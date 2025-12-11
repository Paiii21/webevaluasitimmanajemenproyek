<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $project->name }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $project->description ?: 'Tidak ada deskripsi' }}</p>
                </div>
                
                <div class="flex space-x-2">
                    @if($project->owner_id == Auth::id() || $project->projectMembers()->where('user_id', Auth::id())->where('role', 'manager')->exists())
                        <a href="{{ route('projects.edit', $project) }}"
                            class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 text-sm">
                            Edit Proyek
                        </a>
                    @endif
                </div>
            </div>
            
            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 space-x-4">
                <span>Pemilik: {{ $project->owner->name }}</span>
                <span>•</span>
                <span>Anggota: {{ $project->projectMembers()->count() }}</span>
                <span>•</span>
                <span>Dibuat: {{ $project->created_at->format('d M Y') }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Project Members Section -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Anggota Proyek</h3>
                        @if($project->owner_id == Auth::id() || $project->projectMembers()->where('user_id', Auth::id())->where('role', 'manager')->exists())
                            <a href="{{ route('projects.members.index', $project) }}"
                                class="text-sm bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                Kelola Anggota
                            </a>
                        @endif
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                    <th class="border px-3 py-2">Nama</th>
                                    <th class="border px-3 py-2">Email</th>
                                    <th class="border px-3 py-2">Peran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($project->projectMembers as $member)
                                    <tr>
                                        <td class="border px-3 py-2">{{ $member->user->name }}</td>
                                        <td class="border px-3 py-2">{{ $member->user->email }}</td>
                                        <td class="border px-3 py-2">
                                            <span class="px-2 py-1 rounded text-xs
                                                @if($member->role === 'owner') bg-purple-100 text-purple-800
                                                @elseif($member->role === 'manager') bg-blue-100 text-blue-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst($member->role) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="border px-3 py-4 text-center text-gray-500">
                                            Belum ada anggota dalam proyek ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Project Summary Section -->
            <div>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Ringkasan Proyek</h3>
                    
                    <div class="space-y-4">
                        <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <div class="text-sm text-blue-800 dark:text-blue-200">Jumlah Anggota</div>
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $project->projectMembers()->count() }}</div>
                        </div>
                        
                        <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <div class="text-sm text-green-800 dark:text-green-200">Jumlah Evaluasi</div>
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $project->projectEvaluations()->count() }}</div>
                        </div>
                        
                        <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                            <div class="text-sm text-yellow-800 dark:text-yellow-200">Evaluasi Terakhir</div>
                            <div class="text-lg font-bold text-yellow-600 dark:text-yellow-400">
                                {{ $project->projectEvaluations()->latest()->first() ? $project->projectEvaluations()->latest()->first()->created_at->format('d M Y') : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mt-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Aksi Cepat</h3>
                    
                    <div class="space-y-3">
                        <a href="{{ route('projects.evaluations.create', $project) }}"
                            class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Buat Evaluasi
                        </a>
                        <a href="{{ route('projects.evaluations.index', $project) }}"
                            class="block w-full text-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Lihat Evaluasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>