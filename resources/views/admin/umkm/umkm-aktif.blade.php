<x-app-layout>
    <h1>Dashboard Admin</h1>

    <h1 class="text-2xl mb-6">UMKM Aktif</h1>

    <style>
        .highlight {
            background-color: yellow;
        }

        input[type="search"]::-webkit-search-cancel-button {
            -webkit-appearance: none;
            height: 20px;
            width: 20px;
            background: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="24px" height="24px"%3E%3Cpath d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/%3E%3C/svg%3E') no-repeat center center;
            cursor: pointer;
        }
    </style>

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
        <div class="flex-1 p-6 ml-64 overflow-x-auto">
        <div class="mt-2">
            <div class="bg-white p-6 rounded shadow mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-black">UMKM Aktif</h2>
                        
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">No</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Nama</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Profil</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Deskripsi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Alamat</th>
                            </tr>
                        </thead>
                        <tbody id="table-body-umkm-aktif" class="bg-white divide-y divide-gray-200">
                            @forelse ($umkmAktif as $index => $umkm)
                            <tr id="umkm-row-{{ $index }}" class="umkm-row">
                                <td class="px-4 py-4 whitespace-nowrap text-black">{{ $index + 1 }}</td>
                                <td class="px-4 py-4 whitespace-wrap text-black">{{ $umkm->nama }}</td>
                                <td class="px-4 py-4 whitespace-wrap text-black">
                                    @foreach($umkm->image as $image)
                                    <div class="relative">
                                        <div class="w-24 h-24 rounded-full overflow-hidden border border-gray-400">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $umkm->name }}" class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                    @endforeach
                                </td>
                                <td class="px-4 py-4 whitespace-wrap text-black">{{ $umkm->kategori }}</td>
                                <td class="px-4 py-4 whitespace-wrap text-black">{{ $umkm->deskripsi }}</td>
                                <td class="px-4 py-4 whitespace-wrap text-black">{{ $umkm->alamat }}</td>
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-black" colspan="7">Tidak Ada UMKM Aktif.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Konfirmasi Hapus UMKM</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus UMKM ini?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="deleteUMKM()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">Ya</button>
                    <button type="button" onclick="closeDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Tidak</button>
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

        function confirmDelete(umkmId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            window.umkmId = umkmId; // Save the UMKM ID to a global variable
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function deleteUMKM() {
            document.getElementById('delete-form-' + window.umkmId).submit();
        }

        document.getElementById('search-umkm-aktif').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                filterTable('search-umkm-aktif', 'table-body-umkm-aktif');
            }
        });

        document.getElementById('search-umkm-aktif-btn').addEventListener('click', function() {
            filterTable('search-umkm-aktif', 'table-body-umkm-aktif');
        });

        function filterTable(inputId, tableBodyId) {
            let input = document.getElementById(inputId);
            let filter = input.value.toLowerCase();
            let tableBody = document.getElementById(tableBodyId);
            let rows = tableBody.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                let columns = rows[i].getElementsByTagName('td');
                if (columns.length > 0) {
                    let nameColumn = columns[1].textContent || columns[1].innerText;
                    if (nameColumn.toLowerCase().indexOf(filter) > -1) {
                        rows[i].classList.add('highlight'); // Tambahkan highlight pada baris yang cocok
                        rows[i].style.display = ''; // Tampilkan baris yang cocok
                    } else {
                        rows[i].classList.remove('highlight'); // Hapus highlight pada baris yang tidak cocok
                        rows[i].style.display = 'none'; // Sembunyikan baris yang tidak cocok
                    }
                }
            }
        }

        document.getElementById('search-umkm-aktif').addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                filterTable('search-umkm-aktif', 'table-body-umkm-aktif');
                addHighlight('table-body-umkm-aktif');
            }
        });

        document.getElementById('search-umkm-aktif').addEventListener('input', function () {
            if (this.value === '') {
                filterTable('search-umkm-aktif', 'table-body-umkm-aktif');
                removeHighlight('table-body-umkm-aktif');
            }
        });

        function addHighlight(tableBodyId) {
            let tableBody = document.getElementById(tableBodyId);
            let rows = tableBody.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                rows[i].classList.add('highlight'); // Tambahkan highlight pada semua baris
            }
        }

        function removeHighlight(tableBodyId) {
            let tableBody = document.getElementById(tableBodyId);
            let rows = tableBody.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                rows[i].classList.remove('highlight'); // Hapus highlight pada semua baris
            }
        }

    </script>

</x-app-layout>