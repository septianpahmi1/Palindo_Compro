<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Jurnal Umum</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }

        body {
            font-size: 14px;
        }

        .report-title {
            font-weight: bold;
            font-size: 18px;
        }

        .table th,
        .table td {
            padding: 6px;
            vertical-align: middle;
        }

        .amount {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row report-header text-center mb-4">
            <div class="col-md-12">
                <div class="report-title">{{ $companyName ?? 'PT. Ghaleb Palindo International' }}</div>
                <div class="mb-4">
                    {{ $companyAddress ?? 'Jln. Hanjawar - Pacet RT.003 RW.013 Desa Sukanagalih, Kec. Cipanas, Kabupaten Cianjur' }}
                </div>
                <div class="report-title">Laba/Rugi (Standar)</div>
                <div>
                    Dari {{ \Carbon\Carbon::parse($periodStart)->format('d M Y') ?? '-' }}
                    s/d {{ \Carbon\Carbon::parse($periodEnd)->format('d M Y') ?? '-' }}
                </div>
            </div>
        </div>

        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Tipe Transaksi</th>
                    <th class="amount">Nilai</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($journals as $row)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($row->date)->format('d M Y') }}</td>
                        <td>{{ $row->type }}</td>
                        <td class="amount">Rp {{ number_format($row->total, 0, ',', '.') }}</td>
                        <td>{{ $row->title }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        window.addEventListener("load", function() {
            window.print();
        });
    </script>
</body>

</html>
