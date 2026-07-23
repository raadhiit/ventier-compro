<?php

use App\Models\HomeSection;
use App\Models\PageContent;

beforeEach(function () {
    HomeSection::query()->delete();
    PageContent::query()->delete();
});

test('cms options only expose active public sections', function () {
    expect(HomeSection::sectionOptions())
        ->toHaveKeys([
            HomeSection::HERO,
            HomeSection::FEATURED_PRODUCTS,
            HomeSection::BENEFITS,
            HomeSection::ABOUT_PREVIEW,
            HomeSection::CTA,
        ])
        ->not->toHaveKey('latest_articles')
        ->and(PageContent::PAGE_OPTIONS)
        ->toBe(['about' => 'About Us'])
        ->and(PageContent::sectionOptions('about'))
        ->toHaveKeys(['hero', 'story', 'values', 'advantages', 'cta'])
        ->and(PageContent::sectionOptions('contact'))
        ->toBe([]);
});

test('cleanup migration targets unused cms records', function () {
    HomeSection::query()->create([
        'section_key' => 'latest_articles',
        'title' => 'Legacy articles',
        'is_visible' => true,
        'sort_order' => 1,
    ]);

    PageContent::query()->create([
        'page_key' => 'contact',
        'section_key' => 'hero',
        'title' => 'Legacy contact hero',
        'settings' => ['items' => [['title' => 'Unused item']]],
        'is_visible' => true,
        'sort_order' => 1,
    ]);

    PageContent::query()->create([
        'page_key' => 'about',
        'section_key' => 'hero',
        'title' => 'About hero',
        'settings' => ['items' => [['title' => 'Unused item']], 'tone' => 'warm'],
        'is_visible' => true,
        'sort_order' => 0,
    ]);

    (require base_path('database/migrations/2026_07_23_104221_cleanup_unused_cms_sections.php'))->up();

    expect(HomeSection::query()->where('section_key', 'latest_articles')->doesntExist())->toBeTrue()
        ->and(PageContent::query()->where('page_key', 'contact')->doesntExist())->toBeTrue()
        ->and(PageContent::query()->where('page_key', 'about')->first()?->settings)
        ->toBe(['tone' => 'warm']);
});
