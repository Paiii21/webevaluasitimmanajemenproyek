<x-app-layout>
    <x-slot name="header">
        @if(auth()->user()->isManager() || auth()->user()->isAdmin())
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Dashboard Evaluasi Tim (Manager)
            </h2>
        @else
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Dashboard Evaluasi Produktivitas Tim
            </h2>
        @endif
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(auth()->user()->isManager() || auth()->user()->isAdmin())
                <!-- Manager view - show all evaluations with user names and actions -->
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('manager.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 inline-block">
                        + Tambah Evaluasi
                    </a>

                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        Total Evaluasi: {{ $evaluasis->count() }}
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                <th class="border px-3 py-2">Nama Tim</th>
                                <th class="border px-3 py-2">User</th>
                                <th class="border px-3 py-2">Efektivitas Sistem</th>
                                <th class="border px-3 py-2">Produktivitas Tim</th>
                                <th class="border px-3 py-2">Catatan</th>
                                <th class="border px-3 py-2">Tanggal</th>
                                <th class="border px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($evaluasis as $item)
                                <tr>
                                    <td class="border px-3 py-2">{{ $item->nama_tim }}</td>
                                    <td class="border px-3 py-2">{{ $item->user->name ?? 'N/A' }}</td>
                                    <td class="border px-3 py-2 text-center">
                                        <span class="px-2 py-1 rounded bg-blue-100 text-blue-800">
                                            {{ $item->efektivitas_sistem }}
                                        </span>
                                    </td>
                                    <td class="border px-3 py-2 text-center">
                                        <span class="px-2 py-1 rounded bg-green-100 text-green-800">
                                            {{ $item->produktivitas_tim }}
                                        </span>
                                    </td>
                                    <td class="border px-3 py-2 max-w-xs truncate">{{ $item->catatan }}</td>
                                    <td class="border px-3 py-2 text-center">{{ $item->created_at->format('d M Y') }}</td>
                                    <td class="border px-3 py-2 text-center">
                                        <div class="flex space-x-2 justify-center">
                                            <a href="{{ route('manager.show', $item) }}"
                                                class="text-blue-600 hover:text-blue-900 text-sm">Lihat</a>
                                            <a href="{{ route('manager.edit', $item) }}"
                                                class="text-yellow-600 hover:text-yellow-900 text-sm">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="border px-3 py-4 text-center text-gray-500">
                                        Belum ada data evaluasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Regular user view - show only their evaluations -->
                <a href="{{ route('evaluasi.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
                    + Tambah Evaluasi
                </a>

                <table class="w-full border-collapse border mt-4">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                            <th class="border px-3 py-2">Nama Tim</th>
                            <th class="border px-3 py-2">Efektivitas Sistem</th>
                            <th class="border px-3 py-2">Produktivitas Tim</th>
                            <th class="border px-3 py-2">Catatan</th>
                            <th class="border px-3 py-2">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($evaluasis as $item)
                            <tr>
                                <td class="border px-3 py-2">{{ $item->nama_tim }}</td>
                                <td class="border px-3 py-2 text-center">
                                    <span class="px-2 py-1 rounded bg-blue-100 text-blue-800">
                                        {{ $item->efektivitas_sistem }}
                                    </span>
                                </td>
                                <td class="border px-3 py-2 text-center">
                                    <span class="px-2 py-1 rounded bg-green-100 text-green-800">
                                        {{ $item->produktivitas_tim }}
                                    </span>
                                </td>
                                <td class="border px-3 py-2">{{ $item->catatan }}</td>
                                <td class="border px-3 py-2 text-center">{{ $item->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="border px-3 py-4 text-center text-gray-500">
                                    Belum ada data evaluasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>