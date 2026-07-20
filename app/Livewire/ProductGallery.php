<?php

namespace App\Livewire;

use App\Models\ProductImage;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ProductGallery extends Component
{
    /** @var Collection<int, ProductImage> */
    public Collection $images;

    public string $currentImage = '';

    /**
     * @param  Collection<int, ProductImage>  $images
     */
    public function mount(Collection $images, ?string $thumbnail = null): void
    {
        $this->images = $images->values();

        $firstImagePath = $this->images->isEmpty()
            ? ''
            : $this->images->first()->image_path;

        $this->currentImage = $thumbnail ?: $firstImagePath;
    }

    public function show(string $imagePath): void
    {
        $this->currentImage = $imagePath;
    }

    public function render(): View
    {
        return view('livewire.product-gallery');
    }
}
