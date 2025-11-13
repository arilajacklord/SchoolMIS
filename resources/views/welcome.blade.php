<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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