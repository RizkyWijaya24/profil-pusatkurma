<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Admin') — Pusat Kurma Premium</title>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>* { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="h-full bg-gray-50">

<div class="flex h-screen overflow-hidden">

  {{-- ── SIDEBAR ──────────────────────────────────────── --}}
  <aside id="sidebar" class="w-64 bg-emerald-900 flex flex-col flex-shrink-0 transition-all duration-300">
    {{-- Logo --}}
    <div class="flex items-center gap-3 px-5 py-5 border-b border-emerald-800">
      <div class="w-9 h-9 bg-yellow-400 rounded-lg flex items-center justify-center flex-shrink-0">
        <span class="text-emerald-900 font-black text-lg">🌴</span>
      </div>
      <div>
        <div class="text-white font-extrabold text-sm leading-tight">Admin Panel</div>
        <div class="text-yellow-400 text-xs font-semibold">Pusat Kurma Premium</div>
      </div>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
      @php
        $navItems = [
          ['route' => 'admin.dashboard',          'icon' => '📊', 'label' => 'Dashboard'],
          ['route' => 'admin.products.index',      'icon' => '🌴', 'label' => 'Produk'],
          ['route' => 'admin.testimonials.index',  'icon' => '💬', 'label' => 'Testimoni'],
          ['route' => 'admin.contacts.index',      'icon' => '📩', 'label' => 'Pesan Masuk'],
          ['route' => 'admin.settings.index',      'icon' => '⚙️', 'label' => 'Pengaturan'],
        ];
      @endphp
      @foreach($navItems as $item)
        @php $active = request()->routeIs($item['route']) || request()->routeIs($item['route'].'*'); @endphp
        <a href="{{ route($item['route']) }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                  {{ $active
                      ? 'bg-yellow-400 text-emerald-900 font-bold shadow-md'
                      : 'text-white/70 hover:bg-emerald-800 hover:text-white' }}">
          <span class="text-base">{{ $item['icon'] }}</span>
          <span>{{ $item['label'] }}</span>
          @if($item['route'] === 'admin.contacts.index')
            @php $unread = \App\Models\Contact::unread()->count(); @endphp
            @if($unread > 0)
              <span class="ml-auto bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">{{ $unread }}</span>
            @endif
          @endif
        </a>
      @endforeach
    </nav>

    {{-- Footer --}}
    <div class="px-3 py-4 border-t border-emerald-800">
      <div class="flex items-center gap-3 px-3 py-2 mb-2">
        <div class="w-8 h-8 bg-emerald-700 rounded-full flex items-center justify-center flex-shrink-0">
          <span class="text-white font-bold text-xs">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
        </div>
        <div class="min-w-0">
          <div class="text-white font-semibold text-xs truncate">{{ auth()->user()->name }}</div>
          <div class="text-white/50 text-xs truncate">{{ auth()->user()->email }}</div>
        </div>
      </div>
      <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit"
          class="w-full flex items-center gap-2 px-3 py-2 rounded-xl text-white/70 hover:bg-red-500/20 hover:text-red-300 text-sm font-medium transition-colors">
          <span>🚪</span> Keluar
        </button>
      </form>
      <a href="{{ route('home') }}" target="_blank"
         class="mt-1 w-full flex items-center gap-2 px-3 py-2 rounded-xl text-white/70 hover:bg-emerald-800 hover:text-white text-sm font-medium transition-colors">
        <span>🌐</span> Lihat Website
      </a>
    </div>
  </aside>

  {{-- ── MAIN CONTENT ─────────────────────────────────── --}}
  <div class="flex-1 flex flex-col overflow-hidden">
    {{-- Top bar --}}
    <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between flex-shrink-0">
      <div>
        <h1 class="text-lg font-extrabold text-gray-900">@yield('page-title', 'Dashboard')</h1>
        <p class="text-gray-400 text-xs font-medium mt-0.5">@yield('page-desc', 'Kelola website Anda')</p>
      </div>
      <div class="flex items-center gap-3">
        @if(session('success'))
          <div class="flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold px-3 py-1.5 rounded-lg">
            <span>✓</span> {{ session('success') }}
          </div>
        @endif
        @yield('header-actions')
      </div>
    </header>

    {{-- Content --}}
    <main class="flex-1 overflow-y-auto p-6">
      @yield('content')
    </main>
  </div>
</div>

@stack('scripts')
</body>
</html>
