<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-gray-100 p-6">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
            <div class="text-center mb-8">
                <img src="https://laravel.com/img/logomark.min.svg" alt="Logo" class="mx-auto h-10 mb-2">
                <h2 class="text-2xl font-semibold text-gray-800">Daftar Akun Baru</h2>
                <p class="text-gray-500 text-sm mt-1">Isi data kamu untuk membuat akun</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-gray-600 font-medium mb-1">Nama Lengkap</label>
                    <input id="name" type="text" name="name" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                </div>

                <div>
                    <label for="email" class="block text-gray-600 font-medium mb-1">Email</label>
                    <input id="email" type="email" name="email" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                </div>

                <div>
                    <label for="password" class="block text-gray-600 font-medium mb-1">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-gray-600 font-medium mb-1">Konfirmasi
                        Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg shadow transition">
                    Register
                </button>

                <p class="text-center text-sm text-gray-500 mt-4">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">
                        Login disini
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>