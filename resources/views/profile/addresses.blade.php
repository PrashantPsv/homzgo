@extends('layouts.app')

@section('title', 'Saved Addresses | ServiceHub')

@section('content')


<div class="min-h-screen bg-gray-50">

    {{-- Header --}}
    <section class="border-b border-gray-200 bg-white">
        <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <div class="mb-2 flex items-center gap-2 text-sm text-gray-500">

                        <a
                            href="{{ route('profile') }}"
                            class="hover:text-indigo-600"
                        >
                            My Profile
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
                            Saved Addresses
                        </span>

                    </div>

                    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                        Saved Addresses
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Manage the addresses you use for your bookings.
                    </p>
                </div>


                <a
                    href="{{ route('profile.addresses.add') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                >

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
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    Add New Address

                </a>

            </div>

        </div>
    </section>


    {{-- Main --}}
    <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- Location Info --}}
        <div class="mb-6 flex items-start gap-3 rounded-2xl border border-indigo-100 bg-indigo-50 p-4">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-indigo-600 shadow-sm">

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

            <div>
                <p class="text-sm font-semibold text-gray-900">
                    Your service locations
                </p>

                <p class="mt-1 text-sm text-gray-600">
                    Save your frequently used addresses to make booking faster.
                </p>
            </div>

        </div>


        {{-- Address Count --}}
        <div class="mb-4 flex items-center justify-between">

            <h2 class="text-base font-semibold text-gray-900">
                Your Addresses
            </h2>

            <span class="text-sm text-gray-500">
                {{ count($addresses) }} saved addresses
            </span>

        </div>


        {{-- Address Cards --}}
        <div class="space-y-4">

            @forelse($addresses as $address)

                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="p-5 sm:p-6">

                        <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">

                            {{-- Address Details --}}
                            <div class="flex gap-4">

                                {{-- Icon --}}
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                                    @if($address['icon'] === 'home')

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
                                                d="M3 10.5L12 3l9 7.5"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 9.5V21h14V9.5"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 21v-6h6v6"
                                            />
                                        </svg>

                                    @elseif($address['icon'] === 'office')

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
                                                d="M4 21h16"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M6 21V5a2 2 0 012-2h8a2 2 0 012 2v16"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 7h2m2 0h2M9 11h2m2 0h2M9 15h2m2 0h2"
                                            />
                                        </svg>

                                    @else

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
                                                d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
                                        </svg>

                                    @endif

                                </div>


                                {{-- Text --}}
                                <div class="min-w-0">

                                    <div class="flex flex-wrap items-center gap-2">

                                        <h3 class="text-base font-semibold text-gray-900">
                                            {{ $address['type'] }}
                                        </h3>

                                        @if($address['default'])

                                            <span class="rounded-full bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-700">
                                                Default
                                            </span>

                                        @endif

                                    </div>


                                    <p class="mt-3 text-sm font-medium text-gray-900">
                                        {{ $address['name'] }}
                                    </p>

                                    <p class="mt-1 text-sm leading-6 text-gray-600">
                                        {{ $address['address'] }}
                                        <br>
                                        {{ $address['area'] }}
                                    </p>

                                    <p class="mt-2 text-sm text-gray-500">
                                        Landmark:
                                        <span class="text-gray-700">
                                            {{ $address['landmark'] }}
                                        </span>
                                    </p>

                                    <p class="mt-2 text-sm text-gray-500">
                                        Phone:
                                        <span class="font-medium text-gray-700">
                                            {{ $address['phone'] }}
                                        </span>
                                    </p>

                                </div>

                            </div>


                            {{-- Actions --}}
                            <div class="flex shrink-0 items-center gap-2 sm:ml-4">

                                <a
                                    href="{{ route('profile.addresses.edit', ['address' => $address['id']]) }}"
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
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
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                        />
                                    </svg>

                                    Edit

                                </a>


                                <form method="POST" action="{{ route('profile.addresses.delete', ['address'=>$address['id']]) }}" onsubmit="return confirm('Delete this address?')">@csrf @method('DELETE')<button
                                    type="submit"
                                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 p-2 text-gray-500 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600"
                                    title="Delete address"
                                >

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
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h10"
                                        />
                                    </svg>

                                </button></form>

                            </div>

                        </div>


                        {{-- Default Address Action --}}
                        @if(!$address['default'])

                            <div class="mt-5 border-t border-gray-100 pt-4">

                                <form method="POST" action="{{ route('profile.addresses.default',['address'=>$address['id']]) }}">@csrf<button class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Set as Default Address</button></form>

                            </div>

                        @else

                            <div class="mt-5 flex items-center gap-2 border-t border-gray-100 pt-4 text-sm text-gray-500">

                                <svg
                                    class="h-4 w-4 text-green-600"
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

                                This address will be selected automatically during booking.

                            </div>

                        @endif

                    </div>

                </div>

            @empty
<div class="p-10 text-center text-gray-500">No saved addresses yet.</div>
@endforelse

        </div>


        {{-- Add Address CTA --}}
        <div class="mt-6 rounded-2xl border border-dashed border-gray-300 bg-white p-6 text-center">

            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-indigo-50 text-indigo-600">

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
                        d="M12 4v16m8-8H4"
                    />
                </svg>

            </div>

            <h3 class="mt-4 font-semibold text-gray-900">
                Need another address?
            </h3>

            <p class="mx-auto mt-1 max-w-md text-sm text-gray-500">
                Add another home, office, or frequently used location for faster bookings.
            </p>

            <a
                href="{{ route('profile.addresses.add') }}"
                class="mt-4 inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
            >
                Add New Address
            </a>

        </div>


        {{-- Security Notice --}}
        <div class="mt-6 flex items-start gap-3 rounded-2xl border border-green-100 bg-green-50 p-5">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-green-600">

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
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2zm10-11V7a4 4 0 00-8 0v4h8z"
                    />
                </svg>

            </div>

            <div>
                <p class="text-sm font-semibold text-gray-900">
                    Your addresses are private
                </p>

                <p class="mt-1 text-sm leading-6 text-gray-600">
                    Saved addresses are used only to provide services at your selected location.
                </p>
            </div>

        </div>


        {{-- Back --}}
        <div class="mt-6">

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

        </div>

    </div>

</div>

@endsection