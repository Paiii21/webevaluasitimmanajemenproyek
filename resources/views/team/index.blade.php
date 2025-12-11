<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Tim</title>
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
                        Anggota Tim
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-400">
                        Kelola dan pantau semua anggota tim di seluruh proyek Anda
                    </p>
                </div>

                @php
                    // Get all team members from user's projects
                    $userProjects = Auth::user()->ownedProjects()->pluck('id');
                    $teamMembers = \App\Models\ProjectMember::whereIn('project_id', $userProjects)
                        ->with('user', 'project')
                        ->get()
                        ->unique('user_id');
                @endphp

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-md">
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Anggota</p>
                        <p class="text-5xl font-bold text-gray-900 dark:text-white mt-3">{{ $teamMembers->count() }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-md">
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Tim Aktif</p>
                        <p class="text-5xl font-bold text-gray-900 dark:text-white mt-3">{{ Auth::user()->ownedProjects()->count() }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-md">
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Peran Berbeda</p>
                        <p class="text-5xl font-bold text-gray-900 dark:text-white mt-3">3</p>
                    </div>
                </div>

                <!-- Team Members List -->
                <div class="bg-white dark:bg-gray-800/50 rounded-xl p-8 border border-gray-200 dark:border-gray-700 shadow-md">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Daftar Anggota</h2>

                    @if($teamMembers->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th class="text-left py-4 px-4 text-sm font-semibold text-gray-900 dark:text-white">Nama</th>
                                        <th class="text-left py-4 px-4 text-sm font-semibold text-gray-900 dark:text-white">Email</th>
                                        <th class="text-left py-4 px-4 text-sm font-semibold text-gray-900 dark:text-white">Peran</th>
                                        <th class="text-left py-4 px-4 text-sm font-semibold text-gray-900 dark:text-white">Proyek</th>
                                        <th class="text-left py-4 px-4 text-sm font-semibold text-gray-900 dark:text-white">Bergabung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teamMembers as $member)
                                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                            <td class="py-4 px-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                                        <span class="text-gray-900 dark:text-white font-semibold">{{ substr($member->user->name, 0, 1) }}</span>
                                                    </div>
                                                    <span class="font-medium text-gray-900 dark:text-white">{{ $member->user->name }}</span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 text-gray-600 dark:text-gray-400">{{ $member->user->email }}</td>
                                            <td class="py-4 px-4">
                                                <span class="inline-block px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white text-xs font-semibold rounded-full">
                                                    {{ ucfirst($member->role) }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-4 text-gray-600 dark:text-gray-400">{{ $member->project->name }}</td>
                                            <td class="py-4 px-4 text-gray-600 dark:text-gray-400 text-sm">{{ $member->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20h12a6 6 0 00-6-6 6 6 0 00-6 6z"></path>
                            </svg>
                            <p class="text-gray-600 dark:text-gray-400 text-lg mb-4">Tidak ada anggota tim</p>
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
