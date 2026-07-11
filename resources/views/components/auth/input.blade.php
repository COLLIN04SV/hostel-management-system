@props([
'name',
'label',
'type' => 'text',
'value' => '',
'placeholder' => ''
])

<div class="mb-5">

    <label
        for="{{ $name }}"
        class="block text-sm font-semibold text-slate-700 mb-2">

        {{ $label }}

    </label>

    <input

        id="{{ $name }}"

        name="{{ $name }}"

        type="{{ $type }}"

        value="{{ old($name,$value) }}"

        placeholder="{{ $placeholder }}"

        {{ $attributes }}

       class="

w-full

rounded-xl

border

border-slate-200

bg-white/70

px-4

py-3.5

placeholder:text-slate-400

focus:border-blue-500

focus:ring-4

focus:ring-blue-100

transition-all

duration-300

">

    @error($name)

        <p class="text-red-500 text-sm mt-2">

            {{ $message }}

        </p>

    @enderror

</div>