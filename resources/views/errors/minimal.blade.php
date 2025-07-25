<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <!-- Custom fonts for this template-->
    <link href="auth/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="icon" href="{{ asset('dist/img/logo.png') }}" type="image/x-icon" />
    <!-- Custom styles for this template-->
    <link href="auth/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="text-center">
            <!-- 404 Error Text -->
            <div class="error mx-auto" data-text="404" style="font-size: 100px; font-weight: bold;">@yield('code')
            </div>
            <p class="lead text-gray-800 mb-3">@yield('message')</p>
            <p class="text-muted mb-4">It looks like you found a glitch in the matrix...</p>
            <a href="/" class="btn btn-primary">&larr; Back to Home</a>
        </div>
    </div>



    <script src="auth/vendor/jquery/jquery.min.js"></script>
    <script src="auth/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="auth/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="auth/js/sb-admin-2.min.js"></script>
</body>

</html>
