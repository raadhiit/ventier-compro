<section class="py-20 px-5 bg-white">
    <div class="max-w-[1262px] mx-auto">
        @if($section->title)
            <h2 class="text-[32px] font-semibold leading-[1.2] text-center" x-init="$el.classList.add('animate-fade-in')" style="opacity: 0;" x-intersect="$el.style.opacity = 1">{{ $section->title }}</h2>
        @endif
        @if($section->subtitle)
            <p class="mt-4 text-[17px] leading-[28px] text-text-secondary max-w-2xl mx-auto text-center" x-intersect="$el.style.opacity = 1" style="opacity: 0;" class="transition-all duration-700">{{ $section->subtitle }}</p>
        @endif
        @if($section->content)
            <div class="mt-6 text-[17px] leading-[28px] text-text-secondary max-w-3xl mx-auto text-center">{!! $section->content !!}</div>
        @else
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <div class="p-8 bg-surface-warm rounded-2xl border border-border-sand" x-intersect="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'" style="opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out">
                    <div class="w-12 h-12 rounded-xl bg-champagne/20 flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-champagne" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Kualitas Premium</h3>
                    <p class="text-sm text-text-secondary leading-relaxed">Bahan terbaik dengan standar produksi ketat untuk hasil maksimal.</p>
                </div>
                <div class="p-8 bg-surface-warm rounded-2xl border border-border-sand" x-intersect="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'" style="opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out 0.15s">
                    <div class="w-12 h-12 rounded-xl bg-champagne/20 flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-champagne" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Desain Presisi</h3>
                    <p class="text-sm text-text-secondary leading-relaxed">Setiap produk dirancang khusus agar sesuai dengan interior kendaraan Anda.</p>
                </div>
                <div class="p-8 bg-surface-warm rounded-2xl border border-border-sand" x-intersect="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'" style="opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out 0.3s">
                    <div class="w-12 h-12 rounded-xl bg-champagne/20 flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-champagne" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Kenyamanan Maksimal</h3>
                    <p class="text-sm text-text-secondary leading-relaxed">Prioritas utama dalam setiap produk yang kami hasilkan untuk Anda.</p>
                </div>
            </div>
        @endif
    </div>
</section>
