<x-guest-layout>
    <style>
        :root{
            --bg1: #0f172a;
            --bg2: #0ea5a4;
            --card: rgba(255,255,255,0.06);
            --accent: #06b6d4;
            --glass: rgba(255,255,255,0.03);
        }

        /* page background */
        body, html {
            height: 100%;
            margin: 0;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: radial-gradient(1200px 600px at 10% 10%, rgba(14,165,164,0.12), transparent),
                        radial-gradient(900px 500px at 90% 90%, rgba(99,102,241,0.08), transparent),
                        linear-gradient(180deg, var(--bg1) 0%, #071024 100%);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* center container */
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            box-sizing: border-box;
        }

        /* card */
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

        /* header */
        .auth-header {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1rem;
        }
        .auth-title {
            color: #e6eef2;
            font-weight: 600;
            font-size: 1.25rem;
            letter-spacing: -0.2px;
        }

        /* inputs */
        .auth-card label { color: #cbd5e1; font-size: .875rem; }
        .auth-input {
            width: 100%;
            padding: .65rem .75rem;
            margin-top: .35rem;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.06);
            background: linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.00));
            color: #e6eef2;
            transition: box-shadow .18s, border-color .18s, transform .18s;
            outline: none;
            box-sizing: border-box;
        }
        .auth-input:focus {
            box-shadow: 0 6px 18px rgba(6,182,212,0.12);
            border-color: var(--accent);
            transform: translateY(-2px);
        }

        /* checkbox */
        .remember-label { color: #9fb0bd; font-size: .9rem; }

        /* button */
        .auth-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: .62rem .95rem;
            background: linear-gradient(90deg, #06b6d4 0%, #3b82f6 100%);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            box-shadow: 0 8px 24px rgba(59,130,246,0.18);
            transition: transform .12s ease, box-shadow .12s ease, opacity .12s;
        }
        .auth-button:active { transform: translateY(1px) scale(.997); }
        .auth-button[disabled] { opacity: .6; cursor: not-allowed; }

        /* helper text */
        .status {
            color: #9ff3e7;
            background: rgba(6,182,212,0.06);
            padding: .5rem .75rem;
            border-radius: 8px;
            margin-bottom: .75rem;
            font-size: .9rem;
        }

        /* errors */
        .error-text { color: #ffb4b4; font-size: .875rem; margin-top: .35rem; }

        /* small responsive tweak */
        @media (max-width: 460px) {
            .auth-card { padding: 1.25rem; border-radius: 12px; }
        }

        /* simple appear animation */
        .fade-in { opacity: 0; transform: translateY(10px) scale(.995); animation: appear .6s cubic-bezier(.2,.9,.2,1) forwards; }
        @keyframes appear { to { opacity: 1; transform: translateY(0) scale(1); } }
    </style>

    <div class="auth-wrapper">
        <div class="auth-card fade-in">
            <div class="auth-header">
                <x-slot name="logo">
                    <x-authentication-card-logo />
                </x-slot>
                <div>
                    <div class="auth-title">Welcome back</div>
                    <div style="color:#9fb0bd; font-size:.85rem; margin-top:2px">Sign in to continue to SchoolMIS</div>
                </div>
            </div>

            <x-validation-errors class="mb-3 error-text" />

            @if (session('status'))
                <div class="status">
                    {{ session('status') }}
                </div>
            @endif

            <form id="authForm" method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="auth-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <div id="emailError" class="error-text" style="display:none"></div>
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <div style="position:relative">
                        <x-input id="password" class="auth-input" type="password" name="password" required autocomplete="current-password" />
                        <button type="button" id="togglePassword" aria-label="Toggle password" style="position:absolute; right:8px; top:8px; background:transparent; border:none; color:#9fb0bd; padding:.2rem .45rem; border-radius:6px; cursor:pointer; font-size:.85rem">Show</button>
                    </div>
                    <div id="passwordError" class="error-text" style="display:none"></div>
                </div>

                <div class="block mt-4" style="margin-top:1rem">
                    <label for="remember_me" class="flex items-center remember-label">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600" style="margin-left:.5rem">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4" style="display:flex; align-items:center; justify-content:space-between; margin-top:1.1rem">
                    <div>
                        @if (Route::has('password.request'))
                            <a class="underline text-sm" style="color:#9fb0bd; text-decoration:underline; font-size:.9rem" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <div>
                        <button id="submitBtn" class="auth-button" type="submit">
                            {{ __('Log in') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function(){
            // Elements
            const form = document.getElementById('authForm');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const toggle = document.getElementById('togglePassword');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            const submitBtn = document.getElementById('submitBtn');

            // Show / Hide password
            toggle.addEventListener('click', function(){
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                toggle.textContent = type === 'password' ? 'Show' : 'Hide';
            });

            // Simple client-side validation
            function validate() {
                let ok = true;
                emailError.style.display = 'none';
                passwordError.style.display = 'none';
                email.style.borderColor = '';
                password.style.borderColor = '';

                if (!email.value || !/^\S+@\S+\.\S+$/.test(email.value)) {
                    emailError.textContent = 'Please enter a valid email address.';
                    emailError.style.display = 'block';
                    email.style.borderColor = '#ffb4b4';
                    ok = false;
                }
                if (!password.value || password.value.length < 6) {
                    passwordError.textContent = 'Password must be at least 6 characters.';
                    passwordError.style.display = 'block';
                    password.style.borderColor = '#ffb4b4';
                    ok = false;
                }
                return ok;
            }

            form.addEventListener('submit', function(e){
                if (!validate()) {
                    e.preventDefault();
                    submitBtn.blur();
                    // subtle shake
                    const card = document.querySelector('.auth-card');
                    card.style.transition = 'transform .08s';
                    card.style.transform = 'translateX(-6px)';
                    setTimeout(()=> card.style.transform = 'translateX(6px)', 80);
                    setTimeout(()=> card.style.transform = 'translateX(0)', 160);
                } else {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Signing in...';
                }
            });

            // Accessibility: clear errors on input
            [email, password].forEach(el=>{
                el.addEventListener('input', ()=> {
                    el.style.borderColor = '';
                    if (el === email) emailError.style.display = 'none';
                    if (el === password) passwordError.style.display = 'none';
                });
            });
        })();
    </script>
</x-guest-layout>
