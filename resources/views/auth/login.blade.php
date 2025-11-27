<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — School Management System</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1950&q=80')
                center center / cover no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
            position: relative;
            font-family: 'Poppins', sans-serif;
        }

        /* Dark overlay like your welcome page */
        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.65);
            z-index: 0;
        }

        .auth-card {
            z-index: 1;
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(14px);
            border-radius: 20px;
            padding: 45px 40px;
            color: white;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            animation: fadeInUp .7s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity:1; transform: translateY(0); }
        }

        .system-title {
            font-size: 1.8rem;
            font-weight: 600;
            text-align: center;
            color: #FFD700;
            margin-bottom: 25px;
        }

        label {
            font-weight: 500;
            color: #eee !important;
        }

        input[type="email"], input[type="password"] {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 8px;
        }

        input:focus {
            border-color: #FFD700 !important;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.4) !important;
        }

        .btn-login {
            background-color: #FFD700;
            border: none;
            color: #000;
            font-weight: 600;
            width: 100%;
            border-radius: 50px;
            padding: 10px 30px;
            margin-top: 20px;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #FFC300;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255,215,0,0.4);
        }

        .text-sm a {
            color: #FFD700;
            text-decoration: none;
        }

        .text-sm a:hover {
            text-decoration: underline;
        }

        .text-gray-600 {
            color: #ddd !important;
        }
    </style>
</head>

<body>

    <div class="auth-card">

        <div class="logo text-center">
            {{-- <img src="{{ asset('images/school-logo.png') }}" alt="School Logo"> --}}
        </div>

        <div class="system-title">School Management System</div>

        <x-validation-errors class="mb-3 text-danger" />

        @if (session('status'))
            <div class="mb-4 text-center text-success fw-bold">
                {{ session('status') }}
            </div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="Email" />
                <x-input id="email"
                         class="block mt-1 w-full"
                         type="email"
                         name="email"
                         :value="old('email')"
                         required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="password" value="Password" />
                <x-input id="password"
                         class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required />
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                @if (Route::has('password.request'))
                <div class="text-sm">
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                </div>
                @endif
            </div>

            <button type="submit" class="btn-login">
                Log in
            </button>

        </form>

    </div>

</body>
</html>



