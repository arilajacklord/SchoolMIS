<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<<<<<<< HEAD

    <title>School Management System</title>

    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: radial-gradient(circle at top left, #1b2735, #090a0f);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated background gradient */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(60deg, #004e92, #000428, #1b2735, #0f2027);
            background-size: 300% 300%;
            z-index: -1;
            animation: gradientMove 15s ease infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 20px;
            backdrop-filter: blur(12px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            padding: 50px 40px;
            text-align: center;
            max-width: 650px;
            width: 90%;
        }

        .logo img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .system-name {
            font-size: 2.2rem;
            font-weight: 600;
            color: #FFD700;
            letter-spacing: 0.5px;
        }

        .subtitle {
            font-size: 1rem;
            color: #ddd;
            margin-bottom: 25px;
        }

        .btn-login {
            background-color: #FFD700;
            border: none;
            color: #000;
            font-weight: 600;
            border-radius: 50px;
            padding: 12px 35px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #FFC300;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
        }

        footer {
            position: absolute;
            bottom: 15px;
            width: 100%;
            text-align: center;
            font-size: 0.9rem;
            color: #aaa;
        }

        @media (max-width: 576px) {
            .system-name {
                font-size: 1.8rem;
            }
            .card {
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="logo">
            {{-- Optional school logo --}}
            {{-- <img src="{{ asset('images/school-logo.png') }}" alt="School Logo"> --}}
        </div>

        <div class="system-name">School Management System</div>
        <div class="subtitle">Manage enrollment, grades, pay debt, and borrow books  — all in one place.</div>

        <div class="mt-4 d-flex justify-content-center gap-3">
    @if (Route::has('login'))
        <a href="{{ route('login') }}" class="btn btn-login btn-lg">Login</a>
    @endif

    @if (Route::has('register'))
        <a href="{{ route('register') }}" class="btn btn-login btn-lg" style="background-color: #1E90FF; color: #fff;">
            Register
        </a>
    @endif
</div>

    </div>

    <footer>
        © {{ date('Y') }} School Management System — All Rights Reserved
    </footer>

</body>
</html>
=======
    <title>{{ config('app.name', 'School MIS') }}</title>
    <style>
        :root{
            --bg:#f6f9fc;
            --accent:#2b6cb0;
            --muted:#6b7280;
            --card:#ffffff;
        }
        html,body{height:100%;margin:0;font-family:system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial;}
        body{background:linear-gradient(180deg, var(--bg), #fff); color:#111;}
        header{position:relative;padding:24px 32px;display:flex;align-items:center;justify-content:space-between;}
        .brand{display:flex;align-items:center;gap:12px;}
        .logo{
            width:48px;height:48px;background:var(--accent);display:inline-flex;align-items:center;justify-content:center;border-radius:8px;color:#fff;font-weight:700;font-size:20px;
            box-shadow:0 4px 14px rgba(43,108,176,0.16);
        }
        nav{display:flex;gap:12px;align-items:center;}
        a.btn{padding:8px 14px;border-radius:8px;text-decoration:none;font-weight:600;color:var(--accent);border:1px solid transparent;background:transparent;}
        a.btn.primary{background:var(--accent);color:#fff;border-color:transparent;box-shadow:0 6px 18px rgba(43,108,176,0.12);}
        .hero{max-width:1100px;margin:48px auto 24px;padding:36px;display:flex;gap:32px;align-items:center;}
        .hero-card{background:var(--card);padding:28px;border-radius:12px;box-shadow:0 10px 30px rgba(15,23,42,0.06);flex:1;}
        .hero-visual{flex:1;display:flex;align-items:center;justify-content:center;padding:12px;}
        h1{margin:0;font-size:32px;line-height:1.05;}
        p.lead{margin:12px 0 20px;color:var(--muted);max-width:48ch;}
        .features{display:flex;gap:12px;flex-wrap:wrap;margin-top:12px;}
        .feature{background:#f8fafc;padding:12px;border-radius:8px;font-size:14px;color:var(--muted);flex:1;min-width:150px;text-align:center}
        footer{max-width:1100px;margin:40px auto;padding:18px;color:var(--muted);text-align:center;font-size:14px;}
        @media (max-width:800px){
            .hero{flex-direction:column;padding:18px;margin:20px;}
            .hero-visual{order:-1}
            header{padding:16px}
        }
    </style>
</head>
<body>
    <header>
        <div class="brand">
            <div class="logo">{{ strtoupper(substr(config('app.name','SMIS'),0,2)) }}</div>
            <div>
                <div style="font-weight:700">{{ config('app.name', 'School MIS') }}</div>
                <div style="font-size:12px;color:var(--muted)">Student Information & Administration</div>
            </div>
        </div>

        <nav>
            @auth
                <a href="{{ url('/home') }}" class="btn">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn" style="background:transparent;border:1px solid #eee;padding:8px 12px;border-radius:8px;cursor:pointer;color:var(--muted)">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn primary">Register</a>
                @endif
            @endauth
        </nav>
    </header>

    <main class="hero" role="main">
        <section class="hero-card" aria-labelledby="welcome-title">
            <h1 id="welcome-title">Welcome to {{ config('app.name', 'School MIS') }}</h1>
            <p class="lead">A simple, secure and modern system to manage students, staff, classes, attendance and reports. Streamline school administration so teachers can focus on teaching.</p>

            <div class="features" aria-hidden="false">
                <div class="feature">Students & Admissions</div>
                <div class="feature">Attendance & Timetables</div>
                <div class="feature">Grades & Reports</div>
                <div class="feature">Parent / Staff Portal</div>
            </div>

            <div style="margin-top:20px;">
                @guest
                    <a href="{{ route('login') }}" class="btn" style="margin-right:8px">Sign in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn primary">Create an account</a>
                    @endif
                @else
                    <a href="{{ url('/home') }}" class="btn primary">Go to Dashboard</a>
                @endguest
            </div>
        </section>

        <aside class="hero-visual" aria-hidden="true">
            <!-- Simple illustrative card -->
            <div style="width:320px;max-width:90%;background:linear-gradient(180deg,#ffffff, #f3f9ff);border-radius:12px;padding:22px;box-shadow:0 12px 40px rgba(15,23,42,0.06);text-align:left;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
                    <div style="font-weight:700">Class 10A</div>
                    <div style="font-size:12px;color:var(--muted)">Mon • 09:00</div>
                </div>
                <div style="height:8px;background:#e6f0ff;border-radius:8px;margin-bottom:12px;overflow:hidden;">
                    <div style="width:72%;height:100%;background:var(--accent)"></div>
                </div>
                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <div style="background:#fff;border-radius:8px;padding:10px;flex:1;min-width:110px;box-shadow:0 6px 18px rgba(43,108,176,0.04);">
                        <div style="font-size:13px;font-weight:700">Attendance</div>
                        <div style="font-size:12px;color:var(--muted)">24 / 30</div>
                    </div>
                    <div style="background:#fff;border-radius:8px;padding:10px;flex:1;min-width:110px;box-shadow:0 6px 18px rgba(43,108,176,0.04);">
                        <div style="font-size:13px;font-weight:700">Average</div>
                        <div style="font-size:12px;color:var(--muted)">78%</div>
                    </div>
                </div>
            </div>
        </aside>
    </main>

    <footer>
        &copy; {{ date('Y') }} {{ config('app.name', 'School MIS') }} — Built for schools, academies & tutors.
    </footer>
</body>
</html>
>>>>>>> 35c82757d2b06863100201e89293378ebcad56cd
