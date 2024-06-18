<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem informasi sekolah berbasis web" />
    <meta name="keyword" content="thoyiburrohman, sekolah, sim, sistem informasi sekolah, web sekolah, website sekolah" />
    <meta name="author" content="thoyiburrohman" />
    <title>Warehouse | @yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo-bg.jpg') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    @stack('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/theme.min.css') }}">

</head>

<body>
    @if (session()->has('success'))
        <div id="flash" data-flash="{{ session('success') }}">
        </div>
    @endif
    @if (session()->has('error'))
        <div id="flashError" data-flash="{{ session('error') }}">
        </div>
    @endif
    @yield('content')
    <script src="{{ asset('vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('js/common-init.min.js') }}"></script>
    <script src="{{ asset('js/theme-customizer-init.min.js') }}"></script>
    @stack('scripts')
    <script>
        var flash = $('#flash').data('flash');
        if (flash) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: flash
            })
        };
        var flashError = $('#flashError').data('flash');
        if (flashError) {
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: flashError
            })
        };
    </script>
</body>

</html>
