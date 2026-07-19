<div>
    @if($sent)
        <div class="p-6 bg-champagne-soft rounded-2xl text-text-primary">
            <p class="font-semibold text-lg">Message sent successfully</p>
            <p class="mt-2">Thank you for contacting Ventier. We will respond as soon as possible.</p>
        </div>
    @else
        <form wire:submit="submit" class="space-y-6">
            <div style="display:none" aria-hidden="true">
                <input tabindex="-1" autocomplete="off" wire:model="website">
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-[12px] font-semibold leading-[16px] mb-2">Name</label>
                    <input wire:model="name" type="text" required class="h-11 w-full rounded-lg border border-border-sand bg-white px-4 text-[17px] outline-none focus:border-champagne focus:ring-4 focus:ring-champagne/25">
                    @error('name') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-[12px] font-semibold leading-[16px] mb-2">Phone / WhatsApp</label>
                    <input wire:model="phone" type="tel" required class="h-11 w-full rounded-lg border border-border-sand bg-white px-4 text-[17px] outline-none focus:border-champagne focus:ring-4 focus:ring-champagne/25">
                    @error('phone') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-[12px] font-semibold leading-[16px] mb-2">Email</label>
                    <input wire:model="email" type="email" class="h-11 w-full rounded-lg border border-border-sand bg-white px-4 text-[17px] outline-none focus:border-champagne focus:ring-4 focus:ring-champagne/25">
                                </div>
                                <div>
                                    <label class="block text-[12px] font-semibold leading-[16px] mb-2">Subject</label>
                                    <input wire:model="subject" type="text" class="h-11 w-full rounded-lg border border-border-sand bg-white px-4 text-[17px] outline-none focus:border-champagne focus:ring-4 focus:ring-champagne/25">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[12px] font-semibold leading-[16px] mb-2">Message</label>
                                <textarea wire:model="message" required rows="5" class="w-full rounded-lg border border-border-sand bg-white px-4 py-3 text-[17px] outline-none focus:border-champagne focus:ring-4 focus:ring-champagne/25"></textarea>
                                @error('message') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" class="h-11 rounded-full bg-brand-black px-6 text-white hover:bg-brand-carbon transition-colors" wire:loading.attr="disabled">
                <span wire:loading.remove>Send Message</span>
                <span wire:loading>Sending...</span>
            </button>
        </form>
    @endif
</div>
