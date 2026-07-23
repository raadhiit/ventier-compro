<?php

use App\Models\Product;

test('missing public page renders custom 404', function () {
    $this->get('/missing-public-page')
        ->assertNotFound()
        ->assertSee('This road ends here.')
        ->assertSee(route('home'), false)
        ->assertSee(route('products.index'), false);
});

test('sitemap and robots expose only public product URLs', function () {
    $published = Product::query()->create([
        'name' => 'Published Sitemap Product',
        'slug' => 'published-sitemap-product',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $draft = Product::query()->create([
        'name' => 'Draft Sitemap Product',
        'slug' => 'draft-sitemap-product',
        'status' => 'draft',
    ]);

    $future = Product::query()->create([
        'name' => 'Future Sitemap Product',
        'slug' => 'future-sitemap-product',
        'status' => 'published',
        'published_at' => now()->addDay(),
    ]);

    $this->get(route('sitemap'))
        ->assertSuccessful()
        ->assertHeader('Content-Type', 'application/xml')
        ->assertSee(route('products.show', $published), false)
        ->assertDontSee(route('products.show', $draft), false)
        ->assertDontSee(route('products.show', $future), false);

    $this->get(route('robots'))
        ->assertSuccessful()
        ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
        ->assertSee('Allow: /')
        ->assertSee(route('sitemap'), false);
});

test('product detail renders product and breadcrumb structured data', function () {
    $product = Product::query()->create([
        'name' => 'Structured Product',
        'slug' => 'structured-product',
        'short_description' => 'Structured product description.',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $this->get(route('products.show', $product))
        ->assertSuccessful()
        ->assertSee('type="application/ld+json"', false)
        ->assertSee('"@type":"Product"', false)
        ->assertSee('"@type":"BreadcrumbList"', false)
        ->assertSee(route('products.show', $product), false);
});
