<div class="bg-white rounded-2xl shadow-sm p-6">

    <div class="flex items-center justify-between mb-5">

        <h2 class="text-xl font-semibold">

            {{ $title }}

        </h2>

        @isset($link)

            <a href="{{ $link }}" class="text-blue-600 text-sm hover:underline">

                View All

            </a>

        @endisset

    </div>

    {{ $slot }}

</div>