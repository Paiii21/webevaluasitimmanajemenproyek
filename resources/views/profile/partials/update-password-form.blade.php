<section>
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-black dark:text-white mb-2">
            Perbarui Kata Sandi
        </h2>

        <p class="text-gray-600 dark:text-gray-400">
            Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk keamanan maksimal.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold mb-2">
                Kata Sandi Saat Ini <span class="text-red-600">*</span>
            </label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-900 text-black dark:text-white focus:outline-none focus:border-black dark:focus:border-white transition-colors" autocomplete="current-password" />
            @if ($errors->updatePassword->has('current_password'))
                <p class="mt-1 text-sm text-red-600">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <!-- New Password -->
        <div>
            <label for="update_password_password" class="block text-sm font-semibold mb-2">
                Kata Sandi Baru <span class="text-red-600">*</span>
            </label>
            <input id="update_password_password" name="password" type="password" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-900 text-black dark:text-white focus:outline-none focus:border-black dark:focus:border-white transition-colors" autocomplete="new-password" />
            @if ($errors->updatePassword->has('password'))
                <p class="mt-1 text-sm text-red-600">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold mb-2">
                Konfirmasi Kata Sandi <span class="text-red-600">*</span>
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-900 text-black dark:text-white focus:outline-none focus:border-black dark:focus:border-white transition-colors" autocomplete="new-password" />
            @if ($errors->updatePassword->has('password_confirmation'))
                <p class="mt-1 text-sm text-red-600">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="px-6 py-3 bg-black dark:bg-white text-white dark:text-black font-medium rounded hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                Simpan Perubahan
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-green-600 dark:text-green-400">Berhasil diperbarui.</p>
            @endif
        </div>
    </form>
</section>
