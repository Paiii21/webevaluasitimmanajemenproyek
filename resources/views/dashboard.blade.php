<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4 text-5xl">📋</div>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">Selamat Datang di Sistem Evaluasi Tim</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Sistem evaluasi kinerja tim berbasis proyek. Mulai dengan membuat proyek baru dan mengelola tim Anda.
                </p>

                <a href="{{ route('projects.index') }}"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Kelola Proyek Saya
                </a>
            </div>
        </div>
    </div>
</x-app-layout>