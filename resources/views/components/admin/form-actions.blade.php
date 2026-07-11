@props([
    'cancel',
    'submit' => 'Save',
])

<div class="flex justify-end gap-3 pt-6 border-t border-slate-200">

    <a
        href="{{ $cancel }}"
        class="inline-flex items-center px-5 py-2.5 rounded-lg border border-slate-300 bg-white text-slate-700 text-sm font-medium hover:bg-slate-100 transition">

        <i class="bi bi-arrow-left mr-2"></i>

        Cancel

    </a>

    <button
        type="submit"
        class="inline-flex items-center px-5 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">

        <i class="bi bi-check-lg mr-2"></i>

        {{ $submit }}

    </button>

</div>