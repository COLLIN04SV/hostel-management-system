<x-auth.layout>

    <x-auth.card>

        <div class="text-center mb-10">

            <div class="inline-flex items-center justify-center
                        w-16 h-16
                        rounded-2xl
                        bg-gradient-to-br
                        from-blue-600
                        to-indigo-600
                        shadow-lg
                        mb-5">

                <i class="bi bi-person-plus-fill text-white text-3xl"></i>

            </div>

            <h1 class="text-3xl font-bold text-slate-800">

                Create Account

            </h1>

            <p class="mt-2 text-slate-500">

                Register a new student account

            </p>

        </div>

        @if ($errors->any())

        <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4">

            <div class="flex">

                <i class="bi bi-exclamation-circle-fill text-red-500 mr-3"></i>

                <div>

                    @foreach($errors->all() as $error)

                        <p class="text-red-600 text-sm">

                            {{ $error }}

                        </p>

                    @endforeach

                </div>

            </div>

        </div>

        @endif

        <form method="POST"
              action="{{ route('register') }}">

            @csrf

            <div class="grid md:grid-cols-2 gap-5">

                <x-auth.input
                    label="Full Name"
                    name="name"
                    :value="old('name')"
                    placeholder="Enter full name"
                    required />

                <x-auth.input
                    label="Registration Number"
                    name="registration_number"
                    :value="old('registration_number')"
                    placeholder="e.g CST001"
                    required />

                <x-auth.input
                    label="Email Address"
                    name="email"
                    type="email"
                    :value="old('email')"
                    placeholder="example@email.com"
                    required />

                <x-auth.input
                    label="Phone Number"
                    name="phone"
                    :value="old('phone')"
                    placeholder="+254..." />

                <x-auth.input
                    label="Department"
                    name="department"
                    :value="old('department')"
                    placeholder="Computer Science" />

                <div>

                    <label class="block mb-2 text-sm font-medium text-slate-700">

                        Year of Study

                    </label>

                    <select
                        name="year_of_study"
                        class="w-full rounded-xl border border-slate-300
                               bg-white/70 backdrop-blur
                               px-4 py-3
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-200">

                        <option value="1">Year 1</option>
                        <option value="2">Year 2</option>
                        <option value="3">Year 3</option>
                        <option value="4">Year 4</option>

                    </select>

                </div>

                <x-auth.input
                    id="password"
                    label="Password"
                    name="password"
                    type="password"
                    placeholder="Create password"
                    required />

                <x-auth.input
                    id="password_confirmation"
                    label="Confirm Password"
                    name="password_confirmation"
                    type="password"
                    placeholder="Repeat password"
                    required />

            </div>

            <div class="flex items-center justify-between mt-8">

                <x-auth.link
                    href="{{ route('login') }}">

                    Already have an account?

                </x-auth.link>

                <button
                    type="submit"
                    class="rounded-xl
                           bg-gradient-to-r
                           from-blue-600
                           to-indigo-600
                           px-8 py-3
                           font-semibold
                           text-white
                           shadow-lg
                           transition
                           hover:shadow-xl">

                    <i class="bi bi-person-check-fill mr-2"></i>

                    Register

                </button>

            </div>

        </form>

        <div class="mt-10 pt-6 border-t border-slate-200">

            <p class="text-center text-sm text-slate-400">

                © {{ date('Y') }} Oliver Collins. All rights reserved.

            </p>

        </div>

    </x-auth.card>

</x-auth.layout>