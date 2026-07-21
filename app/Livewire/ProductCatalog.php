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

    public function selectCategory(?string $category): void
    {
        $this->category = $category;
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->reset(['search', 'category']);
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
            ->with('category')
            ->when($this->search, fn ($query) => $query->where(function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('slug', 'like', "%{$this->search}%")
                    ->orWhere('short_description', 'like', "%{$this->search}%");
            }))
            ->when($this->category, fn ($query) => $query->where('product_category_id', $this->category))
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->latest()
            ->paginate($this->perPage);

        $categories = ProductCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

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
