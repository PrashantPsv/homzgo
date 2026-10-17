@extends('layouts.app')

@section('title', 'Contact Support | ServiceHub')

@section('content')

<div class="min-h-screen bg-gray-50">

    {{-- Header --}}
    <section class="border-b border-gray-200 bg-white">

        <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">

            <div class="flex items-center gap-2 text-sm text-gray-500">

                <a
                    href="{{ route('support.index') }}"
                    class="hover:text-indigo-600"
                >
                    Help & Support
                </a>

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

                <span class="text-gray-900">
                    Contact Support
                </span>

            </div>

            <h1 class="mt-3 text-2xl font-bold text-gray-900 sm:text-3xl">
                Contact Support
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Tell us what you need help with and our team will assist you.
            </p>

        </div>

    </section>


    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


            {{-- Contact Options --}}
            <div class="space-y-4">

                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

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
                                d="M3 5a2 2 0 012-2h3l2 5-2 2a16 16 0 007 7l2-2 5 2v3a2 2 0 01-2 2C10.82 22 3 14.18 3 5z"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-4 font-semibold text-gray-900">
                        Call Support
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Speak with our support team.
                    </p>

                    <p class="mt-3 text-sm font-semibold text-indigo-600">
                        +91 1800 123 4567
                    </p>

                </div>


                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-50 text-green-600">

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
                                d="M3 5a2 2 0 012-2h3l2 5-2 2a16 16 0 007 7l2-2 5 2v3a2 2 0 01-2 2C10.82 22 3 14.18 3 5z"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-4 font-semibold text-gray-900">
                        WhatsApp
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Chat with our support team.
                    </p>

                    <p class="mt-3 text-sm font-semibold text-green-600">
                        Chat on WhatsApp
                    </p>

                </div>


                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-50 text-purple-600">

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
                                d="M3 8l9 6 9-6"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-4 font-semibold text-gray-900">
                        Email Support
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Send us your question by email.
                    </p>

                    <p class="mt-3 break-all text-sm font-semibold text-purple-600">
                        support@servicehub.example
                    </p>

                </div>

            </div>


            {{-- Form --}}
            <div class="lg:col-span-2">

                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <form>

                        <div class="px-6 py-6 sm:px-8">

                            <h2 class="text-lg font-semibold text-gray-900">
                                Create Support Request
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Please provide as much detail as possible.
                            </p>


                            <div class="mt-6 space-y-5">

                                {{-- Category --}}
                                <div>

                                    <label class="mb-2 block text-sm font-medium text-gray-700">
                                        What do you need help with?
                                    </label>

                                    <select
                                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                    >
                                        <option selected>Booking</option>
                                        <option>Payment</option>
                                        <option>Service</option>
                                        <option>Cancellation & Refund</option>
                                        <option>Account</option>
                                        <option>Other</option>
                                    </select>

                                </div>


                                {{-- Booking --}}
                                <div>

                                    <label class="mb-2 block text-sm font-medium text-gray-700">
                                        Related Booking
                                    </label>

                                    <select
                                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                    >
                                        <option selected>
                                            SH20260929001 — Home Deep Cleaning
                                        </option>

                                        <option>
                                            SH20261002002 — AC Service & Repair
                                        </option>

                                        <option>
                                            This is not related to a booking
                                        </option>
                                    </select>

                                </div>


                                {{-- Subject --}}
                                <div>

                                    <label class="mb-2 block text-sm font-medium text-gray-700">
                                        Subject
                                    </label>

                                    <input
                                        type="text"
                                        value="Question about my upcoming booking"
                                        class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                    >

                                </div>


                                {{-- Message --}}
                                <div>

                                    <label class="mb-2 block text-sm font-medium text-gray-700">
                                        Describe your issue
                                    </label>

                                    <textarea
                                        rows="6"
                                        placeholder="Tell us what happened..."
                                        class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                    ></textarea>

                                    <p class="mt-2 text-xs text-gray-400">
                                        Please do not share passwords, OTPs or other sensitive information.
                                    </p>

                                </div>


                                {{-- Attachments --}}
                                <div>

                                    <label class="mb-2 block text-sm font-medium text-gray-700">
                                        Attachments
                                        <span class="font-normal text-gray-400">
                                            (optional)
                                        </span>
                                    </label>

                                    <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-5 text-center">

                                        <svg
                                            class="mx-auto h-7 w-7 text-gray-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 0115.9 6L16 6a5 5 0 011 9.9M12 12v9m0-9l-3 3m3-3l3 3"
                                            />
                                        </svg>

                                        <p class="mt-2 text-sm text-gray-600">
                                            Upload screenshots or photos
                                        </p>

                                        <button
                                            type="button"
                                            class="mt-2 text-sm font-semibold text-indigo-600 hover:text-indigo-700"
                                        >
                                            Choose File
                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- Footer --}}
                        <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50 px-6 py-5 sm:flex-row sm:justify-end sm:px-8">

                            <a
                                href="{{ route('support.index') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50"
                            >
                                Cancel
                            </a>

                            <button
                                type="button"
                                class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700"
                            >
                                Submit Request
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection