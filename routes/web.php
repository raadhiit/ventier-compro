<?php

use App\Livewire\AboutPage;
use App\Livewire\ContactPage;
use App\Livewire\Home;
use App\Livewire\ProductCatalog;
use App\Livewire\ProductDetail;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/products', ProductCatalog::class)->name('products.index');
Route::get('/products/{product:slug}', ProductDetail::class)->name('products.show');
Route::get('/about', AboutPage::class)->name('about');
Route::get('/contact', ContactPage::class)->name('contact');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
