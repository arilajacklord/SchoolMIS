<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Registration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('registration.store') }}">
                    @csrf
 
            {{-- Student Information --}}
            <div class="mt-6 pt-4">
                <h3 class="font-semibold text-lg mb-2">Student Information</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>

                    <div>
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div>
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div>
                        <x-label for="course_level" value="Course Level" />
                        <x-input id="course_level" class="block mt-1 w-full" type="text" name="course_level" :value="old('course_level')" required />
                    </div>

                    <div>
                        <x-label for="student_address" value="Address" />
                        <x-input id="student_address" class="block mt-1 w-full" type="text" name="student_address" :value="old('student_address')" required />
                    </div>

                    <div>
                        <x-label for="student_phone" value="Phone" />
                        <x-input id="student_phone" class="block mt-1 w-full" type="text" name="student_phone" :value="old('student_phone')" required />
                    </div>

                    <div>
                        <x-label for="student_status" value="Status" />
                        <x-input id="student_status" class="block mt-1 w-full" type="text" name="student_status" :value="old('student_status')" required />
                    </div>

                    <div>
                        <x-label for="student_citizenship" value="Citizenship" />
                        <x-input id="student_citizenship" class="block mt-1 w-full" type="text" name="student_citizenship" :value="old('student_citizenship')" required />
                    </div>

                    <div>
                        <x-label for="student_birthdate" value="Birthdate" />
                        <x-input id="student_birthdate" class="block mt-1 w-full" type="date" name="student_birthdate" :value="old('student_birthdate')" required />
                    </div>

                    <div>
                        <x-label for="student_religion" value="Religion" />
                        <x-input id="student_religion" class="block mt-1 w-full" type="text" name="student_religion" :value="old('student_religion')" />
                    </div>

                    <div>
                        <x-label for="student_age" value="Age" />
                        <x-input id="student_age" class="block mt-1 w-full" type="number" min="0" name="student_age" :value="old('student_age')" />
                    </div>
                </div>
            </div>

            {{-- Father Information --}}
            <div class="mt-6 pt-4 border-t">
                <h3 class="font-semibold text-lg mb-2">Father Information</h3>

                <div class="grid grid-cols-3 gap-4">
                    <x-input placeholder="First Name" name="father_Fname" :value="old('father_Fname')" />
                    <x-input placeholder="Middle Name" name="father_Mname" :value="old('father_Mname')" />
                    <x-input placeholder="Last Name" name="father_Lname" :value="old('father_Lname')" />
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <x-label for="father_address" value="Address" />
                        <x-input id="father_address" class="block mt-1 w-full" type="text" name="father_address" :value="old('father_address')" />
                    </div>

                    <div>
                        <x-label for="father_cell_no" value="Cell No." />
                        <x-input id="father_cell_no" class="block mt-1 w-full" type="text" name="father_cell_no" :value="old('father_cell_no')" />
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mt-4">
                    <x-input placeholder="Age" type="number" min="0" name="father_age" :value="old('father_age')" />
                    <x-input placeholder="Religion" name="father_religion" :value="old('father_religion')" />
                    <x-input placeholder="Birthdate" type="date" name="father_birthdate" :value="old('father_birthdate')" />
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <x-input placeholder="Profession" name="father_profession" :value="old('father_profession')" />
                    <x-input placeholder="Occupation" name="father_occupation" :value="old('father_occupation')" />
                </div>
            </div>

            {{-- Mother Information --}}
            <div class="mt-6 pt-4 border-t">
                <h3 class="font-semibold text-lg mb-2">Mother Information</h3>

                <div class="grid grid-cols-3 gap-4">
                    <x-input placeholder="First Name" name="mother_Fname" :value="old('mother_Fname')" />
                    <x-input placeholder="Middle Name" name="mother_Mname" :value="old('mother_Mname')" />
                    <x-input placeholder="Last Name" name="mother_Lname" :value="old('mother_Lname')" />
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <x-label for="mother_address" value="Address" />
                        <x-input id="mother_address" class="block mt-1 w-full" type="text" name="mother_address" :value="old('mother_address')" />
                    </div>

                    <div>
                        <x-label for="mother_cell_no" value="Cell No." />
                        <x-input id="mother_cell_no" class="block mt-1 w-full" type="text" name="mother_cell_no" :value="old('mother_cell_no')" />
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mt-4">
                    <x-input placeholder="Age" type="number" min="0" name="mother_age" :value="old('mother_age')" />
                    <x-input placeholder="Religion" name="mother_religion" :value="old('mother_religion')" />
                    <x-input placeholder="Birthdate" type="date" name="mother_birthdate" :value="old('mother_birthdate')" />
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <x-input placeholder="Profession" name="mother_profession" :value="old('mother_profession')" />
                    <x-input placeholder="Occupation" name="mother_occupation" :value="old('mother_occupation')" />
                </div>
            </div>

            {{-- Terms and Policies --}}
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
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
            </div>
        </div>
    </div>
</x-app-layout>
                                  