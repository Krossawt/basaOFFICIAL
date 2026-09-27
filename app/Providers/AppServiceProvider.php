<?php

namespace App\Providers;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // After logging out of the Filament panel, redirect to the custom BASA login page.
        $this->app->bind(LogoutResponseContract::class, function () {
            return new class implements LogoutResponseContract {
                public function toResponse($request): RedirectResponse
                {
                    return redirect('/login');
                }
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
