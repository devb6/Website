<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleAccess;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hanya admin yang bisa akses
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $roleAccesses = RoleAccess::latest()->paginate(10);
        return view('admin.role-access.index', compact('roleAccesses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Hanya admin yang bisa akses
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $roles = UserRole::cases();
        $permissions = ['create', 'read', 'update', 'delete', 'all'];
        
        return view('admin.role-access.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Hanya admin yang bisa akses
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:role_access,slug',
            'description' => 'nullable|string|max:500',
            'role' => 'required|in:admin,petugas,user,kepalaposyandu',
            'permission' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        // Generate slug jika tidak ada
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Pastikan slug unique
        $slug = $validated['slug'];
        $counter = 1;
        while (RoleAccess::where('slug', $slug)->exists()) {
            $slug = $validated['slug'] . '-' . $counter;
            $counter++;
        }
        $validated['slug'] = $slug;

        $validated['is_active'] = $request->has('is_active') ? true : false;

        RoleAccess::create($validated);

        return redirect()->route('admin.role-access.index')
            ->with('success', 'Role access berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RoleAccess $roleAccess)
    {
        // Hanya admin yang bisa akses
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        return view('admin.role-access.show', compact('roleAccess'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoleAccess $roleAccess)
    {
        // Hanya admin yang bisa akses
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $roles = UserRole::cases();
        $permissions = ['create', 'read', 'update', 'delete', 'all'];
        
        return view('admin.role-access.edit', compact('roleAccess', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoleAccess $roleAccess)
    {
        // Hanya admin yang bisa akses
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:role_access,slug,' . $roleAccess->id,
            'description' => 'nullable|string|max:500',
            'role' => 'required|in:admin,petugas,user,kepalaposyandu',
            'permission' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        // Generate slug jika tidak ada
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Pastikan slug unique (kecuali untuk record ini)
        $slug = $validated['slug'];
        if ($slug !== $roleAccess->slug) {
            $counter = 1;
            $originalSlug = $slug;
            while (RoleAccess::where('slug', $slug)->where('id', '!=', $roleAccess->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
        }
        $validated['slug'] = $slug;

        $validated['is_active'] = $request->has('is_active') ? true : false;

        $roleAccess->update($validated);

        return redirect()->route('admin.role-access.index')
            ->with('success', 'Role access berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoleAccess $roleAccess)
    {
        // Hanya admin yang bisa akses
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $roleAccess->delete();

        return redirect()->route('admin.role-access.index')
            ->with('success', 'Role access berhasil dihapus.');
    }
}
