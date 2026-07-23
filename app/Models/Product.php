<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_category_id',
        'name',
        'slug',
        'short_description',
        'description',
        'material',
        'specifications',
        'features',
        'thumbnail_path',
        'status',
        'is_featured',
        'sort_order',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /** @return Attribute<array<string|int, mixed>, string> */
    protected function specifications(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value): array => self::normalizeStructuredField($value),
            set: fn (mixed $value): string => json_encode(self::normalizeStructuredField($value), JSON_THROW_ON_ERROR),
        );
    }

    /** @return Attribute<array<int, mixed>, string> */
    protected function features(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value): array => array_values(self::normalizeStructuredField($value)),
            set: fn (mixed $value): string => json_encode(array_values(self::normalizeStructuredField($value)), JSON_THROW_ON_ERROR),
        );
    }

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function (self $product) {
            if (empty($product->seo_title)) {
                $product->seo_title = Str::limit($product->name, 60);
            }
            if (empty($product->seo_description)) {
                $product->seo_description = Str::limit($product->short_description ?: strip_tags($product->description), 160);
            }
        });
    }

    /** @return array<string, mixed>|array<int, mixed> */
    private static function normalizeStructuredField(mixed $value): array
    {
        if (is_array($value)) {
            return $value;
        }

        if (! is_string($value) || trim($value) === '') {
            return [];
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : [];
    }

    /** @return BelongsTo<ProductCategory, $this> */
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            ProductCategory::class,
            'product_category_id',
        );
    }

    /** @return HasMany<ProductImage, $this> */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)
            ->orderBy('sort_order');
    }

    /**
     * @param  Builder<Product>  $query
     */
    #[Scope]
    protected function published(Builder $query): void
    {
        $query
            ->where('status', 'published')
            ->where(function (Builder $query): void {
                $query
                    ->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }
}
