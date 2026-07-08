@props([
    'title',
    'value',
    'icon' => 'bi-info-circle'
])

<div class="bg-white rounded-2xl shadow-sm border p-5">
    <div class="flex items-center justify-between mb-3">

        <div>
            <p class="text-sm text-gray-500">
                {{ $title }}
            </p>

            <h3 class="text-2xl font-bold text-gray-800 mt-1">
                {{ $value }}
            </h3>
        </div>

        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
            <i class="bi {{ $icon }} text-blue-600 text-xl"></i>
        </div>

    </div>
</div>