<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-black-800 dark:text-black-100 leading-tight">
                    Evaluasi Produktivitas Tim
                </h2>
                <p class="mt-1 text-sm text-black-600 dark:text-black-400">
                    Ringkasan performa untuk semua tim yang terdaftar.
                </p>
            </div>

            <a href="{{ route('evaluasi.create') }}"
                class="mt-4 sm:mt-0 bg-indigo-600 hover:bg-indigo-700 text-black px-4 py-2 rounded-lg shadow-md transition-all duration-150 ease-in-out font-medium inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah Evaluasi
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($data->isEmpty())
                <div class="bg-white dark:bg-black-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-black-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-100">Belum Ada Data Evaluasi</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Mulai dengan menambahkan evaluasi tim baru.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('evaluasi.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                + Tambah Evaluasi Baru
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($data as $item)
                        <div
                            class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg flex flex-col justify-between transition-all duration-300 hover:shadow-2xl">

                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $item->nama_tim }}
                                </h3>
                            </div>

                            <div class="p-6 flex-grow">
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Efektivitas
                                            Sistem</label>
                                        <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">
                                            {{ $item->efektivitas_sistem }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Produktivitas
                                            Tim</label>
                                        <p class="text-3xl font-bold text-green-600 dark:text-green-400">
                                            {{ $item->produktivitas_tim }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 bg-gray-50 dark:bg-gray-800/50 flex justify-end">
                                <a href="{{ route('evaluasi.show', $item->id) }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 text-sm bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition shadow-md font-medium">
                                    📊 Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            @endif

        </div>
    </div>
</x-app-layout>