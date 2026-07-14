@extends('student.layouts.app')

@section('title','Dashboard')

@section('student-content')

<x-student.section-title
    title="Student Dashboard"
    subtitle="Welcome back, {{ $user->name }}. Here's a summary of your hostel information." />

{{-- Summary Cards --}}

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    <x-student.stat-card
        title="Hostel"
        :value="$allocation?->room?->hostel?->name ?? 'Not Allocated'"
        icon="bi-building"
        color="indigo"/>

    <x-student.stat-card
        title="Room"
        :value="$allocation?->room?->room_number ?? 'N/A'"
        icon="bi-door-open"
        color="blue"/>

    <x-student.stat-card
        title="Allocation"
        :value="$allocation?->status ?? 'Pending'"
        icon="bi-house-check"
        color="green"/>

    <x-student.stat-card
        title="Outstanding Balance"
        :value="'KES '.number_format($account?->balance ?? 0)"
        icon="bi-wallet2"
        color="red"/>

</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- Left Column --}}

    <div class="xl:col-span-2 space-y-6">

    {{-- Room Information --}}

<x-student.card>

    <div class="flex items-center justify-between mb-6">

        <div>

            <h3 class="text-lg font-semibold">

                Room Information

            </h3>

            <p class="text-sm text-gray-500">

                Your current hostel allocation

            </p>

        </div>

        @if($allocation)

            <x-student.badge
                type="green"
                text="Allocated"/>

        @else

            <x-student.badge
                type="yellow"
                text="Pending"/>

        @endif

    </div>

    @if($allocation)

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

        <div>

            <p class="text-xs text-gray-500">

                Hostel

            </p>

            <h4 class="font-semibold mt-1">

                {{ $allocation->room->hostel->name }}

            </h4>

        </div>

        <div>

            <p class="text-xs text-gray-500">

                Room

            </p>

            <h4 class="font-semibold mt-1">

                {{ $allocation->room->room_number }}

            </h4>

        </div>

        <div>

            <p class="text-xs text-gray-500">

                Floor

            </p>

            <h4 class="font-semibold mt-1">

                {{ $allocation->room->floor }}

            </h4>

        </div>

        <div>

            <p class="text-xs text-gray-500">

                Capacity

            </p>

            <h4 class="font-semibold mt-1">

                {{ $allocation->room->occupied }}

                /

                {{ $allocation->room->capacity }}

            </h4>

        </div>

        <div>

            <p class="text-xs text-gray-500">

                Monthly Fee

            </p>

            <h4 class="font-semibold mt-1 text-indigo-600">

                KES {{ number_format($allocation->room->price) }}

            </h4>

        </div>

        <div>

            <p class="text-xs text-gray-500">

                Allocation Date

            </p>

            <h4 class="font-semibold mt-1">

                {{ \Carbon\Carbon::parse($allocation->allocated_date)->format('d M Y') }}

            </h4>

        </div>

        <div>

            <p class="text-xs text-gray-500">

                Room Change Window

            </p>

            <h4 class="font-semibold mt-1">

                {{ $daysRemaining }} Days Left

            </h4>

        </div>

        <div>

            <p class="text-xs text-gray-500">

                Status

            </p>

            <h4 class="font-semibold mt-1 text-green-600">

                {{ $allocation->status }}

            </h4>

        </div>

    </div>

    @else

    <div class="text-center py-12">

        <i class="bi bi-house-x text-5xl text-gray-300"></i>

        <h3 class="mt-4 font-semibold">

            No Room Allocation

        </h3>

        <p class="text-gray-500 mt-2">

            Your room allocation will appear here after approval.

        </p>

    </div>

    @endif

</x-student.card>



{{-- Payment Summary --}}

<x-student.card>

    <div class="flex items-center justify-between mb-6">

        <div>

            <h3 class="text-lg font-semibold">

                Payment Summary

            </h3>

            <p class="text-sm text-gray-500">

                Current hostel account

            </p>

        </div>

        <i class="bi bi-wallet2 text-2xl text-green-600"></i>

    </div>

    @if($account)

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

        <div>

            <p class="text-xs text-gray-500">

                Room Fee

            </p>

            <h4 class="font-bold">

                KES {{ number_format($account->room_fee) }}

            </h4>

        </div>

        <div>

            <p class="text-xs text-gray-500">

                Paid

            </p>

            <h4 class="font-bold text-green-600">

                KES {{ number_format($account->amount_paid) }}

            </h4>

        </div>

        <div>

            <p class="text-xs text-gray-500">

                Balance

            </p>

            <h4 class="font-bold text-red-600">

                KES {{ number_format($account->balance) }}

            </h4>

        </div>

        <div>

            <p class="text-xs text-gray-500">

                Status

            </p>

            <h4 class="font-bold text-indigo-600">

                {{ $account->status }}

            </h4>

        </div>

    </div>

    @else

    <div class="py-10 text-center text-gray-500">

        No payment account has been created yet.

    </div>

    @endif

</x-student.card>



{{-- Application Status --}}

<x-student.card>

    <div class="flex items-center justify-between mb-6">

        <h3 class="text-lg font-semibold">

            Hostel Application

        </h3>

    </div>

    @if($application)

    <div class="space-y-4">

        <div class="flex justify-between">

            <span>

                Application Date

            </span>

            <strong>

                {{ \Carbon\Carbon::parse($application->application_date)->format('d M Y') }}

            </strong>

        </div>

        <div class="flex justify-between">

            <span>

                Hostel

            </span>

            <strong>

                {{ $application->hostel->name }}

            </strong>

        </div>

        <div class="flex justify-between">

            <span>

                Status

            </span>

            <strong class="text-indigo-600">

                {{ $application->status }}

            </strong>

        </div>

    </div>

    @else

    <div class="py-10 text-center text-gray-500">

        You have not submitted any hostel application.

    </div>

    @endif

</x-student.card>

</div>

{{-- Right Sidebar --}}

<div class="space-y-6">

    {{-- Latest Notices --}}

    <x-student.card>

        <div class="flex items-center justify-between mb-5">

            <h3 class="text-lg font-semibold">

                Latest Notices

            </h3>

            <a
                href="{{ route('student.notices') }}"
                class="text-sm text-indigo-600 hover:underline">

                View All

            </a>

        </div>

        @forelse($latestNotices as $notice)

            <div class="border-b last:border-0 py-4">

                <h4 class="font-medium">

                    {{ $notice->title }}

                </h4>

                <p class="text-sm text-gray-500 mt-1">

                    {{ \Illuminate\Support\Str::limit($notice->message,80) }}

                </p>

                <p class="text-xs text-gray-400 mt-2">

                    {{ $notice->created_at->diffForHumans() }}

                </p>

            </div>

        @empty

            <div class="py-10 text-center text-gray-500">

                No notices available.

            </div>

        @endforelse

    </x-student.card>



    {{-- Recent Payments --}}

    <x-student.card>

        <div class="flex items-center justify-between mb-5">

            <h3 class="text-lg font-semibold">

                Recent Payments

            </h3>

            <a
                href="{{ route('student.payments') }}"
                class="text-sm text-indigo-600 hover:underline">

                View All

            </a>

        </div>

        @forelse($recentPayments as $payment)

            <div class="flex justify-between items-center border-b last:border-0 py-4">

                <div>

                    <p class="font-medium">

                        KES {{ number_format($payment->amount) }}

                    </p>

                    <p class="text-xs text-gray-500">

                        {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}

                    </p>

                </div>

                <span class="text-green-600 font-semibold">

                    {{ $payment->status }}

                </span>

            </div>

        @empty

            <div class="py-10 text-center text-gray-500">

                No payments recorded.

            </div>

        @endforelse

    </x-student.card>
    
</div>

</div>

@endsection