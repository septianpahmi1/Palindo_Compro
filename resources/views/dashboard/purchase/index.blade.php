@include('dashboard.layouts.header')
@include('dashboard.layouts.navbar')
@include('dashboard.layouts.sidebar')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable Faktur Pembelian</h3>
                            <div class="float-right">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#addPurchase">
                                    Tambah
                                </button>
                            </div>
                        </div>
                        @include('dashboard.purchase.create')
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Date</th>
                                        <th>Supplier</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->number }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                                            <td>{{ $item->supplier->name }}</td>
                                            <td>{{ $item->ket }}</td>
                                            <td>
                                                @if ($item->status == 'Pending')
                                                    <button type="button" class="btn btn-sm btn-outline-warning"
                                                        readonly>Pending</button>
                                                @elseif($item->status == 'Success')
                                                    <button type="button" class="btn btn-sm btn-outline-success"
                                                        readonly>Success</button>
                                                @endif
                                            </td>
                                            <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                            <td>
                                                <div class="btn-group btn-flat btn-block">
                                                    @if ($item->status == 'Pending')
                                                        <button url="{{ route('purchase.status', $item->id) }}"
                                                            data-id="{{ $item->id }}" type="button"
                                                            class="btn btn-primary btn-sm status"><i
                                                                class="fas fa-check"></i></button>
                                                    @endif
                                                    <a href="{{ route('purchase.invoice', $item->id) }}"
                                                        target="_blank" type="button" class="btn btn-success btn-sm"><i
                                                            class="fas fa-file-invoice"></i></a>
                                                    <button url="{{ route('purchase.delete', $item->id) }}"
                                                        data-id="{{ $item->id }}" type="button"
                                                        class="btn btn-danger btn-sm delete"><i
                                                            class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.layouts.footer')
