<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan KSM Tanjung</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h2, h4 {
            text-align: center;
            margin: 0;
        }
        .meta {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #444;
            padding: 6px;
        }
        th {
            background: #f0f0f0;
        }
        .total {
            margin-top: 15px;
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>

<h2>LAPORAN KEUANGAN</h2>
<h4>KSM TANJUNG</h4>

<div class="meta">
    Tanggal Cetak: {{ $tanggal }}
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Jumlah</th>
            <th>Metode</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pembayaran as $i => $item)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $item->created_at->format('d-m-Y') }}</td>
            <td>{{ $item->tagihan->pelanggan->user->name ?? '-' }}</td>
            <td>Rp {{ number_format($item->tagihan->jumlah, 0, ',', '.') }}</td>
            <td>{{ strtoupper($item->method) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="total">
    Total Pemasukan: Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
</div>

</body>
</html>