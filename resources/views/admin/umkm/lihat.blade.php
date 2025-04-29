<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Profil UMKM') }}
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
        <div class="ml-64 flex-1 py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="mb-6">
                            <label class="block text-black font-bold mb-2">Detail Profil UMKM</label>
                            <div class="flex items-center justify-center bg-gray-100 rounded-lg p-4">
                                @foreach($umkm->image as $image)
                                    <div class="relative mx-2">
                                        <div class="w-24 h-24 rounded-full overflow-hidden border border-gray-400">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $umkm->nama }}" class="w-full h-full object-cover">
                                        </div>
                                        <a href="{{ asset('storage/' . $image->image_path) }}" download class="absolute bottom-0 right-0 bg-gray-800 text-white text-xs p-1 rounded-full hover:bg-gray-600">
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

                        <table class="w-full text-left table-auto border border-gray-300">
                            <tbody>
                                <tr class="border-b border-gray-300">
                                    <th class="pr-4 py-2 text-black whitespace-nowrap w-48 border-r border-gray-300">Nama UMKM</th>
                                    <td class="py-2 text-gray-700">{{ $umkm->nama }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="pr-4 py-2 text-black whitespace-nowrap w-48 border-r border-gray-300">Deskripsi UMKM</th>
                                    <td class="py-2 text-gray-700">{{ $umkm->deskripsi }}</td>
                                </tr>

                                @php
                                    $fields = [
                                        'kategori' => 'Kategori UMKM',
                                        'link_whatsapp' => 'Link Whatsapp UMKM',
                                        'link_marketplace' => 'Link Marketplace UMKM',
                                        'alamat' => 'Alamat UMKM',
                                        'kecamatan' => 'Kecamatan UMKM',
                                        'desa' => 'Desa UMKM',
                                        'link_google_maps' => 'Link Google Maps UMKM',
                                    ];
                                @endphp

                                @foreach ($fields as $field => $label)
                                    <tr class="border-b border-gray-300">
                                        <th class="pr-4 py-2 text-black whitespace-nowrap w-48 border-r border-gray-300">{{ $label }}</th>
                                        <td class="py-2 text-gray-700">
                                            @if(in_array($field, ['link_google_maps', 'link_whatsapp', 'link_marketplace']))
                                                <a href="{{ $umkm->$field }}" target="_blank" class="text-blue-500 hover:underline">
                                                    @if($field == 'link_google_maps')
                                                        Lihat Lokasi UMKM di Google Maps
                                                    @elseif($field == 'link_whatsapp')
                                                        Lihat Kontak UMKM di WhatsApp
                                                    @elseif($field == 'link_marketplace')
                                                        Lihat UMKM di Marketplace
                                                    @endif
                                                </a>
                                            @else
                                                {{ $field == 'kategori' ? ucwords(str_replace('_', ' ', $umkm->$field)) : $umkm->$field }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            <a href="{{ route('admin.umkm.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Kembali ke Dashboard</a>
                            <a href="{{ route('umkm.produk', ['umkm_id' => $umkm->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Lihat Produk UMKM</a>
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
    </script>         
</x-app-layout>