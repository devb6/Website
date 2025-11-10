@extends('layouts.app')

@section('title', 'Detail Ibu Hamil')
@section('page-title', 'Detail Ibu Hamil')

@section('content')
<h1 class="text-2xl lg:text-3xl text-black pb-4 lg:pb-6">Detail Ibu Hamil</h1>

<div class="w-full lg:w-2/3 xl:w-1/2">
    <div class="p-6 lg:p-10 bg-white rounded shadow-xl">
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Nama</label>
            <p class="mt-1 text-gray-800">{{ $ibuHamil->nama }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Nama Suami</label>
            <p class="mt-1 text-gray-800">{{ $ibuHamil->nama_suami ?? '-' }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Tanggal Lahir</label>
            <p class="mt-1 text-gray-800">{{ $ibuHamil->tanggal_lahir->format('d/m/Y') }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">HPHT (Hari Pertama Haid Terakhir)</label>
            <p class="mt-1 text-gray-800">{{ $ibuHamil->hpht->format('d/m/Y') }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Alamat</label>
            <p class="mt-1 text-gray-800">{{ $ibuHamil->alamat }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Telepon</label>
            <p class="mt-1 text-gray-800">{{ $ibuHamil->telepon ?? '-' }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('ibu-hamil.edit', $ibuHamil) }}" class="px-4 py-2 text-white font-light tracking-wider bg-sidebar rounded hover:bg-blue-700">
                Edit
            </a>
            <a href="{{ route('ibu-hamil.index') }}" class="px-4 py-2 text-gray-700 font-light tracking-wider bg-gray-200 rounded hover:bg-gray-300 ml-2">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection

