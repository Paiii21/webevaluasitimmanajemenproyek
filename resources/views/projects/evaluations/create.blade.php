<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Buat Evaluasi untuk Proyek: {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <form action="{{ route('projects.evaluations.store', $project) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="team_member_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Anggota Tim *
                    </label>
                    <select name="team_member_id" id="team_member_id" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required>
                        <option value="">Pilih anggota tim...</option>
                        @foreach($project->projectMembers as $member)
                            <option value="{{ $member->user_id }}" {{ old('team_member_id') == $member->user_id ? 'selected' : '' }}>
                                {{ $member->user->name }} ({{ $member->role }})
                            </option>
                        @endforeach
                    </select>
                    @error('team_member_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nama_tim" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Nama Tim *
                    </label>
                    <input type="text" name="nama_tim" id="nama_tim" 
                        value="{{ old('nama_tim') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required>
                    @error('nama_tim')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="efektivitas_sistem" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Efektivitas Sistem (1-10) *
                        </label>
                        <input type="number" name="efektivitas_sistem" id="efektivitas_sistem" 
                            value="{{ old('efektivitas_sistem', 5) }}"
                            min="1" max="10"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            required>
                        @error('efektivitas_sistem')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="produktivitas_tim" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Produktivitas Tim (1-10) *
                        </label>
                        <input type="number" name="produktivitas_tim" id="produktivitas_tim" 
                            value="{{ old('produktivitas_tim', 5) }}"
                            min="1" max="10"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            required>
                        @error('produktivitas_tim')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="catatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Catatan
                    </label>
                    <textarea name="catatan" id="catatan" 
                        rows="4"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex space-x-3">
                    <a href="{{ route('projects.evaluations.index', $project) }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Simpan Evaluasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>