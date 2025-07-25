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
                        <img src="/assets/images/logo-dark.svg" width="200px" alt="">
                        <small class="float-right">Date:
                            {{ Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}</small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>PT. Gahleb Palindo Interational</strong><br>
                        Jln. Hanjawar Kota Bunga, Desa Palasari <br>
                        Kec. Cipanas Kab. Cianjur Jawa Barat 43255<br>
                        Phone: (+62) 813-8872-5056<br>
                        Email: palindo.id@gmail.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong>{{ $data->document->name }}</strong><br>
                        {{ $data->document->address }}<br>
                        {{ $data->document->nation }}<br>
                        Phone: {{ $data->document->phone }}<br>
                        Email: {{ optional($data->document)->email ?? '-' }}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Quotation #{{ $invoiceNumber }}</b><br>
                    <br>
                    <b>Registration ID: {{ $data->document->registration_id }}</b> <br>
                    <b>Payment Due:</b> {{ $paymentDue }}<br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Unit Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $data->category->name }}</td>
                                <td>Rp {{ number_format($data->category->total, 0, '.', '.') }}</td>
                                <td>Rp {{ number_format($data->category->total, 0, '.', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Payment Methods:</p>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/2560px-Bank_Central_Asia.svg.png"
                        alt="bca" width="100px">

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        Ghaleb S S Alqrinawi <br>
                        <b>4520211221</b>
                    </p>
                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        Please attach proof of payment when confirming your order.
                        This whill greatly assist us in checking and expediting the service
                        process.
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-6">

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Total:</th>
                                <td>Rp {{ number_format($data->category->total, 0, '.', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
