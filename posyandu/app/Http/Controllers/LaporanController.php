<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\IbuHamil;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function balita()
    {
        $balita = Balita::latest()->get();
        return view('laporan.balita', compact('balita'));
    }

    public function ibuHamil()
    {
        $ibuHamil = IbuHamil::latest()->get();
        return view('laporan.ibu-hamil', compact('ibuHamil'));
    }
}

