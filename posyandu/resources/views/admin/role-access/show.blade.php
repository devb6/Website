@extends('layouts.app')

@section('title', 'Detail Role Access')
@section('page-title', 'Detail Role Access')

@section('content')
<div class="mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl text-black font-bold">Detail Role Access</h1>
            <p class="text-gray-600 mt-1">Informasi lengkap role access</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.role-access.edit', $roleAccess) }}" class="bg-yellow-500 text-white font-semibold py-2 px-4 rounded hover:bg-yellow-600">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('admin.role-access.index') }}" class="bg-gray-500 text-white font-semibold py-2 px-4 rounded hover:bg-gray-600">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="w-full lg:w-2/3 xl:w-1/2">
    <div class="p-6 lg:p-10 bg-white rounded shadow-xl">
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-1">Nama</label>
            <p class="text-gray-800 text-lg">{{ $roleAccess->name }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-1">
                Slug 
                <span class="text-xs font-normal text-gray-400">(Nama pendek untuk identifikasi)</span>
            </label>
            <code class="text-sm bg-gray-100 px-3 py-2 rounded block">{{ $roleAccess->slug }}</code>
            <div class="text-xs text-gray-500 mt-2 p-2 bg-blue-50 rounded">
                <p class="font-semibold mb-1">Cara Menggunakan Slug:</p>
                <p>Slug ini bisa digunakan di kode program untuk mengecek permission user:</p>
                <code class="bg-white px-2 py-1 rounded block mt-1">if (user->hasPermission('{{ $roleAccess->slug }}')) { ... }</code>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-1">Deskripsi</label>
            <p class="text-gray-800">{{ $roleAccess->description ?: '-' }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-1">Role</label>
            <span class="inline-block px-3 py-1 text-sm rounded 
                @if($roleAccess->role === 'admin') bg-red-100 text-red-800
                @elseif($roleAccess->role === 'kepalaposyandu') bg-purple-100 text-purple-800
                @elseif($roleAccess->role === 'petugas') bg-blue-100 text-blue-800
                @else bg-gray-100 text-gray-800
                @endif">
                {{ $roleAccess->role_label }}
            </span>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-1">Permission</label>
            @if($roleAccess->permission)
                <span class="inline-block px-3 py-1 text-sm rounded bg-green-100 text-green-800">{{ $roleAccess->permission }}</span>
            @else
                <p class="text-gray-400">-</p>
            @endif
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-1">Status</label>
            @if($roleAccess->is_active)
                <span class="inline-block px-3 py-1 text-sm rounded bg-green-100 text-green-800">Aktif</span>
            @else
                <span class="inline-block px-3 py-1 text-sm rounded bg-gray-100 text-gray-800">Tidak Aktif</span>
            @endif
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-1">Dibuat</label>
            <p class="text-gray-800">{{ $roleAccess->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-1">Diperbarui</label>
            <p class="text-gray-800">{{ $roleAccess->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>
</div>
@endsection

