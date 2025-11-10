<?php

namespace App\Http\Controllers;

use App\Models\IbuHamil;
use Illuminate\Http\Request;

class IbuHamilController extends Controller
{
    public function index()
    {
        // Cek permission dengan slug 'kelola-ibu-hamil' (atau 'kelola-ibu')
        // Jika slug belum ada di database, akan auto-fallback ke role-based
        if (!auth()->user()->hasPermission('kelola-ibu-hamil')) {
            abort(403, 'Anda tidak memiliki akses untuk halaman ini.');
        }

        $ibuHamil = IbuHamil::latest()->paginate(10);
        return view('ibu-hamil.index', compact('ibuHamil'));
    }

    public function create()
    {
        // Cek permission create
        if (!auth()->user()->canPermission('kelola-ibu-hamil', 'create')) {
            abort(403, 'Anda tidak memiliki izin untuk menambah data.');
        }

        return view('ibu-hamil.create');
    }

    public function store(Request $request)
    {
        // Cek permission create
        if (!auth()->user()->canPermission('kelola-ibu-hamil', 'create')) {
            abort(403);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nama_suami' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'hpht' => 'required|date',
            'telepon' => 'nullable|string|max:20',
        ]);

        IbuHamil::create($validated);

        return redirect()->route('ibu-hamil.index')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    public function show(IbuHamil $ibuHamil)
    {
        // Cek permission read
        if (!auth()->user()->canPermission('kelola-ibu-hamil', 'read')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat data ini.');
        }

        return view('ibu-hamil.show', compact('ibuHamil'));
    }

    public function edit(IbuHamil $ibuHamil)
    {
        // Cek permission update
        if (!auth()->user()->canPermission('kelola-ibu-hamil', 'update')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit data.');
        }

        return view('ibu-hamil.edit', compact('ibuHamil'));
    }

    public function update(Request $request, IbuHamil $ibuHamil)
    {
        // Cek permission update
        if (!auth()->user()->canPermission('kelola-ibu-hamil', 'update')) {
            abort(403);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nama_suami' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'hpht' => 'required|date',
            'telepon' => 'nullable|string|max:20',
        ]);

        $ibuHamil->update($validated);

        return redirect()->route('ibu-hamil.index')->with('success', 'Data ibu hamil berhasil diperbarui.');
    }

    public function destroy(IbuHamil $ibuHamil)
    {
        // Cek permission delete
        if (!auth()->user()->canPermission('kelola-ibu-hamil', 'delete')) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus data.');
        }

        $ibuHamil->delete();

        return redirect()->route('ibu-hamil.index')->with('success', 'Data ibu hamil berhasil dihapus.');
    }
}

