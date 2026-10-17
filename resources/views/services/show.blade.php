@extends('layouts.app')

@section('title', ($service['name'] ?? 'Service').' | ServiceHub')

@section('content')

{{-- ============================================================
     SERVICE UNAVAILABLE
============================================================ --}}

@if($serviceUnavailable ?? false)

    <section class="bg-gray-50 min-h-[70vh] flex items-center">

        <div class="max-w-3xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-16">

            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8 md:p-12 text-center">

                {{-- Icon --}}
                <div class="mx-auto w-20 h-20 rounded-full bg-red-50 flex items-center justify-center">

                    <svg
                        class="w-10 h-10 text-red-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 9v4m0 4h.01M10.3 3.6L2.8 17a2 2 0 001.7 3h15a2 2 0 001.7-3L13.7 3.6a2 2 0 00-3.4 0z"
                        />
                    </svg>

                </div>

                {{-- Heading --}}
                <h1 class="mt-6 text-2xl md:text-3xl font-bold text-gray-900">
                    Service not available in your area
                </h1>

                {{-- API message --}}
                <p class="mt-3 text-gray-600 leading-7">
                    {{ $serviceUnavailableMessage
                        ?? 'Currently we are not providing service in this area.' }}
                </p>

                {{-- Current Location --}}
                @php
                    $location = session('location', []);
                @endphp

                @if(!empty($location))

                    <div class="mt-6 rounded-2xl bg-gray-50 border border-gray-200 p-4 text-left">

                        <div class="flex items-start gap-3">

                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center">

                                <svg
                                    class="w-5 h-5 text-indigo-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 21s7-5.4 7-12a7 7 0 10-14 0c0 6.6 7 12 7 12z"
                                    />

                                    <circle
                                        cx="12"
                                        cy="9"
                                        r="2.5"
                                    />
                                </svg>

                            </div>

                            <div class="min-w-0">

                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Selected location
                                </p>

                                <p class="mt-1 text-sm font-semibold text-gray-900">
                                    {{ $location['address'] ?? 'Selected location' }}
                                </p>

                                @if(!empty($location['pincode']))

                                    <p class="mt-1 text-xs text-gray-500">
                                        Pincode: {{ $location['pincode'] }}
                                    </p>

                                @endif

                            </div>

                        </div>

                    </div>

                @endif

                {{-- Actions --}}
                <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">

                    {{-- Change location --}}
                    <button
                        type="button"
                        onclick="openLocationModal()"
                        class="inline-flex items-center justify-center rounded-xl bg-gray-900 px-6 py-3 text-sm font-semibold text-white hover:bg-gray-800 transition"
                    >
                        Change location
                    </button>

                    {{-- Browse services --}}
                    <a
                        href="{{ route('services.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition"
                    >
                        Browse other services
                    </a>

                </div>

            </div>

        </div>

    </section>

@else

    {{-- ========================================================
         NORMAL SERVICE DETAIL PAGE
    ======================================================== --}}

    {{-- KEEP YOUR EXISTING SERVICE PAGE CONTENT HERE --}}


{{-- ============================================================
     BREADCRUMB
============================================================ --}}

<section class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

        <div class="flex items-center gap-2 text-sm overflow-x-auto whitespace-nowrap">

            <a
                href="{{ route('home') }}"
                class="text-gray-500 hover:text-indigo-600"
            >
                Home
            </a>

            <svg class="w-4 h-4 text-gray-400"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />

            </svg>

            <a
                href="{{ route('services.index') }}"
                class="text-gray-500 hover:text-indigo-600"
            >
                Services
            </a>

            <svg class="w-4 h-4 text-gray-400"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />

            </svg>

            <span class="text-gray-900 font-medium">
                {{ $service['name'] }}
            </span>

        </div>

    </div>

</section>


{{-- ============================================================
     MAIN SERVICE CONTENT
============================================================ --}}

<section class="bg-gray-50 py-8 lg:py-10">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


            {{-- =================================================
                 LEFT CONTENT
            ================================================== --}}

            <div class="lg:col-span-2 space-y-6">


                {{-- =============================================
                     IMAGE GALLERY
                ============================================== --}}

                <div
                    class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden"
                >

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 p-2">

                        {{-- Main Image --}}
                        <div class="md:col-span-2">

                            <img
                                src="{{ $service['images'] ?? [][0] }}"
                                alt="{{ $service['name'] }}"
                                class="w-full h-[280px] sm:h-[380px] md:h-[460px] object-cover rounded-xl"
                            >

                        </div>


                        {{-- Small Images --}}
                        <div class="hidden md:grid grid-rows-3 gap-2">

                            @foreach(array_slice($service['images'] ?? [], 1, 3) as $image)

                                <img
                                    src="{{ $image }}"
                                    alt="{{ $service['name'] }}"
                                    class="w-full h-full min-h-[120px] object-cover rounded-xl"
                                >

                            @endforeach

                        </div>

                    </div>

                </div>


                {{-- =============================================
                     SERVICE INFORMATION
                ============================================== --}}

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8">

                    <div class="flex flex-wrap items-center gap-3 mb-4">

                        <span class="rounded-full bg-indigo-50 px-3 py-1 text-sm font-medium text-indigo-700">
                            {{ $service['category'] }}
                        </span>

                        <span class="text-sm text-gray-400">
                            Home Service
                        </span>

                    </div>


                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
                        {{ $service['name'] }}
                    </h1>


                    {{-- Rating --}}
                    <div class="flex flex-wrap items-center gap-4 mt-4">

                        <div class="flex items-center gap-2">

                            <span class="inline-flex items-center gap-1 rounded-lg bg-green-50 px-2.5 py-1 text-sm font-semibold text-green-700">

                                <span>★</span>

                                {{ $service['rating'] }}

                            </span>

                            <span class="text-sm text-gray-500">
                                {{ number_format($service['reviews']) }} reviews
                            </span>

                        </div>


                        <div class="flex items-center gap-2 text-sm text-gray-500">

                            <svg class="w-5 h-5 text-gray-400"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                />

                            </svg>

                            {{ $service['duration'] }}

                        </div>

                    </div>


                    <div class="border-t border-gray-100 my-6"></div>


                    {{-- Price --}}
                    <div class="flex flex-wrap items-center gap-3">

                        <span class="text-3xl font-bold text-gray-900">
                            ₹{{ number_format($service['price']) }}
                        </span>

                        <span class="text-lg text-gray-400 line-through">
                            ₹{{ number_format($service['old_price']) }}
                        </span>

                        <span class="rounded-lg bg-green-100 px-2.5 py-1 text-xs font-bold text-green-700">
                            {{ $service['discount'] }}
                        </span>

                    </div>

                    <p class="mt-2 text-sm text-gray-500">
                        Inclusive of applicable taxes
                    </p>

                </div>


                {{-- =============================================
                     ABOUT SERVICE
                ============================================== --}}

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8">

                    <h2 class="text-xl font-bold text-gray-900">
                        About this service
                    </h2>

                    <p class="mt-4 text-gray-600 leading-7">
                        {{ $service['description'] ?? 'Professional service at your doorstep.' }}
                    </p>

                    <p class="mt-4 text-gray-600 leading-7">
                        Whether you are preparing your home for a special occasion,
                        moving into a new house, or simply want a cleaner living
                        environment, our professionals take care of the hard work
                        for you.
                    </p>

                </div>


                {{-- =============================================
                     WHAT'S INCLUDED
                ============================================== --}}

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8">

                    <h2 class="text-xl font-bold text-gray-900">
                        What's included
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        Everything covered in this service
                    </p>


                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">

                        @foreach(($service['included'] ?? []) as $item)

                            <div class="flex items-center gap-3">

                                <span class="flex-shrink-0 w-7 h-7 rounded-full bg-green-100 text-green-600 flex items-center justify-center">

                                    <svg class="w-4 h-4"
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

                                </span>

                                <span class="text-sm text-gray-700">
                                    {{ $item }}
                                </span>

                            </div>

                        @endforeach

                    </div>

                </div>


                {{-- =============================================
                     WHAT'S NOT INCLUDED
                ============================================== --}}

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8">

                    <h2 class="text-xl font-bold text-gray-900">
                        What's not included
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        These services are not part of the base package
                    </p>


                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">

                        @foreach(($service['excluded'] ?? []) as $item)

                            <div class="flex items-center gap-3">

                                <span class="flex-shrink-0 w-7 h-7 rounded-full bg-red-50 text-red-500 flex items-center justify-center">

                                    <svg class="w-4 h-4"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />

                                    </svg>

                                </span>

                                <span class="text-sm text-gray-700">
                                    {{ $item }}
                                </span>

                            </div>

                        @endforeach

                    </div>

                </div>


                {{-- =============================================
                     WHY CHOOSE THIS SERVICE
                ============================================== --}}

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8">

                    <h2 class="text-xl font-bold text-gray-900">
                        Why choose this service?
                    </h2>


                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">

                        @foreach(($service['highlights'] ?? []) as $highlight)

                            <div class="rounded-2xl bg-gray-50 p-5">

                                <div class="w-11 h-11 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center mb-4">

                                    @if($highlight['icon'] === 'shield')

                                        <svg class="w-5 h-5"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"
                                            />

                                        </svg>

                                    @elseif($highlight['icon'] === 'clock')

                                        <svg class="w-5 h-5"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                            />

                                        </svg>

                                    @else

                                        <svg class="w-5 h-5"
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

                                    @endif

                                </div>

                                <h3 class="font-semibold text-gray-900">
                                    {{ $highlight['title'] }}
                                </h3>

                                <p class="mt-2 text-sm text-gray-500 leading-5">
                                    {{ $highlight['description'] }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                </div>


                {{-- =============================================
                     REVIEWS
                ============================================== --}}

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8">

                    <div class="flex items-center justify-between">

                        <div>

                            <h2 class="text-xl font-bold text-gray-900">
                                Customer reviews
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ number_format($service['reviews']) }} verified reviews
                            </p>

                        </div>


                        <div class="text-right">

                            <div class="text-3xl font-bold text-gray-900">
                                {{ $service['rating'] }}
                            </div>

                            <div class="text-yellow-500 text-sm tracking-wide">
                                ★★★★★
                            </div>

                        </div>

                    </div>


                    {{-- Reviews --}}
                    <div class="mt-6">

                        @foreach($reviews as $review)

                            <div class="border-t border-gray-100 py-6 first:border-t-0">

                                <div class="flex gap-4">

                                    <div class="flex-shrink-0 w-11 h-11 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">

                                        {{ strtoupper(substr($review['name'], 0, 1)) }}

                                    </div>


                                    <div class="flex-1">

                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">

                                            <div>

                                                <h3 class="font-semibold text-gray-900">
                                                    {{ $review['name'] }}
                                                </h3>

                                                <div class="text-yellow-500 text-sm mt-1">
                                                    {{ str_repeat('★', $review['rating']) }}
                                                </div>

                                            </div>

                                            <span class="text-xs text-gray-400">
                                                {{ $review['date'] }}
                                            </span>

                                        </div>


                                        <p class="mt-3 text-sm text-gray-600 leading-6">
                                            {{ $review['review'] }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>


                    <button
                        type="button"
                        class="w-full mt-2 rounded-xl border border-gray-200 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition"
                    >
                        View all reviews
                    </button>

                </div>


                {{-- =============================================
                     FAQ
                ============================================== --}}

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8">

                    <h2 class="text-xl font-bold text-gray-900">
                        Frequently asked questions
                    </h2>


                    <div class="mt-6 space-y-3">

                        <details class="group border border-gray-200 rounded-xl">

                            <summary class="flex items-center justify-between cursor-pointer list-none p-5 font-medium text-gray-900">

                                How long does the service take?

                                <span class="text-gray-400 group-open:rotate-180 transition">
                                    ↓
                                </span>

                            </summary>

                            <div class="px-5 pb-5 text-sm text-gray-600 leading-6">

                                The service usually takes around 3 to 4 hours,
                                depending on the size and condition of the home.

                            </div>

                        </details>


                        <details class="group border border-gray-200 rounded-xl">

                            <summary class="flex items-center justify-between cursor-pointer list-none p-5 font-medium text-gray-900">

                                Do I need to provide cleaning products?

                                <span class="text-gray-400 group-open:rotate-180 transition">
                                    ↓
                                </span>

                            </summary>

                            <div class="px-5 pb-5 text-sm text-gray-600 leading-6">

                                No. Our professionals bring the required cleaning
                                products and equipment.

                            </div>

                        </details>


                        <details class="group border border-gray-200 rounded-xl">

                            <summary class="flex items-center justify-between cursor-pointer list-none p-5 font-medium text-gray-900">

                                Can I reschedule my booking?

                                <span class="text-gray-400 group-open:rotate-180 transition">
                                    ↓
                                </span>

                            </summary>

                            <div class="px-5 pb-5 text-sm text-gray-600 leading-6">

                                Yes, bookings can be rescheduled according to the
                                applicable booking policy.

                            </div>

                        </details>


                        <details class="group border border-gray-200 rounded-xl">

                            <summary class="flex items-center justify-between cursor-pointer list-none p-5 font-medium text-gray-900">

                                Are taxes included in the price?

                                <span class="text-gray-400 group-open:rotate-180 transition">
                                    ↓
                                </span>

                            </summary>

                            <div class="px-5 pb-5 text-sm text-gray-600 leading-6">

                                The displayed price includes applicable taxes.

                            </div>

                        </details>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 RIGHT BOOKING CARD
            ================================================== --}}

            <div class="lg:col-span-1">

                <div class="lg:sticky lg:top-24 space-y-4">


                    {{-- Booking Card --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-lg p-6">

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-sm text-gray-500">
                                    Starting from
                                </p>

                                <div class="flex items-center gap-2 mt-1">

                                    <span class="text-2xl font-bold text-gray-900">
                                        ₹{{ number_format($service['price']) }}
                                    </span>

                                    <span class="text-sm text-gray-400 line-through">
                                        ₹{{ number_format($service['old_price']) }}
                                    </span>

                                </div>

                            </div>


                            <button
                                type="button"
                                class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:text-red-500 hover:border-red-200 transition"
                            >

                                <svg class="w-5 h-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 000-7.78z"
                                    />

                                </svg>

                            </button>

                        </div>


                        <div class="border-t border-gray-100 my-5"></div>


                        {{-- Location --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Service location
                            </label>

                            <button
                                type="button"
                                class="w-full flex items-center gap-3 rounded-xl border border-gray-200 p-3 text-left hover:border-indigo-500 transition"
                            >

                                <div class="w-9 h-9 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">

                                    <svg class="w-5 h-5"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                        />

                                    </svg>

                                </div>

                                <div class="min-w-0">

                                    <div class="text-sm font-semibold text-gray-900">
                                        Ahmedabad
                                    </div>

                                    <div class="text-xs text-gray-500 truncate">
                                        Service available in your area
                                    </div>

                                </div>

                            </button>

                        </div>


                        {{-- Date --}}
                        <div class="mt-5">

                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Select date
                            </label>

                            <input
                                type="date"
                                class="w-full rounded-xl border-gray-200 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                        </div>


                        {{-- Time --}}
                        <div class="mt-5">

                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Select time
                            </label>

                            <div class="grid grid-cols-2 gap-2">

                                @foreach([
                                    '09:00 AM',
                                    '11:00 AM',
                                    '01:00 PM',
                                    '03:00 PM',
                                    '05:00 PM',
                                    '07:00 PM'
                                ] as $time)

                                    <button
                                        type="button"
                                        class="rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-600 hover:border-indigo-500 hover:bg-indigo-50 hover:text-indigo-600 transition"
                                    >
                                        {{ $time }}
                                    </button>

                                @endforeach

                            </div>

                        </div>


                        {{-- Price Summary --}}
                        <div class="border-t border-gray-100 mt-6 pt-5">

                            <div class="flex justify-between text-sm">

                                <span class="text-gray-500">
                                    Service
                                </span>

                                <span class="font-medium text-gray-900">
                                    ₹{{ number_format($service['price']) }}
                                </span>

                            </div>


                            <div class="flex justify-between text-sm mt-3">

                                <span class="text-gray-500">
                                    Taxes
                                </span>

                                <span class="font-medium text-gray-900">
                                    Included
                                </span>

                            </div>


                            <div class="border-t border-gray-100 mt-4 pt-4 flex items-center justify-between">

                                <span class="font-semibold text-gray-900">
                                    Total
                                </span>

                                <span class="text-xl font-bold text-gray-900">
                                    ₹{{ number_format($service['price']) }}
                                </span>

                            </div>

                        </div>


                        {{-- Book Now --}}
                        <a
                            href="{{ route('booking.address') }}"
                            class="block w-full mt-6 rounded-xl bg-indigo-600 px-5 py-3.5 text-center text-sm font-semibold text-white hover:bg-indigo-700 transition shadow-sm"
                        >
                            Book Now
                        </a>


                        <div class="flex items-center justify-center gap-2 mt-4 text-xs text-gray-400">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19.5 10.5c0 5.5-7.5 10-7.5 10s-7.5-4.5-7.5-10a7.5 7.5 0 1115 0z"
                                />

                            </svg>

                            No payment required at this step

                        </div>

                    </div>


                    {{-- Guarantee Card --}}
                    <div class="bg-gray-900 rounded-2xl p-5 text-white">

                        <div class="flex gap-3">

                            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">

                                <svg class="w-5 h-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.292 9 11.622C17.176 19.292 21 14.591 21 9c0-1.065-.138-2.098-.382-3.016z"
                                    />

                                </svg>

                            </div>

                            <div>

                                <h3 class="font-semibold">
                                    ServiceHub Guarantee
                                </h3>

                                <p class="mt-1 text-sm text-gray-400">
                                    Verified professionals and quality service.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ============================================================
     MOBILE BOOKING BAR
============================================================ --}}

<div class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-200 shadow-lg p-3">

    <div class="flex items-center gap-3">

        <div class="flex-1">

            <div class="text-xs text-gray-500">
                Starting from
            </div>

            <div class="text-xl font-bold text-gray-900">
                ₹{{ number_format($service['price']) }}
            </div>

        </div>

        <a
            href="{{ route('booking.address') }}"
            class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white"
        >
            Book Now
        </a>

    </div>

</div>
@endif

@endsection