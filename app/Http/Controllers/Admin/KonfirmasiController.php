<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;

class KonfirmasiController extends Controller
{
    /**
     * Menampilkan daftar pembayaran yang menunggu konfirmasi.
     */
    public function index()
    {
        $tagihans = Tagihan::where('status', 'Menunggu Konfirmasi')->with('penggunaan.pelanggan')->latest()->get();
        return view('admin.konfirmasi.index', compact('tagihans'));
    }

    /**
     * Mengkonfirmasi pembayaran dan mengubah status menjadi Lunas.
     */
    public function konfirmasi(Tagihan $tagihan)
    {
        $tagihan->update(['status' => 'Lunas']);
        return back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }
}