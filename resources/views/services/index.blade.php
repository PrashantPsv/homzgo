@extends('layouts.app')

@section('title', 'Services | ServiceHub')

@section('content')



{{-- Page Header --}}
<section class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

            <div>

                <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">

                    <a href="{{ route('home') }}"
                       class="hover:text-indigo-600 transition">
                        Home
                    </a>

                    <span>/</span>

                    <span class="text-gray-900">
                        Services
                    </span>

                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
                    Home Services
                </h1>

                <p class="mt-2 text-gray-500">
                    Professional services delivered at your doorstep
                </p>

            </div>

        </div>

    </div>

</section>


{{-- Search --}}
<section class="bg-gray-50 py-6">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">

            <div class="grid grid-cols-1 md:grid-cols-12 gap-3">

                {{-- Location --}}
                <div class="md:col-span-3">

                    <div class="h-full flex items-center gap-3 border border-gray-200 rounded-xl px-4">

                        <svg class="w-5 h-5 text-indigo-600 flex-shrink-0"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>

                        </svg>

                        <div>
                            <div class="text-xs text-gray-400">
                                Location
                            </div>

                            <div class="text-sm font-medium text-gray-900">
                                Ahmedabad
                            </div>
                        </div>

                    </div>

                </div>


                {{-- Search --}}
                <div class="md:col-span-7">

                    <div class="relative">

                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"/>

                        </svg>

                        <input
                            type="text"
                            placeholder="Search for services..."
                            class="w-full h-full min-h-[52px] rounded-xl border border-gray-200 pl-12 pr-4 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                    </div>

                </div>


                {{-- Search Button --}}
                <div class="md:col-span-2">

                    <button
                        type="button"
                        class="w-full h-full min-h-[52px] rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">

                        Search

                    </button>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- Main Content --}}
<section class="bg-gray-50 pb-16">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">


            {{-- FILTER SIDEBAR --}}
            <aside class="hidden lg:block">

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm sticky top-24">

                    <div class="p-5 border-b border-gray-100">

                        <div class="flex items-center justify-between">

                            <h2 class="font-bold text-gray-900">
                                Filters
                            </h2>

                            <button class="text-sm text-indigo-600 hover:text-indigo-700">
                                Clear all
                            </button>

                        </div>

                    </div>


                    {{-- Category --}}
                    <div class="p-5 border-b border-gray-100">

                        <h3 class="font-semibold text-gray-900 mb-4">
                            Category
                        </h3>

                        <div class="space-y-3">

                            @foreach($categories as $category)

                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input
                                        type="checkbox"
                                        class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    >

                                    <span class="text-sm text-gray-600">
                                        {{ $category['name'] }}
                                    </span>

                                </label>

                            @endforeach

                        </div>

                    </div>


                    {{-- Price --}}
                    <div class="p-5 border-b border-gray-100">

                        <h3 class="font-semibold text-gray-900 mb-4">
                            Price
                        </h3>

                        <div class="space-y-3">

                            @foreach([
                                'Under ₹500',
                                '₹500 - ₹1,000',
                                '₹1,000 - ₹2,000',
                                'Above ₹2,000'
                            ] as $price)

                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input
                                        type="checkbox"
                                        class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    >

                                    <span class="text-sm text-gray-600">
                                        {{ $price }}
                                    </span>

                                </label>

                            @endforeach

                        </div>

                    </div>


                    {{-- Rating --}}
                    <div class="p-5">

                        <h3 class="font-semibold text-gray-900 mb-4">
                            Rating
                        </h3>

                        <div class="space-y-3">

                            @foreach([
                                '4.5+',
                                '4.0+',
                                '3.5+'
                            ] as $rating)

                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input
                                        type="checkbox"
                                        class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    >

                                    <span class="flex items-center gap-1 text-sm text-gray-600">

                                        <span class="text-yellow-500">
                                            ★
                                        </span>

                                        {{ $rating }}

                                    </span>

                                </label>

                            @endforeach

                        </div>

                    </div>

                </div>

            </aside>


            {{-- SERVICES --}}
            <div class="lg:col-span-3">

                {{-- Top Bar --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">

                    <div>

                        <h2 class="text-xl font-bold text-gray-900">
                            Popular Services
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ count($services) }} services available
                        </p>

                    </div>


                    <div class="flex items-center gap-3">

                        {{-- Mobile Filter --}}
                        <button
                            type="button"
                            class="lg:hidden inline-flex items-center gap-2 border border-gray-200 bg-white rounded-xl px-4 py-2.5 text-sm font-medium text-gray-700">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M3 4h18M6 10h12M10 16h4"/>

                            </svg>

                            Filters

                        </button>


                        {{-- Sort --}}
                        <select
                            class="rounded-xl border-gray-200 bg-white text-sm text-gray-700 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500">

                            <option>Sort: Popular</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Rating</option>

                        </select>

                    </div>

                </div>


                {{-- Service Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                    @if(empty($services))<div class="col-span-full rounded-2xl border bg-white p-10 text-center text-gray-500">No services are available right now.</div>@endif

                    @foreach($services as $service)

                        <div class="group bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300">

                            {{-- Image --}}
                            <div class="relative">

                                <img
                                    src="{{ $service['image'] }}"
                                    alt="{{ $service['name'] }}"
                                    class="w-full h-52 object-cover group-hover:scale-105 transition duration-500"
                                >


                                {{-- Discount --}}
                                <div class="absolute top-3 left-3">

                                    <span class="rounded-lg bg-green-600 px-2.5 py-1 text-xs font-bold text-white shadow-sm">
                                        {{ $service['discount'] ?? '' }}
                                    </span>

                                </div>


                                {{-- Wishlist --}}
                                <button
                                    type="button"
                                    class="absolute top-3 right-3 w-9 h-9 rounded-full bg-white/95 backdrop-blur flex items-center justify-center text-gray-500 hover:text-red-500 shadow-sm transition">

                                    <svg class="w-5 h-5"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="1.8"
                                              d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 000-7.78z"/>

                                    </svg>

                                </button>

                            </div>


                            {{-- Content --}}
                            <div class="p-5">

                                <div class="text-xs font-medium text-indigo-600 mb-2">
                                    {{ $service['category'] }}
                                </div>


                                <h3 class="text-lg font-bold text-gray-900 line-clamp-1">
                                    {{ $service['name'] }}
                                </h3>


                                {{-- Rating --}}
                                <div class="flex items-center gap-2 mt-2">

                                    <span class="inline-flex items-center gap-1 bg-green-50 text-green-700 rounded-md px-2 py-1 text-xs font-semibold">

                                        ★ {{ $service['rating'] }}

                                    </span>

                                    <span class="text-xs text-gray-400">
                                        {{ number_format((int)($service['reviews'] ?? 0)) }} reviews
                                    </span>

                                </div>


                                {{-- Price --}}
                                <div class="flex items-center gap-2 mt-4">

                                    <span class="text-xl font-bold text-gray-900">
                                        ₹{{ number_format($service['price']) }}
                                    </span>

                                    <span class="text-sm text-gray-400 line-through">
                                        {{ !empty($service['old_price']) ? '₹'.number_format($service['old_price']) : '' }}
                                    </span>

                                </div>


                                {{-- Duration --}}
                                <div class="flex items-center gap-2 mt-2 text-sm text-gray-500">

                                    <svg class="w-4 h-4"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>

                                    </svg>

                                    {{ $service['duration'] ?? 'Duration varies' }}

                                </div>


                                {{-- Action --}}
                                <div class="mt-5">

                                    <a
                                        href="{{ route('services.show', ['service' => $service['id']]) }}"
                                        class="block w-full text-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white hover:bg-indigo-700 transition">

                                        Book Now

                                    </a>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>


                {{-- Pagination --}}
                <div class="flex items-center justify-center gap-2 mt-10">

                    <button
                        class="w-10 h-10 rounded-xl border border-gray-200 bg-white text-gray-400">

                        ←

                    </button>

                    <button
                        class="w-10 h-10 rounded-xl bg-indigo-600 text-white font-semibold">

                        1

                    </button>

                    <button
                        class="w-10 h-10 rounded-xl border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">

                        2

                    </button>

                    <button
                        class="w-10 h-10 rounded-xl border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">

                        3

                    </button>

                    <button
                        class="w-10 h-10 rounded-xl border border-gray-200 bg-white text-gray-700">

                        →

                    </button>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection