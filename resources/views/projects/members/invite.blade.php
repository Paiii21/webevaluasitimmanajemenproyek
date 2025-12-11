<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Undang Anggota ke Proyek: {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Invitation Form -->
            <form action="{{ route('projects.members.store', $project) }}" method="POST" class="mb-8">
                @csrf

                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Kirim Undangan Baru</h3>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Email Anggota *
                    </label>
                    <input type="email" name="email" id="email"
                        value="{{ old('email') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="email@example.com"
                        required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @if(session('error'))
                        <p class="mt-1 text-sm text-red-600">{{ session('error') }}</p>
                    @endif
                </div>

                <div class="mb-6">
                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Peran Anggota *
                    </label>
                    <select name="role" id="role"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required>
                        <option value="member" {{ old('role') === 'member' ? 'selected' : '' }}>Member</option>
                        <option value="manager" {{ old('role') === 'manager' ? 'selected' : '' }}>Manager</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex space-x-3">
                    <a href="{{ route('projects.members.index', $project) }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Kirim Undangan
                    </button>
                </div>
            </form>

            <!-- Pending Invitations Section -->
            @if($invitations->count() > 0)
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Undangan Tertunda</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                    <th class="border px-3 py-2">Email</th>
                                    <th class="border px-3 py-2">Peran</th>
                                    <th class="border px-3 py-2">Dikirim Oleh</th>
                                    <th class="border px-3 py-2">Kadaluarsa</th>
                                    <th class="border px-3 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invitations as $invitation)
                                    <tr>
                                        <td class="border px-3 py-2">{{ $invitation->email }}</td>
                                        <td class="border px-3 py-2">
                                            <span class="px-2 py-1 rounded text-xs
                                                @if($invitation->role === 'manager') bg-blue-100 text-blue-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst($invitation->role) }}
                                            </span>
                                        </td>
                                        <td class="border px-3 py-2">{{ $invitation->inviter->name }}</td>
                                        <td class="border px-3 py-2 text-center">{{ $invitation->expires_at->format('d M Y') }}</td>
                                        <td class="border px-3 py-2 text-center">
                                            @if($project->owner_id == Auth::id())
                                                <form action="{{ route('projects.members.remove-invitation', [$project, $invitation]) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 text-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin membatalkan undangan ini?')">
                                                        Batal
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('projects.show', $project) }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                    Kembali ke Proyek
                </a>
            </div>
        </div>
    </div>
</x-app-layout>