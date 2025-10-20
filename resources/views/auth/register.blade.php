<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Basic Info --}}
            <div class="mt-6 pt-4">
                <h3 class="font-semibold text-lg mb-2">Register</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username" />
                    </div>

                    <div>
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                            required autocomplete="new-password" />
                    </div>

                    <div>
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    {{-- Role / Type --}}
                    <div class="col-span-2">
                        <x-label for="type" value="User Type" />

                        @if(request('type'))
                            {{-- If role is passed from modal, lock it --}}
                            <x-input id="type" type="hidden" name="type" value="{{ request('type') }}" />
                            <input type="text" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm bg-gray-100"
                                value="{{ ucfirst(request('type')) }}" disabled />
                        @else
                            {{-- Otherwise allow manual selection --}}
                            <select id="type" name="type"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="" selected disabled>-- Select User Type --</option>
                                <option value="admin" {{ old('type') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="teacher" {{ old('type') == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                                <option value="librarian" {{ old('type') == 'Librarian' ? 'selected' : '' }}>Librarian</option>
                                <option value="cashier" {{ old('type') == 'Cashier' ? 'selected' : '' }}>Cashier</option>
                                <option value="student" {{ old('type') == 'Student' ? 'selected' : '' }}>Student</option>
                            </select>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Terms --}}
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            {{-- Submit --}}
            <div class="flex items-center justify-end mt-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
