<?php $__env->startSection('title', 'My Profile | ServiceHub'); ?>

<?php $__env->startSection('content'); ?>


<div class="min-h-screen bg-gray-50">

    
    <section class="border-b border-gray-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <div class="mb-2 flex items-center gap-2 text-sm text-gray-500">
                        <a href="/" class="hover:text-indigo-600">
                            Home
                        </a>

                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 5l7 7-7 7"/>
                        </svg>

                        <span class="text-gray-900">
                            My Profile
                        </span>
                    </div>

                    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                        My Profile
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Manage your personal information and account settings.
                    </p>
                </div>

                <a
                    href="<?php echo e(route('profile.edit')); ?>"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>

                    Edit Profile
                </a>

            </div>

        </div>
    </section>


    
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            
            <div class="lg:col-span-1">

                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                    
                    <div class="h-28 bg-gradient-to-r from-indigo-600 to-indigo-500"></div>

                    <div class="px-6 pb-6">

                        
                        <div class="-mt-12 mb-4 flex justify-center">
                            <div class="flex h-24 w-24 items-center justify-center rounded-full border-4 border-white bg-indigo-100 text-2xl font-bold text-indigo-700 shadow-sm">
                                <img src="<?php echo e($user['profile_image']); ?>">
                            </div>
                        </div>

                        <div class="text-center">
                            <h2 class="text-xl font-bold text-gray-900">
                                <?php echo e($user['first_name']); ?> <?php echo e($user['last_name']); ?>

                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                <?php echo e($user['email']); ?>

                            </p>

                            <div class="mt-3 inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                Active Account
                            </div>
                        </div>

                        <div class="mt-6 border-t border-gray-100 pt-5">

                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">
                                    Member since
                                </span>

                                <span class="font-medium text-gray-900">
                                    <?php echo e(date('d-M-Y',strtotime($user['member_since']))); ?>

                                </span>
                            </div>
                            

                            <div class="mt-3 flex items-center justify-between text-sm">
                                <span class="text-gray-500">
                                    Customer Number
                                </span>

                                <span class="font-medium text-gray-900">
                                    <?php echo e($user['sid']); ?>

                                </span>
                            </div>
                            
                            <div class="mt-3 flex items-center justify-between text-sm">
                                <span class="text-gray-500">
                                    Mobile
                                </span>

                                <span class="font-medium text-gray-900">
                                    <?php echo e($user['phone']); ?>

                                </span>
                            </div>

                        </div>

                    </div>
                </div>


                
                <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="border-b border-gray-100 px-5 py-4">
                        <h3 class="font-semibold text-gray-900">
                            Quick Links
                        </h3>
                    </div>

                    <div class="divide-y divide-gray-100">

                        <a
                            href="<?php echo e(route('booking.index')); ?>"
                            class="flex items-center justify-between px-5 py-4 transition hover:bg-gray-50"
                        >
                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>

                                <span class="text-sm font-medium text-gray-700">
                                    My Bookings
                                </span>

                            </div>

                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>


                        <a
                            href="<?php echo e(route('profile.addresses')); ?>"
                            class="flex items-center justify-between px-5 py-4 transition hover:bg-gray-50"
                        >
                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-purple-50 text-purple-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a8 8 0 1111.314 0l-4.243 4.243a2 2 0 01-2.828 0l-4.243-4.243z"
                                        />
                                    </svg>
                                </div>

                                <span class="text-sm font-medium text-gray-700">
                                    Saved Addresses
                                </span>

                            </div>

                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </a>


                        <a
                            href="<?php echo e(route('support.index')); ?>"
                            class="flex items-center justify-between px-5 py-4 transition hover:bg-gray-50"
                        >
                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-50 text-orange-600">

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
                                            d="M8.228 9c.549-1.165 1.9-2 3.772-2 2.21 0 4 1.343 4 3 0 1.5-1.3 2.5-3.2 3.5-.8.4-1.2 1.1-1.2 2"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 19h.01"
                                        />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="9"
                                            stroke-width="2"
                                        />
                                    </svg>

                                </div>

                                <span class="text-sm font-medium text-gray-700">
                                    Help & Support
                                </span>

                            </div>

                            <svg
                                class="h-4 w-4 text-gray-400"
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

                        </a>

                    </div>
                </div>

            </div>


            
            <div class="space-y-6 lg:col-span-2">

                
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>

                        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

                            <div class="flex items-center justify-between">

                                <div>
                                    <p class="text-sm text-gray-500">
                                        <?php echo e($stat['label']); ?>

                                    </p>

                                    <p class="mt-2 text-2xl font-bold text-gray-900">
                                        <?php echo e($stat['value']); ?>

                                    </p>
                                </div>

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($stat['icon'] === 'calendar'): ?>

                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>

                                    <?php elseif($stat['icon'] === 'check'): ?>

                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M5 13l4 4L19 7"/>
                                        </svg>

                                    <?php else: ?>

                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </div>

                            </div>

                        </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                </div>


                
                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="flex items-center justify-between border-b border-gray-100 px-6 py-5">

                        <div>
                            <h2 class="font-semibold text-gray-900">
                                Personal Information
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Your basic account information.
                            </p>
                        </div>

                        <a
                            href="<?php echo e(route('profile.edit')); ?>"
                            class="text-sm font-semibold text-indigo-600 hover:text-indigo-700"
                        >
                            Edit
                        </a>

                    </div>


                    <div class="grid grid-cols-1 gap-6 px-6 py-6 sm:grid-cols-2">

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                First Name
                            </p>

                            <p class="mt-2 text-sm font-medium text-gray-900">
                                <?php echo e($user['first_name']); ?>

                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Last Name
                            </p>

                            <p class="mt-2 text-sm font-medium text-gray-900">
                                <?php echo e($user['last_name']); ?>

                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Email Address
                            </p>

                            <p class="mt-2 break-all text-sm font-medium text-gray-900">
                                <?php echo e($user['email']); ?>

                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Mobile Number
                            </p>

                            <p class="mt-2 text-sm font-medium text-gray-900">
                                <?php echo e($user['phone']); ?>

                            </p>
                        </div>

                    </div>

                </div>


                
                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="border-b border-gray-100 px-6 py-5">
                        <h2 class="font-semibold text-gray-900">
                            Security
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Manage your password and account security.
                        </p>
                    </div>

                    <div class="divide-y divide-gray-100">

                        <div class="flex flex-col gap-4 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                            <div class="flex items-center gap-4">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-gray-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M12 15v2m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2zm10-11V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        Password
                                    </p>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Last updated recently
                                    </p>
                                </div>

                            </div>

                            <a
                                href="<?php echo e(route('password.request')); ?>"
                                class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                            >
                                Change Password
                            </a>

                        </div>


                        <div class="flex flex-col gap-4 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                            <div class="flex items-center gap-4">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-green-50 text-green-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 12c0 5.591 3.824 10.29 9 11.622C17.176 22.29 21 17.591 21 12c0-1.045-.133-2.059-.382-3.016z"/>
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        Account Security
                                    </p>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Your account is protected.
                                    </p>
                                </div>

                            </div>

                            <span class="inline-flex w-fit items-center rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                                Secure
                            </span>

                        </div>

                    </div>
                </div>


                
                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                    <div class="border-b border-gray-100 px-6 py-5">

                        <h2 class="font-semibold text-gray-900">
                            Notifications
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Manage how ServiceHub keeps you updated.
                        </p>

                    </div>

                    <div class="divide-y divide-gray-100">

                        <div class="flex items-center justify-between gap-4 px-6 py-5">

                            <div>
                                <p class="text-sm font-medium text-gray-900">
                                    Booking Updates
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    Receive updates about your bookings.
                                </p>
                            </div>

                            <div class="relative h-6 w-11 shrink-0 rounded-full bg-indigo-600">
                                <div class="absolute right-1 top-1 h-4 w-4 rounded-full bg-white shadow-sm"></div>
                            </div>

                        </div>


                        <div class="flex items-center justify-between gap-4 px-6 py-5">

                            <div>
                                <p class="text-sm font-medium text-gray-900">
                                    Offers & Promotions
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    Get special offers and service recommendations.
                                </p>
                            </div>

                            <div class="relative h-6 w-11 shrink-0 rounded-full bg-gray-300">
                                <div class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white shadow-sm"></div>
                            </div>

                        </div>

                    </div>

                </div>


                
                <div class="rounded-2xl border border-red-100 bg-red-50 p-5">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Sign out of your account
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                You can sign back in anytime using your account credentials.
                            </p>
                        </div>

                        <a
                            href="<?php echo e(route('login')); ?>"
                            class="inline-flex items-center justify-center rounded-xl border border-red-200 bg-white px-5 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                        >
                            Sign Out
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\homo\resources\views/profile/index.blade.php ENDPATH**/ ?>