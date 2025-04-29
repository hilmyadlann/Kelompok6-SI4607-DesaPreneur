<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil UMKM') }}
        </h2>
    </x-slot>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                
                    <!-- Form untuk mengedit informasi UMKM -->
                    <form method="POST" action="{{ route('umkms.update', $umkm) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2" for="image">
                                Unggah Foto Profil UMKM
                        
                            </label>
                            <div class="flex items-center justify-center bg-gray-100 rounded-lg p-4">
                                <input class="form-input w-full" type="file" name="images" id="image">
                                {{-- <img src="{{ asset('storage/' . $image->image_path) }}"  class="w-24 h-24 rounded-full border border-gray-400"> --}}
                            </div>
                        </div>

                        <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                            <label for="nama" class="col-span-1">Nama UMKM</label>
                            <input type="text" class="col-span-3 input input-bordered border-black @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan Nama UMKM Anda" value="{{ $umkm->nama }}" required>
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                            <label for="deskripsi" class="col-span-1">Deskripsi UMKM</label>
                            <input type="text" class="col-span-3 input input-bordered border-black @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi UMKM Anda" value="{{ $umkm->deskripsi }}" required>
                            @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                            <label for="kategori" class="col-span-1">Kategori UMKM</label>
                            <select id="kategori" name="kategori" class="col-span-3 input input-bordered border-black @error('kategori') is-invalid @enderror" required>
                                <option value="{{ $umkm->kategori }}" selected>{{ ucwords(str_replace('_', ' ', $umkm->kategori)) }}</option>
                                @unless($umkm->kategori == 'makanan_minuman')
                                    <option value="makanan_minuman">Makanan dan Minuman</option>
                                @endunless
                                @unless($umkm->kategori == 'kerajinan_tangan')
                                    <option value="kerajinan_tangan">Kerajinan Tangan</option>
                                @endunless
                                @unless($umkm->kategori == 'kebutuhan_sehari_hari')
                                    <option value="kebutuhan_sehari_hari">Kebutuhan Sehari-hari</option>
                                @endunless
                                @unless($umkm->kategori == 'pakaian')
                                    <option value="pakaian">Pakaian</option>
                                @endunless
                                @unless($umkm->kategori == 'hiasan')
                                    <option value="hiasan">Hiasan</option>
                                @endunless
                            </select>
                            @error('kategori')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                            <label for="link_whatsapp" class="col-span-1">Link Whatsapp UMKM</label>
                            <input type="text" class="col-span-3 input input-bordered border-black @error('link_whatsapp') is-invalid @enderror" id="link_whatsapp" name="link_whatsapp" placeholder="Masukkan Link Whatsapp UMKM Anda" value="{{ $umkm->link_whatsapp }}" required>
                            @error('link_whatsapp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                            <label for="link_marketplace" class="col-span-1">Link Marketplace UMKM</label>
                            <input type="text" class="col-span-3 input input-bordered border-black @error('link_marketplace') is-invalid @enderror" id="link_marketplace" name="link_marketplace" placeholder="Masukkan Link Marketplace UMKM Anda" value="{{ $umkm->link_marketplace }}" required>
                            @error('link_marketplace')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                            <label for="alamat" class="col-span-1">Alamat UMKM</label>
                            <input type="text" class="col-span-3 input input-bordered border-black @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Masukkan Alamat UMKM Anda" value="{{ $umkm->alamat }}" required>
                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                    <label for="kecamatan">Kecamatan UMKM</label>
                                    <select class="col-span-3 inline-flex justify-center w-full px-4 py-3 text-sm font-medium text-gray-700 bg-white border border-black rounded-md shadow-sm focus:outline-none @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" onchange="populateDesa()">
                                        <option value="">Pilih Kecamatan</option>
                                        @foreach ($kecamatans as $kecamatan)
                                            <option value="{{ $kecamatan->id }}" {{ old('kecamatan') == $kecamatan->id ? 'selected' : '' }}>
                                                {{ $kecamatan->nama_kecamatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kecamatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                    <label for="desa">Desa UMKM</label>
                                    <select class="col-span-3 inline-flex justify-center w-full px-4 py-3 text-sm font-medium text-gray-700 bg-white border border-black rounded-md shadow-sm focus:outline-none @error('desa') is-invalid @enderror" id="desa" name="desa">
                                        <option value="">Pilih Desa</option>
                                    </select>
                                    @error('desa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                        <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                            <label for="link_google_maps" class="col-span-1">Link Google Maps UMKM</label>
                            <input type="text" class="col-span-3 input input-bordered border-black @error('link_google_maps') is-invalid @enderror" id="link_google_maps" name="link_google_maps" placeholder="Masukkan Link Gooogle Maps UMKM Anda" value="{{ $umkm->link_google_maps }}" required>
                            @error('link_google_maps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        var selectedKecamatan = "{{ $umkm->kecamatan }}"; // Ambil kecamatan yang sebelumnya dipilih
        var selectedDesa = "{{ $umkm->desa }}"; // Ambil desa yang sebelumnya dipilih

        // Panggil fungsi populateDesa dengan kecamatan dan desa yang sebelumnya dipilih
        populateDesa(selectedKecamatan, selectedDesa);
    });

    function populateDesa(selectedKecamatan = null, selectedDesa = null) {
        var kecamatanId = selectedKecamatan ? selectedKecamatan : $("#kecamatan").val();
        if (kecamatanId) {
            $.ajax({
                url: "{{ route('desas.by-kecamatan', ['kecamatan' => ':kecamatan']) }}".replace(':kecamatan', kecamatanId),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $("#desa").empty();
                    $("#desa").append('<option value="">Pilih Desa</option>');
                    $.each(data, function(key, value) {
                        var selected = (value.id == selectedDesa) ? 'selected' : '';
                        $("#desa").append('<option value="' + value.id + '" '+ selected +'>' + value.nama_desa + '</option>');
                    });
                    if (selectedKecamatan) {
                        $("#kecamatan").val(selectedKecamatan); // Atur kecamatan yang terpilih
                    }
                }
            });
        } else {
            $("#desa").empty();
            $("#desa").append('<option value="">Pilih Desa</option>');
        }
    }

</script>
</x-app-layout>