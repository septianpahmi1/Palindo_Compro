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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">

            {{-- @include('dashboard.components.filter') --}}
            <div id="metric-cards" class="row">
                <div class="col-lg-12 ">
                    <div class="callout callout-info">
                        <div class="row">
                            <div class="col-md-8">
                                <h5>Selamat datang <b>{{ Auth::user()->name }}</b>,</h5>
                                Kami senang menyambut Anda kembali di Dashboard. Di sini, Anda dapat mengelola data,
                                memantau aktivitas, dan menjelajahi berbagai fitur yang telah tersedia untuk Anda.
                                Semoga hari Anda produktif!
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Select date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="reservation">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <p>Daily Expenses</p>
                            <h3 id="metric-spending">Rp {{ number_format($spendingTotal, 0, ',', '.') }}</h3>
                        </div>
                        <div class="icon"><i class="fas fa-dollar-sign"></i></div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <p>Monthly Submission</p>
                            <h3 id="metric-submission">Rp {{ number_format($submissionTotal, 0, ',', '.') }}</h3>
                        </div>
                        <div class="icon"><i class="ion ion-stats-bars"></i></div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <p>Total Cost</p>
                            <h3 id="metric-cost">Rp {{ number_format($totalCost, 0, ',', '.') }}</h3>
                        </div>
                        <div class="icon"><i class="fas fa-chart-line"></i></div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <p>Total Benefit</p>
                            <h3 id="metric-benefit">Rp {{ number_format($totalBenefit, 0, ',', '.') }}</h3>
                        </div>
                        <div class="icon"><i class="fas fa-chart-pie"></i></div>
                    </div>
                </div>
            </div>

        </div>


        @include('dashboard.layouts.footer')
