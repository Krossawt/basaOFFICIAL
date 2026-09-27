<?php

namespace App\Http\Middleware;

use Filament\Http\Middleware\Authenticate as FilamentAuthenticate;

/**
 * Overrides Filament's Authenticate middleware to redirect
 * unauthenticated users to the BASA custom login page (/login)
 * instead of Filament's own /admin/login page.
 */
class FilamentRedirectToLogin extends FilamentAuthenticate
{
    protected function redirectTo($request): ?string
    {
        return '/login';
    }
}
