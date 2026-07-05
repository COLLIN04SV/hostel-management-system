@props([
    'title',
    'icon',
    'route',
    'color' => 'blue'
])

@php

$colors = [

'blue' => 'bg-blue-600',

'green' => 'bg-green-600',

'red' => 'bg-red-600',

'yellow' => 'bg-yellow-500',

];

@endphp

<a href="{{ $route }}">

<div class="{{ $colors[$color] }} rounded-2xl text-white p-6 hover:scale-105 transition">

    <i class="bi {{ $icon }} text-3xl"></i>

    <h3 class="mt-4 font-semibold">

        {{ $title }}

    </h3>

</div>

</a>