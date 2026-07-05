@props([
    'title',
    'value',
    'icon',
    'color' => 'blue'
])

@php

$colors = [

'blue' => 'bg-blue-100 text-blue-600',

'green' => 'bg-green-100 text-green-600',

'red' => 'bg-red-100 text-red-600',

'yellow' => 'bg-yellow-100 text-yellow-600',

'info' => 'bg-cyan-100 text-cyan-600',

];

@endphp

<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

    <div class="flex justify-between items-center">

        <div>

            <p class="text-gray-500 text-sm">
                {{ $title }}
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $value }}
            </h2>

        </div>

        <div class="{{ $colors[$color] }} p-4 rounded-xl">

            <i class="bi {{ $icon }} text-2xl"></i>

        </div>

    </div>

</div>