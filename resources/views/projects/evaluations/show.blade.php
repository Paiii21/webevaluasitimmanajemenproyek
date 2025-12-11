<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Evaluasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white dark:bg-black text-black dark:text-white transition-colors">
    <div class="flex h-screen">
        @include('components.sidebar')
        
        <main class="flex-1 ml-64 overflow-auto">
            <div class="p-8">
                <!-- Header -->
                <div class="mb-8">
                    <a href="{{ route('projects.evaluations.index', $project) }}" class="inline-flex items-center text-black dark:text-white hover:text-gray-600 dark:hover:text-gray-400 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Evaluasi
                    </a>
                    <h1 class="text-4xl font-bold mb-2">Detail Evaluasi</h1>
                    <p class="text-gray-600 dark:text-gray-400">{{ $project->nama_proyek }}</p>
                </div>

                <div class="grid grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="col-span-2">
                        <!-- Evaluation Info -->
                        <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6 mb-6">
                            <div class="mb-6">
                                <h2 class="text-2xl font-semibold mb-4">Informasi Evaluasi</h2>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Anggota Tim</p>
                                        <p class="text-lg font-medium text-black dark:text-white">{{ $evaluation->teamMember->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Tim</p>
                                        <p class="text-lg font-medium text-black dark:text-white">{{ $evaluation->nama_tim }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Dievaluasi Oleh</p>
                                        <p class="text-lg font-medium text-black dark:text-white">{{ $evaluation->evaluator->name ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Tanggal Evaluasi</p>
                                        <p class="text-lg font-medium text-black dark:text-white">{{ $evaluation->created_at->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Metrics -->
                            <div class="border-t border-gray-300 dark:border-gray-700 pt-6">
                                <h3 class="text-xl font-semibold mb-6">Metrik Evaluasi</h3>
                                
                                <div class="mb-8">
                                    <div class="flex justify-between items-center mb-2">
                                        <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Produktivitas Tim</label>
                                        <span class="text-2xl font-bold text-black dark:text-white">{{ $evaluation->produktivitas_tim }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-300 dark:bg-gray-700 rounded-full h-3">
                                        <div class="bg-black dark:bg-white h-3 rounded-full transition-all" style="width: {{ $evaluation->produktivitas_tim }}%"></div>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                        @if ($evaluation->produktivitas_tim >= 80)
                                            Sangat Produktif
                                        @elseif ($evaluation->produktivitas_tim >= 60)
                                            Produktif
                                        @elseif ($evaluation->produktivitas_tim >= 40)
                                            Cukup Produktif
                                        @else
                                            Perlu Peningkatan
                                        @endif
                                    </p>
                                </div>

                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Efektivitas Sistem</label>
                                        <span class="text-2xl font-bold text-black dark:text-white">{{ $evaluation->efektivitas_sistem }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-300 dark:bg-gray-700 rounded-full h-3">
                                        <div class="bg-black dark:bg-white h-3 rounded-full transition-all" style="width: {{ $evaluation->efektivitas_sistem }}%"></div>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                        @if ($evaluation->efektivitas_sistem >= 80)
                                            Sangat Efektif
                                        @elseif ($evaluation->efektivitas_sistem >= 60)
                                            Efektif
                                        @elseif ($evaluation->efektivitas_sistem >= 40)
                                            Cukup Efektif
                                        @else
                                            Perlu Peningkatan
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        @if ($evaluation->catatan)
                            <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6 mb-6">
                                <h3 class="text-xl font-semibold mb-4">Catatan Evaluasi</h3>
                                <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded border border-gray-200 dark:border-gray-800">
                                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $evaluation->catatan }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Chart -->
                        <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6">
                            <h3 class="text-xl font-semibold mb-6">Visualisasi Metrik</h3>
                            <canvas id="evaluationChart" style="max-height: 300px;"></canvas>
                        </div>
                    </div>

                    <!-- Sidebar Info -->
                    <div>
                        <!-- Actions -->
                        <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold mb-4">Aksi</h3>
                            <div class="flex flex-col gap-3">
                                <a href="{{ route('projects.evaluations.edit', [$project, $evaluation]) }}" class="w-full px-4 py-2 bg-black dark:bg-white text-white dark:text-black font-medium rounded hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors text-center">
                                    Edit Evaluasi
                                </a>
                                <form action="{{ route('projects.evaluations.destroy', [$project, $evaluation]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus evaluasi ini?');" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full px-4 py-2 border border-red-600 text-red-600 font-medium rounded hover:bg-red-600 hover:text-white transition-colors">
                                        Hapus Evaluasi
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Statistics Card -->
                        <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6">
                            <h3 class="text-lg font-semibold mb-4">Ringkasan</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Nilai Rata-rata</p>
                                    <p class="text-2xl font-bold text-black dark:text-white">
                                        {{ round(($evaluation->produktivitas_tim + $evaluation->efektivitas_sistem) / 2) }}%
                                    </p>
                                </div>
                                <div class="pt-4 border-t border-gray-300 dark:border-gray-700">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Status</p>
                                    <p class="text-lg font-semibold text-black dark:text-white">
                                        @php
                                            $avg = ($evaluation->produktivitas_tim + $evaluation->efektivitas_sistem) / 2;
                                        @endphp
                                        @if ($avg >= 80)
                                            Sangat Baik
                                        @elseif ($avg >= 60)
                                            Baik
                                        @elseif ($avg >= 40)
                                            Cukup
                                        @else
                                            Perlu Perbaikan
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Chart.js Configuration
        const ctx = document.getElementById('evaluationChart').getContext('2d');
        
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Produktivitas Tim', 'Efektivitas Sistem'],
                datasets: [{
                    label: 'Skor (%)',
                    data: [{{ $evaluation->produktivitas_tim }}, {{ $evaluation->efektivitas_sistem }}],
                    backgroundColor: [
                        'rgba(0, 0, 0, 0.8)',
                        'rgba(100, 100, 100, 0.8)'
                    ],
                    borderColor: [
                        'rgb(0, 0, 0)',
                        'rgb(100, 100, 100)'
                    ],
                    borderWidth: 2,
                    borderRadius: 4,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                indexAxis: 'y',
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            color: 'rgb(107, 114, 128)',
                        },
                        grid: {
                            color: 'rgba(107, 114, 128, 0.1)',
                        }
                    },
                    y: {
                        ticks: {
                            color: 'rgb(0, 0, 0)',
                        },
                        grid: {
                            display: false,
                        }
                    }
                }
            }
        });

        // Dark mode support
        if (document.documentElement.classList.contains('dark')) {
            chart.options.scales.y.ticks.color = 'rgb(255, 255, 255)';
            chart.update();
        }
    </script>
</body>
</html>
