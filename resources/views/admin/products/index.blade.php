@extends('admin.layouts.app')
@section('title', 'Produk')
@section('page-title', '🌴 Manajemen Produk')
@section('page-desc', 'Kelola daftar produk kurma yang tampil di website')

@section('header-actions')
  <a href="{{ route('admin.products.create') }}"
     class="inline-flex items-center gap-2 bg-emerald-900 hover:bg-emerald-800 text-white font-bold text-sm px-4 py-2 rounded-xl transition-colors">
    ➕ Tambah Produk
  </a>
@endsection

@section('content')
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-gray-50 border-b border-gray-100">
        <tr>
          <th class="text-left px-5 py-3.5 text-gray-500 font-semibold text-xs uppercase tracking-wider">Produk</th>
          <th class="text-left px-5 py-3.5 text-gray-500 font-semibold text-xs uppercase tracking-wider hidden md:table-cell">Asal</th>
          <th class="text-left px-5 py-3.5 text-gray-500 font-semibold text-xs uppercase tracking-wider">Harga</th>
          <th class="text-center px-5 py-3.5 text-gray-500 font-semibold text-xs uppercase tracking-wider">Status</th>
          <th class="text-center px-5 py-3.5 text-gray-500 font-semibold text-xs uppercase tracking-wider">Urutan</th>
          <th class="text-right px-5 py-3.5 text-gray-500 font-semibold text-xs uppercase tracking-wider">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-50">
        @forelse($products as $product)
          <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-5 py-4">
              <div class="flex items-center gap-3">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                     class="w-12 h-12 rounded-xl object-cover flex-shrink-0 border border-gray-100"/>
                <div>
                  <div class="font-bold text-gray-900">{{ $product->name }}</div>
                  <span class="{{ $product->badge_class }} text-xs font-semibold px-2 py-0.5 rounded-full">{{ $product->badge_label }}</span>
                </div>
              </div>
            </td>
            <td class="px-5 py-4 text-gray-500 hidden md:table-cell">{{ $product->origin }}</td>
            <td class="px-5 py-4">
              <div class="font-bold text-yellow-600">{{ $product->price }}</div>
              @if($product->old_price)
                <div class="text-gray-400 line-through text-xs">{{ $product->old_price }}</div>
              @endif
            </td>
            <td class="px-5 py-4 text-center">
              @if($product->is_active)
                <span class="bg-emerald-100 text-emerald-700 font-semibold text-xs px-2.5 py-1 rounded-full">Aktif</span>
              @else
                <span class="bg-gray-100 text-gray-500 font-semibold text-xs px-2.5 py-1 rounded-full">Nonaktif</span>
              @endif
            </td>
            <td class="px-5 py-4 text-center text-gray-500 font-medium">{{ $product->sort_order }}</td>
            <td class="px-5 py-4 text-right">
              <div class="flex items-center justify-end gap-2">
                <a href="{{ route('admin.products.edit', $product) }}"
                   class="bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold text-xs px-3 py-1.5 rounded-lg transition-colors">Edit</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                      onsubmit="return confirm('Hapus produk ini?')">
                  @csrf @method('DELETE')
                  <button type="submit"
                    class="bg-red-50 hover:bg-red-100 text-red-600 font-semibold text-xs px-3 py-1.5 rounded-lg transition-colors">
                    Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="px-5 py-12 text-center text-gray-400">
              <div class="text-4xl mb-2">🌴</div>
              <div class="font-semibold">Belum ada produk</div>
              <a href="{{ route('admin.products.create') }}" class="text-emerald-700 text-sm hover:underline mt-1 inline-block">Tambah produk pertama</a>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
