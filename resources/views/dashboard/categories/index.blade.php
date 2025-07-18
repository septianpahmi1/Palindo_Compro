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
                            <h3 class="card-title">DataTable Categories</h3>
                            <div class="float-right">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#addCat">
                                    Tambah
                                </button>
                            </div>
                        </div>
                        @include('dashboard.categories.create')
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Cost</th>
                                        <th>Benefit</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>Rp {{ number_format($item->cost, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($item->benefit, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                            <td>
                                                <div class="btn-group btn-flat btn-block">
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#updateCat{{ $item->id }}">Edit</button>
                                                    <button url="{{ route('categories.delete', $item->id) }}"
                                                        data-id="{{ $item->id }}" type="button"
                                                        class="btn btn-danger btn-sm delete">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('dashboard.categories.update')
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
