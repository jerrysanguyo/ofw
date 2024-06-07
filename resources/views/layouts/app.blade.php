<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('image/IT-White.webp') }}" type="image/x-icon">
    <!-- <link rel="dns-prefetch" href="//fonts.bunny.net"> -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/chart-config.js') }}"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .navbar, #offcanvasNavbar {
            background-color: #ffffff; 
        }

        .btn.btn-primary {
            background-color: #727CF5;
            border-color: #727CF5;
        }

        body {
            background: url('{{ asset("image/bg.webp") }}') no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        
        /* mobile */
        @media (min-width: 375px) {
            .card-chart {
                height: 100%; 
            }
            .mx-5{
                margin-left: 0rem !important;
                margin-right: 0rem !important;
            }
            #offcanvasNavbar {
                width: 100%;
            }
        }

        /* tablet */
        @media (min-width: 768px) and (max-width: 991px) {
            .card-chart {
                height: 100%;
            }
            #offcanvasNavbar {
                width: 40%;
            }
        }

        /* web */
        @media (min-width: 992px) {
            .card-chart {
                height: 645px; 
            }
            .mx-5{
                margin-left:3rem !important;
                margin-right: 3rem !important;
            }
            #offcanvasNavbar {
                width: 16%;
            }
        }
    </style>
</head>
<body style="background-color:#eeeeee">
    <div id="app">
        <nav class="navbar fixed-top shadow-sm text-bg-white">
            <div class="container-fluid">
                @guest
                    @if (Route::has('login'))
                        <a href="/" class="navbar-brand">IT Inventory</a>
                    @endif
                @else
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    @if (Auth::user()->role === 'user')
                        <div class="d-flex justify-content-end">
                            <div class="dropdown navbar-brand">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->last_name . ', ' . Auth::user()->first_name . ' ' . Auth::user()->middle_name  }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="dropdown-item">Account details</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @else
                        <div class="d-flex justify-content-end">
                            <div class="dropdown navbar-brand">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->last_name }}, {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="dropdown-item">Account details</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{ asset('image/IT-white.webp') }}" alt="IT-Logo" class="img-fluid" style="width:100px">
                            <!-- <div class="fs-3 mt-2">IT Inventory</div> -->
                        </div>
                    </div>
                    <hr>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="side-nav-title mb-3">Navigation</li>
                            @if (Auth::user()->role === 'admin')
                                <li class="nav-item fs-7 {{ Request::is('admin.home') ? 'active' : '' }}">
                                    <a href="{{ route('admin.home') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Home
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.personal.create') ? 'active' : '' }}">
                                    <a href="{{ route('admin.personal.create') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Form
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.applicant.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.applicant.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> List of Applicant
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.report.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.report.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Report
                                    </a>
                                </li>
                                <li class="side-nav-title mb-3">CMS</li>
                                <li class="nav-item fs-7 {{ Request::is('admin.barangay.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.barangay.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Barangay
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.city.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.city.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> City
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.civil.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.civil.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Civil Status
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.continent.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.continent.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Continent
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.country.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.country.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Country
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.contract.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.contract.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Contract
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.education.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.education.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Educational Attainment
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.gender.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.gender.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Gender
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.identification.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.identification.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Identification
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.job.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.job.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Job
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.subjob.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.subjob.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Sub job
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.owwa.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.owwa.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Owwa
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.relation.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.relation.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Relationship
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.religion.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.religion.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Religion
                                    </a>
                                </li>
                                <li class="nav-item fs-7 {{ Request::is('admin.residence.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.residence.index') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-line mx-3"></i> Residence
                                    </a>
                                </li>
                                <hr>
                                @else
                                    <li class="nav-item fs-7 {{ Request::is('user.home') ? 'active' : '' }}">
                                        <a href="{{ route('user.home') }}" class="nav-link">
                                            <i class="fa-solid fa-chart-line mx-3"></i> Home
                                        </a>
                                    </li>
                                    <li class="nav-item fs-7 {{ Request::is('user.personal.create') ? 'active' : '' }}">
                                        <a href="{{ route('user.personal.create') }}" class="nav-link">
                                            <i class="fa-solid fa-chart-line mx-3"></i> Form
                                        </a>
                                    </li>
                            @endif
                        </ul>
                    </div>
                </div>
                @endguest
            </div>
        </nav>
        <main class="py-4 mx-5 mt-5">
            @yield('content')
        </main>
        <div class="sticky-bottom mt-5">
        <footer class="footer bg-white fixed-bottom z-n1">
            <div class="col-md-12 p-3">
                <span>&copy; {{ date('Y') }} City of Taguig. All Rights Reserved.</span>
            </div>
        </footer>
        </div>
    </div>
    @stack('scripts')
</body>
</html>