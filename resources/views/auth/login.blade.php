@extends('layouts.app')

@section('title', 'Login | ServiceHub')

@section('content')

<section class="min-h-[calc(100vh-160px)] bg-gray-50 py-10 sm:py-14">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">

            {{-- Left promotional section --}}

            <div class="hidden lg:flex relative bg-indigo-600 p-10 xl:p-14 text-white overflow-hidden">

                <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-32 -left-20 w-80 h-80 rounded-full bg-white/10"></div>

                <div class="relative z-10 flex flex-col justify-between w-full">

                    <div>

                        <div class="flex items-center gap-3">

                            <div class="w-11 h-11 rounded-xl bg-white/15 flex items-center justify-center">

                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 10.5L12 3l9 7.5M5 9v10h14V9M9 19v-6h6v6"
                                    />
                                </svg>

                            </div>

                            <span class="text-xl font-bold">
                                ServiceHub
                            </span>

                        </div>

                        <h1 class="mt-12 text-4xl xl:text-5xl font-bold leading-tight">
                            Your home,<br>
                            taken care of.
                        </h1>

                        <p class="mt-5 text-indigo-100 leading-7 max-w-md">
                            Book trusted professionals for cleaning, repairs,
                            beauty and other home services — all in one place.
                        </p>

                    </div>


                    <div class="mt-12 space-y-5">

                        <div class="flex items-center gap-4">

                            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">

                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>

                            </div>

                            <div>
                                <p class="font-semibold">Verified Professionals</p>
                                <p class="text-sm text-indigo-200">Trusted service experts</p>
                            </div>

                        </div>


                        <div class="flex items-center gap-4">

                            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">

                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4l3 2"
                                    />
                                    <circle cx="12" cy="12" r="9" stroke-width="2"/>
                                </svg>

                            </div>

                            <div>
                                <p class="font-semibold">Easy Booking</p>
                                <p class="text-sm text-indigo-200">Book at your convenience</p>
                            </div>

                        </div>


                        <div class="flex items-center gap-4">

                            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">

                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z"
                                    />
                                </svg>

                            </div>

                            <div>
                                <p class="font-semibold">Secure Payments</p>
                                <p class="text-sm text-indigo-200">Safe and secure transactions</p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Login form --}}

            <div class="p-6 sm:p-10 lg:p-12 xl:p-14">

                <div class="max-w-md mx-auto">

                    {{-- Mobile logo --}}

                    <div class="lg:hidden flex items-center justify-center gap-2 mb-8">

                        <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 10.5L12 3l9 7.5M5 9v10h14V9M9 19v-6h6v6"
                                />
                            </svg>

                        </div>

                        <span class="text-xl font-bold text-gray-900">
                            ServiceHub
                        </span>

                    </div>


                    <div class="text-center lg:text-left">

                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
                            Welcome back
                        </h2>

                        <p class="mt-2 text-sm text-gray-500">
                            Login to manage your bookings and services.
                        </p>

                    </div>


                    {{-- Social login --}}

                    <div class="mt-8">

                        <button
                            type="button"
                            class="w-full flex items-center justify-center gap-3 rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition"
                        >

                            <svg class="w-5 h-5" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M21.35 12.2c0-.7-.06-1.37-.18-2H12v3.79h5.24a4.48 4.48 0 01-1.94 2.94v2.45h3.14c1.84-1.69 2.91-4.18 2.91-7.18z"/>
                                <path fill="#34A853" d="M12 21.5c2.63 0 4.84-.87 6.45-2.35l-3.14-2.45c-.87.58-1.98.93-3.31.93-2.54 0-4.7-1.72-5.47-4.03H3.28v2.53A9.74 9.74 0 0012 21.5z"/>
                                <path fill="#FBBC05" d="M6.53 13.6A5.85 5.85 0 016.23 12c0-.56.1-1.1.3-1.6V7.87H3.28A9.75 9.75 0 002.25 12c0 1.57.38 3.05 1.03 4.13l3.25-2.53z"/>
                                <path fill="#EA4335" d="M12 6.37c1.43 0 2.71.49 3.72 1.46l2.79-2.79C16.84 3.4 14.63 2.5 12 2.5a9.74 9.74 0 00-8.72 5.37l3.25 2.53C7.3 8.09 9.46 6.37 12 6.37z"/>
                            </svg>

                            Continue with Google

                        </button>

                    </div>


                    {{-- Divider --}}

                    <div class="relative my-7">

                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>

                        <div class="relative flex justify-center">
                            <span class="bg-white px-4 text-xs text-gray-400">
                                OR CONTINUE WITH EMAIL
                            </span>
                        </div>

                    </div>


                    <form>

                        {{-- Email --}}

                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address
                            </label>

                            <div class="relative">

                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">

                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h16v12H4z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-width="2"
                                            d="M4 7l8 5 8-5"
                                        />
                                    </svg>

                                </span>

                                <input
                                    type="email"
                                    value="prashant@example.com"
                                    placeholder="Enter your email"
                                    class="w-full rounded-xl border border-gray-200 bg-white pl-11 pr-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                >

                            </div>

                        </div>


                        {{-- Password --}}

                        <div class="mt-5">

                            <div class="flex items-center justify-between mb-2">

                                <label class="block text-sm font-semibold text-gray-700">
                                    Password
                                </label>

                                <a
                                    href="{{ route('password.request') }}"
                                    class="text-xs font-semibold text-indigo-600 hover:text-indigo-700"
                                >
                                    Forgot password?
                                </a>

                            </div>

                            <div class="relative">

                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">

                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <rect x="4" y="10" width="16" height="11" rx="2" stroke-width="2"/>
                                        <path
                                            stroke-linecap="round"
                                            stroke-width="2"
                                            d="M8 10V7a4 4 0 018 0v3"
                                        />
                                    </svg>

                                </span>

                                <input
                                    type="password"
                                    value="password"
                                    placeholder="Enter your password"
                                    class="w-full rounded-xl border border-gray-200 bg-white pl-11 pr-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                >

                            </div>

                        </div>


                        {{-- Remember --}}

                        <label class="mt-5 flex items-center gap-2 cursor-pointer">

                            <input
                                type="checkbox"
                                checked
                                class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                            >

                            <span class="text-sm text-gray-600">
                                Remember me
                            </span>

                        </label>


                        <button
                            type="button"
                            class="mt-6 w-full rounded-xl bg-indigo-600 px-5 py-3.5 text-sm font-semibold text-white hover:bg-indigo-700 transition shadow-sm"
                        >
                            Login
                        </button>

                    </form>


                    {{-- Register --}}

                    <p class="mt-7 text-center text-sm text-gray-500">

                        Don't have an account?

                        <a
                            href="{{ route('register') }}"
                            class="font-semibold text-indigo-600 hover:text-indigo-700"
                        >
                            Create an account
                        </a>

                    </p>


                    <div class="mt-8 pt-6 border-t border-gray-100 text-center">

                        <a
                            href="{{ url('/') }}"
                            class="text-sm font-medium text-gray-500 hover:text-gray-900"
                        >
                            ← Back to ServiceHub
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection