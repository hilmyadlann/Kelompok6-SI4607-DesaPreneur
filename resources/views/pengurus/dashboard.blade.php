<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

</head>
    <body class="antialiased">
        <div class="min-h-screen bg-white">
        <!-- NAVBAR HEADER -->
        <header class="absolute inset-x-0 top-0 z-40">
    <nav class="flex items-center justify-between p-5 lg:px-20 bg-green-500 row-gap: 0px;" aria-label="Global">
        <div class="flex items-center">
            <a href="#" class="p-1 mr-1">
                <img class="h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="">
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
        </div>
      
        <div class="flex items-center space-x-4">
            <a href="{{ route('pengurus.umkm') }}" class="cursor-pointer text-sm font-semibold text-white hover:bg-green-600 mr-2 !border-0">UMKM</a>
            <a href="{{ route('pengurus.statistik') }}" class="cursor-pointer text-sm font-semibold text-white hover:bg-green-600 mr-2 !border-0">Statistics</a>
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
                        <a class="justify-between text-black" href="{{ route('profile.show') }}">
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

            </div>
        </nav>
    </header>


<div class="container mx-auto py-8">
        <div class="mb-6 flex justify-end"></div>
        </div>
        <div class="mb-6 mt-4 ml-4">
            <h2 class="text-3xl text-center font-semibold mb-4 animate__animated animate__heartBeat">Produk Desa</h2>
            @if ($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-6 lg:ml-[-1.5rem]">
                    @foreach ($products as $product)
                        <div class="card bg-base-100 shadow-xl">
                            @if ($product->images->count() > 0)
                                <figure class="m-0">
                                    <img src="{{ asset('storage/' . $product->images->first()->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                                </figure>
                            @endif
                            <div class="card-body p-4">
                                <h2 class="card-title mb-2">{{ $product->name }}</h2>
                                <p>Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                                <div>
                                    <a href="{{ $product->marketplace_link }}" target="_blank" class="btn bg-green-500 text-white hover:bg-green-700">Marketplace</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Tidak ada produk desa.</p>
            @endif
        </div>
    </div>
</body>
<script>
        function toggleDropdown() {
            var dropdownContent = document.querySelector(".dropdown-content");
            var dropdownIcon = document.querySelector(".dropdown svg");
            
            if (dropdownContent.style.display === "none") {
                dropdownContent.style.display = "block";
                dropdownIcon.classList.add("rotate-180");
            } else {
                dropdownContent.style.display = "none";
                dropdownIcon.classList.remove("rotate-180");
            }
        }
    </script>
</html>