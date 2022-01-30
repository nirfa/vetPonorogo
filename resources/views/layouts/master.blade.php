<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html"><img src="{{ URL::asset('assets/images/logo/logo.png') }}" alt="Logo"
                                    srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item @yield('dashboard')">
                            <a href="/admin" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item @yield('data-pasien')">
                            <a href="/data-pasien" class="sidebar-link">
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Data Pasien</span>
                            </a>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="bi bi-file-earmark-bar-graph-fill"></i>
                                <span>Stok Obat</span>
                            </a>
                            <ul class="submenu" style="display: block;">
                                <li class="submenu-item  @yield('stok-obat')">
                                    <a href="/stok-obat">Stok Obat</a>
                                </li>
                                <li class="submenu-item @yield('pemakaian-obat') ">
                                    <a href="/pemakaian-obat">Pemakaian Obat</a>
                                </li>
                                <li class="submenu-item @yield('tambahan-stok') ">
                                    <a href="/tambahan-stok">Tambahan Stok</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item @yield('keuangan')">
                            <a href="/keuangan" class="sidebar-link">
                                <i class="bi bi-cash"></i>
                                <span>Keuangan</span>
                            </a>
                        </li>
                        <li class="sidebar-item @yield('keuangan')">
                            <a href="/keuangan" class="sidebar-link">
                                <i class="bi bi-archive-fill"></i>
                                <span>Riwayat Download</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a class="sidebar-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                                <i class="bi bi-door-open-fill"></i>
                                <span>Logout</span>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        @yield('content')
    </div>

    @yield('script')
    <script src="{{ URL::asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ URL::asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ URL::asset('assets/js/mazer.js') }}"></script>
</body>

</html>
