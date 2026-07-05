@props([
    'title',
    'subtitle' => ''
])

<div class="flex items-center justify-between mb-6">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            {{ $title }}
        </h1>

        @if($subtitle)
            <p class="text-gray-500 mt-1">
                {{ $subtitle }}
            </p>
        @endif

    </div>

    <div>

        {{ $slot }}

    </div>

</div>