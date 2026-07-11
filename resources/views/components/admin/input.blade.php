@props([
    'label',
    'name',
    'type' => 'text',
    'value' => '',
    'required' => false,
    'placeholder' => '',
])

<div>

    <label
        for="{{ $name }}"
        class="block text-sm font-medium text-slate-700 mb-2">

        {{ $label }}

        @if($required)

            <span class="text-red-500">*</span>

        @endif

    </label>

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name,$value) }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif

        {{ $attributes->merge([
            'class' => 'w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition'
        ]) }}>

    @error($name)

        <p class="mt-1 text-sm text-red-500">

            {{ $message }}

        </p>

    @enderror

</div>