@php
    $brandName = $siteSettings['brand_name'];
@endphp

<div class="bg-surface-warm px-5 py-20">
    <div class="mx-auto grid max-w-[1262px] gap-12 lg:grid-cols-2">
        <div>
            <h1 class="text-[40px] font-semibold leading-[1.1] sm:text-[48px]">Contact</h1>
            <p class="mt-4 text-[17px] leading-[28px] text-text-secondary">Reach {{ $brandName }} for product inquiries, partnership discussions, or support.</p>
        </div>
        <div>
            <livewire:contact-form />
        </div>
    </div>
</div>
