<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Evaluasi Proyek: {{ $project->name }}
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
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Daftar Evaluasi</h3>
                
                @if($project->owner_id == Auth::id() || $project->projectMembers()->where('user_id', Auth::id())->where('role', 'manager')->exists())
                    <a href="{{ route('projects.evaluations.create', $project) }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Buat Evaluasi
                    </a>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse border">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                            <th class="border px-3 py-2">Nama Tim</th>
                            <th class="border px-3 py-2">Anggota</th>
                            <th class="border px-3 py-2">Efektivitas</th>
                            <th class="border px-3 py-2">Produktivitas</th>
                            <th class="border px-3 py-2">Pembuat</th>
                            <th class="border px-3 py-2">Tanggal</th>
                            <th class="border px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($evaluations as $evaluation)
                            <tr>
                                <td class="border px-3 py-2">{{ $evaluation->nama_tim }}</td>
                                <td class="border px-3 py-2">{{ $evaluation->teamMember ? $evaluation->teamMember->name : 'N/A' }}</td>
                                <td class="border px-3 py-2 text-center">
                                    <span class="px-2 py-1 rounded bg-blue-100 text-blue-800">
                                        {{ $evaluation->efektivitas_sistem }}
                                    </span>
                                </td>
                                <td class="border px-3 py-2 text-center">
                                    <span class="px-2 py-1 rounded bg-green-100 text-green-800">
                                        {{ $evaluation->produktivitas_tim }}
                                    </span>
                                </td>
                                <td class="border px-3 py-2">{{ $evaluation->evaluator->name }}</td>
                                <td class="border px-3 py-2 text-center">{{ $evaluation->created_at->format('d M Y') }}</td>
                                <td class="border px-3 py-2 text-center">
                                    <a href="{{ route('projects.evaluations.show', [$project, $evaluation]) }}"
                                        class="text-blue-600 hover:text-blue-900 text-sm">Lihat</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="border px-3 py-4 text-center text-gray-500">
                                    Belum ada evaluasi untuk proyek ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">
                <a href="{{ route('projects.show', $project) }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                    Kembali ke Proyek
                </a>
            </div>
        </div>
    </div>
</x-app-layout>