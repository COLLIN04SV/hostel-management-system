@props([
'name',
'label'
])

<label class="flex items-center gap-3">

    <input

        type="checkbox"

        name="{{ $name }}"

        class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">

    <span class="text-slate-700">

        {{ $label }}

    </span>

</label>