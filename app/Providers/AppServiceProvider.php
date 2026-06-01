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

        // Dynamically fix malformed APP_URL (e.g. missing // in https:domain.com)
        $appUrl = config('app.url');
        if (!empty($appUrl)) {
            if (preg_match('/^(https?):(?!\/\/)/i', $appUrl)) {
                $fixedUrl = preg_replace('/^(https?):/i', '$1://', $appUrl);
                config(['app.url' => $fixedUrl]);
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Dynamically fix malformed APP_URL at URL generator level (forces asset() helper to use double slashes)
        $appUrl = config('app.url');
        if (!empty($appUrl)) {
            if (preg_match('/^(https?):(?!\/\/)/i', $appUrl)) {
                $fixedUrl = preg_replace('/^(https?):/i', '$1://', $appUrl);
                \Illuminate\Support\Facades\URL::forceRootUrl($fixedUrl);
            }
        }
    }
}
