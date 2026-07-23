<div
    x-data="{ open: @entangle('previewOpen') }"
    x-on:keydown.escape.window="open = false"
>
    <div class="aspect-[4/3] overflow-hidden rounded-[2rem] border border-border-sand bg-surface-muted shadow-[0_20px_60px_rgba(11,11,11,0.18)]">
        @if($currentImage)
            <button type="button" wire:click="openPreview" class="group relative block h-full w-full cursor-zoom-in focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne focus-visible:ring-offset-4 focus-visible:ring-offset-surface-warm" aria-label="Open larger preview of {{ $productName }}">
                <img src="{{ Storage::disk('public')->url($currentImage) }}" alt="{{ $productName }}" width="1200" height="1500" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.02]">
                <span class="pointer-events-none absolute inset-x-0 bottom-0 flex items-center justify-end bg-gradient-to-t from-black/45 via-black/10 to-transparent px-5 py-4 text-xs font-semibold uppercase tracking-[0.24em] text-white/88">View larger</span>
            </button>
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

    <div
        x-cloak
        x-show="open"
        x-on:click.self="open = false"
        x-transition.opacity.duration.200ms
        class="fixed inset-0 z-[90] flex items-center justify-center bg-black/88 p-5"
        role="dialog"
        aria-modal="true"
        aria-label="Image preview"
    >
        <div class="relative w-full max-w-6xl">
            <button type="button" x-on:click="open = false" class="absolute right-3 top-3 z-10 inline-flex size-11 items-center justify-center rounded-full bg-black/55 text-white transition hover:bg-black/75 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne" aria-label="Close image preview">
                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>

            <div class="overflow-hidden rounded-[2rem] bg-brand-black shadow-[0_28px_90px_rgba(0,0,0,0.45)]">
                @if($currentImage)
                    <img src="{{ Storage::disk('public')->url($currentImage) }}" alt="{{ $productName }}" width="1600" height="1200" class="max-h-[85vh] w-full object-contain">
                @endif
            </div>
        </div>
    </div>
</div>
