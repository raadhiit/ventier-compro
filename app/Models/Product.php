<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
            'specifications' => 'array',
            'features' => 'array',
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
