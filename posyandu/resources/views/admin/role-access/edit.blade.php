@extends('layouts.app')

@section('title', 'Edit Role Access')
@section('page-title', 'Edit Role Access')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl lg:text-3xl text-black font-bold">Edit Role Access</h1>
    <p class="text-gray-600 mt-1">Edit role access: {{ $roleAccess->name }}</p>
</div>

<div class="w-full lg:w-2/3 xl:w-1/2">
    <form class="p-6 lg:p-10 bg-white rounded shadow-xl" action="{{ route('admin.role-access.update', $roleAccess) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-sm text-gray-600 font-semibold mb-2" for="name">Nama Role Access *</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('name') border border-red-500 @enderror" 
                   id="name" name="name" type="text" required value="{{ old('name', $roleAccess->name) }}" placeholder="Contoh: Kelola Balita">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600 font-semibold mb-2" for="slug">
                Slug <span class="text-gray-400 font-normal">(Opsional - Biarkan kosong untuk auto-generate)</span>
            </label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('slug') border border-red-500 @enderror" 
                   id="slug" name="slug" type="text" value="{{ old('slug', $roleAccess->slug) }}" placeholder="Contoh: kelola-balita">
            <div class="text-xs text-gray-500 mt-2 p-3 bg-blue-50 rounded border border-blue-200">
                <p class="font-semibold text-blue-800 mb-2"><i class="fas fa-info-circle mr-1"></i> Penjelasan Slug:</p>
                <div class="space-y-2 text-gray-700">
                    <p><strong>Slug = Nama pendek untuk identifikasi</strong></p>
                    <p>Slug adalah versi pendek dari nama yang digunakan sistem untuk mengenali role access ini.</p>
                    
                    <div class="mt-3 p-2 bg-white rounded border">
                        <p class="font-semibold mb-1">Contoh Praktis:</p>
                        <table class="text-xs w-full">
                            <tr class="border-b">
                                <td class="py-1 pr-2 font-semibold">Nama:</td>
                                <td class="py-1">"Kelola Data Balita"</td>
                            </tr>
                            <tr>
                                <td class="py-1 pr-2 font-semibold">Slug:</td>
                                <td class="py-1"><code class="bg-gray-100 px-1 rounded">kelola-data-balita</code></td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        <p class="font-semibold mb-1">Kegunaan Slug:</p>
                        <ul class="list-disc list-inside ml-2 space-y-1">
                            <li>Digunakan di kode program untuk cek permission</li>
                            <li>Lebih mudah ditulis daripada nama lengkap</li>
                            <li>Format: huruf kecil, tanpa spasi, pakai tanda strip (-)</li>
                        </ul>
                    </div>
                    
                    <div class="mt-3 p-2 bg-yellow-50 rounded border border-yellow-200">
                        <p class="font-semibold text-yellow-800"><i class="fas fa-lightbulb mr-1"></i> Tips:</p>
                        <p class="text-yellow-700">Jika dikosongkan, sistem akan otomatis membuat slug dari nama yang Anda isi di atas.</p>
                    </div>
                </div>
            </div>
            @error('slug')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600 font-semibold mb-2" for="description">Deskripsi</label>
            <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('description') border border-red-500 @enderror" 
                      id="description" name="description" rows="3" placeholder="Deskripsi role access">{{ old('description', $roleAccess->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600 font-semibold mb-2" for="role">Role *</label>
            <select class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('role') border border-red-500 @enderror" 
                    id="role" name="role" required>
                <option value="">Pilih Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->value }}" {{ old('role', $roleAccess->role) === $role->value ? 'selected' : '' }}>
                        {{ $role->label() }}
                    </option>
                @endforeach
            </select>
            @error('role')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600 font-semibold mb-2" for="permission">Permission</label>
            <select class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('permission') border border-red-500 @enderror" 
                    id="permission" name="permission">
                <option value="">Pilih Permission (Opsional)</option>
                @foreach($permissions as $permission)
                    <option value="{{ $permission }}" {{ old('permission', $roleAccess->permission) === $permission ? 'selected' : '' }}>
                        {{ ucfirst($permission) }}
                    </option>
                @endforeach
            </select>
            @error('permission')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $roleAccess->is_active) ? 'checked' : '' }} class="mr-2">
                <span class="text-sm text-gray-600">Aktif</span>
            </label>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <button class="w-full sm:w-auto bg-sidebar text-white font-semibold py-2 px-6 rounded hover:bg-blue-700" type="submit">
                <i class="fas fa-save mr-2"></i> Update
            </button>
            <a href="{{ route('admin.role-access.index') }}" class="w-full sm:w-auto bg-gray-500 text-white font-semibold py-2 px-6 rounded hover:bg-gray-600 text-center">
                <i class="fas fa-times mr-2"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection

