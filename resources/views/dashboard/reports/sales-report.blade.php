<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan per Barang</title>
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
            padding: .4rem;
        }

        .subtotal {
            font-weight: bold;
            border-top: 1px dashed #ccc;
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
                <div class="report-title">Rincian Penjualan per Barang</div>
                <div>
                    Dari {{ \Carbon\Carbon::parse($periodStart)->format('d M Y') ?? '-' }}
                    s/d {{ \Carbon\Carbon::parse($periodEnd)->format('d M Y') ?? '-' }}
                </div>
            </div>
        </div>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Penjualan</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach ($salesData as $itemName => $data)
                    <tr>
                        <td colspan="6"><strong>{{ $data['product_name'] }}</strong></td>
                    </tr>
                    @foreach ($data['items'] as $sale)
                        <tr>
                            <td>{{ $sale->number }}</td>
                            <td>{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</td>
                            <td>{{ $sale->ket ?? '-' }}</td>
                            <td class="text-center">{{ $sale->quantity }}</td>
                            <td class="text-right">{{ number_format($sale->total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="subtotal">
                        <td colspan="3">Total {{ $data['product_name'] }}</td>
                        <td class="text-center">{{ $data['total_quantity'] }}</td>
                        <td></td>
                        <td class="text-right">{{ number_format($data['total_amount'], 0, ',', '.') }}</td>
                    </tr>
                    @php $grandTotal += $data['total_amount']; @endphp
                @endforeach
                <tr class="subtotal">
                    <td colspan="5">GRAND TOTAL</td>
                    <td class="text-right">{{ number_format($grandTotal, 0, ',', '.') }}</td>
                </tr>
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
