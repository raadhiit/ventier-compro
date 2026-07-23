<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    public const HERO = 'hero';

    public const FEATURED_PRODUCTS = 'featured_products';

    public const BENEFITS = 'benefits';

    public const ABOUT_PREVIEW = 'about_preview';

    public const CTA = 'cta';

    /** @return array<string, string> */
    public static function sectionOptions(): array
    {
        return [
            self::HERO => 'Hero Banner',
            self::FEATURED_PRODUCTS => 'Featured Products',
            self::BENEFITS => 'Benefits',
            self::ABOUT_PREVIEW => 'About Preview',
            self::CTA => 'Call to Action',
        ];
    }

    /** @return array<string, string> */
    public static function publicViews(): array
    {
        return [
            self::HERO => 'sections.hero',
            self::FEATURED_PRODUCTS => 'sections.featured_products',
            self::BENEFITS => 'sections.benefits',
            self::ABOUT_PREVIEW => 'sections.about_preview',
            self::CTA => 'sections.cta',
        ];
    }

    protected $fillable = [
        'section_key',
        'title',
        'subtitle',
        'content',
        'image_path',
        'cta_label',
        'cta_url',
        'settings',
        'is_visible',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'settings' => 'array',
            'is_visible' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
