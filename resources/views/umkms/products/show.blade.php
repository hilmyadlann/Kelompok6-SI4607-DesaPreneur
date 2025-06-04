<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $product->name }}</title>
  @vite(['resources/css/app.css'])

  <style>
    .product-image {
      width: 100%;
      max-height: 450px;
      object-fit: cover;
      border-radius: 0.5rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
      cursor: pointer;
    }
    .product-image:hover {
      transform: scale(1.03);
    }
  </style>

  <script>
    function toggleDropdown() {
      const dropdownContent = document.querySelector(".dropdown-content");
      const dropdownIcon = document.querySelector(".dropdown svg");

      if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
        dropdownIcon.classList.remove("rotate-180");
      } else {
        dropdownContent.style.display = "block";
        dropdownIcon.classList.add("rotate-180");
      }
    }
  </script>
</head>

<body class="bg-gray-50 font-sans antialiased min-h-screen flex flex-col">
  <!-- NAVBAR -->
  <header class="fixed inset-x-0 top-0 z-40 bg-green-600 shadow-md h-20">
    <nav
      class="max-w-7xl mx-auto h-full flex items-center justify-between px-6 lg:px-20"
      aria-label="Global"
    >
      <div class="flex items-center">
        <a href="#" class="p-1 mr-3">
          <img
            class="h-10 w-auto"
            src="{{ asset('images/logo.png') }}"
            alt="Logo"
          />
        </a>
      </div>

      <div class="absolute left-1/2 transform -translate-x-1/2 w-full max-w-2xl px-4 sm:px-0">
        <form
          action="{{ route('search') }}"
          method="GET"
          class="flex items-center bg-white rounded-lg shadow-sm"
        >
          <input
            type="text"
            name="query"
            placeholder="Search"
            class="w-full bg-transparent outline-none py-2 px-4 text-gray-700"
          />
          <button type="submit" class="ml-2 pr-3 focus:outline-none" aria-label="Search">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5 text-gray-500"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M11.406 13.093a5.5 5.5 0 111.414-1.414l3.293 3.293a1 1 0 11-1.414 1.414l-3.293-3.293zM9.5 15a5.5 5.5 0 100-11 5.5 5.5 0 000 11z"
                clip-rule="evenodd"
              />
            </svg>
          </button>
        </form>
      </div>

      <div class="flex items-center space-x-6">
        <div class="dropdown dropdown-end relative" id="profileDropdown">
          <span
            tabindex="0"
            role="button"
            class="cursor-pointer text-sm font-semibold text-white flex items-center justify-between select-none"
            onclick="toggleDropdown()"
          >
            <span class="flex items-center">
              <img
                src="{{ asset('images/akun.png') }}"
                alt="Profile Icon"
                class="w-6 h-6 mr-1 rounded-full object-cover"
              />
              {{ Auth::user()->name }}
            </span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5 text-white arrow-down transition-transform duration-300"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M10 12a1 1 0 01-.707-.293l-4-4a1 1 0 111.414-1.414L10 9.586l3.293-3.293a1 1 0 111.414 1.414l-4 4A1 1 0 0110 12z"
                clip-rule="evenodd"
              />
            </svg>
          </span>

          <ul
            tabindex="0"
            class="mt-3 absolute right-0 p-2 shadow-lg menu menu-sm dropdown-content bg-white rounded-lg w-52 hidden"
          >
            <li>
              <a
                href="{{ route('profile.show') }}"
                class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded"
                >Profile</a
              >
            </li>
            <li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button
                  type="submit"
                  class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded"
                >
                  Logout
                </button>
              </form>
            </li>
          </ul>
        </div>

        <a
          href="{{ route('umkms.create') }}"
          class="text-sm font-semibold leading-6 text-white flex items-center space-x-2 hover:underline"
        >
          <img
            src="{{ asset('images/toko.png') }}"
            alt="Buka Toko Icon"
            class="w-5 h-5 mr-1"
          />
          <span>Buka Toko</span>
        </a>
      </div>
    </nav>
  </header>

  <!-- MAIN -->
  <main class="flex-grow pt-24 max-w-7xl mx-auto px-6 sm:px-6 lg:px-8">
    <div
      class="bg-white shadow-md rounded-lg grid grid-cols-1 md:grid-cols-2 gap-8 p-6"
    >
      <!-- Gambar Produk -->
      <section class="flex flex-col justify-center">
        @foreach ($images as $image)
        <img
          src="{{ asset('storage/' . $image->image) }}"
          alt="{{ $product->name }}"
          class="product-image mb-4 rounded-lg"
          loading="lazy"
        />
        @endforeach
      </section>

      <!-- Detail Produk -->
      <section class="flex flex-col justify-between max-w-xl mx-auto">
        <div>
          <h1
            class="text-3xl font-extrabold text-gray-900 mb-4 leading-tight"
          >
            {{ $product->name }}
          </h1>
          <p class="text-4xl font-extrabold text-green-700 mb-8">
            Rp {{ number_format($product->price, 2, ',', '.') }}
          </p>

          <div>
            <h2
              class="bg-green-600 text-white px-4 py-2 rounded-t-md font-semibold tracking-wide"
            >
              Deskripsi Produk
            </h2>
            <div
              class="border border-green-600 border-t-0 rounded-b-md bg-green-100 text-green-900 p-5 leading-relaxed text-lg whitespace-pre-wrap mb-6"
            >
              {{ $product->description }}
            </div>
          </div>
        </div>

        <div class="flex flex-wrap gap-6 mt-8">
          <a
            href="{{ $product->umkm->link_whatsapp }}"
            target="_blank"
            class="flex flex-1 min-w-[180px] items-center justify-center gap-3 bg-green-600 hover:bg-green-700 text-white px-7 py-4 rounded-lg transition duration-300 shadow-md font-semibold text-lg"
            aria-label="Hubungi Penjual via WhatsApp"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-7 w-7 flex-shrink-0"
              fill="currentColor"
              viewBox="0 0 20 20"
            >
              <path
                fill-rule="evenodd"
                d="M9.5 2a7.5 7.5 0 00-7.5 7.5c0 1.97.78 3.854 2.15 5.228l-1.352 4.395 4.528-1.343A7.478 7.478 0 009.5 17c4.136 0 7.5-3.364 7.5-7.5S13.636 2 9.5 2zm0 13a5.5 5.5 0 110-11 5.5 5.5 0 010 11zm3.403-6.59a.5.5 0 00-.828-.175 4.24 4.24 0 00-1.332 1.332.5.5 0 00.174.828l.975.39a.5.5 0 00.657-.657l-.39-.975z"
                clip-rule="evenodd"
              />
            </svg>
            Hubungi Penjual
          </a>

          <a
            href="{{ $product->marketplace_link }}"
            target="_blank"
            class="flex flex-1 min-w-[180px] items-center justify-center gap-3 bg-blue-600 hover:bg-blue-700 text-white px-7 py-4 rounded-lg transition duration-300 shadow-md font-semibold text-lg"
            aria-label="Kunjungi Toko"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-7 w-7 flex-shrink-0"
              fill="currentColor"
              viewBox="0 0 20 20"
            >
              <path
                d="M16 6a2 2 0 10-4 0 2 2 0 004 0zM5 6a2 2 0 10-4 0 2 2 0 004 0zm15 1a1 1 0 00-1-1h-2.42l-1.825-3.651A2 2 0 0012.42 2H7.58a2 2 0 00-1.755 1.349L4.42 6H2a1 1 0 000 2h1l1.945 11.671A2 2 0 007.943 20h8.114a2 2 0 001.998-1.83L19 9h1a1 1 0 001-1zm-6 13a1 1 0 01-1 1H7.943a1 1 0 01-.995-.92L6.055 14H13v2zm3-6H4v-2h12v2zm0-4H4V6h1.063l1.455-2.91A1 1 0 007.42 2h5.16a1 1 0 00.902.59L14.938 6H19v1z"
              />
            </svg>
            Kunjungi Toko
          </a>

          <a
            href="{{ $umkm->link_google_maps }}"
            target="_blank"
            class="flex flex-1 min-w-[180px] items-center justify-center gap-3 bg-yellow-600 hover:bg-yellow-700 text-white px-7 py-4 rounded-lg transition duration-300 shadow-md font-semibold text-lg"
            aria-label="Lokasi Toko"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-7 w-7 flex-shrink-0"
              fill="currentColor"
              viewBox="0 0 20 20"
            >
              <path
                fill-rule="evenodd"
                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                clip-rule="evenodd"
              />
            </svg>
            Lokasi Toko
          </a>
        </div>
      </section>
    </div>
  </main>
</body>
</html>
