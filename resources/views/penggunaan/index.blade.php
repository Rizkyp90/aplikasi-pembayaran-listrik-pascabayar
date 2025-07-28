@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data Penggunaan Listrik
                </div>
                <div class="card-body">
                    <a href="{{ route('penggunaan.create') }}" class="btn btn-primary mb-3">+ Tambah Data Penggunaan</a>
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Bulan / Tahun</th>
                                <th>Meter Awal</th>
                                <th>Meter Akhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penggunaans as $index => $penggunaan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $penggunaan->pelanggan->nama_pelanggan }}</td>
                                    <td>{{ $penggunaan->bulan }} / {{ $penggunaan->tahun }}</td>
                                    <td>{{ $penggunaan->meter_awal }}</td>
                                    <td>{{ $penggunaan->meter_akhir }}</td>
                                    <td>
                                        <form action="{{ route('penggunaan.destroy', $penggunaan->id_penggunaan) }}" method="POST" style="display:inline;">
                                            <a href="{{ route('penggunaan.edit', $penggunaan->id_penggunaan) }}" class="btn btn-sm btn-warning">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data penggunaan belum tersedia.</td>
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