<?php

use App\Models\Product;
use App\Models\SiteSetting;

beforeEach(function () {
    SiteSetting::query()->delete();
});

test('public routes render shared fallbacks when settings are empty', function () {
    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('Vantier', false)
        ->assertSee('<title>Home</title>', false)
        ->assertSee('name="description" content="Discover premium automotive car mats made for refined protection, precise fit, and easy product inquiry."', false)
        ->assertSee(route('products.index'), false)
        ->assertDontSee('href="#"', false);

    $this->get(route('contact'))
        ->assertSuccessful()
        ->assertSee('Reach Vantier for product inquiries, partnership discussions, or support.')
        ->assertDontSee('mailto:', false)
        ->assertDontSee('https://wa.me/', false);
});

test('public layout renders settings-driven branding and contact links', function () {
    collect([
        'brand_name' => 'Vantier Studio',
        'footer_description' => 'Premium profile and curated product catalog.',
        'email' => 'hello@example.com',
        'instagram_url' => 'https://instagram.com/vantier',
        'whatsapp_number' => '+62 812-3456-7890',
        'address' => 'Jakarta',
        'default_seo_title' => 'Default SEO Title',
        'default_seo_description' => 'Default SEO Description',
    ])->each(fn (string $value, string $key) => SiteSetting::query()->create([
        'key' => $key,
        'value' => $value,
        'type' => 'string',
    ]));

    $this->get(route('about'))
        ->assertSuccessful()
        ->assertSee('Vantier Studio')
        ->assertSee('Premium profile and curated product catalog.')
        ->assertSee('mailto:hello@example.com', false)
        ->assertSee('https://instagram.com/vantier', false)
        ->assertSee('https://wa.me/6281234567890', false)
        ->assertSee('Jakarta')
        ->assertSee('<meta property="og:site_name" content="Vantier Studio">', false);
});

test('product detail uses product seo metadata', function () {
    $product = Product::query()->create([
        'name' => 'Signature Mat',
        'slug' => 'signature-mat',
        'short_description' => 'Short summary',
        'description' => 'Long description',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $product->forceFill([
        'seo_title' => 'Signature Mat SEO',
        'seo_description' => 'Signature Mat SEO Description',
    ])->saveQuietly();

    $this->get(route('products.show', $product))
        ->assertSuccessful()
        ->assertSee('<title>Signature Mat SEO</title>', false)
        ->assertSee('name="description" content="Signature Mat SEO Description"', false)
        ->assertSee('property="og:type" content="product"', false);
});
