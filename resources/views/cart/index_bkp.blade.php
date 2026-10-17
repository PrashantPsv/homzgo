@extends('layouts.app')

@section('title', 'Cart & Booking')

@section('content')
@php
    $catalogUser = session('catalog_user');
    $catalogUser = is_array($catalogUser) && array_is_list($catalogUser) ? ($catalogUser[0] ?? null) : $catalogUser;

    // Accept either cart_groups or a flattened list of cart items.
    $rawCartItems = $cartItems ?? [];
    $normalizedCartItems = collect($rawCartItems)
        ->flatMap(function ($entry) {
            $entry = (array) $entry;
            return isset($entry['items']) && is_array($entry['items'])
                ? collect($entry['items'])->map(function ($item) use ($entry) {
                    return array_merge((array) $item, [
                        'sub_category_name' => $entry['sub_category_name'] ?? null,
                        'sub_category_id' => $entry['sub_category_id'] ?? null,
                    ]);
                })->all()
                : [$entry];
        })
        ->map(function ($item) {
            $item = (array) $item;
            $package = (array) ($item['package'] ?? []);
            $price = (float) ($item['unit_price'] ?? $item['price'] ?? 0);
            $quantity = max(1, (int) ($item['quantity'] ?? 1));
            return array_merge($item, [
                'id' => $item['id'] ?? $item['cart_item_id'] ?? null,
                'cart_item_id' => $item['cart_item_id'] ?? $item['id'] ?? null,
                'name' => $item['name'] ?? $package['name'] ?? 'Service',
                'thumbnail_image' => $item['thumbnail_image'] ?? $package['thumbnail_image'] ?? null,
                'pricing_mode' => $item['pricing_mode'] ?? $package['pricing_mode'] ?? 'fixed',
                'price' => $price,
                'quantity' => $quantity,
                'selections' => $item['selections'] ?? [],
                'loading' => false,
            ]);
        })->values()->all();
@endphp

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@if(session('catalog_auth_token'))
<div
    x-data="cartCheckout({ initialCart: @js($normalizedCartItems), guestToken: @js($guestToken ?? null),selectedLocation: @js($selectedLocation ?? session('catalog_location')) })"
    x-init="init()"
    class="min-h-screen bg-gray-50"
>
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- Page Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Your Cart
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Review your services and complete your booking.
            </p>
        </div>

        {{-- Empty Cart --}}
        <template x-if="!loading && cart.length === 0">
            <div class="rounded-2xl border border-gray-200 bg-white p-12 text-center shadow-sm">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gray-100">
                    <svg
                        class="h-8 w-8 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 2h13m-9 4a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"
                        />
                    </svg>
                </div>

                <h2 class="mt-5 text-xl font-bold text-gray-900">
                    Your cart is empty
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Add a service to continue.
                </p>

                <a
                    href="{{ url('/') }}"
                    class="mt-6 inline-flex rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-700"
                >
                    Browse Services
                </a>
            </div>
        </template>


        <div x-show="cartError" x-cloak x-text="cartError" role="alert"
             class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700"></div>

        {{-- Main Checkout --}}
        <template x-if="!loading && cart.length > 0">
            <div class="grid gap-6 lg:grid-cols-3">

                {{-- LEFT --}}
                <div class="space-y-5 lg:col-span-2">


                    {{-- ================= SERVICES ================= --}}
                    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">

                        <div class="border-b border-gray-100 px-5 py-4">
                            <div class="flex items-center justify-between">

                                <div>
                                    <h2 class="font-bold text-gray-900">
                                        Selected Services
                                    </h2>

                                    <p class="mt-1 text-xs text-gray-500">
                                        <span x-text="cartCount"></span>
                                        item(s)
                                    </p>
                                </div>

                            </div>
                        </div>


                        <div class="divide-y divide-gray-100">

                            <template
                                x-for="item in cart"
                                :key="item.id"
                            >

                                <div class="p-5">

                                    <div class="flex gap-4">

                                        {{-- Image --}}
                                        <div class="h-24 w-24 shrink-0 overflow-hidden rounded-xl bg-gray-100">

                                            <template x-if="item.thumbnail_image">
                                                <img
                                                    :src="item.thumbnail_image"
                                                    :alt="item.name"
                                                    class="h-full w-full object-cover"
                                                >
                                            </template>

                                            <template x-if="!item.thumbnail_image">
                                                <div class="flex h-full items-center justify-center text-gray-400">

                                                    <svg
                                                        class="h-8 w-8"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="1.8"
                                                            d="M5 3v18M19 3v18M5 8h14M5 16h14"
                                                        />
                                                    </svg>

                                                </div>
                                            </template>

                                        </div>


                                        {{-- Details --}}
                                        <div class="min-w-0 flex-1">

                                            <div class="flex items-start justify-between gap-4">

                                                <div>
                                                    <h3
                                                        class="font-semibold text-gray-900"
                                                        x-text="item.name"
                                                    ></h3>

                                                    <p x-show="item.sub_category_name" x-text="item.sub_category_name"
                                                       class="mt-1 text-xs font-semibold uppercase tracking-wide text-indigo-600"></p>
                                                    <template x-if="Array.isArray(item.selections) && item.selections.length">
                                                        <div class="mt-2 flex flex-wrap gap-1.5">
                                                            <template x-for="(selection, selectionIndex) in item.selections" :key="selection.id ?? selectionIndex">
                                                                <span class="rounded-md bg-indigo-50 px-2 py-1 text-xs text-indigo-700"
                                                                      x-text="selection.option_label || selection.option?.label || selection.label || selection.value || 'Selected option'"></span>
                                                            </template>
                                                        </div>
                                                    </template>
                                                    <p class="mt-1 text-sm text-gray-500">
                                                        ₹<span
                                                            x-text="Number(item.price).toFixed(2)"
                                                        ></span>
                                                        per item
                                                    </p>
                                                </div>

                                                <p class="font-bold text-gray-900">
                                                    ₹<span
                                                        x-text="(
                                                            Number(item.price) *
                                                            Number(item.quantity)
                                                        ).toFixed(2)"
                                                    ></span>
                                                </p>

                                            </div>


                                            {{-- Quantity --}}
                                            <div class="mt-4 flex items-center">

                                                <div class="flex items-center overflow-hidden rounded-lg border border-gray-200">

                                                    <button
                                                        type="button"
                                                        @click="decrease(item)"
                                                        :disabled="item.loading"
                                                        class="flex h-9 w-9 items-center justify-center text-lg font-bold text-gray-600 hover:bg-gray-50 disabled:opacity-50"
                                                    >
                                                        −
                                                    </button>

                                                    <span
                                                        class="flex h-9 min-w-[40px] items-center justify-center text-sm font-semibold"
                                                        x-text="item.quantity"
                                                    ></span>

                                                    <button
                                                        type="button"
                                                        @click="increase(item)"
                                                        :disabled="item.loading"
                                                        class="flex h-9 w-9 items-center justify-center text-lg font-bold text-gray-600 hover:bg-gray-50 disabled:opacity-50"
                                                    >
                                                        +
                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </template>

                        </div>

                    </div>

                    {{-- Selected service area from header session --}}
                    <div x-show="selectedLocation?.address" x-cloak
                         class="rounded-2xl border border-indigo-200 bg-indigo-50/50 p-5">
                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-600 text-white">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M12 21s8-4.5 8-10a8 8 0 10-16 0c0 5.5 8 10 8 10z"/><circle cx="12" cy="11" r="2.5" stroke-width="1.8"/></svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="font-bold text-gray-900">Selected Service Location</h3>
                                <p class="mt-2 text-sm text-gray-700" x-text="selectedLocation?.address || ''"></p>
                                <p class="mt-1 text-xs text-gray-500">Pincode: <span x-text="selectedLocation?.pincode || 'Not available'"></span></p>
                                <p class="mt-2 text-xs text-indigo-600">Services and pricing are based on this location.</p>
                            </div>
                            <button type="button" @click.stop="openEditAddress(selectedLocation)" class="rounded-lg border border-indigo-200 px-3 py-1 text-xs font-semibold text-indigo-600 hover:bg-indigo-50">Edit</button>
                        </div>
                    </div>

                    {{-- Saved booking addresses (separate from service area) --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                        <div class="mb-4 flex items-center justify-between gap-3">
                            <h2 class="font-bold text-gray-900">Saved Addresses</h2>
                            <button type="button" @click="openAddAddress()"
                                    class="text-sm font-semibold text-indigo-600 hover:underline">+ Add New Address</button>
                        </div>
                        <p x-show="addressLoading" class="text-sm text-gray-500">Loading saved addresses...</p>
                        <div x-show="addressError" x-cloak class="mb-3 rounded-xl border border-amber-200 bg-amber-50 p-3 text-sm text-amber-800">
                            <span x-text="addressError"></span>
                        </div>
                        <div x-show="!addressLoading && addresses.length === 0" x-cloak class="text-sm text-gray-500">
                            No saved addresses found. Add a booking address to continue.
                        </div>
                        <div x-show="!addressLoading && addresses.length > 0" x-cloak class="space-y-3">
                            <template x-for="item in addresses" :key="item.id">
                                <div role="button" tabindex="0" @click="selectAddress(item)" @keydown.enter="selectAddress(item)"
                                        class="w-full cursor-pointer rounded-xl border p-4 text-left transition"
                                        :class="String(address?.id ?? '') === String(item.id) ? 'border-indigo-600 bg-indigo-50' : 'border-gray-200 hover:border-indigo-300'">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="font-semibold text-gray-900" x-text="item.type || item.label || 'Address'"></span>
                                        <div class="flex items-center gap-3">
                                            <span x-show="String(address?.id ?? '') === String(item.id)" class="text-xs font-semibold text-indigo-600">Selected</span>
                                            <button type="button" @click.stop="openEditAddress(item)" class="rounded-lg border border-indigo-200 px-3 py-1 text-xs font-semibold text-indigo-600 hover:bg-indigo-50">Edit</button>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600" x-text="item.address || item.address_line1 || ''"></p>
                                    <p class="mt-1 text-xs text-gray-500" x-text="[item.city, item.pincode].filter(Boolean).join(' · ')"></p>
                                </div>
                            </template>
                        </div>
                        <p x-show="selectedLocation?.pincode && address?.pincode && String(selectedLocation.pincode) !== String(address.pincode)"
                           x-cloak class="mt-3 text-xs text-amber-700">
                            Booking address pincode differs from the selected service location. Choose a matching address or update your service location before payment.
                        </p>
                    </div>
                    {{-- ================= DATE & TIME ================= --}}
                    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">

                        <div class="border-b border-gray-100 px-5 py-4">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-9 w-9 items-center justify-center rounded-full"
                                    :class="
                                        date && time
                                            ? 'bg-green-100 text-green-600'
                                            : 'bg-indigo-100 text-indigo-600'
                                    "
                                >
                                    <span
                                        x-show="date && time"
                                        class="font-bold"
                                    >
                                        ✓
                                    </span>

                                    <span
                                        x-show="!date || !time"
                                        class="font-bold"
                                    >
                                        2
                                    </span>
                                </div>

                                <div>

                                    <h2 class="font-bold text-gray-900">
                                        Date & Time
                                    </h2>

                                    <p
                                        x-show="date && time"
                                        class="text-xs text-gray-500"
                                        x-text="formattedDate + ' · ' + time"
                                    ></p>

                                    <p
                                        x-show="!date || !time"
                                        class="text-xs text-gray-500"
                                    >
                                        Choose your preferred service time
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="p-5">

                            {{-- Dates --}}
                            <h3 class="text-sm font-semibold text-gray-900">
                                Select Date
                            </h3>

                            <div class="mt-3 grid grid-cols-3 gap-3 sm:grid-cols-5">

                                <template
                                    x-for="day in availableDates"
                                    :key="day.value"
                                >

                                    <button
                                        type="button"
                                        @click="selectDate(day.value)"
                                        class="rounded-xl border px-3 py-3 text-center transition"
                                        :class="
                                            date === day.value
                                                ? 'border-indigo-600 bg-indigo-600 text-white'
                                                : 'border-gray-200 hover:border-indigo-300'
                                        "
                                    >

                                        <span
                                            class="block text-xs"
                                            x-text="day.day"
                                        ></span>

                                        <span
                                            class="mt-1 block text-lg font-bold"
                                            x-text="day.number"
                                        ></span>

                                        <span
                                            class="block text-xs"
                                            x-text="day.month"
                                        ></span>

                                    </button>

                                </template>

                            </div>


                            {{-- Time --}}
                            <h3 class="mt-6 text-sm font-semibold text-gray-900">
                                Select Time
                            </h3>

                            <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-4">

                                <template
                                    x-for="slot in timeSlots"
                                    :key="slot"
                                >

                                    <button
                                        type="button"
                                        @click="time = slot"
                                        class="rounded-xl border px-4 py-3 text-sm font-medium transition"
                                        :class="
                                            time === slot
                                                ? 'border-indigo-600 bg-indigo-600 text-white'
                                                : 'border-gray-200 text-gray-700 hover:border-indigo-300'
                                        "
                                        x-text="slot"
                                    ></button>

                                </template>

                            </div>

                        </div>

                    </div>


                    {{-- ================= CUSTOMER DETAILS ================= --}}
                    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">

                        <div class="border-b border-gray-100 px-5 py-4">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-9 w-9 items-center justify-center rounded-full"
                                    :class="
                                        customer.name && customer.phone
                                            ? 'bg-green-100 text-green-600'
                                            : 'bg-indigo-100 text-indigo-600'
                                    "
                                >

                                    <span
                                        x-show="customer.name && customer.phone"
                                        class="font-bold"
                                    >
                                        ✓
                                    </span>

                                    <span
                                        x-show="!customer.name || !customer.phone"
                                        class="font-bold"
                                    >
                                        3
                                    </span>

                                </div>

                                <div>

                                    <h2 class="font-bold text-gray-900">
                                        Customer Details
                                    </h2>

                                    <p class="text-xs text-gray-500">
                                        Enter your contact details
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="p-5">

                            <div class="grid gap-5 sm:grid-cols-2">

                                {{-- Name --}}
                                <div>

                                    <label class="text-sm font-semibold text-gray-700">
                                        Full Name
                                    </label>

                                    <input
                                        type="text"
                                        x-model="customer.name"
                                        placeholder="Enter your name"
                                        class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                    >

                                </div>


                                {{-- Phone --}}
                                <div>

                                    <label class="text-sm font-semibold text-gray-700">
                                        Phone Number
                                    </label>

                                    <input
                                        type="tel"
                                        x-model="customer.phone"
                                        placeholder="Enter phone number"
                                        class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                    >

                                </div>


                                {{-- Email --}}
                                <div class="sm:col-span-2">

                                    <label class="text-sm font-semibold text-gray-700">
                                        Email Address
                                    </label>

                                    <input
                                        type="email"
                                        x-model="customer.email"
                                        placeholder="Enter email address"
                                        class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                    >

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================= RIGHT SUMMARY ================= --}}
                <div>

                    <div class="sticky top-24 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                        <h2 class="text-lg font-bold text-gray-900">
                            Order Summary
                        </h2>


                        {{-- Items --}}
                        <div class="mt-5 space-y-4">

                            <template
                                x-for="item in cart"
                                :key="item.id"
                            >

                                <div class="flex justify-between gap-4 text-sm">

                                    <div class="min-w-0">

                                        <p
                                            class="font-medium text-gray-900"
                                            x-text="item.name"
                                        ></p>

                                        <p class="mt-1 text-gray-500">
                                            Qty:
                                            <span x-text="item.quantity"></span>
                                        </p>

                                    </div>

                                    <span class="shrink-0 font-medium text-gray-900">
                                        ₹<span
                                            x-text="(
                                                Number(item.price) *
                                                Number(item.quantity)
                                            ).toFixed(2)"
                                        ></span>
                                    </span>

                                </div>

                            </template>

                        </div>


                        <div class="my-5 border-t"></div>


                        {{-- Address Summary --}}
                        <div x-show="address">

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Service Address
                            </p>

                            <p
                                class="mt-2 text-sm font-semibold text-gray-900"
                                x-text="address?.type"
                            ></p>

                            <p
                                class="mt-1 text-sm leading-5 text-gray-500"
                                x-text="[
                                    address?.address,
                                    address?.area,
                                    address?.city,
                                    address?.pincode
                                ].filter(Boolean).join(', ')"
                            ></p>

                        </div>


                        {{-- Date Summary --}}
                        <div
                            x-show="date && time"
                            class="mt-5"
                        >

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Service Time
                            </p>

                            <p
                                class="mt-2 text-sm font-semibold text-gray-900"
                                x-text="formattedDate"
                            ></p>

                            <p
                                class="mt-1 text-sm text-gray-500"
                                x-text="time"
                            ></p>

                        </div>


                        <div class="my-5 border-t"></div>


                        {{-- Total --}}
                        <div class="flex items-center justify-between">

                            <span class="font-bold text-gray-900">
                                Total
                            </span>

                            <span class="text-xl font-bold text-gray-900">
                                ₹<span x-text="cartTotal.toFixed(2)"></span>
                            </span>

                        </div>


                        {{-- Validation --}}
                        <div
                            x-show="!isCheckoutComplete"
                            class="mt-4 rounded-xl bg-amber-50 p-3 text-xs leading-5 text-amber-700"
                        >
                            Please complete:

                            <ul class="mt-1 list-inside list-disc">

                                <li x-show="!address">
                                    Service address
                                </li>

                                <li x-show="!date || !time">
                                    Date & time
                                </li>

                                <li x-show="!customer.name || !customer.phone">
                                    Customer details
                                </li>

                            </ul>
                        </div>


                        {{-- Payment Button --}}
                        <button
                            type="button"
                            @click="proceedToPayment()"
                            :disabled="paymentLoading"
                            class="w-full rounded-xl bg-black px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-800 disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            <template x-if="!paymentLoading">
                                <span>
                                    Proceed to Payment
                                </span>
                            </template>

                            <template x-if="paymentLoading">
                                <span class="flex items-center justify-center gap-2">
                                    <svg
                                        class="h-5 w-5 animate-spin"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                    >
                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="10"
                                            stroke="currentColor"
                                            stroke-width="4"
                                            class="opacity-25"
                                        ></circle>

                                        <path
                                            d="M4 12a8 8 0 018-8"
                                            stroke="currentColor"
                                            stroke-width="4"
                                        ></path>
                                    </svg>

                                    Processing...
                                </span>
                            </template>
                        </button>

                    </div>

                </div>

            </div>
        </template>

    </div>

<div x-show="addressModalOpen" x-cloak @keydown.escape.window="addressModalOpen = false"
     class="fixed inset-0 z-[120] flex items-center justify-center bg-black/60 p-3 sm:p-6">
    <div class="absolute inset-0" @click="addressModalOpen = false"></div>
    <div role="dialog" aria-modal="true" aria-label="Address form"
         class="relative z-10 flex max-h-[92vh] w-full max-w-2xl flex-col overflow-hidden rounded-3xl bg-white shadow-2xl"
         @click.stop>
        <div class="flex items-center justify-between border-b px-5 py-4 sm:px-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-indigo-500">Service address</p>
                <h2 class="mt-1 text-xl font-bold text-gray-900" x-text="editingAddressId ? 'Edit address' : 'Add address'"></h2>
            </div>
            <button type="button" @click="addressModalOpen = false" aria-label="Close" class="rounded-full p-2 text-gray-500 hover:bg-gray-100">✕</button>
        </div>
        <form @submit.prevent="saveAddress()" class="min-h-0 overflow-y-auto p-5 sm:p-6">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <label class="block text-sm font-semibold text-gray-800">Type
                    <select x-model="addressForm.type" required class="mt-2 w-full rounded-xl border border-gray-200 bg-white px-4 py-3 font-normal outline-none focus:border-indigo-500">
                        <option value="home">Home</option><option value="work">Work</option><option value="other">Other</option>
                    </select>
                </label>
                <label class="block text-sm font-semibold text-gray-800">Pincode
                    <input x-model="addressForm.pincode" required inputmode="numeric" maxlength="10" pattern="[0-9]{4,10}" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 font-normal outline-none focus:border-indigo-500" placeholder="Pincode">
                </label>
                <label class="block text-sm font-semibold text-gray-800 sm:col-span-2">Address
                    <textarea x-model="addressForm.address" required rows="3" class="mt-2 w-full resize-y rounded-xl border border-gray-200 px-4 py-3 font-normal outline-none focus:border-indigo-500" placeholder="House / flat, street, locality"></textarea>
                </label>
                <label class="block text-sm font-semibold text-gray-800">Landmark
                    <input x-model="addressForm.landmark" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 font-normal outline-none focus:border-indigo-500">
                </label>
                <label class="block text-sm font-semibold text-gray-800">Floor
                    <input x-model="addressForm.floor" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 font-normal outline-none focus:border-indigo-500">
                </label>
                <label class="block text-sm font-semibold text-gray-800">City
                    <input x-model="addressForm.city"  class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 font-normal outline-none focus:border-indigo-500">
                </label>
                <label class="block text-sm font-semibold text-gray-800">State
                    <input x-model="addressForm.state"  class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 font-normal outline-none focus:border-indigo-500">
                </label>
                <label class="block text-sm font-semibold text-gray-800 sm:col-span-2">Instructions
                    <textarea x-model="addressForm.instructions" rows="2" class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 font-normal outline-none focus:border-indigo-500"></textarea>
                </label>
                <input type="hidden" name="latitude" x-model="addressForm.latitude" >
                <input type="hidden" name="longitude" x-model="addressForm.longitude" >
            </div>
            <label class="mt-5 flex items-center gap-2 text-sm text-gray-700">
                <input type="checkbox" x-model="addressForm.is_default" class="h-4 w-4 accent-indigo-600"> Set as default
            </label>
            <p x-show="addressFormError" x-text="addressFormError" role="alert" class="mt-4 rounded-xl bg-red-50 p-3 text-sm text-red-700"></p>
            <div class="mt-6 flex justify-end gap-3 border-t pt-5">
                <button type="button" @click="addressModalOpen = false" class="rounded-xl border px-5 py-3 text-sm font-semibold text-gray-700">Cancel</button>
                <button type="submit" :disabled="addressSaving" class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white disabled:opacity-50" x-text="addressSaving ? 'Saving...' : (editingAddressId ? 'Update Address' : 'Save Address')"></button>
            </div>
        </form>
    </div>
</div>
</div> {{-- End cartCheckout Alpine scope --}}
@else
<div
    x-data="cartCheckout({ initialCart: @js($normalizedCartItems), guestToken: @js($guestToken ?? null),selectedLocation: @js($selectedLocation ?? session('catalog_location')) })"
    x-init="init()"
    class="min-h-screen bg-gray-50"
>
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- Page Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Your Cart
            </h1>
            <p>
                To book the service, please login or sign up
            </p>
            <button
                onclick="window.dispatchEvent(new CustomEvent('open-login'))"
                class="mt-4 block rounded-xl border border-dashed border-indigo-300 p-3 text-center text-sm font-semibold text-indigo-600 transition hover:bg-indigo-50"
            >
                Login
            </button>
        </div>
    </div>
</div>
@endif

@endsection


@push('scripts')
<script>
function cartCheckout(config = {}) {
    return {

        loading: true,
        cartError: '',

        cart: (config.initialCart || []).map(item => ({...item})),

        guestToken: config.guestToken || null,

        selectedLocation: config.selectedLocation || null,

        // =========================
        // ADDRESS
        // =========================

        address: null,

        addresses: [],
        addressLoading: false,
        addressError: null,


        // =========================
        // DATE / TIME
        // =========================

        date: '',
        time: '',

        availableDates: [],

        timeSlots: [
            '09:00 AM',
            '10:00 AM',
            '11:00 AM',
            '12:00 PM',
            '01:00 PM',
            '02:00 PM',
            '03:00 PM',
            '04:00 PM',
            '05:00 PM',
            '06:00 PM',
        ],


        // =========================
        // CUSTOMER
        // =========================

        customer: {
            name: '',
            phone: '',
            email: '',
        },


        addressModalOpen: false,
        editingAddressId: null,
        addressSaving: false,
        addressFormError: '',
        // Set these URLs to the actual POST/PUT routes from your address controller.
        addressStoreUrl: '/profile/addresses',
        addressUpdateUrl: id => `/profile/addresses/${encodeURIComponent(id)}`,

        addressForm: {
            type: 'home',
            address: '',
            latitude: '',
            longitude: '',
            landmark: '',
            floor: '',
            instructions: '',
            is_default: false,
        },

        paymentLoading: false,

        // =========================
        // INIT
        // =========================

        init() {

            this.loadGuestToken();
            // Initial cart is server-sourced; never overwrite it with localStorage.
            this.cart = this.cart.map(item => ({ ...item, loading: false }));

            this.loadSavedBookingData();

            this.generateDates();

            this.loadAddresses();

            this.loading = false;
        },



        matchSelectedLocationAddress() {
            if (!this.selectedLocation || !this.addresses.length) {
                return false;
            }

            const location = this.selectedLocation;

            // Match by saved address ID if available
            if (location.id != null) {
                const matched = this.addresses.find(
                    item => String(item.id) === String(location.id)
                );

                if (matched) {
                    this.selectAddress(matched);
                    return true;
                }
            }

            // Match exact normalized address
            const normalize = value =>
                String(value || '')
                    .trim()
                    .toLowerCase()
                    .replace(/\s+/g, ' ');

            const locationAddress = normalize(location.address);

            if (!locationAddress) return false;

            const matched = this.addresses.find(
                item => normalize(item.address) === locationAddress
            );

            if (matched) {
                this.selectAddress(matched);
                return true;
            }

            return false;
        },

        // =========================
        // CART
        // =========================

        loadCart() {

            try {

                const savedCart =
                    localStorage.getItem('servicehub_cart');

                this.cart = savedCart
                    ? JSON.parse(savedCart)
                    : [];

            } catch (error) {

                console.error(
                    'Cart load error:',
                    error
                );

                this.cart = [];
            }
        },

        emptyAddressForm() {
            return {
                type: 'home',
                pincode: this.selectedLocation?.pincode || '',
                address: '', landmark: '', floor: '', city: '', state: '',
                instructions: '', is_default: false,
                latitude: this.selectedLocation?.latitude ?? null,
                longitude: this.selectedLocation?.longitude ?? null,
            };
        },

        openAddAddress() {
            this.editingAddressId = null;
            this.addressFormError = '';
            this.addressForm = this.emptyAddressForm();
            this.addressModalOpen = true;
        },

        openEditAddress(item) {
            this.editingAddressId = item.id;
            this.addressFormError = '';
            this.addressForm = {
                type: String(item.type || 'home').toLowerCase(),
                pincode: String(item.pincode || ''),
                address: item.address || item.address_line1 || '',
                landmark: item.landmark || '', floor: item.floor || '',
                city: item.city || '', state: item.state || '',
                instructions: item.instructions || '',
                is_default: Boolean(Number(item.is_default) || item.is_default === true),
                latitude: item.latitude ?? null,
                longitude: item.longitude ?? null,
            };
            this.addressModalOpen = true;
        },

        async saveAddress() {
            if (this.addressSaving) return;
            this.addressSaving = true;
            this.addressFormError = '';
            const editing = (this.editingAddressId !== null && this.editingAddressId !== undefined);

            const payload = {
                ...this.addressForm,

                latitude: this.addressForm.latitude == null ||
                          this.addressForm.latitude === ''
                    ? null
                    : String(this.addressForm.latitude),

                longitude: this.addressForm.longitude == null ||
                           this.addressForm.longitude === ''
                    ? null
                    : String(this.addressForm.longitude)
            };

            const url = editing ? this.addressUpdateUrl(this.editingAddressId) : this.addressStoreUrl;
            try {
                const response = await fetch(url, {
                    method: editing ? 'PUT' : 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    },
                    body: JSON.stringify(payload),
                });
                const result = await response.json().catch(() => ({}));
                if (!response.ok || result.status === false || result.success === false) {
                    const firstError = result.errors ? Object.values(result.errors)[0]?.[0] : null;
                    throw new Error(firstError || result.message || 'Unable to save address.');
                }
                this.addressModalOpen = false;
                await this.loadAddresses();
                const savedId = result.data?.id ?? result.data?.address?.id ?? this.editingAddressId;
                if (savedId != null) {
                    const saved = this.addresses.find(a => String(a.id) === String(savedId));
                    if (saved) this.selectAddress(saved);
                }
            } catch (error) {
                this.addressFormError = error.message || 'Unable to save address.';
            } finally {
                this.addressSaving = false;
            }
        },

        async proceedToPayment() {
            
            if (this.paymentLoading) {
                return;
            }

            /*
             * Basic validation
             */

            if (!this.customer.name) {
                alert('Please enter your name.');
                return;
            }

            if (!this.customer.phone) {
                alert('Please enter your phone number.');
                return;
            }

            if (!this.address) {
                alert('Please select a service address.');
                return;
            }

            if (this.selectedLocation?.pincode && this.address?.pincode &&
                String(this.selectedLocation.pincode) !== String(this.address.pincode)) {
                alert('Your booking address pincode differs from your selected service location. Please choose a matching address.');
                return;
            }

            if (!this.date) {
                alert('Please select a service date.');
                return;
            }

            if (!this.time) {
                alert('Please select a service time.');
                return;
            }


            /*
             * Check cart
             */

            if (!this.cartTotal || Number(this.cartTotal) <= 0) {

                alert('Your cart is empty.');

                return;
            }


            this.paymentLoading = true;


            try {

                /*
                 * Create Razorpay Order
                 */

                const response = await fetch(
                    "{{ route('payment.create') }}",
                    {
                        method: "POST",

                        headers: {
                            "Content-Type": "application/json",

                            "Accept": "application/json",

                            "X-CSRF-TOKEN":
                                document
                                    .querySelector(
                                        'meta[name="csrf-token"]'
                                    )
                                    .getAttribute('content')
                        },

                        body: JSON.stringify({

                            /*
                             * Temporary.
                             *
                             * SECURITY: Laravel MUST recalculate the amount
                             * from the authenticated/guest server-side cart.
                             * Do not trust this client-submitted amount.
                             */
                            amount: Number(this.cartTotal)

                        })
                    }
                );


                const data = await response.json();


                if (!response.ok || !data.success) {

                    throw new Error(
                        data.message ||
                        'Unable to create payment order.'
                    );
                }


                /*
                 * Razorpay Checkout Options
                 */

                const options = {

                    key: data.key,

                    amount: data.amount,

                    currency: data.currency,

                    name: "HOMZgo",

                    description: "Service Booking",

                    order_id: data.order_id,


                    /*
                     * Customer information
                     */

                    prefill: {

                        name:
                            this.customer.name || '',

                        email:
                            this.customer.email || '',

                        contact:
                            this.customer.phone || ''

                    },


                    /*
                     * Payment success
                     */

                    handler: async (paymentResponse) => {

                        console.log(
                            'Razorpay Payment Response:',
                            paymentResponse
                        );

                        await this.verifyPayment(
                            paymentResponse
                        );
                    },


                    /*
                     * Checkout closed
                     */

                    modal: {

                        ondismiss: () => {

                            console.log(
                                'Razorpay checkout closed'
                            );

                            this.paymentLoading = false;

                        }

                    },


                    /*
                     * Theme
                     */

                    theme: {

                        color: "#111827"

                    }

                };


                /*
                 * Create Razorpay instance
                 */

                const razorpay = new Razorpay(options);


                /*
                 * Payment failed
                 */

                razorpay.on(
                    'payment.failed',
                    (response) => {

                        console.error(
                            'Razorpay Payment Failed:',
                            response.error
                        );


                        this.paymentLoading = false;


                        alert(
                            response.error.description ||
                            'Payment failed. Please try again.'
                        );

                    }
                );


                /*
                 * Open Razorpay
                 */

                razorpay.open();


            } catch (error) {

                console.error(
                    'Payment Error:',
                    error
                );


                alert(
                    error.message ||
                    'Unable to start payment.'
                );


                this.paymentLoading = false;
            }
        },


        /**
         * Verify payment with Laravel
         */

        async verifyPayment(paymentResponse) {
            try {
                
                const response = await fetch(
                    "{{ route('payment.verify') }}",
                    {
                        method: "POST",

                        headers: {

                            "Content-Type":
                                "application/json",

                            "Accept":
                                "application/json",

                            "X-CSRF-TOKEN":
                                document
                                    .querySelector(
                                        'meta[name="csrf-token"]'
                                    )
                                    .getAttribute('content')

                        },

                        body: JSON.stringify({

                            razorpay_order_id:
                                paymentResponse.razorpay_order_id,

                            razorpay_payment_id:
                                paymentResponse.razorpay_payment_id,

                            razorpay_signature:
                                paymentResponse.razorpay_signature,

                            address_id:this.address.id,

                            slots: Object.fromEntries(this.cart.map(item => [
                                String(item.id || item.package_id),
                                { slot_date: this.date, slot_time: convertTo24Hour(this.time) }
                            ]))

                        })
                    }
                );


                const data =
                    await response.json();


                if (
                    !response.ok ||
                    !data.success
                ) {

                    throw new Error(
                        data.message ||
                        'Payment verification failed.'
                    );

                }


                /*
                 * Payment successfully verified
                 */

                console.log(
                    'Payment Verified Successfully'
                );


                /*
                 * Redirect
                 */

                window.location.href =
                    data.redirect;


            } catch (error) {

                console.error(
                    'Payment Verification Error:',
                    error
                );


                alert(
                    error.message ||
                    'Payment verification failed.'
                );


                this.paymentLoading = false;
            }
        },
        
        async loadAddresses() {
            this.addressLoading = true;
            this.addressError = null;
            try {
                const response = await fetch('{{ route('cart.addresses') }}', {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    credentials: 'same-origin'
                });
                const result = await response.json();
                if (response.status === 401) {
                    this.addresses = [];
                    this.address = null;
                    this.addressError = 'Please login to continue.';
                    return;
                }
                if (!response.ok || result.status === false) {
                    throw new Error(result.message || 'Unable to load saved addresses.');
                }
                // Supports both {data:[...]} and {data:{addresses:[...]}}.
                const data = result.data;
                this.addresses = Array.isArray(data) ? data
                    : Array.isArray(data?.addresses) ? data.addresses
                    : Array.isArray(data?.data) ? data.data : [];

                // Avoid retaining an address that is no longer in the server list.
                const previouslySelectedId = this.address?.id;
                this.address = null;
                if (!this.matchSelectedLocationAddress() && previouslySelectedId != null) {
                    const previous = this.addresses.find(a => String(a.id) === String(previouslySelectedId));
                    if (previous && (!this.selectedLocation?.pincode ||
                        String(previous.pincode ?? '') === String(this.selectedLocation.pincode))) {
                        this.selectAddress(previous);
                    }
                }
                // Do not silently select a default address from a different service pincode.
            } catch (error) {
                console.error('Address loading error:', error);
                this.addressError = error.message || 'Unable to load addresses.';
            } finally {
                this.addressLoading = false;
            }
        },

        loadGuestToken() {
            if (!this.guestToken) {
                this.guestToken = localStorage.getItem('servicehub_guest_token');
            }
            if (this.guestToken) {
                localStorage.setItem('servicehub_guest_token', this.guestToken);
            }
        },


        saveCart() {

            localStorage.setItem(
                'servicehub_cart',
                JSON.stringify(this.cart)
            );
        },


        // =========================
        // CART QUANTITY
        // =========================

        async increase(item) {

            const quantity =
                Number(item.quantity) + 1;

            await this.updateCartQuantity(
                item,
                quantity
            );
        },


        async decrease(item) {

            const quantity =
                Number(item.quantity);

            if (quantity <= 1) {

                await this.removeCartItem(item);

                return;
            }

            await this.updateCartQuantity(
                item,
                quantity - 1
            );
        },


        async updateCartQuantity(
            item,
            quantity
        ) {

            if (item.loading) return;
            item.loading = true;
            this.cartError = '';

            try {

                const response = await fetch(
                    `/cart/items/${item.cart_item_id || item.id}`,
                    {
                        method: 'PUT',

                        headers: {
                            'Content-Type':
                                'application/json',

                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest',

                            'X-CSRF-TOKEN':
                                document
                                    .querySelector(
                                        'meta[name="csrf-token"]'
                                    )
                                    ?.getAttribute(
                                        'content'
                                    ) || '',
                        },

                        credentials: 'same-origin',

                        body: JSON.stringify({
                            quantity: Number(quantity),
                            guest_token: this.guestToken,
                            slot_date: this.date || undefined,
                            slot_time: this.time ? convertTo24Hour(this.time) : undefined,
                        }),
                    }
                );


                const result =
                    await response.json();


                if (
                    !response.ok ||
                    !result.status
                ) {

                    throw new Error(
                        result.message ||
                        'Unable to update cart.'
                    );
                }


                item.quantity =
                    Number(quantity);

                window.dispatchEvent(new CustomEvent('cart-updated'));
                // Server is the source of truth; no localStorage cart overwrite.

            } catch (error) {

                console.error(
                    'Cart update error:',
                    error
                );

                this.cartError = error.message || 'Unable to update cart.';

            } finally {

                item.loading = false;
            }
        },


        // =========================
        // DELETE CART ITEM
        // =========================

        async removeCartItem(item) {

            if (!item.cart_item_id) {

                console.error(
                    'Cart item ID missing:',
                    item
                );

                alert(
                    'Cart item ID is missing.'
                );

                return;
            }


            item.loading = true;


            try {

                const response = await fetch(
                    `/cart/items/${item.cart_item_id}`,
                    {
                        method: 'DELETE',

                        headers: {
                            'Content-Type':
                                'application/json',

                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest',

                            'X-CSRF-TOKEN':
                                document
                                    .querySelector(
                                        'meta[name="csrf-token"]'
                                    )
                                    ?.getAttribute(
                                        'content'
                                    ) || '',
                        },

                        credentials: 'same-origin',

                        body: JSON.stringify({
                            guest_token:
                                this.guestToken,
                        }),
                    }
                );


                const result =
                    await response.json();


                if (
                    !response.ok ||
                    !result.status
                ) {

                    throw new Error(
                        result.message ||
                        'Unable to remove item.'
                    );
                }


                this.cart =
                    this.cart.filter(
                        cartItem =>
                            Number(cartItem.id) !==
                            Number(item.id)
                    );


                window.dispatchEvent(new CustomEvent('cart-updated'));
                // Server is the source of truth; no localStorage cart overwrite.

            } catch (error) {

                console.error(
                    'Remove cart item error:',
                    error
                );

                this.cartError = error.message || 'Unable to remove item.';

            } finally {

                item.loading = false;
            }
        },


        // =========================
        // ADDRESS
        // =========================

        selectAddress(address) {

            this.address =
                address;


            localStorage.setItem(
                'servicehub_booking_address',
                JSON.stringify(address)
            );
        },


        // =========================
        // DATE
        // =========================

        async selectDate(value) {
            this.date = value;
            this.time = '';
            try {
                const response = await fetch(`{{ route('booking.slots') }}?date=${encodeURIComponent(value)}`, { headers: { 'Accept': 'application/json' }, credentials: 'same-origin' });
                const result = await response.json();
                if (!response.ok || !result.status) throw new Error(result.message || 'Unable to load time slots.');
                const raw = result.data?.slots ?? result.data ?? [];
                this.timeSlots = Array.isArray(raw) ? raw.map(s => typeof s === 'string' ? s : (s.time || s.label || s.start_time)).filter(Boolean) : Object.values(raw).flat().map(s => typeof s === 'string' ? s : (s.time || s.label || s.start_time)).filter(Boolean);
            } catch (error) {
                console.error('Slot loading error:', error);
                this.timeSlots = [];
            }
        },

        generateDates() {

            const today =
                new Date();


            for (
                let i = 0;
                i < 7;
                i++
            ) {

                const date =
                    new Date(today);


                date.setDate(
                    today.getDate() + i
                );


                this.availableDates.push({

                    value:
                        this.formatDate(date),

                    day:
                        date.toLocaleDateString(
                            'en-US',
                            {
                                weekday: 'short'
                            }
                        ),

                    number:
                        date.getDate(),

                    month:
                        date.toLocaleDateString(
                            'en-US',
                            {
                                month: 'short'
                            }
                        ),
                });
            }
        },


        formatDate(date) {

            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },


        // =========================
        // SAVED DATA
        // =========================

        loadSavedBookingData() {

            try {

                const savedAddress =
                    localStorage.getItem(
                        'servicehub_booking_address'
                    );

                if (savedAddress) {

                    this.address =
                        JSON.parse(
                            savedAddress
                        );
                }


                const savedDateTime =
                    localStorage.getItem(
                        'servicehub_booking_datetime'
                    );

                if (savedDateTime) {

                    const data =
                        JSON.parse(
                            savedDateTime
                        );

                    this.date =
                        data.date || '';

                    this.time =
                        data.time || '';
                }


                const savedCustomer = @js($catalogUser);

                if (savedCustomer) {

                    this.customer.name = savedCustomer.name || ''
                    this.customer.phone = savedCustomer.phone_number || savedCustomer.phone || savedCustomer.mobile || ''
                    this.customer.email = savedCustomer.email || ''
                }

            } catch (error) {

                console.error(
                    'Saved booking data error:',
                    error
                );
            }
        },


        // =========================
        // SAVE CHECKOUT DATA
        // =========================

        saveCheckoutData() {

            localStorage.setItem(
                'servicehub_booking_datetime',
                JSON.stringify({
                    date: this.date,
                    time: this.time,
                })
            );


            localStorage.setItem(
                'servicehub_customer',
                JSON.stringify(
                    this.customer
                )
            );


            if (this.address) {

                localStorage.setItem(
                    'servicehub_booking_address',
                    JSON.stringify(
                        this.address
                    )
                );
            }
        },

        // =========================
        // COMPUTED
        // =========================

        get cartCount() {

            return this.cart.reduce(
                (
                    total,
                    item
                ) =>
                    total +
                    Number(
                        item.quantity
                    ),
                0
            );
        },


        get cartTotal() {
            return this.cart.reduce(
                (total, item) =>
                    total +
                    Number(item.price) * Number(item.quantity),
                0
            );
        },


        get formattedDate() {

            if (!this.date) {
                return '';
            }


            const date =
                new Date(
                    this.date +
                    'T00:00:00'
                );


            return date.toLocaleDateString(
                'en-US',
                {
                    weekday: 'short',
                    day: 'numeric',
                    month: 'short',
                }
            );
        },


        get isCheckoutComplete() {

            return (
                this.cart.length > 0 &&
                !!this.address &&
                !!this.date &&
                !!this.time &&
                !!this.customer.name &&
                !!this.customer.phone
            );
        },
    };
}

function convertTo24Hour(time) {
    if (!time) return '';

    const value = String(time).trim();

    // Already in 24-hour format
    const match24 = value.match(
        /^([01]?\d|2[0-3]):([0-5]\d)(?::[0-5]\d)?$/
    );

    if (match24) {
        return (
            String(Number(match24[1])).padStart(2, '0') +
            ':' +
            match24[2]
        );
    }

    // 12-hour format with AM/PM
    const match12 = value.match(
        /^(0?[1-9]|1[0-2]):([0-5]\d)\s*(AM|PM)$/i
    );

    if (!match12) {
        console.error('Invalid booking time:', value);
        return '';
    }

    let hours = Number(match12[1]);
    const minutes = match12[2];
    const modifier = match12[3].toUpperCase();

    if (modifier === 'PM' && hours !== 12) {
        hours += 12;
    }

    if (modifier === 'AM' && hours === 12) {
        hours = 0;
    }

    return String(hours).padStart(2, '0') + ':' + minutes;
}

</script>
@endpush