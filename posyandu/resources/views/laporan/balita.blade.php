@extends('layouts.app')

@section('title', 'Laporan Data Balita')
@section('page-title', 'Laporan Data Balita')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6">
    <h1 class="text-2xl lg:text-3xl text-black">Laporan Data Balita</h1>
    <button onclick="window.print()" class="bg-sidebar text-white px-4 py-2 rounded hover:bg-blue-700 w-full sm:w-auto text-center">
        <i class="fas fa-print mr-2"></i>Cetak
    </button>
</div>

<div class="bg-white overflow-x-auto rounded-lg shadow">
    <table class="min-w-full bg-white text-sm lg:text-base">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">No</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nama</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nama Ibu</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Tanggal Lahir</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Jenis Kelamin</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Alamat</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @forelse($balita as $item)
            <tr class="{{ $loop->even ? 'bg-gray-200' : '' }}">
                <td class="text-left py-3 px-4">{{ $loop->iteration }}</td>
                <td class="text-left py-3 px-4">{{ $item->nama }}</td>
                <td class="text-left py-3 px-4">{{ $item->nama_ibu }}</td>
                <td class="text-left py-3 px-4">{{ $item->tanggal_lahir->format('d/m/Y') }}</td>
                <td class="text-left py-3 px-4">{{ $item->jenis_kelamin_text }}</td>
                <td class="text-left py-3 px-4">{{ $item->alamat }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">
                    <x-empty-state message="Tidak ada data balita" />
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4 text-sm text-gray-600">
    Total Data: {{ $balita->count() }}
</div>
@endsection

