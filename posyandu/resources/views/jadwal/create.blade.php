@extends('layouts.app')

@section('title', 'Tambah Jadwal')
@section('page-title', 'Tambah Jadwal')

@section('content')
<h1 class="text-2xl lg:text-3xl text-black pb-4 lg:pb-6">Tambah Jadwal Kegiatan</h1>

<div class="w-full lg:w-2/3 xl:w-1/2">
    <form class="p-6 lg:p-10 bg-white rounded shadow-xl" action="{{ route('jadwal.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="nama_kegiatan">Nama Kegiatan *</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('nama_kegiatan') border border-red-500 @enderror" 
                   id="nama_kegiatan" name="nama_kegiatan" type="text" required value="{{ old('nama_kegiatan') }}" placeholder="Nama Kegiatan">
            @error('nama_kegiatan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="tanggal">Tanggal *</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('tanggal') border border-red-500 @enderror" 
                   id="tanggal" name="tanggal" type="date" required value="{{ old('tanggal') }}">
            @error('tanggal')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="waktu">Waktu *</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('waktu') border border-red-500 @enderror" 
                   id="waktu" name="waktu" type="text" required value="{{ old('waktu') }}" placeholder="Contoh: 08:00 - 12:00">
            @error('waktu')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="lokasi">Lokasi *</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('lokasi') border border-red-500 @enderror" 
                   id="lokasi" name="lokasi" type="text" required value="{{ old('lokasi') }}" placeholder="Lokasi Kegiatan">
            @error('lokasi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="keterangan">Keterangan</label>
            <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('keterangan') border border-red-500 @enderror" 
                      id="keterangan" name="keterangan" rows="3" placeholder="Keterangan">{{ old('keterangan') }}</textarea>
            @error('keterangan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6">
            <button class="px-4 py-2 text-white font-light tracking-wider bg-gray-900 rounded hover:bg-gray-800" type="submit">
                Simpan
            </button>
            <a href="{{ route('jadwal.index') }}" class="px-4 py-2 text-gray-700 font-light tracking-wider bg-gray-200 rounded hover:bg-gray-300 ml-2">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection

