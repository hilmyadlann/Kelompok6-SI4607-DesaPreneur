<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;

class KecamatanDesaController extends Controller
{
    public function index()
{
    $kecamatans = Kecamatan::all();
    return view('admin.form-umkm', compact('kecamatans'));
}

    
    // Menampilkan form untuk menambahkan kecamatan dan desa
    public function create()
    {
        $kecamatans = Kecamatan::all();
        return view('admin.form-umkm', compact('kecamatans'));
    }

    // Menyimpan kecamatan baru dan desa baru
    public function store(Request $request)
    {
    $request->validate([
        'nama_kecamatan' => 'required|string|max:255',
        'nama_desa' => 'required|string|max:255',
    ]);

    // Cek apakah kecamatan dengan nama yang sama sudah ada dalam database
    $kecamatan = Kecamatan::where('nama_kecamatan', $request->nama_kecamatan)->first();

    // Jika kecamatan sudah ada, gunakan kecamatan yang sudah ada tersebut
    if ($kecamatan) {
        $newDesa = $kecamatan->desas()->create([
            'nama_desa' => $request->nama_desa,
        ]);

        return redirect()->back()->with('success', 'Desa ' . $newDesa->nama_desa . ' berhasil ditambahkan pada kecamatan ' . $kecamatan->nama_kecamatan);
    }

    // Jika kecamatan belum ada, buat kecamatan baru dan tambahkan desa baru
    $newKecamatan = Kecamatan::create([
        'nama_kecamatan' => $request->nama_kecamatan,
    ]);

    $newDesa = $newKecamatan->desas()->create([
        'nama_desa' => $request->nama_desa,
    ]);

    return redirect()->back()->with('success', 'Kecamatan ' . $newKecamatan->nama_kecamatan . ' dan Desa ' . $newDesa->nama_desa . ' berhasil ditambahkan.');
}

    // Menghapus kecamatan dan semua desanya
    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->desas()->delete(); // Menghapus semua desa yang terkait dengan kecamatan
        $kecamatan->delete(); // Menghapus kecamatan itu sendiri

        return redirect()->back()->with('success', 'Kecamatan dan Desa berhasil dihapus.');
    }
    public function destroyDesa(Desa $desa)
{
    $desa->delete(); // Menghapus desa

    return redirect()->back()->with('success', 'Desa berhasil dihapus.');
}
}
