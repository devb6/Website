@extends('layouts.app')

@section('title', 'Role Access Management')
@section('page-title', 'Role Access Management')

@section('content')
<div class="mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl text-black font-bold">Role Access Management</h1>
            <p class="text-gray-600 mt-1">Kelola akses role untuk sistem</p>
        </div>
        <a href="{{ route('admin.role-access.create') }}" class="w-full sm:w-auto bg-sidebar text-white font-semibold py-2 px-4 lg:px-6 rounded hover:bg-blue-700 flex items-center justify-center">
            <i class="fas fa-plus mr-2"></i> Tambah Role Access
        </a>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white text-sm lg:text-base">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Nama</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Slug</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Role</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Permission</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Status</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-200">
                @forelse($roleAccesses as $roleAccess)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-3 px-4 font-medium">{{ $roleAccess->name }}</td>
                    <td class="py-3 px-4">
                        <code class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $roleAccess->slug }}</code>
                    </td>
                    <td class="py-3 px-4">
                        <span class="inline-block px-2 py-1 text-xs rounded 
                            @if($roleAccess->role === 'admin') bg-red-100 text-red-800
                            @elseif($roleAccess->role === 'kepalaposyandu') bg-purple-100 text-purple-800
                            @elseif($roleAccess->role === 'petugas') bg-blue-100 text-blue-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $roleAccess->role_label }}
                        </span>
                    </td>
                    <td class="py-3 px-4">
                        @if($roleAccess->permission)
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">{{ $roleAccess->permission }}</span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        @if($roleAccess->is_active)
                            <span class="inline-block px-2 py-1 text-xs rounded bg-green-100 text-green-800">Aktif</span>
                        @else
                            <span class="inline-block px-2 py-1 text-xs rounded bg-gray-100 text-gray-800">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.role-access.show', $roleAccess) }}" class="text-blue-500 hover:text-blue-700" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.role-access.edit', $roleAccess) }}" class="text-yellow-500 hover:text-yellow-700" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.role-access.destroy', $roleAccess) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus role access ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">
                        <x-empty-state 
                            message="Tidak ada data role access"
                            actionText="Tambah role access pertama"
                            actionUrl="{{ route('admin.role-access.create') }}"
                            icon="shield-alt"
                        />
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($roleAccesses->hasPages())
    <div class="px-4 py-3 border-t bg-gray-50">
        {{ $roleAccesses->links() }}
    </div>
    @endif
</div>
@endsection

