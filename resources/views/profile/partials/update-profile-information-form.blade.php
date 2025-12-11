<section>
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-black dark:text-white mb-2">
            Informasi Profil
        </h2>
        <p class="text-gray-600 dark:text-gray-400">
            Perbarui informasi profil dan alamat email akun Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Name Field -->
        <div>
            <label for="name" class="block text-sm font-semibold mb-2">
                Nama <span class="text-red-600">*</span>
            </label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-900 text-black dark:text-white focus:outline-none focus:border-black dark:focus:border-white transition-colors" />
            @if ($errors->has('name'))
                <p class="mt-1 text-sm text-red-600">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-sm font-semibold mb-2">
                Email <span class="text-red-600">*</span>
            </label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-900 text-black dark:text-white focus:outline-none focus:border-black dark:focus:border-white transition-colors" />
            @if ($errors->has('email'))
                <p class="mt-1 text-sm text-red-600">{{ $errors->first('email') }}</p>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded">
                    <p class="text-sm text-yellow-800 dark:text-yellow-200">
                        Alamat email Anda belum diverifikasi.
                        <button form="send-verification" class="font-semibold underline hover:text-yellow-900 dark:hover:text-yellow-100">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            Link verifikasi baru telah dikirim ke alamat email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="px-6 py-3 bg-black dark:bg-white text-white dark:text-black font-medium rounded hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-green-600 dark:text-green-400">Berhasil disimpan.</p>
            @endif
        </div>
    </form>
</section>
