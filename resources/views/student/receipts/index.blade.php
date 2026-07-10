@extends('student.layouts.app')

@section('title','Receipts')

@section('student-content')

<x-student.section-title
    title="Payment Receipts"
    subtitle="Download all your hostel payment receipts."/>

<x-student.card>

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead>

                <tr class="border-b">

                    <th class="text-left py-3">
                        Receipt
                    </th>

                    <th class="text-left py-3">
                        Date
                    </th>

                    <th class="text-left py-3">
                        Amount
                    </th>

                    <th class="text-left py-3">
                        Status
                    </th>

                    <th class="text-center py-3">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($payments as $payment)

                <tr class="border-b">

                    <td class="py-4">
                        #{{ $payment->id }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}
                    </td>

                    <td>
                        KES {{ number_format($payment->amount) }}
                    </td>

                    <td>

                        @if($payment->status=='Paid')

                            <x-student.badge
                                type="green"
                                text="Paid"/>

                        @elseif($payment->status=='Pending')

                            <x-student.badge
                                type="yellow"
                                text="Pending"/>

                        @else

                            <x-student.badge
                                type="red"
                                text="Failed"/>

                        @endif

                    </td>

                    <td class="text-center">

                        <a
                            href="{{ route('student.receipts.download',$payment->id) }}"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg">

                            Download

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="text-center py-10 text-gray-500">

                        No receipts available.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $payments->links() }}

    </div>

</x-student.card>

@endsection