@props([
    'action',
    'placeholder' => 'Search...',
    'value' => request('search')
])

<form
    method="GET"
    action="{{ $action }}"
    class="mb-5 flex flex-col md:flex-row gap-3">

    <div class="relative flex-1">

        <i class="bi bi-search absolute left-3 top-3 text-slate-400"></i>

        <input
            type="text"
            name="search"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            class="w-full pl-10 pr-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">

    </div>

    <button
        class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm transition">

        Search

    </button>

    @if(request('search'))

        <a
            href="{{ $action }}"
            class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 rounded-lg text-sm flex items-center justify-center transition">

            Clear

        </a>

    @endif

</form>