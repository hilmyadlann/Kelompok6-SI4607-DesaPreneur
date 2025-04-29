<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin DesaPreneur</title>
    <!-- Tambahkan link ke Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <header class="absolute inset-x-0 top-0 z-40">
        <nav class="flex items-center justify-between p-5 lg:px-20 bg-green-500 row-gap: 0px;" aria-label="Global">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="p-1 mr-1">
                    <img class="h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="Logo">
                </a>
            </div>
            <div class="absolute left-2/4 transform -translate-x-2/4">
                <form action="{{ route('search') }}" class="flex items-center bg-white rounded-lg" method="GET">
                    <input type="text" name="query" placeholder="Search" class="w-80 sm:w-96 bg-transparent outline-none py-2 px-4">
                    <button type="submit" class="ml-1 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M11.406 13.093a5.5 5.5 0 111.414-1.414l3.293 3.293a1 1 0 11-1.414 1.414l-3.293-3.293zM9.5 15a5.5 5.5 0 100-11 5.5 5.5 0 000 11z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
            <!-- Profile drop-down -->
            <div class="dropdown dropdown-end" id="profileDropdown">
                <span tabindex="0" role="button" class="cursor-pointer text-sm font-semibold text-white flex items-center justify-between" onclick="toggleDropdown()">
                    <span class="flex items-center">
                        <img src="{{ asset('images/akun.png') }}" class="w-6 h-6 mr-1" alt="Profile Icon">
                        {{ Auth::user()->name }}
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white arrow-down" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 12a1 1 0 01-.707-.293l-4-4a1 1 0 111.414-1.414L10 9.586l3.293-3.293a1 1 0 111.414 1.414l-4 4A1 1 0 0110 12z" clip-rule="evenodd" />
                    </svg>
                </span>
                <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52" style="display: none;">
                    <li>
                        <a class="justify-between text-white" href="{{ route('profile.show') }}">
                            Profile
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center justify-between w-full">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
                <a href="{{ route('umkms.create') }}" class="text-sm font-semibold leading-6 text-white flex items-center space-x-2">
                    <img src="{{ asset('images/toko.png') }}" class="w-5 h-5 mr-2" alt="Buka Toko Icon">
                    Buka Toko
                </a>
            </div>
        </nav>
    </header>

    <div class="container mx-auto mt-8">
        @yield('content')
    </div>
</body>
</html>