<x-app-layout>
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
                </a>
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
            <h1 class="text-2xl mb-6">Dashboard Admin</h1>
            <div class="mt-14">
                <div class="bg-white p-6 rounded shadow mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-black">UMKM Pendaftar</h2>
                        <div class="relative text-gray-600">
                                    <path d="M10 2a8 8 0 0 1 8 8 7.96 7.96 0 0 1-2.344 5.656l5.69 5.69-1.415 1.414-5.69-5.69A7.96 7.96 0 0 1 10 18a8 8 1 1 1 0-16zm0 2a6 6 0 0 0-4.24 10.24A6 6 1 1 0 14.24 6A5.976 5.976 0 0 0 10 4z" />
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
                                    <th class="px-4 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-body-umkm-pendaftar" class="bg-white divide-y divide-gray-200">
                                @forelse ($umkmPendaftar as $index => $umkm)
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
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <button type="button" onclick="confirmSetujui('{{ $umkm->id }}')" class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600 block mb-2">Setujui</button>
                                        <form id="setujui-form-{{ $umkm->id }}" action="{{ route('admin.umkm.setujui', $umkm) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                        <button type="button" onclick="confirmTolak('{{ $umkm->id }}')" class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600 block">Tolak</button>
                                        <form id="tolak-form-{{ $umkm->id }}" action="{{ route('admin.umkm.tolak', $umkm) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-black" colspan="7">Tidak Ada UMKM Pendaftar.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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

    <!-- Confirmation Modal for Tolak -->
    <div id="tolakModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="closeTolakModal()">
                                <path d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Konfirmasi Tolak UMKM</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Apakah Anda yakin ingin menolak pendaftaran UMKM ini?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="tolak()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">Ya</button>
                    <button type="button" onclick="closeTolakModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Tidak</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal for Setujui -->
    <div id="setujuiModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-green-600 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="closeSetujuiModal()">
                                <path d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Konfirmasi Setujui UMKM</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Apakah Anda yakin ingin menyetujui pendaftaran UMKM ini?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="setujui()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 sm:ml-3 sm:w-auto sm:text-sm">Ya</button>
                    <button type="button" onclick="closeSetujuiModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Tidak</button>
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

        function confirmTolak(id) {
            document.getElementById('tolakModal').classList.remove('hidden');
            window.umkmId = id; // Save the UMKM ID to a global variable
        }

        function closeTolakModal() {
            document.getElementById('tolakModal').classList.add('hidden');
        }

        function tolak() {
            document.getElementById('tolak-form-' + window.umkmId).submit();
        }

        function confirmSetujui(id) {
            document.getElementById('setujuiModal').classList.remove('hidden');
            window.umkmId = id; // Save the UMKM ID to a global variable
        }

        function closeSetujuiModal() {
            document.getElementById('setujuiModal').classList.add('hidden');
        }

        function setujui() {
            document.getElementById('setujui-form-' + window.umkmId).submit();
        }

        document.getElementById('search-umkm-pendaftar').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                filterTable('search-umkm-pendaftar', 'table-body-umkm-pendaftar');
            }
        });

        document.getElementById('search-umkm-pendaftar-btn').addEventListener('click', function() {
            filterTable('search-umkm-pendaftar', 'table-body-umkm-pendaftar');
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

        document.getElementById('search-umkm-pendaftar').addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                filterTable('search-umkm-pendaftar', 'table-body-umkm-pendaftar');
                addHighlight('table-body-umkm-pendaftar');
            }
        });

        document.getElementById('search-umkm-pendaftar').addEventListener('input', function () {
            if (this.value === '') {
                filterTable('search-umkm-pendaftar', 'table-body-umkm-pendaftar');
                removeHighlight('table-body-umkm-pendaftar');
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