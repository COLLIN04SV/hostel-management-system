@props([
    'href' => null,
    'type' => 'button',
    'color' => 'blue',
    'icon'
])

@php

$colors = [

    'blue' => 'bg-blue-500 hover:bg-blue-600 text-white',

    'green' => 'bg-green-500 hover:bg-green-600 text-white',

    'red' => 'bg-red-500 hover:bg-red-600 text-white',

    'gray' => 'bg-gray-500 hover:bg-gray-600 text-white',

];

@endphp

@if($href)

<a
    href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'inline-flex items-center justify-center w-9 h-9 rounded-lg transition '.$colors[$color]
    ]) }}
>

    <i class="bi {{ $icon }}"></i>

</a>

@else

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'inline-flex items-center justify-center w-9 h-9 rounded-lg transition '.$colors[$color]
    ]) }}
>

    <i class="bi {{ $icon }}"></i>

</button>

@endif