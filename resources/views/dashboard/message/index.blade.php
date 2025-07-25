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
                            <h3 class="card-title">Inbox</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" class="form-control float-right" placeholder="Search"
                                        id="search-input">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default" id="search-btn">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form id="delete-form" method="POST">
                            @csrf
                            <div class="card-body p-0">
                                <div class="mailbox-controls">
                                    <button type="button" class="btn btn-default btn-sm checkbox-toggle mr-2">
                                        <i class="far fa-square"></i>
                                    </button>

                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-default btn-sm mr-2 delete"
                                            id="delete-selected" disabled>
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>

                                    <button type="button" class="btn btn-default btn-sm" onclick="location.reload();">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>

                                    <div class="float-right">
                                        <div class="btn-group">
                                            {{ $data->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-0" id="mailbox-content">
                                    @include('dashboard.message.table', ['data' => $data])
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.layouts.footer')
