@props([
'title',
'value',
'icon',
'color' => 'indigo'
])

<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">

    <div class="flex justify-between items-center">

        <div>

            <p class="text-sm text-gray-500">
                {{ $title }}
            </p>

            <h3 class="text-2xl font-bold mt-1">
                {{ $value }}
            </h3>

        </div>

        <div class="w-12 h-12 rounded-full flex items-center justify-center
        bg-{{ $color }}-100 text-{{ $color }}-600">

            <i class="bi {{ $icon }} text-xl"></i>

        </div>

    </div>

</div>