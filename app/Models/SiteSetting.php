<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    public const CACHE_KEY = 'public_site_settings';

    /** @var array<string, string> */
    public const DEFAULTS = [
        'brand_name' => 'Vantier',
        'footer_description' => 'Premium car mats designed for precise protection and interior comfort.',
        'default_seo_title' => 'Vantier — Premium Couture Carmat',
        'default_seo_description' => 'Vantier offers premium car mats with precise design, quality materials, and refined interior protection.',
    ];

    protected $fillable = ['key', 'value', 'type'];

    protected static function booted(): void
    {
        static::saved(fn (): bool => Cache::forget(self::CACHE_KEY));
        static::deleted(fn (): bool => Cache::forget(self::CACHE_KEY));
    }

    /** @return array<string, mixed> */
    public static function publicValues(): array
    {
        return Cache::remember(
            self::CACHE_KEY,
            now()->addHour(),
            fn (): array => array_replace(
                self::DEFAULTS,
                self::query()
                    ->pluck('value', 'key')
                    ->map(fn (mixed $value): mixed => is_string($value) ? trim($value) : $value)
                    ->filter(fn (mixed $value): bool => $value !== null && $value !== '')
                    ->all(),
            ),
        );
    }

    protected function casts(): array
    {
        return [
            'value' => 'json',
        ];
    }
}
