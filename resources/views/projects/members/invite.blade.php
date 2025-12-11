<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undang Anggota - {{ $project->nama_proyek }}</title>
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
                    <a href="{{ route('projects.members.index', $project) }}" class="inline-flex items-center text-black dark:text-white hover:text-gray-600 dark:hover:text-gray-400 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Anggota
                    </a>
                    <h1 class="text-4xl font-bold mb-2">Undang Anggota</h1>
                    <p class="text-gray-600 dark:text-gray-400">{{ $project->nama_proyek }}</p>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-6 p-4 border-l-4 border-black dark:border-white bg-gray-50 dark:bg-gray-900">
                        <p class="text-black dark:text-white">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Invitation Form -->
                <div class="max-w-2xl">
                    <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6 mb-8">
                        <h2 class="text-2xl font-bold mb-6">Kirim Undangan Baru</h2>
                        
                        <form action="{{ route('projects.members.store', $project) }}" method="POST">
                            @csrf

                            <!-- Email Input -->
                            <div class="mb-6">
                                <label for="email" class="block text-sm font-semibold mb-2">
                                    Email Anggota <span class="text-red-600">*</span>
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="email@example.com" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-900 text-black dark:text-white focus:outline-none focus:border-black dark:focus:border-white transition-colors @error('email') border-red-600 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                @if(session('error'))
                                    <p class="mt-1 text-sm text-red-600">{{ session('error') }}</p>
                                @endif
                            </div>

                            <!-- Role Selection -->
                            <div class="mb-8">
                                <label for="role" class="block text-sm font-semibold mb-2">
                                    Peran Anggota <span class="text-red-600">*</span>
                                </label>
                                <select name="role" id="role" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-900 text-black dark:text-white focus:outline-none focus:border-black dark:focus:border-white transition-colors @error('role') border-red-600 @enderror">
                                    <option value="member" {{ old('role') === 'member' ? 'selected' : '' }}>Member</option>
                                    <option value="manager" {{ old('role') === 'manager' ? 'selected' : '' }}>Manager</option>
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-4">
                                <button type="submit" class="px-6 py-3 bg-black dark:bg-white text-white dark:text-black font-medium rounded hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                                    Kirim Undangan
                                </button>
                                <a href="{{ route('projects.members.index', $project) }}" class="px-6 py-3 border border-black dark:border-white text-black dark:text-white hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors rounded font-medium">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Pending Invitations -->
                @if($invitations->count() > 0)
                    <div class="mt-8">
                        <h2 class="text-2xl font-bold mb-4">Undangan Tertunda</h2>
                        <div class="space-y-4">
                            @foreach($invitations as $invitation)
                                <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="text-lg font-semibold text-black dark:text-white">{{ $invitation->email }}</h4>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Dikirim oleh: {{ $invitation->inviter->name }}</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Kadaluarsa: {{ $invitation->expires_at->format('d M Y') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-block px-3 py-1 rounded text-sm font-medium
                                                @if($invitation->role === 'manager') bg-gray-700 dark:bg-gray-300 text-white dark:text-black
                                                @else bg-gray-200 dark:bg-gray-800 text-black dark:text-white
                                                @endif">
                                                {{ ucfirst($invitation->role) }}
                                            </span>
                                            @if($project->owner_id == Auth::id())
                                                <form action="{{ route('projects.members.remove-invitation', [$project, $invitation]) }}" method="POST" class="mt-3" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan undangan ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-4 py-2 border border-red-600 text-red-600 rounded hover:bg-red-600 hover:text-white transition-colors font-medium text-sm">
                                                        Batal
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>