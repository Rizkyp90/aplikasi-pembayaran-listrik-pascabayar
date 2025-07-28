@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Konfirmasi Pembayaran</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Pelanggan</th>
                                <th>Periode</th>
                                <th>Metode Pembayaran</th>
                                <th>Total Bayar</th>
                                <th>Bukti Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tagihans as $tagihan)
                                <tr>
                                    <td>{{ $tagihan->penggunaan->pelanggan->nama_pelanggan }}</td>
                                    <td>{{ $tagihan->penggunaan->bulan }}/{{ $tagihan->penggunaan->tahun }}</td>
                                    <td>{{ $tagihan->metode_pembayaran }}</td>
                                    <td>Rp {{ number_format($tagihan->total_bayar, 2, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ asset('storage/bukti_pembayaran/' . $tagihan->bukti_pembayaran) }}" target="_blank">
                                            Lihat Bukti
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.pembayaran.konfirmasi', $tagihan->id_tagihan) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Konfirmasi Lunas</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada pembayaran yang perlu dikonfirmasi saat ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection