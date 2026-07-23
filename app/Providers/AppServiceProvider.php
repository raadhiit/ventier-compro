<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        $this->configurePublicViews();
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(
            fn (): ?Password => app()->isProduction()
                ? Password::min(12)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
                : null,
        );
    }

    private function configurePublicViews(): void
    {
        ViewFacade::composer(
            [
                'layouts.public',
                'livewire.pages.contact',
                'livewire.contact-form',
                'livewire.product-detail',
                'livewire.product-gallery',
                'errors.404',
            ],
            function (View $view): void {
                $view->with(
                    'siteSettings',
                    SiteSetting::publicValues(),
                );
            },
        );
    }
}
