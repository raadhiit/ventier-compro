<?php

namespace App\Livewire;

use Livewire\Component;

class ProductGallery extends Component
{
    public $images;
    public string $currentImage = '';

    public function mount($images, ?string $thumbnail = null): void
    {
        $this->images = collect($images)->values();
        $this->currentImage = $thumbnail ?: ($this->images->first()->image_path ?? '');
    }

    public function show(string $imagePath): void
    {
        $this->currentImage = $imagePath;
    }

    public function render()
    {
        return view('livewire.product-gallery');
    }
}
