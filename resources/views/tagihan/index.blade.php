@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Riwayat Tagihan Anda
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bulan / Tahun</th>
                                <th>Jumlah Meter (KWH)</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tagihans as $index => $tagihan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $tagihan->penggunaan->bulan }} / {{ $tagihan->penggunaan->tahun }}</td>
                                    <td>{{ $tagihan->jumlah_meter }}</td>
                                    <td>Rp {{ number_format($tagihan->total_bayar, 2, ',', '.') }}</td>
                                    <td>
                                        @if ($tagihan->status == 'Lunas')
                                            <span class="badge bg-success">Lunas</span>
                                        @elseif ($tagihan->status == 'Menunggu Konfirmasi')
                                            <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                                        @else
                                            <span class="badge bg-danger">{{ $tagihan->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($tagihan->status == 'Belum Lunas' || $tagihan->status == 'Belum Bayar')
                                            <a href="{{ route('pembayaran.show', $tagihan->id_tagihan) }}" class="btn btn-sm btn-primary">Bayar Sekarang</a>
                                        @elseif ($tagihan->status == 'Menunggu Pembayaran')
                                            <a href="{{ route('pembayaran.upload.show', $tagihan->id_tagihan) }}" class="btn btn-sm btn-warning">Upload Bukti</a>
                                        @elseif ($tagihan->status == 'Lunas')
                                            <a href="{{ route('struk.cetak', $tagihan->id_tagihan) }}" class="btn btn-sm btn-info" target="_blank">Cetak Struk</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Anda belum memiliki riwayat tagihan.</td>
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