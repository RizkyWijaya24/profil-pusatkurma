@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-desc', 'Ringkasan data toko Anda')

@section('content')
{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
  @php
    $cards = [
      ['label' => 'Total Produk',    'value' => $stats['total_products'],     'sub' => $stats['active_products'].' aktif',     'icon' => '🌴', 'color' => 'bg-emerald-50 text-emerald-700', 'border' => 'border-emerald-200'],
      ['label' => 'Testimoni',       'value' => $stats['total_testimonials'],  'sub' => 'Ulasan pelanggan',                     'icon' => '💬', 'color' => 'bg-blue-50 text-blue-700',     'border' => 'border-blue-200'],
      ['label' => 'Total Pesan',     'value' => $stats['total_contacts'],      'sub' => $stats['unread_contacts'].' belum dibaca', 'icon' => '📩', 'color' => 'bg-purple-50 text-purple-700', 'border' => 'border-purple-200'],
      ['label' => 'Pesan Baru',      'value' => $stats['unread_contacts'],     'sub' => 'Belum dibaca',                         'icon' => '🔔', 'color' => 'bg-red-50 text-red-600',       'border' => 'border-red-200'],
    ];
  @endphp
  @foreach($cards as $card)
    <div class="bg-white rounded-2xl border {{ $card['border'] }} p-5 flex items-center gap-4">
      <div class="{{ $card['color'] }} w-12 h-12 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
        {{ $card['icon'] }}
      </div>
      <div>
        <div class="text-2xl font-black text-gray-900">{{ $card['value'] }}</div>
        <div class="text-gray-500 text-xs font-medium">{{ $card['label'] }}</div>
        <div class="text-gray-400 text-xs">{{ $card['sub'] }}</div>
      </div>
    </div>
  @endforeach
</div>

{{-- Quick Actions --}}
<div class="grid lg:grid-cols-2 gap-6">
  {{-- Recent Messages --}}
  <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
      <h3 class="font-extrabold text-gray-900 text-sm">📩 Pesan Terbaru</h3>
      <a href="{{ route('admin.contacts.index') }}" class="text-emerald-700 text-xs font-semibold hover:underline">Lihat Semua</a>
    </div>
    <div class="divide-y divide-gray-50">
      @forelse($recent_contacts as $contact)
        <a href="{{ route('admin.contacts.show', $contact) }}" class="flex items-start gap-3 px-5 py-3.5 hover:bg-gray-50 transition-colors block">
          <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
            <span class="text-emerald-700 font-bold text-xs">{{ strtoupper(substr($contact->name, 0, 2)) }}</span>
          </div>
          <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2">
              <span class="font-semibold text-gray-900 text-sm">{{ $contact->name }}</span>
              @if(!$contact->is_read)
                <span class="w-2 h-2 bg-red-500 rounded-full flex-shrink-0"></span>
              @endif
            </div>
            <p class="text-gray-400 text-xs truncate mt-0.5">{{ $contact->message }}</p>
          </div>
          <span class="text-gray-300 text-xs flex-shrink-0">{{ $contact->created_at->diffForHumans() }}</span>
        </a>
      @empty
        <div class="px-5 py-8 text-center text-gray-400 text-sm">Belum ada pesan masuk</div>
      @endforelse
    </div>
  </div>

  {{-- Quick Links --}}
  <div class="bg-white rounded-2xl border border-gray-100 p-5">
    <h3 class="font-extrabold text-gray-900 text-sm mb-4">⚡ Aksi Cepat</h3>
    <div class="grid grid-cols-2 gap-3">
      <a href="{{ route('admin.products.create') }}"
         class="flex flex-col items-center gap-2 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 rounded-xl p-4 transition-colors text-center">
        <span class="text-2xl">➕</span>
        <span class="text-emerald-800 font-semibold text-xs">Tambah Produk</span>
      </a>
      <a href="{{ route('admin.testimonials.create') }}"
         class="flex flex-col items-center gap-2 bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-xl p-4 transition-colors text-center">
        <span class="text-2xl">💬</span>
        <span class="text-blue-800 font-semibold text-xs">Tambah Testimoni</span>
      </a>
      <a href="{{ route('admin.settings.index') }}"
         class="flex flex-col items-center gap-2 bg-yellow-50 hover:bg-yellow-100 border border-yellow-200 rounded-xl p-4 transition-colors text-center">
        <span class="text-2xl">⚙️</span>
        <span class="text-yellow-800 font-semibold text-xs">Pengaturan</span>
      </a>
      <a href="{{ route('home') }}" target="_blank"
         class="flex flex-col items-center gap-2 bg-purple-50 hover:bg-purple-100 border border-purple-200 rounded-xl p-4 transition-colors text-center">
        <span class="text-2xl">🌐</span>
        <span class="text-purple-800 font-semibold text-xs">Lihat Website</span>
      </a>
    </div>
  </div>
</div>
@endsection
