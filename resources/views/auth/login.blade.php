<!-- login.blade.php -->
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="images/logo.png" alt="Logo Anda" class="w-41 h-auto" />
        </x-slot>

        <x-slot name="title">
            <h1 class="text-2xl font-bold text-white">Selamat datang di</h1>
            <h2 class="text-4xl font-black text-white mb-10">
                <span>Website</span> <span class="text-yellow-500">DESA</span><span>PRENEUR</span>
            </h2>
        </x-slot>

        <!-- Konten Form -->
        <x-validation-errors class="mb-4" />
        
        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}" class="flex flex-col items-start">
            @csrf

            <!-- Email Field -->
            <div class="mb-6">
                <x-label for="identifier" value="{{ __('Email atau Nomor Handphone') }}" class="text-white text-lg mb-2 font-bold" style="font-size: 1.1rem;" />
                <x-input id="identifier" class="block mt-1 px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-black" type="text" name="identifier" :value="old('identifier')" required autofocus autocomplete="username" style="font-size: 1.2rem; width: 400px; background-color: #ffffff; margin-top: 0.5rem;" />
            </div>

            <!-- Password Field -->
            <div class="mb-6">
                <x-label for="password" value="{{ __('Password') }}" class="text-white text-lg mb-2 font-bold" style="font-size: 1.1rem; margin-bottom: 0.5rem;" />
                <x-input id="password" class="block mt-1 px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-black" type="password" name="password" required autocomplete="current-password" style="font-size: 1.2rem; width: 400px; background-color: #ffffff;" />
            </div>

            <!-- Remember Me Checkbox -->
            <div class="mb-4 flex items-center justify-between w-full">
                <label for="remember_me" class="flex items-center font-bold">
                    <x-checkbox class="text-white" id="remember_me" name="remember"/>
                    <span class="ml-2 text-sm text-white">{{ __('Ingat saya') }}</span>
                </label>

                <!-- Forgot Password Link -->
                <div class="ml-auto">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-white font-bold" href="{{ route('password.request') }}">
                            {{ __('Lupa password?') }}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Submit Button -->
            <div class="w-full flex justify-center">
                <button class="btn btn-warning btn-sm" style="width: 120px;">
                    {{ __('Masuk') }}
                </button>
            </div>

           <!-- Link to Register Page -->
            <div class="mt-4 text-sm text-center text-white mx-auto" style="width: fit-content;">
                Belum Aunya Akun? Silahkan <a class="underline font-bold" href="{{ route('register') }}">Daftar</a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
