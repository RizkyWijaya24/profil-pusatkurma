<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $products     = Product::active()->get();
        $testimonials = Testimonial::active()->get();
        $settings     = Setting::pluck('value', 'key');

        return view('welcome', compact('products', 'testimonials', 'settings'));
    }
}
