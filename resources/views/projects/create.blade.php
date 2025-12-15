<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Proyek Baru</title>
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
                    <h1 class="text-4xl font-bold mb-2">Buat Proyek Baru</h1>
                    <p class="text-gray-600 dark:text-gray-400">Mulai dengan membuat proyek baru untuk mengelola tim Anda</p>
                </div>

                <!-- Form -->
                <form action="{{ route('projects.store') }}" method="POST" class="max-w-2xl">
                    @csrf

                    <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6 mb-6">
                        <!-- Project Name -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold mb-2">
                                Nama Proyek <span class="text-red-600">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Masukkan nama proyek" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-900 text-black dark:text-white focus:outline-none focus:border-black dark:focus:border-white transition-colors @error('name') border-red-600 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Project Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-semibold mb-2">
                                Deskripsi Proyek
                            </label>
                            <textarea name="description" id="description" rows="5" placeholder="Jelaskan tujuan dan gambaran umum proyek ini..." class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-900 text-black dark:text-white focus:outline-none focus:border-black dark:focus:border-white transition-colors @error('description') border-red-600 @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <button type="submit" class="px-6 py-3 bg-black dark:bg-white text-white dark:text-black font-medium rounded hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                            Buat Proyek
                        </button>
                        <a href="{{ route('projects.index') }}" class="px-6 py-3 border border-black dark:border-white text-black dark:text-white hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors rounded font-medium">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>