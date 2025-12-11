<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Dashboard Manager Evaluasi Tim
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

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
                        @forelse ($evaluasis as $evaluasi)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="border px-3 py-2">{{ $evaluasi->nama_tim }}</td>
                                <td class="border px-3 py-2">{{ $evaluasi->user->name ?? 'N/A' }}</td>
                                <td class="border px-3 py-2 text-center">
                                    <span class="px-2 py-1 rounded bg-blue-100 text-blue-800">
                                        {{ $evaluasi->efektivitas_sistem }}
                                    </span>
                                </td>
                                <td class="border px-3 py-2 text-center">
                                    <span class="px-2 py-1 rounded bg-green-100 text-green-800">
                                        {{ $evaluasi->produktivitas_tim }}
                                    </span>
                                </td>
                                <td class="border px-3 py-2 max-w-xs truncate">{{ $evaluasi->catatan ?? '-' }}</td>
                                <td class="border px-3 py-2 text-center">{{ $evaluasi->created_at->format('d M Y H:i') }}</td>
                                <td class="border px-3 py-2 text-center">
                                    <div class="flex space-x-2 justify-center">
                                        <a href="{{ route('manager.show', $evaluasi) }}"
                                            class="text-blue-600 hover:text-blue-900 text-sm">Lihat</a>
                                        <a href="{{ route('manager.edit', $evaluasi) }}"
                                            class="text-yellow-600 hover:text-yellow-900 text-sm">Edit</a>
                                        <form action="{{ route('manager.destroy', $evaluasi) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 text-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus evaluasi ini?')">
                                                Hapus
                                            </button>
                                        </form>
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
        </div>
    </div>
</x-app-layout>