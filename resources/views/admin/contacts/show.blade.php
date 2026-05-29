@extends('admin.layouts.app')
@section('title', 'Detail Pesan')
@section('page-title', '📩 Detail Pesan Masuk')
@section('page-desc', 'Baca dan tindak lanjuti pesan dari pengunjung website')

@section('content')
<div class="max-w-3xl">
  {{-- Back link --}}
  <div class="mb-6">
    <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-700 hover:text-emerald-800 transition-colors">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      Kembali ke Daftar Pesan
    </a>
  </div>

  {{-- Message Card --}}
  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
    {{-- Header area --}}
    <div class="p-6 border-b border-gray-50 bg-slate-50/50 flex flex-wrap items-center justify-between gap-4">
      <div class="flex items-center gap-4">
        <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
          <span class="text-emerald-700 font-bold text-lg">{{ strtoupper(substr($contact->name, 0, 2)) }}</span>
        </div>
        <div>
          <h3 class="font-extrabold text-gray-900 text-lg leading-tight">{{ $contact->name }}</h3>
          <p class="text-gray-400 text-xs mt-1">Diterima: {{ $contact->created_at->format('d M Y, H:i') }} ({{ $contact->created_at->diffForHumans() }})</p>
        </div>
      </div>
      <div>
        @if($contact->is_read)
          <span class="bg-gray-100 text-gray-500 font-bold text-xs px-3 py-1.5 rounded-full inline-block">Sudah Dibaca</span>
        @else
          <span class="bg-red-100 text-red-600 font-bold text-xs px-3 py-1.5 rounded-full inline-block animate-pulse">Pesan Baru</span>
        @endif
      </div>
    </div>

    {{-- Info Grid --}}
    <div class="p-6 border-b border-gray-50 grid sm:grid-cols-2 gap-4 text-sm">
      <div>
        <span class="block text-gray-400 font-medium text-xs uppercase mb-1">Nama Pengirim</span>
        <span class="font-bold text-gray-800">{{ $contact->name }}</span>
      </div>
      <div>
        <span class="block text-gray-400 font-medium text-xs uppercase mb-1">Nomor Handphone / WhatsApp</span>
        @if($contact->phone)
          <div class="flex items-center gap-2">
            <a href="https://wa.me/{{ preg_replace('/\D/', '', $contact->phone) }}" target="_blank" class="font-bold text-emerald-700 hover:underline inline-flex items-center gap-1.5">
              {{ $contact->phone }}
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
              </svg>
            </a>
          </div>
        @else
          <span class="text-gray-400">—</span>
        @endif
      </div>
    </div>

    {{-- Content area --}}
    <div class="p-6">
      <span class="block text-gray-400 font-medium text-xs uppercase mb-3">Isi Pesan</span>
      <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 text-gray-700 leading-relaxed whitespace-pre-wrap font-medium text-sm">
        {{ $contact->message }}
      </div>
    </div>
  </div>

  {{-- Actions bar --}}
  <div class="flex flex-wrap items-center justify-between gap-4">
    <div>
      <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
        @csrf @method('DELETE')
        <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 font-extrabold text-sm px-5 py-3 rounded-xl transition-colors">
          🗑️ Hapus Pesan Ini
        </button>
      </form>
    </div>
    
    @if($contact->phone)
      <div>
        <a href="https://wa.me/{{ preg_replace('/\D/', '', $contact->phone) }}?text=Halo%20{{ urlencode($contact->name) }}%2C%20terima%20kasih%20telah%20menghubungi%20Pusat%20Kurma%20Premium%20Cianjur.%20Menanggapi%20pesan%20Anda%3A%20" 
           target="_blank" 
           class="inline-flex items-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white font-extrabold text-sm px-6 py-3 rounded-xl shadow-lg transition-colors">
          <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
          </svg>
          Balas via WhatsApp
        </a>
      </div>
    @endif
  </div>
</div>
@endsection
