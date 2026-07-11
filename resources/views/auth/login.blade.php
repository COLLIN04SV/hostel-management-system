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

        <i class="bi bi-building text-white text-3xl"></i>

    </div>

    <h1 class="text-3xl font-bold tracking-tight text-slate-800">

        Hostel Management

    </h1>

    <p class="mt-2 text-slate-500">

        Sign in to access your dashboard

    </p>

</div>

@if(session('status'))

<div class="mb-6 rounded-xl bg-green-50 border border-green-200 p-4 text-green-600">

    {{ session('status') }}

</div>

@endif

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
              action="{{ route('login') }}">

            @csrf

            <x-auth.input
                label="Email Address"
                name="email"
                type="email"
                :value="old('email')"
                placeholder="Enter your email"
                required
                autofocus />

            <div class="relative">

                <x-auth.input
                    id="password"
                    label="Password"
                    name="password"
                    type="password"
                    placeholder="Enter your password"
                    required />

                <button
                    type="button"
                    onclick="togglePassword()"
                    class="absolute right-4 top-[43px] text-slate-500 hover:text-blue-600">

                    <i
                        id="passwordIcon"
                        class="bi bi-eye"></i>

                </button>

            </div>

            <div class="flex items-center justify-between mb-8">

                <x-auth.checkbox
                    name="remember"
                    label="Remember me" />

                @if (Route::has('password.request'))

                    <x-auth.link
                        href="{{ route('password.request') }}">

                        Forgot Password?

                    </x-auth.link>

                @endif

            </div>

           <button

    id="loginButton"

    type="submit"

    class="w-full
           rounded-xl
           bg-gradient-to-r
           from-blue-600
           to-indigo-600
           py-3.5
           text-white
           font-semibold
           hover:shadow-xl
           transition">

    <span id="loginText">

        <i class="bi bi-box-arrow-in-right mr-2"></i>

        Login

    </span>

</button>

        </form>

        <div class="mt-10 pt-6 border-t border-slate-200">

    <p class="text-center text-sm text-slate-400">

        © {{ date('Y') }}

        Oliver Collins. All rights reserved.

    </p>

</div>

    </x-auth.card>

    <script>

        function togglePassword() {

            const input = document.getElementById('password');

            const icon = document.getElementById('passwordIcon');

            if(input.type === 'password'){

                input.type='text';

                icon.classList.remove('bi-eye');

                icon.classList.add('bi-eye-slash');

            }else{

                input.type='password';

                icon.classList.remove('bi-eye-slash');

                icon.classList.add('bi-eye');

            }

        }

    </script>

    <script>

     document.querySelector("form").addEventListener("submit",function(){

     document.getElementById("loginText").innerHTML=

     `<i class="bi bi-arrow-repeat animate-spin mr-2"></i>

     Signing in...`;

    });

    </script>

</x-auth.layout>