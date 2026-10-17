@extends('layouts.app')

@section('title', 'Add-ons | ServiceHub')

@section('content')



<div class="min-h-screen bg-gray-50" x-data="bookingAddons()">

    {{-- Booking Header --}}
    <div class="border-b border-gray-200 bg-white">

        <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-indigo-600">
                        Booking
                    </p>

                    <h1 class="mt-1 text-xl font-bold text-gray-900 sm:text-2xl">
                        Add-ons
                    </h1>

                </div>


                <div class="text-right">

                    <p class="text-sm font-medium text-gray-500">
                        Step 4 of 6
                    </p>

                    <div class="mt-2 flex gap-1.5">

                        <span class="h-1.5 w-8 rounded-full bg-indigo-600"></span>
                        <span class="h-1.5 w-8 rounded-full bg-indigo-600"></span>
                        <span class="h-1.5 w-8 rounded-full bg-indigo-600"></span>
                        <span class="h-1.5 w-8 rounded-full bg-indigo-600"></span>
                        <span class="h-1.5 w-8 rounded-full bg-gray-200"></span>
                        <span class="h-1.5 w-8 rounded-full bg-gray-200"></span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Main --}}
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <div class="mb-6">

            <nav class="flex flex-wrap items-center gap-2 text-sm text-gray-500">

                <a
                    href="{{ route('home') }}"
                    class="hover:text-indigo-600"
                >
                    Home
                </a>

                <span>/</span>

                <a
                    href="{{ route('booking.date-time') }}"
                    class="hover:text-indigo-600"
                >
                    Date & Time
                </a>

                <span>/</span>

                <span class="font-medium text-gray-900">
                    Add-ons
                </span>

            </nav>

        </div>


        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            {{-- LEFT --}}
            <div class="lg:col-span-2">

                {{-- Heading --}}
                <div class="mb-6">

                    <h2 class="text-2xl font-bold text-gray-900">
                        Make your service even better
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        Add extra services to get more done during the same visit.
                    </p>

                </div>


                {{-- Add-on Cards --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    @foreach($addons as $index => $addon)

                        <div
                            class="group overflow-hidden rounded-2xl border
                            border-gray-200
                            bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md"
                        >

                            {{-- Image --}}
                            <div class="relative h-40 overflow-hidden">

                                <img
                                    src="{{ $addon['image'] }}"
                                    alt="{{ $addon['name'] }}"
                                    class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                >

                                {{-- Selected Badge --}}
                                @if(false)

                                    <span class="absolute left-3 top-3 inline-flex items-center gap-1 rounded-full bg-indigo-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm">

                                        <svg
                                            class="h-3.5 w-3.5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>

                                        Added

                                    </span>

                                @endif

                            </div>


                            {{-- Content --}}
                            <div class="p-4">

                                <div class="flex items-start justify-between gap-3">

                                    <div>

                                        <h3 class="font-semibold text-gray-900">
                                            {{ $addon['name'] }}
                                        </h3>

                                        <p class="mt-1 text-xs leading-5 text-gray-500">
                                            {{ $addon['description'] }}
                                        </p>

                                    </div>

                                </div>


                                <div class="mt-4 flex items-center justify-between">

                                    <div>

                                        <span class="text-base font-bold text-gray-900">
                                            ₹{{ number_format($addon['price']) }}
                                        </span>

                                        <span class="ml-1 text-xs text-gray-400">
                                            · {{ $addon['duration'] }}
                                        </span>

                                    </div>


                                    @if(false)

                                        <button
                                            type="button"
                                            class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50"
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
                                                    d="M6 6l12 12M18 6L6 18"
                                                />
                                            </svg>

                                            Remove

                                        </button>

                                    @else

                                        <button
                                            type="button"
                                            class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-indigo-700"
                                        >

                                            <svg
                                                class="h-4 w-4"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-width="2"
                                                    d="M12 5v14M5 12h14"
                                                />
                                            </svg>

                                            Add

                                        </button>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>


                {{-- Skip Add-ons --}}
                <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-5">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <h3 class="font-semibold text-gray-900">
                                Don't need any add-ons?
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                You can continue with just your selected service.
                            </p>

                        </div>

                        <a
                            href="{{ route('booking.summary') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                        >
                            Skip
                        </a>

                    </div>

                </div>


                {{-- Navigation --}}
                <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-between">

                    <a
                        href="{{ route('booking.date-time') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 px-6 py-3.5 text-sm font-semibold text-gray-700 transition hover:bg-white"
                    >
                        Back
                    </a>


                    <a
                        href="{{ route('booking.summary') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-6 py-3.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                    >
                        Continue

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
                                d="M5 12h14M13 6l6 6-6 6"
                            />
                        </svg>

                    </a>

                </div>

            </div>


            {{-- RIGHT SUMMARY --}}
            <div class="lg:col-span-1">

                <div class="sticky top-6">

                    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                        {{-- Service --}}
                        <div class="p-5">

                            <h3 class="text-lg font-bold text-gray-900">
                                Booking Summary
                            </h3>


                            <div class="mt-5 flex gap-4">

                                <img
                                    src="{{ $service['image'] }}"
                                    alt="{{ $service['name'] }}"
                                    class="h-20 w-20 rounded-xl object-cover"
                                >


                                <div class="min-w-0">

                                    <p class="text-xs font-medium text-indigo-600">
                                        {{ $service['category'] }}
                                    </p>

                                    <h4 class="mt-1 font-semibold text-gray-900">
                                        {{ $service['name'] }}
                                    </h4>

                                    <p class="mt-2 text-sm text-gray-500">
                                        {{ $service['duration'] }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Date / Time --}}
                        <div class="border-t border-gray-100 p-5">

                            <div class="space-y-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">

                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <rect
                                                x="3"
                                                y="4"
                                                width="18"
                                                height="17"
                                                rx="2"
                                                stroke-width="2"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-width="2"
                                                d="M8 2v4M16 2v4M3 10h18"
                                            />

                                        </svg>

                                    </div>

                                    <div>

                                        <p class="text-xs text-gray-500">
                                            Date
                                        </p>

                                        <p class="mt-0.5 text-sm font-semibold text-gray-900">
                                            {{ $date ? \Illuminate\Support\Carbon::parse($date)->format('d F Y') : 'Not selected' }}
                                        </p>

                                    </div>

                                </div>


                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">

                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="9"
                                                stroke-width="2"
                                            />

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

                                        <p class="mt-0.5 text-sm font-semibold text-gray-900">
                                            {{ $time ? \Illuminate\Support\Carbon::parse($time)->format('h:i A') : 'Not selected' }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- Address --}}
                        <div class="border-t border-gray-100 p-5">

                            <div class="flex items-start gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">

                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-width="2"
                                            d="M3 10.5L12 3l9 7.5"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-width="2"
                                            d="M5 9.5V21h14V9.5"
                                        />

                                    </svg>

                                </div>

                                <div>

                                    <p class="text-xs text-gray-500">
                                        Service Address
                                    </p>

                                    <p class="mt-1 text-sm font-semibold text-gray-900">
                                        Home
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-gray-500">
                                        123, Satellite Road, Near City Mall,
                                        Ahmedabad - 380015
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Price Breakdown --}}
                        <div class="border-t border-gray-100 p-5">

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-gray-500">
                                    {{ $service['name'] ?? 'Selected Service' }}
                                </span>

                                <span class="text-sm font-medium text-gray-900">
                                    ₹{{ number_format((float)($service['price'] ?? 0), 2) }}
                                </span>

                            </div>


                            <template x-for="addon in selectedAddons" :key="addon.id">
                                <div class="mt-3 flex items-center justify-between">
                                    <span class="text-sm text-gray-500" x-text="addon.name"></span>
                                    <span class="text-sm font-medium text-gray-900" x-text="`₹${Number(addon.price || 0).toFixed(2)}`"></span>
                                </div>
                            </template>

                            <div class="my-4 border-t border-dashed border-gray-200"></div>


                            <div class="flex items-center justify-between">

                                <span class="text-sm text-gray-500">
                                    Taxes & fees
                                </span>

                                <span class="text-sm font-medium text-gray-900">
                                    ₹0
                                </span>

                            </div>


                            <div class="my-4 border-t border-gray-200"></div>


                            <div class="flex items-center justify-between">

                                <span class="font-semibold text-gray-900">
                                    Total
                                </span>

                                <span class="text-2xl font-bold text-gray-900">
                                    ₹1,647
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Savings --}}
                    <div class="mt-4 rounded-2xl border border-green-100 bg-green-50 p-4">

                        <div class="flex gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-600">

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
                                        d="M12 8c-1.5-1.5-4-.5-4 1.5S10.5 12 12 12s4 .5 4 2.5S13.5 16 12 16"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-width="2"
                                        d="M12 4v2M12 18v2"
                                    />

                                </svg>

                            </div>

                            <div>

                                <p class="text-sm font-semibold text-gray-900">
                                    Bundle more & save time
                                </p>

                                <p class="mt-1 text-xs leading-5 text-gray-600">
                                    Add-ons can be completed during the same service visit.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@push('scripts')
<script>
function bookingAddons() {
    return {
        selectedAddons: @js(session('booking.addons', [])),
        toggleAddon(addon) {
            const id = Number(addon.id);
            const index = this.selectedAddons.findIndex(item => Number(item.id) === id);
            if (index >= 0) {
                this.selectedAddons.splice(index, 1);
            } else {
                this.selectedAddons.push(addon);
            }
            fetch('{{ route('booking.add-ons.select') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                credentials: 'same-origin',
                body: JSON.stringify({ addons: this.selectedAddons })
            });
        }
    }
}
</script>
@endpush

@endsection