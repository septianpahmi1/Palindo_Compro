<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice Print</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <img src="/assets/images/logo-dark.svg" width="200" alt="Logo">
                        <small class="float-right">
                            Date: {{ \Carbon\Carbon::parse($data->date)->format('d/m/Y') }}
                        </small>
                    </h2>
                </div>
            </div>

            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                    From
                    <address>
                        <strong>PT. Ghaleb Palindo International</strong><br>
                        Jln. Hanjawar - Pacet RT.003 RW.013 Desa Sukanagalih <br>
                        Kec. Cipanas Kab. Cianjur Jawa Barat 43255 Indonesia<br>
                        Phone: (+62) 813-2020-558<br>
                        Email: admin@alharamainservices.id
                    </address>
                </div>

                <div class="col-sm-3 invoice-col">
                    To
                    <address>
                        <strong>{{ $data->customer->name }}</strong><br>
                        Phone: {{ $data->customer->phone }}<br>
                        Email: {{ optional($data->customer)->email ?? '-' }}
                    </address>
                </div>

                <div class="col-sm-3 invoice-col">
                    Nomor
                    <address>
                        <strong>{{ $data->number }}</strong>
                    </address>
                </div>
            </div>

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No. Invoice</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th>Diskon</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $invoiceNumber }}</td>
                                <td>Rp {{ number_format($data->price, 0, '.', '.') }}</td>
                                <td>{{ $data->quantity }}</td>
                                <td>Rp {{ number_format($data->discount, 0, '.', '.') }}</td>
                                <td>Rp {{ number_format($data->total, 0, '.', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Keterangan</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $data->ket }}</td>
                                <td>Rp {{ number_format($data->total, 0, '.', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- Auto print -->
    <script>
        window.addEventListener("load", function() {
            window.print();
        });
    </script>
</body>

</html>
