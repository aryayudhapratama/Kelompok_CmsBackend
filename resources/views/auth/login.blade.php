<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-800 to-indigo-900 text-white font-sans relative overflow-hidden">

        <!-- 🔵 Animasi Partikel Latar -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div class="absolute w-64 h-64 bg-blue-400 opacity-20 blur-3xl animate-pulse rounded-full -top-20 -left-20"></div>
            <div class="absolute w-96 h-96 bg-indigo-500 opacity-30 blur-3xl animate-spin-slow rounded-full -bottom-40 -right-40"></div>
        </div>

        <!-- 🔐 Login Card -->
        <div class="w-full max-w-sm p-8 bg-white/10 backdrop-blur-xl rounded-2xl shadow-2xl z-10 border border-white/20">

            <!-- 🧭 Logo + Text -->
            <div class="flex items-center justify-center mb-8 space-x-3 animate-bounce-slow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white drop-shadow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h6v6H3V3zm0 12h6v6H3v-6zm12-12h6v6h-6V3zm0 12h6v6h-6v-6z" />
                </svg>
                <h1 class="text-2xl font-extrabold tracking-wide text-white drop-shadow-sm">
                    Back<span class="text-cyan-300">End</span>
                </h1>
            </div>

            <!-- 🔺 Error & status -->
            <x-validation-errors class="mb-4 text-sm text-red-300" />
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-300">
                    {{ session('status') }}
                </div>
            @endif

            <!-- 🔐 Form Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4 group">
                    <input id="email" name="email" type="email"
                        class="w-full px-4 py-2 rounded-lg border border-white bg-transparent text-white placeholder-white focus:ring-2 focus:ring-cyan-400 focus:outline-none focus:border-cyan-300 transition-all duration-300 group-hover:shadow-md"
                        placeholder="USERNAME" value="{{ old('email') }}" required autofocus />
                </div>

                <!-- Password -->
                <div class="mb-6 group">
                    <input id="password" name="password" type="password"
                        class="w-full px-4 py-2 rounded-lg border border-white bg-transparent text-white placeholder-white focus:ring-2 focus:ring-cyan-400 focus:outline-none focus:border-cyan-300 transition-all duration-300 group-hover:shadow-md"
                        placeholder="PASSWORD" required />
                </div>

                <!-- Forgot password -->
                <div class="flex justify-between items-center text-sm mb-6">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-white hover:underline transition-opacity duration-200 hover:opacity-80">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Tombol login -->
                <button type="submit"
                    class="w-full py-2 bg-gradient-to-r from-white to-gray-100 text-blue-800 font-extrabold rounded-xl shadow-md hover:from-blue-100 hover:to-white hover:text-blue-900 transition-all duration-300 ease-in-out transform hover:scale-[1.02]">
                    LOGIN
                </button>
            </form>
        </div>
    </div>

    <!-- Tailwind Custom Animations -->
    <style>
        .animate-bounce-slow {
            animation: bounce 2.5s infinite;
        }

        .animate-spin-slow {
            animation: spin 18s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg)
            }

            100% {
                transform: rotate(360deg)
            }
        }
    </style>
</x-guest-layout>
