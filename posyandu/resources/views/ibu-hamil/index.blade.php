@extends('layouts.app')

@section('title', 'Data Ibu Hamil')
@section('page-title', 'Data Ibu Hamil')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6">
    <h1 class="text-2xl lg:text-3xl text-black">Data Ibu Hamil</h1>
    <a href="{{ route('ibu-hamil.create') }}" class="bg-sidebar text-white px-4 py-2 rounded hover:bg-blue-700 w-full sm:w-auto text-center">
        <i class="fas fa-plus mr-2"></i>Tambah Data
    </a>
</div>

<div class="bg-white overflow-x-auto rounded-lg shadow-md">
    <table class="min-w-full bg-white text-sm lg:text-base">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">No</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Nama</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Nama Suami</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">HPHT</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Alamat</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 divide-y divide-gray-200">
            @forelse($ibuHamil as $item)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="text-left py-3 px-4">{{ ($ibuHamil->currentPage() - 1) * $ibuHamil->perPage() + $loop->iteration }}</td>
                <td class="text-left py-3 px-4">{{ $item->nama }}</td>
                <td class="text-left py-3 px-4">{{ $item->nama_suami ?? '-' }}</td>
                <td class="text-left py-3 px-4">{{ $item->hpht->format('d/m/Y') }}</td>
                <td class="text-left py-3 px-4">{{ \Illuminate\Support\Str::limit($item->alamat, 30) }}</td>
                <td class="text-left py-3 px-4">
                    <a href="{{ route('ibu-hamil.show', $item) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('ibu-hamil.edit', $item) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('ibu-hamil.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                        message="Tidak ada data ibu hamil"
                        actionText="Tambah data ibu hamil pertama"
                        actionUrl="{{ route('ibu-hamil.create') }}"
                    />
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $ibuHamil->links() }}
</div>
@endsection

