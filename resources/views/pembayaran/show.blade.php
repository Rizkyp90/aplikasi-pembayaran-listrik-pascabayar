@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Konfirmasi Pembayaran</div>

                <div class="card-body">
                    <h5>Detail Tagihan</h5>
                    <table class="table">
                        <tr>
                            <th>Periode</th>
                            <td>{{ $tagihan->penggunaan->bulan }} / {{ $tagihan->penggunaan->tahun }}</td>
                        </tr>
                        <tr>
                            <th>Total Bayar</th>
                            <td class="fs-4 fw-bold">Rp {{ number_format($tagihan->total_bayar, 2, ',', '.') }}</td>
                        </tr>
                    </table>

                    <hr>

                    <form action="{{ route('pembayaran.proses', $tagihan->id_tagihan) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="metode_pembayaran" class="form-label">Pilih Metode Pembayaran</label>
                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required onchange="showInstruction()">
                                <option value="">-- Pilih Metode --</option>
                                @foreach ($metodePembayaran as $metode => $nomor)
                                    <option value="{{ $metode }}">{{ $metode }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="instruction-box" class="alert alert-info" style="display: none;">
                            Silakan lakukan pembayaran ke: <br>
                            <strong id="instruction-text"></strong>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Lanjutkan ke Upload Bukti</button>
                    </form>

                    <script>
                        const metodeData = @json($metodePembayaran);

                        function showInstruction() {
                            const select = document.getElementById('metode_pembayaran');
                            const instructionBox = document.getElementById('instruction-box');
                            const instructionText = document.getElementById('instruction-text');

                            if (select.value) {
                                instructionText.innerText = metodeData[select.value];
                                instructionBox.style.display = 'block';
                            } else {
                                instructionBox.style.display = 'none';
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection