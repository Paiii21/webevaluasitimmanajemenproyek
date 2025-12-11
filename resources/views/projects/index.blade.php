<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Daftar Proyek Saya
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('projects.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 inline-block">
                    + Buat Proyek Baru
                </a>
                
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Jumlah Proyek: {{ $projects->count() }}
                </div>
            </div>

            @if($projects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($projects as $project)
                        <div class="border rounded-lg p-4 bg-white dark:bg-gray-700 shadow">
                            <h3 class="font-semibold text-lg text-gray-800 dark:text-white mb-2">
                                {{ $project->name }}
                            </h3>
                            
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                                {{ Str::limit($project->description, 100) }}
                            </p>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded dark:bg-blue-200 dark:text-blue-900">
                                    {{ $project->project_members_count ?? $project->projectMembers()->count() }} anggota
                                </span>
                                <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded dark:bg-green-200 dark:text-green-900">
                                    {{ $project->project_evaluations_count ?? $project->projectEvaluations()->count() }} evaluasi
                                </span>
                            </div>
                            
                            <div class="mt-4 flex space-x-2">
                                <a href="{{ route('projects.show', $project) }}"
                                    class="text-blue-600 hover:text-blue-900 text-sm">Lihat</a>
                                @if($project->owner_id == Auth::id() || $project->projectMembers()->where('user_id', Auth::id())->where('role', 'manager')->exists())
                                    <a href="{{ route('projects.edit', $project) }}"
                                        class="text-yellow-600 hover:text-yellow-900 text-sm">Edit</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-gray-400 mb-4">📁</div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Belum ada proyek</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-4">
                        Anda belum memiliki proyek apapun. Buat proyek pertama Anda sekarang!
                    </p>
                    <a href="{{ route('projects.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Buat Proyek Baru
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>