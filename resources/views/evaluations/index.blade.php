<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Evaluasi</title>
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
                <!-- Header -->
                <div class="mb-10">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-2">
                        Evaluasi
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-400">
                        Lihat semua evaluasi tim Anda dari semua proyek
                    </p>
                </div>

                @php
                    // Get all evaluations from user's projects
                    $userProjects = Auth::user()->ownedProjects()->pluck('id');
                    $evaluations = \App\Models\ProjectEvaluation::whereIn('project_id', $userProjects)
                        ->with('project', 'evaluator', 'teamMember')
                        ->latest()
                        ->get();
                @endphp

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-md">
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Evaluasi</p>
                        <p class="text-5xl font-bold text-gray-900 dark:text-white mt-3">{{ $evaluations->count() }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-md">
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Evaluasi Anda</p>
                        <p class="text-5xl font-bold text-gray-900 dark:text-white mt-3">{{ $evaluations->where('evaluator_id', Auth::id())->count() }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-md">
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Proyek Dievaluasi</p>
                        <p class="text-5xl font-bold text-gray-900 dark:text-white mt-3">{{ $evaluations->pluck('project_id')->unique()->count() }}</p>
                    </div>
                </div>

                <!-- Evaluations List -->
                <div class="bg-white dark:bg-gray-800/50 rounded-xl p-8 border border-gray-200 dark:border-gray-700 shadow-md">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Daftar Evaluasi</h2>

                    @if($evaluations->count() > 0)
                        <div class="space-y-4">
                            @foreach($evaluations as $evaluation)
                                <div class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-6 border border-gray-200 dark:border-gray-700 hover:border-black dark:hover:border-white transition-colors">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Left side -->
                                        <div>
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $evaluation->project->name }}</h3>
                                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ $evaluation->nama_tim }}</p>
                                            
                                            <div class="space-y-2">
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm text-gray-600 dark:text-gray-400">Produktivitas Tim:</span>
                                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $evaluation->produktivitas_tim }}%</span>
                                                </div>
                                                <div class="w-full bg-gray-300 dark:bg-gray-600 rounded-full h-2">
                                                    <div class="bg-black dark:bg-white h-2 rounded-full" style="width: {{ $evaluation->produktivitas_tim }}%"></div>
                                                </div>
                                            </div>

                                            <div class="space-y-2 mt-4">
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm text-gray-600 dark:text-gray-400">Efektivitas Sistem:</span>
                                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $evaluation->efektivitas_sistem }}%</span>
                                                </div>
                                                <div class="w-full bg-gray-300 dark:bg-gray-600 rounded-full h-2">
                                                    <div class="bg-black dark:bg-white h-2 rounded-full" style="width: {{ $evaluation->efektivitas_sistem }}%"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right side -->
                                        <div>
                                            <div class="mb-4">
                                                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">Dievaluasi oleh</p>
                                                <p class="font-semibold text-gray-900 dark:text-white">{{ $evaluation->evaluator->name }}</p>
                                            </div>

                                            <div class="mb-4">
                                                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">Anggota Tim</p>
                                                <p class="font-semibold text-gray-900 dark:text-white">{{ $evaluation->teamMember->name }}</p>
                                            </div>

                                            <div class="mb-4">
                                                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">Tanggal</p>
                                                <p class="font-semibold text-gray-900 dark:text-white">{{ $evaluation->created_at->format('d M Y H:i') }}</p>
                                            </div>

                                            @if($evaluation->catatan)
                                                <div>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">Catatan</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($evaluation->catatan, 100) }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="text-gray-600 dark:text-gray-400 text-lg mb-4">Tidak ada evaluasi</p>
                            <a href="{{ route('projects.index') }}" class="inline-block bg-black dark:bg-white hover:bg-gray-900 dark:hover:bg-gray-100 text-white dark:text-black font-semibold py-2 px-6 rounded-lg transition-colors">
                                Kelola Proyek
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
