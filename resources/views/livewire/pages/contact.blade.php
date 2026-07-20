<div class="bg-surface-warm px-5 py-20">
    <div class="max-w-[1262px] mx-auto grid gap-12 lg:grid-cols-2">
        <div x-intersect="$el.style.opacity = 1" style="opacity: 0; transition: opacity 0.8s ease-out">
            <h1 class="text-[40px] sm:text-[48px] font-semibold leading-[1.1]">Contact Us</h1>
            <p class="mt-4 text-[17px] leading-[28px] text-text-secondary">Reach Vantier for product inquiries, partnership discussions, or support.</p>
        </div>
        <div x-intersect="$el.style.opacity = 1" style="opacity: 0; transition: opacity 0.8s ease-out 0.2s">
            <livewire:contact-form />
        </div>
    </div>
</div>
