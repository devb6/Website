@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl lg:text-3xl text-black font-bold">Dashboard</h1>
    <p class="text-gray-600 mt-1">Selamat datang, {{ Auth::user()->name }}!</p>
</div>

<!-- Statistik Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-md p-4 lg:p-6 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-xs lg:text-sm font-medium mb-1">Total Balita</p>
                <p class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $stats['total_balita'] }}</p>
            </div>
            <div class="p-3 bg-blue-100 rounded-full">
                <i class="fas fa-baby text-blue-500 text-xl lg:text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-4 lg:p-6 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-xs lg:text-sm font-medium mb-1">Total Ibu Hamil</p>
                <p class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $stats['total_ibu_hamil'] }}</p>
            </div>
            <div class="p-3 bg-green-100 rounded-full">
                <i class="fas fa-user-injured text-green-500 text-xl lg:text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-4 lg:p-6 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-xs lg:text-sm font-medium mb-1">Total Jadwal</p>
                <p class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $stats['total_jadwal'] }}</p>
            </div>
            <div class="p-3 bg-purple-100 rounded-full">
                <i class="fas fa-calendar text-purple-500 text-xl lg:text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-4 lg:p-6 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-xs lg:text-sm font-medium mb-1">Balita Baru</p>
                <p class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $stats['balita_baru_bulan_ini'] }}</p>
                <p class="text-xs text-gray-500 mt-1">Bulan ini</p>
            </div>
            <div class="p-3 bg-yellow-100 rounded-full">
                <i class="fas fa-plus text-yellow-500 text-xl lg:text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Grafik Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-md p-4 lg:p-6">
        <div class="flex items-center mb-4">
            <i class="fas fa-chart-bar text-sidebar mr-3 text-lg"></i>
            <h3 class="text-lg lg:text-xl font-semibold text-gray-800">Grafik Bulanan</h3>
        </div>
        <div class="relative" style="height: 250px;">
            <canvas id="chartOne"></canvas>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-4 lg:p-6">
        <div class="flex items-center mb-4">
            <i class="fas fa-chart-line text-sidebar mr-3 text-lg"></i>
            <h3 class="text-lg lg:text-xl font-semibold text-gray-800">Trend Data</h3>
        </div>
        <div class="relative" style="height: 250px;">
            <canvas id="chartTwo"></canvas>
        </div>
    </div>
</div>

<!-- Data Terbaru Section -->
<div class="bg-white rounded-lg shadow-md p-4 lg:p-6">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center">
            <i class="fas fa-list text-sidebar mr-3 text-lg"></i>
            <h3 class="text-lg lg:text-xl font-semibold text-gray-800">Data Terbaru</h3>
        </div>
        <a href="{{ route('balita.index') }}" class="text-sidebar hover:text-blue-700 text-sm font-medium">
            Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white text-sm lg:text-base">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Nama</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Jenis</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Tanggal</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-xs text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-200">
                @php
                    $latestBalita = \App\Models\Balita::latest()->take(5)->get();
                    $latestIbuHamil = \App\Models\IbuHamil::latest()->take(3)->get();
                    $latestData = collect();
                    foreach($latestBalita as $b) {
                        $latestData->push(['type' => 'Balita', 'name' => $b->nama, 'date' => $b->created_at, 'route' => route('balita.show', $b)]);
                    }
                    foreach($latestIbuHamil as $ih) {
                        $latestData->push(['type' => 'Ibu Hamil', 'name' => $ih->nama, 'date' => $ih->created_at, 'route' => route('ibu-hamil.show', $ih)]);
                    }
                    $latestData = $latestData->sortByDesc('date')->take(5);
                @endphp
                @forelse($latestData as $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-3 px-4 font-medium">{{ $item['name'] }}</td>
                    <td class="py-3 px-4">
                        <span class="inline-block px-2 py-1 text-xs rounded 
                            {{ $item['type'] === 'Balita' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                            {{ $item['type'] }}
                        </span>
                    </td>
                    <td class="py-3 px-4">{{ $item['date']->format('d/m/Y') }}</td>
                    <td class="py-3 px-4">
                        <a href="{{ $item['route'] }}" class="text-sidebar hover:text-blue-700 font-medium">
                            <i class="fas fa-eye mr-1"></i> Lihat
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">
                        <x-empty-state message="Tidak ada data terbaru" />
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Grafik Bulanan - Bar Chart
    var ctxOne = document.getElementById('chartOne').getContext('2d');
    var chartOne = new Chart(ctxOne, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Jumlah Data',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgba(61, 104, 255, 0.8)',
                borderColor: 'rgba(61, 104, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1
                    },
                    gridLines: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        }
    });

    // Trend Data - Line Chart
    var ctxTwo = document.getElementById('chartTwo').getContext('2d');
    var chartTwo = new Chart(ctxTwo, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Trend Data',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgba(61, 104, 255, 0.1)',
                borderColor: 'rgba(61, 104, 255, 1)',
                borderWidth: 3,
                fill: true,
                lineTension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: 'rgba(61, 104, 255, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 2
                    },
                    gridLines: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        }
    });
</script>
@endpush

