<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;

class AdminUmkmController extends Controller
{
    public function index()
    {
        $umkmPendaftar = Umkm::where('disetujui', false)->get();
        $umkmAktif = Umkm::where('disetujui', true)->get();
    
        return view('admin.dashboard', compact('umkmPendaftar', 'umkmAktif'));
    }

    // Update baru untuk button Kembali ke Dashboard
    public function umkmIndex()
    {
        $umkmPendaftar = Umkm::where('disetujui', false)->get();
        $umkmAktif = Umkm::where('disetujui', true)->get();
    
        return view('admin.dashboard', compact('umkmPendaftar', 'umkmAktif'));
    }

    public function setujui(Umkm $umkm)
    {
        try {
            $umkm->update(['disetujui' => true]);
            return redirect()->route('admin.dashboard')->with('success', 'UMKM berhasil disetujui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyetujui UMKM: ' . $e->getMessage());
        }
    }

    public function tolak(Umkm $umkm)
    {
        $umkm->delete();
        return redirect()->route('admin.dashboard')->with('success', 'UMKM berhasil ditolak.');
    }

    public function lihat(Umkm $umkm)
    {
        // Implementasi untuk menampilkan detail UMKM
        return view('admin.umkm.lihat', compact('umkm'));
    }

    public function hapus(Umkm $umkm)
    {
        // Implementasi untuk menghapus UMKM
        $umkm->delete();

        return redirect()->route('admin.dashboard')->with('success', 'UMKM berhasil dihapus.');
    }

    public function show(Umkm $umkm)
    {
        // Implementasi untuk menampilkan detail UMKM
        return view('admin.umkm.show', compact('umkm'));
    }
}