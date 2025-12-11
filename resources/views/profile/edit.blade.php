<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - {{ config('app.name', 'Laravel') }}</title>
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
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-black dark:text-white hover:text-gray-600 dark:hover:text-gray-400 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali
                    </a>
                    <h1 class="text-4xl font-bold mb-2">Profil Saya</h1>
                    <p class="text-gray-600 dark:text-gray-400">Kelola informasi akun dan pengaturan keamanan Anda</p>
                </div>

                <!-- Profile Sections -->
                <div class="space-y-6 max-w-2xl">
                    <!-- Update Profile Information -->
                    <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <!-- Update Password -->
                    <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6">
                        @include('profile.partials.update-password-form')
                    </div>

                    <!-- Delete Account -->
                    <div class="border border-red-300 dark:border-red-700 rounded-lg p-6">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
