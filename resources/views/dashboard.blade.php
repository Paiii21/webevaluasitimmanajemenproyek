<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero-pattern {
            background: radial-gradient(circle at top right, rgba(0, 0, 0, 0.05) 0%, transparent 50%), 
                        radial-gradient(circle at bottom left, rgba(0, 0, 0, 0.05) 0%, transparent 50%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-white to-gray-50 dark:from-gray-950 dark:to-black min-h-screen">
    <div class="min-h-screen hero-pattern flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white/80 dark:bg-black/80 backdrop-blur-sm sticky top-0 z-50 border-b border-gray-200 dark:border-gray-800">
            <div class="h-16 px-4 sm:px-6 lg:px-8 flex justify-between items-center ml-64">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ config('app.name', 'Laravel') }}</h1>
                </div>
                <div class="relative group">
                    <button class="flex items-center text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <div class="ml-64 flex-1 px-4 sm:px-6 lg:px-8 py-12">
            <div class="max-w-6xl">
                <!-- Welcome Section -->
                <div class="mb-12">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-2">
                        Selamat Datang, {{ Auth::user()->name }}! 👋
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-400">
                        Pantau kinerja dan kelola proyek Anda dari sini
                    </p>
                </div>

                <!-- Stats Grid -->
                @php
                    $allProjects = Auth::user()->ownedProjects();
                    $projectCount = $allProjects->count();
                    $memberCount = Auth::user()->projectMemberships()->distinct('project_id')->count();
                    $evaluationCount = \App\Models\ProjectEvaluation::whereIn('project_id', $allProjects->pluck('id'))->count();
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <!-- Total Projects -->
                    <div class="card-hover bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Proyek</p>
                                <p class="text-5xl font-bold text-gray-900 dark:text-white mt-3">{{ $projectCount }}</p>
                                <p class="text-gray-500 dark:text-gray-400 text-xs mt-2">Proyek yang Anda kelola</p>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                                <svg class="w-10 h-10 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7 12a5 5 0 1110 0A5 5 0 017 12z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Team Members -->
                    <div class="card-hover bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Anggota Tim</p>
                                <p class="text-5xl font-bold text-gray-900 dark:text-white mt-3">{{ $memberCount + 1 }}</p>
                                <p class="text-gray-500 dark:text-gray-400 text-xs mt-2">Termasuk Anda</p>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                                <svg class="w-10 h-10 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20h12a6 6 0 00-6-6 6 6 0 00-6 6z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Evaluations -->
                    <div class="card-hover bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Evaluasi Terbuat</p>
                                <p class="text-5xl font-bold text-gray-900 dark:text-white mt-3">{{ $evaluationCount }}</p>
                                <p class="text-gray-500 dark:text-gray-400 text-xs mt-2">Di semua proyek</p>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                                <svg class="w-10 h-10 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Aksi Cepat</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('projects.create') }}" class="bg-black dark:bg-white hover:bg-gray-900 dark:hover:bg-gray-100 text-white dark:text-black font-semibold py-4 px-6 rounded-lg transition-colors shadow-lg hover:shadow-xl flex items-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Buat Proyek Baru
                        </a>
                        <a href="{{ route('projects.index') }}" class="border-2 border-black dark:border-white text-black dark:text-white hover:bg-gray-100 dark:hover:bg-gray-900 font-semibold py-4 px-6 rounded-lg transition-colors flex items-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Kelola Proyek
                        </a>
                    </div>
                </div>

                <!-- Recent Projects -->
                <div class="bg-white dark:bg-gray-800/50 rounded-xl p-8 border border-gray-200 dark:border-gray-700 shadow-md">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Proyek Terbaru</h2>
                        <a href="{{ route('projects.index') }}" class="text-black dark:text-white hover:text-gray-700 dark:hover:text-gray-300 font-semibold transition-colors">
                            Lihat Semua →
                        </a>
                    </div>

                    @php
                        $recentProjects = Auth::user()->projects()->latest()->take(5)->get();
                    @endphp

                    @if($recentProjects->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentProjects as $project)
                                <div class="card-hover bg-gray-50 dark:bg-gray-700/30 rounded-lg p-4 border border-gray-200 dark:border-gray-700 hover:border-black dark:hover:border-white transition-colors">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $project->name }}</h3>
                                            <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">
                                                {{ Str::limit($project->description, 100) ?? 'Tidak ada deskripsi' }}
                                            </p>
                                        </div>
                                        <a href="{{ route('projects.show', $project) }}" class="bg-black dark:bg-white hover:bg-gray-900 dark:hover:bg-gray-100 text-white dark:text-black px-6 py-2 rounded-lg text-sm font-semibold transition-colors whitespace-nowrap">
                                            Lihat
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-600 dark:text-gray-400 text-lg mb-4">Belum ada proyek</p>
                            <a href="{{ route('projects.create') }}" class="inline-block bg-black dark:bg-white hover:bg-gray-900 dark:hover:bg-gray-100 text-white dark:text-black font-semibold py-2 px-6 rounded-lg transition-colors">
                                Buat Proyek Pertama Anda
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
