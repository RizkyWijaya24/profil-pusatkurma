@extends('admin.layouts.app')
@section('title', 'Tambah Produk')
@section('page-title', '➕ Tambah Produk Baru')
@section('page-desc', 'Isi detail produk yang akan ditampilkan di website')

@section('header-actions')
  <a href="{{ route('admin.products.index') }}" class="text-gray-500 hover:text-gray-700 font-semibold text-sm">← Kembali</a>
@endsection

@section('content')
<div class="bg-white rounded-2xl border border-gray-100 p-6">
  @if($errors->any())
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
      <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.products.store') }}" method="POST">
    @csrf
    @include('admin.products._form')
    <div class="flex items-center gap-3 mt-8 pt-6 border-t border-gray-100">
      <button type="submit"
        class="bg-emerald-900 hover:bg-emerald-800 text-white font-extrabold px-6 py-2.5 rounded-xl transition-colors text-sm">
        Simpan Produk
      </button>
      <a href="{{ route('admin.products.index') }}" class="text-gray-500 hover:text-gray-700 font-semibold text-sm px-4 py-2.5">Batal</a>
    </div>
  </form>
</div>
@endsection
