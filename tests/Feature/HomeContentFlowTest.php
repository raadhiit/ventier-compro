<?php

use App\Models\HomeSection;
use App\Models\Product;
use App\Models\ProductCategory;

beforeEach(function () {
    HomeSection::query()->delete();
    Product::query()->delete();
    ProductCategory::query()->delete();
});

test('home shows useful fallback when no sections are visible', function () {
    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('Our showroom is being prepared. Brand information, product catalog, and consultations remain available.')
        ->assertSee(route('products.index'), false)
        ->assertSee(route('contact'), false);
});

test('home renders visible supported sections in sort order', function () {
    HomeSection::query()->create([
        'section_key' => HomeSection::CTA,
        'title' => 'CTA last',
        'is_visible' => true,
        'sort_order' => 2,
    ]);

    HomeSection::query()->create([
        'section_key' => HomeSection::HERO,
        'title' => 'Hero first',
        'is_visible' => true,
        'sort_order' => 0,
    ]);

    HomeSection::query()->create([
        'section_key' => HomeSection::ABOUT_PREVIEW,
        'title' => 'About middle',
        'is_visible' => true,
        'sort_order' => 1,
    ]);

    $response = $this->get(route('home'));

    $response->assertSuccessful()
        ->assertSeeInOrder([
            'Hero first',
            'About middle',
            'CTA last',
        ]);
});

test('home skips hidden, unsupported, and latest article sections', function () {
    HomeSection::query()->create([
        'section_key' => HomeSection::HERO,
        'title' => 'Visible hero',
        'is_visible' => true,
        'sort_order' => 0,
    ]);

    HomeSection::query()->create([
        'section_key' => HomeSection::LATEST_ARTICLES,
        'title' => 'Should stay hidden',
        'is_visible' => true,
        'sort_order' => 1,
    ]);

    HomeSection::query()->create([
        'section_key' => 'unsafe_partial_name',
        'title' => 'Unsafe include',
        'is_visible' => true,
        'sort_order' => 2,
    ]);

    HomeSection::query()->create([
        'section_key' => HomeSection::CTA,
        'title' => 'Hidden CTA',
        'is_visible' => false,
        'sort_order' => 3,
    ]);

    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('Visible hero')
        ->assertDontSee('Should stay hidden')
        ->assertDontSee('Unsafe include')
        ->assertDontSee('Hidden CTA');
});

test('featured products section renders active product categories with catalog links', function () {
    HomeSection::query()->create([
        'section_key' => HomeSection::FEATURED_PRODUCTS,
        'title' => 'Featured picks',
        'is_visible' => true,
        'sort_order' => 0,
        'settings' => ['limit' => 4],
    ]);

    ProductCategory::query()->create([
        'name' => 'Sedan',
        'slug' => 'sedan',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    ProductCategory::query()->create([
        'name' => 'SUV',
        'slug' => 'suv',
        'is_active' => true,
        'sort_order' => 2,
    ]);

    ProductCategory::query()->create([
        'name' => 'MPV',
        'slug' => 'mpv',
        'is_active' => true,
        'sort_order' => 3,
    ]);

    ProductCategory::query()->create([
        'name' => 'Coupe',
        'slug' => 'coupe',
        'is_active' => true,
        'sort_order' => 4,
    ]);

    ProductCategory::query()->create([
        'name' => 'Hidden',
        'slug' => 'hidden',
        'is_active' => false,
        'sort_order' => 5,
    ]);

    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('Sedan')
        ->assertSee('SUV')
        ->assertSee('MPV')
        ->assertSee('Coupe')
        ->assertDontSee('Hidden')
        ->assertSee(route('products.index', ['category' => 'sedan']), false)
        ->assertSee(route('products.index', ['category' => 'suv']), false);
});

test('featured products section shows catalog fallback when no category is available', function () {
    HomeSection::query()->create([
        'section_key' => HomeSection::FEATURED_PRODUCTS,
        'title' => 'Featured picks',
        'is_visible' => true,
        'sort_order' => 0,
    ]);

    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('Product categories are being prepared.')
        ->assertSee(route('products.index'), false);
});
