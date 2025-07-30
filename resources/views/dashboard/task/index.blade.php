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
                            <div class="row align-items-center">
                                <!-- Judul -->
                                <div class="col-lg-9 col-md-6 mb-2 mb-lg-0">
                                    <h3 class="card-title">DataTable Monthly Task</h3>
                                </div>

                                <div class="col-lg-2 col-md-3 mb-2 mb-lg-0">
                                    <input type="month" class="form-control" id="searchByMonth" />
                                </div>
                                @if (Auth::user()->role == 'admin')
                                    <div class="col-lg-1 col-md-12 text-lg-right">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#addTask">
                                            Tambah
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @include('dashboard.task.create')
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Start at</th>
                                        <th>End at</th>
                                        <th>Status</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('dashboard.task.tabel', ['data' => $data])
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
