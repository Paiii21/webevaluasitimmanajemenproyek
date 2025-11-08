<x-app-layout>
    <div class="container mx-auto mt-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Tambah Evaluasi</h2>

        <form action="{{ route('evaluasi.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Nama Tim</label>
                <input type="text" name="nama_tim" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Efektivitas Sistem (1–10)</label>
                <input type="number" name="efektivitas_sistem" min="1" max="10" class="w-full border rounded px-3 py-2"
                    required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Produktivitas Tim (1–10)</label>
                <input type="number" name="produktivitas_tim" min="1" max="10" class="w-full border rounded px-3 py-2"
                    required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Catatan</label>
                <textarea name="catatan" class="w-full border rounded px-3 py-2"></textarea>
            </div>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>