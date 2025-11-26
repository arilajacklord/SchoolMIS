<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
