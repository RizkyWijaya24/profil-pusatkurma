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
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'image_url'   => 'nullable|url',
            'wa_text'     => 'required|string',
            'btn_class'   => 'required|string',
            'unit'        => 'required|string|max:50',
            'sort_order'  => 'integer|min:0',
            'is_active'   => 'boolean',
            'is_featured' => 'boolean',
        ]);

        if (!$request->hasFile('image') && empty($validated['image_url'])) {
            return back()->withErrors(['image_url' => 'Mohon unggah file gambar atau masukkan URL gambar.'])->withInput();
        }

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'product_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $validated['image_url'] = asset('uploads/products/' . $filename);
        }

        unset($validated['image']);

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
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'image_url'   => 'nullable|url',
            'wa_text'     => 'required|string',
            'btn_class'   => 'required|string',
            'unit'        => 'required|string|max:50',
            'sort_order'  => 'integer|min:0',
        ]);

        // Handle Image Upload / URL change
        if ($request->hasFile('image')) {
            // Delete old local file if it exists
            $this->deleteOldLocalImage($product->image_url);

            $file = $request->file('image');
            $filename = 'product_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $validated['image_url'] = asset('uploads/products/' . $filename);
        } elseif (!empty($validated['image_url'])) {
            // If they provided a new URL different from old one, delete old local file
            if ($validated['image_url'] !== $product->image_url) {
                $this->deleteOldLocalImage($product->image_url);
            }
        } else {
            // If both are empty, retain old image_url
            $validated['image_url'] = $product->image_url;
        }

        unset($validated['image']);

        $validated['is_active']   = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        // Delete local image file if it exists
        $this->deleteOldLocalImage($product->image_url);

        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * Delete old local image if it exists in uploads/products
     */
    private function deleteOldLocalImage($imageUrl)
    {
        if ($imageUrl) {
            $relativePath = strstr($imageUrl, 'uploads/products/');
            if ($relativePath) {
                $fullPath = public_path($relativePath);
                if (file_exists($fullPath)) {
                    @unlink($fullPath);
                }
            }
        }
    }
}
