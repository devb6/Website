@extends('layouts.app')

@section('title', 'Tambah Data Ibu Hamil')
@section('page-title', 'Tambah Data Ibu Hamil')

@section('content')
<h1 class="text-2xl lg:text-3xl text-black pb-4 lg:pb-6">Tambah Data Ibu Hamil</h1>

<div class="w-full lg:w-2/3 xl:w-1/2">
    <form class="p-6 lg:p-10 bg-white rounded shadow-xl" action="{{ route('ibu-hamil.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="nama">Nama *</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('nama') border border-red-500 @enderror" 
                   id="nama" name="nama" type="text" required value="{{ old('nama') }}" placeholder="Nama Ibu Hamil">
            @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="nama_suami">Nama Suami</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('nama_suami') border border-red-500 @enderror" 
                   id="nama_suami" name="nama_suami" type="text" value="{{ old('nama_suami') }}" placeholder="Nama Suami">
            @error('nama_suami')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="tanggal_lahir">Tanggal Lahir *</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('tanggal_lahir') border border-red-500 @enderror" 
                   id="tanggal_lahir" name="tanggal_lahir" type="date" required value="{{ old('tanggal_lahir') }}">
            @error('tanggal_lahir')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="hpht">HPHT (Hari Pertama Haid Terakhir) *</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('hpht') border border-red-500 @enderror" 
                   id="hpht" name="hpht" type="date" required value="{{ old('hpht') }}">
            @error('hpht')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="alamat">Alamat *</label>
            <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('alamat') border border-red-500 @enderror" 
                      id="alamat" name="alamat" rows="3" required placeholder="Alamat">{{ old('alamat') }}</textarea>
            @error('alamat')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="telepon">Telepon</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('telepon') border border-red-500 @enderror" 
                   id="telepon" name="telepon" type="text" value="{{ old('telepon') }}" placeholder="Nomor Telepon">
            @error('telepon')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6">
            <button class="px-4 py-2 text-white font-light tracking-wider bg-gray-900 rounded hover:bg-gray-800" type="submit">
                Simpan
            </button>
            <a href="{{ route('ibu-hamil.index') }}" class="px-4 py-2 text-gray-700 font-light tracking-wider bg-gray-200 rounded hover:bg-gray-300 ml-2">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection

