@extends('layouts.app')

@section('title', 'Jadwal Kegiatan')
@section('page-title', 'Jadwal Kegiatan')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6">
    <h1 class="text-2xl lg:text-3xl text-black">Jadwal Kegiatan</h1>
    <a href="{{ route('jadwal.create') }}" class="bg-sidebar text-white px-4 py-2 rounded hover:bg-blue-700 w-full sm:w-auto text-center">
        <i class="fas fa-plus mr-2"></i>Tambah Jadwal
    </a>
</div>

<div class="bg-white overflow-x-auto rounded-lg shadow-md">
    <table class="min-w-full bg-white text-sm lg:text-base">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">No</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Nama Kegiatan</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Tanggal</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Waktu</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Lokasi</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 divide-y divide-gray-200">
            @forelse($jadwal as $item)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="text-left py-3 px-4">{{ ($jadwal->currentPage() - 1) * $jadwal->perPage() + $loop->iteration }}</td>
                <td class="text-left py-3 px-4">{{ $item->nama_kegiatan }}</td>
                <td class="text-left py-3 px-4">{{ $item->tanggal->format('d/m/Y') }}</td>
                <td class="text-left py-3 px-4">{{ $item->waktu }}</td>
                <td class="text-left py-3 px-4">{{ $item->lokasi }}</td>
                <td class="text-left py-3 px-4">
                    <a href="{{ route('jadwal.show', $item) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('jadwal.edit', $item) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('jadwal.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">
                    <x-empty-state 
                        message="Tidak ada jadwal kegiatan"
                        actionText="Tambah jadwal pertama"
                        actionUrl="{{ route('jadwal.create') }}"
                        icon="calendar"
                    />
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $jadwal->links() }}
</div>
@endsection

