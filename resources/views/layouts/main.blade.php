<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SOGO EVENCIO</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
</head>

<body>

    <!-- Navbar -->
    <nav class="sticky-top navbar navbar-expand-lg bg-navbar">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="{{ asset('/assets/img/logo.png') }}" width="70" height="70"
                    alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-light" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ms-3">
                        <a class="nav-link active text-light" aria-current="page" href="/">Beranda</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="nav-link text-light" href="/#service">Layanan</a>
                    </li>
                    <li class="nav-item ms-3 ">
                        <a class="nav-link text-light" href="/contact">Kontak</a>
                    </li>
                </ul>
                @if (auth()->check())
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span>{{ auth()->user()->name }}</span>
                        <i class="bi bi-person-circle fs-2 mx-2"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/transactions">Transaksi</a></li>
                        @if (auth()->user()->is_admin)
                        <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                        @endif
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <a class="nav-link  d-flex align-items-center" href="/login">
                    <span class="me-2">Login</span>
                    <i class="bi bi-person-circle fs-2"></i>
                </a>
                @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <div class="container" style="margin-top: 70px;">
        <footer class="py-3 my-4">
            <p class="text-center text-muted">© {{ date('Y') }} SOGO Evencio</p>
        </footer>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>