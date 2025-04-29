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

        function confirmLogout() {
            if (confirm("Are you sure you want to logout?")) {
                document.getElementById('logout-form').submit();
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

        /* Add some margin to the main content to avoid overlapping with the sidebar */
        .main-content {
            margin-left: 270px; /* width of the sidebar + some extra space */
        }
    </style>
</head>

<body class="antialiased">
    <!-- Sidebar -->
    <div class="w-64 bg-green-500 text-white h-screen p-4 fixed top-0 left-0">
            <div class="flex items-center justify-center mb-6 mt-20 mr-11">
                <span class="text-lg font-semibold">Dashboard Admin</span>
            </div>
            <nav>
                <a href="{{ route('admin.umkm.index') }}" class="flex items-center px-4 py-2 rounded mb-2 {{ request()->routeIs('admin.umkm.index') ? 'bg-green-600' : 'hover:bg-green-600' }}">
                    <img src="{{ asset('images/people.png') }}" alt="Users Icon" class="w-5 h-5 mr-2"> UMKM Pendaftar
                </a>
                <a href="{{ route('admin.umkm-aktif.index') }}" class="flex items-center px-4 py-2 rounded mb-2 {{ request()->routeIs('admin.umkm-aktif.index') ? 'bg-green-600' : 'hover:bg-green-600' }}">
                    <img src="{{ asset('images/store.png') }}" alt="Check Icon" class="w-5 h-5 mr-2"> UMKM Aktif
                </a>
            </nav>
            <div class="absolute bottom-0 w-56 mb-4">
                <!-- Tambahkan Form Logout -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                <button type="button" onclick="confirmLogout()" class="flex items-center w-full text-left px-4 py-2 rounded hover:bg-green-600">
                    <img src="{{ asset('images/logout.png') }}" alt="Logout Icon" class="w-5 h-5 mr-2"> Logout
                </button>
            </div>
        </div>

    <!-- Navbar -->
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

    <!-- Main Content -->
    <div class="main-content py-12 mt-14 mr-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 product-container">
                    <div class="product-images">
                        <div class="grid grid-cols-1 gap-5">
                            <!-- Hanya gambar yang berada di sebelah kiri -->
                            <div class="col-span-1">
                                @foreach($images as $image)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}" class="w-full h-1000 object-cover">
                                    <a href="{{ asset('storage/' . $image->image) }}" download class="absolute bottom-2 right-2 bg-gray-800 text-white p-1.5 rounded-full hover:bg-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 5v8" stroke-width="1.5"/>
                                            <path d="M7 13l5 5 5-5" stroke-width="1.5"/>
                                            <path d="M5 20h14" stroke-width="1.5" transform="translate(0, 1.5)"/>
                                        </svg>
                                    </a>
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
                                <a href="{{ $umkm->link_google_maps }}" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:bg-green-600 focus:outline-none flex items-center inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    Lokasi Toko
                                </a>
                                <div>
                                    <a href="#" 
                                        id="like-button" 
                                        data-product-id="{{ $product->id }}" 
                                    </a>     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal for Logout -->
    <div id="logoutModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="closeModal()">
                                <path d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Konfirmasi Logout</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Apakah Anda yakin ingin keluar dari Dashboard Admin?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="logout()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">Ya</button>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Tidak</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function confirmLogout() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        function logout() {
            document.getElementById('logout-form').submit();
        }
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
</body>
</html>
