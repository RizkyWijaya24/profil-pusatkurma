<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('sort_order')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'origin'      => 'required|string|max:100',
            'description' => 'required|string',
            'price'       => 'required|string|max:50',
            'old_price'   => 'nullable|string|max:50',
            'badge_label' => 'nullable|string|max:50',
            'badge_class' => 'required|string',
            'image_url'   => 'required|url',
            'wa_text'     => 'required|string',
            'btn_class'   => 'required|string',
            'unit'        => 'required|string|max:50',
            'sort_order'  => 'integer|min:0',
            'is_active'   => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $validated['is_active']   = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'origin'      => 'required|string|max:100',
            'description' => 'required|string',
            'price'       => 'required|string|max:50',
            'old_price'   => 'nullable|string|max:50',
            'badge_label' => 'nullable|string|max:50',
            'badge_class' => 'required|string',
            'image_url'   => 'required|url',
            'wa_text'     => 'required|string',
            'btn_class'   => 'required|string',
            'unit'        => 'required|string|max:50',
            'sort_order'  => 'integer|min:0',
        ]);

        $validated['is_active']   = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus!');
    }
}
