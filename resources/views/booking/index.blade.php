@extends('layouts.app')

@section('title', 'My Bookings | HOMZgo')

@section('content')
<section class="border-b border-gray-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <nav class="mb-3 text-sm text-gray-500" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-indigo-600">Home</a>
            <span class="mx-2">/</span> <span class="text-gray-900">My Bookings</span>
        </nav>
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">My Bookings</h1>
                <p class="mt-2 text-sm text-gray-500">View and manage your HOMZgo service bookings.</p>
            </div>
            <a href="{{ url('/services') }}" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700">+ Book a New Service</a>
        </div>
    </div>
</section>

<section class="bg-gray-50 py-8 sm:py-10" x-data="{ activeTab: 'upcoming' }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if(!empty($apiError))
            <div role="alert" class="mb-6 rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">{{ $apiError }}</div>
        @endif

        @php
            $statStyles = [
                'calendar' => 'bg-indigo-50 text-indigo-600',
                'clock' => 'bg-amber-50 text-amber-600',
                'check' => 'bg-emerald-50 text-emerald-600',
                'x' => 'bg-rose-50 text-rose-600',
            ];
        @endphp
        <div class="mb-8 grid grid-cols-2 gap-3 lg:grid-cols-4 sm:gap-4">
            @foreach($stats as $stat)
                <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm sm:p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-xs font-medium text-gray-500 sm:text-sm">{{ $stat['label'] }}</p>
                            <p class="mt-2 text-2xl font-extrabold text-gray-900">{{ $stat['value'] }}</p>
                        </div>
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ $statStyles[$stat['icon']] ?? 'bg-gray-100 text-gray-600' }}">
                            @if($stat['icon'] === 'calendar')
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2" stroke-width="1.8"/><path d="M7 3v4M17 3v4M3 10h18" stroke-width="1.8"/></svg>
                            @elseif($stat['icon'] === 'clock')
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="1.8"/><path d="M12 7v5l3 2" stroke-width="1.8"/></svg>
                            @elseif($stat['icon'] === 'check')
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 12l5 5L20 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            @else
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 6l12 12M18 6L6 18" stroke-width="2" stroke-linecap="round"/></svg>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="flex overflow-x-auto border-b border-gray-200" role="tablist" aria-label="Booking categories">
                @foreach([
                    'upcoming' => ['Upcoming', count($upcomingBookings)],
                    'completed' => ['Completed', count($completedBookings)],
                    'cancelled' => ['Cancelled', count($cancelledBookings)],
                    'all' => ['All', count($bookings)],
                ] as $key => $tab)
                    <button type="button" role="tab" @click="activeTab = @js($key)"
                        :aria-selected="activeTab === @js($key)"
                        :class="activeTab === @js($key) ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-900'"
                        class="whitespace-nowrap border-b-2 px-5 py-4 text-sm font-semibold transition sm:px-6">
                        {{ $tab[0] }}
                        <span class="ml-1 rounded-full bg-gray-100 px-2 py-0.5 text-xs text-gray-700">{{ $tab[1] }}</span>
                    </button>
                @endforeach
            </div>

            @foreach([
                'upcoming' => $upcomingBookings,
                'completed' => $completedBookings,
                'cancelled' => $cancelledBookings,
                'all' => $bookings,
            ] as $tabKey => $tabBookings)
                <div x-show="activeTab === @js($tabKey)" x-cloak class="space-y-4 p-4 sm:p-6" role="tabpanel">
                    <div class="mb-5">
                        <h2 class="text-lg font-bold text-gray-900">{{ ucfirst($tabKey) }} Bookings</h2>
                        <p class="mt-1 text-sm text-gray-500">{{ count($tabBookings) }} booking(s)</p>
                    </div>

                    @forelse($tabBookings as $booking)
                        @php
                            $status = strtolower((string) ($booking['status'] ?? 'pending'));
                            $statusClass = in_array($status, ['completed', 'reviewed', 'finished'], true)
                                ? 'bg-emerald-100 text-emerald-700'
                                : (in_array($status, ['cancelled', 'canceled'], true)
                                    ? 'bg-rose-100 text-rose-700'
                                    : 'bg-indigo-100 text-indigo-700');
                            $paymentStatus = strtolower((string) ($booking['payment_status'] ?? 'pending'));
                            $paymentClass = in_array($paymentStatus, ['paid', 'captured', 'success', 'completed'], true)
                                ? 'text-emerald-700' : 'text-amber-700';
                            $bookingId = $booking['id'] ?? null;
                            $dateText = !empty($booking['slot_date'])
                                ? \Illuminate\Support\Carbon::parse($booking['slot_date'])->format('D, d M Y')
                                : 'Not scheduled';
                        @endphp
                        <article class="overflow-hidden rounded-2xl border border-gray-200 bg-white">
                            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-100 bg-gray-50/70 px-4 py-3 sm:px-5">
                                <div class="flex flex-wrap items-center gap-3">
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}">{{ ucwords(str_replace('_', ' ', $status)) }}</span>
                                    <span class="text-xs text-gray-500 sm:text-sm">{{ $booking['booking_number'] ?? ($bookingId ? 'BOOK-'.$bookingId : 'Booking') }}</span>
                                </div>
                                <span class="text-lg font-bold text-gray-900">₹{{ number_format((float) ($booking['total'] ?? 0), 2) }}</span>
                            </div>
                            <div class="flex flex-col gap-5 p-4 sm:flex-row sm:p-5">
                                <div class="h-28 w-full shrink-0 overflow-hidden rounded-xl bg-gray-100 sm:w-32">
                                    @if(!empty($booking['image']))
                                        <img src="{{ $booking['image'] }}" alt="{{ $booking['service'] ?? 'Service' }}" class="h-full w-full object-cover" loading="lazy">
                                    @else
                                        <div class="flex h-full items-center justify-center text-xs text-gray-400">No Image</div>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-indigo-600">{{ $booking['category'] ?? 'Home Services' }}</p>
                                    <h3 class="mt-1 text-lg font-bold text-gray-900">{{ $booking['service'] ?? 'Service' }}</h3>
                                    @if(!empty($booking['selections_summary']))
                                        <div class="mt-2">
                                            <span class="inline-flex rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">
                                                {{ $booking['selections_summary'] }}
                                            </span>
                                        </div>
                                    @endif

                                    @if(!empty($booking['variant_name']))
                                        <p class="mt-2 text-sm text-gray-600">
                                            Variant: {{ $booking['variant_name'] }}
                                        </p>
                                    @endif
                                    <div class="mt-3 space-y-2 text-sm text-gray-600">
                                        <p><span class="font-medium text-gray-800">Date:</span> {{ $dateText }}</p>
                                        <p><span class="font-medium text-gray-800">Time:</span> {{ $booking['slot_time'] ?: 'Not selected' }}</p>
                                        @if(!empty($booking['address']))
                                            <p class="break-words"><span class="font-medium text-gray-800">Address:</span> {{ $booking['address'] }}</p>
                                        @endif
                                        <p><span class="font-medium text-gray-800">Payment:</span> <span class="font-semibold {{ $paymentClass }}">{{ ucwords(str_replace('_', ' ', $paymentStatus)) }}</span></p>
                                        @if(!empty($booking['reason']) && in_array($status, ['cancelled', 'canceled'], true))
                                            <p><span class="font-medium text-gray-800">Reason:</span> {{ $booking['reason'] }}</p>
                                        @endif
                                    </div>
                                    @if(!empty($booking['extraWorks']) && is_array($booking['extraWorks']))
                                        <div class="mt-4 flex flex-wrap gap-2">
                                            @foreach($booking['extraWorks'] as $addon)
                                                <span class="rounded-lg border border-indigo-100 bg-indigo-50 px-3 py-1 text-xs text-indigo-700">{{ is_array($addon) ? ($addon['name'] ?? 'Additional service') : (string) $addon }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="flex shrink-0 items-end justify-end sm:w-44 sm:items-start">
                                    @if($bookingId !== null && $bookingId !== '')
                                        <a href="{{ route('booking.success', ['booking_id' => \Illuminate\Support\Facades\Crypt::encryptString((string) $bookingId)]) }}"
                                            class="inline-flex w-full justify-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                                            View Booking Details
                                        </a>
                                    @else
                                        <span class="text-xs text-gray-500">Details unavailable</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-xl border border-dashed border-gray-200 px-6 py-14 text-center">
                            <div class="text-3xl">📅</div>
                            <h3 class="mt-3 font-semibold text-gray-900">No {{ $tabKey }} bookings found</h3>
                            <p class="mt-2 text-sm text-gray-500">Your bookings will appear here when available.</p>
                            <a href="{{ url('/services') }}" class="mt-4 inline-block text-sm font-semibold text-indigo-600 hover:underline">Explore services</a>
                        </div>
                    @endforelse
                </div>
            @endforeach
        </div>

        <div class="mt-8 flex flex-col gap-4 rounded-2xl bg-indigo-600 p-6 text-white sm:flex-row sm:items-center sm:justify-between sm:p-8">
            <div>
                <h2 class="text-xl font-bold">Need help with a booking?</h2>
                <p class="mt-2 text-sm text-indigo-100">Contact HOMZgo support for booking or service questions.</p>
            </div>
            {{-- Replace this URL with your real support page when available. --}}
            <a href="{{ url('/') }}" class="inline-flex justify-center rounded-xl bg-white px-5 py-3 text-sm font-semibold text-indigo-700 hover:bg-indigo-50">Back to Home</a>
        </div>
    </div>
</section>
@endsection
