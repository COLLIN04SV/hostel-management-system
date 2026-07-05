@props([
    'href' => null,
    'type' => 'button',
    'color' => 'blue'
])

@php

$colors = [

'blue' => 'bg-blue-600 hover:bg-blue-700 text-white',

'green' => 'bg-green-600 hover:bg-green-700 text-white',

'red' => 'bg-red-600 hover:bg-red-700 text-white',

'gray' => 'bg-gray-600 hover:bg-gray-700 text-white',

];

@endphp

@if($href)

<a
    href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'inline-flex items-center px-5 py-2.5 rounded-xl transition font-medium '.$colors[$color]
    ]) }}
>

    {{ $slot }}

</a>

@else

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'inline-flex items-center px-5 py-2.5 rounded-xl transition font-medium '.$colors[$color]
    ]) }}
>

    {{ $slot }}

</button>

@endif