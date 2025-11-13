<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Tambah Evaluasi Tim
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('evaluasi.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200">Nama Tim</label>
                    <input type="text" name="nama_tim" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200">Efektivitas Sistem (1–10)</label>
                    <input type="number" name="efektivitas_sistem" min="1" max="10" class="w-full p-2 border rounded"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200">Produktivitas Tim (1–10)</label>
                    <input type="number" name="produktivitas_tim" min="1" max="10" class="w-full p-2 border rounded"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200">Catatan Tambahan</label>
                    <textarea name="catatan" rows="3" class="w-full p-2 border rounded"></textarea>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan Evaluasi
                </button>
            </form>
        </div>
    </div>
</x-app-layout>