<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Dynamically detect cPanel public_html/profil-web subfolder structure
        $parentDir = dirname($this->app->basePath());
        if (basename($parentDir) === 'public_html' || (str_contains($parentDir, 'public_html') && file_exists($parentDir . '/index.php'))) {
            $this->app->usePublicPath($parentDir);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
