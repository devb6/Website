@extends('layouts.app')

@section('title', 'Detail Balita')
@section('page-title', 'Detail Balita')

@section('content')
<h1 class="text-2xl lg:text-3xl text-black pb-4 lg:pb-6">Detail Balita</h1>

<div class="w-full lg:w-2/3 xl:w-1/2">
    <div class="p-6 lg:p-10 bg-white rounded shadow-xl">
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Nama Balita</label>
            <p class="mt-1 text-gray-800">{{ $balita->nama }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Nama Ibu</label>
            <p class="mt-1 text-gray-800">{{ $balita->nama_ibu }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Tanggal Lahir</label>
            <p class="mt-1 text-gray-800">{{ $balita->tanggal_lahir->format('d/m/Y') }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Jenis Kelamin</label>
            <p class="mt-1 text-gray-800">{{ $balita->jenis_kelamin_text }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Alamat</label>
            <p class="mt-1 text-gray-800">{{ $balita->alamat }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Berat Lahir</label>
            <p class="mt-1 text-gray-800">{{ $balita->berat_lahir ? $balita->berat_lahir . ' kg' : '-' }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Tinggi Lahir</label>
            <p class="mt-1 text-gray-800">{{ $balita->tinggi_lahir ? $balita->tinggi_lahir . ' cm' : '-' }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('balita.edit', $balita) }}" class="px-4 py-2 text-white font-light tracking-wider bg-sidebar rounded hover:bg-blue-700">
                Edit
            </a>
            <a href="{{ route('balita.index') }}" class="px-4 py-2 text-gray-700 font-light tracking-wider bg-gray-200 rounded hover:bg-gray-300 ml-2">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection

