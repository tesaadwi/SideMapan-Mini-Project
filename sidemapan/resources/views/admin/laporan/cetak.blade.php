<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan DesaHub</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        h1, p {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        .total {
            margin-top: 20px;
            font-weight: bold;
        }

        @media print {
            button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <h1>Laporan Penjualan DesaHub</h1>
    <p>Periode:
        {{ request('tanggal_mulai', 'Semua tanggal') }}
        s.d.
        {{ request('tanggal_akhir', 'Semua tanggal') }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Pesanan</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesanans as $pesanan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pesanan->kode_pesanan ?? $pesanan->id }}</td>
                    <td>{{ $pesanan->created_at?->format('d-m-Y') }}</td>
                    <td>Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($pesanan->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data penjualan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="total">
        Total Penjualan:
        Rp{{ number_format($totalPenjualan, 0, ',', '.') }}
    </p>

    <button onclick="window.print()">Cetak Laporan</button>
</body>
</html>