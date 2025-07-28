<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran Listrik - {{ $tagihan->penggunaan->pelanggan->nomor_kwh }}</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { width: 400px; margin: auto; border: 1px solid #ccc; padding: 20px; }
        h2 { text-align: center; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 5px; }
        .label { width: 40%; }
        .total { font-weight: bold; font-size: 1.2em; }
        .print-button { display: block; width: 100%; padding: 10px; background: #0d6efd; color: white; border: none; cursor: pointer; text-align: center; margin-top: 20px; text-decoration: none; }
        @media print {
            .print-button { display: none; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Struk Pembayaran Listrik</h2>
        <table>
            <tr>
                <td class="label">ID Pelanggan</td>
                <td>: {{ $tagihan->penggunaan->pelanggan->nomor_kwh }}</td>
            </tr>
            <tr>
                <td class="label">Nama Pelanggan</td>
                <td>: {{ $tagihan->penggunaan->pelanggan->nama_pelanggan }}</td>
            </tr>
            <tr>
                <td class="label">Periode</td>
                <td>: {{ $tagihan->penggunaan->bulan }} / {{ $tagihan->penggunaan->tahun }}</td>
            </tr>
            <tr>
                <td class="label">Jumlah Meter</td>
                <td>: {{ $tagihan->jumlah_meter }} KWH</td>
            </tr>
            <tr>
                <td class="label">Metode Bayar</td>
                <td>: {{ $tagihan->metode_pembayaran }}</td>
            </tr>
            <tr class="total">
                <td class="label">Total Bayar</td>
                <td>: Rp {{ number_format($tagihan->total_bayar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td>: LUNAS</td>
            </tr>
        </table>
    </div>
    <div class="container" style="border: none;">
        <a href="#" class="print-button" onclick="window.print()">Cetak Struk</a>
    </div>
</body>
</html>