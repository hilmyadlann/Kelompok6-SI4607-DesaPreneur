<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atur Toko') }}
        </h2>
    </x-slot>

    <div class="flex">
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

        <!-- Main Content -->
        <div class="flex-1 ml-64 py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-bold text-black">Produk {{ $umkm->nama }}</h2>
                        <div class="relative">
                            <input type="text" id="search" onkeyup="handleKeyUp(event)" placeholder="Cari Produk..." class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 pr-10">
                            <span id="clear-search" class="absolute inset-y-0 right-8 flex items-center pr-3 cursor-pointer" style="display: none;">
                                <i class="fas fa-times text-gray-400"></i>
                            </span>
                            <span id="search-icon" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                                <i class="fas fa-search text-gray-400"></i>
                            </span>
                        </div>
                    </div>
                    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 mt-8">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">NO</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Gambar</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Nama</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Deskripsi</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Harga</th>
                                    <th class="px-5 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="product-table-body">
                                @foreach ($products as $key => $product)
                                <tr id="product-row-{{ $product->id }}">
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 row-number">{{ $key + 1 }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        @if ($product->images->isNotEmpty())
                                            <img src="{{ asset('storage/' . $product->images->first()->image) }}" alt="{{ $product->name }}" class="h-12 w-12 rounded-full">
                                        @else
                                            <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder" class="h-12 w-12 rounded-full">
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 product-name">{{ $product->name }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-normal">
                                        <div class="text-sm text-gray-900">{{ $product->description }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">Rp {{ number_format($product->price, 2, ',', '.') }}</span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-left text-sm font-medium flex flex-col">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 ml-1" onclick="window.location='{{ route('products.details', $product->id) }}'">Lihat Detail</button>
                                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-2 mr-4 ml-1" onclick="window.location='{{ route('products.editnew', $product->id) }}'">Edit</button>
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mb-2 mr-4 ml-1" onclick="confirmDelete('{{ $product->id }}')">Hapus</button>
                                        <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Button Kembali -->
                        <div class="mt-6 mb-4">
                            <a href="javascript:history.back()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>

    <!-- Confirmation Modal -->
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

    <!-- Confirmation Modal for Delete -->
    <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="closeDeleteModal()">
                                <path d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Konfirmasi Hapus Produk</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus produk ini?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="deleteProduct()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">Ya</button>
                    <button type="button" onclick="closeDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Tidak</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmLogout() {
            document.getElementById('logoutModal').classList.remove('hidden');
            document.getElementById('sidebar').classList.add('modal-bg');
        }

        function closeModal() {
            document.getElementById('logoutModal').classList.add('hidden');
            document.getElementById('sidebar').classList.remove('modal-bg');
        }

        function logout() {
            document.getElementById('logout-form').submit();
        }

        function confirmDelete(productId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            window.productId = productId; // Save the product ID to a global variable
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function deleteProduct() {
            document.getElementById('delete-form-' + window.productId).submit();
        }

        function handleKeyUp(event) {
            const input = document.getElementById('search');
            const clearIcon = document.getElementById('clear-search');
            const filter = input.value.toLowerCase();

            if (filter !== '') {
                clearIcon.style.display = 'flex';
            } else {
                clearIcon.style.display = 'none';
                showAllRows();
            }

            if (event.key === 'Enter') {
                searchProducts();
            }
        }

        function searchProducts() {
            const input = document.getElementById('search');
            const filter = input.value.toLowerCase();
            const rows = document.querySelectorAll('#product-table-body tr');

            rows.forEach(row => {
                const productName = row.querySelector('.product-name').textContent.toLowerCase();
                if (productName.includes(filter)) {
                    row.style.display = '';  // Show row
                    row.style.backgroundColor = 'yellow';  // Highlight row
                } else {
                    row.style.display = 'none';  // Hide row
                    row.style.backgroundColor = '';  // Remove highlight
                }
            });

            updateRowNumbers();
        }

        function showAllRows() {
            const rows = document.querySelectorAll('#product-table-body tr');
            rows.forEach(row => {
                row.style.display = '';  // Show all rows
                row.style.backgroundColor = '';  // Remove highlight from all rows
            });
            updateRowNumbers();
        }

        document.getElementById('clear-search').addEventListener('click', function() {
            const input = document.getElementById('search');
            input.value = '';
            showAllRows();
            const clearIcon = document.getElementById('clear-search');
            clearIcon.style.display = 'none';
        });

        document.getElementById('search-icon').addEventListener('click', function() {
            searchProducts();
        });

        function updateRowNumbers() {
            const rows = document.querySelectorAll('#product-table-body tr');
            rows.forEach((row, index) => {
                row.querySelector('.row-number').textContent = index + 1;
            });
        }
    </script>

</x-app-layout>

<!-- Tambahkan ini di tempat yang sesuai dalam template Blade Anda -->
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
