<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }}</title>
    @vite(['resources/css/app.css'])
    <head>
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
    <style>
        .product-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .product-images {
            grid-column: 1 / 2;
        }

        .product-details {
            grid-column: 2 / 3;
        }

        .product-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 product-container">
                    <div class="product-images">
                        <div class="grid grid-cols-1 gap-5">
                            <!-- Hanya gambar yang berada di sebelah kiri -->
                            <div class="col-span-1">
                                @foreach($images as $image)
                                <div>
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}" class="w-full h-1000 object-cover">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="product-details">
                        <div class="col-span-2">
                            <h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>
                            <p class="mb-4 font-bold">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                            <div class="bg-green-500 text-white px-4 py-2 rounded-t-md">
                                <p class="font-bold">Deskripsi Produk</p>
                            </div>
                            <div class="bg-green-300 text-green-900 font-semi-bold px-4 py-2 rounded-b-md">
                                <p>{{ $product->description }}</p>
                            </div>
                            <br> 
                            <div class="flex items-center space-x-4">
    <a href="{{ $product->umkm->link_whatsapp }}" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:bg-green-600 focus:outline-none flex items-center inline-block">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.5 2a7.5 7.5 0 0 0-7.5 7.5c0 1.97.78 3.854 2.15 5.228l-1.352 4.395 4.528-1.343A7.478 7.478 0 0 0 9.5 17c4.136 0 7.5-3.364 7.5-7.5S13.636 2 9.5 2zm0 13a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm3.403-6.59a.5.5 0 0 0-.828-.175 4.24 4.24 0 0 0-1.332 1.332.5.5 0 0 0 .174.828l.975.39a.5.5 0 0 0 .657-.657l-.39-.975z" clip-rule="evenodd"/>
        </svg>
        Hubungi Penjual
    </a>
    <a href="{{ $product->marketplace_link }}" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:bg-green-600 focus:outline-none flex items-center inline-block">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path d="M16 6a2 2 0 10-4 0 2 2 0 004 0zM5 6a2 2 0 10-4 0 2 2 0 004 0zm15 1a1 1 0 00-1-1h-2.42l-1.825-3.651A2 2 0 0012.42 2H7.58a2 2 0 00-1.755 1.349L4.42 6H2a1 1 0 000 2h1l1.945 11.671A2 2 0 007.943 20h8.114a2 2 0 001.998-1.83L19 9h1a1 1 0 001-1zm-6 13a1 1 0 01-1 1H7.943a1 1 0 01-.995-.92L6.055 14H13v2zm3-6H4v-2h12v2zm0-4H4V6h1.063l1.455-2.91A1 1 0 007.42 2h5.16a1 1 0 00.902.59L14.938 6H19v1z"/>
        </svg>
        Kunjungi Toko
        </a>
    {{-- //tambahan manda --}}
    <a href="#" 
        id="like-button" 
        data-product-id="{{ $product->id }}" 
        class="bg-white text-black border border-black px-3 py-2 rounded-md flex items-center space-x-2 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" viewBox="0 0 24 24" fill="none" stroke="black">
                <path fill="none" stroke="black" d="M20.84 4.42a5.5 5.5 0 0 0-7.78 0L12 5.34l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21l8.84-8.84a5.5 5.5 0 0 0 0-7.78z" />
            </svg>
            <span class="block text-sm font-semibold leading-6">Favorite</span>
        </a>     
</div>

                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
    <body class="antialiased">
        <div class="min-h-screen bg-white">
    <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>

            <!-- NAVBAR HEADER -->
            <header class="absolute inset-x-0 top-0 z-40">
    <nav class="flex items-center justify-between p-5 lg:px-20 bg-green-500 row-gap: 0px;" aria-label="Global">
        <div class="flex items-center">
            <a href="#" class="p-1 mr-1">
                <img class="h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="">
            </a>
        </div>
        <!-- search box -->
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
        <div class="flex items-center space-x-4"> <!-- Menyesuaikan margin pada baris ini -->
            <a href="#" class="text-sm font-semibold leading-6 text-white flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.42a5.5 5.5 0 0 0-7.78 0L12 5.34l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21l8.84-8.84a5.5 5.5 0 0 0 0-7.78z" />
                    </svg>
                <span class="block text-sm font-semibold leading-6 text-white">Favorite</span>
            </a>
            <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-white">Masuk</a>
            <a href="{{ route('register') }}" class="text-sm font-semibold leading-6 text-white">Daftar</a>
        </div>
    </nav>
</header>
<!-- Contact -->
<section class="flex justify-center items-center min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-8">
      <h3 class="text-3xl font-bold tracking-tighter text-indigo-950">Contact Person</h3>
    </div>
    <div class="flex justify-center">
      <div class="bg-white rounded-lg shadow-md p-6 flex items-center relative border-2 border-black" style="max-width: 450px;">
        <div class="mr-6" style="flex: 1;">
          <h3 class="text-lg font-bold leading-6 text-black">Layanan Pertanyaan</h3>
          <p class="text-base text-black-500 font">
            Silahkan hubungi Admin, jika terdapat masalah atau pertanyaan terkait Official Website Produk <span class="text-yellow-500 font-bold">UMKM</span><span class="text-black font-bold">Mart</span> Kabupaten Bandung
          </p>
          <div class="mt-4">
            <a href="#" class="inline-block px-4 py-2 bg-green-500 text-white rounded-md hover:bg-indigo-600 focus:bg-indigo-600 focus:outline-none">Hubungi Kami</a>
          </div>
        </div>
        <div class="absolute right-2 top-10 flex items-center">
          <img class="h-20 w-20 object-cover" src="{{ asset('images/cs.png') }}" alt="Customer Service Logo">
        </div>
      </div>
    </div>
  </div>
</section>
    @vite(['resources/js/app.js'])
</body>
</html>

<script>
    document.getElementById('like-button').addEventListener('click', function(e) {
        e.preventDefault();

        const productId = this.getAttribute('data-product-id');
        const likesCountElement = document.getElementById('likes-count');

        fetch(`/products/${productId}/like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Pastikan Anda menambahkan CSRF token
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Product liked successfully!');
                // Update the likes count on the page
                var currentLikesCount = parseInt(likesCountElement.innerText.split(' ')[0]);
                likesCountElement.innerText = (currentLikesCount + 1) + ' likes';
            } else {
                alert('Failed to like the product.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
