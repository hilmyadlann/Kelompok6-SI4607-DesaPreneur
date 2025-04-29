<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">
<header class="absolute inset-x-0 top-0 z-40">
        <nav class="flex items-center justify-between p-5 lg:px-20 bg-green-500 row-gap: 0px;" aria-label="Global">
            <div class="flex items-center">
                <a href="/dashboard" class="p-1 mr-1">
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
        </div>
            <div class="flex items-center space-x-4">
                <a href="#" class="text-sm font-semibold leading-6 text-white flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.42a5.5 5.5 0 0 0-7.78 0L12 5.34l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21l8.84-8.84a5.5 5.5 0 0 0 0-7.78z" />
                    </svg>
                </a>
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
    
    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-4">{{ $umkm->nama }}</h1>
            <p class="mb-4">{{ $umkm->deskripsi }}</p>
            <p class="mb-4">Kategori: {{ $umkm->kategori }}</p>
            <p class="mb-4">Alamat: {{ $umkm->alamat }}</p>
            <p class="mb-4">Kecamatan: {{ $umkm->kecamatan }}</p>
            <p class="mb-4">Desa: {{ $umkm->desa }}</p>
            <p class="mb-4">Link WhatsApp: <a href="{{ $umkm->link_whatsapp }}" target="_blank">{{ $umkm->link_whatsapp }}</a></p>
            <p class="mb-4">Link Marketplace: <a href="{{ $umkm->link_marketplace }}" target="_blank">{{ $umkm->link_marketplace }}</a></p>
            <p class="mb-4">Link Google Maps: <a href="{{ $umkm->link_google_maps }}" target="_blank">{{ $umkm->link_google_maps }}</a></p>
            <h2 class="text-xl font-bold mb-4">Gambar UMKM</h2>
            @foreach ($images as $image)
                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $umkm->nama }}" class="w-full h-48 object-cover">
            @endforeach
            <div class="grid grid-cols-3 gap-4">
                <!-- Tambahkan kode untuk menampilkan gambar UMKM di sini -->
            </div>
        </div>
    </div>

    <h2 class="text-xl font-bold mb-4 mt-8">Produk UMKM</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse ($umkm->products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if ($product->images->isNotEmpty())
                    @foreach ($product->images as $image)
                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    @endforeach
                @else
                    <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder" class="w-full h-48 object-cover">
                @endif
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">Tidak ada produk yang ditemukan.</p>
        @endforelse
    </div>
</div>

@vite(['resources/js/app.js'])
</body>
</html>
