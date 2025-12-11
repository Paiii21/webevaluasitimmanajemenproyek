<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Anggota Proyek: {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Daftar Anggota</h3>

                <a href="{{ route('projects.members.invite', $project) }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Undang Anggota
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse border">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                            <th class="border px-3 py-2">Nama</th>
                            <th class="border px-3 py-2">Email</th>
                            <th class="border px-3 py-2">Peran</th>
                            <th class="border px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($project->projectMembers as $member)
                            <tr>
                                <td class="border px-3 py-2">{{ $member->user->name }}</td>
                                <td class="border px-3 py-2">{{ $member->user->email }}</td>
                                <td class="border px-3 py-2">
                                    <span class="px-2 py-1 rounded text-xs
                                        @if($member->role === 'owner') bg-purple-100 text-purple-800
                                        @elseif($member->role === 'manager') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($member->role) }}
                                    </span>
                                </td>
                                <td class="border px-3 py-2 text-center">
                                    @if($project->owner_id == Auth::id() && $member->user_id != Auth::id())
                                        <div class="flex space-x-2 justify-center">
                                            <form action="{{ route('projects.members.update-role', [$project, $member]) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <select name="role"
                                                    onchange="this.form.submit()"
                                                    class="text-sm rounded border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                    <option value="member" {{ $member->role === 'member' ? 'selected' : '' }}>Member</option>
                                                    <option value="manager" {{ $member->role === 'manager' ? 'selected' : '' }}>Manager</option>
                                                </select>
                                            </form>
                                            <form action="{{ route('projects.members.remove', [$project, $member]) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 text-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini dari proyek?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($project->owner_id == Auth::id() && $member->user_id == Auth::id())
                                        <span class="text-sm text-gray-500">Tidak dapat diubah</span>
                                    @else
                                        <span class="text-sm">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="border px-3 py-4 text-center text-gray-500">
                                    Belum ada anggota dalam proyek ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

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