@extends('layouts.app')

@section('content')
{{-- Hero Section --}}
<div class="container-fluid bg-primary text-white text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold">Bayar Listrik Pascabayar Lebih Mudah</h1>
        <p class="lead my-3">Cek tagihan dan lakukan pembayaran listrik bulanan Anda kapan saja, di mana saja, dengan beberapa klik saja.</p>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg me-2">Daftar Sekarang</a>
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">Login</a>
    </div>
</div>

{{-- Features Section --}}
<div class="container py-5">
    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">✔️ Cek Tagihan</h3>
                    <p class="card-text">Akses riwayat tagihan listrik Anda secara lengkap dan transparan. Tidak ada lagi tagihan yang terlewat.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">💳 Pembayaran Fleksibel</h3>
                    <p class="card-text">Pilih metode pembayaran yang paling nyaman untuk Anda, mulai dari transfer bank hingga e-wallet populer.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">🔒 Konfirmasi Aman</h3>
                    <p class="card-text">Upload bukti pembayaran Anda dengan mudah dan dapatkan konfirmasi dari admin kami secara cepat dan aman.</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- How It Works Section --}}
<div class="container-fluid bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col text-center mb-4">
                <h2>Cara Kerja</h2>
                <p>Hanya dalam 3 langkah mudah.</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">1. Daftar Akun</h5>
                        <p class="card-text">Buat akun Anda dengan nomor KWH dan data diri yang valid.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">2. Cek & Bayar Tagihan</h5>
                        <p class="card-text">Pilih tagihan yang akan dibayar dan metode pembayaran Anda.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">3. Upload & Konfirmasi</h5>
                        <p class="card-text">Upload bukti pembayaran Anda dan tunggu konfirmasi dari admin.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection