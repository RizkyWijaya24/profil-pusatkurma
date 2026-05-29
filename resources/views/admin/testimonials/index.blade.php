@extends('admin.layouts.app')
@section('title', 'Testimoni')
@section('page-title', '💬 Manajemen Testimoni')
@section('page-desc', 'Kelola ulasan pelanggan yang tampil di website')

@section('header-actions')
  <a href="{{ route('admin.testimonials.create') }}"
     class="inline-flex items-center gap-2 bg-emerald-900 hover:bg-emerald-800 text-white font-bold text-sm px-4 py-2 rounded-xl transition-colors">
    ➕ Tambah Testimoni
  </a>
@endsection

@section('content')
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
  @forelse($testimonials as $t)
    <div class="bg-white rounded-2xl border border-gray-100 p-5 flex flex-col gap-4">
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 {{ $t->avatar_color }} rounded-full flex items-center justify-center flex-shrink-0">
            <span class="text-white font-bold text-sm">{{ $t->initials }}</span>
          </div>
          <div>
            <div class="font-bold text-gray-900 text-sm">{{ $t->name }}</div>
            <div class="text-gray-400 text-xs">{{ $t->location }}</div>
          </div>
        </div>
        @if($t->is_active)
          <span class="bg-emerald-100 text-emerald-700 font-semibold text-xs px-2 py-0.5 rounded-full">Aktif</span>
        @else
          <span class="bg-gray-100 text-gray-500 font-semibold text-xs px-2 py-0.5 rounded-full">Nonaktif</span>
        @endif
      </div>
      <p class="text-gray-500 text-sm leading-relaxed flex-1 italic">{{ Str::limit($t->review, 120) }}</p>
      <div class="flex items-center gap-2 pt-2 border-t border-gray-50">
        <a href="{{ route('admin.testimonials.edit', $t) }}"
           class="flex-1 text-center bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold text-xs py-1.5 rounded-lg transition-colors">Edit</a>
        <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST"
              onsubmit="return confirm('Hapus testimoni ini?')" class="flex-1">
          @csrf @method('DELETE')
          <button type="submit"
            class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-semibold text-xs py-1.5 rounded-lg transition-colors">Hapus</button>
        </form>
      </div>
    </div>
  @empty
    <div class="col-span-3 bg-white rounded-2xl border border-gray-100 py-16 text-center text-gray-400">
      <div class="text-4xl mb-2">💬</div>
      <div class="font-semibold">Belum ada testimoni</div>
      <a href="{{ route('admin.testimonials.create') }}" class="text-emerald-700 text-sm hover:underline mt-1 inline-block">Tambah testimoni pertama</a>
    </div>
  @endforelse
</div>
@endsection
