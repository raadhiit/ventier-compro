<?php

use App\Livewire\ContactForm;
use App\Models\ContactMessage;
use App\Models\PageContent;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;

beforeEach(function () {
    PageContent::query()->delete();
    ContactMessage::query()->delete();
    SiteSetting::query()->delete();
    RateLimiter::clear('contact-form:127.0.0.1');
});

test('about page renders visible sections in order and skips hidden ones', function () {
    PageContent::query()->create([
        'page_key' => 'about',
        'section_key' => 'cta',
        'title' => 'Last CTA',
        'is_visible' => true,
        'sort_order' => 2,
    ]);

    PageContent::query()->create([
        'page_key' => 'about',
        'section_key' => 'hero',
        'title' => 'About Hero',
        'is_visible' => true,
        'sort_order' => 0,
    ]);

    PageContent::query()->create([
        'page_key' => 'about',
        'section_key' => 'story',
        'title' => 'Our Story',
        'is_visible' => true,
        'sort_order' => 1,
    ]);

    PageContent::query()->create([
        'page_key' => 'about',
        'section_key' => 'values',
        'title' => 'Hidden Values',
        'is_visible' => false,
        'sort_order' => 3,
    ]);

    $this->get(route('about'))
        ->assertSuccessful()
        ->assertSeeInOrder(['About Hero', 'Our Story', 'Last CTA'])
        ->assertDontSee('Hidden Values');
});

test('about page shows premium fallback when cms is empty', function () {
    $this->get(route('about'))
        ->assertSuccessful()
        ->assertSee('Premium car mat brand, built around trust and product clarity.')
        ->assertSee(route('products.index'), false)
        ->assertSee(route('contact'), false);
});

test('contact page renders settings backed links and hides empty ones', function () {
    collect([
        'brand_name' => 'Vantier Studio',
        'whatsapp_number' => '+62 812-3456-7890',
        'email' => 'hello@example.com',
        'instagram_url' => 'https://instagram.com/vantier',
        'address' => 'Jakarta',
    ])->each(fn (string $value, string $key) => SiteSetting::query()->create([
        'key' => $key,
        'value' => $value,
        'type' => 'string',
    ]));

    $this->get(route('contact'))
        ->assertSuccessful()
        ->assertSee('Contact Vantier Studio')
        ->assertSee('https://wa.me/6281234567890', false)
        ->assertSee('mailto:hello@example.com', false)
        ->assertSee('https://instagram.com/vantier', false)
        ->assertSee('Jakarta');
});

test('contact form validates required fields', function () {
    Livewire::test(ContactForm::class)
        ->call('submit')
        ->assertHasErrors([
            'name' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
});

test('contact form stores valid submissions', function () {
    Livewire::test(ContactForm::class)
        ->set('name', 'Jane Doe')
        ->set('phone', '+6281234567890')
        ->set('email', 'jane@example.com')
        ->set('subject', 'Product question')
        ->set('message', 'Need more details about fitment.')
        ->call('submit')
        ->assertSet('sent', true);

    expect(ContactMessage::query()->count())->toBe(1)
        ->and(ContactMessage::query()->first()?->status)->toBe('new');
});

test('contact form ignores honeypot spam', function () {
    Livewire::test(ContactForm::class)
        ->set('website', 'https://spam.test')
        ->set('name', 'Spam Bot')
        ->set('phone', '+6281234567890')
        ->set('message', 'Spam message')
        ->call('submit')
        ->assertSet('sent', false);

    expect(ContactMessage::query()->count())->toBe(0);
});

test('contact form rate limits repeated submissions', function () {
    for ($attempt = 1; $attempt <= 5; $attempt++) {
        Livewire::test(ContactForm::class)
            ->set('name', 'Jane Doe')
            ->set('phone', '+6281234567890')
            ->set('message', 'Attempt '.$attempt)
            ->call('submit')
            ->assertSet('sent', true);
    }

    Livewire::test(ContactForm::class)
        ->set('name', 'Jane Doe')
        ->set('phone', '+6281234567890')
        ->set('message', 'Blocked attempt')
        ->call('submit')
        ->assertHasErrors(['form']);

    expect(ContactMessage::query()->count())->toBe(5);
});
