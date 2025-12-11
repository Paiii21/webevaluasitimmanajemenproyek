<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Sistem Evaluasi Tim</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
            <script>
                tailwind.config = {
                    darkMode: 'class'
                }
            </script>
        @endif>
        
        <style>
            .hero-pattern {
                background: radial-gradient(circle at top right, rgba(0, 0, 0, 0.05) 0%, transparent 50%), 
                            radial-gradient(circle at bottom left, rgba(0, 0, 0, 0.05) 0%, transparent 50%);
            }
            .feature-card {
                transition: all 0.3s ease;
            }
            .feature-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="min-h-screen hero-pattern">
            <!-- Navigation -->
            <nav class="bg-white/80 dark:bg-black/80 backdrop-blur-sm sticky top-0 z-50 border-b border-gray-200 dark:border-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 flex items-center">
                                <div class="h-8 w-8 rounded-full bg-black dark:bg-white flex items-center justify-center">
                                    <span class="text-white dark:text-black font-bold text-lg">TE</span>
                                </div>
                                <span class="ml-2 text-xl font-bold text-black dark:text-white">{{ config('app.name', 'Laravel') }}</span>
                            </div>
                        </div>
                        <div class="hidden md:ml-6 md:flex md:items-center md:space-x-8">
                            <a href="#features" class="text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white transition-colors">Fitur</a>
                            <a href="#about" class="text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white transition-colors">Tentang</a>
                            <a href="#contact" class="text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white transition-colors">Kontak</a>
                        </div>
                        <div class="flex items-center">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 bg-black dark:bg-white hover:bg-gray-800 dark:hover:bg-gray-100 text-white dark:text-black px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                        Daftar
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-extrabold text-black dark:text-white tracking-tight">
                        Sistem Evaluasi <span class="font-black">Tim</span> Terbaik
                    </h1>
                    <p class="mt-6 text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                        Kelola kinerja tim Anda dengan mudah dan efisien. Evaluasi produktivitas, efektivitas sistem, dan kolaborasi tim dalam satu platform terintegrasi.
                    </p>
                    <div class="mt-10 flex justify-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-black dark:bg-white hover:bg-gray-800 dark:hover:bg-gray-100 text-white dark:text-black px-8 py-3 rounded-lg text-lg font-semibold transition-colors shadow-lg hover:shadow-xl">
                                Akses Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="bg-black dark:bg-white hover:bg-gray-800 dark:hover:bg-gray-100 text-white dark:text-black px-8 py-3 rounded-lg text-lg font-semibold transition-colors shadow-lg hover:shadow-xl">
                                Mulai Sekarang
                            </a>
                        @endif
                        <a href="#features" class="border-2 border-black dark:border-white text-black dark:text-white hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div id="features" class="py-20 bg-gray-50 dark:bg-gray-900/50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-black dark:text-white">
                            Fitur Unggulan Kami
                        </h2>
                        <p class="mt-4 text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                            Segala yang Anda butuhkan untuk mengevaluasi dan meningkatkan kinerja tim Anda
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Feature 1 -->
                        <div class="feature-card bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
                            <div class="w-12 h-12 rounded-lg bg-black dark:bg-white flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-white dark:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-black dark:text-white mb-2">Evaluasi Tim</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Buat dan kelola evaluasi kinerja tim Anda secara menyeluruh dengan metrik yang relevan.
                            </p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="feature-card bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
                            <div class="w-12 h-12 rounded-lg bg-black dark:bg-white flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-white dark:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-black dark:text-white mb-2">Manajemen Proyek</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Kelola berbagai proyek dan tim Anda dalam satu platform yang terintegrasi.
                            </p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="feature-card bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
                            <div class="w-12 h-12 rounded-lg bg-black dark:bg-white flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-white dark:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-black dark:text-white mb-2">Analisis Data</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Visualisasi grafik dan analisis mendalam untuk pengambilan keputusan yang lebih baik.
                            </p>
                        </div>

                        <!-- Feature 4 -->
                        <div class="feature-card bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
                            <div class="w-12 h-12 rounded-lg bg-black dark:bg-white flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-white dark:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-black dark:text-white mb-2">Keamanan</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Perlindungan data yang ketat dan otentikasi multi-faktor untuk keamanan maksimal.
                            </p>
                        </div>

                        <!-- Feature 5 -->
                        <div class="feature-card bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
                            <div class="w-12 h-12 rounded-lg bg-black dark:bg-white flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-white dark:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-black dark:text-white mb-2">Kolaborasi</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Kerjasama lintas tim dan berbagi insight untuk peningkatan kinerja bersama.
                            </p>
                        </div>

                        <!-- Feature 6 -->
                        <div class="feature-card bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
                            <div class="w-12 h-12 rounded-lg bg-black dark:bg-white flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-white dark:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-black dark:text-white mb-2">Kustomisasi</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Sesuaikan sesuai kebutuhan tim Anda dengan konfigurasi fleksibel.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="bg-black dark:bg-white rounded-2xl p-12 text-center">
                        <h2 class="text-3xl md:text-4xl font-bold text-white dark:text-black mb-4">
                            Siap Meningkatkan Kinerja Tim Anda?
                        </h2>
                        <p class="text-xl text-gray-300 dark:text-gray-700 max-w-2xl mx-auto mb-8">
                            Bergabunglah dengan ribuan tim yang telah menggunakan platform kami untuk mengoptimalkan kerja sama dan produktivitas mereka.
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                            <a href="{{ route('register') }}" class="bg-white dark:bg-black text-black dark:text-white hover:bg-gray-100 dark:hover:bg-gray-900 px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                                Mulai Gratis Sekarang
                            </a>
                            <a href="#about" class="bg-gray-800 dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600 text-white px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                                Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div class="col-span-1 md:col-span-2">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-black dark:bg-white flex items-center justify-center">
                                    <span class="text-white dark:text-black font-bold text-lg">TE</span>
                                </div>
                                <span class="ml-2 text-xl font-bold text-black dark:text-white">{{ config('app.name', 'Laravel') }}</span>
                            </div>
                            <p class="mt-4 text-gray-600 dark:text-gray-400 max-w-md">
                                Platform terpercaya untuk evaluasi dan manajemen kinerja tim Anda. Membantu organisasi mencapai tujuan dengan data yang akurat dan insight yang bermanfaat.
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-black dark:text-white uppercase tracking-wider">Solusi</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-black dark:hover:text-white">Evaluasi Tim</a></li>
                                <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-black dark:hover:text-white">Manajemen Proyek</a></li>
                                <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-black dark:hover:text-white">Analisis Kinerja</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-black dark:text-white uppercase tracking-wider">Dukungan</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-black dark:hover:text-white">Dokumentasi</a></li>
                                <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-black dark:hover:text-white">Panduan</a></li>
                                <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-black dark:hover:text-white">Kontak</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-800 flex flex-col md:flex-row justify-between items-center">
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Hak Cipta Dilindungi.
                        </p>
                        <div class="mt-4 md:mt-0 flex space-x-6">
                            <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-black dark:hover:text-white">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg>
                            </a>
                            <a href="https://github.com/Paiii21/webevaluasitimmanajemenproyek.git" class="text-gray-600 dark:text-gray-400 hover:text-black dark:hover:text-white">
                                <span class="sr-only">GitHub</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>