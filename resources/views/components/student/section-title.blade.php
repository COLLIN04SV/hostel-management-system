@props([
'title',
'subtitle'=>null
])

<div class="mb-5">

    <h2 class="text-xl font-bold">
        {{ $title }}
    </h2>

    @if($subtitle)

        <p class="text-gray-500 text-sm">
            {{ $subtitle }}
        </p>

    @endif

</div>