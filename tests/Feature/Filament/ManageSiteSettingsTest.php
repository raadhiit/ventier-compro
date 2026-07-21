<?php

use App\Filament\Pages\ManageSiteSettings;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Livewire;

beforeEach(function () {
    SiteSetting::query()->delete();
});

test('site settings page is restricted to super admins', function () {
    expect(ManageSiteSettings::canAccess())->toBeFalse();

    $contentAdmin = User::factory()->create([
        'role' => User::ROLE_CONTENT_ADMIN,
        'is_active' => true,
    ]);

    $this->actingAs($contentAdmin);

    expect(ManageSiteSettings::canAccess())->toBeFalse();

    $superAdmin = User::factory()->create([
        'role' => User::ROLE_SUPER_ADMIN,
        'is_active' => true,
    ]);

    $this->actingAs($superAdmin);

    expect(ManageSiteSettings::canAccess())->toBeTrue();
});

test('super admin can persist site settings and clear public cache', function () {
    Cache::put(SiteSetting::CACHE_KEY, ['brand_name' => 'Stale'], now()->addHour());

    $this->actingAs(User::factory()->create([
        'role' => User::ROLE_SUPER_ADMIN,
        'is_active' => true,
    ]));

    Livewire::test(ManageSiteSettings::class)
        ->fillForm([
            'brand_name' => 'Vantier Studio',
            'footer_description' => 'Footer copy',
            'whatsapp_number' => '+6281234567890',
            'email' => 'hello@example.com',
            'instagram_url' => 'https://instagram.com/vantier',
            'address' => 'Jakarta',
            'default_seo_title' => 'SEO Title',
            'default_seo_description' => 'SEO description',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect(SiteSetting::query()->where('key', 'brand_name')->value('value'))->toBe('Vantier Studio')
        ->and(Cache::has(SiteSetting::CACHE_KEY))->toBeFalse();
});

test('site settings page validates admin input', function () {
    $this->actingAs(User::factory()->create([
        'role' => User::ROLE_SUPER_ADMIN,
        'is_active' => true,
    ]));

    Livewire::test(ManageSiteSettings::class)
        ->fillForm([
            'brand_name' => '',
            'email' => 'not-an-email',
            'instagram_url' => 'not-a-url',
        ])
        ->call('save')
        ->assertHasFormErrors([
            'brand_name' => 'required',
            'email' => 'email',
            'instagram_url' => 'url',
        ]);
});
