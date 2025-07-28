@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- TAMPILAN UNTUK ADMIN --}}
                    @if (Auth::guard('web')->check())
                        <h4>Selamat Datang, Admin!</h4>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="card text-white bg-primary">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Pelanggan</h5>
                                        <p class="card-text fs-4">{{ $total_pelanggan }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-info">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Tagihan Masuk</h5>
                                        <p class="card-text fs-4">{{ $total_tagihan }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-success">
                                    <div class="card-body">
                                        <h5 class="card-title">Tagihan Lunas</h5>
                                        <p class="card-text fs-4">{{ $tagihan_lunas }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- TAMPILAN UNTUK PELANGGAN --}}
                    @if (Auth::guard('pelanggan')->check())
                        <h4>Selamat Datang, {{ Auth::guard('pelanggan')->user()->nama_pelanggan }}!</h4>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="card text-white bg-danger mb-3">
                                    <div class="card-header">Tagihan Belum Lunas</div>
                                    <div class="card-body">
                                        <h5 class="card-title fs-4">{{ $tagihan_belum_lunas_count }} Tagihan</h5>
                                        <p class="card-text">Total yang harus dibayar adalah <strong>Rp {{ number_format($tagihan_belum_lunas_total, 0, ',', '.') }}</strong>.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header">Aksi Cepat</div>
                                    <div class="card-body">
                                        <h5 class="card-title">Lihat Riwayat Tagihan</h5>
                                        <p class="card-text">Lihat semua riwayat tagihan Anda dan lakukan pembayaran.</p>
                                        <a href="{{ route('tagihan.index') }}" class="btn btn-primary">Ke Halaman Tagihan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection