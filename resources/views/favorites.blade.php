<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atur Toko') }}
        </h2>
    </x-slot>

<body>
<header class="fixed inset-x-0 top-0 z-40">
    <nav class="flex items-center justify-between p-3 lg:px-50 bg-green-500" aria-label="Global">
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
        </div>
        <div class="flex items-center space-x-4">
        <a href="#" class="text-sm font-semibold leading-6 text-white flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.42a5.5 5.5 0 0 0-7.78 0L12 5.34l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21l8.84-8.84a5.5 5.5 0 0 0 0-7.78z" />
            </svg>
            <span class="block text-sm font-semibold leading-6 text-white">Favorite</span>
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

<div class="container mx-auto px-4 mt-16"> <!-- Tambahkan margin atas di sini -->
    <button class="bg-blue-700 text-white px-4 py-2 rounded-md mb-4">Produk Favorit</button>
    @if($favorites->isEmpty())
    <div class="mb-4">
        <p class="text-center text-gray-600 mt-4">Tidak ada produk favorit saat ini.</p>
    </div>
    @else
        <div class="grid grid-cols-4 gap-4">
            @foreach($favorites as $product)
            <div class="col-span-1 mb-8" id="product-{{ $product->id }}">
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
                                <div class="flex justify-between items-center">
                                    <p class="text-gray-600">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-md" onclick="deleteFavorite({{ $product->id }})">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
    function deleteFavorite(productId) {
        if (confirm("Apakah Anda yakin ingin menghapus produk ini dari daftar favorit?")) {
            fetch(`/favorites/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('product-' + productId).remove();
                    alert(data.success);
                } else {
                    alert('Gagal menghapus produk dari daftar favorit.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }
</script>

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
</x-app-layout>
