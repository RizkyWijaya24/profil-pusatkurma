{{-- Reusable product form partial --}}
@php $isEdit = isset($product); @endphp

<div class="grid lg:grid-cols-2 gap-6">
  {{-- LEFT --}}
  <div class="space-y-5">
    <div>
      <label class="block text-gray-700 font-semibold text-sm mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
      <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required
             class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all"
             placeholder="Kurma Sukari Premium"/>
    </div>

    <div>
      <label class="block text-gray-700 font-semibold text-sm mb-1.5">Negara Asal <span class="text-red-500">*</span></label>
      <input type="text" name="origin" value="{{ old('origin', $product->origin ?? 'Arab Saudi') }}" required
             class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all"
             placeholder="Arab Saudi"/>
    </div>

    <div>
      <label class="block text-gray-700 font-semibold text-sm mb-1.5">Deskripsi <span class="text-red-500">*</span></label>
      <textarea name="description" rows="4" required
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all resize-none"
                placeholder="Deskripsi rasa, tekstur, dan keunggulan produk...">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="block text-gray-700 font-semibold text-sm mb-1.5">Harga <span class="text-red-500">*</span></label>
        <input type="text" name="price" value="{{ old('price', $product->price ?? '') }}" required
               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all"
               placeholder="Rp 85.000"/>
      </div>
      <div>
        <label class="block text-gray-700 font-semibold text-sm mb-1.5">Harga Coret</label>
        <input type="text" name="old_price" value="{{ old('old_price', $product->old_price ?? '') }}"
               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all"
               placeholder="Rp 105.000"/>
      </div>
    </div>

    <div>
      <label class="block text-gray-700 font-semibold text-sm mb-1.5">Satuan <span class="text-red-500">*</span></label>
      <input type="text" name="unit" value="{{ old('unit', $product->unit ?? 'per 500 gram') }}" required
             class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all"
             placeholder="per 500 gram"/>
    </div>
  </div>

  {{-- RIGHT --}}
  <div class="space-y-5">
    <div>
      <label class="block text-gray-700 font-semibold text-sm mb-1.5">URL Gambar <span class="text-red-500">*</span></label>
      <input type="url" name="image_url" id="image_url_input"
             value="{{ old('image_url', $product->image_url ?? '') }}" required
             oninput="previewImg(this.value)"
             class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all"
             placeholder="https://images.unsplash.com/..."/>
      <div class="mt-2 rounded-xl overflow-hidden border border-gray-100 aspect-video bg-gray-50 flex items-center justify-center">
        <img id="img_preview" src="{{ $product->image_url ?? '' }}" alt="Preview"
             class="w-full h-full object-cover {{ ($product->image_url ?? '') ? '' : 'hidden' }}"/>
        <span id="img_placeholder" class="{{ ($product->image_url ?? '') ? 'hidden' : '' }} text-gray-300 text-sm">Preview gambar</span>
      </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="block text-gray-700 font-semibold text-sm mb-1.5">Label Badge</label>
        <input type="text" name="badge_label" value="{{ old('badge_label', $product->badge_label ?? '') }}"
               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all"
               placeholder="⭐ Best Seller"/>
      </div>
      <div>
        <label class="block text-gray-700 font-semibold text-sm mb-1.5">Class Badge</label>
        <select name="badge_class"
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all">
          @php
            $badgeClasses = [
              'bg-yellow-500 text-emerald-950' => 'Kuning (Gold)',
              'bg-emerald-600 text-white'      => 'Hijau',
              'bg-purple-600 text-white'       => 'Ungu',
              'bg-blue-600 text-white'         => 'Biru',
              'bg-orange-500 text-white'       => 'Oranye',
              'bg-red-500 text-white'          => 'Merah',
            ];
          @endphp
          @foreach($badgeClasses as $val => $label)
            <option value="{{ $val }}" {{ old('badge_class', $product->badge_class ?? '') === $val ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div>
      <label class="block text-gray-700 font-semibold text-sm mb-1.5">Tombol Style</label>
      <select name="btn_class"
              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all">
        <option value="bg-emerald-900 hover:bg-emerald-800 text-white" {{ old('btn_class', $product->btn_class ?? '') === 'bg-emerald-900 hover:bg-emerald-800 text-white' ? 'selected' : '' }}>Hijau Gelap (default)</option>
        <option value="bg-yellow-500 hover:bg-yellow-400 text-emerald-950" {{ old('btn_class', $product->btn_class ?? '') === 'bg-yellow-500 hover:bg-yellow-400 text-emerald-950' ? 'selected' : '' }}>Kuning/Gold (Hampers)</option>
      </select>
    </div>

    <div>
      <label class="block text-gray-700 font-semibold text-sm mb-1.5">Teks Pesan WA (URL-encoded) <span class="text-red-500">*</span></label>
      <textarea name="wa_text" rows="3" required
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all resize-none font-mono text-xs"
                placeholder="Halo%20Admin...">{{ old('wa_text', $product->wa_text ?? '') }}</textarea>
      <p class="text-gray-400 text-xs mt-1">Gunakan URL encoding (spasi = %20, dsb.)</p>
    </div>

    <div class="grid grid-cols-3 gap-4">
      <div>
        <label class="block text-gray-700 font-semibold text-sm mb-1.5">Urutan</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $product->sort_order ?? 0) }}" min="0"
               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all"/>
      </div>
      <div class="flex flex-col justify-end pb-1">
        <label class="flex items-center gap-2 cursor-pointer">
          <input type="hidden" name="is_active" value="0"/>
          <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}
                 class="w-4 h-4 text-emerald-600 rounded"/>
          <span class="text-gray-700 font-semibold text-sm">Aktif</span>
        </label>
      </div>
      <div class="flex flex-col justify-end pb-1">
        <label class="flex items-center gap-2 cursor-pointer">
          <input type="hidden" name="is_featured" value="0"/>
          <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured ?? true) ? 'checked' : '' }}
                 class="w-4 h-4 text-emerald-600 rounded"/>
          <span class="text-gray-700 font-semibold text-sm">Unggulan</span>
        </label>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  function previewImg(url) {
    const img = document.getElementById('img_preview');
    const placeholder = document.getElementById('img_placeholder');
    if (url) {
      img.src = url;
      img.classList.remove('hidden');
      placeholder.classList.add('hidden');
    } else {
      img.classList.add('hidden');
      placeholder.classList.remove('hidden');
    }
  }
</script>
@endpush
