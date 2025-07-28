<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Bayar Listrik</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand">
                    Bayar Listrik
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        {{-- Tampilkan menu ini jika yang login adalah admin (guard 'web') --}}
                        @if (Auth::guard('web')->check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('penggunaan.index') }}">Pengelolaan Penggunaan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.pembayaran.index') }}">Konfirmasi Pembayaran</a>
                            </li>
                        @endif

                        {{-- Tampilkan menu ini jika yang login adalah pelanggan (guard 'pelanggan') --}}
                        @if (Auth::guard('pelanggan')->check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('tagihan.index') }}">Tagihan Saya</a>
                            </li>
                        @endif
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @if (!Auth::guard('web')->check() && !Auth::guard('pelanggan')->check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @else
                            {{-- Jika login (baik sebagai admin atau pelanggan) --}}
                            <li class="nav-item">
                                <span class="nav-link">
                                    Selamat datang,
                                    {{-- Tampilkan nama dari guard yang aktif --}}
                                    @if (Auth::guard('web')->check())
                                        {{ Auth::guard('web')->user()->name }}
                                    @else
                                        {{ Auth::guard('pelanggan')->user()->nama_pelanggan }}
                                    @endif
                                </span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
    <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>