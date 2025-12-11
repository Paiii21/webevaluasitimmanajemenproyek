<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi Proyek - {{ $project->nama_proyek }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white dark:bg-black text-black dark:text-white transition-colors">
    <div class="flex h-screen">
        @include('components.sidebar')
        
        <main class="flex-1 ml-64 overflow-auto">
            <div class="p-8">
                <!-- Header -->
                <div class="mb-8">
                    <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center text-black dark:text-white hover:text-gray-600 dark:hover:text-gray-400 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Proyek
                    </a>
                    <h1 class="text-4xl font-bold mb-2">Evaluasi Proyek</h1>
                    <p class="text-gray-600 dark:text-gray-400">{{ $project->nama_proyek }}</p>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-6 p-4 border-l-4 border-black dark:border-white bg-gray-50 dark:bg-gray-900">
                        <p class="text-black dark:text-white">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Action Button -->
                <div class="mb-8">
                    <a href="{{ route('projects.evaluations.create', $project) }}" class="inline-block px-6 py-3 bg-black dark:bg-white text-white dark:text-black font-medium rounded hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                        + Buat Evaluasi
                    </a>
                </div>

                <!-- Evaluations List -->
                @if ($evaluations->count() > 0)
                    <div class="space-y-4">
                        @foreach ($evaluations as $evaluation)
                            <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6 hover:border-gray-500 dark:hover:border-gray-500 transition-colors">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-semibold text-black dark:text-white mb-1">
                                            {{ $evaluation->teamMember->name }}
                                        </h3>
                                        <p class="text-gray-600 dark:text-gray-400">
                                            Tim: {{ $evaluation->nama_tim }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ $evaluation->created_at->format('d M Y') }}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            Oleh: {{ $evaluation->evaluator->name ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Metrics -->
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <div class="flex justify-between items-center mb-2">
                                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Produktivitas</label>
                                            <span class="text-sm font-bold text-black dark:text-white">{{ $evaluation->produktivitas_tim }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-300 dark:bg-gray-700 rounded-full h-2">
                                            <div class="bg-black dark:bg-white h-2 rounded-full" style="width: {{ $evaluation->produktivitas_tim }}%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between items-center mb-2">
                                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Efektivitas</label>
                                            <span class="text-sm font-bold text-black dark:text-white">{{ $evaluation->efektivitas_sistem }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-300 dark:bg-gray-700 rounded-full h-2">
                                            <div class="bg-black dark:bg-white h-2 rounded-full" style="width: {{ $evaluation->efektivitas_sistem }}%"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Notes -->
                                @if ($evaluation->catatan)
                                    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded">
                                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $evaluation->catatan }}</p>
                                    </div>
                                @endif

                                <!-- Actions -->
                                <div class="flex gap-2">
                                    <a href="{{ route('projects.evaluations.show', [$project, $evaluation]) }}" class="px-4 py-2 border border-black dark:border-white text-black dark:text-white hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors rounded">
                                        Lihat Detail
                                    </a>
                                    <a href="{{ route('projects.evaluations.edit', [$project, $evaluation]) }}" class="px-4 py-2 border border-black dark:border-white text-black dark:text-white hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors rounded">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 border border-gray-300 dark:border-gray-700 rounded-lg">
                        <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-400 mb-2">Belum ada evaluasi</h3>
                        <p class="text-gray-500 dark:text-gray-500 mb-4">Mulai dengan membuat evaluasi pertama untuk proyek ini</p>
                    </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>
