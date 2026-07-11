<x-auth.layout>

@section('title','Verify Email')

@section('content')

<x-auth.card>

    <div class="text-center mb-8">

        <h1 class="text-3xl font-bold text-slate-800">

            Verify Email

        </h1>

        <p class="text-slate-500 mt-3">

            Thanks for signing up.

            Verify your email before continuing.

        </p>

    </div>

    @if(session('status')=='verification-link-sent')

        <div class="mb-6 rounded-xl bg-green-100 p-4 text-green-700">

            A new verification link has been sent.

        </div>

    @endif

    <form method="POST"
          action="{{ route('verification.send') }}">

        @csrf

        <x-auth.button>

            Resend Verification Email

        </x-auth.button>

    </form>

    <form method="POST"
          action="{{ route('logout') }}"
          class="mt-4">

        @csrf

        <button
            class="w-full text-slate-600 hover:text-red-600 transition">

            Logout

        </button>

    </form>

</x-auth.card>

</x-auth.layout>