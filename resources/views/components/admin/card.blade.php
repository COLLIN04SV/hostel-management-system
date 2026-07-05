<div {{ $attributes->merge([
    'class' => 'bg-white rounded-2xl shadow-sm border border-gray-200 p-6'
]) }}>
    {{ $slot }}
</div>