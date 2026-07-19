<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.public')]
class ProductCatalog extends Component
{
    use WithPagination;

    public string $search = '';
    public ?string $category = null;
    public int $perPage = 12;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategory(): void
    {
        $this->resetPage();
    }

    public function loadMore(): void
    {
        $this->perPage += 12;
    }

    public function render()
    {
        $products = Product::query()
            ->where('status', 'published')
            ->when($this->search, fn($q) => $q->where(function($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('slug', 'like', "%{$this->search}%")
                    ->orWhere('short_description', 'like', "%{$this->search}%");
            }))
            ->when($this->category, fn($q) => $q->where('product_category_id', $this->category))
            ->latest()
            ->paginate($this->perPage);

        $categories = \App\Models\ProductCategory::where('is_active', true)->get();

        return view('livewire.product-catalog', compact('products', 'categories'));
    }
}