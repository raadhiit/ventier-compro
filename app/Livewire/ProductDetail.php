<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;

    public function mount(Product $product): void
    {
        $this->product = Product::query()
            ->published()
            ->with([
                'category',
                'images',
            ])
            ->whereKey($product->getKey())
            ->firstOrFail();
    }

    public function render(): View
    {
        $relatedProducts = Product::query()
            ->published()
            ->whereKeyNot($this->product->getKey())
            ->when(
                $this->product->product_category_id,
                fn ($query) => $query->where(
                    'product_category_id',
                    $this->product->product_category_id,
                ),
            )
            ->with('category')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        $imageUrl = $this->product->thumbnail_path
            ? asset('storage/'.$this->product->thumbnail_path)
            : null;

        $structuredData = [
            '@context' => 'https://schema.org',
            '@graph' => [
                array_filter([
                    '@type' => 'Product',
                    'name' => $this->product->name,
                    'description' => $this->product->seo_description ?: $this->product->short_description,
                    'category' => $this->product->category?->name,
                    'image' => $imageUrl ? [$imageUrl] : null,
                    'url' => route('products.show', $this->product),
                    'brand' => [
                        '@type' => 'Brand',
                        'name' => 'Vantier',
                    ],
                ], fn (mixed $value): bool => $value !== null),
                [
                    '@type' => 'BreadcrumbList',
                    'itemListElement' => [
                        [
                            '@type' => 'ListItem',
                            'position' => 1,
                            'name' => 'Home',
                            'item' => route('home'),
                        ],
                        [
                            '@type' => 'ListItem',
                            'position' => 2,
                            'name' => 'Products',
                            'item' => route('products.index'),
                        ],
                        [
                            '@type' => 'ListItem',
                            'position' => 3,
                            'name' => $this->product->name,
                            'item' => route('products.show', $this->product),
                        ],
                    ],
                ],
            ],
        ];

        return view(
            'livewire.product-detail',
            compact('relatedProducts'),
        )->layout(
            'layouts.public',
            [
                'title' => $this->product->seo_title ?: $this->product->name,
                'description' => $this->product->seo_description ?: $this->product->short_description,
                'image' => $this->product->thumbnail_path,
                'ogType' => 'product',
                'structuredData' => $structuredData,
            ],
        );
    }
}
