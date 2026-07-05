@props([
'color'=>'indigo'
])

<button {{ $attributes->merge([
'class'=>
'px-5 py-2 rounded-lg bg-'.$color.'-600 hover:bg-'.$color.'-700 text-white transition'
]) }}>
    {{ $slot }}
</button>