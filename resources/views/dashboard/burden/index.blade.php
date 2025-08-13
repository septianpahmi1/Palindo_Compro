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
                            <h3 class="card-title">DataTable Load Record</h3>
                            <div class="float-right">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#addBurden">
                                    Tambah
                                </button>
                            </div>
                        </div>
                        @include('dashboard.burden.create')
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Estimated Account</th>
                                        <th>Date</th>
                                        <th>Date Expired</th>
                                        <th>Total</th>
                                        <th>ٍStatus</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->number }}</td>
                                            <td>{{ $item->estimation->title }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->date_expired)->format('d/m/Y') }}</td>
                                            <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                            <td>
                                                @if ($item->status == 'Pending')
                                                    <button type="button" class="btn btn-sm btn-outline-warning"
                                                        readonly>Pending</button>
                                                @elseif($item->status == 'Success')
                                                    <button type="button" class="btn btn-sm btn-outline-success"
                                                        readonly>Success</button>
                                                @endif
                                            </td>
                                            <td>{{ Str::limit($item->description, 25) }}</td>
                                            <td>
                                                <div class="btn-group btn-block">
                                                    @if ($item->status == 'Pending')
                                                        <button url="{{ route('burden.status', $item->id) }}"
                                                            data-id="{{ $item->id }}" type="button"
                                                            class="btn btn-primary btn-sm status"><i
                                                                class="fas fa-check"></i></button>
                                                    @endif
                                                    <button url="{{ route('burden.delete', $item->id) }}"
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
