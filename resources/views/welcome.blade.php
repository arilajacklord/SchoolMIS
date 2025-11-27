<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>School Management System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet" />

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #000;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        #mainNav {
            background: rgba(0, 0, 0, 0.7);
            padding: 1rem 0;
        }

        #mainNav .navbar-brand {
            color: #fff;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        #mainNav .nav-link {
            color: #ddd !important;
            font-weight: 600;
        }

        #mainNav .nav-link:hover {
            color: #fff !important;
        }

        /* Hero */
        header.masthead {
            position: relative;
            width: 100%;
            height: 100vh;
            background: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1950&q=80')
                center center / cover no-repeat;
        }
        header.masthead::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.65);
        }
        header .content {
            position: relative;
            z-index: 2;
        }
        .title {
            font-size: 3rem;
            font-weight: 800;
            color: #fff;
            text-transform: uppercase;
        }
        .subtitle {
            font-size: 1.2rem;
            color: #ccc;
            max-width: 600px;
            margin: 0 auto 30px auto;
        }
        .btn-main {
            background-color: #0d6efd;
            border-radius: 50px;
            padding: 12px 35px;
            font-size: 1.1rem;
        }

        /* Features section */
        #features {
            padding: 100px 0;
            background-color: #111;
        }
        #features h2 {
            color: #fff;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 40px;
        }
        .feature-box {
            background-color: #000;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            transition: transform .3s ease;
        }
        .feature-box:hover {
            transform: translateY(-8px);
        }
        .feature-box img {
            width: 100%;
            height: 230px;
            object-fit: cover;
        }
        .feature-box .content {
            padding: 20px;
        }
        .feature-box h4 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .feature-box p {
            color: #bbb;
            font-size: 0.95rem;
        }

        /* Contact section */
        #contact {
            padding: 80px 0;
            background-color: #0a0a0a;
            color: #fff;
        }
        #contact h2 {
            font-size: 2.3rem;
            font-weight: 700;
        }
        #contact p {
            font-size: 1.1rem;
            color: #ccc;
        }

        footer {
            background: #000;
            padding: 20px;
            color: #aaa;
            text-align: center;
        }
    </style>
</head>

<body id="page-top">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#page-top">School System</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" 
            data-bs-toggle="collapse" data-bs-target="#navbarResponsive">
            Menu
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#page-top">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<header class="masthead">
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="content text-center">
            <h1 class="title">School Management System</h1>
            <p class="subtitle">Manage enrollment, grades, invoices, tuition payments, and library activity — all in one place.</p>

            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="btn btn-main">Login</a>
            @endif
        </div>
    </div>
</header>

<!-- FEATURES -->
<section id="features">
    <div class="container text-center">
        <h2>System Features</h2>

        <div class="row g-4">

            <!-- Enrollment -->
            <div class="col-lg-3 col-md-6">
                <div class="feature-box">
                    <img src="https://images.unsplash.com/photo-1588072432836-e10032774350?q=80&w=1200" alt="Enrollment">
                    <div class="content">
                        <h4>Student Enrollment</h4>
                        <p>Register and manage student records quickly with a streamlined interface.</p>
                    </div>
                </div>
            </div>

            <!-- Grades -->
            <div class="col-lg-3 col-md-6">
                <div class="feature-box">
                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1200" alt="Grades">
                    <div class="content">
                        <h4>Grades & Assessments</h4>
                        <p>Update and track academic performance efficiently.</p>
                    </div>
                </div>
            </div>

            <!-- Library -->
            <div class="col-lg-3 col-md-6">
                <div class="feature-box">
                    <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?q=80&w=1200" alt="Library">
                    <div class="content">
                        <h4>Library Management</h4>
                        <p>Borrow, return, and track books with ease.</p>
                    </div>
                </div>
            </div>

         

            <!-- Invoice & Payments -->
            <div class="col-lg-3 col-md-6">
                <div class="feature-box">
                    <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=1200" alt="Invoices">
                    <div class="content">
                        <h4>Tuition Payments</h4>
                        <p>Manage tuition fees, payments with transparency.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- CONTACT SECTION -->
<section id="contact">
    <div class="container text-center">
        <h2>Contact Us</h2>
        <p>If you have questions regarding enrollment, fees, or system usage, feel free to contact us.</p>

        <h4 class="mt-3">📧 Email:</h4>
        <p><b>andrewdionson08@gmail.com</b></p>
    </div>
</section>

<!-- FOOTER -->
<footer>
    © {{ date('Y') }} School Management System — All Rights Reserved
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
