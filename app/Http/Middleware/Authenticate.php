<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Cek apakah request dari admin area
            // Gunakan str_starts_with() karena lebih reliable
            if (str_starts_with($request->path(), 'admin')) {
                return route('admin.login');
            }

            // Default untuk web
            return route('home');
        }

        return null;
    }
}