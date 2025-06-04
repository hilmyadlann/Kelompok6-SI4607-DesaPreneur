<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Kecamatan dan Desa
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-green-500 text-white h-screen p-4 fixed top-0 left-0">
            <div class="flex items-center justify-center mb-6 mt-20 mr-11">
                <span class="text-lg font-semibold">Dashboard Admin</span>
            </div>
            <nav>
                <a href="{{ route('admin.form-umkm.index') }}" class="flex items-center px-4 py-2 rounded mb-2 {{ request()->routeIs('admin.form-umkm.index') ? 'bg-green-600' : 'hover:bg-green-600' }}">
                    <img src="{{ asset('images/clipboard.png') }}" alt="Form Icon" class="w-5 h-5 mr-2"> Tambah Kecamatan dan Desa
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
        <div class="ml-64 flex-1 py-12">
            @if (session('success'))
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <!-- Form untuk menambah kecamatan dan desa -->
                        <h2 class="text-gray-900 text-xl font-bold" style="margin-left: 15px;">Tambah Kecamatan dan Desa</h2>
                        <form id="add-form" onsubmit="event.preventDefault(); confirmAddKecamatanDesa();" method="POST">
                            @csrf

                            <!-- Input untuk nama kecamatan -->
                            <div class="max-w-md mx-auto mt-6">
                                <label for="nama_kecamatan" class="block text-sm font-medium text-gray-700">Nama Kecamatan</label>
                                <input type="text" id="nama_kecamatan" name="nama_kecamatan" placeholder="Masukkan nama kecamatan"
                                    class="mt-1 block w-full px-3 py-2 border bg-gray-200 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900">

                                <!-- Input untuk nama desa -->
                                <label for="nama_desa" class="block text-sm font-medium text-gray-700">Nama Desa</label>
                                <input type="text" id="nama_desa" name="nama_desa" placeholder="Masukkan nama desa"
                                    class="mt-1 block w-full px-3 py-2 border bg-gray-200 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900">
                            </div>

                            <!-- Tombol untuk menambah kecamatan dan desa -->
                            <div class="flex justify-center mt-8">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 rounded-md font-semibold text-white tracking-wide shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 mb-4">
                                    Tambah kecamatan dan desa
                                </button>
                            </div>
                        </form>
                        <hr>
                        <!-- Tampilkan daftar kecamatan dan desa -->
                        <h2 class="px-6 py-3 bg-gray-50 text-left text-m font-medium text-gray-900">Daftar Kecamatan dan Desa</h2>
                        <div class="container mx-auto">
                            <div class="bg-gray-200 shadow-md rounded my-6">
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="shadow overflow-hidden border-b border-gray-300 sm:rounded-lg">
                                                <table class="min-w-full divide-y divide-gray-300">
                                                    <thead class="bg-gray-400">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 text-left text-base font-bold text-white tracking-wider">
                                                                No
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 text-left text-base font-bold text-white tracking-wider">
                                                                Nama Kecamatan
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 text-left text-base font-bold text-white tracking-wider">
                                                                Nama Desa
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 text-left text-base font-bold text-white tracking-wider">

                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-300">
                                                        @foreach($kecamatans as $kecamatan)
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap text-black">
                                                                {{ $loop->index + 1 }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-black">
                                                                {{ $kecamatan->nama_kecamatan }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-black font-medium">
                                                                @foreach($kecamatan->desas as $desa)
                                                                @php($isFirstDesa = $loop->first)
                                                                <div class="flex justify-between @if($isFirstDesa) mt-2 @endif">
                                                                    <p class="mr-2 @if($isFirstDesa) mt-2 @endif">{{ $desa->nama_desa }}</p>
                                                                    <button type="button" class="inline-block px-2 py-1 rounded-md bg-red-500 text-white hover:bg-red-600" style="border-radius: 10px; margin-bottom: 10px; font-size: 16px;" onclick="confirmDeleteDesa('{{ $desa->id }}')">Hapus Desa</button>
                                                                    <form id="delete-desa-form-{{ $desa->id }}" action="{{ route('admin.form-umkm.destroyDesa', ['desa' => $desa->id]) }}" method="POST" style="display: none;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                </div>
                                                                @endforeach
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                                <div class="flex items-center">
                                                                    <button type="button" class="inline-block px-2 py-1.5 rounded-md bg-red-500 text-white hover:bg-red-600" style="border-radius: 10px; font-size: 16px;" onclick="confirmDeleteKecamatan('{{ $kecamatan->id }}')">Hapus Kecamatan</button>
                                                                    <form id="delete-kecamatan-form-{{ $kecamatan->id }}" action="{{ route('admin.form-umkm.destroy', ['kecamatan' => $kecamatan->id]) }}" method="POST" style="display: none;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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

        <!-- Confirmation Modal for Delete Desa -->
        <div id="deleteDesaModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="closeDeleteDesaModal()">
                                    <path d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Konfirmasi Hapus Desa</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus desa ini?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" onclick="deleteDesa()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">Ya</button>
                        <button type="button" onclick="closeDeleteDesaModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Tidak</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmation Modal for Delete Kecamatan -->
        <div id="deleteKecamatanModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="closeDeleteKecamatanModal()">
                                    <path d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Konfirmasi Hapus Kecamatan</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus kecamatan ini?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" onclick="deleteKecamatan()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">Ya</button>
                        <button type="button" onclick="closeDeleteKecamatanModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Tidak</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmation Modal for Add Kecamatan and Desa -->
        <div id="addKecamatanDesaModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-green-600 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="closeAddKecamatanDesaModal()">
                                    <path d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Konfirmasi Tambah Kecamatan dan Desa</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Apakah Anda yakin ingin menambah kecamatan dan desa ini?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" onclick="submitAddKecamatanDesaForm()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 sm:ml-3 sm:w-auto sm:text-sm">Ya</button>
                        <button type="button" onclick="closeAddKecamatanDesaModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Tidak</button>
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

            function confirmDeleteDesa(desaId) {
                document.getElementById('deleteDesaModal').classList.remove('hidden');
                window.desaId = desaId; // Save the desa ID to a global variable
            }

            function closeDeleteDesaModal() {
                document.getElementById('deleteDesaModal').classList.add('hidden');
            }

            function deleteDesa() {
                document.getElementById('delete-desa-form-' + window.desaId).submit();
            }

            function confirmDeleteKecamatan(kecamatanId) {
                document.getElementById('deleteKecamatanModal').classList.remove('hidden');
                window.kecamatanId = kecamatanId; // Save the kecamatan ID to a global variable
            }

            function closeDeleteKecamatanModal() {
                document.getElementById('deleteKecamatanModal').classList.add('hidden');
            }

            function deleteKecamatan() {
                document.getElementById('delete-kecamatan-form-' + window.kecamatanId).submit();
            }

            function confirmAddKecamatanDesa() {
                document.getElementById('addKecamatanDesaModal').classList.remove('hidden');
            }

            function closeAddKecamatanDesaModal() {
                document.getElementById('addKecamatanDesaModal').classList.add('hidden');
            }

            function submitAddKecamatanDesaForm() {
                document.getElementById('add-form').submit();
            }
        </script>
</x-app-layout>