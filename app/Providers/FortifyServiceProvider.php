<?php

namespace App\Providers;

use App\Actions\Fortify\ResetUserPassword;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
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
        $this->configureAuthentication();
        $this->configureActions();
        $this->configureViews();
        $this->configureRateLimiting();
    }

    /**
     * Configure user authentication.
     */
    private function configureAuthentication(): void
    {
        Fortify::authenticateUsing(
            function (Request $request): ?User {
                $email = trim(
                    (string) $request->input(Fortify::username())
                );

                $password = (string) $request->input('password');

                $user = User::query()
                    ->where('email', $email)
                    ->where('is_active', true)
                    ->first();

                if (
                    $user === null
                    || ! Hash::check($password, $user->password)
                ) {
                    return null;
                }

                return $user;
            }
        );
    }

    /**
     * Configure Fortify actions.
     */
    private function configureActions(): void
    {
        Fortify::resetUserPasswordsUsing(
            ResetUserPassword::class
        );
    }

    /**
     * Configure Fortify views.
     */
    private function configureViews(): void
    {
        Fortify::loginView(
            fn () => view('livewire.auth.login')
        );

        Fortify::resetPasswordView(
            fn () => view('livewire.auth.reset-password')
        );

        Fortify::requestPasswordResetLinkView(
            fn () => view('livewire.auth.forgot-password')
        );
    }

    /**
     * Configure rate limiting.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for(
            'login',
            function (Request $request): Limit {
                $username = Str::lower(
                    trim(
                        (string) $request->input(
                            Fortify::username()
                        )
                    )
                );

                $throttleKey = Str::transliterate(
                    $username.'|'.$request->ip()
                );

                return Limit::perMinute(5)
                    ->by($throttleKey);
            }
        );
    }
}
