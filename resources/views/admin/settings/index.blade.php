@extends('admin.layouts.app')
@section('title', 'Pengaturan')
@section('page-title', '⚙️ Pengaturan Toko')
@section('page-desc', 'Kelola semua informasi, konten banner, statistik, detail halaman tentang kami, dan kontak secara dinamis.')

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="max-w-5xl space-y-6">
  @csrf

  @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-xl p-4 text-sm font-semibold flex items-center gap-3">
      <span>✓</span>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  @if($errors->any())
    <div class="bg-red-50 border border-red-100 text-red-700 rounded-xl p-4 text-sm font-semibold space-y-1">
      <div class="font-extrabold">⚠️ Mohon koreksi kesalahan berikut:</div>
      <ul class="list-disc pl-5">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Responsive Premium Tabs Header --}}
  <div class="bg-white border border-gray-100 rounded-2xl p-2 shadow-sm">
    <div class="flex flex-wrap gap-1 md:gap-2 overflow-x-auto whitespace-nowrap scrollbar-none">
      <button type="button" onclick="switchTab(event, 'tab-utama')" class="tab-btn px-5 py-3 text-sm font-extrabold border-b-2 border-emerald-700 text-emerald-700 transition-all duration-200 flex items-center gap-2">
        <span>🏪</span> Informasi Utama
      </button>
      <button type="button" onclick="switchTab(event, 'tab-hero')" class="tab-btn px-5 py-3 text-sm font-extrabold border-b-2 border-transparent text-gray-500 hover:text-emerald-700 hover:border-emerald-200 transition-all duration-200 flex items-center gap-2">
        <span>✨</span> Banner Hero
      </button>
      <button type="button" onclick="switchTab(event, 'tab-stats')" class="tab-btn px-5 py-3 text-sm font-extrabold border-b-2 border-transparent text-gray-500 hover:text-emerald-700 hover:border-emerald-200 transition-all duration-200 flex items-center gap-2">
        <span>📊</span> Statistik
      </button>
      <button type="button" onclick="switchTab(event, 'tab-about')" class="tab-btn px-5 py-3 text-sm font-extrabold border-b-2 border-transparent text-gray-500 hover:text-emerald-700 hover:border-emerald-200 transition-all duration-200 flex items-center gap-2">
        <span>🌿</span> Tentang Kami
      </button>
      <button type="button" onclick="switchTab(event, 'tab-cta')" class="tab-btn px-5 py-3 text-sm font-extrabold border-b-2 border-transparent text-gray-500 hover:text-emerald-700 hover:border-emerald-200 transition-all duration-200 flex items-center gap-2">
        <span>📣</span> Banner CTA
      </button>
    </div>
  </div>

  {{-- Tab Panes --}}
  <div class="space-y-6">

    {{-- TAB 1: INFORMASI UTAMA --}}
    <div id="tab-utama" class="tab-pane space-y-6">
      <div class="grid md:grid-cols-2 gap-6">
        
        {{-- Card: Profil Toko --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-5">
          <h3 class="font-extrabold text-emerald-950 text-base border-b border-gray-50 pb-3 flex items-center gap-2">
            <span>🏪</span> Profil & Hubungi Kami
          </h3>

          <div>
            <label class="block text-gray-700 font-semibold text-sm mb-1.5">Nama Toko</label>
            <input type="text" name="store_name" value="{{ old('store_name', $settings['store_name'] ?? '') }}" 
                   class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800" required>
          </div>

          {{-- Logo Toko --}}
          <div class="border-t border-gray-50 pt-4 space-y-3">
            <label class="block text-gray-700 font-semibold text-sm mb-1.5">Logo Toko (Opsional)</label>
            <div class="flex items-center gap-4">
              <div id="store-logo-preview" class="w-14 h-14 bg-gradient-to-br from-emerald-900 to-emerald-800 rounded-xl flex items-center justify-center overflow-hidden shadow-inner border border-emerald-700/20 flex-shrink-0">
                @if(!empty($settings['store_logo']))
                  <img src="{{ $settings['store_logo'] }}" class="h-full w-full object-contain p-1">
                @else
                  <span class="text-2xl leading-none">🌴</span>
                @endif
              </div>
              <div class="flex-grow space-y-2">
                <input type="file" name="store_logo" accept="image/*" onchange="previewImage(this, 'store-logo-preview', '🌴')"
                       class="w-full bg-gray-50 hover:bg-gray-100/50 border border-gray-200 focus:border-emerald-500 rounded-xl px-3 py-2 text-xs outline-none font-medium text-gray-800 file:mr-3 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-3xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                @if(!empty($settings['store_logo']))
                  <label class="flex items-center gap-2 text-xs text-red-500 font-semibold cursor-pointer select-none">
                    <input type="checkbox" name="delete_store_logo" value="1" class="rounded text-red-600 focus:ring-red-500/20 border-gray-300">
                    <span>Hapus logo kustom & gunakan default 🌴</span>
                  </label>
                @else
                  <p class="text-3xs text-gray-400">Jika dikosongkan, default emoji 🌴 dan teks akan digunakan.</p>
                @endif
              </div>
            </div>
          </div>

          <div>
            <label class="block text-gray-700 font-semibold text-sm mb-1.5">Nomor WhatsApp</label>
            <input type="text" name="wa_number" value="{{ old('wa_number', $settings['wa_number'] ?? '') }}" 
                   class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800" required>
            <p class="text-xs text-gray-400 mt-1">Gunakan kode negara tanpa tanda "+" (misal: 6281234567890)</p>
          </div>

          <div>
            <label class="block text-gray-700 font-semibold text-sm mb-1.5">Jam Operasional</label>
            <input type="text" name="opening_hours" value="{{ old('opening_hours', $settings['opening_hours'] ?? '') }}" 
                   class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800" required>
          </div>

          <div>
            <label class="block text-gray-700 font-semibold text-sm mb-1.5">Alamat Lengkap</label>
            <textarea name="address" rows="3" class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800" required>{{ old('address', $settings['address'] ?? '') }}</textarea>
          </div>
        </div>

        {{-- Card: Tautan & Media Sosial --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between space-y-5">
          <div class="space-y-5">
            <h3 class="font-extrabold text-emerald-950 text-base border-b border-gray-50 pb-3 flex items-center gap-2">
              <span>🌐</span> Media Sosial & Peta
            </h3>

            <div>
              <label class="block text-gray-700 font-semibold text-sm mb-1.5">Layanan Pengiriman</label>
              <textarea name="shipping_info" rows="2" class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800" required>{{ old('shipping_info', $settings['shipping_info'] ?? '') }}</textarea>
            </div>

            <div>
              <label class="block text-gray-700 font-semibold text-sm mb-1.5">Link Iframe Google Maps (Embed URL)</label>
              <input type="text" name="maps_embed_url" value="{{ old('maps_embed_url', $settings['maps_embed_url'] ?? '') }}" placeholder="https://www.google.com/maps/embed?pb=..."
                     class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800">
              <p class="text-xs text-gray-400 mt-1">Masukkan URL iframe src saja dari share map Google Maps</p>
            </div>

            <div>
              <label class="block text-gray-700 font-semibold text-sm mb-1.5">Link Instagram</label>
              <input type="url" name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}" placeholder="https://instagram.com/..."
                     class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800">
            </div>

            <div>
              <label class="block text-gray-700 font-semibold text-sm mb-1.5">Link Facebook</label>
              <input type="url" name="facebook" value="{{ old('facebook', $settings['facebook'] ?? '') }}" placeholder="https://facebook.com/..."
                     class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800">
            </div>
          </div>
      </div>

      {{-- Card: Cabang Toko Resmi --}}
      <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-5">
        <div class="flex items-center justify-between border-b border-gray-50 pb-3 flex-wrap gap-2">
          <h3 class="font-extrabold text-emerald-950 text-base flex items-center gap-2">
            <span>📍</span> Cabang Toko Resmi
          </h3>
          <button type="button" onclick="addBranchRow()" class="bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-extrabold text-xs px-4 py-2 rounded-xl transition-colors cursor-pointer flex items-center gap-1.5">
            <span>＋</span> Tambah Cabang
          </button>
        </div>

        <p class="text-xs text-gray-500 leading-relaxed">
          Tambahkan cabang-cabang resmi toko Anda. Jika cabang ditambahkan, halaman utama akan menampilkan daftar cabang interaktif beserta peta khusus dan WhatsApp per cabang. Jika dikosongkan, halaman utama akan otomatis menggunakan info default di atas.
        </p>

        {{-- Hidden input for branches JSON --}}
        <input type="hidden" name="branches" id="branches-json-input" value="{{ old('branches', $settings['branches'] ?? '[]') }}">

        {{-- Branch Rows Container --}}
        <div id="branch-rows-container" class="space-y-4">
          {{-- Dynamic branch rows will be rendered here by Javascript --}}
        </div>
      </div>

    </div>
  </div>

    {{-- TAB 2: BANNER HERO --}}
    <div id="tab-hero" class="tab-pane space-y-6 hidden">
      <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-5">
        <h3 class="font-extrabold text-emerald-950 text-base border-b border-gray-50 pb-3 flex items-center gap-2">
          <span>✨</span> Banner Depan Utama (Hero)
        </h3>

        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="block text-gray-700 font-semibold text-sm mb-1.5">Tagline Kecil</label>
            <input type="text" name="hero_tagline" value="{{ old('hero_tagline', $settings['hero_tagline'] ?? '') }}" 
                   class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800">
            <p class="text-xs text-gray-400 mt-1">Muncul di atas judul utama banner</p>
          </div>

          <div>
            <label class="block text-gray-700 font-semibold text-sm mb-1.5">Judul Utama (Headline)</label>
            <input type="text" name="hero_headline" value="{{ old('hero_headline', $settings['hero_headline'] ?? '') }}" 
                   class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800">
            <p class="text-xs text-gray-400 mt-1">Teks tebal utama yang bersinar keemasan</p>
          </div>
        </div>

        <div>
          <label class="block text-gray-700 font-semibold text-sm mb-1.5">Deskripsi Banner (Sub-headline)</label>
          <textarea name="hero_sub" rows="3" class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800">{{ old('hero_sub', $settings['hero_sub'] ?? '') }}</textarea>
        </div>

        <div class="grid md:grid-cols-3 gap-6 items-end">
          <div class="md:col-span-1">
            <label class="block text-gray-700 font-semibold text-sm mb-1.5">Gambar Hero Saat Ini</label>
            <div id="hero-bg-preview" class="h-32 bg-gray-50 rounded-xl border border-gray-100 flex items-center justify-center overflow-hidden">
              @if(!empty($settings['hero_bg_image']))
                <img src="{{ $settings['hero_bg_image'] }}" class="h-full w-full object-cover">
              @else
                <span class="text-xs text-gray-400">Belum ada gambar</span>
              @endif
            </div>
          </div>
          <div class="md:col-span-2">
            <label class="block text-gray-700 font-semibold text-sm mb-1.5">Unggah Gambar Latar Belakang Baru (Hero Background)</label>
            <input type="file" name="hero_bg_image" accept="image/*" onchange="previewImage(this, 'hero-bg-preview', 'Belum ada gambar')"
                   class="w-full bg-gray-50 hover:bg-gray-100/50 border border-gray-200 focus:border-emerald-500 rounded-xl px-4 py-3 text-sm outline-none font-medium text-gray-800 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
            <p class="text-xs text-gray-400 mt-1.5">Format file: JPG, JPEG, PNG, WEBP.</p>
          </div>
        </div>
      </div>
    </div>

    {{-- TAB 3: STATISTIK --}}
    <div id="tab-stats" class="tab-pane space-y-6 hidden">
      <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-5">
        <h3 class="font-extrabold text-emerald-950 text-base border-b border-gray-50 pb-3 flex items-center gap-2">
          <span>📊</span> Statistik Counter Bar Beranda
        </h3>
        <p class="text-xs text-gray-500 leading-relaxed mb-4">Pengaturan untuk 4 kolom statistik yang muncul di bawah banner beranda.</p>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
          {{-- Stat 1 --}}
          <div class="p-4 bg-emerald-50/50 border border-emerald-100/80 rounded-2xl space-y-3">
            <h4 class="font-bold text-sm text-emerald-900 border-b border-emerald-100 pb-1.5">Statistik 1</h4>
            <div>
              <label class="block text-gray-700 font-semibold text-xs mb-1">Nilai (Value)</label>
              <input type="text" name="stat_1_val" value="{{ old('stat_1_val', $settings['stat_1_val'] ?? '') }}" 
                     class="w-full bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-lg px-3 py-2 text-xs transition-all outline-none font-semibold text-gray-800" required>
            </div>
            <div>
              <label class="block text-gray-700 font-semibold text-xs mb-1">Label</label>
              <input type="text" name="stat_1_lbl" value="{{ old('stat_1_lbl', $settings['stat_1_lbl'] ?? '') }}" 
                     class="w-full bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-lg px-3 py-2 text-xs transition-all outline-none font-medium text-gray-800" required>
            </div>
          </div>

          {{-- Stat 2 --}}
          <div class="p-4 bg-emerald-50/50 border border-emerald-100/80 rounded-2xl space-y-3">
            <h4 class="font-bold text-sm text-emerald-900 border-b border-emerald-100 pb-1.5">Statistik 2</h4>
            <div>
              <label class="block text-gray-700 font-semibold text-xs mb-1">Nilai (Value)</label>
              <input type="text" name="stat_2_val" value="{{ old('stat_2_val', $settings['stat_2_val'] ?? '') }}" 
                     class="w-full bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-lg px-3 py-2 text-xs transition-all outline-none font-semibold text-gray-800" required>
            </div>
            <div>
              <label class="block text-gray-700 font-semibold text-xs mb-1">Label</label>
              <input type="text" name="stat_2_lbl" value="{{ old('stat_2_lbl', $settings['stat_2_lbl'] ?? '') }}" 
                     class="w-full bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-lg px-3 py-2 text-xs transition-all outline-none font-medium text-gray-800" required>
            </div>
          </div>

          {{-- Stat 3 --}}
          <div class="p-4 bg-emerald-50/50 border border-emerald-100/80 rounded-2xl space-y-3">
            <h4 class="font-bold text-sm text-emerald-900 border-b border-emerald-100 pb-1.5">Statistik 3</h4>
            <div>
              <label class="block text-gray-700 font-semibold text-xs mb-1">Nilai (Value)</label>
              <input type="text" name="stat_3_val" value="{{ old('stat_3_val', $settings['stat_3_val'] ?? '') }}" 
                     class="w-full bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-lg px-3 py-2 text-xs transition-all outline-none font-semibold text-gray-800" required>
            </div>
            <div>
              <label class="block text-gray-700 font-semibold text-xs mb-1">Label</label>
              <input type="text" name="stat_3_lbl" value="{{ old('stat_3_lbl', $settings['stat_3_lbl'] ?? '') }}" 
                     class="w-full bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-lg px-3 py-2 text-xs transition-all outline-none font-medium text-gray-800" required>
            </div>
          </div>

          {{-- Stat 4 --}}
          <div class="p-4 bg-emerald-50/50 border border-emerald-100/80 rounded-2xl space-y-3">
            <h4 class="font-bold text-sm text-emerald-900 border-b border-emerald-100 pb-1.5">Statistik 4</h4>
            <div>
              <label class="block text-gray-700 font-semibold text-xs mb-1">Nilai (Value)</label>
              <input type="text" name="stat_4_val" value="{{ old('stat_4_val', $settings['stat_4_val'] ?? '') }}" 
                     class="w-full bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-lg px-3 py-2 text-xs transition-all outline-none font-semibold text-gray-800" required>
            </div>
            <div>
              <label class="block text-gray-700 font-semibold text-xs mb-1">Label</label>
              <input type="text" name="stat_4_lbl" value="{{ old('stat_4_lbl', $settings['stat_4_lbl'] ?? '') }}" 
                     class="w-full bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-lg px-3 py-2 text-xs transition-all outline-none font-medium text-gray-800" required>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- TAB 4: TENTANG KAMI --}}
    <div id="tab-about" class="tab-pane space-y-6 hidden">
      
      {{-- Card: Teks Utama Tentang Kami --}}
      <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-5">
        <h3 class="font-extrabold text-emerald-950 text-base border-b border-gray-50 pb-3 flex items-center gap-2">
          <span>🌿</span> Konten Utama Halaman Tentang Kami
        </h3>

        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="block text-gray-700 font-semibold text-sm mb-1.5">Headline Utama Tentang Kami</label>
            <input type="text" name="about_headline" value="{{ old('about_headline', $settings['about_headline'] ?? '') }}" 
                   class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800" required>
          </div>

          <div>
            <label class="block text-gray-700 font-semibold text-sm mb-1.5">Judul Detail Deskripsi</label>
            <input type="text" name="about_title_detail" value="{{ old('about_title_detail', $settings['about_title_detail'] ?? '') }}" 
                   class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800" required>
          </div>
        </div>

        <div>
          <label class="block text-gray-700 font-semibold text-sm mb-1.5">Sub-headline (Teks Deskripsi Pendek Atas)</label>
          <textarea name="about_sub" rows="2" class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800">{{ old('about_sub', $settings['about_sub'] ?? '') }}</textarea>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="block text-gray-700 font-semibold text-sm mb-1.5">Paragraf Detail 1</label>
            <textarea name="about_desc_1" rows="4" class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800" required>{{ old('about_desc_1', $settings['about_desc_1'] ?? '') }}</textarea>
          </div>
          <div>
            <label class="block text-gray-700 font-semibold text-sm mb-1.5">Paragraf Detail 2</label>
            <textarea name="about_desc_2" rows="4" class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800">{{ old('about_desc_2', $settings['about_desc_2'] ?? '') }}</textarea>
          </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6 items-end">
          <div class="md:col-span-1">
            <label class="block text-gray-700 font-semibold text-sm mb-1.5">Gambar Toko Saat Ini</label>
            <div id="about-img-preview" class="h-32 bg-gray-50 rounded-xl border border-gray-100 flex items-center justify-center overflow-hidden">
              @if(!empty($settings['about_image']))
                <img src="{{ $settings['about_image'] }}" class="h-full w-full object-cover">
              @else
                <span class="text-xs text-gray-400">Belum ada gambar</span>
              @endif
            </div>
          </div>
          <div class="md:col-span-2">
            <label class="block text-gray-700 font-semibold text-sm mb-1.5">Unggah Gambar Toko Baru (Tentang Kami Image)</label>
            <input type="file" name="about_image" accept="image/*" onchange="previewImage(this, 'about-img-preview', 'Belum ada gambar')"
                   class="w-full bg-gray-50 hover:bg-gray-100/50 border border-gray-200 focus:border-emerald-500 rounded-xl px-4 py-3 text-sm outline-none font-medium text-gray-800 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
            <p class="text-xs text-gray-400 mt-1.5">Format file: JPG, JPEG, PNG, WEBP.</p>
          </div>
        </div>
      </div>

      {{-- Card: Highlights (4 Item) --}}
      <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-5">
        <h3 class="font-extrabold text-emerald-950 text-base border-b border-gray-50 pb-3 flex items-center gap-2">
          <span>✨</span> Fitur Unggulan (4 Highlights)
        </h3>

        <div class="grid md:grid-cols-2 gap-4">
          
          {{-- Highlight 1 --}}
          <div class="p-4 bg-gray-50 border border-gray-100 rounded-xl space-y-2">
            <h4 class="font-extrabold text-xs text-emerald-800">Highlight 1</h4>
            <div class="grid grid-cols-4 gap-2">
              <div>
                <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Icon</label>
                <input type="text" name="about_h1_icon" value="{{ old('about_h1_icon', $settings['about_h1_icon'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-2.5 py-1.5 text-xs text-center">
              </div>
              <div class="col-span-3">
                <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Judul</label>
                <input type="text" name="about_h1_title" value="{{ old('about_h1_title', $settings['about_h1_title'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-3 py-1.5 text-xs font-bold">
              </div>
            </div>
            <div>
              <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Deskripsi Singkat</label>
              <input type="text" name="about_h1_desc" value="{{ old('about_h1_desc', $settings['about_h1_desc'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-3 py-1.5 text-xs">
            </div>
          </div>

          {{-- Highlight 2 --}}
          <div class="p-4 bg-gray-50 border border-gray-100 rounded-xl space-y-2">
            <h4 class="font-extrabold text-xs text-emerald-800">Highlight 2</h4>
            <div class="grid grid-cols-4 gap-2">
              <div>
                <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Icon</label>
                <input type="text" name="about_h2_icon" value="{{ old('about_h2_icon', $settings['about_h2_icon'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-2.5 py-1.5 text-xs text-center">
              </div>
              <div class="col-span-3">
                <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Judul</label>
                <input type="text" name="about_h2_title" value="{{ old('about_h2_title', $settings['about_h2_title'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-3 py-1.5 text-xs font-bold">
              </div>
            </div>
            <div>
              <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Deskripsi Singkat</label>
              <input type="text" name="about_h2_desc" value="{{ old('about_h2_desc', $settings['about_h2_desc'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-3 py-1.5 text-xs">
            </div>
          </div>

          {{-- Highlight 3 --}}
          <div class="p-4 bg-gray-50 border border-gray-100 rounded-xl space-y-2">
            <h4 class="font-extrabold text-xs text-emerald-800">Highlight 3</h4>
            <div class="grid grid-cols-4 gap-2">
              <div>
                <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Icon</label>
                <input type="text" name="about_h3_icon" value="{{ old('about_h3_icon', $settings['about_h3_icon'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-2.5 py-1.5 text-xs text-center">
              </div>
              <div class="col-span-3">
                <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Judul</label>
                <input type="text" name="about_h3_title" value="{{ old('about_h3_title', $settings['about_h3_title'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-3 py-1.5 text-xs font-bold">
              </div>
            </div>
            <div>
              <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Deskripsi Singkat</label>
              <input type="text" name="about_h3_desc" value="{{ old('about_h3_desc', $settings['about_h3_desc'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-3 py-1.5 text-xs">
            </div>
          </div>

          {{-- Highlight 4 --}}
          <div class="p-4 bg-gray-50 border border-gray-100 rounded-xl space-y-2">
            <h4 class="font-extrabold text-xs text-emerald-800">Highlight 4</h4>
            <div class="grid grid-cols-4 gap-2">
              <div>
                <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Icon</label>
                <input type="text" name="about_h4_icon" value="{{ old('about_h4_icon', $settings['about_h4_icon'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-2.5 py-1.5 text-xs text-center">
              </div>
              <div class="col-span-3">
                <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Judul</label>
                <input type="text" name="about_h4_title" value="{{ old('about_h4_title', $settings['about_h4_title'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-3 py-1.5 text-xs font-bold">
              </div>
            </div>
            <div>
              <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Deskripsi Singkat</label>
              <input type="text" name="about_h4_desc" value="{{ old('about_h4_desc', $settings['about_h4_desc'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-3 py-1.5 text-xs">
            </div>
          </div>

        </div>
      </div>

      {{-- Card: Trust Cards (3 Item) --}}
      <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-5">
        <h3 class="font-extrabold text-emerald-950 text-base border-b border-gray-50 pb-3 flex items-center gap-2">
          <span>🛡️</span> Jaminan Layanan & Kepercayaan (3 Trust Cards)
        </h3>

        <div class="grid md:grid-cols-3 gap-4">
          
          {{-- Trust Card 1 --}}
          <div class="p-4 bg-emerald-50/20 border border-emerald-100/50 rounded-xl space-y-2">
            <h4 class="font-extrabold text-xs text-emerald-900 border-b border-emerald-100/60 pb-1 flex items-center justify-between">
              <span>Card 1</span>
            </h4>
            <div class="grid grid-cols-4 gap-2">
              <div>
                <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Icon</label>
                <input type="text" name="about_c1_icon" value="{{ old('about_c1_icon', $settings['about_c1_icon'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-2 py-1.5 text-xs text-center font-bold">
              </div>
              <div class="col-span-3">
                <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Judul Jaminan</label>
                <input type="text" name="about_c1_title" value="{{ old('about_c1_title', $settings['about_c1_title'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-3 py-1.5 text-xs font-extrabold">
              </div>
            </div>
            <div>
              <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Deskripsi Lengkap</label>
              <textarea name="about_c1_desc" rows="3" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-3 py-1.5 text-xs leading-relaxed">{{ old('about_c1_desc', $settings['about_c1_desc'] ?? '') }}</textarea>
            </div>
          </div>

          {{-- Trust Card 2 --}}
          <div class="p-4 bg-emerald-50/20 border border-emerald-100/50 rounded-xl space-y-2">
            <h4 class="font-extrabold text-xs text-emerald-900 border-b border-emerald-100/60 pb-1 flex items-center justify-between">
              <span>Card 2</span>
            </h4>
            <div class="grid grid-cols-4 gap-2">
              <div>
                <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Icon</label>
                <input type="text" name="about_c2_icon" value="{{ old('about_c2_icon', $settings['about_c2_icon'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-2 py-1.5 text-xs text-center font-bold">
              </div>
              <div class="col-span-3">
                <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Judul Jaminan</label>
                <input type="text" name="about_c2_title" value="{{ old('about_c2_title', $settings['about_c2_title'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-3 py-1.5 text-xs font-extrabold">
              </div>
            </div>
            <div>
              <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Deskripsi Lengkap</label>
              <textarea name="about_c2_desc" rows="3" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-3 py-1.5 text-xs leading-relaxed">{{ old('about_c2_desc', $settings['about_c2_desc'] ?? '') }}</textarea>
            </div>
          </div>

          {{-- Trust Card 3 --}}
          <div class="p-4 bg-emerald-50/20 border border-emerald-100/50 rounded-xl space-y-2">
            <h4 class="font-extrabold text-xs text-emerald-900 border-b border-emerald-100/60 pb-1 flex items-center justify-between">
              <span>Card 3</span>
            </h4>
            <div class="grid grid-cols-4 gap-2">
              <div>
                <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Icon</label>
                <input type="text" name="about_c3_icon" value="{{ old('about_c3_icon', $settings['about_c3_icon'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-2 py-1.5 text-xs text-center font-bold">
              </div>
              <div class="col-span-3">
                <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Judul Jaminan</label>
                <input type="text" name="about_c3_title" value="{{ old('about_c3_title', $settings['about_c3_title'] ?? '') }}" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-3 py-1.5 text-xs font-extrabold">
              </div>
            </div>
            <div>
              <label class="block text-gray-700 font-semibold text-2xs mb-0.5">Deskripsi Lengkap</label>
              <textarea name="about_c3_desc" rows="3" class="w-full bg-white border border-gray-200 focus:border-emerald-500 rounded-lg px-3 py-1.5 text-xs leading-relaxed">{{ old('about_c3_desc', $settings['about_c3_desc'] ?? '') }}</textarea>
            </div>
          </div>

        </div>
      </div>
    </div>

    {{-- TAB 5: BANNER CTA --}}
    <div id="tab-cta" class="tab-pane space-y-6 hidden">
      <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-5">
        <h3 class="font-extrabold text-emerald-950 text-base border-b border-gray-50 pb-3 flex items-center gap-2">
          <span>📣</span> Banner Ajakan Bertindak (CTA Banner Tengah)
        </h3>

        <div>
          <label class="block text-gray-700 font-semibold text-sm mb-1.5">Judul Utama Banner CTA</label>
          <input type="text" name="cta_headline" value="{{ old('cta_headline', $settings['cta_headline'] ?? '') }}" 
                 class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800">
        </div>

        <div>
          <label class="block text-gray-700 font-semibold text-sm mb-1.5">Deskripsi Banner CTA (Sub-headline)</label>
          <textarea name="cta_sub" rows="3" class="w-full bg-gray-50 hover:bg-gray-100/50 focus:bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800">{{ old('cta_sub', $settings['cta_sub'] ?? '') }}</textarea>
        </div>
      </div>
    </div>

  </div>

  {{-- Floating Save Bar --}}
  <div class="flex items-center justify-end gap-3 bg-slate-50 border border-gray-100 rounded-2xl p-4 shadow-sm">
    <button type="submit" class="bg-emerald-700 hover:bg-emerald-800 text-white font-extrabold text-sm px-8 py-3.5 rounded-xl shadow-lg transition-colors cursor-pointer flex items-center gap-2">
      <span>💾</span> Simpan Semua Pengaturan
    </button>
  </div>
</form>

<script>
  function switchTab(evt, tabId) {
    // Hide all tab panes
    const tabPanes = document.querySelectorAll('.tab-pane');
    tabPanes.forEach(pane => pane.classList.add('hidden'));

    // Remove active styles from all tab buttons
    const tabBtns = document.querySelectorAll('.tab-btn');
    tabBtns.forEach(btn => {
      btn.classList.remove('border-emerald-700', 'text-emerald-700');
      btn.classList.add('border-transparent', 'text-gray-500');
    });

    // Show the current tab pane
    document.getElementById(tabId).classList.remove('hidden');

    // Add active styles to current tab button
    evt.currentTarget.classList.remove('border-transparent', 'text-gray-500');
    evt.currentTarget.classList.add('border-emerald-700', 'text-emerald-700');
  }

  // Live image preview helper
  function previewImage(input, previewId, fallbackText) {
    const file = input.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const previewDiv = document.getElementById(previewId);
        if (previewId === 'store-logo-preview') {
          previewDiv.innerHTML = `<img src="${e.target.result}" class="h-full w-full object-contain p-1">`;
        } else {
          previewDiv.innerHTML = `<img src="${e.target.result}" class="h-full w-full object-cover">`;
        }
      };
      reader.readAsDataURL(file);
    }
  }

  // Store Branches Manager State
  let branchesData = [];
  try {
    const rawVal = document.getElementById('branches-json-input').value;
    branchesData = JSON.parse(rawVal || '[]');
  } catch (e) {
    branchesData = [];
  }

  function renderBranches() {
    const container = document.getElementById('branch-rows-container');
    if (branchesData.length === 0) {
      container.innerHTML = `
        <div class="text-center py-8 border border-dashed border-gray-200 rounded-2xl bg-gray-50/50">
          <span class="text-3xl">📍</span>
          <p class="text-xs text-gray-400 mt-2 font-medium">Belum ada cabang terdaftar. Klik tombol di atas untuk menambah cabang.</p>
        </div>
      `;
      return;
    }

    container.innerHTML = branchesData.map((branch, index) => renderBranchRow(branch, index)).join('');
  }

  function renderBranchRow(branch, index) {
    return `
      <div class="branch-row-card p-5 bg-slate-50/50 border border-slate-100 rounded-2xl relative space-y-4 group transition-all duration-200 hover:border-emerald-100 hover:bg-emerald-50/10" data-index="${index}">
        <div class="flex items-center justify-between border-b border-slate-100 pb-2.5">
          <h4 class="font-bold text-xs text-slate-800 flex items-center gap-1.5">
            <span class="w-5 h-5 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center text-3xs font-extrabold">${index + 1}</span>
            <span>Detail Cabang Resmi</span>
          </h4>
          <button type="button" onclick="deleteBranchRow(${index})" class="text-red-500 hover:text-red-700 text-xs font-bold transition-colors flex items-center gap-1 cursor-pointer">
            <span>🗑️</span> Hapus Cabang
          </button>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="block text-slate-700 font-semibold text-xs mb-1">Nama Cabang / Wilayah</label>
            <input type="text" value="${escapeHtml(branch.name || '')}" oninput="updateBranchField(${index}, 'name', this.value)"
                   placeholder="Contoh: Cabang Cianjur"
                   class="w-full bg-white border border-slate-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-lg px-3 py-2 text-xs transition-all outline-none font-semibold text-slate-800" required>
          </div>
          <div>
            <label class="block text-slate-700 font-semibold text-xs mb-1">Nomor WhatsApp Cabang</label>
            <input type="text" value="${escapeHtml(branch.wa_number || '')}" oninput="updateBranchField(${index}, 'wa_number', this.value)"
                   placeholder="Contoh: 6281234567890"
                   class="w-full bg-white border border-slate-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-lg px-3 py-2 text-xs transition-all outline-none font-medium text-slate-800" required>
          </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="block text-slate-700 font-semibold text-xs mb-1">Alamat Lengkap Cabang</label>
            <textarea rows="2" oninput="updateBranchField(${index}, 'address', this.value)"
                      placeholder="Masukkan alamat lengkap cabang..."
                      class="w-full bg-white border border-slate-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-lg px-3 py-2 text-xs transition-all outline-none font-medium text-slate-800" required>${escapeHtml(branch.address || '')}</textarea>
          </div>
          <div>
            <label class="block text-slate-700 font-semibold text-xs mb-1">Link Iframe Google Maps (Embed URL)</label>
            <textarea rows="2" oninput="updateBranchField(${index}, 'maps_embed_url', this.value)"
                      placeholder="https://www.google.com/maps/embed?pb=..."
                      class="w-full bg-white border border-slate-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-lg px-3 py-2 text-xs transition-all outline-none font-medium text-slate-800">${escapeHtml(branch.maps_embed_url || '')}</textarea>
          </div>
        </div>
      </div>
    `;
  }

  function addBranchRow() {
    branchesData.push({
      name: '',
      wa_number: '',
      address: '',
      maps_embed_url: ''
    });
    saveBranchesToInput();
    renderBranches();
  }

  function deleteBranchRow(index) {
    if (confirm('Apakah Anda yakin ingin menghapus cabang ini?')) {
      branchesData.splice(index, 1);
      saveBranchesToInput();
      renderBranches();
    }
  }

  function updateBranchField(index, field, value) {
    if (branchesData[index]) {
      branchesData[index][field] = value;
      saveBranchesToInput();
    }
  }

  function saveBranchesToInput() {
    document.getElementById('branches-json-input').value = JSON.stringify(branchesData);
  }

  function escapeHtml(str) {
    if (!str) return '';
    return str
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  // Initial render
  document.addEventListener('DOMContentLoaded', () => {
    renderBranches();
  });
</script>
@endsection
