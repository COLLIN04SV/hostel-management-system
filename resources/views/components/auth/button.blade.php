@props([
'type'=>'submit'
])

<button

    type="{{ $type }}"

    {{ $attributes }}

   class="

w-full

rounded-xl

bg-gradient-to-r

from-blue-600

to-indigo-600

hover:from-blue-700

hover:to-indigo-700

text-white

font-semibold

py-3.5

shadow-lg

hover:shadow-xl

transition-all

duration-300

hover:-translate-y-0.5

active:translate-y-0
">

    {{ $slot }}

</button>