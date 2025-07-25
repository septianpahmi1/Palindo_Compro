@include('dashboard.layouts.header')
@include('dashboard.layouts.navbar')
@include('dashboard.layouts.sidebar')

<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Read Consultation</h3>

                            <div class="card-tools">
                                <a href="#" class="btn btn-tool" title="Previous"><i
                                        class="fas fa-chevron-left"></i></a>
                                <a href="#" class="btn btn-tool" title="Next"><i
                                        class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="mailbox-read-info">
                                <h5>{{ $data->subject }}</h5>
                                <h6 class="text-sm"><b>{{ $data->name }}</b> &lt;{{ $data->email }}&gt;
                                    <span
                                        class="mailbox-read-time float-right">{{ Carbon\Carbon::parse($data->created_at)->format('d F Y H:i A') }}</span>
                                </h6>
                            </div>
                            <div class="mailbox-read-message">

                                <p>{{ $data->message }}</p>
                            </div>
                            <!-- /.mailbox-read-message -->
                        </div>
                        <!-- /.card-footer -->
                        <div class="card-footer">
                            <button type="button" url="{{ route('consultation.destroy', $data->id) }}"
                                data-id="{{ $data->id }}" class="btn btn-default delete"><i
                                    class="far fa-trash-alt"></i>
                                Delete</button>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.layouts.footer')
