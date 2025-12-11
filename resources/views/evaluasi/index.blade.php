<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Dashboard Evaluasi
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4 text-5xl">📁</div>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">Sistem Evaluasi Berbasis Proyek</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-2xl mx-auto">
                    Evaluasi tim kini dikelola berdasarkan proyek. Buat proyek baru untuk mulai mengelola tim dan melakukan evaluasi kinerja.
                </p>

                <div class="space-y-4">
                    <a href="{{ route('projects.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Kelola Proyek Saya
                    </a>

                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Proyek memungkinkan Anda untuk:
                        </p>
                        <ul class="mt-3 space-y-2 text-sm text-gray-600 dark:text-gray-300">
                            <li class="flex items-start">
                                <span class="text-green-500 mr-2">✓</span>
                                <span>Membuat dan mengelola tim Anda sendiri</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-500 mr-2">✓</span>
                                <span>Mengundang anggota tim ke proyek Anda</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-500 mr-2">✓</span>
                                <span>Melakukan evaluasi kinerja anggota tim</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-500 mr-2">✓</span>
                                <span>Menetapkan peran (manager atau member) untuk anggota tim</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>