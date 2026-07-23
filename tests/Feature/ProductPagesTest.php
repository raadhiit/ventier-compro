<?php

use App\Livewire\ProductCatalog;
use App\Livewire\ProductGallery;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;

beforeEach(function () {
    ProductImage::query()->delete();
    Product::query()->delete();
    ProductCategory::query()->delete();
});

function makeCategory(string $name = 'SUV'): ProductCategory
{
    return ProductCategory::query()->create([
        'name' => $name,
        'slug' => str()->slug($name),
        'is_active' => true,
        'sort_order' => 1,
    ]);
}

function makeProduct(array $attributes = []): Product
{
    static $sequence = 1;

    $defaults = [
        'name' => 'Product '.$sequence,
        'slug' => 'product-'.$sequence,
        'short_description' => 'Short description '.$sequence,
        'description' => 'Long description '.$sequence,
        'status' => 'published',
        'published_at' => now(),
        'is_featured' => false,
        'sort_order' => $sequence,
    ];

    $sequence++;

    return Product::query()->create(array_merge($defaults, $attributes));
}

test('catalog page shows only published non-future products', function () {
    $visibleProduct = makeProduct(['name' => 'Visible Product', 'slug' => 'visible-product']);
    makeProduct(['name' => 'Draft Product', 'slug' => 'draft-product', 'status' => 'draft', 'published_at' => null]);
    makeProduct(['name' => 'Future Product', 'slug' => 'future-product', 'published_at' => now()->addDay()]);

    $this->get(route('products.index'))
        ->assertSuccessful()
        ->assertSee('Visible Product')
        ->assertSee(route('products.show', $visibleProduct), false)
        ->assertDontSee('Draft Product')
        ->assertDontSee('Future Product');
});

test('catalog filters by search and category slug', function () {
    $sedan = makeCategory('Sedan');
    $suv = makeCategory('SUV');

    makeProduct([
        'name' => 'Executive Sedan Mat',
        'slug' => 'executive-sedan-mat',
        'product_category_id' => $sedan->id,
    ]);

    makeProduct([
        'name' => 'Adventure SUV Mat',
        'slug' => 'adventure-suv-mat',
        'product_category_id' => $suv->id,
    ]);

    Livewire::test(ProductCatalog::class)
        ->set('search', 'Sedan')
        ->assertSee('Executive Sedan Mat')
        ->assertDontSee('Adventure SUV Mat')
        ->call('resetFilters')
        ->call('selectCategory', $sedan->slug)
        ->assertSee('Executive Sedan Mat')
        ->assertDontSee('Adventure SUV Mat')
        ->call('resetFilters')
        ->assertSee('Adventure SUV Mat');
});

test('catalog prefilters by category slug from query string', function () {
    $sedan = makeCategory('Sedan');
    $suv = makeCategory('SUV');

    makeProduct([
        'name' => 'Executive Sedan Mat',
        'slug' => 'executive-sedan-mat',
        'product_category_id' => $sedan->id,
    ]);

    makeProduct([
        'name' => 'Adventure SUV Mat',
        'slug' => 'adventure-suv-mat',
        'product_category_id' => $suv->id,
    ]);

    $this->get(route('products.index', ['category' => $suv->slug]))
        ->assertSuccessful()
        ->assertSee('Adventure SUV Mat')
        ->assertDontSee('Executive Sedan Mat');
});

test('catalog load more increases per page', function () {
    for ($i = 1; $i <= 13; $i++) {
        makeProduct([
            'name' => 'Catalog Product '.$i,
            'slug' => 'catalog-product-'.$i,
            'sort_order' => $i,
        ]);
    }

    Livewire::test(ProductCatalog::class)
        ->assertDontSee('Catalog Product 13')
        ->call('loadMore')
        ->assertSee('Catalog Product 13');
});

test('catalog shows filter empty state when no products match', function () {
    makeProduct([
        'name' => 'Luxury Fit Mat',
        'slug' => 'luxury-fit-mat',
    ]);

    Livewire::test(ProductCatalog::class)
        ->set('search', 'missing-keyword')
        ->assertSee('No products match this filter.')
        ->assertSee('Reset filters');
});

test('product gallery opens and closes main image preview', function () {
    $product = makeProduct([
        'name' => 'Preview Product',
        'slug' => 'preview-product',
        'thumbnail_path' => 'products/preview-thumbnail.webp',
    ]);

    $image = ProductImage::query()->create([
        'product_id' => $product->id,
        'image_path' => 'products/preview-detail.webp',
        'alt_text' => 'Preview detail',
        'sort_order' => 1,
    ]);

    Livewire::test(ProductGallery::class, [
        'images' => $product->images()->get(),
        'thumbnail' => $product->thumbnail_path,
        'productName' => $product->name,
    ])
        ->assertSet('previewOpen', false)
        ->assertSee('Open larger preview of Preview Product')
        ->call('openPreview')
        ->assertSet('previewOpen', true)
        ->call('show', $image->image_path)
        ->assertSet('currentImage', $image->image_path)
        ->call('closePreview')
        ->assertSet('previewOpen', false);
});

test('product detail safely handles legacy structured fields stored as strings', function () {
    $product = makeProduct([
        'name' => 'Legacy Product',
        'slug' => 'legacy-product',
    ]);

    DB::table('products')
        ->where('id', $product->id)
        ->update([
            'features' => json_encode('Legacy feature'),
            'specifications' => json_encode('Legacy specification'),
        ]);

    $product->refresh();

    expect($product->features)->toBeArray()->toBeEmpty()
        ->and($product->specifications)->toBeArray()->toBeEmpty();

    $this->get(route('products.show', $product))
        ->assertSuccessful()
        ->assertDontSee('Built around daily protection.')
        ->assertDontSee('Details at a glance.');
});

test('product detail renders seo, gallery, specifications, and related published products only', function () {
    SiteSetting::query()->create([
        'key' => 'whatsapp_number',
        'value' => '+6281234567890',
        'type' => 'string',
    ]);

    $category = makeCategory();

    $product = makeProduct([
        'name' => 'Signature Mat',
        'slug' => 'signature-mat',
        'product_category_id' => $category->id,
        'material' => 'Hybrid leather',
        'features' => ['Deep edge coverage', 'Precision texture'],
        'specifications' => ['Material' => 'Hybrid leather', 'Layer' => 'Anti-slip base'],
        'thumbnail_path' => 'products/signature-thumbnail.webp',
    ]);

    $product->forceFill([
        'seo_title' => 'Signature Mat SEO',
        'seo_description' => 'Signature Mat SEO Description',
    ])->saveQuietly();

    ProductImage::query()->create([
        'product_id' => $product->id,
        'image_path' => 'products/signature-detail.webp',
        'alt_text' => 'Signature detail',
        'sort_order' => 1,
    ]);

    makeProduct([
        'name' => 'Related Product',
        'slug' => 'related-product',
        'product_category_id' => $category->id,
        'status' => 'published',
        'published_at' => now(),
    ]);

    makeProduct([
        'name' => 'Draft Related',
        'slug' => 'draft-related',
        'product_category_id' => $category->id,
        'status' => 'draft',
        'published_at' => null,
    ]);

    $this->get(route('products.show', $product))
        ->assertSuccessful()
        ->assertSee('<title>Signature Mat SEO</title>', false)
        ->assertSee('name="description" content="Signature Mat SEO Description"', false)
        ->assertSee('property="og:type" content="product"', false)
        ->assertSee('Hybrid leather')
        ->assertSee('Deep edge coverage')
        ->assertSee('Precision texture')
        ->assertSee('Related Product')
        ->assertDontSee('Draft Related')
        ->assertSee('Ask via WhatsApp')
        ->assertSee('Show Signature detail')
        ->assertSee('https://wa.me/6281234567890', false);
});

test('draft and future product detail routes return not found', function () {
    $draft = makeProduct([
        'name' => 'Draft Product',
        'slug' => 'draft-product',
        'status' => 'draft',
        'published_at' => null,
    ]);

    $future = makeProduct([
        'name' => 'Future Product',
        'slug' => 'future-product',
        'published_at' => now()->addDay(),
    ]);

    $this->get(route('products.show', $draft))->assertNotFound();
    $this->get(route('products.show', $future))->assertNotFound();
});
