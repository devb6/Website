@extends('layouts.app')

@section('title', 'Laporan')
@section('page-title', 'Laporan')

@section('content')
<h1 class="text-2xl lg:text-3xl text-black pb-4 lg:pb-6">Laporan</h1>

<div class="flex flex-wrap mt-4 lg:mt-6 gap-4">
    <div class="w-full lg:w-1/2">
        <div class="p-6 bg-white rounded-lg shadow">
            <h3 class="text-xl font-semibold mb-4">Laporan Data Balita</h3>
            <p class="text-gray-600 mb-4">Lihat dan cetak laporan data balita yang terdaftar di sistem.</p>
            <a href="{{ route('laporan.balita') }}" class="bg-sidebar text-white px-4 py-2 rounded hover:bg-blue-700 inline-block">
                <i class="fas fa-file-alt mr-2"></i>Lihat Laporan
            </a>
        </div>
    </div>

    <div class="w-full lg:w-1/2">
        <div class="p-6 bg-white rounded-lg shadow">
            <h3 class="text-xl font-semibold mb-4">Laporan Data Ibu Hamil</h3>
            <p class="text-gray-600 mb-4">Lihat dan cetak laporan data ibu hamil yang terdaftar di sistem.</p>
            <a href="{{ route('laporan.ibu-hamil') }}" class="bg-sidebar text-white px-4 py-2 rounded hover:bg-blue-700 inline-block">
                <i class="fas fa-file-alt mr-2"></i>Lihat Laporan
            </a>
        </div>
    </div>
</div>
@endsection

