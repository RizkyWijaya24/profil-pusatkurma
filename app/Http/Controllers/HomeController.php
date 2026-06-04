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
            $produk_kasir = DB::connection('mysql_kasir')
                ->table('products')
                ->where('stock', '>', 0)
                ->get();
        }

        return view('welcome', compact('products', 'testimonials', 'settings', 'produk_kasir'));
    }
}
