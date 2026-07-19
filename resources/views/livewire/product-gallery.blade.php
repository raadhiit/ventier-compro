<div>
    <div class="aspect-[4/3] overflow-hidden rounded-2xl bg-surface-muted border border-border-sand">
        @if($currentImage)
            <img src="{{ Storage::disk('public')->url($currentImage) }}" alt="Product image" class="h-full w-full object-cover">
        @endif
    </div>

    @if($images->isNotEmpty())
        <div class="mt-4 grid grid-cols-4 gap-4">
            @foreach($images as $image)
                <button type="button" wire:key="gallery-{{ $image->id }}" wire:click="show('{{ $image->image_path }}')" class="aspect-square overflow-hidden rounded-xl border {{ $currentImage === $image->image_path ? 'border-champagne' : 'border-border-sand' }} bg-surface-muted">
                    <img src="{{ Storage::disk('public')->url($image->image_path) }}" alt="{{ $image->alt_text ?: 'Product image' }}" class="h-full w-full object-cover">
                </button>
            @endforeach
        </div>
    @endif
</div>
