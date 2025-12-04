<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Dashboard Evaluasi Produktivitas Tim
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('evaluasi.create') }}"
                class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
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
                            <td class="border px-3 py-2 text-center">{{ $item->efektivitas_sistem }}</td>
                            <td class="border px-3 py-2 text-center">{{ $item->produktivitas_tim }}</td>
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
        </div>
    </div>
</x-app-layout>