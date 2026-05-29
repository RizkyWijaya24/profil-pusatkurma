<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products'     => Product::count(),
            'active_products'    => Product::where('is_active', true)->count(),
            'total_testimonials' => Testimonial::count(),
            'total_contacts'     => Contact::count(),
            'unread_contacts'    => Contact::unread()->count(),
        ];

        $recent_contacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_contacts'));
    }
}
