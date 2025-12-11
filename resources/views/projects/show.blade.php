<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->nama_proyek }}</title>
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
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center text-black dark:text-white hover:text-gray-600 dark:hover:text-gray-400 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Proyek
                    </a>
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-4xl font-bold mb-2">{{ $project->nama_proyek }}</h1>
                            <p class="text-gray-600 dark:text-gray-400">{{ $project->deskripsi ?: 'Tidak ada deskripsi' }}</p>
                        </div>
                        @if($project->owner_id == Auth::id() || $project->projectMembers()->where('user_id', Auth::id())->where('role', 'manager')->exists())
                            <a href="{{ route('projects.edit', $project) }}" class="px-6 py-3 bg-black dark:bg-white text-white dark:text-black font-medium rounded hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                                Edit Proyek
                            </a>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="col-span-2">
                        <!-- Project Members Section -->
                        <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6 mb-8">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-2xl font-bold">Anggota Proyek</h2>
                                @if($project->owner_id == Auth::id() || $project->projectMembers()->where('user_id', Auth::id())->where('role', 'manager')->exists())
                                    <a href="{{ route('projects.members.index', $project) }}" class="px-4 py-2 bg-black dark:bg-white text-white dark:text-black font-medium rounded hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                                        Kelola Anggota
                                    </a>
                                @endif
                            </div>

                            @if($project->projectMembers->count() > 0)
                                <div class="space-y-3">
                                    @foreach($project->projectMembers as $member)
                                        <div class="flex justify-between items-center p-3 border border-gray-200 dark:border-gray-800 rounded">
                                            <div>
                                                <p class="font-semibold">{{ $member->user->name }}</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $member->user->email }}</p>
                                            </div>
                                            <span class="inline-block px-3 py-1 rounded text-sm font-medium
                                                @if($member->role === 'owner') bg-black dark:bg-white text-white dark:text-black
                                                @elseif($member->role === 'manager') bg-gray-700 dark:bg-gray-300 text-white dark:text-black
                                                @else bg-gray-200 dark:bg-gray-800 text-black dark:text-white
                                                @endif">
                                                {{ ucfirst($member->role) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8 text-gray-600 dark:text-gray-400">
                                    <p>Belum ada anggota dalam proyek ini.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Quick Actions -->
                        <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6">
                            <h2 class="text-2xl font-bold mb-4">Aksi Cepat</h2>
                            <div class="space-y-3">
                                <a href="{{ route('projects.evaluations.create', $project) }}" class="block w-full px-4 py-3 bg-black dark:bg-white text-white dark:text-black font-medium rounded hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors text-center">
                                    + Buat Evaluasi
                                </a>
                                <a href="{{ route('projects.evaluations.index', $project) }}" class="block w-full px-4 py-3 border border-black dark:border-white text-black dark:text-white hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors rounded font-medium text-center">
                                    Lihat Evaluasi
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Stats -->
                    <div>
                        <!-- Project Info Card -->
                        <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6 mb-6">
                            <h3 class="text-lg font-bold mb-4">Informasi Proyek</h3>
                            <div class="space-y-4 text-sm">
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400 mb-1">Pemilik</p>
                                    <p class="font-semibold">{{ $project->owner->name }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400 mb-1">Dibuat</p>
                                    <p class="font-semibold">{{ $project->created_at->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400 mb-1">Diperbarui</p>
                                    <p class="font-semibold">{{ $project->updated_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Stats Card -->
                        <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6">
                            <h3 class="text-lg font-bold mb-4">Statistik</h3>
                            <div class="space-y-4">
                                <div class="p-4 bg-gray-100 dark:bg-gray-900 rounded">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Jumlah Anggota</p>
                                    <p class="text-3xl font-bold">{{ $project->projectMembers()->count() }}</p>
                                </div>
                                <div class="p-4 bg-gray-100 dark:bg-gray-900 rounded">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Jumlah Evaluasi</p>
                                    <p class="text-3xl font-bold">{{ $project->projectEvaluations()->count() }}</p>
                                </div>
                                <div class="p-4 bg-gray-100 dark:bg-gray-900 rounded">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Evaluasi Terakhir</p>
                                    <p class="text-lg font-bold">
                                        {{ $project->projectEvaluations()->latest()->first() ? $project->projectEvaluations()->latest()->first()->created_at->format('d M Y') : 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
