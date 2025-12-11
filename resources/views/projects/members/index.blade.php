<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggota Proyek - {{ $project->nama_proyek }}</title>
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
                    <h1 class="text-4xl font-bold mb-2">Anggota Proyek</h1>
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
                    <a href="{{ route('projects.members.invite', $project) }}" class="inline-block px-6 py-3 bg-black dark:bg-white text-white dark:text-black font-medium rounded hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                        + Undang Anggota
                    </a>
                </div>

                <!-- Members List -->
                @if ($project->projectMembers->count() > 0)
                    <div class="space-y-4 mb-8">
                        @foreach ($project->projectMembers as $member)
                            <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-semibold text-black dark:text-white">{{ $member->user->name }}</h3>
                                        <p class="text-gray-600 dark:text-gray-400">{{ $member->user->email }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-block px-3 py-1 rounded text-sm font-medium
                                            @if($member->role === 'owner') bg-black dark:bg-white text-white dark:text-black
                                            @elseif($member->role === 'manager') bg-gray-700 dark:bg-gray-300 text-white dark:text-black
                                            @else bg-gray-200 dark:bg-gray-800 text-black dark:text-white
                                            @endif">
                                            {{ ucfirst($member->role) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Actions -->
                                @if($project->owner_id == Auth::id() && $member->user_id != Auth::id())
                                    <div class="flex gap-2">
                                        <form action="{{ route('projects.members.update-role', [$project, $member]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <select name="role" onchange="this.form.submit()" class="px-4 py-2 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-900 text-black dark:text-white focus:outline-none focus:border-black dark:focus:border-white transition-colors">
                                                <option value="member" {{ $member->role === 'member' ? 'selected' : '' }}>Member</option>
                                                <option value="manager" {{ $member->role === 'manager' ? 'selected' : '' }}>Manager</option>
                                            </select>
                                        </form>
                                        <form action="{{ route('projects.members.remove', [$project, $member]) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 border border-red-600 text-red-600 rounded hover:bg-red-600 hover:text-white transition-colors font-medium">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                @elseif($project->owner_id == Auth::id() && $member->user_id == Auth::id())
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Anda adalah pemilik proyek</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 border border-gray-300 dark:border-gray-700 rounded-lg mb-8">
                        <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-400 mb-2">Belum ada anggota</h3>
                        <p class="text-gray-500 dark:text-gray-500 mb-4">Mulai dengan mengundang anggota pertama ke proyek ini</p>
                    </div>
                @endif

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