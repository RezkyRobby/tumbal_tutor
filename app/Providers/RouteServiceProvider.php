<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route; // Tambahkan ini
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\RoleMiddleware; // Pastikan RoleMiddleware juga diimpor


class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Definisikan route untuk web
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        // Definisikan route untuk API
        // Route::middleware('api')
        //     ->prefix('api')
        //     ->group(base_path('routes/api.php'));

        // Alias Middleware untuk 'role'
        Route::aliasMiddleware('role', \App\Http\Middleware\RoleMiddleware::class);
    }
}
