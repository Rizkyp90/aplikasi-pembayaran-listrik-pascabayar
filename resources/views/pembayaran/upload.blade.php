@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload Bukti Pembayaran</div>
               <div class="card-body">
                <div class="alert alert-info">
                    Silakan lakukan pembayaran sebesar <strong>Rp {{ number_format($tagihan->total_bayar, 2, ',', '.') }}</strong>
                    <br>
                    Metode: <strong>{{ $tagihan->metode_pembayaran }}</strong>
                    <br>
                    Nomor Tujuan: <strong>{{ $metodePembayaran[$tagihan->metode_pembayaran] ?? 'Tidak Ditemukan' }}</strong>
                    <br><br>
                    Upload bukti transfer Anda di bawah ini.
                </div>

                {{-- Form untuk upload bukti --}}
                <form action="{{ route('pembayaran.upload.store', $tagihan->id_tagihan) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="bukti_pembayaran" class="form-label">File Bukti Pembayaran</label>
                        <input class="form-control @error('bukti_pembayaran') is-invalid @enderror" type="file" name="bukti_pembayaran" id="bukti_pembayaran" required>
                        @error('bukti_pembayaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary"> Upload Bukti</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection