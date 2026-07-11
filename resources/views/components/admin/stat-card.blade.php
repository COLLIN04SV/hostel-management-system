@props([
    'title',
    'value',
    'icon',
    'color' => 'indigo'
])

@php

$colors = [

    'indigo' => 'bg-indigo-100 text-indigo-600',

    'blue' => 'bg-blue-100 text-blue-600',

    'green' => 'bg-green-100 text-green-600',

    'red' => 'bg-red-100 text-red-600',

    'yellow' => 'bg-yellow-100 text-yellow-600',

    'cyan' => 'bg-cyan-100 text-cyan-600',

];

@endphp

<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">

    <div class="flex items-center justify-between">

        <div>

            <p class="text-xs uppercase tracking-wide text-slate-500">

                {{ $title }}

            </p>

            <h2 class="mt-2 text-2xl font-bold text-slate-800">

                {{ $value }}

            </h2>

        </div>

        <div class="w-11 h-11 rounded-xl flex items-center justify-center {{ $colors[$color] ?? $colors['indigo'] }}">

            <i class="bi {{ $icon }} text-lg"></i>

        </div>

    </div>

</div>