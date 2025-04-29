<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Pendaftaran UMKM DesaPreneur') }}
        </h2>
    </x-slot>

    
        <div class="bg-white">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($existingUmkm = Auth::user()->umkms) 
                    @if ($existingUmkm->disetujui)

                        <div class="w-full">
                            <br><h1 class="ml-8 font-bold font-30px"> <strong>Status Verifikasi Pendaftaran UMKM Anda</strong> </h1><br>

                            <ul class="steps steps-vertical lg:steps-horizontal w-full">
                                <li class="step step-info"> 
                                    <strong>Tahap 1</strong>
                                    <span class="step-description width-10" style="font-size:14px">Pendaftaran UMKM Berhasil Diajukan</span>
                                </li>
                                <li class="step step-info">
                                    <strong>Tahap 2</strong> 
                                    <span class="step-description width-10" style="font-size:14px">Pendaftaran UMKM Anda Sedang Diverifikasi Oleh Admin</span>
                                </li>
                                <li class="step step-info">
                                    <strong>Tahap 3</strong>
                                    <span class="step-description width-10" style="font-size:14px">Pendaftaran UMKM Telah Selesai Diverifikasi</span>
                                </li>
                            </ul><br><br>
                        </div>  

                        <div class="flex flex-col items-center justify-center">
                            <div class="alert alert-success flex items-center justify-center text-center" style="width: 600px">
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Selamat, UMKM Anda Berhasil Diverifikasi<br>Tahapan Pendaftaran UMKM Anda Telah Selesai</span>
                            </div>
                            <br>
                            <a href="{{ route('toko', $existingUmkm->id) }}" class="btn btn-warning" style="width: 350px">Lihat Profil UMKM Saya</a>
                        </div>

                        <div class="bg-white"> 
                        <br><h1 class="ml-8 font-bold font-30px"><strong>Berikut adalah Preview Pendaftaran UMKM Anda!</strong></h1><br>

                            <form> 
                                <div class="grid grid-cols-6 gap-x-6 gap-y-4 p-8">
                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="images" class="col-span-1">Gambar UMKM:</label>
                                        <input type="file" class="col-span-3 file-input file-input-bordered file-input-success" name="images[]" accept="image/*" multiple onchange="previewImages(event)" disabled/>
                                    </div>
                                

                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="nama">Nama UMKM</label>
                                        <input type="text" class="col-span-3 input input-bordered border-black" id="nama" name="nama" value="{{ $existingUmkm->nama ?? '' }}" disabled>
                                    </div>


                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="deskripsi">Deskripsi UMKM</label>
                                        <textarea class="col-span-3 input input-bordered border-black" id="deskripsi" name="deskripsi" disabled>{{ $existingUmkm->deskripsi ?? '' }}</textarea>
                                    </div>

                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="kategori">Kategori UMKM</label>
                                        <select class="col-span-3 inline-flex justify-center w-full px-4 py-3 text-sm font-medium text-gray-700 bg-white border border-black rounded-md shadow-sm focus:outline-none" id="kategori" name="kategori" disabled>
                                            <option value="makanan_minuman" {{ $existingUmkm->kategori == 'makanan_minuman' ? 'selected' : '' }}>Makanan dan Minuman</option>
                                            <option value="kerajinan_tangan" {{ $existingUmkm->kategori == 'kerajinan_tangan' ? 'selected' : '' }}>Kerajinan Tangan</option>
                                            <option value="kebutuhan_sehari_hari" {{ $existingUmkm->kategori == 'kebutuhan_sehari_hari' ? 'selected' : '' }}>Kebutuhan Sehari-hari</option>
                                            <option value="pakaian" {{ $existingUmkm->kategori == 'pakaian' ? 'selected' : '' }}>Pakaian</option>
                                            <option value="hiasan" {{ $existingUmkm->kategori == 'hiasan' ? 'selected' : '' }}>Hiasan</option>
                                        </select>
                                    </div>
                                        
                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="link_whatsapp">Link WhatsApp:</label>
                                        <input type="text" id="link_whatsapp" name="link_whatsapp" class="col-span-3 input input-bordered border-black" value="{{ $existingUmkm->link_whatsapp ?? '' }}" disabled>
                                    </div>
                                        
                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="link_marketplace">Link Marketplace:</label>
                                        <input type="text" id="link_marketplace" name="link_marketplace" class="col-span-3 input input-bordered border-black" value="{{ $existingUmkm->link_marketplace ?? '' }}"disabled>
                                    </div>

                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="alamat">Alamat UMKM:</label>
                                        <input type="text" id="alamat" name="alamat" class="col-span-3 input input-bordered border-black" value="{{ $existingUmkm->alamat ?? '' }}" disabled>
                                    </div>

                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="kecamatan">Kecamatan UMKM:</label>
                                        <select id="kecamatan" name="kecamatan" class="col-span-3 inline-flex justify-center w-full px-4 py-3 text-sm font-medium text-gray-700 bg-white border border-black rounded-md shadow-sm focus:outline-none" disabled>
                                            @foreach ($kecamatans as $kecamatan)
                                                <option value="{{ $kecamatan->id }}" {{ $existingUmkm->kecamatan == $kecamatan->id ? 'selected' : '' }}>{{ $kecamatan->nama_kecamatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="desa">Desa UMKM:</label>
                                        <select id="desa" name="desa" class="col-span-3 inline-flex justify-center w-full px-4 py-3 text-sm font-medium text-gray-700 bg-white border border-black rounded-md shadow-sm focus:outline-none" disabled>
                                            @foreach ($desas as $desa)
                                                <option value="{{ $desa->id }}" {{ $existingUmkm->desa == $desa->id ? 'selected' : '' }}>{{ $desa->nama_desa }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        
                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="link_google_maps">Link Google Maps:</label>
                                        <input type="text" id="link_google_maps" name="link_google_maps" class="col-span-3 input input-bordered border-black" value="{{ $existingUmkm->link_google_maps ?? '' }}" disabled>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    @else
                        <div class="alert alert-info text-align:center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Form ini sedang menunggu persetujuan admin. Anda tidak dapat mengubah data saat ini.
                        </div>

                        <div class="w-full">
                            <br><h1 class="ml-8 font-bold font-30px"> <strong>Status Verifikasi Pendaftaran UMKM Anda</strong> </h1><br>

                            <ul class="steps steps-vertical lg:steps-horizontal w-full">
                                <li class="step step-info"> 
                                    <strong>Tahap 1</strong>
                                    <span class="step-description width-10" style="font-size:14px">Pendaftaran UMKM Berhasil Diajukan</span>
                                </li>
                                <li class="step step-info">
                                    <strong>Tahap 2</strong> 
                                    <span class="step-description width-10" style="font-size:14px">Pendaftaran UMKM Anda Sedang Diverifikasi Oleh Admin</span>
                                </li>
                                <li class="step ">
                                    <strong>Tahap 3</strong>
                                    <span class="step-description width-10" style="font-size:14px">Pendaftaran UMKM Telah Selesai Diverifikasi</span>
                                </li>
                            </ul><br>
                        </div>     
                        
                        <div class="bg-white"> 
                            <br><h1 class="ml-8 font-bold font-30px"><strong>Berikut adalah Preview Pendaftaran UMKM Anda!</strong></h1><br>
                        
                            <form> 
                                <div class="grid grid-cols-6 gap-x-6 gap-y-4 p-8">
                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="images" class="col-span-1">Gambar UMKM:</label>
                                        <input type="file" class="col-span-3 file-input file-input-bordered file-input-success" name="images[]" accept="image/*" multiple onchange="previewImages(event)" disabled/>
                                    </div>

                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="nama">Nama UMKM</label>
                                        <input type="text" class="col-span-3 input input-bordered border-black" id="nama" name="nama" value="{{ $existingUmkm->nama ?? '' }}" disabled>
                                    </div>


                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="deskripsi">Deskripsi UMKM</label>
                                        <textarea class="col-span-3 input input-bordered border-black" id="deskripsi" name="deskripsi" disabled>{{ $existingUmkm->deskripsi ?? '' }}</textarea>
                                    </div>

                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="kategori">Kategori UMKM</label>
                                        <select class="col-span-3 inline-flex justify-center w-full px-4 py-3 text-sm font-medium text-gray-700 bg-white border border-black rounded-md shadow-sm focus:outline-none" id="kategori" name="kategori" disabled>
                                            <option value="makanan_minuman" {{ $existingUmkm->kategori == 'makanan_minuman' ? 'selected' : '' }}>Makanan dan Minuman</option>
                                            <option value="kerajinan_tangan" {{ $existingUmkm->kategori == 'kerajinan_tangan' ? 'selected' : '' }}>Kerajinan Tangan</option>
                                            <option value="kebutuhan_sehari_hari" {{ $existingUmkm->kategori == 'kebutuhan_sehari_hari' ? 'selected' : '' }}>Kebutuhan Sehari-hari</option>
                                            <option value="pakaian" {{ $existingUmkm->kategori == 'pakaian' ? 'selected' : '' }}>Pakaian</option>
                                            <option value="hiasan" {{ $existingUmkm->kategori == 'hiasan' ? 'selected' : '' }}>Hiasan</option>
                                        </select>
                                    </div>
                                    
                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="link_whatsapp">Link WhatsApp:</label>
                                        <input type="text" id="link_whatsapp" name="link_whatsapp" class="col-span-3 input input-bordered border-black" value="{{ $existingUmkm->link_whatsapp ?? '' }}" disabled>
                                    </div>
                                    
                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="link_marketplace">Link Marketplace:</label>
                                        <input type="text" id="link_marketplace" name="link_marketplace" class="col-span-3 input input-bordered border-black" value="{{ $existingUmkm->link_marketplace ?? '' }}"disabled>
                                    </div>

                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="alamat">Alamat UMKM:</label>
                                        <input type="text" id="alamat" name="alamat" class="col-span-3 input input-bordered border-black" value="{{ $existingUmkm->alamat ?? '' }}" disabled>
                                    </div>

                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="kecamatan">Kecamatan UMKM:</label>
                                        <select id="kecamatan" name="kecamatan" class="col-span-3 inline-flex justify-center w-full px-4 py-3 text-sm font-medium text-gray-700 bg-white border border-black rounded-md shadow-sm focus:outline-none" disabled>
                                            @foreach ($kecamatans as $kecamatan)
                                                <option value="{{ $kecamatan->id }}" {{ $existingUmkm->kecamatan == $kecamatan->id ? 'selected' : '' }}>{{ $kecamatan->nama_kecamatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="desa">Desa UMKM:</label>
                                        <select id="desa" name="desa" class="col-span-3 inline-flex justify-center w-full px-4 py-3 text-sm font-medium text-gray-700 bg-white border border-black rounded-md shadow-sm focus:outline-none" disabled>
                                            @foreach ($desas as $desa)
                                                <option value="{{ $desa->id }}" {{ $existingUmkm->desa == $desa->id ? 'selected' : '' }}>{{ $desa->nama_desa }}</option>
                                            @endforeach
                                        </select>   
                                    </div>

                                    
                                    <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                        <label for="link_google_maps">Link Google Maps:</label>
                                        <input type="text" id="link_google_maps" name="link_google_maps" class="col-span-3 input input-bordered border-black" value="{{ $existingUmkm->link_google_maps ?? '' }}" disabled>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>  
                @endif
                @else
                        <form method="POST" action="{{ route('umkms.store') }}" enctype="multipart/form-data">
                            @csrf
                            <br><h1 class="text center ml-8 font-bold">SILAKAN ISI FORM PENDAFTARAN UMKM DIBAWAH INI!</h1>
                            <div class="grid grid-cols-6 gap-x-6 gap-y-4 p-8">

                                <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                    <label for="images"class="col-span-1">Profil UMKM</label>
                                    <input type="file" class="col-span-3 file-input file-input-bordered file-input-success @error('images') is-invalid @enderror" name="images[]" accept="image/*" multiple onchange="previewImages(event)" />
                                    @error('images')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                    <label for="nama" class="col-span-1">Nama UMKM</label>
                                    <input type="text" class="col-span-3 input input-bordered border-black @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan Nama UMKM Anda" value="{{ old('nama') }}" required>
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                    <label for="deskripsi">Deskripsi UMKM</label>
                                    <textarea class="col-span-3 input input-bordered border-black @error('deskripsi') is-invalid @enderror" id="deskripsi" placeholder="Masukkan deskripsi lengkap UMKM Anda" name="deskripsi">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                    <label for="kategori">Kategori UMKM</label>
                                    <select class="col-span-3 inline-flex justify-center w-full px-4 py-3 text-sm font-medium text-gray-700 bg-white border border-black rounded-md shadow-sm focus:outline-none @error('kategori') is-invalid @enderror" id="kategori" name="kategori">
                                        <option value="makanan_minuman" {{ old('kategori') == 'makanan_minuman' ? 'selected' : '' }}>Makanan dan Minuman</option>
                                        <option value="kerajinan_tangan" {{ old('kategori') == 'kerajinan_tangan' ? 'selected' : '' }}>Kerajinan Tangan</option>
                                        <option value="kebutuhan_sehari_hari" {{ old('kategori') == 'kebutuhan_sehari_hari' ? 'selected' : '' }}>Kebutuhan Sehari-hari</option>
                                        <option value="pakaian" {{ old('kategori') == 'pakaian' ? 'selected' : '' }}>Pakaian</option>
                                        <option value="hiasan" {{ old('kategori') == 'hiasan' ? 'selected' : '' }}>Hiasan</option>
                                    </select>
                                    @error('kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                    <label for="link_whatsapp">Link WhatsApp</label>
                                    <input type="text" class="col-span-3 input input-bordered border-black @error('link_whatsapp') is-invalid @enderror" id="link_whatsapp" name="link_whatsapp" placeholder="Tautkan link Whatsapp milik Anda" value="{{ old('link_whatsapp') }}">
                                    @error('link_whatsapp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                    <label for="link_marketplace">Link Marketplace</label>
                                    <input type="text"class="col-span-3 input input-bordered border-black @error('link_marketplace') is-invalid @enderror" id="link_marketplace" name="link_marketplace" placeholder="Tautkan link Marketlace milik Anda" value="{{ old('link_marketplace') }}">
                                    @error('link_marketplace')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="sm:col-span-6 grid grid-cols-6 gap-4 mb-5">
                                    <label for="alamat">Alamat UMKM</label>
                                    <input type="text" class="col-span-3 input input-bordered border-black @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Masukkan alamat lengkap UMKM milk Anda dengan menyertakan kode pos" value="{{ old('alamat') }}">
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
                                    <label for="link_google_maps">Link Google Maps</label>
                                    <input type="text" class="col-span-3 input input-bordered border-black @error('link_google_maps') is-invalid @enderror" id="link_google_maps" name="link_google_maps" placeholder="Tautkan link google maps lokasi UMKM Anda" value="{{ old('link_google_maps') }}">
                                    @error('link_google_maps')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>     
                                <button type="submit" class="btn btn-success text-white px-20 py-4 ml-10" id="buttondaftar" onclick="return confirm('Yakin ?')">Daftar UMKM</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function populateDesa() {
    var kecamatanId = $("#kecamatan").val();
    if (kecamatanId) {
        $.ajax({
            url: "{{ route('desas.by-kecamatan', ['kecamatan' => ':kecamatan']) }}".replace(':kecamatan', kecamatanId),
            type: "GET",
            dataType: "json",
            success: function(data) {
                $("#desa").empty();
                $("#desa").append('<option value="">Pilih Desa</option>');
                $.each(data, function(key, value) {
                    $("#desa").append('<option value="' + value.id + '">' + value.nama_desa + '</option>');
                });
            }
        });
    } else {
        $("#desa").empty();
        $("#desa").append('<option value="">Pilih Desa</option>');
    }
}
    </script>
</x-app-layout>