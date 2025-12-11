<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Evaluasi - {{ $project->nama_proyek }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white dark:bg-black text-black dark:text-white transition-colors">
    <div class="flex h-screen">
        @include('components.sidebar')
        
        <main class="flex-1 ml-64 overflow-auto">
            <div class="p-8">
                <!-- Header -->
                <div class="mb-8">
                    <a href="{{ route('projects.evaluations.show', [$project, $evaluation]) }}" class="inline-flex items-center text-black dark:text-white hover:text-gray-600 dark:hover:text-gray-400 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Detail
                    </a>
                    <h1 class="text-4xl font-bold mb-2">Edit Evaluasi</h1>
                    <p class="text-gray-600 dark:text-gray-400">{{ $project->nama_proyek }}</p>
                </div>

                <!-- Form -->
                <form action="{{ route('projects.evaluations.update', [$project, $evaluation]) }}" method="POST" class="max-w-2xl">
                    @csrf
                    @method('PUT')

                    <!-- Team Member Selection -->
                    <div class="mb-6">
                        <label for="team_member_id" class="block text-sm font-semibold mb-2">
                            Anggota Tim <span class="text-red-600">*</span>
                        </label>
                        <select id="team_member_id" name="team_member_id" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-900 text-black dark:text-white focus:outline-none focus:border-black dark:focus:border-white transition-colors @error('team_member_id') border-red-600 @enderror">
                            <option value="">Pilih Anggota Tim</option>
                            @foreach ($projectMembers as $member)
                                <option value="{{ $member->user_id }}" {{ old('team_member_id', $evaluation->team_member_id) == $member->user_id ? 'selected' : '' }}>
                                    {{ $member->user->name }} ({{ $member->role }})
                                </option>
                            @endforeach
                        </select>
                        @error('team_member_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Productivity Metric -->
                    <div class="mb-6">
                        <label for="produktivitas_tim" class="block text-sm font-semibold mb-2">
                            Produktivitas Tim <span class="text-red-600">*</span>
                        </label>
                        <div class="flex items-center gap-4">
                            <div class="flex-1">
                                <input type="range" id="produktivitas_tim" name="produktivitas_tim" min="0" max="100" value="{{ old('produktivitas_tim', $evaluation->produktivitas_tim) }}" class="w-full h-2 bg-gray-300 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-black dark:accent-white" @error('produktivitas_tim') class="border-red-600" @enderror>
                            </div>
                            <div class="text-right min-w-12">
                                <input type="number" id="produktivitas_nilai" value="{{ old('produktivitas_tim', $evaluation->produktivitas_tim) }}" min="0" max="100" class="w-12 px-2 py-1 border border-gray-300 dark:border-gray-700 rounded text-center text-sm bg-white dark:bg-gray-900 text-black dark:text-white" readonly>
                                <span class="text-sm text-gray-600 dark:text-gray-400">%</span>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Masukkan persentase 0-100</p>
                        @error('produktivitas_tim')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Effectiveness Metric -->
                    <div class="mb-6">
                        <label for="efektivitas_sistem" class="block text-sm font-semibold mb-2">
                            Efektivitas Sistem <span class="text-red-600">*</span>
                        </label>
                        <div class="flex items-center gap-4">
                            <div class="flex-1">
                                <input type="range" id="efektivitas_sistem" name="efektivitas_sistem" min="0" max="100" value="{{ old('efektivitas_sistem', $evaluation->efektivitas_sistem) }}" class="w-full h-2 bg-gray-300 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-black dark:accent-white" @error('efektivitas_sistem') class="border-red-600" @enderror>
                            </div>
                            <div class="text-right min-w-12">
                                <input type="number" id="efektivitas_nilai" value="{{ old('efektivitas_sistem', $evaluation->efektivitas_sistem) }}" min="0" max="100" class="w-12 px-2 py-1 border border-gray-300 dark:border-gray-700 rounded text-center text-sm bg-white dark:bg-gray-900 text-black dark:text-white" readonly>
                                <span class="text-sm text-gray-600 dark:text-gray-400">%</span>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Masukkan persentase 0-100</p>
                        @error('efektivitas_sistem')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="mb-6">
                        <label for="catatan" class="block text-sm font-semibold mb-2">Catatan</label>
                        <textarea id="catatan" name="catatan" rows="5" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-900 text-black dark:text-white focus:outline-none focus:border-black dark:focus:border-white transition-colors @error('catatan') border-red-600 @enderror">{{ old('catatan', $evaluation->catatan) }}</textarea>
                        @error('catatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <button type="submit" class="px-6 py-3 bg-black dark:bg-white text-white dark:text-black font-medium rounded hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('projects.evaluations.show', [$project, $evaluation]) }}" class="px-6 py-3 border border-black dark:border-white text-black dark:text-white hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors rounded font-medium">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Sync slider and number inputs for produktivitas
        const prodSlider = document.getElementById('produktivitas_tim');
        const prodNilai = document.getElementById('produktivitas_nilai');
        
        prodSlider.addEventListener('input', function() {
            prodNilai.value = this.value;
            document.getElementById('produktivitas_tim').value = this.value;
        });

        // Sync slider and number inputs for efektivitas
        const efekSlider = document.getElementById('efektivitas_sistem');
        const efekNilai = document.getElementById('efektivitas_nilai');
        
        efekSlider.addEventListener('input', function() {
            efekNilai.value = this.value;
            document.getElementById('efektivitas_sistem').value = this.value;
        });
    </script>
</body>
</html>
