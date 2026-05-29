@extends('admin.layouts.app')
@section('title', 'Pesan Masuk')
@section('page-title', '📩 Pesan Masuk')
@section('page-desc', 'Kelola semua pesan dari pengunjung website')

@section('content')
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-gray-50 border-b border-gray-100">
        <tr>
          <th class="text-left px-5 py-3.5 text-gray-500 font-semibold text-xs uppercase tracking-wider">Pengirim</th>
          <th class="text-left px-5 py-3.5 text-gray-500 font-semibold text-xs uppercase tracking-wider hidden md:table-cell">No. HP</th>
          <th class="text-left px-5 py-3.5 text-gray-500 font-semibold text-xs uppercase tracking-wider">Pesan</th>
          <th class="text-left px-5 py-3.5 text-gray-500 font-semibold text-xs uppercase tracking-wider hidden lg:table-cell">Waktu</th>
          <th class="text-center px-5 py-3.5 text-gray-500 font-semibold text-xs uppercase tracking-wider">Status</th>
          <th class="text-right px-5 py-3.5 text-gray-500 font-semibold text-xs uppercase tracking-wider">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-50">
        @forelse($contacts as $contact)
          <tr class="hover:bg-gray-50 transition-colors {{ !$contact->is_read ? 'bg-emerald-50/40' : '' }}">
            <td class="px-5 py-4">
              <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                  <span class="text-emerald-700 font-bold text-xs">{{ strtoupper(substr($contact->name, 0, 2)) }}</span>
                </div>
                <div>
                  <div class="font-bold text-gray-900 flex items-center gap-1.5">
                    {{ $contact->name }}
                    @if(!$contact->is_read)
                      <span class="w-2 h-2 bg-red-500 rounded-full inline-block"></span>
                    @endif
                  </div>
                </div>
              </div>
            </td>
            <td class="px-5 py-4 text-gray-500 hidden md:table-cell">
              @if($contact->phone)
                <a href="https://wa.me/{{ preg_replace('/\D/', '', $contact->phone) }}" target="_blank"
                   class="text-emerald-700 hover:underline font-medium">{{ $contact->phone }}</a>
              @else
                <span class="text-gray-300">—</span>
              @endif
            </td>
            <td class="px-5 py-4 text-gray-500 max-w-xs">
              <p class="truncate">{{ $contact->message }}</p>
            </td>
            <td class="px-5 py-4 text-gray-400 text-xs hidden lg:table-cell">{{ $contact->created_at->format('d M Y, H:i') }}</td>
            <td class="px-5 py-4 text-center">
              @if($contact->is_read)
                <span class="bg-gray-100 text-gray-500 font-semibold text-xs px-2.5 py-1 rounded-full">Dibaca</span>
              @else
                <span class="bg-red-100 text-red-600 font-semibold text-xs px-2.5 py-1 rounded-full">Baru</span>
              @endif
            </td>
            <td class="px-5 py-4 text-right">
              <div class="flex items-center justify-end gap-2">
                <a href="{{ route('admin.contacts.show', $contact) }}"
                   class="bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold text-xs px-3 py-1.5 rounded-lg transition-colors">Lihat</a>
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST"
                      onsubmit="return confirm('Hapus pesan ini?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 font-semibold text-xs px-3 py-1.5 rounded-lg transition-colors">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="px-5 py-16 text-center text-gray-400">
              <div class="text-4xl mb-2">📩</div>
              <div class="font-semibold">Belum ada pesan masuk</div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($contacts->hasPages())
    <div class="px-5 py-4 border-t border-gray-100">
      {{ $contacts->links() }}
    </div>
  @endif
</div>
@endsection
