<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-guest-layout>
    <style>
        body {
            background: radial-gradient(circle at top left, #1b2735, #090a0f);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

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

        .auth-card {
            background: rgba(255, 255, 255, 0.08);
            border: none;
            border-radius: 20px;
            backdrop-filter: blur(12px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            padding: 45px 40px;
            width: 420px;
            color: white;
        }

        .auth-card .logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .system-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #FFD700;
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            color: #eee !important;
            font-weight: 500;
        }

        input[type="email"], input[type="password"] {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 8px;
        }

        input:focus {
            border-color: #FFD700 !important;
            box-shadow: 0 0 8px rgba(255, 215, 0, 0.4) !important;
        }

        .btn-login {
            background-color: #FFD700;
            border: none;
            color: #000;
            font-weight: 600;
            border-radius: 50px;
            padding: 10px 30px;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #FFC300;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
        }

        a {
            color: #FFD700;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .text-gray-600 {
            color: #ddd !important;
        }
          .auth-card {
            width: 100%;
            max-width: 420px;
            background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
            border: 1px solid rgba(255,255,255,0.04);
            border-radius: 14px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(2,6,23,0.6);
            backdrop-filter: blur(8px);
            transition: transform .45s cubic-bezier(.2,.8,.2,1), box-shadow .3s;
            transform: translateY(0);
        }
        .auth-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(2,6,23,0.7);
        }
    </style>

    <div class="auth-card">
        <div class="logo text-center">
            {{-- Optional logo image --}}
            {{-- <img src="{{ asset('images/school-logo.png') }}" alt="School Logo"> --}}
        </div>

        <div class="system-title">School Management System</div>
       

        <x-validation-errors class="mb-4 text-danger" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-400 text-center">
                {{ session('status') }}
            </div>
        @endif
          <form method="POST" action="{{ route('login') }}">
        @csrf
            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email"
                         class="block mt-1 w-full"
                         type="email"
                         name="email"
                         :value="old('email')"
                         required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password"
                         class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="current-password" />
            </div>

            @if (session('status'))
                <div class="status">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" class="btn btn-login ms-4">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
    
</body>
</html>