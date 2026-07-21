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
            ->limit(3)
            ->get();

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
            ],
        );
    }
}
