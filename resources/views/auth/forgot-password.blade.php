<x-auth.layout>

@section('title','Forgot Password')

@section('content')

<x-auth.card>

    <div class="text-center mb-8">

        <h1 class="text-3xl font-bold text-slate-800">
            Forgot Password
        </h1>

        <p class="text-slate-500 mt-2">
            Enter your email address and we'll send you a reset link.
        </p>

    </div>

    @if (session('status'))

        <div class="mb-6 rounded-xl bg-green-100 text-green-700 p-4">

            {{ session('status') }}

        </div>

    @endif

    <form method="POST"
          action="{{ route('password.email') }}"
          class="space-y-6">

        @csrf

        <x-auth.input
            label="Email Address"
            name="email"
            type="email"
            :value="old('email')"
            required/>

        <x-auth.button>

            Email Password Reset Link

        </x-auth.button>

    </form>

    <div class="mt-8 text-center">

        <a href="{{ route('login') }}"
           class="text-sm text-blue-600 hover:text-blue-700">

            ← Back to Login

        </a>

    </div>

</x-auth.card>

</x-auth.layout>