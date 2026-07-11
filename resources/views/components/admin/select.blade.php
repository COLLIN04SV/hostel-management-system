@props([
    'label',
    'name',
    'required' => false,
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

    <select

        id="{{ $name }}"
        name="{{ $name }}"

        @if($required) required @endif

        {{ $attributes->merge([
            'class'=>'w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition'
        ]) }}>

        {{ $slot }}

    </select>

    @error($name)

        <p class="mt-1 text-sm text-red-500">

            {{ $message }}

        </p>

    @enderror

</div>