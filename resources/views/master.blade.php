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
    <header>
        <nav class="navbar navbar-expand-lg bg-dark-subtle">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">Navbar</a>
                <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo03">
                    <ul class="navbar-nav mb-3 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('project.index') }}">Project</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Task</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <button class="btn btn-outline-success" type="submit">Avatar</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('body')
    </main>

    <script src="{{asset('/')}}assets/js/vendor/bootstrap.min.js"></script>
</body>
</html>
