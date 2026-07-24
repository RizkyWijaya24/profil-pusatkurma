<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

// ─── PUBLIC ROUTES ───────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ─── DYNAMIC SITEMAP.XML ──────────────────────────────────────────────
Route::get('/sitemap.xml', function () {
    $baseUrl = url('/');
    $now = date('Y-m-d\TH:i:sP');

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";

    // Homepage
    $xml .= "  <url>\n";
    $xml .= "    <loc>{$baseUrl}</loc>\n";
    $xml .= "    <lastmod>{$now}</lastmod>\n";
    $xml .= "    <changefreq>daily</changefreq>\n";
    $xml .= "    <priority>1.0</priority>\n";
    $xml .= "  </url>\n";

    // Anchor sections
    foreach (['tentang', 'produk', 'faq', 'kontak'] as $section) {
        $xml .= "  <url>\n";
        $xml .= "    <loc>{$baseUrl}/#{$section}</loc>\n";
        $xml .= "    <lastmod>{$now}</lastmod>\n";
        $xml .= "    <changefreq>weekly</changefreq>\n";
        $xml .= "    <priority>0.8</priority>\n";
        $xml .= "  </url>\n";
    }

    $xml .= '</urlset>';

    return response($xml, 200, ['Content-Type' => 'application/xml']);
});

// ─── DYNAMIC ROBOTS.TXT ──────────────────────────────────────────────
Route::get('/robots.txt', function () {
    $sitemapUrl = url('/sitemap.xml');
    $content = "User-agent: *\n";
    $content .= "Allow: /\n";
    $content .= "Disallow: /admin/\n\n";
    $content .= "User-agent: Googlebot\n";
    $content .= "Allow: /\n\n";
    $content .= "User-agent: Google-Extended\n";
    $content .= "Allow: /\n\n";
    $content .= "User-agent: GPTBot\n";
    $content .= "Allow: /\n\n";
    $content .= "Sitemap: {$sitemapUrl}\n";

    return response($content, 200, ['Content-Type' => 'text/plain']);
});

Route::get('/clear-cache', function() {
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    return "All Laravel cache cleared successfully!";
});

// Route untuk membersihkan URL localhost/127.0.0.1 dari database
Route::get('/fix-image-urls', function() {
    $report = ['settings_fixed' => [], 'products_fixed' => [], 'errors' => []];

    // Bersihkan settings dengan URL localhost
    $imageKeys = ['store_logo', 'hero_bg_image', 'about_image'];
    foreach ($imageKeys as $key) {
        $setting = \App\Models\Setting::where('key', $key)->first();
        if (!$setting) continue;

        $val = $setting->getRawOriginal('value') ?? '';
        if (empty($val)) continue;

        // Ekstrak path relatif dari URL localhost/127.0.0.1
        if (preg_match('/uploads\/(settings|products)\/.+$/i', $val, $matches)) {
            $relativePath = $matches[0];
            if ($val !== $relativePath) {
                $report['settings_fixed'][] = [
                    'key' => $key,
                    'old' => $val,
                    'new' => $relativePath,
                ];
                \App\Models\Setting::set($key, $relativePath);
            } else {
                $report['settings_fixed'][] = ['key' => $key, 'status' => 'already_clean', 'value' => $val];
            }
        }
    }

    // Bersihkan products dengan URL localhost
    $products = \App\Models\Product::all();
    foreach ($products as $product) {
        $val = $product->getRawOriginal('image_url') ?? '';
        if (empty($val)) continue;

        if (preg_match('/uploads\/(products|settings)\/.+$/i', $val, $matches)) {
            $relativePath = $matches[0];
            if ($val !== $relativePath) {
                $report['products_fixed'][] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'old' => $val,
                    'new' => $relativePath,
                ];
                $product->update(['image_url' => $relativePath]);
            } else {
                $report['products_fixed'][] = ['id' => $product->id, 'name' => $product->name, 'status' => 'already_clean', 'value' => $val];
            }
        }
    }

    // Clear view cache
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');

    return response()->json($report, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
});

Route::get('/check-files', function() {
    $logoPath = \App\Models\Setting::where('key', 'store_logo')->value('value');
    $heroBgPath = \App\Models\Setting::where('key', 'hero_bg_image')->value('value');
    $paths = [
        'public_path' => public_path(),
        'base_path' => base_path(),
        'uploads_settings_dir_exists' => is_dir(public_path('uploads/settings')),
        'logo_raw_db_value' => $logoPath,
        'logo_asset_url' => $logoPath ? asset($logoPath) : null,
        'logo_file_exists' => $logoPath ? file_exists(public_path($logoPath)) : false,
        'hero_bg_raw_db_value' => $heroBgPath,
        'hero_bg_asset_url' => $heroBgPath ? asset($heroBgPath) : null,
        'products_dir_exists' => is_dir(public_path('uploads/products')),
        'products_files' => is_dir(public_path('uploads/products')) ? scandir(public_path('uploads/products')) : [],
        'app_url_config' => config('app.url'),
    ];
    return response()->json($paths);
});

// ─── ADMIN AUTH ──────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ─── PROTECTED ADMIN ROUTES ──────────────────────────────────
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('products', ProductController::class)->except(['show']);
        Route::resource('testimonials', TestimonialController::class)->except(['show']);
        Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);

        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
