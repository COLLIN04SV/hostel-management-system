@props(['notice'])

<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition">

    <div class="flex justify-between items-center mb-4">

        <h3 class="text-lg font-semibold">

            {{ $notice->title }}

        </h3>

        <span class="text-sm text-gray-500">

            {{ $notice->created_at->format('d M Y') }}

        </span>

    </div>

    <p class="text-gray-600 leading-7">

        {{ $notice->content }}

    </p>

</div>