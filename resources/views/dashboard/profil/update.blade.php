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
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-default">
                        <div class="card-header text-center">
                            <h2><b>Update Password</b></h2>
                        </div>
                        <div class="card-body">
                            <p class="login-box-msg">Ensure your account is using a long, random password to stay
                                secure.</p>
                            <form action="{{ route('password.update') }}" method="post">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="password" id="update_password_current_password"
                                            name="current_password" class="form-control" autocomplete="current-password"
                                            placeholder="Enter your current password">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger" />
                                </div>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="password" id="update_password_password" name="password"
                                            class="form-control" placeholder="Enter your new password"
                                            autocomplete="new-password" />
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
                                </div>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="password" id="update_password_password_confirmation"
                                            name="password_confirmation" class="form-control"
                                            placeholder="Enter your password confirmation"
                                            autocomplete="new-password" />
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger" />
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-block">Change
                                            password</button>
                                    </div>
                                    <div class="col-12 text-center">
                                        @if (session('status') === 'password-updated')
                                            <p x-data="{ show: true }" x-show="show" x-transition
                                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                                {{ __('Saved') }}</p>
                                        @endif
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                        </div>
                        <!-- /.login-card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.layouts.footer')
