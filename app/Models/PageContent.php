<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    public const PAGE_OPTIONS = [
        'about' => 'About Us',
    ];

    public const SECTION_OPTIONS = [
        'about' => [
            'hero' => 'Hero',
            'story' => 'Our Story',
            'values' => 'Our Values',
            'advantages' => 'Why Choose Vantier',
            'cta' => 'Call to Action',
        ],
    ];

    protected $fillable = [
        'page_key',
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

    /**
     * @return array<string, string>
     */
    public static function sectionOptions(?string $pageKey): array
    {
        if (! $pageKey) {
            return [];
        }

        return self::SECTION_OPTIONS[$pageKey] ?? [];
    }

    public function sectionLabel(): string
    {
        return self::SECTION_OPTIONS[$this->page_key][$this->section_key]
            ?? $this->section_key;
    }

    public function pageLabel(): string
    {
        return self::PAGE_OPTIONS[$this->page_key]
            ?? $this->page_key;
    }
}
