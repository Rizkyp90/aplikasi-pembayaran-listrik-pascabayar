<?php

namespace App\Http\Controllers;

use App\Models\Penggunaan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PenggunaanController extends Controller
{
    /**
     * Menampilkan daftar penggunaan.
     */
    public function index()
    {
        // Ambil semua data penggunaan beserta data pelanggannya
        $penggunaans = Penggunaan::with('pelanggan')->latest()->get();

        // Kirim data ke view
        return view('penggunaan.index', compact('penggunaans'));
    }

        /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        $pelanggans = Pelanggan::all(); // Ambil semua data pelanggan
        return view('penggunaan.create', compact('pelanggans'));
    }

    /**
 * Menyimpan data baru ke database.
 */
    public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'bulan' => 'required|string|max:2',
            'tahun' => 'required|string|max:4',
            'meter_awal' => 'required|numeric',
            'meter_akhir' => 'required|numeric|gt:meter_awal', // meter akhir harus > meter awal
        ]);

        // 2. Simpan data ke database
        Penggunaan::create($request->all());

        // 3. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('penggunaan.index')->with('success', 'Data penggunaan berhasil ditambahkan.');
    }

    /**
 * Menampilkan form untuk mengedit data.
 */
    public function edit(Penggunaan $penggunaan)
    {
        $pelanggans = Pelanggan::all(); // Ambil semua pelanggan untuk dropdown
        return view('penggunaan.edit', compact('penggunaan', 'pelanggans'));
    }

    /**
 * Memperbarui data di database.
 */
    public function update(Request $request, Penggunaan $penggunaan)
    {
        // 1. Validasi data
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'bulan' => 'required|string|max:2',
            'tahun' => 'required|string|max:4',
            'meter_awal' => 'required|numeric',
            'meter_akhir' => 'required|numeric|gt:meter_awal',
        ]);

        // 2. Update data di database
        $penggunaan->update($request->all());

        // 3. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('penggunaan.index')->with('success', 'Data penggunaan berhasil diperbarui.');
    }

        /**
     * Menghapus data dari database.
     */
    public function destroy(Penggunaan $penggunaan)
    {
        // Hapus data yang ditemukan
        $penggunaan->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('penggunaan.index')->with('success', 'Data penggunaan berhasil dihapus.');
    }
}