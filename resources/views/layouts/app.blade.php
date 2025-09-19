<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon" />

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- ========== All CSS files linkup ========= -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    </head>
    <body>
        <!-- ======== Preloader =========== -->
        <div id="preloader">
            <div class="spinner"></div>
        </div>
        <!-- ======== Preloader =========== -->

        <!-- ======== sidebar-nav start =========== -->
        <aside class="sidebar-nav-wrapper">
            <div class="navbar-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="logo" />
                </a>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li class="nav-item nav-item-has-children">
                        <a
                            href="#0"
                            data-bs-toggle="collapse"
                            data-bs-target="#ddmenu_1"
                            aria-controls="ddmenu_1"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                        >
                            <span class="icon">
                                <!-- SVG omitted for brevity -->
                            </span>
                            <span class="text">Dashboard</span>
                        </a>
                        <ul id="ddmenu_1" class="collapse show dropdown-nav">
                            <li>
                                <a href="{{ url('/') }}" class="active"> Feature </a>
                            </li>
                        </ul>
                    </li>

                    <span class="divider"><hr /></span>

                    <li class="nav-item nav-item-has-children">
                        <a
                            href="#0"
                            class="collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#ddmenu_2"
                            aria-controls="ddmenu_2"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                        >
                            <span class="icon">
                                <!-- SVG omitted for brevity -->
                            </span>
                            <span class="text">Enrollment</span>
                        </a>
                        <ul id="ddmenu_2" class="collapse dropdown-nav">
                            <li>
                                <a href="#"> Sample Page </a>
                            </li>
                            <li>
                                <a href="#"> Sample Page </a>
                            </li>
                        </ul>
                    </li>

                    <span class="divider"><hr /></span>

                    <!-- Repeat for other menu items, but use unique data-bs-target and id for each dropdown -->
                    <li class="nav-item nav-item-has-children">
                        <a
                            href="#0"
                            class="collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#ddmenu_3"
                            aria-controls="ddmenu_3"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                        >
                            <span class="icon">
                                <!-- SVG omitted for brevity -->
                            </span>
                            <span class="text">GradeManagement</span>
                        </a>
                        <ul id="ddmenu_3" class="collapse dropdown-nav">
                            <li>
                                <a href="#"> Sample Page </a>
                            </li>
                            <li>
                                <a href="#"> Sample Page </a>
                            </li>
                        </ul>
                    </li>

                    <span class="divider"><hr /></span>

                    <li class="nav-item nav-item-has-children">
                        <a
                            href="#0"
                            class="collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#ddmenu_4"
                            aria-controls="ddmenu_4"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                        >
                            <span class="icon">
                                <!-- SVG omitted for brevity -->
                            </span>
                            <span class="text">BillingManagement</span>
                        </a>
                        <ul id="ddmenu_4" class="collapse dropdown-nav">
                            <li>
                                <a href="#"> Sample Page </a>
                            </li>
                            <li>
                                <a href="#"> Sample Page </a>
                            </li>
                        </ul>
                    </li>

                    <span class="divider"><hr /></span>

                    <li class="nav-item nav-item-has-children">
                        <a
                            href="#0"
                            class="collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#ddmenu_5"
                            aria-controls="ddmenu_5"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                        >
                            <span class="icon">
                                <!-- SVG omitted for brevity -->
                            </span>
                            <span class="text">LibraryManagement</span>
                        </a>
                        <ul id="ddmenu_5" class="collapse dropdown-nav">
                            <li>
                                <a href="#"> Sample Page</a>
                            </li>
                            <li>
                                <a href="#"> Sample Page </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="promo-box">
                <div class="promo-icon">
                    <img class="mx-auto" src="{{ asset('assets/images/logo/logo-icon-big.svg') }}" alt="Logo">
                </div>
                <h3>Upgrade to PRO</h3>
                <p>Improve your development process and start doing more with PlainAdmin PRO!</p>
                <a href="https://plainadmin.com/pro" target="_blank" rel="nofollow" class="main-btn primary-btn btn-hover">
                    Upgrade to PRO
                </a>
            </div>
        </aside>
        <div class="overlay"></div>
        <!-- ======== sidebar-nav end =========== -->

        <!-- ======== main-wrapper start =========== -->
        <main class="main-wrapper">
            <!-- ========== header start ========== -->
            <header class="header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-6">
                            <div class="header-left d-flex align-items-center">
                                <div class="menu-toggle-btn mr-15">
                                    <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                                        <i class="lni lni-chevron-left me-2"></i> Menu
                                    </button>
                                </div>
                                <div class="header-search d-none d-md-flex">
                                    <form action="#">
                                        <input type="text" placeholder="Search..." />
                                        <button><i class="lni lni-search-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-6">
                            <div class="header-right">
                                <!-- notification start -->
                                <!-- ... notification/message/profile code unchanged ... -->
                                <!-- profile start -->
                                <div class="profile-box ml-15">
                                    <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="profile-info">
                                            <div class="info">
                                                <div class="image">
                                                    <img src="{{ asset('assets/images/profile/profile-image.png') }}" alt="" />
                                                </div>
                                                <div>
                                                    <h6 class="fw-500">Adam Joe</h6>
                                                    <p>Admin</p>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                        <li>
                                            <div class="author-info flex items-center !p-1">
                                                <div class="image">
                                                    <img src="{{ asset('assets/images/profile/profile-image.png') }}" alt="image">
                                                </div>
                                                <div class="content">
                                                    <h4 class="text-sm">Adam Joe</h4>
                                                    <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs" href="#">Email@gmail.com</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#0">
                                                <i class="lni lni-user"></i> View Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#0">
                                                <i class="lni lni-alarm"></i> Notifications
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#0"> <i class="lni lni-inbox"></i> Messages </a>
                                        </li>
                                        <li>
                                            <a href="#0"> <i class="lni lni-cog"></i> Settings </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item">
                                                    <i class="lni lni-exit"></i> Sign Out
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <!-- profile end -->
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- ========== header end ========== -->

            <!-- ========== section start ========== -->
            <section class="section">
                <div class="container-fluid">
                    <!-- ========== title-wrapper start ========== -->
                    <!-- ... dashboard content unchanged ... -->
                    <!-- You can replace the dashboard content with @yield('content') if you want to use Blade sections -->
                </div>
                <!-- end container -->
            </section>
            <!-- ========== section end ========== -->

            <!-- ========== footer start =========== -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 order-last order-md-first">
                            <div class="copyright text-center text-md-start">
                                <p class="text-sm">
                                    Designed and Developed by
                                    <a href="https://plainadmin.com" rel="nofollow" target="_blank">
                                        PlainAdmin
                                    </a>
                                </p>
                            </div>
                        </div>
                        <!-- end col-->
                        <div class="col-md-6">
                            <div class="terms d-flex justify-content-center justify-content-md-end">
                                <a href="#0" class="text-sm">Term & Conditions</a>
                                <a href="#0" class="text-sm ml-15">Privacy & Policy</a>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </footer>
            <!-- ========== footer end =========== -->
        </main>
        <!-- ======== main-wrapper end =========== -->

        <!-- ========= All Javascript files linkup ======== -->
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/Chart.min.js') }}"></script>
        <script src="{{ asset('assets/js/dynamic-pie-chart.js') }}"></script>
        <script src="{{ asset('assets/js/moment.min.js') }}"></script>
        <script src="{{ asset('assets/js/fullcalendar.js') }}"></script>
        <script src="{{ asset('assets/js/jvectormap.min.js') }}"></script>
        <script src="{{ asset('assets/js/world-merc.js') }}"></script>
        <script src="{{ asset('assets/js/polyfill.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <!-- ... inline JS unchanged ... -->
    </body>
</html>
