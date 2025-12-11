<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Detail Evaluasi: {{ $evaluation->nama_tim }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Informasi Evaluasi</h3>
                    
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Nama Tim</p>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $evaluation->nama_tim }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Anggota yang Dievaluasi</p>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $evaluation->teamMember->name ?? 'N/A' }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Pembuat Evaluasi</p>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $evaluation->evaluator->name }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Evaluasi</p>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $evaluation->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Skor Evaluasi</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Efektivitas Sistem</span>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $evaluation->efektivitas_sistem }}/10</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $evaluation->efektivitas_sistem * 10 }}%"></div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Produktivitas Tim</span>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $evaluation->produktivitas_tim }}/10</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $evaluation->produktivitas_tim * 10 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Catatan</h3>
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">
                        {{ $evaluation->catatan ?: '-' }}
                    </p>
                </div>
            </div>
            
            <div class="flex space-x-3">
                <a href="{{ route('projects.evaluations.index', $project) }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Chart section -->
    <div class="py-6 max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Grafik Evaluasi</h3>
            <canvas id="chartEvaluasi" class="max-w-full"></canvas>
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
                    data: [{{ $evaluation->efektivitas_sistem }}, {{ $evaluation->produktivitas_tim }}],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.6)',    // Blue for Efektivitas
                        'rgba(16, 185, 129, 0.6)'    // Green for Produktivitas
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)'
                    ],
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                scales: { 
                    y: { 
                        beginAtZero: true, 
                        max: 10,
                        title: {
                            display: true,
                            text: 'Skor'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Aspek Evaluasi'
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>