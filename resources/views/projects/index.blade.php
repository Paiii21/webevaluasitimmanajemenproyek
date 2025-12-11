<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Proyek</title>
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
                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-6 bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-700 text-green-800 dark:text-green-300 px-6 py-4 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Header Section -->
                <div class="mb-10">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-2">
                        Proyek Saya
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-400">
                        Kelola dan pantau semua proyek Anda di sini
                    </p>
                </div>

                <!-- Action Buttons & Stats -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
                    <a href="{{ route('projects.create') }}" class="bg-black dark:bg-white hover:bg-gray-900 dark:hover:bg-gray-100 text-white dark:text-black font-semibold py-3 px-8 rounded-lg transition-colors shadow-lg hover:shadow-xl inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Proyek Baru
                    </a>
                    
                    <div class="flex items-center gap-4">
                        <div class="text-center">
                            <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Total Proyek</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $projects->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Projects Grid -->
                @if($projects->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($projects as $project)
                            <div class="card-hover bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-md">
                                <!-- Project Name -->
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                                    {{ $project->name }}
                                </h3>
                                
                                <!-- Project Description -->
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">
                                    {{ $project->description ?? 'Tidak ada deskripsi' }}
                                </p>
                                
                                <!-- Stats -->
                                <div class="flex gap-3 mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                                    <div class="flex-1">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Anggota</p>
                                        <p class="text-lg font-bold text-gray-900 dark:text-white">
                                            {{ $project->project_members_count ?? $project->projectMembers()->count() }}
                                        </p>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Evaluasi</p>
                                        <p class="text-lg font-bold text-gray-900 dark:text-white">
                                            {{ $project->project_evaluations_count ?? $project->projectEvaluations()->count() }}
                                        </p>
                                    </div>
                                </div>
                                
                                <!-- Actions -->
                                <div class="flex gap-2">
                                    <a href="{{ route('projects.show', $project) }}" class="flex-1 bg-black dark:bg-white hover:bg-gray-900 dark:hover:bg-gray-100 text-white dark:text-black px-4 py-2 rounded-lg text-sm font-semibold transition-colors text-center">
                                        Lihat
                                    </a>
                                    @if($project->owner_id == Auth::id() || $project->projectMembers()->where('user_id', Auth::id())->where('role', 'manager')->exists())
                                        <a href="{{ route('projects.edit', $project) }}" class="flex-1 border-2 border-black dark:border-white text-black dark:text-white hover:bg-gray-100 dark:hover:bg-gray-900 px-4 py-2 rounded-lg text-sm font-semibold transition-colors text-center">
                                            Edit
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="bg-white dark:bg-gray-800/50 rounded-xl p-12 border border-gray-200 dark:border-gray-700 shadow-md text-center">
                        <svg class="w-24 h-24 text-gray-400 dark:text-gray-600 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Belum ada proyek</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
                            Anda belum memiliki proyek apapun. Buat proyek pertama Anda sekarang dan mulai mengelola tim!
                        </p>
                        <a href="{{ route('projects.create') }}" class="inline-block bg-black dark:bg-white hover:bg-gray-900 dark:hover:bg-gray-100 text-white dark:text-black font-semibold py-3 px-8 rounded-lg transition-colors shadow-lg hover:shadow-xl">
                            Buat Proyek Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>