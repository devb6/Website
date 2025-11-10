<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik untuk dashboard
        $stats = [
            'total_balita' => \App\Models\Balita::count(),
            'total_ibu_hamil' => \App\Models\IbuHamil::count(),
            'total_jadwal' => \App\Models\Jadwal::count(),
            'balita_baru_bulan_ini' => \App\Models\Balita::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}

