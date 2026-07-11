<x-auth.layout>

@section('title','Reset Password')

@section('content')

<x-auth.card>

    <div class="text-center mb-8">

        <h1 class="text-3xl font-bold text-slate-800">

            Reset Password

        </h1>

        <p class="text-slate-500 mt-2">

            Create a new secure password.

        </p>

    </div>

    <form method="POST"
          action="{{ route('password.store') }}"
          class="space-y-6">

        @csrf

        <input type="hidden"
               name="token"
               value="{{ $request->route('token') }}">

        <x-auth.input
            label="Email"
            name="email"
            type="email"
            :value="old('email',$request->email)"
            required/>

        <x-auth.input
            label="New Password"
            name="password"
            type="password"
            required/>

        <x-auth.input
            label="Confirm Password"
            name="password_confirmation"
            type="password"
            required/>

        <x-auth.button>

            Reset Password

        </x-auth.button>

    </form>

</x-auth.card>

</x-auth.layout>