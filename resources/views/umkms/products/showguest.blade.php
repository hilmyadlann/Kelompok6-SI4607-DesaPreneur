<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }}</title>

    @vite(['resources/css/app.css'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body class="bg-white font-poppins antialiased">

    <!-- Navbar -->
    <header class="fixed top-0 inset-x-0 z-40 bg-green-500">
        <nav class="flex items-center justify-between p-4 lg:px-20">
            <a href="#" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
            </a>

            <!-- Search -->
            <form action="{{ route('search') }}" method="GET" class="hidden sm:flex items-center bg-white rounded-lg shadow px-3 py-1">
                <input type="text" name="query" placeholder="Search..." class="w-72 bg-transparent focus:outline-none">
                <button type="submit" class="text-gray-500 hover:text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.406 13.093a5.5 5.5 0 111.414-1.414l3.293 3.293a1 1 0 11-1.414 1.414l-3.293-3.293zM9.5 15a5.5 5.5 0 100-11 5.5 5.5 0 000 11z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>

            <div class="flex space-x-4 text-white font-semibold">
                <a href="{{ route('login') }}">Masuk</a>
                <a href="{{ route('register') }}">Daftar</a>
            </div>
        </nav>
    </header>


  <!-- MAIN CONTENT -->
  <main class="flex-grow pt-28 pb-12 max-w-7xl mx-auto px-6 lg:px-20">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 bg-white rounded-xl shadow-lg p-10">

      <!-- Gambar Produk -->
      <section class="flex justify-center items-center">
        @foreach ($images as $image)
          <img
            src="{{ asset('storage/' . $image->image) }}"
            alt="{{ $product->name }}"
            class="product-image"
            loading="lazy"
          />
        @endforeach
      </section>

      <!-- Detail Produk -->
      <section class="flex flex-col justify-between max-w-xl mx-auto">
        <div>
          <h1 class="text-4xl font-extrabold text-gray-900 mb-4">{{ $product->name }}</h1>
          <p class="text-4xl font-extrabold text-green-700 mb-8">
            Rp {{ number_format($product->price, 2, ',', '.') }}
          </p>

          <div>
            <h2 class="bg-green-700 text-white rounded-t-lg px-6 py-3 font-semibold text-lg tracking-wide">
              Deskripsi Produk
            </h2>
            <div class="border border-green-700 border-t-0 rounded-b-lg bg-green-50 p-6 text-green-900 text-lg leading-relaxed whitespace-pre-line">
              {{ $product->description }}
            </div>
          </div>
        </div>

        <div class="flex flex-wrap gap-6 mt-8">
          <a
            href="{{ $product->umkm->link_whatsapp }}"
            target="_blank"
            class="flex flex-1 min-w-[180px] items-center justify-center gap-3 bg-green-700 hover:bg-green-800 transition text-white rounded-lg px-7 py-4 shadow-md font-semibold text-lg"
            aria-label="Hubungi Penjual via WhatsApp"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M9.5 2a7.5 7.5 0 00-7.5 7.5c0 1.97.78 3.854 2.15 5.228l-1.352 4.395 4.528-1.343A7.478 7.478 0 009.5 17c4.136 0 7.5-3.364 7.5-7.5S13.636 2 9.5 2zm0 13a5.5 5.5 0 110-11 5.5 5.5 0 010 11zm3.403-6.59a.5.5 0 00-.828-.175 4.24 4.24 0 00-1.332 1.332.5.5 0 00.174.828l.975.39a.5.5 0 00.657-.657l-.39-.975z" clip-rule="evenodd"/>
            </svg>
            Hubungi Penjual
          </a>

          <a
            href="{{ $product->marketplace_link }}"
            target="_blank"
            class="flex flex-1 min-w-[180px] items-center justify-center gap-3 bg-blue-700 hover:bg-blue-800 transition text-white rounded-lg px-7 py-4 shadow-md font-semibold text-lg"
            aria-label="Kunjungi Toko"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
              <path d="M16 6a2 2 0 10-4 0 2 2 0 004 0zM5 6a2 2 0 10-4 0 2 2 0 004 0zm15 1a1 1 0 00-1-1h-2.42l-1.825-3.651A2 2 0 0012.42 2H7.58a2 2 0 00-1.755 1.349L4.42 6H2a1 1 0 000 2h1l1.945 11.671A2 2 0 007.943 20h8.114a2 2 0 001.998-1.83L19 9h1a1 1 0 001-1zm-6 13a1 1 0 01-1 1H7.943a1 1 0 01-.995-.92L6.055 14H13v2zm3-6H4v-2h12v2zm0-4H4V6h1.063l1.455-2.91A1 1 0 007.42 2h5.16a1 1 0 00.902.59L14.938 6H19v1z"/>
            </svg>
            Kunjungi Toko
          </a>

          <a
            href="{{ $umkm->link_google_maps }}"
            target="_blank"
            class="flex flex-1 min-w-[180px] items-center justify-center gap-3 bg-yellow-600 hover:bg-yellow-700 transition text-white rounded-lg px-7 py-4 shadow-md font-semibold text-lg"
            aria-label="Lokasi Toko"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
            </svg>
            Lokasi Toko
          </a>
        </div>
      </section>
    </div>
  </main>
</body>
</html>
