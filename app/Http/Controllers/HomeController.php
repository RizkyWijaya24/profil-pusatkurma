<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $products     = Product::active()->get();
        $testimonials = Testimonial::active()->get();
        $settings     = Setting::all()->pluck('value', 'key');

        // Fetch products from Kasir (POS) database only if enabled in settings
        $produk_kasir = collect();
        if (isset($settings['show_catalog']) && $settings['show_catalog'] == '1') {
            try {
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

                $produk_kasir = $query->get();
            } catch (\Throwable $e) {
                $produk_kasir = collect();
            }
        }

        return view('welcome', compact('products', 'testimonials', 'settings', 'produk_kasir'));
    }
}
