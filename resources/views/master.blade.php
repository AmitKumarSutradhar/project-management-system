<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('/')}}assets/css/vendor/bootstrap.min.css">
</head>
<body>
    <!-- Header Start -->
    @include('includes.header')
    <!-- Header End -->

    <main>
        @yield('body')
    </main>

    <script src="{{asset('/')}}assets/js/vendor/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
