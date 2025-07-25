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
                            <h3 class="card-title">DataTable Monthly Submission</h3>
                            @if (Auth::user()->role == 'admin')
                                <div class="float-right">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#addSubmission">
                                        Tambah
                                    </button>
                                </div>
                            @endif
                        </div>
                        @include('dashboard.submission.create')
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>Importance</th>
                                        <th>Status</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="/file/submission/{{ $item->submission->image }}"
                                                    height="50px" width="50px" style="object-fit: cover"
                                                    alt="" data-toggle="modal"
                                                    data-target="#imageDetail{{ $item->id }}">
                                            </td>

                                            @include('dashboard.submission.image')
                                            <td>{{ $item->submission->user->name }}</td>
                                            <td>{{ $item->submission->title }}</td>
                                            <td>{{ $item->submission->quantity }}</td>
                                            <td>Rp {{ number_format($item->submission->price, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($item->submission->total, 0, ',', '.') }}</td>
                                            <td>
                                                @if ($item->submission->importance == 'Not Important')
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                        readonly>Low</button>
                                                @elseif($item->submission->importance == 'Important')
                                                    <button type="button" class="btn btn-sm btn-outline-warning"
                                                        readonly>Medium</button>
                                                @elseif($item->submission->importance == 'Very Important')
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        readonly>Hight</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status == 'Pending')
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                        readonly>Pending</button>
                                                @elseif($item->status == 'Approved')
                                                    <button type="button" class="btn btn-sm btn-outline-success"
                                                        readonly>Approved</button>
                                                @elseif($item->status == 'Disapproved')
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        readonly>Disapproved</button>
                                                @endif
                                            </td>
                                            <td>
                                                <p data-toggle="modal" data-target="#descDetail{{ $item->id }}">
                                                    {{ Str::limit($item->submission->description, 15) }}</p>
                                            </td>
                                            @include('dashboard.submission.description')
                                            </td>
                                            <td>
                                                <div class="btn-group btn-flat btn-block">
                                                    @if (Auth::user()->role == 'super admin')
                                                        @if ($item->status == 'Pending')
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#submission{{ $item->id }}">Action</button>
                                                        @endif
                                                    @endif
                                                    @if (Auth::user()->role == 'admin')
                                                        <button url="{{ route('submission.delete', $item->id) }}"
                                                            data-id="{{ $item->id }}" type="button"
                                                            class="btn btn-danger btn-sm delete">Delete</button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @include('dashboard.submission.action')
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
