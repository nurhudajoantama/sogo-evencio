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
                <a class="nav-link" href="/login">
                    <i class="bi bi-person-circle fs-2"></i>
                </a>
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