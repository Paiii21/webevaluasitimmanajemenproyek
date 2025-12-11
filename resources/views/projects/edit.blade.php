<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Proyek - {{ $project->nama_proyek }}</title>
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
                    <h1 class="text-4xl font-bold mb-2">Edit Proyek</h1>
                    <p class="text-gray-600 dark:text-gray-400">{{ $project->nama_proyek }}</p>
                </div>

                <!-- Form -->
                <form action="{{ route('projects.update', $project) }}" method="POST" class="max-w-2xl">
                    @csrf
                    @method('PUT')

                    <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6 mb-6">
                        <!-- Project Name -->
                        <div class="mb-6">
                            <label for="nama_proyek" class="block text-sm font-semibold mb-2">
                                Nama Proyek <span class="text-red-600">*</span>
                            </label>
                            <input type="text" name="nama_proyek" id="nama_proyek" value="{{ old('nama_proyek', $project->nama_proyek) }}" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-900 text-black dark:text-white focus:outline-none focus:border-black dark:focus:border-white transition-colors @error('nama_proyek') border-red-600 @enderror">
                            @error('nama_proyek')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Project Description -->
                        <div class="mb-6">
                            <label for="deskripsi" class="block text-sm font-semibold mb-2">
                                Deskripsi Proyek
                            </label>
                            <textarea name="deskripsi" id="deskripsi" rows="5" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-900 text-black dark:text-white focus:outline-none focus:border-black dark:focus:border-white transition-colors @error('deskripsi') border-red-600 @enderror">{{ old('deskripsi', $project->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <button type="submit" class="px-6 py-3 bg-black dark:bg-white text-white dark:text-black font-medium rounded hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('projects.show', $project) }}" class="px-6 py-3 border border-black dark:border-white text-black dark:text-white hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors rounded font-medium">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>