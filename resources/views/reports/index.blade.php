<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Laporan</title>
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
                        Laporan
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-400">
                        Analisis dan insight kinerja tim Anda
                    </p>
                </div>

                @php
                    $userProjects = Auth::user()->ownedProjects()->with('projectEvaluations')->get();
                    $totalEvaluations = $userProjects->sum(fn($p) => $p->projectEvaluations->count());
                    $avgProductivity = $totalEvaluations > 0 
                        ? round(\App\Models\ProjectEvaluation::whereIn('project_id', $userProjects->pluck('id'))->avg('produktivitas_tim'))
                        : 0;
                    $avgEffectiveness = $totalEvaluations > 0
                        ? round(\App\Models\ProjectEvaluation::whereIn('project_id', $userProjects->pluck('id'))->avg('efektivitas_sistem'))
                        : 0;
                @endphp

                <!-- Summary Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-md">
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Evaluasi</p>
                        <p class="text-5xl font-bold text-gray-900 dark:text-white mt-3">{{ $totalEvaluations }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs mt-2">Di semua proyek</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-md">
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Rata-rata Produktivitas</p>
                        <p class="text-5xl font-bold text-gray-900 dark:text-white mt-3">{{ $avgProductivity }}%</p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs mt-2">Semua tim</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-md">
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Rata-rata Efektivitas Sistem</p>
                        <p class="text-5xl font-bold text-gray-900 dark:text-white mt-3">{{ $avgEffectiveness }}%</p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs mt-2">Semua tim</p>
                    </div>
                </div>

                <!-- Project Reports -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Laporan Per Proyek</h2>
                    
                    @if($userProjects->count() > 0)
                        @foreach($userProjects as $project)
                            @php
                                $projectEvals = $project->projectEvaluations;
                                $projectAvgProd = $projectEvals->count() > 0 ? round($projectEvals->avg('produktivitas_tim')) : 0;
                                $projectAvgEff = $projectEvals->count() > 0 ? round($projectEvals->avg('efektivitas_sistem')) : 0;
                            @endphp
                            <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-md">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">{{ $project->name }}</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium mb-2">Evaluasi</p>
                                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $projectEvals->count() }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium mb-2">Avg Produktivitas</p>
                                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $projectAvgProd }}%</p>
                                        <div class="w-full bg-gray-300 dark:bg-gray-600 rounded-full h-2 mt-2">
                                            <div class="bg-black dark:bg-white h-2 rounded-full" style="width: {{ $projectAvgProd }}%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium mb-2">Avg Efektivitas</p>
                                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $projectAvgEff }}%</p>
                                        <div class="w-full bg-gray-300 dark:bg-gray-600 rounded-full h-2 mt-2">
                                            <div class="bg-black dark:bg-white h-2 rounded-full" style="width: {{ $projectAvgEff }}%"></div>
                                        </div>
                                    </div>
                                </div>

                                @if($projectEvals->count() > 0)
                                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Evaluasi Terbaru</p>
                                        <div class="space-y-3">
                                            @foreach($projectEvals->take(3) as $eval)
                                                <div class="flex justify-between items-center text-sm">
                                                    <div>
                                                        <p class="font-medium text-gray-900 dark:text-white">{{ $eval->teamMember->name }}</p>
                                                        <p class="text-gray-500 dark:text-gray-400">{{ $eval->created_at->format('d M Y') }}</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="font-semibold text-gray-900 dark:text-white">Prod: {{ $eval->produktivitas_tim }}% | Efek: {{ $eval->efektivitas_sistem }}%</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="bg-white dark:bg-gray-800/50 rounded-xl p-12 border border-gray-200 dark:border-gray-700 shadow-md text-center">
                            <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <p class="text-gray-600 dark:text-gray-400 text-lg mb-4">Tidak ada proyek</p>
                            <a href="{{ route('projects.index') }}" class="inline-block bg-black dark:bg-white hover:bg-gray-900 dark:hover:bg-gray-100 text-white dark:text-black font-semibold py-2 px-6 rounded-lg transition-colors">
                                Buat Proyek Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
