<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Tagihan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('check.auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $viewData = [];

        // Cek jika yang login adalah admin (guard 'web')
        if (Auth::guard('web')->check()) {
            $viewData['total_pelanggan'] = Pelanggan::count();
            $viewData['total_tagihan'] = Tagihan::count();
            $viewData['tagihan_lunas'] = Tagihan::where('status', 'Lunas')->count();
        }
        // Cek jika yang login adalah pelanggan (guard 'pelanggan')
        elseif (Auth::guard('pelanggan')->check()) {
            $pelanggan = Auth::guard('pelanggan')->user();

            $tagihanQuery = Tagihan::whereHas('penggunaan', function ($query) use ($pelanggan) {
                $query->where('id_pelanggan', $pelanggan->id_pelanggan);
            })->whereIn('status', ['Belum Lunas', 'Belum Bayar', 'Menunggu Pembayaran']);

            $viewData['tagihan_belum_lunas_count'] = $tagihanQuery->count();
            $viewData['tagihan_belum_lunas_total'] = $tagihanQuery->sum('total_bayar');
        }
        
        return view('home', $viewData);
    }
}