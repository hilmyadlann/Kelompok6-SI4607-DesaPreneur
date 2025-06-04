<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;

use App\Models\Image;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class UMKMController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        $existingUmkm = $user->umkms()->where('disetujui', true)->first();

        if ($existingUmkm) {
            // Jika pengguna sudah memiliki UMKM yang disetujui, arahkan ke halaman toko
            return redirect()->route('toko', $existingUmkm->id);
        }

        $kecamatans = Kecamatan::all();
        $desas = Desa::all();

        return view('umkms.create', compact('kecamatans', 'desas'));
    }

    public function store(Request $request, Umkm $umkm)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:255',
            'alamat' => 'required|string',
            'link_whatsapp' => 'required|string|max:255',
            'link_marketplace' => 'required|string|max:255',
            'kecamatan' => 'required|exists:kecamatans,id',
            'desa' => 'required|exists:desas,id',
            'link_google_maps' => 'required|string|max:255',
        ]);

        // Simpan data UMKM ke dalam database
        $umkm = new Umkm($validatedData);
        $umkm->user_id = auth()->id();
        $umkm->save();

        // Simpan gambar jika ada yang diunggah
        if ($request->hasFile('images')) {
            $images = $request->file('images');
        
            foreach ($images as $image) {
                if ($image->isValid()) {
                    $imagePath = $image->store('images', 'public'); 
                    // Buat entri baru di tabel 'image' dan simpan ke database
                    $umkm->image()->create(['image_path' => $imagePath])->save();
                } else {
                    return redirect()->back()->with('error', 'Invalid file uploaded.');
                }
            }
        }

        // Periksa apakah UMKM sudah terdaftar sebelumnya
        $existingUmkm = Umkm::where('user_id', auth()->id())->first();
        if ($existingUmkm) {
            return redirect()->back()->with('error', 'Anda sudah mendaftarkan UMKM sebelumnya dan masih menunggu persetujuan admin.');
        }

        return redirect()->route('umkms.create')->with('success', 'UMKM berhasil didaftarkan. Tunggu konfirmasi admin.');
    }

    public function toko(Umkm $umkm)
    {
        // Periksa apakah pengguna yang terautentikasi memiliki hak akses atau apakah UMKM telah disetujui
        if ($umkm->user_id != auth()->user()->id || !$umkm->disetujui) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengubah UMKM ini.');
        }
    
        // Ambil produk yang terkait dengan UMKM dan eager load gambar mereka
        $products = $umkm->products()->with('images')->get();
    
        // Kirimkan data UMKM dan produk ke view
        return view('umkms.toko', compact('umkm', 'products'));
    }

    public function update(Request $request, Umkm $umkm)
    {
        // Validasi input data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:255',
            'alamat' => 'required|string',
            'link_whatsapp' => 'required|string|max:255',
            'link_marketplace' => 'required|string|max:255',
            'kecamatan' => 'required|exists:kecamatans,id',
            'desa' => 'required|exists:desas,id',
            'link_google_maps' => 'required|string|max:255',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            
            foreach ($umkm->image as $image) {           
                Storage::disk('public')->delete($image->image_path);
                $umkm->image()->delete();
            }

            $imagePath = $images->store('images','public');
            $umkm->image()->create([
                'image_path' => $imagePath,
            ]);
        }

        // Update data UMKM
        $umkm->update($validatedData);

        // Mengarahkan pengguna kembali ke halaman detail toko
        return redirect()->route('toko', ['umkm' => $umkm])->with('success', 'Data UMKM berhasil diperbarui.');
    }

    public function getDesasByKecamatan($kecamatanId)
    {
        $desas = Desa::where('kecamatan_id', $kecamatanId)->get();
        return response()->json($desas);
    }

    public function show(Umkm $umkm)
    {
        // Mengambil data gambar dari relasi
        $images = $umkm->image;

        // Mengambil data kecamatan dari relasi
        $kecamatan = $umkm->kecamatans ? $umkm->kecamatans->nama_kecamatan : '';

        $kecamatans = Kecamatan::all();
        $desas = Desa::all();

        // Mengirim data Umkm, gambar, dan kecamatan ke view umkms.umkm-show
        return view('umkms.umkm-show', compact('umkm', 'images', 'kecamatans'));
    }

    public function showProducts($umkm_id)
    {
        $umkm = UMKM::with('image')->findOrFail($umkm_id);
        $products = Product::where('umkm_id', $umkm_id)->with('images')->get();
        return view('admin.umkm.produk', compact('umkm', 'products'));

        $kecamatan = $umkm->kecamatan;
        $desa = $umkm->desa;
        
        // Mengirim data Umkm, gambar, dan kecamatan ke view umkms.umkm-show
        return view('umkms.umkm-show', compact('umkm', 'images', 'kecamatans','desas'));
    }

    // Untuk menampilkan daftar UMKM pendaftar
    public function indexPendaftar()
    {
        $umkmPendaftar = Umkm::where('disetujui', false)->get();
        return view('admin.umkm.umkm-pendaftar', compact('umkmPendaftar'));
    }

    // Untuk menampilkan daftar UMKM aktif
    public function indexAktif()
    {
        $umkmAktif = Umkm::where('disetujui', true)->get();
        return view('admin.umkm.umkm-aktif', compact('umkmAktif'));
    }

}