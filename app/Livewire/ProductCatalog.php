<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

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

    public function render(): View
    {
        $products = Product::query()
            ->published()
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('slug', 'like', "%{$this->search}%")
                    ->orWhere('short_description', 'like', "%{$this->search}%");
            }))
            ->when($this->category, fn ($q) => $q->where('product_category_id', $this->category))
            ->latest()
            ->paginate($this->perPage);

        $categories = ProductCategory::where('is_active', true)->get();

        return view('livewire.product-catalog', compact('products', 'categories'))
            ->layout(
                'layouts.public',
                [
                    'title' => 'Products',
                    'description' => 'Browse premium automotive car mats designed for protection, comfort, and precise vehicle fit.',
                ],
            );
    }
}
