@php
    $brandName = $siteSettings['brand_name'];
@endphp

<div>
    @if($sent)
        <div class="rounded-[1.5rem] border border-champagne/20 bg-champagne-soft p-6 text-text-primary">
            <p class="text-lg font-semibold">Message sent successfully</p>
            <p class="mt-2 leading-7">Thank you for contacting {{ $brandName }}. We will respond as soon as possible.</p>
        </div>
    @else
        <form wire:submit="submit" class="space-y-6">
            <div aria-hidden="true" class="hidden">
                <input tabindex="-1" autocomplete="off" wire:model="website">
            </div>

            @error('form')
                <div class="rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">{{ $message }}</div>
            @enderror

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label for="contact-name" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-text-muted">Name</label>
                    <input id="contact-name" wire:model="name" type="text" autocomplete="name" required class="h-12 w-full rounded-2xl border border-border-sand bg-white px-4 text-[17px] outline-none transition focus:border-champagne focus:ring-4 focus:ring-champagne/20">
                    @error('name') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="contact-phone" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-text-muted">Phone / WhatsApp</label>
                    <input id="contact-phone" wire:model="phone" type="tel" autocomplete="tel" required class="h-12 w-full rounded-2xl border border-border-sand bg-white px-4 text-[17px] outline-none transition focus:border-champagne focus:ring-4 focus:ring-champagne/20">
                    @error('phone') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label for="contact-email" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-text-muted">Email</label>
                    <input id="contact-email" wire:model="email" type="email" autocomplete="email" class="h-12 w-full rounded-2xl border border-border-sand bg-white px-4 text-[17px] outline-none transition focus:border-champagne focus:ring-4 focus:ring-champagne/20">
                </div>
                <div>
                    <label for="contact-subject" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-text-muted">Subject</label>
                    <input id="contact-subject" wire:model="subject" type="text" autocomplete="off" class="h-12 w-full rounded-2xl border border-border-sand bg-white px-4 text-[17px] outline-none transition focus:border-champagne focus:ring-4 focus:ring-champagne/20">
                </div>
            </div>

            <div>
                <label for="contact-message" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-text-muted">Message</label>
                <textarea id="contact-message" wire:model="message" required rows="6" class="w-full rounded-2xl border border-border-sand bg-white px-4 py-3 text-[17px] outline-none transition focus:border-champagne focus:ring-4 focus:ring-champagne/20"></textarea>
                @error('message') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
            </div>

            <button type="submit" wire:loading.attr="disabled" class="inline-flex h-12 items-center justify-center rounded-full bg-brand-black px-6 text-sm font-semibold text-white transition hover:bg-brand-carbon disabled:opacity-60">
                <span wire:loading.remove>Send Message</span>
                <span wire:loading>Sending...</span>
            </button>
        </form>
    @endif
</div>
