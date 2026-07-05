@extends('layouts.admin')

@section('page-title','Reports')

@section('content')

<x-admin.page-header
    title="Reports Dashboard"
    subtitle="System statistics and performance overview">

</x-admin.page-header>

<!-- Statistics -->

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    <x-admin.stat-card
        title="Students"
        :value="$totalStudents"
        icon="bi-people-fill"
        color="blue"/>

    <x-admin.stat-card
        title="Hostels"
        :value="$totalHostels"
        icon="bi-building"
        color="green"/>

    <x-admin.stat-card
        title="Rooms"
        :value="$totalRooms"
        icon="bi-door-open"
        color="yellow"/>

    <x-admin.stat-card
        title="Revenue"
        :value="'KSh '.number_format($totalCollected)"
        icon="bi-cash-stack"
        color="green"/>

</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    <x-admin.stat-card
        title="Allocated Students"
        :value="$allocatedStudents"
        icon="bi-house-check"
        color="green"/>

    <x-admin.stat-card
        title="Unallocated"
        :value="$unallocatedStudents"
        icon="bi-person-x"
        color="red"/>

    <x-admin.stat-card
        title="Applications"
        :value="$totalApplications"
        icon="bi-file-earmark-text"
        color="blue"/>

    <x-admin.stat-card
        title="Payments"
        :value="$totalPayments"
        icon="bi-credit-card"
        color="yellow"/>

</div>

<div class="grid lg:grid-cols-2 gap-6 mb-8">

    <x-admin.card>

        <h2 class="text-xl font-bold mb-5">

            Room Summary

        </h2>

        <div class="space-y-4">

            <div class="flex justify-between">

                <span>Total Rooms</span>

                <strong>{{ $totalRooms }}</strong>

            </div>

            <div class="flex justify-between">

                <span>Occupied Rooms</span>

                <strong>{{ $occupiedRooms }}</strong>

            </div>

            <div class="flex justify-between">

                <span>Vacant Rooms</span>

                <strong>{{ $vacantRooms }}</strong>

            </div>

        </div>

    </x-admin.card>

    <x-admin.card>

        <h2 class="text-xl font-bold mb-5">

            Application Summary

        </h2>

        <div class="space-y-4">

            <div class="flex justify-between">

                <span>Total Applications</span>

                <strong>{{ $totalApplications }}</strong>

            </div>

            <div class="flex justify-between">

                <span>Pending</span>

                <x-admin.badge
                    type="warning"
                    text="{{ $pendingApplications }}"/>

            </div>

            <div class="flex justify-between">

                <span>Approved</span>

                <x-admin.badge
                    type="success"
                    text="{{ $approvedApplications }}"/>

            </div>

        </div>

    </x-admin.card>

</div>

<x-admin.card>

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-xl font-bold">

            Recent Payments

        </h2>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

            <tr class="bg-gray-50 border-b">

                <th class="px-6 py-4 text-left">

                    Student

                </th>

                <th class="px-6 py-4 text-left">

                    Amount

                </th>

                <th class="px-6 py-4 text-left">

                    Date

                </th>

                <th class="px-6 py-4 text-center">

                    Status

                </th>

            </tr>

            </thead>

            <tbody>

            @forelse($recentPayments as $payment)

            <tr class="border-b hover:bg-gray-50">

                <td class="px-6 py-4">

                    {{ $payment->student->user->name }}

                </td>

                <td class="px-6 py-4">

                    KSh {{ number_format($payment->amount) }}

                </td>

                <td class="px-6 py-4">

                    {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}

                </td>

                <td class="px-6 py-4 text-center">

                    <x-admin.badge
                        type="success"
                        :text="$payment->status"/>

                </td>

            </tr>

            @empty

            <tr>

                <td
                    colspan="4"
                    class="py-10 text-center text-gray-500">

                    No payments found.

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</x-admin.card>

@endsection