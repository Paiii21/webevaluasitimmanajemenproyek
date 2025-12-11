<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Daftar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero-pattern {
            background: radial-gradient(circle at top right, rgba(0, 0, 0, 0.05) 0%, transparent 50%), 
                        radial-gradient(circle at bottom left, rgba(0, 0, 0, 0.05) 0%, transparent 50%);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-white to-gray-50 dark:from-gray-950 dark:to-black min-h-screen">
    <div class="min-h-screen hero-pattern flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white/80 dark:bg-black/80 backdrop-blur-sm border-b border-gray-200 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="h-8 w-8 rounded-full bg-black dark:bg-white flex items-center justify-center">
                            <span class="text-white dark:text-black font-bold text-lg">TE</span>
                        </div>
                        <span class="ml-2 text-xl font-bold text-gray-900 dark:text-white">{{ config('app.name', 'Laravel') }}</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ url('/') }}" class="text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            Beranda
                        </a>
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            Masuk
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-20">
            <div class="w-full max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <!-- Left Side - Benefits -->
                    <div class="hidden lg:block">
                        <h2 class="text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                            Bergabunglah dengan Kami
                        </h2>
                        <p class="text-xl text-gray-600 dark:text-gray-400 mb-12">
                            Buat akun gratis dan mulai mengevaluasi kinerja tim Anda hari ini.
                        </p>
                        
                        <div class="space-y-8">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4">
                                    <svg class="w-6 h-6 text-black dark:text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Gratis Selamanya</h3>
                                    <p class="text-gray-600 dark:text-gray-400 mt-2">Tidak ada biaya tersembunyi</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4">
                                    <svg class="w-6 h-6 text-black dark:text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Setup Mudah</h3>
                                    <p class="text-gray-600 dark:text-gray-400 mt-2">Cukup beberapa klik untuk memulai</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4">
                                    <svg class="w-6 h-6 text-black dark:text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Aman & Terpercaya</h3>
                                    <p class="text-gray-600 dark:text-gray-400 mt-2">Data Anda terenkripsi dan terlindungi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Form -->
                    <div>
                        <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-4">Buat Akun</h1>
                        <p class="text-xl text-gray-600 dark:text-gray-400 mb-12">Mulai perjalanan Anda bersama kami</p>

                        <form method="POST" action="{{ route('register') }}" class="space-y-6 max-w-md">
                            @csrf

                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Nama Lengkap</label>
                                <input 
                                    id="name" 
                                    type="text" 
                                    name="name" 
                                    value="{{ old('name') }}"
                                    required 
                                    autofocus
                                    class="w-full px-4 py-4 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-black focus:border-transparent transition-colors" 
                                    placeholder="John Doe"
                                />
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Email</label>
                                <input 
                                    id="email" 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email') }}"
                                    required
                                    class="w-full px-4 py-4 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-black focus:border-transparent transition-colors" 
                                    placeholder="nama@email.com"
                                />
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Password</label>
                                <input 
                                    id="password" 
                                    type="password" 
                                    name="password" 
                                    required
                                    class="w-full px-4 py-4 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-black focus:border-transparent transition-colors" 
                                    placeholder="••••••••"
                                />
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Konfirmasi Password</label>
                                <input 
                                    id="password_confirmation" 
                                    type="password" 
                                    name="password_confirmation" 
                                    required
                                    class="w-full px-4 py-4 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-black focus:border-transparent transition-colors" 
                                    placeholder="••••••••"
                                />
                                @error('password_confirmation')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <label class="flex items-start cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    name="agree_terms"
                                    class="w-4 h-4 mt-1 text-black dark:text-white rounded border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-black"
                                />
                                <span class="ml-3 text-sm text-gray-600 dark:text-gray-400">
                                    Saya setuju dengan 
                                    <a href="#" class="text-black dark:text-white hover:text-gray-700 dark:hover:text-gray-300 font-semibold">Ketentuan Layanan</a> 
                                    dan 
                                    <a href="#" class="text-black dark:text-white hover:text-gray-700 dark:hover:text-gray-300 font-semibold">Kebijakan Privasi</a>
                                </span>
                            </label>

                            <button 
                                type="submit"
                                class="w-full bg-black dark:bg-white hover:bg-gray-900 dark:hover:bg-gray-100 text-white dark:text-black font-semibold py-4 rounded-lg transition-colors shadow-lg hover:shadow-xl text-lg"
                            >
                                Daftar
                            </button>
                        </form>

                        <div class="relative my-10">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300 dark:border-gray-700"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white dark:bg-black text-gray-500 dark:text-gray-400">Sudah punya akun?</span>
                            </div>
                        </div>

                        <a 
                            href="{{ route('login') }}"
                            class="block w-full max-w-md text-center border-2 border-black dark:border-white text-black dark:text-white hover:bg-gray-100 dark:hover:bg-gray-900 font-semibold py-4 rounded-lg transition-colors text-lg"
                        >
                            Masuk Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
