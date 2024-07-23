<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Periksa apakah aplikasi berjalan di lingkungan lokal
        if (config('app.env') == 'local') {
            // Jika aplikasi berada di lingkungan lokal, paksa penggunaan skema HTTPS
            URL::forceScheme('https');
        }
    }
}
