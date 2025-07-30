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
                            <h3 class="card-title">DataTable Daily Expenses</h3>
                            <div class="float-right">
                                @if (Auth::user()->role == 'admin')
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#addExpenses">
                                        Tambah
                                    </button>
                                @endif
                            </div>
                        </div>
                        @include('dashboard.expenses.create')
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Invoice/ Nota</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Status Pembayaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="/file/invoice/{{ $item->spending->image }}" height="50px"
                                                    width="50px" style="object-fit: cover" alt=""
                                                    data-toggle="modal" data-target="#imageDetail">
                                            </td>

                                            @include('dashboard.expenses.detail')
                                            <td>{{ $item->spending->user->name }}</td>
                                            <td>{{ $item->spending->title }}</td>
                                            <td>{{ $item->spending->quantity }}</td>
                                            <td>Rp {{ number_format($item->spending->price, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($item->spending->total, 0, ',', '.') }}</td>
                                            <td>
                                                @if ($item->spending->status == 'Belum Dibayarkan')
                                                    <button type="button" class="btn btn-sm btn-outline-warning"
                                                        readonly>Not Paid</button>
                                                @elseif($item->spending->status == 'Dibayarkan')
                                                    <button type="button" class="btn btn-sm btn-outline-success"
                                                        readonly>Paid</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status == 'Belum Dibayar')
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        readonly>Not Paid</button>
                                                @elseif($item->status == 'Dibayar')
                                                    <button type="button" class="btn btn-sm btn-outline-success"
                                                        readonly>Paid</button>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-flat btn-block">
                                                    @if ($item->status == 'Belum Dibayar')
                                                        @if (Auth::user()->role == 'super admin')
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#action{{ $item->id }}">Action</button>
                                                        @endif
                                                        @if (Auth::user()->role == 'admin')
                                                            <button url="{{ route('expense.delete', $item->id) }}"
                                                                data-id="{{ $item->id }}" type="button"
                                                                class="btn btn-danger btn-sm delete">Delete</button>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @include('dashboard.expenses.action')
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
