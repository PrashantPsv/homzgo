@extends('layouts.app')

@section('title', 'Booking Details | ServiceHub')

@section('content')




{{-- ============================================================
     PAGE HEADER
============================================================ --}}

<section class="bg-white border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <div class="flex items-center gap-2 text-sm text-gray-500">

            <a
                href="{{ url('/') }}"
                class="hover:text-indigo-600 transition"
            >
                Home
            </a>

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>

            <a
                href="{{ route('booking.index') }}"
                class="hover:text-indigo-600 transition"
            >
                My Bookings
            </a>

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>

            <span class="text-gray-900">
                Booking Details
            </span>

        </div>

    </div>

</section>


{{-- ============================================================
     MAIN CONTENT
============================================================ --}}

<section class="py-8 sm:py-10">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ====================================================
             BOOKING HEADER
        ===================================================== --}}

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden mb-6">

            <div class="p-5 sm:p-7">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <div class="flex items-start gap-4">

                        <div class="w-14 h-14 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center shrink-0">

                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        </div>

                        <div>

                            <div class="flex flex-wrap items-center gap-2">

                                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                                    Booking Details
                                </h1>

                                <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                    {{ $booking['status'] }}
                                </span>

                            </div>

                            <p class="mt-2 text-sm text-gray-500">
                                Booking ID:
                                <span class="font-semibold text-gray-800">
                                    #{{ $booking['id'] }}
                                </span>
                            </p>

                            <p class="mt-1 text-sm text-gray-500">
                                Booked on 29 September 2026
                            </p>

                        </div>

                    </div>


                    {{-- Actions --}}

                    <div class="flex flex-col sm:flex-row gap-2">

                        <button
                            type="button"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 4v5h5M20 20v-5h-5M5.5 9A7 7 0 0118 6.5L20 9M18.5 15A7 7 0 016 17.5L4 15"
                                />
                            </svg>

                            Reschedule
                        </button>

                        <button
                            type="button"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-red-200 bg-white px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50 transition"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 6l12 12M18 6L6 18"
                                />
                            </svg>

                            Cancel Booking
                        </button>

                    </div>

                </div>

            </div>

        </div>


        {{-- ====================================================
             TWO COLUMN LAYOUT
        ===================================================== --}}

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            {{-- =================================================
                 LEFT / MAIN COLUMN
            ================================================== --}}

            <div class="lg:col-span-2 space-y-6">


                {{-- =================================================
                     SERVICE DETAILS
                ================================================== --}}

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

                    <div class="px-5 sm:px-6 py-5 border-b border-gray-200">

                        <h2 class="text-lg font-bold text-gray-900">
                            Service Details
                        </h2>

                    </div>

                    <div class="p-5 sm:p-6">

                        <div class="flex flex-col sm:flex-row gap-5">

                            <img
                                src="{{ $booking['image'] }}"
                                alt="{{ $booking['service'] }}"
                                class="w-full sm:w-40 h-48 sm:h-32 object-cover rounded-xl"
                            >

                            <div class="flex-1">

                                <p class="text-xs font-semibold uppercase tracking-wide text-indigo-600">
                                    {{ $booking['category'] }}
                                </p>

                                <h3 class="mt-1 text-xl font-bold text-gray-900">
                                    {{ $booking['service'] }}
                                </h3>

                                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">

                                    <div class="flex items-center gap-3">

                                        <div class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center">

                                            <svg class="w-4 h-4 text-gray-600"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="9" stroke-width="2"/>
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-width="2"
                                                    d="M12 7v5l3 2"
                                                />
                                            </svg>

                                        </div>

                                        <div>

                                            <p class="text-xs text-gray-500">
                                                Duration
                                            </p>

                                            <p class="text-sm font-semibold text-gray-900">
                                                {{ $booking['duration'] }}
                                            </p>

                                        </div>

                                    </div>


                                    <div class="flex items-center gap-3">

                                        <div class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center">

                                            <svg class="w-4 h-4 text-gray-600"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 12l2 2 4-4"
                                                />
                                            </svg>

                                        </div>

                                        <div>

                                            <p class="text-xs text-gray-500">
                                                Service Status
                                            </p>

                                            <p class="text-sm font-semibold text-green-600">
                                                {{ $booking['status'] }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     SERVICE SCHEDULE
                ================================================== --}}

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm">

                    <div class="px-5 sm:px-6 py-5 border-b border-gray-200">

                        <h2 class="text-lg font-bold text-gray-900">
                            Service Schedule
                        </h2>

                    </div>

                    <div class="p-5 sm:p-6">

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                            <div class="rounded-xl bg-gray-50 border border-gray-100 p-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">

                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"
                                            />
                                        </svg>

                                    </div>

                                    <div>

                                        <p class="text-xs text-gray-500">
                                            Date
                                        </p>

                                        <p class="mt-1 text-sm font-semibold text-gray-900">
                                            {{ $booking['date'] }}
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <div class="rounded-xl bg-gray-50 border border-gray-100 p-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">

                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="9" stroke-width="2"/>
                                            <path
                                                stroke-linecap="round"
                                                stroke-width="2"
                                                d="M12 7v5l3 2"
                                            />
                                        </svg>

                                    </div>

                                    <div>

                                        <p class="text-xs text-gray-500">
                                            Time
                                        </p>

                                        <p class="mt-1 text-sm font-semibold text-gray-900">
                                            {{ $booking['time'] }}
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <div class="rounded-xl bg-gray-50 border border-gray-100 p-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">

                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 21s7-5.4 7-11a7 7 0 10-14 0c0 5.6 7 11 7 11z"
                                            />
                                            <circle cx="12" cy="10" r="2.5"/>
                                        </svg>

                                    </div>

                                    <div>

                                        <p class="text-xs text-gray-500">
                                            Location
                                        </p>

                                        <p class="mt-1 text-sm font-semibold text-gray-900">
                                            Ahmedabad
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     ADDRESS
                ================================================== --}}

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm">

                    <div class="px-5 sm:px-6 py-5 border-b border-gray-200 flex items-center justify-between">

                        <h2 class="text-lg font-bold text-gray-900">
                            Service Address
                        </h2>

                        <span class="inline-flex items-center rounded-lg bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                            {{ $booking['address_type'] }}
                        </span>

                    </div>

                    <div class="p-5 sm:p-6">

                        <div class="flex items-start gap-4">

                            <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">

                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 10.5L12 3l9 7.5M5 9v10h14V9M9 19v-6h6v6"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h3 class="font-semibold text-gray-900">
                                    {{ $booking['customer_name'] }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 leading-6">
                                    {{ $booking['address'] }}<br>
                                    {{ $booking['area'] }}
                                </p>

                                <p class="mt-2 text-sm text-gray-500">
                                    {{ $booking['phone'] }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     ADD-ONS
                ================================================== --}}

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm">

                    <div class="px-5 sm:px-6 py-5 border-b border-gray-200">

                        <h2 class="text-lg font-bold text-gray-900">
                            Additional Services
                        </h2>

                    </div>

                    <div class="p-5 sm:p-6">

                        <div class="space-y-4">

                            @foreach($addons as $addon)

                                <div class="flex items-center justify-between gap-4 rounded-xl border border-gray-100 bg-gray-50 p-4">

                                    <div>

                                        <h3 class="text-sm font-semibold text-gray-900">
                                            {{ $addon['name'] }}
                                        </h3>

                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $addon['duration'] }}
                                        </p>

                                    </div>

                                    <span class="text-sm font-bold text-gray-900 whitespace-nowrap">
                                        ₹{{ number_format($addon['price']) }}
                                    </span>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     BOOKING TIMELINE
                ================================================== --}}

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm">

                    <div class="px-5 sm:px-6 py-5 border-b border-gray-200">

                        <h2 class="text-lg font-bold text-gray-900">
                            Booking Timeline
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Track the progress of your service.
                        </p>

                    </div>

                    <div class="p-5 sm:p-6">

                        <div class="relative">

                            @foreach($timeline as $index => $item)

                                <div class="relative flex gap-4 {{ !$loop->last ? 'pb-8' : '' }}">

                                    @if(!$loop->last)

                                        <div class="absolute left-4 top-9 bottom-0 w-px bg-gray-200"></div>

                                    @endif


                                    <div class="relative z-10 w-8 h-8 rounded-full flex items-center justify-center shrink-0
                                        {{ $item['completed'] ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400' }}">

                                        @if($item['completed'])

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M5 13l4 4L19 7"
                                                />
                                            </svg>

                                        @else

                                            <div class="w-2.5 h-2.5 rounded-full bg-current"></div>

                                        @endif

                                    </div>


                                    <div class="flex-1 min-w-0">

                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">

                                            <h3 class="text-sm font-semibold text-gray-900">
                                                {{ $item['title'] }}
                                            </h3>

                                            <span class="text-xs text-gray-500">
                                                {{ $item['date'] }} · {{ $item['time'] }}
                                            </span>

                                        </div>

                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ $item['description'] }}
                                        </p>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 RIGHT SIDEBAR
            ================================================== --}}

            <div class="space-y-6">


                {{-- =================================================
                     PRICE SUMMARY
                ================================================== --}}

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden lg:sticky lg:top-6">

                    <div class="px-5 py-5 border-b border-gray-200">

                        <h2 class="text-lg font-bold text-gray-900">
                            Payment Summary
                        </h2>

                    </div>

                    <div class="p-5">

                        <div class="space-y-3">

                            <div class="flex items-center justify-between text-sm">

                                <span class="text-gray-600">
                                    {{ $booking['service'] }}
                                </span>

                                <span class="font-medium text-gray-900">
                                    ₹{{ number_format($booking['service_price']) }}
                                </span>

                            </div>


                            <div class="flex items-center justify-between text-sm">

                                <span class="text-gray-600">
                                    Additional Services
                                </span>

                                <span class="font-medium text-gray-900">
                                    ₹{{ number_format($booking['addons_total']) }}
                                </span>

                            </div>


                            <div class="flex items-center justify-between text-sm">

                                <span class="text-gray-600">
                                    Discount
                                </span>

                                <span class="font-medium text-green-600">
                                    - ₹{{ number_format($booking['discount']) }}
                                </span>

                            </div>


                            <div class="flex items-center justify-between text-sm">

                                <span class="text-gray-600">
                                    Taxes
                                </span>

                                <span class="font-medium text-gray-900">
                                    ₹{{ number_format($booking['taxes']) }}
                                </span>

                            </div>

                        </div>


                        <div class="my-5 border-t border-dashed border-gray-200"></div>


                        <div class="flex items-center justify-between">

                            <span class="text-base font-semibold text-gray-900">
                                Total Paid
                            </span>

                            <span class="text-2xl font-bold text-gray-900">
                                ₹{{ number_format($booking['total']) }}
                            </span>

                        </div>


                        <div class="mt-4 rounded-xl bg-green-50 border border-green-100 p-3">

                            <div class="flex items-center gap-2">

                                <svg class="w-5 h-5 text-green-600"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>

                                <div>

                                    <p class="text-sm font-semibold text-green-700">
                                        Payment {{ $booking['payment_status'] }}
                                    </p>

                                    <p class="text-xs text-green-600 mt-0.5">
                                        Paid via {{ $booking['payment_method'] }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     PAYMENT INFORMATION
                ================================================== --}}

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm">

                    <div class="px-5 py-5 border-b border-gray-200">

                        <h2 class="text-base font-bold text-gray-900">
                            Payment Information
                        </h2>

                    </div>

                    <div class="p-5 space-y-4">

                        <div class="flex items-center justify-between">

                            <span class="text-sm text-gray-500">
                                Payment Method
                            </span>

                            <span class="text-sm font-semibold text-gray-900">
                                {{ $booking['payment_method'] }}
                            </span>

                        </div>

                        <div class="flex items-center justify-between">

                            <span class="text-sm text-gray-500">
                                Payment Status
                            </span>

                            <span class="text-sm font-semibold text-green-600">
                                {{ $booking['payment_status'] }}
                            </span>

                        </div>

                        <div class="flex items-center justify-between gap-4">

                            <span class="text-sm text-gray-500">
                                Reference
                            </span>

                            <span class="text-xs font-mono text-gray-700 text-right">
                                {{ $booking['payment_reference'] }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     PROFESSIONAL CARD
                ================================================== --}}

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm">

                    <div class="p-5">

                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Your Professional
                        </p>

                        <div class="mt-4 flex items-center gap-4">

                            <div class="w-12 h-12 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">
                                SP
                            </div>

                            <div>

                                <h3 class="font-semibold text-gray-900">
                                    {{ $booking['provider']['name'] }}
                                </h3>

                                <div class="mt-1 flex items-center gap-1 text-sm">

                                    <svg class="w-4 h-4 fill-current text-yellow-400"
                                         viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.56-.955L10 0l2.95 5.955 6.56.955-4.755 4.635 1.123 6.545z"/>
                                    </svg>

                                    <span class="font-semibold text-gray-900">
                                        {{ $booking['provider']['rating'] }}
                                    </span>

                                    <span class="text-gray-400">
                                        ({{ $booking['provider']['reviews'] }} reviews)
                                    </span>

                                </div>

                            </div>

                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-100">

                            <p class="text-sm text-gray-600">
                                {{ $booking['provider']['experience'] }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     SUPPORT CARD
                ================================================== --}}

                <div class="rounded-2xl bg-indigo-50 border border-indigo-100 p-5">

                    <div class="flex items-start gap-3">

                        <div class="w-10 h-10 rounded-xl bg-white text-indigo-600 flex items-center justify-center shrink-0">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M18 10c0 4-3 7-6 7s-6-3-6-7 3-7 6-7 6 3 6 7z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-width="2"
                                    d="M6 17v2a2 2 0 002 2h2M18 17v2a2 2 0 01-2 2h-2"
                                />
                            </svg>

                        </div>

                        <div>

                            <h3 class="font-semibold text-gray-900">
                                Need Help?
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                Have questions about your booking or service?
                            </p>

                            <a
                                href="#"
                                class="inline-flex items-center gap-1 mt-3 text-sm font-semibold text-indigo-600 hover:text-indigo-700"
                            >
                                Contact Support

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ====================================================
             BOTTOM ACTIONS
        ===================================================== --}}

        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4">

            <a
                href="{{ route('booking.index') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900"
            >

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Back to My Bookings

            </a>


            <a
                href="{{ url('/services') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700 transition shadow-sm"
            >

                Book Another Service

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7"
                    />
                </svg>

            </a>

        </div>

    </div>

</section>

@endsection