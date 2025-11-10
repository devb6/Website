@extends('layouts.app')

@section('title', 'Detail Jadwal')
@section('page-title', 'Detail Jadwal')

@section('content')
<h1 class="text-2xl lg:text-3xl text-black pb-4 lg:pb-6">Detail Jadwal Kegiatan</h1>

<div class="w-full lg:w-2/3 xl:w-1/2">
    <div class="p-6 lg:p-10 bg-white rounded shadow-xl">
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Nama Kegiatan</label>
            <p class="mt-1 text-gray-800">{{ $jadwal->nama_kegiatan }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Tanggal</label>
            <p class="mt-1 text-gray-800">{{ $jadwal->tanggal->format('d/m/Y') }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Waktu</label>
            <p class="mt-1 text-gray-800">{{ $jadwal->waktu }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Lokasi</label>
            <p class="mt-1 text-gray-800">{{ $jadwal->lokasi }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Keterangan</label>
            <p class="mt-1 text-gray-800">{{ $jadwal->keterangan ?? '-' }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('jadwal.edit', $jadwal) }}" class="px-4 py-2 text-white font-light tracking-wider bg-sidebar rounded hover:bg-blue-700">
                Edit
            </a>
            <a href="{{ route('jadwal.index') }}" class="px-4 py-2 text-gray-700 font-light tracking-wider bg-gray-200 rounded hover:bg-gray-300 ml-2">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection

