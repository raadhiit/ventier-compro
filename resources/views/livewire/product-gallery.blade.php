<div>
    <div class="aspect-[4/3] overflow-hidden rounded-[2rem] border border-border-sand bg-surface-muted shadow-[0_20px_60px_rgba(11,11,11,0.18)]">
        @if($currentImage)
            <img src="{{ Storage::disk('public')->url($currentImage) }}" alt="{{ $productName }}" width="1200" height="1500" class="h-full w-full object-cover">
        @else
            <div class="grid h-full place-items-center bg-[radial-gradient(circle_at_top,_rgba(183,154,99,0.18),_transparent_42%),linear-gradient(180deg,_#262626_0%,_#171717_100%)] px-8 text-center text-sm text-white/55">
                Product image coming soon
            </div>
        @endif
    </div>

    @if($images->isNotEmpty())
        <div class="mt-4 grid grid-cols-4 gap-4">
            @foreach($images as $image)
                <button type="button" wire:key="gallery-{{ $image->id }}" wire:click="show('{{ $image->image_path }}')" aria-label="Show {{ $image->alt_text ?: $productName }}" @class([
                    'aspect-square overflow-hidden rounded-2xl border bg-surface-muted transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne',
                    'border-champagne' => $currentImage === $image->image_path,
                    'border-border-sand hover:border-champagne/60' => $currentImage !== $image->image_path,
                ])>
                    <img src="{{ Storage::disk('public')->url($image->image_path) }}" alt="{{ $image->alt_text ?: $productName }}" width="400" height="400" loading="lazy" class="h-full w-full object-cover">
                </button>
            @endforeach
        </div>
    @endif
</div>
