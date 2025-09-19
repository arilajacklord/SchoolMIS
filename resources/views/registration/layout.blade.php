<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>

<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-600" />
            </a>
        </x-slot>

        {{-- Intro Message --}}
        <div class="mb-6 text-sm text-gray-700">
            {{ __('Thank you for signing up! Please verify your email address by clicking the link we sent to your inbox. If you didn’t receive the email, you can request a new one below.') }}
        </div>

        {{-- Success message when link is re-sent --}}
        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 p-3 rounded-lg bg-green-100 text-green-700 text-sm font-medium">
                {{ __('A new verification link has been sent to your email address.') }}
            </div>
        @endif

        {{-- Action buttons --}}
        <div class="mt-6 flex items-center justify-between">
            {{-- Resend Verification --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-button>
                    {{ __('Resend Email') }}
                </x-button>
            </form>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                    class="text-sm font-medium text-gray-600 hover:text-gray-900 underline">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>

