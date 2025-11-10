<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Posyandu')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
        
        /* Pastikan layout benar */
        html, body {
            height: 100%;
        }
        
        @media (min-width: 1024px) {
            body {
                padding-left: 16rem; /* Space untuk sidebar fixed */
            }
            
            .content-wrapper {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 font-family-karla min-h-screen">

    <aside class="bg-sidebar w-64 hidden lg:block shadow-xl fixed left-0 top-0 z-30" style="height: 100vh; overflow-y: auto;">
        <div class="flex flex-col h-full">
            <div class="p-4 lg:p-6 flex-shrink-0">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <svg class="h-8 lg:h-10 w-auto mr-2" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="30" cy="30" r="28" fill="#FF2D20"/>
                        <text x="30" y="40" font-family="Arial, sans-serif" font-size="32" font-weight="bold" fill="white" text-anchor="middle">G</text>
                    </svg>
                    <span class="text-white text-lg lg:text-xl font-semibold uppercase hover:text-gray-300">Posyandu</span>
                </a>
                <a href="{{ route('balita.create') }}" class="w-full bg-white cta-btn font-semibold py-2 mt-4 lg:mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center text-sm lg:text-base">
                    <i class="fas fa-plus mr-2 lg:mr-3"></i> Data Baru
                </a>
            </div>
            <nav class="text-white text-sm lg:text-base font-semibold pt-3 flex-1 pb-4">
                <a href="{{ route('dashboard') }}" class="flex items-center {{ request()->routeIs('dashboard') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} py-3 lg:py-4 pl-4 lg:pl-6 nav-item">
                    <i class="fas fa-tachometer-alt mr-2 lg:mr-3"></i>
                    Dashboard
                </a>
                <a href="{{ route('balita.index') }}" class="flex items-center {{ request()->routeIs('balita.*') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} py-3 lg:py-4 pl-4 lg:pl-6 nav-item">
                    <i class="fas fa-baby mr-2 lg:mr-3"></i>
                    Data Balita
                </a>
                <a href="{{ route('ibu-hamil.index') }}" class="flex items-center {{ request()->routeIs('ibu-hamil.*') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} py-3 lg:py-4 pl-4 lg:pl-6 nav-item">
                    <i class="fas fa-user-injured mr-2 lg:mr-3"></i>
                    Data Ibu Hamil
                </a>
                <a href="{{ route('jadwal.index') }}" class="flex items-center {{ request()->routeIs('jadwal.*') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} py-3 lg:py-4 pl-4 lg:pl-6 nav-item">
                    <i class="fas fa-calendar mr-2 lg:mr-3"></i>
                    Jadwal Kegiatan
                </a>
                <a href="{{ route('laporan.index') }}" class="flex items-center {{ request()->routeIs('laporan.*') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} py-3 lg:py-4 pl-4 lg:pl-6 nav-item">
                    <i class="fas fa-file-alt mr-2 lg:mr-3"></i>
                    Laporan
                </a>
                @if(Auth::user()->isAdmin())
                <div class="border-t border-blue-500 my-2"></div>
                <a href="{{ route('admin.role-access.index') }}" class="flex items-center {{ request()->routeIs('admin.*') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} py-3 lg:py-4 pl-4 lg:pl-6 nav-item">
                    <i class="fas fa-shield-alt mr-2 lg:mr-3"></i>
                    Role Access
                </a>
                @endif
            </nav>
        </div>
    </aside>

    <div class="w-full content-wrapper flex flex-col min-h-screen">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-4 lg:px-6 hidden lg:flex sticky top-0 z-20 shadow-sm flex-shrink-0">
            <div class="w-1/2">
                <h2 class="text-xl lg:text-2xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
            </div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="relative z-10 w-10 h-10 lg:w-12 lg:h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3d68ff&color=fff" alt="User">
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-48 bg-white rounded-lg shadow-lg py-2 mt-16 right-0">
                    <div class="block px-4 py-2 text-gray-800 font-semibold border-b text-sm lg:text-base">{{ Auth::user()->name }}</div>
                    <div class="block px-4 py-2 text-gray-600 text-xs lg:text-sm border-b">{{ Auth::user()->email }}</div>
                    <div class="block px-4 py-2 border-b">
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded 
                            @if(Auth::user()->isAdmin()) bg-red-100 text-red-800
                            @elseif(Auth::user()->isKepalaPosyandu()) bg-purple-100 text-purple-800
                            @elseif(Auth::user()->isPetugas()) bg-blue-100 text-blue-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ Auth::user()->getRole()->label() }}
                        </span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="block" id="logout-form-desktop">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="w-full text-left px-4 py-2 account-link hover:text-white">
                            <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-4 px-4 lg:hidden sticky top-0 z-30 shadow-lg">
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <svg class="h-8 w-auto mr-2" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="30" cy="30" r="28" fill="#FF2D20"/>
                        <text x="30" y="40" font-family="Arial, sans-serif" font-size="32" font-weight="bold" fill="white" text-anchor="middle">G</text>
                    </svg>
                    <span class="text-white text-lg font-semibold uppercase hover:text-gray-300">Posyandu</span>
                </a>
                <button @click="isOpen = !isOpen" class="text-white text-2xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4 max-h-[calc(100vh-80px)] overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center {{ request()->routeIs('dashboard') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="{{ route('balita.index') }}" class="flex items-center {{ request()->routeIs('balita.*') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item">
                    <i class="fas fa-baby mr-3"></i>
                    Data Balita
                </a>
                <a href="{{ route('ibu-hamil.index') }}" class="flex items-center {{ request()->routeIs('ibu-hamil.*') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item">
                    <i class="fas fa-user-injured mr-3"></i>
                    Data Ibu Hamil
                </a>
                <a href="{{ route('jadwal.index') }}" class="flex items-center {{ request()->routeIs('jadwal.*') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item">
                    <i class="fas fa-calendar mr-3"></i>
                    Jadwal Kegiatan
                </a>
                <a href="{{ route('laporan.index') }}" class="flex items-center {{ request()->routeIs('laporan.*') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item">
                    <i class="fas fa-file-alt mr-3"></i>
                    Laporan
                </a>
                @if(Auth::user()->isAdmin())
                <div class="border-t border-blue-500 my-2 mx-4"></div>
                <a href="{{ route('admin.role-access.index') }}" class="flex items-center {{ request()->routeIs('admin.*') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} py-2 pl-4 nav-item">
                    <i class="fas fa-shield-alt mr-3"></i>
                    Role Access
                </a>
                @endif
                <div class="px-4 py-2 text-white border-t border-blue-500 mt-2">
                    <div class="text-sm font-semibold">{{ Auth::user()->name }}</div>
                    <div class="text-xs opacity-75">{{ Auth::user()->email }}</div>
                    <div class="mt-2">
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded 
                            @if(Auth::user()->isAdmin()) bg-red-500 text-white
                            @elseif(Auth::user()->isKepalaPosyandu()) bg-purple-500 text-white
                            @elseif(Auth::user()->isPetugas()) bg-blue-500 text-white
                            @else bg-gray-500 text-white
                            @endif">
                            {{ Auth::user()->getRole()->label() }}
                        </span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="block" id="logout-form-mobile">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="w-full flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Sign Out
                    </button>
                </form>
            </nav>
        </header>
    
        <div class="w-full overflow-x-hidden flex flex-col flex-1 min-h-0">
            <main class="w-full flex-1 p-4 lg:p-6 overflow-y-auto">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
    
            <footer class="w-full bg-white text-center lg:text-right p-4 border-t shadow-sm flex-shrink-0">
                <p class="text-xs lg:text-sm text-gray-600">Sistem Informasi Posyandu © {{ date('Y') }}</p>
            </footer>
        </div>
        
    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
    
    <!-- CSRF Token Setup -->
    <script>
        // Setup CSRF token untuk semua AJAX request
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };
        
        // Refresh CSRF token dan update form logout
        function refreshCsrfToken() {
            fetch('{{ route('login') }}', {
                method: 'HEAD',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            }).then(function() {
                // Update CSRF token di semua form logout
                var logoutForms = document.querySelectorAll('form[action*="logout"]');
                var newToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                logoutForms.forEach(function(form) {
                    var tokenInput = form.querySelector('input[name="_token"]');
                    if (tokenInput) {
                        tokenInput.value = newToken;
                    } else {
                        var hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = '_token';
                        hiddenInput.value = newToken;
                        form.appendChild(hiddenInput);
                    }
                });
            }).catch(function() {
                // Ignore errors, akan di-handle saat submit
            });
        }
        
        // Pastikan form logout selalu menggunakan CSRF token terbaru
        document.addEventListener('DOMContentLoaded', function() {
            // Refresh token setiap 30 menit
            setInterval(refreshCsrfToken, 1800000);
            
            var logoutForms = document.querySelectorAll('form[action*="logout"]');
            logoutForms.forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    // Pastikan CSRF token ada dan valid
                    var tokenInput = form.querySelector('input[name="_token"]');
                    if (!tokenInput || !tokenInput.value) {
                        e.preventDefault();
                        // Refresh token dan coba lagi
                        refreshCsrfToken();
                        setTimeout(function() {
                            form.submit();
                        }, 500);
                    }
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
