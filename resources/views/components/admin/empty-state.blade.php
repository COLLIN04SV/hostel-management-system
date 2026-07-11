@props([
    'icon'=>'bi-inbox',
    'title'=>'No Records Found',
    'message'=>'There is nothing to display.'
])

<tr>

<td colspan="100%" class="py-16 text-center">

    <i class="bi {{ $icon }} text-5xl text-slate-300"></i>

    <h3 class="mt-4 text-lg font-semibold text-slate-700">

        {{ $title }}

    </h3>

    <p class="mt-2 text-sm text-slate-500">

        {{ $message }}

    </p>

</td>

</tr>