<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="images/logo.png" alt="Logo Anda" class="w-41 h-auto" />
        </x-slot>

        <x-slot name="title">
            <h1 class="text-2xl font-bold text-white">Silahkan Daftarkan Akun Anda di</h1>
            <h2 class="text-4xl font-black text-white mb-10">
                <span>Website</span> <span class="text-yellow-500">DESA</span><span>PRENEUR</span>
            </h2>
        </x-slot>

        <!-- Konten Form -->
        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-6">
                <x-label for="name" value="{{ __('Nama') }}" class="text-white text-lg mb-2 font-bold" style="font-size: 1.1rem;" />
                <x-input id="name" class="block mt-1 px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-black" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" style="font-size: 1.2rem; width: 400px; background-color: #ffffff; margin-top: 0.5rem;" />
            </div>

            <div class="mb-6">
                <x-label for="email" value="{{ __('Email') }}" class="text-white text-lg mb-2 font-bold" style="font-size: 1.1rem;" />
                <x-input id="email" class="block mt-1 px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-black" type="email" name="email" required autofocus autocomplete="email" style="font-size: 1.2rem; width: 400px; background-color: #ffffff; margin-top: 0.5rem;" />
            </div>

            <div class="mb-6">
                <x-label for="no_hp" value="{{ __('No Handphone') }}" class="text-white text-lg mb-2 font-bold" style="font-size: 1.1rem;" />
                <x-input id="no_hp" class="block mt-1 px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-black" type="text" name="no_hp" required autofocus autocomplete="no_hp" style="font-size: 1.2rem; width: 400px; background-color: #ffffff; margin-top: 0.5rem;" />
            </div>

            <div class="mb-6">
                <x-label for="password" value="{{ __('Password') }}" class="text-white text-lg mb-2 font-bold" style="font-size: 1.1rem; margin-bottom: 0.5rem;" />
                <x-input id="password" class="block mt-1 px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-black" type="password" name="password" required autocomplete="new-password" style="font-size: 1.2rem; width: 400px; background-color: #ffffff;" />
            </div>

            <div class="mb-6">
                <x-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" class="text-white text-lg mb-2 font-bold" style="font-size: 1.1rem; margin-bottom: 0.5rem;" />
                <x-input id="password_confirmation" class="block mt-1 px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-black" type="password" name="password_confirmation" required autocomplete="new-password" style="font-size: 1.2rem; width: 400px; background-color: #ffffff;" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <!-- Tombol Daftar -->
            <div class="w-full flex justify-center">
                <button class="btn btn-warning btn-sm" style="width: 120px;">
                    {{ __('Daftar') }}
                </button>
            </div>

            <!-- Link to Login Page -->
            <div class="mt-4 text-sm text-center text-white mx-auto" style="width: fit-content;">
                Belum Punya Akun? Silahkan <a class="underline font-bold" href="{{ route('login') }}">Masuk</a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
