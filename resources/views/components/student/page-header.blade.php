<div class="flex items-center justify-between mb-6">

    <div>
        <h1 class="text-3xl font-bold text-gray-900">
            {{ $title }}
        </h1>

        @isset($subtitle)
            <p class="text-gray-500 mt-1">
                {{ $subtitle }}
            </p>
        @endisset
    </div>

    @isset($actions)
        <div>
            {{ $actions }}
        </div>
    @endisset

</div>