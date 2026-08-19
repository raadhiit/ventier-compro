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

    /** @var array<int, array{path: string, alt: string}> */
    public array $thumbnails = [];

    public string $currentImage = '';

    public bool $previewOpen = false;

    public string $productName = 'Product';

    /**
     * @param  Collection<int, ProductImage>  $images
     */
    public function mount(Collection $images, ?string $thumbnail = null, string $productName = 'Product'): void
    {
        $this->images = $images->values();
        $this->productName = $productName;

        $thumbnails = collect();

        if ($thumbnail) {
            $thumbnails->push(['path' => $thumbnail, 'alt' => $productName]);
        }

        foreach ($this->images as $image) {
            if ($image->image_path === $thumbnail) {
                continue;
            }

            $thumbnails->push(['path' => $image->image_path, 'alt' => $image->alt_text ?: $productName]);
        }

        $this->thumbnails = $thumbnails->values()->all();

        $firstImagePath = $this->images->isEmpty()
            ? ''
            : $this->images->first()->image_path;

        $this->currentImage = $thumbnail ?: $firstImagePath;
    }

    public function show(string $imagePath): void
    {
        $this->currentImage = $imagePath;
    }

    public function openPreview(): void
    {
        if ($this->currentImage === '') {
            return;
        }

        $this->previewOpen = true;
    }

    public function closePreview(): void
    {
        $this->previewOpen = false;
    }

    public function render(): View
    {
        return view('livewire.product-gallery');
    }
}
