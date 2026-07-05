@props([
'icon',
'title',
'subtitle',
'route'
])

<a href="{{ $route }}">

<div class="border rounded-xl p-5 hover:shadow transition">

    <div class="w-12 h-12 rounded-full bg-indigo-100
    text-indigo-600 flex items-center justify-center mb-4">

        <i class="bi {{ $icon }}"></i>

    </div>

    <h4 class="font-semibold">
        {{ $title }}
    </h4>

    <p class="text-sm text-gray-500">
        {{ $subtitle }}
    </p>

</div>

</a>