<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $settings['store_name'] ?? 'Pusat Kurma Premium Cianjur' }} | Toko Kurma Terpercaya</title>
  <meta name="description" content="{{ $settings['store_name'] ?? 'Pusat Kurma Premium Cianjur' }} - Distributor kurma impor berkualitas tinggi. Kurma Sukari, Medjool, Ajwa, dan berbagai varian kurma premium dengan harga terbaik. Tersedia grosir & eceran." />
  <meta name="keywords" content="kurma premium, toko kurma cianjur, kurma sukari, kurma medjool, kurma ajwa, kurma impor" />

  <!-- Google Fonts: Outfit -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Swiper CSS CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            outfit: ['Outfit', 'sans-serif'],
          },
          colors: {
            emerald: {
              950: '#022c22',
              900: '#064e3b',
              800: '#065f46',
              700: '#047857',
              600: '#059669',
              500: '#10b981',
            },
            gold: {
              400: '#fbbf24',
              500: '#f59e0b',
              600: '#d97706',
            },
          },
        },
      },
    };
  </script>

  <style>
    * { font-family: 'Outfit', sans-serif; }

    /* Navbar scroll effect */
    #navbar { transition: background 0.3s ease, box-shadow 0.3s ease; }
    #navbar.scrolled {
      background: rgba(6, 78, 59, 0.97) !important;
      box-shadow: 0 4px 30px rgba(0,0,0,0.25);
      backdrop-filter: blur(12px);
    }

    /* Mobile menu */
    #mobile-menu { max-height: 0; overflow: hidden; transition: max-height 0.4s ease; }
    #mobile-menu.open { max-height: 400px; }

    /* Hero gradient overlay */
    .hero-overlay {
      background: linear-gradient(135deg, rgba(2,44,34,0.92) 0%, rgba(6,78,59,0.82) 50%, rgba(4,120,87,0.65) 100%);
    }

    /* Product card hover */
    .product-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .product-card:hover { transform: translateY(-8px); box-shadow: 0 20px 50px rgba(6,78,59,0.18); }

    /* Floating WA button */
    @keyframes pulseGlow {
      0%, 100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.5); }
      50%       { box-shadow: 0 0 0 14px rgba(34, 197, 94, 0); }
    }
    .wa-float { animation: pulseGlow 2.5s ease-in-out infinite; }

    /* Modern Scroll Reveal System */
    .reveal,
    [class*="reveal-"] {
      opacity: 0;
      transition: opacity 1.2s cubic-bezier(0.16, 1, 0.3, 1),
                  transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
      will-change: transform, opacity;
    }

    .reveal,
    .reveal-slide-up { transform: translateY(50px); }
    .reveal-slide-down { transform: translateY(-50px); }
    .reveal-slide-left { transform: translateX(50px); }
    .reveal-slide-right { transform: translateX(-50px); }
    .reveal-zoom-in { transform: scale(0.94); }
    .reveal-zoom-out { transform: scale(1.06); }
    .reveal-fade { transform: none; }

    /* When visible */
    .reveal.visible,
    [class*="reveal-"].visible {
      opacity: 1;
      transform: translate(0) scale(1);
    }

    /* Gold shimmer */
    .gold-shimmer {
      background: linear-gradient(90deg, #f59e0b, #fbbf24, #f59e0b);
      background-size: 200% auto;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: shimmer 3s linear infinite;
    }
    @keyframes shimmer { to { background-position: 200% center; } }

    /* Floating badge */
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50%       { transform: translateY(-10px); }
    }
    .trust-badge { animation: float 4s ease-in-out infinite; }

    /* Custom scrollbar */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #f0fdf4; }
    ::-webkit-scrollbar-thumb { background: #064e3b; border-radius: 3px; }

    /* Wave divider */
    .wave-divider { overflow: hidden; line-height: 0; }
    .wave-divider svg { display: block; }

    /* Custom Swiper Styles */
    .swiper-pagination-bullet {
      background: #064e3b !important;
      opacity: 0.3 !important;
      width: 10px !important;
      height: 10px !important;
      transition: all 0.3s ease !important;
    }
    .swiper-pagination-bullet-active {
      background: #d97706 !important;
      width: 24px !important;
      border-radius: 5px !important;
      opacity: 1 !important;
    }
    .swiper-slide {
      height: auto !important;
    }

    /* Premium Product Card Upgrades */
    .product-card {
      transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1),
                  box-shadow 0.6s cubic-bezier(0.16, 1, 0.3, 1),
                  border-color 0.6s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    .product-card:hover {
      transform: translateY(-12px) scale(1.015);
      box-shadow: 0 30px 60px rgba(6, 78, 59, 0.12),
                  0 0 0 1px rgba(245, 158, 11, 0.2) inset !important;
      border-color: rgba(245, 158, 11, 0.3) !important;
    }

    /* Product Image Smooth Zoom & Subtle Rotate */
    .product-card img {
      transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    .product-card:hover img {
      transform: scale(1.08) rotate(1deg);
    }

    /* Swiper Navigation Micro-interactions with Spring Ease */
    .swiper-prev-btn {
      transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    .swiper-prev-btn:hover {
      transform: translateY(-50%) scale(1.15) translateX(-4px) !important;
      box-shadow: 0 10px 25px rgba(6, 78, 59, 0.15) !important;
    }

    .swiper-next-btn {
      transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    .swiper-next-btn:hover {
      transform: translateY(-50%) scale(1.15) translateX(4px) !important;
      box-shadow: 0 10px 25px rgba(6, 78, 59, 0.15) !important;
    }

    /* WhatsApp Button Shimmer & Premium Hover */
    .btn-premium-wa {
      position: relative;
      overflow: hidden;
      transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    .btn-premium-wa:hover {
      transform: scale(1.03);
      box-shadow: 0 12px 25px rgba(6, 78, 59, 0.2);
    }
    .btn-premium-wa::after {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.2),
        transparent
      );
      transition: all 0.6s ease;
    }
    .btn-premium-wa:hover::after {
      left: 100%;
    }

    /* Sparkling Green Animations for White CTA Background */
    @keyframes floatGlow {
      0%, 100% {
        transform: translate(0, 0) scale(1);
        opacity: 0.15;
      }
      50% {
        transform: translate(60px, -40px) scale(1.25);
        opacity: 0.45;
      }
    }
    @keyframes sweepShimmer {
      0% {
        transform: translateX(-100%) rotate(25deg);
      }
      100% {
        transform: translateX(100%) rotate(25deg);
      }
    }
    .animate-float-glow-1 {
      animation: floatGlow 10s ease-in-out infinite;
    }
    .animate-float-glow-2 {
      animation: floatGlow 14s ease-in-out infinite;
      animation-delay: 3s;
    }
    .shimmer-sweep {
      position: relative;
      overflow: hidden;
    }
    .shimmer-sweep::after {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(
        to right,
        transparent,
        rgba(16, 185, 129, 0.05) 25%,
        rgba(16, 185, 129, 0.28) 50%,
        rgba(16, 185, 129, 0.05) 75%,
        transparent
      );
      transform: rotate(25deg);
      animation: sweepShimmer 5s cubic-bezier(0.16, 1, 0.3, 1) infinite;
      pointer-events: none;
    }
  </style>
</head>

<body class="bg-white text-gray-800 antialiased">

  @php
    $storeName = $settings['store_name'] ?? 'Pusat Kurma Premium Cianjur';
    $waNumClean = preg_replace('/\D/', '', $settings['wa_number'] ?? '6281234567890');
    $addressVal = $settings['address'] ?? 'Jl. Merdeka No. 45, Kel. Solokpandan, Kec. Cianjur, Kab. Cianjur, Jawa Barat 43214';
    $hoursVal = $settings['opening_hours'] ?? 'Senin–Jumat: 08.00–20.00 WIB | Sabtu: 08.00–17.00 WIB';
    $instagramVal = $settings['instagram'] ?? 'https://instagram.com';
    $facebookVal = $settings['facebook'] ?? 'https://facebook.com';

    // Split brand name into two lines for beautiful header styling
    $words = explode(' ', $storeName);
    $firstWord = $words[0] ?? 'Pusat';
    $secondWord = implode(' ', array_slice($words, 1));

    // Dynamic additions
    $heroBgImage = $settings['hero_bg_image'] ?? 'https://images.unsplash.com/photo-1571680322279-a226e6a4cc2a?w=1600&q=80&auto=format&fit=crop';
    $shippingInfo = $settings['shipping_info'] ?? 'Antar gratis area Cianjur kota (min. order 500g). Pengiriman seluruh Indonesia via JNE, J&T, SiCepat.';
    $mapsEmbedUrlRaw = $settings['maps_embed_url'] ?? '';
    $mapsEmbedUrl = !empty($mapsEmbedUrlRaw) && str_contains($mapsEmbedUrlRaw, 'embed')
      ? $mapsEmbedUrlRaw
      : (!empty($addressVal) ? "https://maps.google.com/maps?q=" . urlencode($storeName . ' ' . $addressVal) . "&t=&z=15&ie=UTF8&iwloc=&output=embed" : "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15837.356714929936!2d107.13403!3d-6.82185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68a96e1b5a9cf9%3A0x20e0d4987d91a09c!2sCianjur%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1680000000000!5m2!1sen!2sid");
    $branches = json_decode($settings['branches'] ?? '[]', true);
    
    // Stats
    $stats = [
      ['value' => $settings['stat_1_val'] ?? '10+',    'label' => $settings['stat_1_lbl'] ?? 'Tahun Berpengalaman'],
      ['value' => $settings['stat_2_val'] ?? '2.300+', 'label' => $settings['stat_2_lbl'] ?? 'Pelanggan Setia'],
      ['value' => $settings['stat_3_val'] ?? '15+',    'label' => $settings['stat_3_lbl'] ?? 'Varian Kurma Premium'],
      ['value' => $settings['stat_4_val'] ?? '100%',   'label' => $settings['stat_4_lbl'] ?? 'Produk Halal & Autentik'],
    ];

    // About Details
    $aboutHeadline = $settings['about_headline'] ?? 'Kepercayaan yang Dibangun Sejak Puluhan Tahun';
    $aboutSub = $settings['about_sub'] ?? 'Kami bukan sekadar toko kurma. Kami adalah mitra Anda dalam menghadirkan kelezatan, kebaikan, dan keberkahan dari buah terbaik bumi Allah.';
    $aboutImage = $settings['about_image'] ?? 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=800&q=80&auto=format&fit=crop';
    $aboutTitleDetail = $settings['about_title_detail'] ?? 'Menghadirkan Kurma Terbaik Langsung ke Tangan Anda';
    $aboutDesc1 = $settings['about_desc_1'] ?? 'Pusat Kurma Premium Cianjur berkomitmen menghadirkan kurma impor berkualitas tinggi...';
    $aboutDesc2 = $settings['about_desc_2'] ?? 'Berlokasi strategis di Cianjur, kami melayani pembelian eceran maupun grosir...';

    $aboutHighlights = [
      ['icon' => $settings['about_h1_icon'] ?? '🌿', 'title' => $settings['about_h1_title'] ?? '100% Organik', 'desc' => $settings['about_h1_desc'] ?? 'Tanpa pengawet buatan'],
      ['icon' => $settings['about_h2_icon'] ?? '🛡️', 'title' => $settings['about_h2_title'] ?? 'Bersertifikat Halal', 'desc' => $settings['about_h2_desc'] ?? 'Dijamin MUI & BPOM'],
      ['icon' => $settings['about_h3_icon'] ?? '✈️', 'title' => $settings['about_h3_title'] ?? 'Langsung Impor', 'desc' => $settings['about_h3_desc'] ?? 'Arab, Tunisia, Mesir'],
      ['icon' => $settings['about_h4_icon'] ?? '📦', 'title' => $settings['about_h4_title'] ?? 'Kemasan Premium', 'desc' => $settings['about_h4_desc'] ?? 'Higienis & elegan'],
    ];

    $aboutTrustCards = [
      ['icon' => $settings['about_c1_icon'] ?? '🌴', 'title' => $settings['about_c1_title'] ?? 'Stok Selalu Fresh', 'desc' => $settings['about_c1_desc'] ?? 'Produk kami selalu diperbarui secara berkala untuk memastikan kesegaran dan kualitas terbaik setiap saat.'],
      ['icon' => $settings['about_c2_icon'] ?? '🧼', 'title' => $settings['about_c2_title'] ?? 'Penanganan Higienis', 'desc' => $settings['about_c2_desc'] ?? 'Proses sortir, pengemasan, hingga pengiriman dilakukan dengan standar kebersihan dan higienitas yang ketat.'],
      ['icon' => $settings['about_c3_icon'] ?? '💚', 'title' => $settings['about_c3_title'] ?? 'Amanah & Jujur', 'desc' => $settings['about_c3_desc'] ?? 'Kami menjual apa yang kami janjikan. Tidak ada pemalsuan produk. Kepercayaan adalah segalanya.'],
    ];

    // CTA Banner
    $ctaHeadline = $settings['cta_headline'] ?? 'Siap Order Kurma Premium Terbaik? 🌴';
    $ctaSub = $settings['cta_sub'] ?? 'Hubungi kami sekarang via WhatsApp dan dapatkan konsultasi gratis seputar pilihan kurma terbaik sesuai kebutuhan & budget Anda.';
  @endphp

  {{-- ============================================================
       STICKY NAVBAR
  ============================================================ --}}
  <header id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-emerald-900/95 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">

        {{-- Logo --}}
        <a href="#beranda" class="flex items-center gap-2.5 group">
          @if(!empty($settings['store_logo']))
            <div class="flex items-center justify-center h-11 px-3 bg-white border border-gray-100 rounded-xl shadow-sm transition-all duration-300 group-hover:scale-[1.03] group-hover:shadow-md">
              <img src="{{ $settings['store_logo'] }}" alt="{{ $storeName }}" class="h-8 w-auto object-contain transition-transform duration-300" style="image-rendering: -webkit-optimize-contrast;">
            </div>
          @else
            <div class="w-9 h-9 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-lg flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
              <span class="text-emerald-950 font-black text-lg leading-none">🌴</span>
            </div>
            <div>
              <div class="text-white font-extrabold text-base leading-tight tracking-tight">{{ $firstWord }}</div>
              <div class="text-yellow-400 font-semibold text-xs leading-tight tracking-wider uppercase">{{ $secondWord }}</div>
            </div>
          @endif
        </a>

        {{-- Desktop Nav --}}
        <nav class="hidden md:flex items-center gap-1">
          <a href="#beranda" class="nav-link text-white/80 hover:text-yellow-400 font-medium text-sm px-3 py-2 rounded-lg hover:bg-white/10 transition-all duration-200">Beranda</a>
          <a href="#tentang" class="nav-link text-white/80 hover:text-yellow-400 font-medium text-sm px-3 py-2 rounded-lg hover:bg-white/10 transition-all duration-200">Tentang Kami</a>
          <a href="#produk" class="nav-link text-white/80 hover:text-yellow-400 font-medium text-sm px-3 py-2 rounded-lg hover:bg-white/10 transition-all duration-200">Produk Unggulan</a>
          <a href="#kontak" class="nav-link text-white/80 hover:text-yellow-400 font-medium text-sm px-3 py-2 rounded-lg hover:bg-white/10 transition-all duration-200">Kontak</a>
        </nav>

        {{-- Trust badge + Hamburger --}}
        <div class="flex items-center gap-3">
          <div class="hidden sm:flex items-center gap-1.5 bg-yellow-500/20 border border-yellow-400/40 rounded-full px-3 py-1">
            <span class="text-yellow-400 text-xs">✓</span>
            <span class="text-yellow-300 font-semibold text-xs">Toko Resmi · Cianjur</span>
          </div>
          <button id="hamburger" onclick="toggleMenu()" class="md:hidden p-2 rounded-lg text-white hover:bg-white/10 transition-colors" aria-label="Menu">
            <svg id="icon-menu" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg id="icon-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
      </div>

      {{-- Mobile Menu --}}
      <div id="mobile-menu">
        <nav class="pb-4 flex flex-col gap-1">
          <a href="#beranda" onclick="closeMenu()" class="text-white/90 hover:text-yellow-400 font-medium text-sm px-4 py-3 rounded-lg hover:bg-white/10 transition-all">🏠 Beranda</a>
          <a href="#tentang" onclick="closeMenu()" class="text-white/90 hover:text-yellow-400 font-medium text-sm px-4 py-3 rounded-lg hover:bg-white/10 transition-all">ℹ️ Tentang Kami</a>
          <a href="#produk" onclick="closeMenu()" class="text-white/90 hover:text-yellow-400 font-medium text-sm px-4 py-3 rounded-lg hover:bg-white/10 transition-all">🛍️ Produk Unggulan</a>
          <a href="#kontak" onclick="closeMenu()" class="text-white/90 hover:text-yellow-400 font-medium text-sm px-4 py-3 rounded-lg hover:bg-white/10 transition-all">📞 Kontak</a>
          <div class="mt-2 flex items-center gap-1.5 bg-yellow-500/20 border border-yellow-400/40 rounded-full px-3 py-1.5 w-fit">
            <span class="text-yellow-400 text-xs">✓</span>
            <span class="text-yellow-300 font-semibold text-xs">Toko Resmi · Cianjur</span>
          </div>
        </nav>
      </div>
    </div>
  </header>

  <main>

    {{-- ============================================================
         HERO SECTION
    ============================================================ --}}
    <section id="beranda" class="relative min-h-screen flex items-center overflow-hidden">
      {{-- Background Image --}}
      <div class="absolute inset-0 z-0">
        <img
          src="{{ $heroBgImage }}"
          alt="Kurma Premium berkualitas tinggi"
          class="w-full h-full object-cover object-center"
          loading="eager"
        />
        <div class="hero-overlay absolute inset-0"></div>
      </div>

      {{-- Decorative circles --}}
      <div class="absolute top-24 right-10 w-64 h-64 rounded-full border border-yellow-400/20 opacity-40 hidden lg:block"></div>
      <div class="absolute top-32 right-16 w-48 h-48 rounded-full border border-yellow-400/15 opacity-30 hidden lg:block"></div>

      <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-20 lg:pt-36 lg:pb-28">
        <div class="max-w-3xl">

          {{-- Tagline badge --}}
          <div class="inline-flex items-center gap-2 bg-yellow-500/20 border border-yellow-400/50 rounded-full px-4 py-1.5 mb-6 backdrop-blur-sm">
            <span class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></span>
            <span class="text-yellow-300 font-semibold text-xs sm:text-sm tracking-wide uppercase">{{ $settings['hero_tagline'] ?? 'Kurma Impor Terpercaya · Cianjur' }}</span>
          </div>

          {{-- Main Headline --}}
          <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-black text-white leading-tight mb-6">
            Kurma Premium
            <span class="block gold-shimmer mt-1">{{ $settings['hero_headline'] ?? 'Asli & Terjamin' }}</span>
            <span class="block text-3xl sm:text-4xl lg:text-5xl font-bold text-white/90 mt-2">Langsung dari Tanah Arab 🌙</span>
          </h1>

          {{-- Sub headline --}}
          <p class="text-white/80 text-base sm:text-lg lg:text-xl font-medium leading-relaxed mb-8 max-w-xl">
            {{ $settings['hero_sub'] ?? 'Nikmati cita rasa kurma pilihan terbaik — manis alami, higienis, dan autentik. Tersedia dalam berbagai varian premium untuk kebutuhan keluarga, oleh-oleh, hingga acara spesial Anda.' }}
          </p>

          {{-- CTA Buttons --}}
          <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
            <a
              id="cta-hero-order"
              href="https://wa.me/{{ $waNumClean }}?text=Halo%20Admin%20{{ urlencode($storeName) }}%2C%20saya%20ingin%20mengetahui%20produk%20dan%20harga%20kurma%20premium%20yang%20tersedia.%20Mohon%20infonya%20ya%20kak%20%F0%9F%99%8F"
              target="_blank"
              rel="noopener noreferrer"
              class="wa-float inline-flex items-center justify-center gap-2.5 bg-yellow-500 hover:bg-yellow-400 text-emerald-950 font-extrabold text-base sm:text-lg px-7 py-4 rounded-2xl shadow-2xl transition-all duration-300 hover:scale-105 min-h-[52px]"
            >
              <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
              </svg>
              Order via WhatsApp
            </a>
            <a
              href="#produk"
              class="inline-flex items-center justify-center gap-2 bg-white/15 hover:bg-white/25 text-white font-bold text-base sm:text-lg px-7 py-4 rounded-2xl border border-white/30 backdrop-blur-sm transition-all duration-300 hover:scale-105 min-h-[52px]"
            >
              Lihat Produk
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
              </svg>
            </a>
          </div>

          {{-- Trust indicators --}}
          <div class="flex flex-wrap gap-4 mt-10">
            <div class="flex items-center gap-2 text-white/70">
              <span class="text-yellow-400 font-bold text-base">★★★★★</span>
              <span class="text-sm font-medium">4.9 · 2.300+ Pelanggan</span>
            </div>
            <div class="w-px bg-white/20 hidden sm:block"></div>
            <div class="flex items-center gap-1.5 text-white/70">
              <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              <span class="text-sm font-medium">100% Produk Halal & Autentik</span>
            </div>
            <div class="w-px bg-white/20 hidden sm:block"></div>
            <div class="flex items-center gap-1.5 text-white/70">
              <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M5 8a1 1 0 011-1h1V6a3 3 0 016 0v1h1a1 1 0 011 1v7a2 2 0 01-2 2H7a2 2 0 01-2-2V8z"/></svg>
              <span class="text-sm font-medium">Kemasan Higienis & Aman</span>
            </div>
          </div>
        </div>
      </div>

      {{-- Bottom wave --}}
      <div class="wave-divider absolute bottom-0 left-0 right-0 z-10">
        <svg viewBox="0 0 1440 80" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
          <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#f8fafc"/>
        </svg>
      </div>
    </section>

    {{-- ============================================================
         STATS BAR
    ============================================================ --}}
    <section class="bg-slate-50 py-8 border-y border-emerald-100">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
          @foreach($stats as $index => $stat)
            <div class="reveal" style="transition-delay: {{ $index * 0.1 }}s">
              <div class="text-3xl sm:text-4xl font-black text-emerald-900">{{ $stat['value'] }}</div>
              <div class="text-gray-500 font-medium text-sm mt-1">{{ $stat['label'] }}</div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    {{-- ============================================================
         ABOUT US SECTION
    ============================================================ --}}
    <section id="tentang" class="py-20 lg:py-28 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="text-center max-w-2xl mx-auto mb-16 reveal">
          <span class="inline-block text-emerald-700 font-bold text-sm tracking-widest uppercase mb-3">Tentang Kami</span>
          <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-emerald-950 leading-tight mb-4">
            {!! nl2br(e($aboutHeadline)) !!}
          </h2>
          @if($aboutSub)
            <p class="text-gray-500 text-base sm:text-lg font-medium leading-relaxed">
              {{ $aboutSub }}
            </p>
          @endif
        </div>

        {{-- Main content grid --}}
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-center mb-16">

          {{-- Image Column --}}
          <div class="lg:col-span-5 relative reveal-slide-right w-full max-w-md sm:max-w-lg lg:max-w-none mx-auto">
            <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-[3/2]">
              <img
                src="{{ $aboutImage }}"
                alt="Tampilan Dalam Toko"
                class="w-full h-full object-cover"
                loading="lazy"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/50 to-transparent"></div>
            </div>
            {{-- Floating badge --}}
            <div class="trust-badge absolute -bottom-4 -right-4 sm:-bottom-6 sm:-right-6 bg-white rounded-2xl shadow-xl p-4 border border-emerald-100">
              <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center">
                  <span class="text-2xl">🏅</span>
                </div>
                <div>
                  <div class="font-black text-emerald-900 text-sm leading-tight">Toko Terpercaya</div>
                  <div class="text-yellow-600 font-semibold text-xs">⭐ Rating 4.9/5.0</div>
                </div>
              </div>
            </div>
            <div class="absolute -top-4 -left-4 sm:-top-6 sm:-left-6 bg-emerald-900 rounded-2xl shadow-xl p-4">
              <div class="text-center">
                <div class="text-2xl font-black text-yellow-400">10+</div>
                <div class="text-white font-semibold text-xs leading-tight">Tahun<br/>Berpengalaman</div>
              </div>
            </div>
          </div>
 
          {{-- Content Column --}}
          <div class="lg:col-span-7 reveal-slide-left w-full" style="transition-delay: 0.15s">
            <h3 class="text-2xl sm:text-3xl font-extrabold text-emerald-950 mb-5 leading-tight">
              {!! nl2br(e($aboutTitleDetail)) !!}
            </h3>
            <p class="text-gray-600 text-base leading-relaxed mb-6">
              {!! nl2br(e($aboutDesc1)) !!}
            </p>
            @if($aboutDesc2)
              <p class="text-gray-600 text-base leading-relaxed mb-8">
                {!! nl2br(e($aboutDesc2)) !!}
              </p>
            @endif

            {{-- Highlights --}}
            <div class="grid grid-cols-2 gap-3">
              @foreach($aboutHighlights as $h)
                @if(!empty($h['title']))
                  <div class="flex items-start gap-3 bg-emerald-50 rounded-xl p-3.5 border border-emerald-100">
                    <span class="text-2xl flex-shrink-0">{{ $h['icon'] }}</span>
                    <div>
                      <div class="font-bold text-emerald-900 text-sm">{{ $h['title'] }}</div>
                      <div class="text-gray-500 text-xs font-medium mt-0.5">{{ $h['desc'] }}</div>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-6">
          @foreach($aboutTrustCards as $index => $card)
            @if(!empty($card['title']))
              <div class="reveal text-center bg-gradient-to-br from-emerald-50 to-white rounded-2xl p-7 border border-emerald-100 hover:border-emerald-300 hover:shadow-lg transition-all duration-300" style="transition-delay: {{ $index * 0.15 }}s">
                <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                  <span class="text-3xl">{{ $card['icon'] }}</span>
                </div>
                <h4 class="font-extrabold text-emerald-950 text-lg mb-2">{{ $card['title'] }}</h4>
                <p class="text-gray-500 text-sm font-medium leading-relaxed">{{ $card['desc'] }}</p>
              </div>
            @endif
          @endforeach
        </div>
      </div>
    </section>

    {{-- ============================================================
         PRODUCT SHOWCASE
    ============================================================ --}}
    <section id="produk" class="py-20 lg:py-28 bg-slate-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="text-center max-w-2xl mx-auto mb-16 reveal">
          <span class="inline-block text-emerald-700 font-bold text-sm tracking-widest uppercase mb-3">Produk Unggulan</span>
          <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-emerald-950 leading-tight mb-4">
            Koleksi Kurma
            <span class="text-emerald-700">Terlengkap & Terpremium</span>
          </h2>
          <p class="text-gray-500 text-base sm:text-lg font-medium leading-relaxed">
            Dari kurma Sukari yang manis legit hingga Medjool yang besar dan lembut — temukan varian terbaik pilihan kami.
          </p>
        </div>

        {{-- Product slider --}}
        <div class="relative px-4 sm:px-12 reveal">
          <div class="swiper productSwiper overflow-hidden">
            <div class="swiper-wrapper">
              @forelse($products as $index => $product)
                @php
                  // Calculate discount percentage if old price and price both look numeric
                  $discount = '';
                  if ($product->old_price && $product->price) {
                      $p1 = (int) preg_replace('/\D/', '', $product->old_price);
                      $p2 = (int) preg_replace('/\D/', '', $product->price);
                      if ($p1 > $p2 && $p1 > 0) {
                          $pct = round((($p1 - $p2) / $p1) * 100);
                          $discount = 'Hemat ' . $pct . '%';
                      }
                  }
                @endphp
                <div class="swiper-slide py-6">
                  <article class="product-card h-full bg-white rounded-3xl overflow-hidden shadow-md border border-gray-100 flex flex-col justify-between">
                    <div>
                      <div class="relative overflow-hidden aspect-[4/3] flex-shrink-0">
                        <img
                          src="{{ $product->image_url }}"
                          alt="{{ $product->name }}"
                          class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                          loading="lazy"
                        />
                        @if($product->badge_label)
                          <div class="absolute top-3 left-3">
                            <span class="{{ $product->badge_class ?? 'bg-yellow-500 text-emerald-950' }} font-bold text-xs px-3 py-1 rounded-full shadow">
                              {{ $product->badge_label }}
                            </span>
                          </div>
                        @endif
                        <div class="absolute top-3 right-3">
                          <span class="bg-emerald-900/80 text-white font-semibold text-xs px-2.5 py-1 rounded-full backdrop-blur-sm">
                            {{ $product->origin }}
                          </span>
                        </div>
                      </div>
                      <div class="p-5 sm:p-6">
                        <h3 class="font-extrabold text-emerald-950 text-xl mb-1.5">{{ $product->name }}</h3>
                        <p class="text-gray-500 text-sm font-medium leading-relaxed mb-4">{{ $product->description }}</p>
                      </div>
                    </div>
                    <div class="px-5 pb-5 sm:px-6 sm:pb-6">
                      <div class="flex items-center justify-between mb-4">
                        <div>
                          <div class="text-yellow-600 font-black text-2xl">{{ $product->price }}</div>
                          <div class="text-gray-400 text-xs font-medium">{{ $product->unit ?? 'per 500 gram' }}</div>
                        </div>
                        <div class="text-right">
                          @if($product->old_price)
                            <div class="text-gray-400 line-through text-sm">{{ $product->old_price }}</div>
                            @if($discount)
                              <div class="bg-red-50 text-red-500 font-bold text-xs px-2 py-0.5 rounded-full">{{ $discount }}</div>
                            @endif
                          @else
                            <span class="bg-emerald-50 text-emerald-700 font-bold text-xs px-2 py-0.5 rounded-full">🌟 Stok Terbatas</span>
                          @endif
                        </div>
                      </div>
                      <a
                        id="btn-beli-{{ $product->id }}"
                        href="https://wa.me/{{ $waNumClean }}?text={{ $product->wa_text ?? 'Halo%20Admin%20Pusat%20Kurma%2C%20saya%20tertarik%20dengan%20produk%20' . urlencode($product->name) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn-premium-wa flex items-center justify-center gap-2 {{ $product->btn_class ?? 'bg-emerald-900 hover:bg-emerald-800 text-white' }} font-bold text-sm px-4 py-3.5 rounded-xl w-full transition-all duration-200 hover:shadow-lg min-h-[48px]"
                      >
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Beli Sekarang
                      </a>
                    </div>
                  </article>
                </div>
              @empty
                <div class="swiper-slide py-16 text-center text-gray-400">
                  <span class="text-4xl">🛍️</span>
                  <p class="font-semibold mt-2">Belum ada produk aktif saat ini.</p>
                </div>
              @endforelse
            </div>
            
            {{-- Pagination dots --}}
            <div class="swiper-pagination !relative !bottom-0 mt-8"></div>
          </div>

          {{-- Navigation Arrows (hidden on mobile, visible on lg screens) --}}
          <button class="swiper-prev-btn absolute top-1/2 -left-4 -translate-y-1/2 w-12 h-12 bg-white text-emerald-900 border border-emerald-100 hover:bg-emerald-900 hover:text-white rounded-full flex items-center justify-center shadow-lg transition-all duration-300 z-10 hidden lg:flex" aria-label="Previous Slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
            </svg>
          </button>
          <button class="swiper-next-btn absolute top-1/2 -right-4 -translate-y-1/2 w-12 h-12 bg-white text-emerald-900 border border-emerald-100 hover:bg-emerald-900 hover:text-white rounded-full flex items-center justify-center shadow-lg transition-all duration-300 z-10 hidden lg:flex" aria-label="Next Slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
            </svg>
          </button>
        </div>

        {{-- View all CTA --}}
        <div class="text-center mt-12 reveal">
          <p class="text-gray-500 font-medium mb-4">Masih banyak varian lainnya yang tersedia!</p>
          <a
            href="https://wa.me/{{ $waNumClean }}?text=Halo%20Admin%20{{ urlencode($storeName) }}%2C%20saya%20ingin%20melihat%20katalog%20lengkap%20produk%20kurma%20yang%20tersedia.%20Mohon%20kirimkan%20daftar%20harganya%20ya%20kak%20%F0%9F%99%8F"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center gap-2 border-2 border-emerald-900 text-emerald-900 hover:bg-emerald-900 hover:text-white font-bold text-base px-8 py-3.5 rounded-2xl transition-all duration-300 min-h-[52px]"
          >
            Lihat Katalog Lengkap
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
          </a>
        </div>
      </div>
    </section>

    {{-- ============================================================
         TESTIMONIALS
    ============================================================ --}}
    <section class="py-20 bg-emerald-950 overflow-hidden relative">
      <div class="absolute top-0 left-0 w-72 h-72 bg-emerald-800/30 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
      <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-800/20 rounded-full translate-x-1/2 translate-y-1/2 blur-3xl"></div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-14 reveal-slide-up">
          <span class="inline-block text-yellow-400 font-bold text-sm tracking-widest uppercase mb-3">Testimoni Pelanggan</span>
          <h2 class="text-3xl sm:text-4xl font-black text-white leading-tight mb-3">Apa Kata Mereka? 💬</h2>
          <p class="text-white/60 text-base font-medium">Ribuan pelanggan puas mempercayai kami untuk kebutuhan kurma premium mereka.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @forelse($testimonials as $index => $t)
            <div class="reveal-zoom-in bg-white/5 border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition-all duration-300" style="transition-delay: {{ $index * 0.1 }}s">
              <div class="flex items-center gap-1 mb-3">
                <span class="text-yellow-400 text-sm">★★★★★</span>
              </div>
              <p class="text-white/80 text-sm font-medium leading-relaxed mb-5">{{ $t->review }}</p>
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 {{ $t->avatar_color ?? 'bg-emerald-700' }} rounded-full flex items-center justify-center flex-shrink-0">
                  <span class="text-white font-bold text-sm">{{ $t->initials }}</span>
                </div>
                <div>
                  <div class="text-white font-bold text-sm">{{ $t->name }}</div>
                  <div class="text-white/50 text-xs">Pelanggan · {{ $t->location }}</div>
                </div>
              </div>
            </div>
          @empty
            <div class="col-span-full py-10 text-center text-white/40">
              <p class="font-medium">Belum ada testimoni saat ini.</p>
            </div>
          @endforelse
        </div>
      </div>
    </section>

    {{-- ============================================================
         CTA BANNER
    ============================================================ --}}
    <section class="py-20 bg-white relative overflow-hidden border-y border-emerald-100/50 shimmer-sweep">
      {{-- Decorative sparkling animated green glows --}}
      <div class="absolute -top-12 -left-12 w-80 h-80 bg-emerald-400/40 rounded-full blur-3xl pointer-events-none animate-float-glow-1"></div>
      <div class="absolute -bottom-12 -right-12 w-80 h-80 bg-emerald-300/30 rounded-full blur-3xl pointer-events-none animate-float-glow-2"></div>

      <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center relative z-10 reveal-zoom-in">
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-emerald-950 mb-4 leading-tight">
          {!! nl2br(e($ctaHeadline)) !!}
        </h2>
        @if($ctaSub)
          <p class="text-emerald-900/70 text-base sm:text-lg font-medium mb-8 max-w-2xl mx-auto">
            {!! nl2br(e($ctaSub)) !!}
          </p>
        @endif
        <a
          id="cta-banner-wa"
          href="https://wa.me/{{ $waNumClean }}?text=Halo%20Admin%20{{ urlencode($storeName) }}%21%20Saya%20ingin%20order%20kurma%20premium.%20Mohon%20bantu%20rekomendasikan%20produk%20yang%20cocok%20%F0%9F%99%8F"
          target="_blank"
          rel="noopener noreferrer"
          class="inline-flex items-center gap-3 bg-emerald-900 hover:bg-emerald-800 text-white font-extrabold text-lg px-10 py-5 rounded-2xl shadow-xl hover:shadow-emerald-900/10 transition-all duration-300 hover:scale-105 min-h-[60px]"
        >
          <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
          </svg>
          Chat WhatsApp Sekarang
        </a>
        <p class="text-emerald-900/60 text-sm font-medium mt-4">⚡ Biasanya dibalas dalam 5 menit · Jam Operasional Toko</p>
      </div>
    </section>

    {{-- ============================================================
         CONTACT SECTION
    ============================================================ --}}
    <section id="kontak" class="py-20 lg:py-28 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-14 reveal-slide-up">
          <span class="inline-block text-emerald-700 font-bold text-sm tracking-widest uppercase mb-3">Hubungi Kami</span>
          <h2 class="text-3xl sm:text-4xl font-black text-emerald-950 leading-tight mb-3">Hubungi & Temukan Kami 📍</h2>
          <p class="text-gray-500 text-base font-medium">Kirimkan pesan Anda langsung melalui form di bawah ini atau kunjungi toko kami.</p>
        </div>

        {{-- Contact Grid with Form --}}
        <div class="grid lg:grid-cols-12 gap-10 lg:gap-16 items-start mb-16">

          {{-- Left Column: Contact info (col-span-5) --}}
          <div class="lg:col-span-5 reveal-slide-right space-y-5">
            @if(!empty($branches))
              <div class="space-y-4">
                <div class="font-extrabold text-emerald-950 text-lg flex items-center justify-between border-b border-slate-100 pb-2.5 flex-wrap gap-2">
                  <div class="flex items-center gap-2">
                    <span>📍</span> Cabang Resmi Toko Kami
                  </div>
                  {{-- Navigation Buttons for Branch Swiper --}}
                  <div class="flex items-center gap-1.5 z-10">
                    <button class="branch-prev-btn w-9 h-9 bg-white text-emerald-900 border border-emerald-100 hover:bg-emerald-900 hover:text-white rounded-xl flex items-center justify-center shadow-sm transition-all duration-200 cursor-pointer" aria-label="Sebelumnya">
                      <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                      </svg>
                    </button>
                    <button class="branch-next-btn w-9 h-9 bg-white text-emerald-900 border border-emerald-100 hover:bg-emerald-900 hover:text-white rounded-xl flex items-center justify-center shadow-sm transition-all duration-200 cursor-pointer" aria-label="Selanjutnya">
                      <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                      </svg>
                    </button>
                  </div>
                </div>
                
                {{-- Swiper Slider for Branches --}}
                <div class="swiper branchSwiper rounded-2xl overflow-hidden pb-8 relative">
                  <div class="swiper-wrapper">
                    @foreach($branches as $index => $branch)
                      @php
                        $branchWaClean = preg_replace('/\D/', '', $branch['wa_number'] ?? '');
                      @endphp
                      <div class="swiper-slide h-auto">
                        <div class="branch-card bg-slate-50 border border-slate-100 rounded-2xl p-5 space-y-4 hover:border-emerald-200 hover:bg-emerald-50/10 transition-all duration-200 group relative flex flex-col justify-between h-full">
                          <div class="space-y-4">
                            <div class="flex justify-between items-start gap-2">
                              <h4 class="font-extrabold text-emerald-950 text-base group-hover:text-emerald-800 transition-colors">
                                {{ $branch['name'] }}
                              </h4>
                              <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-800 text-2xs font-extrabold flex items-center justify-center flex-shrink-0">
                                {{ $index + 1 }}
                              </span>
                            </div>
                            <p class="text-gray-600 font-semibold text-xs leading-relaxed line-clamp-3">
                              {{ $branch['address'] }}
                            </p>
                          </div>

                          <div class="flex flex-wrap gap-2 pt-3 border-t border-slate-100/50 mt-4">
                            @if(!empty($branch['wa_number']))
                              <a href="https://wa.me/{{ $branchWaClean }}" target="_blank" rel="noopener noreferrer" 
                                 class="flex-1 min-w-[100px] bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs px-3 py-2.5 rounded-xl transition-all text-center flex items-center justify-center gap-1.5 shadow-sm hover:shadow">
                                <span>💬</span> WhatsApp
                              </a>
                            @endif
                            @php
                              $resolvedMapUrl = !empty($branch['maps_embed_url']) && str_contains($branch['maps_embed_url'], 'embed')
                                ? $branch['maps_embed_url']
                                : (!empty($branch['address']) ? "https://maps.google.com/maps?q=" . urlencode($branch['name'] . ' ' . $branch['address']) . "&t=&z=15&ie=UTF8&iwloc=&output=embed" : $mapsEmbedUrl);
                            @endphp
                            <button type="button" 
                                    onclick="changeActiveMap('{{ $resolvedMapUrl }}', '{{ addslashes($branch['name']) }}')"
                                    class="flex-1 min-w-[100px] bg-white border border-slate-200 hover:border-emerald-500 hover:text-emerald-700 text-gray-700 font-bold text-xs px-3 py-2.5 rounded-xl transition-all text-center flex items-center justify-center gap-1.5 shadow-sm cursor-pointer">
                              <span>🗺️</span> Lihat Peta
                            </button>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                  {{-- Pagination --}}
                  <div class="swiper-pagination branch-swiper-pagination !bottom-0"></div>
                </div>

                {{-- Other General Info --}}
                <div class="grid grid-cols-2 gap-3 pt-3">
                  <div class="flex items-start gap-3 bg-slate-50 rounded-2xl p-4 border border-slate-100">
                    <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0 text-lg">
                      🛵
                    </div>
                    <div class="min-w-0">
                      <div class="font-extrabold text-emerald-950 text-xs mb-0.5">Pengiriman</div>
                      <div class="text-gray-600 font-semibold text-3xs leading-snug line-clamp-3">{!! nl2br(e($shippingInfo)) !!}</div>
                    </div>
                  </div>

                  <div class="flex items-start gap-3 bg-slate-50 rounded-2xl p-4 border border-slate-100">
                    <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0 text-lg">
                      🕐
                    </div>
                    <div class="min-w-0">
                      <div class="font-extrabold text-emerald-950 text-xs mb-0.5">Operasional</div>
                      <div class="text-gray-600 font-semibold text-3xs leading-snug line-clamp-3">{{ $hoursVal }}</div>
                    </div>
                  </div>
                </div>
              </div>
            @else
              {{-- Fallback: Old Layout for single address --}}
              <div class="flex items-start gap-4 bg-slate-50 rounded-2xl p-5 border border-slate-100">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                  <span class="text-2xl">📍</span>
                </div>
                <div>
                  <div class="font-extrabold text-emerald-950 text-base mb-1">Alamat Toko</div>
                  <div class="text-gray-600 font-medium text-sm leading-relaxed">{!! nl2br(e($addressVal)) !!}</div>
                </div>
              </div>

              <div class="flex items-start gap-4 bg-slate-50 rounded-2xl p-5 border border-slate-100">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                  <span class="text-2xl">📱</span>
                </div>
                <div>
                  <div class="font-extrabold text-emerald-950 text-base mb-1">WhatsApp / Telepon</div>
                  <div class="text-gray-600 font-medium text-sm leading-relaxed">
                    <a href="https://wa.me/{{ $waNumClean }}" class="text-emerald-700 font-bold hover:text-emerald-900 transition-colors">+{{ $settings['wa_number'] ?? '6281234567890' }}</a>
                    <br/><span class="text-gray-400 text-xs">Senin – Sabtu: 08.00 – 20.00 WIB</span>
                  </div>
                </div>
              </div>

              <div class="flex items-start gap-4 bg-slate-50 rounded-2xl p-5 border border-slate-100">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                  <span class="text-2xl">🛵</span>
                </div>
                <div>
                  <div class="font-extrabold text-emerald-950 text-base mb-1">Layanan Pengiriman</div>
                  <div class="text-gray-600 font-medium text-sm leading-relaxed">{!! nl2br(e($shippingInfo)) !!}</div>
                </div>
              </div>

              <div class="flex items-start gap-4 bg-slate-50 rounded-2xl p-5 border border-slate-100">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                  <span class="text-2xl">🕐</span>
                </div>
                <div>
                  <div class="font-extrabold text-emerald-950 text-base mb-1">Jam Operasional</div>
                  <div class="text-gray-600 font-medium text-sm leading-relaxed">
                    {{ $hoursVal }}
                    <br/><span class="text-red-500 font-semibold text-xs mt-1 block">Minggu: Libur (Pelayanan Online Saja)</span>
                  </div>
                </div>
              </div>
            @endif
          </div>

          {{-- Right Column: Beautiful Contact Form (col-span-7) --}}
          <div class="lg:col-span-7 reveal-slide-left" style="transition-delay: 0.15s">
            <form action="{{ route('contact.store') }}#kontak" method="POST" class="bg-gradient-to-br from-emerald-50 to-white border border-emerald-100 rounded-3xl p-6 sm:p-8 space-y-4 shadow-sm">
              @csrf
              <h3 class="font-extrabold text-emerald-950 text-lg mb-2">Form Hubungi Kami</h3>
              
              @if(session('success'))
                <div class="bg-emerald-100 border border-emerald-200 text-emerald-800 rounded-xl p-4 text-sm font-bold flex items-center gap-2.5">
                  <span class="text-lg">✓</span>
                  <span>{{ session('success') }}</span>
                </div>
              @endif

              @if($errors->any())
                <div class="bg-red-50 border border-red-100 text-red-700 rounded-xl p-4 text-sm font-semibold space-y-1">
                  @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                  @endforeach
                </div>
              @endif

              <div>
                <label for="contact_name" class="block text-gray-700 font-bold text-sm mb-1.5">Nama Lengkap</label>
                <input type="text" id="contact_name" name="name" required placeholder="Ahmad Hidayat" value="{{ old('name') }}"
                       class="w-full bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800">
              </div>

              <div>
                <label for="contact_phone" class="block text-gray-700 font-bold text-sm mb-1.5">Nomor HP / WhatsApp (Opsional)</label>
                <input type="tel" id="contact_phone" name="phone" placeholder="081234567890" value="{{ old('phone') }}"
                       class="w-full bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800">
              </div>

              <div>
                <label for="contact_message" class="block text-gray-700 font-bold text-sm mb-1.5">Pesan Anda</label>
                <textarea id="contact_message" name="message" rows="4" required placeholder="Tuliskan pertanyaan, konsultasi, atau detail pemesanan Anda..."
                          class="w-full bg-white border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm transition-all outline-none font-medium text-gray-800">{{ old('message') }}</textarea>
              </div>

              <button type="submit"
                      class="w-full bg-emerald-900 hover:bg-emerald-800 text-white font-extrabold text-sm px-6 py-4 rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 min-h-[48px]">
                <span>✉️</span>
                <span>Kirim Pesan Sekarang</span>
              </button>
            </form>
          </div>
        </div>

        {{-- Map Full Width --}}
        <div class="reveal">
          <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200 aspect-[16/9] md:aspect-[21/9] bg-slate-100 min-h-[350px]">
            <iframe
              id="active-store-map"
              src="{{ !empty($branches) ? (!empty($branches[0]['maps_embed_url']) && str_contains($branches[0]['maps_embed_url'], 'embed') ? $branches[0]['maps_embed_url'] : (!empty($branches[0]['address']) ? 'https://maps.google.com/maps?q=' . urlencode($branches[0]['name'] . ' ' . $branches[0]['address']) . '&t=&z=15&ie=UTF8&iwloc=&output=embed' : $mapsEmbedUrl)) : $mapsEmbedUrl }}"
              width="100%"
              height="100%"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              title="Lokasi {{ !empty($branches) ? $branches[0]['name'] : $storeName }}"
            ></iframe>
          </div>
          <div class="mt-4 text-center">
            <a
              id="active-store-map-link"
              href="https://www.google.com/maps/search/?api=1&query={{ urlencode(!empty($branches) ? $branches[0]['name'] : $storeName) }}"
              target="_blank"
              rel="noopener noreferrer"
              class="inline-flex items-center gap-2 text-emerald-700 hover:text-emerald-900 font-bold text-sm transition-colors"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
              </svg>
              <span id="active-store-map-text">Buka di Google Maps ({{ !empty($branches) ? $branches[0]['name'] : $storeName }})</span>
            </a>
          </div>
        </div>
      </div>
    </section>

  </main>

  {{-- ============================================================
       FOOTER
  ============================================================ --}}
  <footer class="bg-emerald-950 text-white pt-14 pb-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">

        {{-- Brand --}}
        <div class="sm:col-span-2 lg:col-span-1">
          <div class="flex items-center gap-2.5 mb-4">
            @if(!empty($settings['store_logo']))
              <div class="inline-flex items-center justify-center h-12 px-3.5 bg-white border border-gray-100 rounded-xl shadow-sm mb-0.5">
                <img src="{{ $settings['store_logo'] }}" alt="{{ $storeName }}" class="h-9 w-auto object-contain">
              </div>
            @else
              <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-xl flex items-center justify-center">
                <span class="text-emerald-950 font-black text-xl">🌴</span>
              </div>
              <div>
                <div class="font-extrabold text-white text-base leading-tight">{{ $storeName }}</div>
                <div class="text-yellow-400 font-semibold text-xs">Cianjur · Est. 2015</div>
              </div>
            @endif
          </div>
          <p class="text-white/60 text-sm font-medium leading-relaxed mb-5">
            Menghadirkan kurma impor berkualitas terbaik dengan harga terjangkau. Terpercaya, higienis, dan selalu fresh.
          </p>
          <div class="flex gap-3">
            <a href="https://wa.me/{{ $waNumClean }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"
               class="w-9 h-9 bg-white/10 hover:bg-green-500 rounded-lg flex items-center justify-center transition-colors duration-200">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            </a>
            <a href="{{ $instagramVal }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"
               class="w-9 h-9 bg-white/10 hover:bg-pink-600 rounded-lg flex items-center justify-center transition-colors duration-200">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            </a>
            <a href="{{ $facebookVal }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"
               class="w-9 h-9 bg-white/10 hover:bg-blue-600 rounded-lg flex items-center justify-center transition-colors duration-200">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
          </div>
        </div>

        {{-- Quick Links --}}
        <div>
          <h4 class="font-extrabold text-white text-sm uppercase tracking-wider mb-4">Navigasi</h4>
          <ul class="space-y-2.5">
            @foreach(['beranda' => 'Beranda', 'tentang' => 'Tentang Kami', 'produk' => 'Produk Unggulan', 'kontak' => 'Hubungi Kami'] as $anchor => $label)
              <li><a href="#{{ $anchor }}" class="text-white/60 hover:text-yellow-400 font-medium text-sm transition-colors">{{ $label }}</a></li>
            @endforeach
          </ul>
        </div>

        <div>
          <h4 class="font-extrabold text-white text-sm uppercase tracking-wider mb-4">Varian Favorit</h4>
          <ul class="space-y-2.5">
            @if(!empty($products) && count($products) > 0)
              @foreach($products->take(5) as $product)
                <li><a href="#produk" class="text-white/60 hover:text-yellow-400 font-medium text-sm transition-colors">{{ $product->name }}</a></li>
              @endforeach
            @else
              @foreach(['Kurma Sukari Premium', 'Kurma Medjool Jumbo', 'Kurma Ajwa Madinah', 'Kurma Deglet Nour', 'Hampers Kurma Mix'] as $p)
                <li><span class="text-white/60 font-medium text-sm">{{ $p }}</span></li>
              @endforeach
            @endif
          </ul>
        </div>

        {{-- Contact --}}
        <div>
          <h4 class="font-extrabold text-white text-sm uppercase tracking-wider mb-4">Hubungi Kami</h4>
          <ul class="space-y-3">
            <li class="flex items-start gap-2">
              <span class="text-yellow-400 flex-shrink-0 mt-0.5">📍</span>
              <span class="text-white/60 font-medium text-sm">{{ $addressVal }}</span>
            </li>
            <li class="flex items-center gap-2">
              <span class="text-yellow-400 flex-shrink-0">📱</span>
              <a href="https://wa.me/{{ $waNumClean }}" class="text-white/60 hover:text-yellow-400 font-medium text-sm transition-colors">+{{ $settings['wa_number'] ?? '6281234567890' }}</a>
            </li>
            <li class="flex items-center gap-2">
              <span class="text-yellow-400 flex-shrink-0">🕐</span>
              <span class="text-white/60 font-medium text-sm">{{ $hoursVal }}</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="border-t border-white/10 pt-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
          <p class="text-white/40 text-xs font-medium text-center sm:text-left">
            © {{ date('Y') }} {{ $storeName }}. Seluruh hak cipta dilindungi.
          </p>
          <div class="flex items-center gap-2">
            <span class="text-white/40 text-xs">Dibuat dengan</span>
            <span class="text-red-400 text-sm">❤️</span>
            <span class="text-white/40 text-xs">untuk pelanggan setia kami</span>
          </div>
        </div>
      </div>
    </div>
  </footer>

  {{-- ============================================================
       FLOATING WHATSAPP BUTTON
  ============================================================ --}}
  <a
    id="wa-float-btn"
    href="https://wa.me/{{ $waNumClean }}?text=Halo%20Admin%20{{ urlencode($storeName) }}%21%20Saya%20ingin%20bertanya%20tentang%20produk%20kurma%20yang%20tersedia.%20Bisa%20bantu%20saya%3F%20%F0%9F%99%8F"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Chat WhatsApp"
    class="wa-float fixed bottom-6 right-4 sm:right-6 z-50 flex items-center gap-3 bg-green-500 hover:bg-green-400 text-white font-bold pl-4 pr-5 py-3.5 rounded-full shadow-2xl transition-all duration-300 hover:scale-105"
  >
    <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
    <span class="text-sm hidden sm:block">Chat Sekarang</span>
  </a>

  <!-- Swiper JS CDN -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  {{-- ============================================================
       JAVASCRIPT
  ============================================================ --}}
  <script>
    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 40);
    });

    // Mobile menu
    function toggleMenu() {
      const menu    = document.getElementById('mobile-menu');
      const iconO   = document.getElementById('icon-menu');
      const iconX   = document.getElementById('icon-close');
      const isOpen  = menu.classList.toggle('open');
      iconO.classList.toggle('hidden', isOpen);
      iconX.classList.toggle('hidden', !isOpen);
    }
    function closeMenu() {
      const menu  = document.getElementById('mobile-menu');
      menu.classList.remove('open');
      document.getElementById('icon-menu').classList.remove('hidden');
      document.getElementById('icon-close').classList.add('hidden');
    }
    document.addEventListener('click', (e) => {
      const btn  = document.getElementById('hamburger');
      const menu = document.getElementById('mobile-menu');
      if (!btn.contains(e.target) && !menu.contains(e.target)) closeMenu();
    });

    // Modern Scroll Reveal Observer
    const revealObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target); // Unobserve to lock state and optimize browser performance
        }
      });
    }, { threshold: 0.05, rootMargin: '0px 0px -80px 0px' });
    document.querySelectorAll('.reveal, [class*="reveal-"]').forEach(el => revealObserver.observe(el));

    // Active nav highlight
    const sections  = document.querySelectorAll('section[id]');
    const navLinks  = document.querySelectorAll('nav a.nav-link');
    window.addEventListener('scroll', () => {
      let current = '';
      sections.forEach(s => {
        if (window.scrollY >= s.offsetTop - 80) current = s.id;
      });
      navLinks.forEach(link => {
        const active = link.getAttribute('href') === `#${current}`;
        link.classList.toggle('text-yellow-400', active);
        link.classList.toggle('text-white/80', !active);
      });
    });

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(a => {
      a.addEventListener('click', e => {
        // Skip default anchor action unless it targets page element
        const href = a.getAttribute('href');
        if (href.startsWith('#')) {
          const t = document.querySelector(href);
          if (t) {
            e.preventDefault();
            t.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
        }
      });
    });

    // Initialize Swiper for Product Catalog
    const productSwiper = new Swiper('.productSwiper', {
      slidesPerView: 1,
      spaceBetween: 24,
      grabCursor: true,
      loop: {{ count($products) > 3 ? 'true' : 'false' }},
      speed: 1000, /* Slower, highly luxurious weighted slide transitions */
      watchSlidesProgress: true,
      parallax: true,
      keyboard: {
        enabled: true,
        onlyInViewport: true,
      },
      mousewheel: {
        forceToAxis: true,
      },
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-next-btn',
        prevEl: '.swiper-prev-btn',
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 24,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30,
        }
      }
    });

    // Initialize Swiper for Branch Locations
    const branchSwiper = new Swiper('.branchSwiper', {
      slidesPerView: 1,
      spaceBetween: 16,
      grabCursor: true,
      pagination: {
        el: '.branch-swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.branch-next-btn',
        prevEl: '.branch-prev-btn',
      },
    });

    // Change Active Map for branches
    window.changeActiveMap = function(embedUrl, name) {
      const mapFrame = document.getElementById('active-store-map');
      const mapLink = document.getElementById('active-store-map-link');
      const mapText = document.getElementById('active-store-map-text');
      
      if (mapFrame) {
        mapFrame.src = embedUrl;
        mapFrame.title = "Lokasi " + name;
      }
      if (mapText) {
        mapText.textContent = "Buka di Google Maps (" + name + ")";
      }
      if (mapLink) {
        mapLink.href = "https://www.google.com/maps/search/?api=1&query=" + encodeURIComponent(name);
      }
      
      // Smooth scroll to map frame
      const mapContainer = mapFrame.closest('.reveal');
      if (mapContainer) {
        mapContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
    };
  </script>

</body>
</html>
