<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Posyandu</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        #lottie-animation {
            width: 100%;
            height: 100%;
            max-width: 600px;
            max-height: 600px;
            min-height: 300px;
        }
        
        @media (max-width: 1024px) {
            #lottie-animation {
                max-width: 400px;
                max-height: 400px;
                min-height: 250px;
            }
        }
        
        @media (max-width: 640px) {
            #lottie-animation {
                max-width: 300px;
                max-height: 300px;
                min-height: 200px;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-family-karla min-h-screen">
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Left Side - Lottie Animation -->
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 p-4 lg:p-8">
            <div id="lottie-animation" class="w-full h-full"></div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-4 lg:p-8">
            <div class="w-full max-w-md">
                <div class="bg-white rounded-lg shadow-xl p-6 lg:p-8">
            <div class="text-center mb-8">
                <svg class="h-16 w-16 mx-auto mb-4" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="30" cy="30" r="28" fill="#FF2D20"/>
                    <text x="30" y="40" font-family="Arial, sans-serif" font-size="32" font-weight="bold" fill="white" text-anchor="middle">G</text>
                </svg>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Daftar Akun</h1>
                <p class="text-gray-600 mt-2">Buat akun baru untuk mengakses sistem</p>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm text-gray-600 mb-2" for="name">Nama Lengkap</label>
                    <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('name') border border-red-500 @enderror" 
                           id="name" name="name" type="text" required value="{{ old('name') }}" placeholder="Nama Lengkap">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-gray-600 mb-2" for="email">Email</label>
                    <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('email') border border-red-500 @enderror" 
                           id="email" name="email" type="email" required value="{{ old('email') }}" placeholder="Email Anda">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-gray-600 mb-2" for="password">Password</label>
                    <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('password') border border-red-500 @enderror" 
                           id="password" name="password" type="password" required placeholder="Password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm text-gray-600 mb-2" for="password_confirmation">Konfirmasi Password</label>
                    <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" 
                           id="password_confirmation" name="password_confirmation" type="password" required placeholder="Ulangi Password">
                </div>

                <div class="mb-4">
                    <button class="w-full bg-sidebar text-white font-semibold py-2 px-4 rounded hover:bg-blue-700" type="submit">
                        Daftar
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-sidebar hover:underline">Login di sini</a>
                    </p>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Load Lottie animation
        document.addEventListener('DOMContentLoaded', function() {
            try {
                var animation = lottie.loadAnimation({
                    container: document.getElementById('lottie-animation'),
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: '{{ asset("Doctor.json") }}'
                });

                // Handle animation loaded
                animation.addEventListener('data_ready', function() {
                    console.log('Animation loaded successfully');
                });

                // Handle animation error
                animation.addEventListener('data_failed', function() {
                    console.error('Failed to load animation');
                    // Show fallback message
                    document.getElementById('lottie-animation').innerHTML = '<div class="text-center text-gray-400"><p>Animation tidak dapat dimuat</p></div>';
                });
            } catch (error) {
                console.error('Error loading animation:', error);
                // Show fallback message
                document.getElementById('lottie-animation').innerHTML = '<div class="text-center text-gray-400"><p>Animation tidak dapat dimuat</p></div>';
            }
        });
    </script>
</body>
</html>

