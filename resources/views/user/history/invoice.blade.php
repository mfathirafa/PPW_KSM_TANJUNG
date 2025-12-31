<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
        }
        th {
            background: #f0f0f0;
        }
    </style>
</head>
<body>

<h2 align="center">INVOICE PEMBAYARAN</h2>
<p align="center">KSM TANJUNG</p>

<hr>

<table>
    <tr>
        <th>ID Pembayaran</th>
        <td>{{ $pembayaran->id }}</td>
    </tr>
    <tr>
        <th>Tanggal</th>
        <td>{{ $pembayaran->created_at->translatedFormat('d F Y') }}</td>
    </tr>
    <tr>
        <th>Bulan Tagihan</th>
        <td>{{ $pembayaran->tagihan->bulan }}</td>
    </tr>
    <tr>
        <th>Metode</th>
        <td>{{ strtoupper($pembayaran->method) }}</td>
    </tr>
    <tr>
        <th>Jumlah</th>
        <td>Rp {{ number_format($pembayaran->tagihan->jumlah, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>{{ strtoupper($pembayaran->status) }}</td>
    </tr>
</table>

<p style="margin-top:20px">
    Dicetak pada {{ now()->translatedFormat('d F Y') }}
</p>

</body>
</html>