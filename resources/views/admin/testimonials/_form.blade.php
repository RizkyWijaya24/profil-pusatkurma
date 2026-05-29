{{-- Reusable testimonial form partial --}}
@php $isEdit = isset($testimonial); @endphp

<div class="grid lg:grid-cols-2 gap-6">
  <div class="space-y-5">
    <div>
      <label class="block text-gray-700 font-semibold text-sm mb-1.5">Nama Pelanggan <span class="text-red-500">*</span></label>
      <input type="text" name="name" value="{{ old('name', $testimonial->name ?? '') }}" required
             class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all"
             placeholder="Siti Nurhaliza"/>
    </div>
    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="block text-gray-700 font-semibold text-sm mb-1.5">Inisial (2–3 huruf) <span class="text-red-500">*</span></label>
        <input type="text" name="initials" maxlength="5" value="{{ old('initials', $testimonial->initials ?? '') }}" required
               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all"
               placeholder="SN"/>
      </div>
      <div>
        <label class="block text-gray-700 font-semibold text-sm mb-1.5">Urutan</label>
        <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}"
               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all"/>
      </div>
    </div>
    <div>
      <label class="block text-gray-700 font-semibold text-sm mb-1.5">Lokasi / Asal Kota <span class="text-red-500">*</span></label>
      <input type="text" name="location" value="{{ old('location', $testimonial->location ?? '') }}" required
             class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all"
             placeholder="Cianjur Kota"/>
    </div>
    <div>
      <label class="block text-gray-700 font-semibold text-sm mb-1.5">Warna Avatar</label>
      <select name="avatar_color"
              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all">
        @php
          $colors = [
            'bg-emerald-700' => 'Hijau Emerald',
            'bg-yellow-600'  => 'Kuning/Gold',
            'bg-purple-700'  => 'Ungu',
            'bg-blue-600'    => 'Biru',
            'bg-red-600'     => 'Merah',
            'bg-orange-600'  => 'Oranye',
            'bg-pink-600'    => 'Pink',
          ];
        @endphp
        @foreach($colors as $val => $label)
          <option value="{{ $val }}" {{ old('avatar_color', $testimonial->avatar_color ?? 'bg-emerald-700') === $val ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
      </select>
    </div>
    <div class="flex items-center gap-2 pt-1">
      <input type="hidden" name="is_active" value="0"/>
      <input type="checkbox" name="is_active" value="1" id="is_active"
             {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}
             class="w-4 h-4 text-emerald-600 rounded"/>
      <label for="is_active" class="text-gray-700 font-semibold text-sm cursor-pointer">Tampilkan di website</label>
    </div>
  </div>

  <div class="space-y-5">
    <div>
      <label class="block text-gray-700 font-semibold text-sm mb-1.5">Teks Ulasan <span class="text-red-500">*</span></label>
      <textarea name="review" rows="7" required
                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all resize-none"
                placeholder='"Kurma-nya enak banget, manis alami dan ukurannya besar-besar..."'>{{ old('review', $testimonial->review ?? '') }}</textarea>
      <p class="text-gray-400 text-xs mt-1">Sertakan tanda kutip ("...") agar tampak lebih natural.</p>
    </div>

    {{-- Live preview --}}
    <div class="bg-emerald-950 rounded-2xl p-4 border border-emerald-800">
      <p class="text-white/60 text-xs font-semibold uppercase tracking-wider mb-3">Preview</p>
      <div class="flex items-center gap-1 mb-2">
        <span class="text-yellow-400 text-xs">★★★★★</span>
      </div>
      <p class="text-white/80 text-xs italic leading-relaxed mb-3">Preview ulasan akan muncul di sini...</p>
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 bg-emerald-700 rounded-full flex items-center justify-center">
          <span class="text-white font-bold text-xs">SN</span>
        </div>
        <div>
          <div class="text-white font-bold text-xs">Nama Pelanggan</div>
          <div class="text-white/50 text-xs">Lokasi</div>
        </div>
      </div>
    </div>
  </div>
</div>
