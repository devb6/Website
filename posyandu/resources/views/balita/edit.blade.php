@extends('layouts.app')

@section('title', 'Edit Data Balita')
@section('page-title', 'Edit Data Balita')

@section('content')
<h1 class="text-2xl lg:text-3xl text-black pb-4 lg:pb-6">Edit Data Balita</h1>

<div class="w-full lg:w-2/3 xl:w-1/2">
    <form class="p-6 lg:p-10 bg-white rounded shadow-xl" action="{{ route('balita.update', $balita) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="nama">Nama Balita *</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('nama') border border-red-500 @enderror" 
                   id="nama" name="nama" type="text" required value="{{ old('nama', $balita->nama) }}" placeholder="Nama Balita">
            @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="nama_ibu">Nama Ibu *</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('nama_ibu') border border-red-500 @enderror" 
                   id="nama_ibu" name="nama_ibu" type="text" required value="{{ old('nama_ibu', $balita->nama_ibu) }}" placeholder="Nama Ibu">
            @error('nama_ibu')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="tanggal_lahir">Tanggal Lahir *</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('tanggal_lahir') border border-red-500 @enderror" 
                   id="tanggal_lahir" name="tanggal_lahir" type="date" required value="{{ old('tanggal_lahir', $balita->tanggal_lahir->format('Y-m-d')) }}">
            @error('tanggal_lahir')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="jenis_kelamin">Jenis Kelamin *</label>
            <select class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('jenis_kelamin') border border-red-500 @enderror" 
                    id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L" {{ old('jenis_kelamin', $balita->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin', $balita->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="alamat">Alamat *</label>
            <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('alamat') border border-red-500 @enderror" 
                      id="alamat" name="alamat" rows="3" required placeholder="Alamat">{{ old('alamat', $balita->alamat) }}</textarea>
            @error('alamat')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="berat_lahir">Berat Lahir (kg)</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('berat_lahir') border border-red-500 @enderror" 
                   id="berat_lahir" name="berat_lahir" type="number" step="0.01" value="{{ old('berat_lahir', $balita->berat_lahir) }}" placeholder="Contoh: 3.5">
            @error('berat_lahir')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600" for="tinggi_lahir">Tinggi Lahir (cm)</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('tinggi_lahir') border border-red-500 @enderror" 
                   id="tinggi_lahir" name="tinggi_lahir" type="number" step="0.01" value="{{ old('tinggi_lahir', $balita->tinggi_lahir) }}" placeholder="Contoh: 50.5">
            @error('tinggi_lahir')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6">
            <button class="px-4 py-2 text-white font-light tracking-wider bg-gray-900 rounded hover:bg-gray-800" type="submit">
                Update
            </button>
            <a href="{{ route('balita.index') }}" class="px-4 py-2 text-gray-700 font-light tracking-wider bg-gray-200 rounded hover:bg-gray-300 ml-2">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection

