<?php $__env->startSection('title', 'My Bookings | HOMZgo'); ?>

<?php $__env->startSection('content'); ?>
<section class="border-b border-gray-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <nav class="mb-3 text-sm text-gray-500" aria-label="Breadcrumb">
            <a href="<?php echo e(url('/')); ?>" class="hover:text-indigo-600">Home</a>
            <span class="mx-2">/</span> <span class="text-gray-900">My Bookings</span>
        </nav>
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">My Bookings</h1>
                <p class="mt-2 text-sm text-gray-500">View and manage your HOMZgo service bookings.</p>
            </div>
            <a href="<?php echo e(url('/services')); ?>" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700">+ Book a New Service</a>
        </div>
    </div>
</section>

<section class="bg-gray-50 py-8 sm:py-10" x-data="{ activeTab: 'upcoming' }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($apiError)): ?>
            <div role="alert" class="mb-6 rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800"><?php echo e($apiError); ?></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php
            $statStyles = [
                'calendar' => 'bg-indigo-50 text-indigo-600',
                'clock' => 'bg-amber-50 text-amber-600',
                'check' => 'bg-emerald-50 text-emerald-600',
                'x' => 'bg-rose-50 text-rose-600',
            ];
        ?>
        <div class="mb-8 grid grid-cols-2 gap-3 lg:grid-cols-4 sm:gap-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm sm:p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-xs font-medium text-gray-500 sm:text-sm"><?php echo e($stat['label']); ?></p>
                            <p class="mt-2 text-2xl font-extrabold text-gray-900"><?php echo e($stat['value']); ?></p>
                        </div>
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl <?php echo e($statStyles[$stat['icon']] ?? 'bg-gray-100 text-gray-600'); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($stat['icon'] === 'calendar'): ?>
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2" stroke-width="1.8"/><path d="M7 3v4M17 3v4M3 10h18" stroke-width="1.8"/></svg>
                            <?php elseif($stat['icon'] === 'clock'): ?>
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="1.8"/><path d="M12 7v5l3 2" stroke-width="1.8"/></svg>
                            <?php elseif($stat['icon'] === 'check'): ?>
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 12l5 5L20 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <?php else: ?>
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 6l12 12M18 6L6 18" stroke-width="2" stroke-linecap="round"/></svg>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="flex overflow-x-auto border-b border-gray-200" role="tablist" aria-label="Booking categories">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                    'upcoming' => ['Upcoming', count($upcomingBookings)],
                    'completed' => ['Completed', count($completedBookings)],
                    'cancelled' => ['Cancelled', count($cancelledBookings)],
                    'all' => ['All', count($bookings)],
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <button type="button" role="tab" @click="activeTab = <?php echo \Illuminate\Support\Js::from($key)->toHtml() ?>"
                        :aria-selected="activeTab === <?php echo \Illuminate\Support\Js::from($key)->toHtml() ?>"
                        :class="activeTab === <?php echo \Illuminate\Support\Js::from($key)->toHtml() ?> ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-900'"
                        class="whitespace-nowrap border-b-2 px-5 py-4 text-sm font-semibold transition sm:px-6">
                        <?php echo e($tab[0]); ?>

                        <span class="ml-1 rounded-full bg-gray-100 px-2 py-0.5 text-xs text-gray-700"><?php echo e($tab[1]); ?></span>
                    </button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                'upcoming' => $upcomingBookings,
                'completed' => $completedBookings,
                'cancelled' => $cancelledBookings,
                'all' => $bookings,
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabKey => $tabBookings): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div x-show="activeTab === <?php echo \Illuminate\Support\Js::from($tabKey)->toHtml() ?>" x-cloak class="space-y-4 p-4 sm:p-6" role="tabpanel">
                    <div class="mb-5">
                        <h2 class="text-lg font-bold text-gray-900"><?php echo e(ucfirst($tabKey)); ?> Bookings</h2>
                        <p class="mt-1 text-sm text-gray-500"><?php echo e(count($tabBookings)); ?> booking(s)</p>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tabBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
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
                        ?>
                        <article class="overflow-hidden rounded-2xl border border-gray-200 bg-white">
                            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-100 bg-gray-50/70 px-4 py-3 sm:px-5">
                                <div class="flex flex-wrap items-center gap-3">
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold <?php echo e($statusClass); ?>"><?php echo e(ucwords(str_replace('_', ' ', $status))); ?></span>
                                    <span class="text-xs text-gray-500 sm:text-sm"><?php echo e($booking['booking_number'] ?? ($bookingId ? 'BOOK-'.$bookingId : 'Booking')); ?></span>
                                </div>
                                <span class="text-lg font-bold text-gray-900">₹<?php echo e(number_format((float) ($booking['total'] ?? 0), 2)); ?></span>
                            </div>
                            <div class="flex flex-col gap-5 p-4 sm:flex-row sm:p-5">
                                <div class="h-28 w-full shrink-0 overflow-hidden rounded-xl bg-gray-100 sm:w-32">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($booking['image'])): ?>
                                        <img src="<?php echo e($booking['image']); ?>" alt="<?php echo e($booking['service'] ?? 'Service'); ?>" class="h-full w-full object-cover" loading="lazy">
                                    <?php else: ?>
                                        <div class="flex h-full items-center justify-center text-xs text-gray-400">No Image</div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-indigo-600"><?php echo e($booking['category'] ?? 'Home Services'); ?></p>
                                    <h3 class="mt-1 text-lg font-bold text-gray-900"><?php echo e($booking['service'] ?? 'Service'); ?></h3>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($booking['selections_summary'])): ?>
                                        <div class="mt-2">
                                            <span class="inline-flex rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">
                                                <?php echo e($booking['selections_summary']); ?>

                                            </span>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($booking['variant_name'])): ?>
                                        <p class="mt-2 text-sm text-gray-600">
                                            Variant: <?php echo e($booking['variant_name']); ?>

                                        </p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div class="mt-3 space-y-2 text-sm text-gray-600">
                                        <p><span class="font-medium text-gray-800">Date:</span> <?php echo e($dateText); ?></p>
                                        <p><span class="font-medium text-gray-800">Time:</span> <?php echo e($booking['slot_time'] ?: 'Not selected'); ?></p>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($booking['address'])): ?>
                                            <p class="break-words"><span class="font-medium text-gray-800">Address:</span> <?php echo e($booking['address']); ?></p>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <p><span class="font-medium text-gray-800">Payment:</span> <span class="font-semibold <?php echo e($paymentClass); ?>"><?php echo e(ucwords(str_replace('_', ' ', $paymentStatus))); ?></span></p>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($booking['reason']) && in_array($status, ['cancelled', 'canceled'], true)): ?>
                                            <p><span class="font-medium text-gray-800">Reason:</span> <?php echo e($booking['reason']); ?></p>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($booking['extraWorks']) && is_array($booking['extraWorks'])): ?>
                                        <div class="mt-4 flex flex-wrap gap-2">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $booking['extraWorks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                <span class="rounded-lg border border-indigo-100 bg-indigo-50 px-3 py-1 text-xs text-indigo-700"><?php echo e(is_array($addon) ? ($addon['name'] ?? 'Additional service') : (string) $addon); ?></span>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="flex shrink-0 items-end justify-end sm:w-44 sm:items-start">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bookingId !== null && $bookingId !== ''): ?>
                                        <a href="<?php echo e(route('booking.success', ['booking_id' => \Illuminate\Support\Facades\Crypt::encryptString((string) $bookingId)])); ?>"
                                            class="inline-flex w-full justify-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                                            View Booking Details
                                        </a>
                                    <?php else: ?>
                                        <span class="text-xs text-gray-500">Details unavailable</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <div class="rounded-xl border border-dashed border-gray-200 px-6 py-14 text-center">
                            <div class="text-3xl">📅</div>
                            <h3 class="mt-3 font-semibold text-gray-900">No <?php echo e($tabKey); ?> bookings found</h3>
                            <p class="mt-2 text-sm text-gray-500">Your bookings will appear here when available.</p>
                            <a href="<?php echo e(url('/services')); ?>" class="mt-4 inline-block text-sm font-semibold text-indigo-600 hover:underline">Explore services</a>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        <div class="mt-8 flex flex-col gap-4 rounded-2xl bg-indigo-600 p-6 text-white sm:flex-row sm:items-center sm:justify-between sm:p-8">
            <div>
                <h2 class="text-xl font-bold">Need help with a booking?</h2>
                <p class="mt-2 text-sm text-indigo-100">Contact HOMZgo support for booking or service questions.</p>
            </div>
            
            <a href="<?php echo e(url('/')); ?>" class="inline-flex justify-center rounded-xl bg-white px-5 py-3 text-sm font-semibold text-indigo-700 hover:bg-indigo-50">Back to Home</a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\homo\resources\views/booking/index.blade.php ENDPATH**/ ?>