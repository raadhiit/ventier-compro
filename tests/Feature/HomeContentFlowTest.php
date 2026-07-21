<?php

use App\Models\HomeSection;
use App\Models\Product;

beforeEach(function () {
    HomeSection::query()->delete();
    Product::query()->delete();
});

test('home shows useful fallback when no sections are visible', function () {
    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('Showroom sedang disiapkan. Brand, katalog, dan konsultasi tetap siap dilihat.')
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

test('featured products section only renders published featured products', function () {
    HomeSection::query()->create([
        'section_key' => HomeSection::FEATURED_PRODUCTS,
        'title' => 'Featured picks',
        'is_visible' => true,
        'sort_order' => 0,
        'settings' => ['limit' => 6],
    ]);

    Product::query()->create([
        'name' => 'Published Featured',
        'slug' => 'published-featured',
        'status' => 'published',
        'is_featured' => true,
        'published_at' => now(),
    ]);

    Product::query()->create([
        'name' => 'Draft Featured',
        'slug' => 'draft-featured',
        'status' => 'draft',
        'is_featured' => true,
    ]);

    Product::query()->create([
        'name' => 'Published Non Featured',
        'slug' => 'published-non-featured',
        'status' => 'published',
        'is_featured' => false,
        'published_at' => now(),
    ]);

    Product::query()->create([
        'name' => 'Future Featured',
        'slug' => 'future-featured',
        'status' => 'published',
        'is_featured' => true,
        'published_at' => now()->addDay(),
    ]);

    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('Published Featured')
        ->assertDontSee('Draft Featured')
        ->assertDontSee('Published Non Featured')
        ->assertDontSee('Future Featured');
});

test('featured products section shows catalog fallback when no product is eligible', function () {
    HomeSection::query()->create([
        'section_key' => HomeSection::FEATURED_PRODUCTS,
        'title' => 'Featured picks',
        'is_visible' => true,
        'sort_order' => 0,
    ]);

    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('Produk unggulan sedang disiapkan.')
        ->assertSee(route('products.index'), false);
});
