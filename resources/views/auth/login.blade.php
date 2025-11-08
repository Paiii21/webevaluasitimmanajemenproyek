<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-white to-blue-200">
        <div
            class="relative w-full max-w-md bg-white/90 backdrop-blur-md shadow-2xl rounded-3xl border border-blue-100 p-10 transition-all duration-500 hover:shadow-blue-300/50">

            <!-- Efek Glow -->
            <div
                class="absolute inset-0 rounded-3xl bg-gradient-to-tr from-blue-300/10 via-transparent to-purple-300/10 blur-3xl -z-10">
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Username -->
                <div class="transition-all duration-300 transform hover:scale-[1.02]">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <div
                        class="flex items-center border-2 border-blue-400 rounded-xl px-3 py-2 focus-within:ring-2 focus-within:ring-blue-400 bg-white/70">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm-6 8a6 6 0 1112 0H4z" />
                        </svg>
                        <input id="email" type="text" name="email" required autofocus
                            class="w-full bg-transparent outline-none text-gray-800 placeholder-gray-400"
                            placeholder="Masukkan Username" />
                    </div>
                </div>

                <!-- Password -->
                <div class="transition-all duration-300 transform hover:scale-[1.02]">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div
                        class="flex items-center border-2 border-blue-400 rounded-xl px-3 py-2 focus-within:ring-2 focus-within:ring-blue-400 bg-white/70">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 2a6 6 0 016 6v2h1a1 1 0 011 1v7a2 2 0 01-2 2H4a2 2 0 01-2-2v-7a1 1 0 011-1h1V8a6 6 0 016-6zm-4 8V8a4 4 0 118 0v2H6z"
                                clip-rule="evenodd" />
                        </svg>
                        <input id="password" type="password" name="password" required
                            class="w-full bg-transparent outline-none text-gray-800 placeholder-gray-400"
                            placeholder="Masukkan Password" />
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-400 ml-2 hover:text-blue-500 cursor-pointer transition"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M2.94 6.34A10.97 10.97 0 0110 3c3.87 0 7.2 2.13 9.06 5.34a1 1 0 010 .96A10.97 10.97 0 0110 17a10.97 10.97 0 01-7.06-3.7 1 1 0 010-.96z" />
                        </svg>
                    </div>
                    <div class="text-right mt-2">
                        <a href="#"
                            class="text-red-600 text-sm font-semibold hover:underline hover:text-red-700 transition">Lupa
                            Kata Sandi ?</a>
                    </div>
                </div>

                <!-- Tombol -->
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-semibold py-3 rounded-xl shadow-lg hover:shadow-blue-400/50 transition-all duration-300 transform hover:-translate-y-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M3 10a1 1 0 011-1h8a1 1 0 010 2H4a1 1 0 01-1-1zm10-5a1 1 0 00-1-1h-1V2a1 1 0 10-2 0v2H8a1 1 0 000 2h1v2a1 1 0 102 0V6h1a1 1 0 001-1z" />
                    </svg>
                    <span>Masuk</span>
                </button>

                <!-- Link daftar -->
                <div class="text-center text-gray-500 text-sm mt-6 animate-fadeIn">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                        class="text-blue-600 font-semibold hover:underline hover:text-blue-800 transition">Daftar
                        disini</a>
                </div>
            </form>

            <!-- Divider -->
            <div class="flex items-center mt-10">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="mx-3 text-gray-400 text-sm">Menu Lainnya</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>
        </div>
    </div>
</x-guest-layout>