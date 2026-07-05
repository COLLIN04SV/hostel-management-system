<div class="bg-white rounded-2xl shadow-sm p-5 hover:shadow-md transition">

    <div class="flex items-center justify-between">

        <div>

            <p class="text-gray-500 text-sm">
                {{ $title }}
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $value }}
            </h2>

            @isset($subtitle)

                <p class="text-xs text-gray-400 mt-2">
                    {{ $subtitle }}
                </p>

            @endisset

        </div>

        <div class="w-14 h-14 rounded-xl {{ $color }} flex items-center justify-center">

            <i class="{{ $icon }} text-3xl text-white"></i>

        </div>

    </div>

</div>