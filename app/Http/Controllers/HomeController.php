<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $products     = Product::active()->get();
        $testimonials = Testimonial::active()->get();
        $settings     = Setting::all()->pluck('value', 'key');

        // Fetch products from Kasir (POS) database/API with 15-min Caching (900 seconds)
        $produk_kasir = collect();
        if (isset($settings['show_catalog']) && $settings['show_catalog'] == '1') {
            $produk_kasir = Cache::remember('katalog_produk_pos_cache', 900, function () use ($settings) {
                try {
                    // 1. Check if HTTP API URL is defined in env/settings
                    $apiUrl = env('POS_API_URL');
                    if (!empty($apiUrl)) {
                        $response = Http::timeout(3)->get($apiUrl);
                        if ($response->successful()) {
                            $data = $response->json()['data'] ?? $response->json();
                            return collect(json_decode(json_encode($data)));
                        }
                    }

                    // 2. Direct MySQL POS Database Query (fallback)
                    $query = DB::connection('mysql_kasir')
                        ->table('products')
                        ->where('stock', '>', 0);

                    if (isset($settings['pos_only_with_image']) && $settings['pos_only_with_image'] == '1') {
                        $query->whereNotNull('image_path')
                              ->where('image_path', '!=', '');
                    }

                    $filterMode = $settings['pos_filter_mode'] ?? 'all';

                    if ($filterMode === 'selected') {
                        $selectedIds = json_decode($settings['pos_selected_products'] ?? '[]', true);
                        if (is_array($selectedIds) && !empty($selectedIds)) {
                            $query->whereIn('id', array_map('intval', $selectedIds));
                        }
                    } elseif ($filterMode === 'categories') {
                        $selectedCategories = json_decode($settings['pos_selected_categories'] ?? '[]', true);
                        if (is_array($selectedCategories) && !empty($selectedCategories)) {
                            $query->whereIn('category', $selectedCategories);
                        }
                    }

                    return $query->get();
                } catch (\Throwable $e) {
                    Log::error('Gagal mengambil API / database produk POS: ' . $e->getMessage());
                    return collect();
                }
            });
        }

        return view('welcome', compact('products', 'testimonials', 'settings', 'produk_kasir'));
    }
}
