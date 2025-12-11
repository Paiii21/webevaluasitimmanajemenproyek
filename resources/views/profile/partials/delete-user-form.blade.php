<section class="space-y-6">
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-red-600 dark:text-red-400 mb-2">
            Hapus Akun
        </h2>

        <p class="text-gray-600 dark:text-gray-400">
            Setelah akun Anda dihapus, semua data dan sumbernya akan dihapus secara permanen. Sebelum menghapus akun, unduh data apapun yang ingin Anda pertahankan.
        </p>
    </header>

    <button type="button" @click="$dispatch('open-modal', 'confirm-user-deletion')" class="px-6 py-3 border border-red-600 text-red-600 font-medium rounded hover:bg-red-600 hover:text-white transition-colors">
        Hapus Akun
    </button>

    <!-- Delete Confirmation Modal -->
    <div x-data="{ open: false }" @keydown.escape="open = false" style="display: none;" x-show="open" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50 flex items-center justify-center">
        <!-- Background -->
        <div class="fixed inset-0 bg-black opacity-75" @click="open = false"></div>
        
        <!-- Modal -->
        <div class="relative bg-white dark:bg-gray-800 rounded-lg max-w-md w-full p-6">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h2 class="text-xl font-bold text-black dark:text-white mb-4">
                    Apakah Anda yakin ingin menghapus akun?
                </h2>

                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Setelah akun Anda dihapus, semua data akan dihapus secara permanen. Masukkan kata sandi Anda untuk mengkonfirmasi penghapusan akun.
                </p>

                <!-- Password Input -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold mb-2">
                        Kata Sandi <span class="text-red-600">*</span>
                    </label>
                    <input id="password" name="password" type="password" placeholder="Masukkan kata sandi Anda" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded bg-white dark:bg-gray-900 text-black dark:text-white focus:outline-none focus:border-black dark:focus:border-white transition-colors" />
                    @if ($errors->userDeletion->has('password'))
                        <p class="mt-1 text-sm text-red-600">{{ $errors->userDeletion->first('password') }}</p>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 justify-end">
                    <button type="button" @click="open = false" class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-black dark:text-white rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors font-medium">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors font-medium">
                        Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    // Simple modal management
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.querySelector('[x-data*="open"]');
        const deleteBtn = document.querySelector('button[type="button"]');
        
        if (deleteBtn && modal) {
            deleteBtn.addEventListener('click', function(e) {
                e.preventDefault();
                modal.style.display = 'block';
                modal.__x.$data.open = true;
            });
        }
    });
</script>
