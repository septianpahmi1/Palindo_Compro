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

            {{-- <div class="row">
                <div class="col-md-6">
                    <!-- Area Chart -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Consumers</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="areaChart"
                                    style="min-height:250px;height:250px;max-height:250px;width:100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Line Chart -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Total Benefit</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="lineChart"
                                    style="min-height:250px;height:250px;max-height:250px;width:100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        {{-- @include('dashboard.components.dashboard-js') --}}
        @include('dashboard.layouts.footer')
