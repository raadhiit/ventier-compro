<?php

use App\Livewire\AboutPage;
use App\Livewire\ContactPage;
use App\Livewire\Home;
use App\Livewire\ProductCatalog;
use App\Livewire\ProductDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/products', ProductCatalog::class)->name('products.index');
Route::get('/products/{product:slug}', ProductDetail::class)->name('products.show');
Route::get('/about', AboutPage::class)->name('about');
Route::get('/contact', ContactPage::class)->name('contact');
Route::get('/sitemap.xml', function () {
    $urls = collect([
        ['location' => route('home'), 'lastModified' => null],
        ['location' => route('products.index'), 'lastModified' => null],
        ['location' => route('about'), 'lastModified' => null],
        ['location' => route('contact'), 'lastModified' => null],
    ])->concat(
        Product::query()
            ->published()
            ->select(['slug', 'updated_at'])
            ->get()
            ->map(fn (Product $product): array => [
                'location' => route('products.show', $product),
                'lastModified' => $product->updated_at?->toAtomString(),
            ]),
    );

    return response()
        ->view('sitemap', compact('urls'))
        ->header('Content-Type', 'application/xml');
})->name('sitemap');
Route::get('/robots.txt', fn () => response(
    "User-agent: *\nAllow: /\nSitemap: ".route('sitemap')."\n",
    headers: ['Content-Type' => 'text/plain'],
))->name('robots');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
