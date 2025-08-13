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
                        <strong>{{ $data->employee->name }}</strong><br>
                        NIK: {{ $data->employee->nik }}<br>
                        POSITION: {{ optional($data->employee)->position ?? '-' }}
                    </address>
                </div>

                <div class="col-sm-3 invoice-col">
                    Nomor
                    <address>
                        <strong>{{ $data->number }}</strong>
                    </address>
                    Payment Due: {{ Carbon\Carbon::parse($data->date_expired)->format('d/m/Y') }} <br>
                    Periode: {{ Carbon\Carbon::parse($data->date)->format('Y') }} <br>
                </div>
            </div>

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No. Invoice</th>
                                <th>Basic Salary</th>
                                <th>Allowance</th>
                                <th>Deduction</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $invoiceNumber }}</td>
                                <td>Rp {{ number_format($data->salary, 0, '.', '.') }}</td>
                                <td>Rp {{ number_format($data->allowance, 0, '.', '.') }}</td>
                                <td>Rp {{ number_format($data->deduction, 0, '.', '.') }}</td>
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
                                <td>{{ $data->description }}</td>
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
