@extends('layouts.app')

@section('title', 'Help & Support | ServiceHub')

@section('content')

@php

    $categories = [
        [
            'title' => 'Bookings',
            'description' => 'Manage, reschedule or cancel your bookings.',
            'color' => 'indigo',
            'icon' => 'calendar',
        ],
        [
            'title' => 'Payments',
            'description' => 'Payment methods, invoices and refunds.',
            'color' => 'green',
            'icon' => 'payment',
        ],
        [
            'title' => 'Services',
            'description' => 'Questions about services and professionals.',
            'color' => 'purple',
            'icon' => 'service',
        ],
        [
            'title' => 'Cancellations',
            'description' => 'Cancellation policies and refund information.',
            'color' => 'orange',
            'icon' => 'cancel',
        ],
        [
            'title' => 'Account',
            'description' => 'Profile, password and account settings.',
            'color' => 'blue',
            'icon' => 'user',
        ],
        [
            'title' => 'Other',
            'description' => 'Anything else you need help with.',
            'color' => 'gray',
            'icon' => 'help',
        ],
    ];

    $faqs = [
        [
            'question' => 'How can I book a service?',
            'answer' => 'Choose a service, select your address, date and time, review the booking details and complete the booking process.',
        ],
        [
            'question' => 'Can I reschedule my booking?',
            'answer' => 'Yes. Upcoming bookings can be rescheduled subject to availability and the applicable service policy.',
        ],
        [
            'question' => 'How can I cancel my booking?',
            'answer' => 'Open My Bookings, select the booking and choose the cancellation option. Any applicable refund depends on the cancellation policy.',
        ],
        [
            'question' => 'What payment methods are supported?',
            'answer' => 'ServiceHub can support UPI, credit/debit cards, net banking, wallets and pay-after-service options depending on the service.',
        ],
        [
            'question' => 'How do I change my saved address?',
            'answer' => 'Go to My Profile → Saved Addresses and choose Edit next to the address you want to update.',
        ],
        [
            'question' => 'What happens after I book a service?',
            'answer' => 'You receive a booking confirmation with the booking ID, scheduled date and time. A professional can then be assigned to the booking.',
        ],
    ];

    $tickets = [
        [
            'id' => 'SUP20260928001',
            'subject' => 'Question about my upcoming booking',
            'category' => 'Bookings',
            'status' => 'Open',
            'date' => '28 September 2026',
        ],
        [
            'id' => 'SUP20260915002',
            'subject' => 'Payment confirmation',
            'category' => 'Payments',
            'status' => 'Resolved',
            'date' => '15 September 2026',
        ],
    ];

@endphp


<div class="min-h-screen bg-gray-50">

    {{-- Hero --}}
    <section class="bg-indigo-600">

        <div class="mx-auto max-w-6xl px-4 py-12 sm:px-6 lg:px-8">

            <div class="mx-auto max-w-3xl text-center">

                <div class="mb-3 flex items-center justify-center gap-2 text-sm text-indigo-100">

                    <a
                        href="{{ route('profile') }}"
                        class="hover:text-white"
                    >
                        My Profile
                    </a>

                    <span>/</span>

                    <span class="text-white">
                        Help & Support
                    </span>

                </div>

                <h1 class="text-3xl font-bold text-white sm:text-4xl">
                    How can we help?
                </h1>

                <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-indigo-100 sm:text-base">
                    Find answers to common questions or get in touch with our support team.
                </p>


                {{-- Search --}}
                <div class="mx-auto mt-8 max-w-2xl">

                    <div class="relative">

                        <svg
                            class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                            />
                        </svg>

                        <input
                            type="text"
                            placeholder="Search for help..."
                            class="w-full rounded-2xl border-0 bg-white py-4 pl-12 pr-5 text-sm text-gray-900 shadow-lg outline-none placeholder:text-gray-400 focus:ring-4 focus:ring-white/20"
                        >

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- Main --}}
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">


        {{-- Support Categories --}}
        <section>

            <div class="mb-5">

                <h2 class="text-xl font-bold text-gray-900">
                    Browse by category
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Choose a topic to find the help you need.
                </p>

            </div>


            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

                @foreach($categories as $category)

                    <a
                        href="#"
                        class="group rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-md"
                    >

                        <div class="flex items-start gap-4">

                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                                @if($category['icon'] === 'calendar')

                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        />
                                    </svg>

                                @elseif($category['icon'] === 'payment')

                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 10h18M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"
                                        />
                                    </svg>

                                @elseif($category['icon'] === 'service')

                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M14.7 6.3a1 1 0 00-1.4 0l-7 7a1 1 0 000 1.4l3 3a1 1 0 001.4 0l7-7a1 1 0 000-1.4l-3-3z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M16 4l4 4"
                                        />
                                    </svg>

                                @elseif($category['icon'] === 'cancel')

                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 6l12 12M18 6L6 18"
                                        />
                                    </svg>

                                @elseif($category['icon'] === 'user')

                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 21a8 8 0 0116 0"
                                        />
                                    </svg>

                                @else

                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8.228 9c.549-1.165 1.9-2 3.772-2 2.21 0 4 1.343 4 3 0 1.5-1.3 2.5-3.2 3.5-3.5.8-.4 1.2-1.1 1.2-2 0-1.657-1.79-3-4-3-1.87 0-3.223.835-3.772 2"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 17h.01"
                                        />
                                    </svg>

                                @endif

                            </div>


                            <div class="min-w-0 flex-1">

                                <h3 class="font-semibold text-gray-900 group-hover:text-indigo-600">
                                    {{ $category['title'] }}
                                </h3>

                                <p class="mt-1 text-sm leading-5 text-gray-500">
                                    {{ $category['description'] }}
                                </p>

                            </div>


                            <svg
                                class="mt-1 h-5 w-5 shrink-0 text-gray-300 transition group-hover:translate-x-1 group-hover:text-indigo-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>

                        </div>

                    </a>

                @endforeach

            </div>

        </section>


        {{-- Popular Questions --}}
        <section class="mt-12">

            <div class="mb-5">

                <h2 class="text-xl font-bold text-gray-900">
                    Popular questions
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Quick answers to questions customers ask most often.
                </p>

            </div>


            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                @foreach($faqs as $faq)

                    <details class="group border-b border-gray-100 last:border-b-0">

                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-5 py-5 sm:px-6">

                            <span class="text-sm font-semibold text-gray-900">
                                {{ $faq['question'] }}
                            </span>

                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-gray-100 text-gray-500 transition group-open:bg-indigo-50 group-open:text-indigo-600">

                                <svg
                                    class="h-4 w-4 transition group-open:rotate-45"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 5v14M5 12h14"
                                    />
                                </svg>

                            </span>

                        </summary>

                        <div class="px-5 pb-5 sm:px-6">

                            <p class="max-w-3xl text-sm leading-6 text-gray-600">
                                {{ $faq['answer'] }}
                            </p>

                        </div>

                    </details>

                @endforeach

            </div>

        </section>


        {{-- Contact Support --}}
        <section class="mt-12">

            <div class="rounded-2xl bg-gray-900 p-6 sm:p-8">

                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/10 text-white">

                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M18 10c0 3.866-2.686 7-6 7s-6-3.134-6-7 2.686-7 6-7 6 3.134 6 7z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 10v7a2 2 0 002 2h8a2 2 0 002-2v-7"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 21h6"
                                />
                            </svg>

                        </div>

                        <h2 class="mt-4 text-xl font-bold text-white">
                            Still need help?
                        </h2>

                        <p class="mt-2 max-w-xl text-sm leading-6 text-gray-300">
                            Our support team is here to help with bookings, payments,
                            cancellations and other questions.
                        </p>

                    </div>


                    <div class="flex flex-col gap-3 sm:flex-row">

                        <a
                            href="{{ route('support.contact') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-semibold text-gray-900 transition hover:bg-gray-100"
                        >

                            Contact Support

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
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

        </section>


        {{-- Support Requests --}}
        <section class="mt-12">

            <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <h2 class="text-xl font-bold text-gray-900">
                        My Support Requests
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Track your previous support conversations.
                    </p>

                </div>

                <a
                    href="{{ route('support.contact') }}"
                    class="text-sm font-semibold text-indigo-600 hover:text-indigo-700"
                >
                    Create New Request
                </a>

            </div>


            <div class="space-y-3">

                @foreach($tickets as $ticket)

                    <a
                        href="{{ route('support.ticket', ['ticket' => $ticket['id']]) }}"
                        class="block rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:border-indigo-200 hover:shadow-md"
                    >

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            <div class="flex min-w-0 items-start gap-4">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">

                                    <svg
                                        class="h-5 w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 10h8M8 14h5"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M20 11.5a8 8 0 01-8 8 7.9 7.9 0 01-3.5-.8L4 20l1.3-4A8 8 0 1120 11.5z"
                                        />
                                    </svg>

                                </div>


                                <div class="min-w-0">

                                    <div class="flex flex-wrap items-center gap-2">

                                        <h3 class="truncate text-sm font-semibold text-gray-900">
                                            {{ $ticket['subject'] }}
                                        </h3>

                                        @if($ticket['status'] === 'Open')

                                            <span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                                Open
                                            </span>

                                        @else

                                            <span class="rounded-full bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-700">
                                                Resolved
                                            </span>

                                        @endif

                                    </div>

                                    <p class="mt-1 text-xs text-gray-500">
                                        {{ $ticket['id'] }}
                                        ·
                                        {{ $ticket['category'] }}
                                        ·
                                        {{ $ticket['date'] }}
                                    </p>

                                </div>

                            </div>


                            <svg
                                class="h-5 w-5 shrink-0 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>

                        </div>

                    </a>

                @endforeach

            </div>

        </section>


        {{-- Bottom Links --}}
        <div class="mt-10 flex flex-col gap-3 border-t border-gray-200 pt-6 sm:flex-row sm:items-center sm:justify-between">

            <a
                href="{{ route('profile') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-indigo-600"
            >

                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Back to Profile

            </a>


            <a
                href="{{ route('booking.index') }}"
                class="text-sm font-semibold text-indigo-600 hover:text-indigo-700"
            >
                View My Bookings →
            </a>

        </div>

    </div>

</div>

@endsection