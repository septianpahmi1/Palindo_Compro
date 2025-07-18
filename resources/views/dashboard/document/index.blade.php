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
                            <h3 class="card-title">DataTable Document</h3>
                            <div class="float-right">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#addDoc">
                                    Tambah
                                </button>
                            </div>
                        </div>
                        @include('dashboard.document.create')
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Registration ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Citizenship</th>
                                        <th>Document Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->document->registration_id }}</td>
                                            <td>{{ $item->document->name }}</td>
                                            <td>{{ $item->document->phone }}</td>
                                            <td>{{ optional($item->document)->email ?? '-' }}</td>
                                            <td>{{ $item->document->address }}</td>
                                            <td>{{ $item->document->nation }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <div class="btn-group btn-flat btn-block">
                                                    @if ($item->status !== 'Completed')
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#action{{ $item->id }}">Action</button>
                                                    @endif
                                                    <a href="{{ url('/document', $item->id) }}" target="_blank"
                                                        type="button" class="btn btn-success btn-sm">Invoice</a>
                                                    <button url="{{ route('documents.delete', $item->id) }}"
                                                        data-id="{{ $item->id }}" type="button"
                                                        class="btn btn-danger btn-sm delete">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('dashboard.document.action')
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
