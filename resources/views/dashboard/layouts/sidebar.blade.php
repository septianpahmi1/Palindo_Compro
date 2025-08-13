<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/logo_palindo.png" alt="Alharamain Logo" class="brand-image " style="opacity: .8">
        <span class="brand-text font-weight-bold">AlharamainApp</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                </li>
                @if (Auth::user()->role == 'super admin')
                    <li class="nav-header">MASTER DATA</li>
                    <li class="nav-item">
                        <a href="{{ route('categories') }}"
                            class="nav-link {{ request()->routeIs('categories') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-list"></i>
                            <p>Categories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('estimation') }}"
                            class="nav-link {{ request()->routeIs('estimation') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>Akun Perkiraan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee') }}"
                            class="nav-link {{ request()->routeIs('employee') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data Karyawan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customer') }}"
                            class="nav-link {{ request()->routeIs('customer') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>Data Customer</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('supplier') }}"
                            class="nav-link {{ request()->routeIs('supplier') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-id-badge"></i>
                            <p>Data Supplier</p>
                        </a>
                    </li>
                @endif
                <li class="nav-header">PROJECT</li>
                <li class="nav-item">
                    <a href="{{ route('documents') }}"
                        class="nav-link {{ request()->routeIs('documents') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Projects
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                </li>
                @if (Auth::user()->role == 'super admin')
                    <li class="nav-header">KEUANGAN</li>
                    <li class="nav-item">
                        <a href="{{ route('payment') }}"
                            class="nav-link {{ request()->routeIs('payment') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-money-check"></i>
                            <p>
                                Pembayaran
                                <!-- <i class="right fas fa-angle-left"></i> -->
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('receipt') }}"
                            class="nav-link {{ request()->routeIs('receipt') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p>
                                Penerimaan
                                <!-- <i class="right fas fa-angle-left"></i> -->
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('burden') }}"
                            class="nav-link {{ request()->routeIs('burden') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-money-bill-wave"></i>
                            <p>
                                Pencatatan Beban
                                <!-- <i class="right fas fa-angle-left"></i> -->
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('salary') }}"
                            class="nav-link {{ request()->routeIs('salary') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-invoice-dollar"></i>
                            <p>
                                Pencatatan Gajih
                                <!-- <i class="right fas fa-angle-left"></i> -->
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('journal') }}"
                            class="nav-link {{ request()->routeIs('journal') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Jurnal Umum
                                <!-- <i class="right fas fa-angle-left"></i> -->
                            </p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs(['sales-invoice', 'purchase']) ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ request()->routeIs(['sales-invoice', 'purchase']) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>
                                Faktur
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('sales-invoice') }}"
                                    class="nav-link {{ request()->routeIs('sales-invoice') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Penjualan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('purchase') }}"
                                    class="nav-link {{ request()->routeIs('purchase') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pembelian</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="nav-header">PENGELUARAN</li>
                <li class="nav-item">
                    <a href="{{ route('expense') }}"
                        class="nav-link {{ request()->routeIs('expense') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Daily Expenses
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('submission') }}"
                        class="nav-link {{ request()->routeIs('submission') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-week"></i>
                        <p>
                            Monthly Submission
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="nav-header">MESSAGE</li>
                    <li class="nav-item">
                        <a href="{{ route('consultation') }}"
                            class="nav-link {{ request()->routeIs('consultation') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-headset"></i>
                            <p>
                                Consultation
                                <!-- <i class="right fas fa-angle-left"></i> -->
                            </p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role == 'super admin')
                    <li class="nav-header">REPORT</li>
                    <li
                        class="nav-item {{ request()->routeIs(['profit-loss', 'general-journal', 'salesReport', 'purchaseReport']) ? ' menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ request()->routeIs(['profit-loss', 'general-journal', 'salesReport', 'purchaseReport']) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Monthly Report
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('profit-loss') }}"
                                    class="nav-link {{ request()->routeIs('profit-loss') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Laba Rugi(Standar)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('general-journal') }}"
                                    class="nav-link {{ request()->routeIs('general-journal') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jurnal Umum</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('salesReport') }}"
                                    class="nav-link {{ request()->routeIs('salesReport') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Laporan Penjualan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('purchaseReport') }}"
                                    class="nav-link {{ request()->routeIs('purchaseReport') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Laporan Pembelian</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                {{-- <li class="nav-item">
                    <a href="{{ route('task') }}" class="nav-link {{ request()->routeIs('task') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            Task
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                </li> --}}

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
