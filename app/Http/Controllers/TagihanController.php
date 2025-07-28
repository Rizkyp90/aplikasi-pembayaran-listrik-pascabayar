<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Tagihan;

/**
 * Tagihan Controller
 *
 * @package     Aplikasi Listrik Pascabayar
 * @author      RIZKY KUSUMA PUTRA <kputra479@gmail.com>
 * @version     1.0.0
 *
 * @desc        Controller ini bertanggung jawab untuk menangani semua logika
 * yang berkaitan dengan pelanggan, seperti menampilkan riwayat
 * tagihan dan memproses alur pembayaran.
 */

class TagihanController extends Controller
{
    /**
     * Menampilkan daftar tagihan milik pengguna yang sedang login.
     */
    public function index()
    {
        $id_pelanggan = Auth::guard('pelanggan')->id();

        $tagihans = Tagihan::whereHas('penggunaan', function ($query) use ($id_pelanggan) {
            $query->where('id_pelanggan', $id_pelanggan);
        })->with('penggunaan')->latest()->get();

        return view('tagihan.index', compact('tagihans'));
    }

    /**
     * Menampilkan halaman konfirmasi pembayaran.
     */
    public function showPembayaran(Tagihan $tagihan)
    {
        if ($tagihan->penggunaan->id_pelanggan != Auth::guard('pelanggan')->id()) {
            abort(403);
        }

        // Data metode pembayaran yang kita sediakan
        $metodePembayaran = [
            'BCA' => '1234567890 (a.n. PT Listrik Ceria)',
            'Gopay' => '081234567890 (a.n. PT Listrik Ceria)',
            'ShopeePay' => '081234567890 (a.n. PT Listrik Ceria)',
            'DANA' => '081234567890 (a.n. PT Listrik Ceria)',
        ];

        return view('pembayaran.show', compact('tagihan', 'metodePembayaran'));
    }

    /**
     * Memproses pembayaran.
     */
    public function prosesPembayaran(Request $request, Tagihan $tagihan)
    {
        if ($tagihan->penggunaan->id_pelanggan != Auth::guard('pelanggan')->id()) {
            abort(403);
        }

        // Validasi dan simpan metode pembayaran
        $request->validate(['metode_pembayaran' => 'required|string']);

        $tagihan->update([
            'status' => 'Menunggu Pembayaran',
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return redirect()->route('pembayaran.upload.show', $tagihan->id_tagihan);
    }

    public function showUploadForm(Tagihan $tagihan)
    {
        if ($tagihan->penggunaan->id_pelanggan != Auth::guard('pelanggan')->id()) {
            abort(403);
        }

        // Data metode pembayaran yang kita sediakan
        $metodePembayaran = [
            'BCA' => '1234567890 (a.n. PT Listrik Ceria)',
            'Gopay' => '081234567890 (a.n. PT Listrik Ceria)',
            'ShopeePay' => '081234567890 (a.n. PT Listrik Ceria)',
            'DANA' => '081234567890 (a.n. PT Listrik Ceria)',
        ];

        return view('pembayaran.upload', compact('tagihan', 'metodePembayaran'));
    }

    public function storeUpload(Request $request, Tagihan $tagihan)
    {
        // Keamanan: Pastikan tagihan ini milik pengguna yang login
        if ($tagihan->penggunaan->id_pelanggan != Auth::guard('pelanggan')->id()) {
            abort(403);
        }

        // 1. Validasi file yang di-upload
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2. Simpan file ke storage dan dapatkan path-nya
        $path = $request->file('bukti_pembayaran')->store('public/bukti_pembayaran');
        
        // 3. Update database dengan nama file dan status baru
        $tagihan->update([
            'status' => 'Menunggu Konfirmasi',
            'bukti_pembayaran' => basename($path) // basename() mengambil nama filenya saja
        ]);
        
        return redirect()->route('tagihan.index')->with('success', 'Bukti pembayaran berhasil di-upload. Mohon tunggu konfirmasi dari admin.');
    }

    public function cetakStruk(Tagihan $tagihan)
    {
        // Keamanan: Pastikan struk ini milik pengguna yang login
        if ($tagihan->penggunaan->id_pelanggan != Auth::guard('pelanggan')->id()) {
            abort(403, 'AKSES DITOLAK');
        }

        // Pastikan hanya struk yang sudah lunas yang bisa dicetak
        if ($tagihan->status != 'Lunas') {
            return redirect()->route('tagihan.index')->with('error', 'Tagihan ini belum lunas.');
        }

        return view('tagihan.struk', compact('tagihan'));
    }
}