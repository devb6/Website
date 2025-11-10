<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Contoh: Cek permission dengan slug (opsional, bisa diaktifkan jika perlu)
        // if (!auth()->user()->hasPermission('kelola-balita')) {
        //     abort(403, 'Anda tidak memiliki akses untuk halaman ini.');
        // }

        $balita = Balita::latest()->paginate(10);
        return view('balita.index', compact('balita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Contoh: Cek permission create
        // if (!auth()->user()->canPermission('kelola-balita', 'create')) {
        //     abort(403, 'Anda tidak memiliki izin untuk menambah data.');
        // }

        return view('balita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Contoh: Cek permission create
        // if (!auth()->user()->canPermission('kelola-balita', 'create')) {
        //     abort(403);
        // }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'berat_lahir' => 'nullable|numeric',
            'tinggi_lahir' => 'nullable|numeric',
        ]);

        Balita::create($validated);

        return redirect()->route('balita.index')
            ->with('success', 'Data balita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Balita $balita)
    {
        return view('balita.show', compact('balita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Balita $balita)
    {
        // Contoh: Cek permission update
        // if (!auth()->user()->canPermission('kelola-balita', 'update')) {
        //     abort(403, 'Anda tidak memiliki izin untuk mengedit data.');
        // }

        return view('balita.edit', compact('balita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Balita $balita)
    {
        // Contoh: Cek permission update
        // if (!auth()->user()->canPermission('kelola-balita', 'update')) {
        //     abort(403);
        // }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'berat_lahir' => 'nullable|numeric',
            'tinggi_lahir' => 'nullable|numeric',
        ]);

        $balita->update($validated);

        return redirect()->route('balita.index')
            ->with('success', 'Data balita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Balita $balita)
    {
        // Contoh: Cek permission delete
        // if (!auth()->user()->canPermission('kelola-balita', 'delete')) {
        //     abort(403, 'Anda tidak memiliki izin untuk menghapus data.');
        // }

        $balita->delete();

        return redirect()->route('balita.index')
            ->with('success', 'Data balita berhasil dihapus.');
    }
}
