<x-app-layout>
    <div class="p-6">

        <a href="{{ route('evaluasi.index') }}"
            class="px-3 py-1 bg-gray-700 text-black rounded-lg hover:bg-black-800 text-sm">
            ← Kembali
        </a>

        <h1 class="text-3xl font-bold text-black-800 dark:text-black-200 mt-4">
            Detail Evaluasi — {{ $evaluasi->nama_tim }}
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

            <!-- Chart -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-3">
                    Grafik Evaluasi 📊
                </h2>
                <canvas id="chartEvaluasi"></canvas>
            </div>

            <!-- Catatan -->
            <div class="bg-yellow-50 border border-yellow-300 text-yellow-900 p-6 rounded-lg shadow">
                <h3 class="font-semibold text-lg mb-3">Catatan / Deskripsi:</h3>
                <p class="text-black-800 dark:text-black-200 leading-relaxed">
                    {{ $evaluasi->catatan ?? 'Tidak ada catatan.' }}
                </p>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById("chartEvaluasi"), {
            type: "bar",
            data: {
                labels: ["Efektivitas", "Produktivitas"],
                datasets: [{
                    label: "Nilai Evaluasi",
                    data: [{{ $evaluasi->efektivitas_sistem }}, {{ $evaluasi->produktivitas_tim }}],
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true, max: 10 } }
            }
        });
    </script>
</x-app-layout>