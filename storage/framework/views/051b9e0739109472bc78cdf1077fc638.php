

<?php $__env->startSection('title', 'Support Request | ServiceHub'); ?>

<?php $__env->startSection('content'); ?>

<?php

    $ticket = [
        'id' => $ticketId,
        'subject' => 'Question about my upcoming booking',
        'category' => 'Bookings',
        'status' => 'Open',
        'created_at' => '28 September 2026, 03:20 PM',
        'booking_id' => 'SH20260929001',
    ];

    $messages = [
        [
            'sender' => 'You',
            'message' => 'I have a booking scheduled for 30 September at 01:00 PM. I would like to confirm whether the professional has been assigned.',
            'time' => '28 September 2026, 03:20 PM',
            'mine' => true,
        ],
        [
            'sender' => 'ServiceHub Support',
            'message' => 'Thanks for contacting us. Your request has been received. Our support team will check the booking and update you shortly.',
            'time' => '28 September 2026, 03:35 PM',
            'mine' => false,
        ],
    ];

?>


<div class="min-h-screen bg-gray-50">

    
    <section class="border-b border-gray-200 bg-white">

        <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">

            <div class="flex items-center gap-2 text-sm text-gray-500">

                <a
                    href="<?php echo e(route('support.index')); ?>"
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
                    Support Request
                </span>

            </div>


            <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <div class="flex flex-wrap items-center gap-2">

                        <h1 class="text-xl font-bold text-gray-900 sm:text-2xl">
                            <?php echo e($ticket['subject']); ?>

                        </h1>

                        <span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
                            <?php echo e($ticket['status']); ?>

                        </span>

                    </div>

                    <p class="mt-2 text-sm text-gray-500">
                        Ticket #<?php echo e($ticket['id']); ?>

                    </p>

                </div>


                <a
                    href="<?php echo e(route('support.contact')); ?>"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700"
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
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    New Request

                </a>

            </div>

        </div>

    </section>


    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">

        
        <div class="mb-6 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">

                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                        Category
                    </p>

                    <p class="mt-2 text-sm font-semibold text-gray-900">
                        <?php echo e($ticket['category']); ?>

                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                        Related Booking
                    </p>

                    <a
                        href="<?php echo e(route('bookings.show', ['booking' => $ticket['booking_id']])); ?>"
                        class="mt-2 block text-sm font-semibold text-indigo-600 hover:text-indigo-700"
                    >
                        <?php echo e($ticket['booking_id']); ?>

                    </a>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                        Created
                    </p>

                    <p class="mt-2 text-sm font-semibold text-gray-900">
                        <?php echo e($ticket['created_at']); ?>

                    </p>

                </div>

            </div>

        </div>


        
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-100 px-5 py-4 sm:px-6">

                <h2 class="font-semibold text-gray-900">
                    Conversation
                </h2>

            </div>


            <div class="space-y-6 p-5 sm:p-6">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>

                    <div class="flex <?php echo e($message['mine'] ? 'justify-end' : 'justify-start'); ?>">

                        <div class="max-w-2xl">

                            <div class="mb-2 flex items-center gap-2 <?php echo e($message['mine'] ? 'justify-end' : ''); ?>">

                                <span class="text-xs font-semibold text-gray-700">
                                    <?php echo e($message['sender']); ?>

                                </span>

                                <span class="text-xs text-gray-400">
                                    <?php echo e($message['time']); ?>

                                </span>

                            </div>


                            <div class="rounded-2xl px-4 py-3 text-sm leading-6
                                <?php echo e($message['mine']
                                    ? 'rounded-br-md bg-indigo-600 text-white'
                                    : 'rounded-bl-md bg-gray-100 text-gray-700'); ?>"
                            >
                                <?php echo e($message['message']); ?>

                            </div>

                        </div>

                    </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

            </div>


            
            <div class="border-t border-gray-100 bg-gray-50 p-5 sm:p-6">

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Reply to Support
                </label>

                <textarea
                    rows="4"
                    placeholder="Write your reply..."
                    class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                ></textarea>


                <div class="mt-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <p class="text-xs text-gray-500">
                        Do not share passwords, OTPs or payment PINs.
                    </p>

                    <button
                        type="button"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700"
                    >
                        Send Reply

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
                                d="M5 12h14m-6-6l6 6-6 6"
                            />
                        </svg>

                    </button>

                </div>

            </div>

        </div>


        
        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <a
                href="<?php echo e(route('support.index')); ?>"
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

                Back to Help & Support

            </a>


            <button
                type="button"
                class="text-sm font-semibold text-red-600 hover:text-red-700"
            >
                Close Request
            </button>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\homo\resources\views/support/ticket.blade.php ENDPATH**/ ?>