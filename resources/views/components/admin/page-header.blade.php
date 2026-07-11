@props([
    'title',
    'subtitle' => null,
])

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

    <div>

        <h1 class="text-2xl font-bold text-slate-800">

            {{ $title }}

        </h1>

        @if($subtitle)

            <p class="text-sm text-slate-500 mt-1">

                {{ $subtitle }}

            </p>

        @endif

    </div>

    <div class="flex items-center gap-3">

        {{ $slot }}

    </div>

</div>