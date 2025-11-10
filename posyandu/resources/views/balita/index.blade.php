@extends('layouts.app')

@section('title', 'Data Balita')
@section('page-title', 'Data Balita')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6">
    <h1 class="text-2xl lg:text-3xl text-black">Data Balita</h1>
    <a href="{{ route('balita.create') }}" class="bg-sidebar text-white px-4 py-2 rounded hover:bg-blue-700 w-full sm:w-auto text-center">
        <i class="fas fa-plus mr-2"></i>Tambah Data
    </a>
</div>

<div class="bg-white overflow-x-auto rounded-lg shadow-md">
    <table class="min-w-full bg-white text-sm lg:text-base">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">No</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Nama</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Nama Ibu</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Tanggal Lahir</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Jenis Kelamin</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 divide-y divide-gray-200">
            @forelse($balita as $item)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="text-left py-3 px-4">{{ ($balita->currentPage() - 1) * $balita->perPage() + $loop->iteration }}</td>
                <td class="text-left py-3 px-4">{{ $item->nama }}</td>
                <td class="text-left py-3 px-4">{{ $item->nama_ibu }}</td>
                <td class="text-left py-3 px-4">{{ $item->tanggal_lahir->format('d/m/Y') }}</td>
                <td class="text-left py-3 px-4">{{ $item->jenis_kelamin_text }}</td>
                <td class="text-left py-3 px-4">
                    <a href="{{ route('balita.show', $item) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('balita.edit', $item) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('balita.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                        message="Tidak ada data balita"
                        actionText="Tambah data balita pertama"
                        actionUrl="{{ route('balita.create') }}"
                    />
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $balita->links() }}
</div>
@endsection

