<x-auth.layout>

@section('title','Confirm Password')

@section('content')

<x-auth.card>

    <div class="text-center mb-8">

        <h1 class="text-3xl font-bold text-slate-800">

            Confirm Password

        </h1>

        <p class="text-slate-500 mt-2">

            Please confirm your password before continuing.

        </p>

    </div>

    <form method="POST"
          action="{{ route('password.confirm') }}"
          class="space-y-6">

        @csrf

        <x-auth.input
            label="Password"
            name="password"
            type="password"
            required/>

        <x-auth.button>

            Confirm Password

        </x-auth.button>

    </form>

</x-auth.card>

</x-auth.layout>