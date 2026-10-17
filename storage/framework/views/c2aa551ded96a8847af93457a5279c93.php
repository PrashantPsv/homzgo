

<?php $__env->startSection('title', 'Booking Confirmed | ServiceHub'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $canPayBooking = !empty($booking['id'])
        && strtolower((string)($booking['status'] ?? '')) === 'completed'
        && !in_array(strtolower((string)($booking['payment_status'] ?? 'unknown')), ['paid','captured','completed'], true);
?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canPayBooking): ?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<div class="min-h-screen bg-gray-50">

    
    <section class="border-b border-gray-200 bg-white">
        <div class="mx-auto max-w-4xl px-4 py-12 text-center sm:px-6 lg:px-8">

            
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-green-100">
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-green-500 text-white">
                    <svg
                        class="h-8 w-8"
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
                </div>
            </div>

            <p class="mt-6 text-sm font-semibold uppercase tracking-wider text-green-600">
                Booking Confirmed
            </p>

            <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                Your service is booked!
            </h1>

            <p class="mx-auto mt-3 max-w-2xl text-sm leading-6 text-gray-500 sm:text-base">
                Thank you for choosing ServiceHub. Your booking has been confirmed successfully.
                We'll keep you updated about your service.
            </p>

            
            <div class="mx-auto mt-6 inline-flex items-center gap-3 rounded-xl border border-gray-200 bg-gray-50 px-5 py-3">

                <span class="text-sm text-gray-500">
                    Booking ID
                </span>

                <span class="font-mono text-sm font-bold text-gray-900">
                    #<?php echo e($booking['booking_number'] ?? $booking['id']); ?>

                </span>

                <button
                    type="button"
                    onclick="copyBookingId()"
                    class="text-indigo-600 hover:text-indigo-700"
                    title="Copy booking ID"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <rect
                            x="9"
                            y="9"
                            width="13"
                            height="13"
                            rx="2"
                            stroke-width="2"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"
                        />
                    </svg>
                </button>

            </div>

        </div>
    </section>


    
    <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">

        
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <div class="flex items-center gap-3">

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
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500">
                            Service Date
                        </p>

                        <p class="mt-1 text-sm font-bold text-gray-900">
                            <?php echo e(\Carbon\Carbon::parse($booking['slot_date'])->format('d F Y')); ?>

                        </p>

                        <p class="mt-0.5 text-xs text-gray-500">
                            <?php echo e(\Carbon\Carbon::parse($booking['slot_date'])->format('l')); ?>

                        </p>
                    </div>

                </div>
            </div>


            
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <div class="flex items-center gap-3">

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
                                d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"
                            />
                        </svg>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500">
                            Service Time
                        </p>

                        <p class="mt-1 text-sm font-bold text-gray-900">
                            <?php echo e(\Carbon\Carbon::parse($booking['slot_time'])->format('h:i A')); ?>

                        </p>
                    </div>

                </div>
            </div>


            
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <div class="flex items-center gap-3">

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
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500">
                            Booking Status
                        </p>

                        <p class="mt-1 text-sm font-bold text-green-600">
                            <?php echo e(ucfirst(str_replace('_', ' ', $booking['status'] ?? 'pending'))); ?>

                        </p>
                    </div>

                </div>
            </div>

        </div>


        <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">

            
            <div class="space-y-6 lg:col-span-2">

                
                <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4">

                        <h2 class="font-semibold text-gray-900">
                            Service Details
                        </h2>

                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                            <?php echo e(ucfirst(str_replace('_', ' ', $booking['status'] ?? 'pending'))); ?>

                        </span>

                    </div>

                    <div class="p-5">

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $booking['booking_items'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>

                            <div class="flex flex-col gap-5 sm:flex-row">

                                <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">

                                    <img src="<?php echo e($item['thumbnail_image'] ?? ''); ?>">

                                </div>


                                <div class="flex-1">

                                    <p class="text-xs font-medium uppercase tracking-wide text-indigo-600">
                                        Service
                                    </p>

                                    <h3 class="mt-1 text-xl font-bold text-gray-900">
                                        <?php echo e($item['package_name'] ?? 'Service'); ?>

                                    </h3>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($item['variant_name'])): ?>
                                        <p class="mt-1 text-sm text-gray-500">
                                            <?php echo e($item['variant_name']); ?>

                                        </p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($item['selections_summary'])): ?>
                                        <p class="mt-2 text-sm text-gray-500">
                                            <?php echo e($item['selections_summary']); ?>

                                        </p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <div class="mt-3 flex flex-wrap gap-4 text-sm text-gray-500">

                                        <span class="flex items-center gap-1.5">
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
                                                    d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"
                                                />
                                            </svg>

                                            Qty: <?php echo e($item['quantity'] ?? 1); ?>

                                        </span>

                                        <span class="flex items-center gap-1.5">
                                            ₹<?php echo e(number_format((float) ($item['unit_price'] ?? 0), 2)); ?> / item
                                        </span>

                                    </div>

                                </div>


                                <div class="text-left sm:text-right">

                                    <p class="text-xs text-gray-500">
                                        Item Total
                                    </p>

                                    <p class="mt-1 text-lg font-bold text-gray-900">
                                        ₹<?php echo e(number_format(
                                            (float) ($item['unit_price'] ?? 0) *
                                            (int) ($item['quantity'] ?? 1),
                                            2
                                        )); ?>

                                    </p>

                                </div>

                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$loop->last): ?>
                                <div class="my-5 border-t border-gray-100"></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                            <div class="py-6 text-center text-sm text-gray-500">
                                No booking items found.
                            </div>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>

                </div>


                
                <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="border-b border-gray-100 px-5 py-4">
                        <h2 class="font-semibold text-gray-900">
                            Service Schedule
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 gap-4 p-5 sm:grid-cols-2">

                        
                        <div class="rounded-xl bg-gray-50 p-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">

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
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <p class="text-xs text-gray-500">
                                        Date
                                    </p>

                                    <p class="mt-1 text-sm font-semibold text-gray-900">
                                        <?php echo e(\Carbon\Carbon::parse($booking['slot_date'])->format('l')); ?>

                                    </p>

                                    <p class="text-xs text-gray-500">
                                        <?php echo e(\Carbon\Carbon::parse($booking['slot_date'])->format('d F Y')); ?>

                                    </p>

                                </div>

                            </div>

                        </div>


                        
                        <div class="rounded-xl bg-gray-50 p-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-50 text-purple-600">

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
                                            d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <p class="text-xs text-gray-500">
                                        Time
                                    </p>

                                    <p class="mt-1 text-sm font-semibold text-gray-900">
                                        <?php echo e(\Carbon\Carbon::parse($booking['slot_time'])->format('h:i A')); ?>

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                
                <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="border-b border-gray-100 px-5 py-4">
                        <h2 class="font-semibold text-gray-900">
                            Service Address
                        </h2>
                    </div>

                    <div class="p-5">

                        <div class="flex gap-4">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

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
                                        d="M3 10.5V21h18V10.5M5 10.5L12 4l7 6.5M9 21v-6h6v6"
                                    />
                                </svg>

                            </div>

                            <div class="flex-1">

                                <div class="flex flex-wrap items-center gap-2">

                                    <h3 class="font-semibold text-gray-900">
                                        Service Location
                                    </h3>

                                    <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-600">
                                        Customer Address
                                    </span>

                                </div>

                                <p class="mt-1 text-sm font-medium text-gray-700">
                                    <?php echo e($booking['name'] ?? ''); ?>

                                </p>

                                <p class="mt-1 text-sm leading-6 text-gray-500">
                                    <?php echo e($booking['address'] ?? 'Address not available'); ?>

                                </p>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($booking['phone_number'])): ?>
                                    <p class="mt-2 text-sm text-gray-500">
                                        <?php echo e($booking['phone_number']); ?>

                                    </p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </div>

                        </div>

                    </div>

                </div>


                
                <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="border-b border-gray-100 px-5 py-4">
                        <h2 class="font-semibold text-gray-900">
                            Additional Services
                        </h2>
                    </div>

                    
                    <div
                        x-data="extraWorksManager({
                            bookingId: <?php echo \Illuminate\Support\Js::from($booking['id'])->toHtml() ?>,
                            items: <?php echo \Illuminate\Support\Js::from($booking['extraWorks'] ?? [])->toHtml() ?>,
                            urlTemplate: <?php echo \Illuminate\Support\Js::from(url('/booking/__BOOKING_ID__/extra-work/__EXTRA_ID__/respond'))->toHtml() ?>
                        })"
                        class="divide-y divide-gray-100"
                    >
                        <template x-for="extra in extraWorks" :key="extra.id">
                            <div class="flex flex-col gap-4 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                                <!-- Additional Service -->
                                <div class="flex items-start gap-3">

                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg"
                                        :class="extra.status === 'accepted'
                                            ? 'bg-green-50 text-green-600'
                                            : extra.status === 'rejected'
                                                ? 'bg-red-50 text-red-600'
                                                : 'bg-amber-50 text-amber-600'"
                                    >
                                        <svg class="h-5 w-5" fill="none"
                                             stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>

                                    <div>
                                        <p
                                            class="text-sm font-semibold text-gray-900"
                                            x-text="extra.name || extra.title || 'Additional Service'"
                                        ></p>

                                        <p
                                            x-show="extra.description"
                                            x-text="extra.description"
                                            class="mt-1 text-xs text-gray-500"
                                        ></p>

                                        <span
                                            class="mt-2 inline-flex rounded-full px-2.5 py-1 text-xs font-semibold"
                                            :class="{
                                                'bg-amber-50 text-amber-700': extra.status === 'pending',
                                                'bg-green-50 text-green-700': extra.status === 'accepted',
                                                'bg-red-50 text-red-700': extra.status === 'rejected'
                                            }"
                                            x-text="extra.status || 'pending'"
                                        ></span>
                                    </div>
                                </div>

                                <!-- Price and Actions -->
                                <div class="flex items-center gap-3 sm:justify-end">

                                    <span
                                        class="text-sm font-bold text-gray-900"
                                        x-text="'₹' + Number(
                                            extra.total_amount ?? extra.price ??
                                            (Number(extra.unit_price || 0) * Number(extra.quantity || 1))
                                        ).toLocaleString('en-IN', {
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2
                                        })"
                                    ></span>

                                    <!-- Accept / Reject -->
                                    <template x-if="extra.status === 'pending'">
                                        <div class="flex items-center gap-2">

                                            <button
                                                type="button"
                                                @click="respond(extra, 'accepted')"
                                                :disabled="extra.loading"
                                                class="rounded-lg bg-green-600 px-3 py-2 text-xs font-bold text-white hover:bg-green-700 disabled:opacity-50"
                                            >
                                                Accept
                                            </button>

                                            <button
                                                type="button"
                                                @click="respond(extra, 'rejected')"
                                                :disabled="extra.loading"
                                                class="rounded-lg border border-red-200 px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-50 disabled:opacity-50"
                                            >
                                                Reject
                                            </button>

                                        </div>
                                    </template>

                                    <span
                                        x-show="extra.loading"
                                        class="text-xs text-gray-500"
                                    >
                                        Updating...
                                    </span>

                                </div>

                                <p
                                    x-show="extra.error"
                                    x-text="extra.error"
                                    class="text-xs text-red-600 sm:basis-full"
                                ></p>

                            </div>
                        </template>

                        <div
                            x-show="extraWorks.length === 0"
                            class="px-5 py-5 text-sm text-gray-500"
                        >
                            No additional services added.
                        </div>
                    </div>

                </div>

            </div>


            
            <div class="space-y-6">

                
                <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="border-b border-gray-100 px-5 py-4">
                        <h2 class="font-semibold text-gray-900">
                            Payment Details
                        </h2>
                    </div>

                    <div class="p-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-xs text-gray-500">
                                    Booking Status
                                </p>

                                <div class="mt-1 flex items-center gap-2">

                                    <span class="h-2 w-2 rounded-full bg-green-500"></span>

                                    <span class="text-sm font-semibold text-green-600">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $booking['status'] ?? 'pending'))); ?>

                                    </span>

                                </div>

                            </div>

                            <div class="text-right">

                                <p class="text-xs text-gray-500">
                                    Amount
                                </p>

                                <p class="mt-1 text-xl font-bold text-gray-900">
                                    ₹<?php echo e(number_format((float) ($booking['total'] ?? 0), 2)); ?>

                                </p>

                            </div>

                        </div>

                        <div class="mt-5 border-t border-gray-100 pt-4">

                            <div class="flex items-center justify-between text-sm">

                                <span class="text-gray-500">
                                    Booking Number
                                </span>

                                <span class="font-medium text-gray-900">
                                    <?php echo e($booking['booking_number'] ?? '-'); ?>

                                </span>

                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($booking['created_at'])): ?>

                                <div class="mt-3 flex items-center justify-between text-sm">

                                    <span class="text-gray-500">
                                        Created
                                    </span>

                                    <span class="font-medium text-gray-900">
                                        <?php echo e(\Carbon\Carbon::parse($booking['created_at'])->format('d M Y, h:i A')); ?>

                                    </span>

                                </div>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>

                    </div>

                </div>


                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canPayBooking): ?>
                <div x-data="bookingPayment({
                    bookingId: <?php echo \Illuminate\Support\Js::from($booking['id'] ?? null)->toHtml() ?>,
                    createUrl: <?php echo \Illuminate\Support\Js::from(route('booking.razorpay.create', ['booking' => $booking['id']]))->toHtml() ?>,
                    verifyUrl: <?php echo \Illuminate\Support\Js::from(route('booking.razorpay.verify', ['booking' => $booking['id']]))->toHtml() ?>
                })" class="rounded-2xl border border-indigo-200 bg-white p-5 shadow-sm">
                    <h3 class="font-bold text-gray-900">Complete Payment</h3>
                    <p class="mt-2 text-sm text-gray-600">Your service is completed. Pay the outstanding amount.</p>
                    <p class="mt-3 text-xs text-gray-500">The final payable amount will be confirmed by the server.</p>
                    <p x-show="error" x-text="error" x-cloak role="alert" class="mt-3 rounded-lg bg-red-50 p-3 text-sm text-red-700"></p>
                    <button type="button" @click="pay()" :disabled="loading"
                        class="mt-4 w-full rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white hover:bg-indigo-700 disabled:opacity-50"
                        x-text="loading ? 'Processing...' : 'Pay Now'"></button>
                </div>
                <?php elseif(in_array(strtolower((string)($booking['payment_status'] ?? '')), ['paid','captured','completed'], true)): ?>
                <div class="rounded-2xl border border-green-200 bg-green-50 p-4 text-sm font-semibold text-green-700">Payment completed</div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="border-b border-gray-100 px-5 py-4">
                        <h2 class="font-semibold text-gray-900">
                            Price Summary
                        </h2>
                    </div>

                    <div class="space-y-3 p-5">

                        <div class="flex justify-between text-sm">

                            <span class="text-gray-600">
                                Subtotal
                            </span>

                            <span class="font-medium text-gray-900">
                                ₹<?php echo e(number_format((float) ($booking['subtotal'] ?? 0), 2)); ?>

                            </span>

                        </div>


                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) ($booking['discount'] ?? 0) > 0): ?>

                            <div class="flex justify-between text-sm">

                                <span class="text-gray-600">
                                    Discount
                                </span>

                                <span class="font-medium text-green-600">
                                    -₹<?php echo e(number_format((float) $booking['discount'], 2)); ?>

                                </span>

                            </div>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                        <div class="flex justify-between text-sm">

                            <span class="text-gray-600">
                                Additional Services
                            </span>

                            <span class="font-medium text-gray-900">
                                ₹<?php echo e(number_format(
                                    collect($booking['extraWorks'] ?? [])->filter(function ($extra) {
                                        return ($extra['status'] ?? '') === 'accepted';
                                    })->sum(function ($extra) {
                                        return (float) ($extra['total_amount'] ?? $extra['price'] ?? 0);
                                    }),
                                    2
                                )); ?>

                            </span>

                        </div>


                        <div class="border-t border-dashed border-gray-200 pt-4">

                            <div class="flex items-center justify-between">

                                <span class="font-semibold text-gray-900">
                                    Total
                                </span>

                                <span class="text-xl font-bold text-gray-900">
                                    ₹<?php echo e(number_format((float) ($booking['total'] ?? 0), 2)); ?>

                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($booking['cancellation_status']) && $booking['cancellation_status'] !== 'none'): ?>

                    <div class="rounded-2xl border border-red-100 bg-red-50 p-5">

                        <h3 class="font-semibold text-red-900">
                            Cancellation Status
                        </h3>

                        <p class="mt-2 text-sm text-red-700">
                            <?php echo e(ucfirst(str_replace('_', ' ', $booking['cancellation_status']))); ?>

                        </p>

                    </div>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($booking['vendor'])): ?>

                    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">

                        <div class="border-b border-gray-100 px-5 py-4">
                            <h2 class="font-semibold text-gray-900">
                                Service Professional
                            </h2>
                        </div>

                        <div class="p-5">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_array($booking['vendor'])): ?>

                                <p class="text-sm font-semibold text-gray-900">
                                    <?php echo e($booking['vendor']['name'] ?? 'Assigned Professional'); ?>

                                </p>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($booking['vendor']['phone'])): ?>
                                    <p class="mt-2 text-sm text-gray-500">
                                        <?php echo e($booking['vendor']['phone']); ?>

                                    </p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php else: ?>

                                <p class="text-sm font-semibold text-gray-900">
                                    <?php echo e($booking['vendor']); ?>

                                </p>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>

                    </div>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                
                <div class="rounded-2xl border border-indigo-100 bg-indigo-50 p-5">

                    <h3 class="font-semibold text-indigo-900">
                        What's next?
                    </h3>

                    <div class="mt-4 space-y-4">

                        <div class="flex gap-3">

                            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-indigo-600 text-xs font-bold text-white">
                                1
                            </div>

                            <p class="text-xs leading-5 text-indigo-800">
                                Our service professional will be assigned to your booking.
                            </p>

                        </div>


                        <div class="flex gap-3">

                            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-indigo-600 text-xs font-bold text-white">
                                2
                            </div>

                            <p class="text-xs leading-5 text-indigo-800">
                                You'll receive an update before the professional arrives.
                            </p>

                        </div>


                        <div class="flex gap-3">

                            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-indigo-600 text-xs font-bold text-white">
                                3
                            </div>

                            <p class="text-xs leading-5 text-indigo-800">
                                Sit back and let our professional take care of the service.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        
        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">

            <a
                href="<?php echo e(route('booking.index')); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-7 py-3.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
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
                        d="M9 5l7 7-7 7"
                    />
                </svg>

                View My Bookings

            </a>


            <a
                href="<?php echo e(url('/')); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-300 bg-white px-7 py-3.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
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
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0h6"
                    />
                </svg>

                Back to Home

            </a>

        </div>


        
        <div class="mt-8 text-center">

            <p class="text-sm text-gray-500">
                Need help with your booking?
                <a
                    href="#"
                    class="font-semibold text-indigo-600 hover:text-indigo-700"
                >
                    Contact Support
                </a>
            </p>

        </div>

    </div>

</div>

<?php $__env->startPush('scripts'); ?>
<script>

function bookingPayment(config) {
    return {
        loading: false,
        error: '',
        async pay() {
            if (this.loading) return;
            this.error = '';
            this.loading = true;
            try {
                if (typeof Razorpay === 'undefined') throw new Error('Razorpay could not load. Please refresh.');
                const headers = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                };
                const createdResponse = await fetch(config.createUrl, {
                    method: 'POST', credentials: 'same-origin', headers, body: JSON.stringify({})
                });
                const created = await createdResponse.json();
                if (!createdResponse.ok || created.status === false || created.success === false) {
                    throw new Error(created.message || 'Could not create payment order.');
                }
                const rawOrder = created.data ?? created;
                const order = {
                    key: rawOrder.key,
                    order_id: rawOrder.order_id ?? rawOrder.id,
                    amount: rawOrder.amount,
                    currency: rawOrder.currency || 'INR'
                };
                if (!order.key || !order.order_id || !Number.isInteger(Number(order.amount)) || Number(order.amount) <= 0) {
                    throw new Error('Invalid payment order response.');
                }
                const self = this;
                const checkout = new Razorpay({
                    key: order.key,
                    order_id: order.order_id,
                    amount: Number(order.amount),
                    currency: order.currency || 'INR',
                    name: 'HOMZgo',
                    description: 'Completed service booking payment',
                    handler: async function(payment) {
                        try {
                            const response = await fetch(config.verifyUrl, {
                                method: 'POST', credentials: 'same-origin', headers,
                                body: JSON.stringify({
                                    razorpay_order_id: payment.razorpay_order_id,
                                    razorpay_payment_id: payment.razorpay_payment_id,
                                    razorpay_signature: payment.razorpay_signature
                                })
                            });
                            const result = await response.json();
                            if (!response.ok || result.status === false || result.success === false) {
                                throw new Error(result.message || 'Payment received, but confirmation is pending. Contact support before paying again.');
                            }
                            window.location.reload();
                        } catch (error) {
                            self.error = error.message || 'Payment confirmation is pending. Do not pay again.';
                            self.loading = false;
                        }
                    },
                    modal: { ondismiss: () => { self.loading = false; } },
                    theme: { color: '#4f46e5' }
                });
                checkout.on('payment.failed', (event) => {
                    self.error = event.error?.description || 'Payment could not be completed.';
                    self.loading = false;
                });
                checkout.open();
            } catch (error) {
                this.error = error.message || 'Unable to start payment.';
                this.loading = false;
            }
        }
    };
}

    function copyBookingId() {
        const bookingId = <?php echo json_encode($booking['booking_number'] ?? $booking['id'] ?? '', 15, 512) ?>;

        if (navigator.clipboard) {
            navigator.clipboard.writeText(bookingId).then(() => {
                // Optional: replace with toast notification
                alert('Booking ID copied!');
            });
        }
    }

function extraWorksManager(config) {
    return {
        bookingId: config.bookingId,

        extraWorks: (config.items || []).map(item => ({
            ...item,
            status: String(item.status || 'pending').toLowerCase(),
            loading: false,
            error: ''
        })),

        async respond(extra, status) {
            if (extra.loading || extra.status !== 'pending') {
                return;
            }

            const message = status === 'accepted'
                ? 'Accept this additional service?'
                : 'Reject this additional service?';

            if (!window.confirm(message)) {
                return;
            }

            extra.loading = true;
            extra.error = '';

            try {
                const url = config.urlTemplate
                    .replace('__BOOKING_ID__', encodeURIComponent(this.bookingId))
                    .replace('__EXTRA_ID__', encodeURIComponent(extra.id));

                const response = await fetch(url, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN':
                            document.querySelector('meta[name="csrf-token"]')
                                ?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({
                        status: status
                    })
                });

                const result = await response.json();

                if (!response.ok || result.status === false) {
                    throw new Error(
                        result.message || 'Unable to update additional service.'
                    );
                }

                extra.status = String(
                    result.data?.status ?? status
                ).toLowerCase();

            } catch (error) {
                extra.error = error.message || 'Request failed.';
            } finally {
                extra.loading = false;
            }
        }
    };
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\homo\resources\views/booking/success.blade.php ENDPATH**/ ?>