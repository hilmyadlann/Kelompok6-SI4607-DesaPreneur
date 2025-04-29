<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <title>Welcome to DesaPreneur</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/smooth-scroll/dist/smooth-scroll.min.js"></script>
    <style>
            body {
                font-family: 'Poppins', sans-serif;
                overflow-x: hidden;
                scroll-behavior: smooth;
            }
            @keyframes scroll-animation {
                from {
                    opacity: 0;
                    transform: translateY(-50px); /* Sesuaikan nilai pergerakan */
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .slider-container {
                display: flex;
                overflow: hidden;
                width: 100%;
            }

            .slider-container img {
            flex-shrink: 0;
            animation: slide-animation 20s infinite linear; /* Sesuaikan durasi animasi */
        }

            @keyframes slide-animation {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-400%);
        }
    }
        
        </style>

</head>

<body class="antialiased">
    <div class="min-h-screen bg-white">
        <!-- NAVBAR HEADER -->
        <header class="absolute inset-x-0 top-0 z-40">
    <nav class="flex items-center justify-between p-5 lg:px-20 bg-green-500 row-gap: 0px;" aria-label="Global">
        <div class="flex items-center">
            <a href="#" class="p-1 mr-1 animate__animated animate__bounce">
                <img class="h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="">
            </a>
        </div>
        <div class="flex items-center space-x-4"> <!-- Menyesuaikan margin pada baris ini -->
            <a href="#" class="text-sm font-semibold leading-6 text-white flex items-center space-x-2">
                    </svg>
            </a>
            <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-white">Masuk</a>
            <a href="{{ route('register') }}" class="text-sm font-semibold leading-6 text-white">Daftar</a>
        </div>
    </nav>
</header>

<div class="relative">
    <!-- Banner Selamat Datang (digeser ke bawah sedikit) -->
    <div class="w-full bg-green-700 pt-16 pb-16 px-4 text-white text-center animate__animated animate__fadeInDown shadow-md mt-16">
        <h2 class="text-4xl font-extrabold mb-4 tracking-wide">
            Halo User, Selamat Datang
        </h2>
        <p class="text-xl font-semibold leading-relaxed">
            Website <span class="text-yellow-400">Desa</span><span class="text-white">Preneur Kabupaten Bandung</span><br>
            <span class="italic">Produk Harga Kaki Lima, Kualitas Bintang Lima</span>
        </p>
    </div>
</div>

        <!-- KATEGORI -->
        <section>
  <div id="about-section" class="py-8 px-4 md:px-6 lg:px-8 w-full grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
      
      <!-- Makanan dan Minuman -->
      <a href="{{ route('landing.category', ['category' => 'Makanan dan Minuman']) }}#products" class="h-full">
          <div class="bg-green-300 rounded-lg shadow-md hover:shadow-xl transition duration-300 flex flex-col items-center justify-center hover:bg-green-500 active:bg-green-600 h-full">
              <div class="p-4 text-center">
                  <img src="{{ asset('images/diet 1.png') }}" alt="Logo 1" class="h-12 w-12 mb-2 mx-auto">
                  <h3 class="text-sm font-semibold text-black">Makanan dan Minuman</h3>
              </div>
          </div>
      </a>

      <!-- Kerajinan Tangan -->
      <a href="{{ route('landing.category', ['category' => 'Kerajinan Tangan']) }}#products" class="h-full">
          <div class="bg-green-300 rounded-lg shadow-md hover:shadow-xl transition duration-300 flex flex-col items-center justify-center hover:bg-green-500 active:bg-green-600 h-full">
              <div class="p-4 text-center">
                  <img src="{{ asset('images/artisanal 1.png') }}" alt="Logo 2" class="h-12 w-12 mb-2 mx-auto">
                  <h3 class="text-sm font-semibold text-black">Kerajinan Tangan</h3>
              </div>
          </div>
      </a>

      <!-- Kebutuhan Sehari-hari -->
      <a href="{{ route('landing.category', ['category' => 'Kebutuhan Sehari-hari']) }}#products" class="h-full">
          <div class="bg-green-300 rounded-lg shadow-md hover:shadow-xl transition duration-300 flex flex-col items-center justify-center hover:bg-green-500 active:bg-green-600 h-full">
              <div class="p-4 text-center">
                  <img src="{{ asset('images/needs 1.png') }}" alt="Logo 3" class="h-12 w-12 mb-2 mx-auto">
                  <h3 class="text-sm font-semibold text-black">Kebutuhan Sehari-hari</h3>
              </div>
          </div>
      </a>

      <!-- Pakaian -->
      <a href="{{ route('landing.category', ['category' => 'Pakaian']) }}#products" class="h-full">
          <div class="bg-green-300 rounded-lg shadow-md hover:shadow-xl transition duration-300 flex flex-col items-center justify-center hover:bg-green-500 active:bg-green-600 h-full">
              <div class="p-4 text-center">
                  <img src="{{ asset('images/clothes 1.png') }}" alt="Logo 4" class="h-12 w-12 mb-2 mx-auto">
                  <h3 class="text-sm font-semibold text-black">Pakaian</h3>
              </div>
          </div>
      </a>

      <!-- Hiasan -->
      <a href="{{ route('landing.category', ['category' => 'Hiasan']) }}#products" class="h-full">
          <div class="bg-green-300 rounded-lg shadow-md hover:shadow-xl transition duration-300 flex flex-col items-center justify-center hover:bg-green-500 active:bg-green-600 h-full">
              <div class="p-4 text-center">
                  <img src="{{ asset('images/shelf 1.png') }}" alt="Logo 5" class="h-12 w-12 mb-2 mx-auto">
                  <h3 class="text-sm font-semibold text-black">Hiasan</h3>
              </div>
          </div>
      </a>

  </div>
</section>


 <!-- OUR PRODUK -->
 <section>
    <div id="system-section" class="h-full py-8 px-8 mx-auto md:px-12 lg:px-12 max-w-7xl">
        <div class="text-center">
            <h3 class="py-4 text-2xl font-semibold tracking-tighter text-indigo-900">
                @if (isset($category))
                    {{ $category->name }}
                @else
                    Our Products
                @endif
            </h3>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 lg:gap-6 py-6 px-4 md:px-6">
            @if (isset($category))
                @foreach ($products as $product)
                    <div class="mb-8">
                        <a href="{{ route('products.show', $product) }}">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full">
                                @if ($product->images->isNotEmpty())
                                    @foreach ($product->images as $image)
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                    @endforeach
                                @else
                                    <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder" class="w-full h-48 object-cover">
                                @endif
                                <div class="p-4">
                                    <h4 class="text-lg font-semibold mb-2">{{ $product->name }}</h4>
                                    <p class="text-gray-600">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                @foreach ($productsByCategory as $category => $products)
                    @foreach ($products as $product)
                        <div class="col-span-1 mb-8">
                            <a href="{{ route('products.show', $product) }}">
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full">
                                    @if ($product->images->isNotEmpty())
                                        @foreach ($product->images as $image)
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                        @endforeach
                                    @else
                                        <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder" class="w-full h-48 object-cover">
                                    @endif
                                    <div class="p-4">
                                        <h4 class="text-lg font-semibold mb-2">{{ $product->name }}</h4>
                                        <p class="text-gray-600">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endforeach
            @endif
        </div>
    </div>
</section>

        <!-- TOKO -->
        <section>
    <div id="stats-section" class="pt-8 pb-2 px-4 mx-auto md:px-8 lg:px-6 max-w-7xl">
        <div class="shadow-xl rounded-lg">
            @if (isset($desas))
                <form action="{{ route('umkms.by-desa') }}#umkms" method="GET">
                    <div class="flex justify-center items-center space-x-2 py-4 px-6 bg-white rounded-lg shadow-md w-full max-w-2xl mx-auto">
                        <select id="desaSelect" name="desa_id"
                            class="px-4 py-2 rounded-md bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Select Desa</option>
                            @foreach ($desas as $desa)
                                <option value="{{ $desa->id }}">{{ $desa->nama_desa }}</option>
                            @endforeach
                        </select>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                            Show UMKM
                        </button>
                    </div>
                </form>
            @endif

            @if (isset($umkms))
                <div id="umkms" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6 py-6 px-4 md:px-6 scroll-animation">
                    @foreach ($umkms as $umkm)
                        <div class="bg-white rounded-lg shadow-md p-4 w-full md:w-auto lg:w-full">
                            <h3 class="text-lg font-bold">{{ $umkm->nama }}</h3>
                            @if ($umkm->products->isNotEmpty())
                                <div class="mt-2">
                                    @if ($umkm->products->first()->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $umkm->products->first()->images->first()->image) }}"
                                            alt="{{ $umkm->products->first()->name }}"
                                            class="w-full h-40 object-cover rounded-md mb-2">
                                    @endif
                                    <div>
                                        <p class="font-semibold">{{ $umkm->products->first()->name }}</p>
                                        <p>Rp {{ number_format($umkm->products->first()->price, 2, ',', '.') }}</p>
                                    </div>
                                    <a href="{{ route('umkms.detail', $umkm->id) }}"
                                        class="mt-2 inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:bg-green-700">
                                        Detail
                                    </a>
                                </div>
                            @else
                                <p class="mt-2 text-gray-500">No products available.</p>
                            @endif
                        </div>
                    @endforeach
                </div>

                @if ($umkms->isEmpty())
                    <div class="text-center mb-0">
                        <p class="text-xl italic font-bold text-gray-500">
                            Toko UMKM pada Desa {{ \App\Models\Desa::find($desaId)->nama_desa ?? '' }} belum tersedia
                        </p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</section>


<script>
    // Ambil nilai desa_id dari parameter query jika ada
    const urlParams = new URLSearchParams(window.location.search);
    const desaId = urlParams.get('desa_id');
    
    // Set nilai dropdown menjadi desa_id jika tersedia
    if (desaId) {
        document.getElementById("desaSelect").value = desaId;
    }
</script>

<script>
    function resetAnimation() {
    images.forEach((img, index) => {
        setTimeout(() => {
            img.style.animation = 'none';
            img.offsetHeight; /* trigger reflow */
            img.style.animation = null;
        }, (index * 200)); // Sesuaikan penundaan waktu untuk setiap gambar
    });

    requestAnimationFrame(resetAnimation);
}
// Scroll otomatis ke elemen dengan id yang sesuai
function scrollToElement(elementId) {
        const element = document.getElementById(elementId);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth' });
        }
    }

    // Cek fragmen URL saat halaman dimuat
    window.addEventListener('load', () => {
        const url = new URL(window.location.href);
        const hash = url.hash.substr(1);
        if (hash) {
            scrollToElement(hash);
        }
    });
</script>
</html>

