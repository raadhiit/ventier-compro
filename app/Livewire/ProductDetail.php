<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.public')]
class ProductDetail extends Component
{
    public Product $product;

    public function mount(Product $product): void
    {
        abort_unless($product->status === 'published', 404);

        $this->product = $product->load(['category', 'images']);
    }

    public function render()
    {
        $relatedProducts = Product::query()
            ->where('status', 'published')
            ->whereKeyNot($this->product->id)
            ->when($this->product->product_category_id, fn($q) => $q->where('product_category_id', $this->product->product_category_id))
            ->limit(3)
            ->get();

        return view('livewire.product-detail', compact('relatedProducts'));
    }
}