<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{asset('/')}}assets/css/vendor/bootstrap.min.css">
    </head>
    <body>
        <header>
            <div class="container">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand" href="#">Navbar</a>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo03">
                            <ul class="navbar-nav float-end mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                                </li>
                                <li class="nav-item">
{{--                                    <a class="nav-link" href="{{ route('admin.project.index') }}">Projects</a>--}}
                                </li>
                                <li class="nav-item">
{{--                                    <a class="nav-link" href="{{ route('admin.task.index') }}">Tasks</a>--}}
                                </li>
                            </ul>
                            <div class="d-flex">
                                <img src="{{ asset('/') }}assets/img/avatar/images.jpg" class="img-thumbnail rounded-5" alt="Avatar" style="width: 40px; height: 40px;">
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <main>
            @yield('body')
        </main>

        <script src="{{asset('/')}}assets/js/vendor/bootstrap.min.js"></script>
    </body>
</html>
