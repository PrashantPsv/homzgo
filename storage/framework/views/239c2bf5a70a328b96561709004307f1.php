<?php $__env->startSection('title', 'Choose a Service | ServiceHub'); ?>

<?php $__env->startSection('content'); ?>

<div
    x-data="subcategoryServices({
        subCategoryId: <?php echo e($subCategoryId); ?>,
        collections: <?php echo \Illuminate\Support\Js::from($collections)->toHtml() ?>,
    })"
    x-init="init()"
    class="min-h-screen bg-gray-50"
>

    
    <div class="border-b border-gray-200 bg-white">

        <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8">

            <div class="flex items-center gap-3">

                <button
                    type="button"
                    onclick="history.back()"
                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 text-gray-500 transition hover:bg-gray-50"
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
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                </button>

                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-indigo-600">
                        Choose a service
                    </p>

                    <h1 class="text-xl font-bold text-gray-900">
                        Services
                    </h1>

                </div>

            </div>

        </div>

    </div>


    
    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        <div class="grid gap-8 lg:grid-cols-[230px_minmax(0,1fr)]">


            
            <aside>

                <div class="lg:sticky lg:top-6">

                    <h2 class="mb-3 text-sm font-bold text-gray-900">
                        Service Type
                    </h2>

                    
                    <div class="flex gap-2 overflow-x-auto pb-2 lg:hidden">

                        <template
                            x-for="collection in collections"
                            :key="collection.id"
                        >

                            <button
                                type="button"
                                @click="selectCollection(collection)"
                                class="shrink-0 rounded-full border px-4 py-2 text-sm font-semibold"
                                :class="
                                    selectedCollection?.id === collection.id
                                    ? 'border-indigo-600 bg-indigo-600 text-white'
                                    : 'border-gray-200 bg-white text-gray-700'
                                "
                                x-text="collection.name"
                            ></button>

                        </template>

                    </div>


                    
                    <div class="hidden space-y-2 lg:block">

                        <template
                            x-for="collection in collections"
                            :key="collection.id"
                        >

                            <button
                                type="button"
                                @click="selectCollection(collection)"
                                class="flex w-full items-center justify-between rounded-xl px-4 py-3 text-left transition"
                                :class="
                                    selectedCollection?.id === collection.id
                                    ? 'bg-indigo-50 text-indigo-700'
                                    : 'bg-white text-gray-700 hover:bg-gray-100'
                                "
                            >

                                <span
                                    class="text-sm font-semibold"
                                    x-text="collection.name"
                                ></span>

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
                                        d="m9 5 7 7-7 7"
                                    />
                                </svg>

                            </button>

                        </template>

                    </div>

                </div>

            </aside>


            
            <section>


                
                <div
                    x-show="loading"
                    x-cloak
                    class="rounded-2xl border border-gray-200 bg-white p-12 text-center"
                >

                    <div class="mx-auto h-8 w-8 animate-spin rounded-full border-2 border-gray-200 border-t-indigo-600"></div>

                    <p class="mt-3 text-sm text-gray-500">
                        Loading services...
                    </p>

                </div>


                
                <div
                    x-show="error"
                    x-cloak
                    class="rounded-2xl border border-red-200 bg-red-50 p-5"
                >

                    <p
                        class="text-sm font-medium text-red-700"
                        x-text="error"
                    ></p>

                    <button
                        type="button"
                        @click="loadPackageGroups()"
                        class="mt-3 text-sm font-semibold text-red-700 underline"
                    >
                        Try Again
                    </button>

                </div>


                
                <div
                    x-show="!loading && !error"
                    x-cloak
                >

                    <div class="mb-6">

                        <h2
                            class="text-2xl font-bold text-gray-900"
                            x-text="selectedCollection?.name || 'Available Services'"
                        ></h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Select the service you need
                        </p>

                    </div>


                    
                    <div class="space-y-8">

                        <template
                            x-for="group in packageGroups"
                            :key="group.id"
                        >

                            <div>

                                <div class="mb-4">

                                    <h3
                                        class="text-lg font-bold text-gray-900"
                                        x-text="group.name"
                                    ></h3>

                                    <p
                                        x-show="group.description"
                                        class="mt-1 text-sm text-gray-500"
                                        x-text="group.description"
                                    ></p>

                                </div>


                                <div class="space-y-3">

                                    <template
                                        x-for="pkg in group.packages"
                                        :key="pkg.id"
                                    >

                                        <div
                                            class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm transition hover:border-indigo-200 hover:shadow-md"
                                        >

                                            <div class="flex gap-4">


                                                
                                                <div class="hidden h-28 w-28 shrink-0 overflow-hidden rounded-xl bg-gray-100 sm:block">

                                                    <template x-if="pkg.thumbnail_image">

                                                        <img
                                                            :src="pkg.thumbnail_image"
                                                            :alt="pkg.name"
                                                            class="h-full w-full object-cover"
                                                        >

                                                    </template>

                                                    <template x-if="!pkg.thumbnail_image">

                                                        <div class="flex h-full w-full items-center justify-center">

                                                            <svg
                                                                class="h-9 w-9 text-gray-300"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="1.5"
                                                                    d="M19.5 8.25l-7.5-5.25-7.5 5.25m15 0v7.5l-7.5 5.25m7.5-12.75l-7.5 5.25m0 0L4.5 8.25m7.5 5.25v7.5"
                                                                />
                                                            </svg>

                                                        </div>

                                                    </template>

                                                </div>


                                                
                                                <div class="min-w-0 flex-1">

                                                    <h4 class="text-base font-semibold text-gray-900">
                                                        <span x-text="pkg.name"></span>
                                                    </h4>


                                                    
                                                    <div
                                                        x-show="Number(pkg.rating) > 0"
                                                        class="mt-2 flex items-center gap-2"
                                                    >

                                                        <span class="text-sm font-semibold text-gray-700">
                                                            ⭐
                                                            <span x-text="pkg.rating"></span>
                                                        </span>

                                                        <span class="text-xs text-gray-400">
                                                            (<span x-text="pkg.review_count"></span>)
                                                        </span>

                                                    </div>


                                                    
                                                    <div class="mt-3 flex items-center gap-2">

                                                        <span class="text-lg font-bold text-gray-900">

                                                            ₹<span
                                                                x-text="Number(pkg.base_price).toLocaleString('en-IN')"
                                                            ></span>

                                                        </span>


                                                        <template x-if="pkg.strike_price">

                                                            <span class="text-sm text-gray-400 line-through">

                                                                ₹<span
                                                                    x-text="Number(pkg.strike_price).toLocaleString('en-IN')"
                                                                ></span>

                                                            </span>

                                                        </template>

                                                    </div>

                                                </div>


                                                
                                                <div class="flex shrink-0 items-center">

                                                    <button
                                                        type="button"
                                                        @click="openPackageDetails(pkg)"
                                                        class="rounded-xl border border-indigo-600 bg-white px-5 py-2 text-sm font-bold text-indigo-600 transition hover:bg-indigo-600 hover:text-white"
                                                    >
                                                        Add
                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                    </template>

                                </div>

                            </div>

                        </template>

                    </div>


                    
                    <div
                        x-show="packageGroups.length === 0"
                        class="rounded-2xl border border-gray-200 bg-white p-12 text-center"
                    >

                        <p class="text-sm font-medium text-gray-700">
                            No services available.
                        </p>

                    </div>

                </div>

            </section>

        </div>

    </main>



<!-- PACKAGE DETAILS MODAL -->
<div
    x-show="packageModal"
    x-cloak
    @keydown.escape.window="closePackageModal()"
    class="fixed inset-0 z-[9999] flex items-center justify-center p-3 sm:p-5"
>
    <!-- Overlay -->
    <div
        class="absolute inset-0 bg-slate-950/65 backdrop-blur-sm"
        @click="closePackageModal()"
    ></div>

    <!-- Main Modal -->
    <div
        class="relative z-10 flex max-h-[95vh] w-full max-w-3xl flex-col overflow-hidden rounded-3xl bg-white shadow-2xl"
        @click.stop
    >
        <!-- Header -->
        <div class="flex shrink-0 items-center justify-between border-b border-slate-100 px-5 py-4 sm:px-7">
            <div class="min-w-0">
                <p class="text-[11px] font-bold uppercase tracking-widest text-indigo-600">
                    HOMZgo Professional Services
                </p>

                <h2
                    class="mt-1 truncate text-lg font-extrabold text-slate-900 sm:text-xl"
                    x-text="selectedPackage?.name || 'Service Details'"
                ></h2>
            </div>

            <button
                type="button"
                @click="closePackageModal()"
                class="ml-3 flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-600 transition hover:bg-slate-200"
            >
                ✕
            </button>
        </div>

        <!-- Loading -->
        <div
            x-show="packageLoading && !selectedPackage"
            class="flex min-h-[350px] items-center justify-center"
        >
            <div class="text-center">
                <div class="mx-auto h-11 w-11 animate-spin rounded-full border-4 border-indigo-100 border-t-indigo-600"></div>
                <p class="mt-4 text-sm text-slate-500">
                    Loading service details...
                </p>
            </div>
        </div>

        <!-- Scrollable Body -->
        <div
            x-show="selectedPackage"
            class="min-h-0 flex-1 overflow-y-auto overscroll-contain"
        >
            <!-- Hero Image -->
            <div
                x-show="selectedPackage?.thumbnail_image"
                class="relative h-44 overflow-hidden bg-slate-100 sm:h-56"
            >
                <img
                    :src="selectedPackage?.thumbnail_image || ''"
                    :alt="selectedPackage?.name || 'Service'"
                    class="h-full w-full object-cover"
                >

                <div class="absolute bottom-4 left-5">
                    <span class="rounded-full bg-white/95 px-3 py-1.5 text-xs font-bold text-slate-800 shadow">
                        ★
                        <span x-text="selectedPackage?.rating || '0.0'"></span>
                        <span
                            class="font-normal text-slate-500"
                            x-text="'(' + (selectedPackage?.review_count || 0) + ' reviews)'"
                        ></span>
                    </span>
                </div>
            </div>

            <div class="space-y-7 p-5 sm:p-7">

                <!-- Service Description -->
                <section>
                    <h3
                        class="text-xl font-extrabold text-slate-900"
                        x-text="selectedPackage?.name"
                    ></h3>

                    <p
                        class="mt-2 text-sm leading-6 text-slate-500"
                        x-text="selectedPackage?.description || 'Professional service performed by trained experts.'"
                    ></p>
                </section>

                <!-- VARIANT SELECTION -->
                <section
                    x-show="['variant', 'combined'].includes(selectedPackage?.pricing_mode)"
                    class="rounded-2xl border border-indigo-100 bg-indigo-50/40 p-4 sm:p-5"
                >
                    <h3 class="text-base font-extrabold text-slate-900">Choose Service Variant</h3>
                    <p class="mt-1 mb-4 text-xs text-slate-500">Choose the option that suits your service</p>

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <template x-for="variant in selectedPackage?.variants || []" :key="variant.id">
                            <label
                                class="flex cursor-pointer items-center gap-3 rounded-xl border-2 p-4 transition"
                                :class="selectedVariantId !== null && Number(selectedVariantId) === Number(variant.id)
                                    ? 'border-indigo-600 bg-indigo-50'
                                    : 'border-slate-200 bg-white hover:border-indigo-300'"
                            >
                                <input type="radio" name="package_variant"
                                    class="h-5 w-5 shrink-0 accent-indigo-600"
                                    :value="variant.id"
                                    :checked="selectedVariantId !== null && Number(selectedVariantId) === Number(variant.id)"
                                    @change="setPackageVariant(variant)">
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-bold text-slate-900" x-text="variant.name || variant.label"></p>
                                    <p x-show="variant.price != null" class="mt-1 text-sm font-semibold text-indigo-600"
                                        x-text="'₹' + formatPackagePrice(variant.price)"></p>
                                </div>
                            </label>
                        </template>
                    </div>
                    <p x-show="!(selectedPackage?.variants || []).length" class="mt-3 text-sm text-amber-700">
                        No variants are available for this package.
                    </p>
                </section>

                <!-- REQUIREMENT SELECTION -->
                <section
                    x-show="selectedPackage?.requirement_groups?.length"
                    class="rounded-2xl border border-indigo-100 bg-indigo-50/40 p-4 sm:p-5"
                >
                    <!-- Heading -->
                    <div class="mb-5 flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-100 text-xl text-indigo-600">
                            ⚙
                        </div>

                        <div>
                            <h3 class="font-extrabold text-slate-900">
                                Customize Your Service
                            </h3>
                            <p class="mt-1 text-xs text-slate-500">
                                Select the options that match your requirements
                            </p>
                        </div>
                    </div>

                    <!-- Requirement Groups -->
                    <div class="space-y-6">
                        <template
                            x-for="group in selectedPackage?.requirement_groups || []"
                            :key="group.id"
                        >
                            <div>
                                <!-- Group Title -->
                                <div class="mb-3 flex items-center gap-2">
                                    <h4
                                        class="text-sm font-bold text-slate-800"
                                        x-text="group.question"
                                    ></h4>

                                    <span
                                        x-show="Number(group.is_required) === 1"
                                        class="rounded-md bg-red-50 px-2 py-1 text-[10px] font-bold text-red-500"
                                    >
                                        Required
                                    </span>
                                </div>

                                <!-- SINGLE SELECTION RADIO CARDS -->
                                <template
                                    x-if="!['multiple', 'multi'].includes(group.selection_type)"
                                >
                                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                                        <template
                                            x-for="option in group.options || []"
                                            :key="option.id"
                                        >
                                            <label
                                                class="relative flex cursor-pointer items-center gap-3 rounded-xl border-2 p-4 transition-all duration-200"
                                                :class="
                                                    String(packageSelections[group.id] ?? '') === String(option.id)
                                                        ? 'border-indigo-600 bg-indigo-50 shadow-sm'
                                                        : 'border-slate-200 bg-white hover:border-indigo-300'
                                                "
                                            >
                                                <input
                                                    type="radio"
                                                    class="h-5 w-5 shrink-0 accent-indigo-600"
                                                    :name="'requirement_' + group.id"
                                                    :value="option.id"
                                                    :checked="
                                                        String(packageSelections[group.id] ?? '') === String(option.id)
                                                    "
                                                    @change="setPackageSelection(group, option.id)"
                                                >

                                                <div class="min-w-0 flex-1">
                                                    <p
                                                        class="text-sm font-bold text-slate-800"
                                                        x-text="option.label"
                                                    ></p>

                                                    <!-- Option Price -->
                                                    <p
                                                        x-show="optionRateCardPrice(group, option) !== null"
                                                        class="mt-1 text-xs font-bold text-indigo-600"
                                                        x-text="
                                                            optionRateCardPrice(group, option) !== null
                                                                ? '₹' + formatPackagePrice(optionRateCardPrice(group, option))
                                                                : ''
                                                        "
                                                    ></p>
                                                </div>

                                                <!-- Selected Check -->
                                                <span
                                                    x-show="
                                                        String(packageSelections[group.id] ?? '') === String(option.id)
                                                    "
                                                    class="absolute -right-2 -top-2 flex h-5 w-5 items-center justify-center rounded-full bg-indigo-600 text-xs text-white"
                                                >
                                                    ✓
                                                </span>
                                            </label>
                                        </template>
                                    </div>
                                </template>

                                <!-- MULTIPLE SELECTION CHECKBOXES -->
                                <template
                                    x-if="['multiple', 'multi'].includes(group.selection_type)"
                                >
                                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                        <template
                                            x-for="option in group.options || []"
                                            :key="option.id"
                                        >
                                            <label
                                                class="flex cursor-pointer items-center gap-3 rounded-xl border-2 p-4 transition"
                                                :class="
                                                    (packageSelections[group.id] || [])
                                                        .map(String)
                                                        .includes(String(option.id))
                                                        ? 'border-indigo-600 bg-indigo-50'
                                                        : 'border-slate-200 bg-white hover:border-indigo-300'
                                                "
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="h-5 w-5 accent-indigo-600"
                                                    :checked="
                                                        (packageSelections[group.id] || [])
                                                            .map(String)
                                                            .includes(String(option.id))
                                                    "
                                                    @change="togglePackageOption(group, option.id)"
                                                >

                                                <span
                                                    class="text-sm font-semibold text-slate-800"
                                                    x-text="option.label"
                                                ></span>
                                            </label>
                                        </template>
                                    </div>
                                </template>

                                <p
                                    x-show="Number(group.affects_price) === 1"
                                    class="mt-3 text-xs text-indigo-600"
                                >
                                    ⓘ Price depends on selected configuration
                                </p>
                            </div>
                        </template>
                    </div>
                </section>

                <!-- DYNAMIC PRICE -->
                <section class="rounded-2xl border border-indigo-100 bg-gradient-to-r from-indigo-50 to-white p-5">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wide text-indigo-600">
                                Service Price
                            </p>

                            <template x-if="packageTotal() !== null">
                                <div>
                                    <div class="mt-2 flex flex-wrap items-center gap-3">
                                        <span class="text-3xl font-black text-slate-900">
                                            ₹<span x-text="formatPackagePrice(packageTotal())"></span>
                                        </span>

                                        <span
                                            x-show="packageStrikePrice() !== null && packageStrikePrice() > packageTotal()"
                                            class="text-base text-slate-400 line-through"
                                        >
                                            ₹<span x-text="formatPackagePrice(packageStrikePrice())"></span>
                                        </span>
                                    </div>

                                    <span
                                        x-show="packageDiscount() > 0"
                                        class="mt-2 inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700"
                                        x-text="packageDiscount() + '% OFF'"
                                    ></span>
                                </div>
                            </template>

                            <p
                                x-show="packageTotal() === null"
                                class="mt-2 text-sm font-medium text-slate-600"
                            >
                                Select service options to view pricing. For combined pricing, the final amount is calculated at checkout.
                            </p>
                        </div>

                        <!-- <div class="rounded-xl bg-white px-3 py-2 text-xs font-semibold text-emerald-700 shadow-sm">
                            ✓ Transparent Pricing
                        </div> -->
                    </div>
                </section>

                <!-- Highlights -->
                <section x-show="selectedPackage?.highlights?.length">
                    <h3 class="mb-4 text-lg font-extrabold text-slate-900">
                        Service Highlights
                    </h3>

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <template
                            x-for="item in selectedPackage?.highlights || []"
                            :key="item.id"
                        >
                            <div class="flex items-start gap-3 rounded-xl bg-emerald-50 p-3">
                                <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-xs font-bold text-emerald-700">
                                    ✓
                                </span>

                                <span
                                    class="text-sm leading-5 text-slate-700"
                                    x-text="item.text"
                                ></span>
                            </div>
                        </template>
                    </div>
                </section>

                <!-- Included / Excluded -->
                <section x-show="selectedPackage?.includes?.length">
                    <h3 class="mb-4 text-lg font-extrabold text-slate-900">
                        What's Included & Excluded
                    </h3>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <!-- Included -->
                        <div class="rounded-2xl border border-emerald-100 bg-emerald-50/50 p-4">
                            <h4 class="mb-3 font-bold text-emerald-700">
                                ✓ Included
                            </h4>

                            <template
                                x-for="item in (selectedPackage?.includes || []).filter(x => x.type === 'included')"
                                :key="item.id"
                            >
                                <div class="mb-3 flex items-start gap-2 text-sm text-slate-600">
                                    <span class="font-bold text-emerald-600">✓</span>
                                    <span x-text="item.text"></span>
                                </div>
                            </template>
                        </div>

                        <!-- Excluded -->
                        <div class="rounded-2xl border border-rose-100 bg-rose-50/50 p-4">
                            <h4 class="mb-3 font-bold text-rose-700">
                                ✕ Excluded
                            </h4>

                            <template
                                x-for="item in (selectedPackage?.includes || []).filter(x => x.type === 'excluded')"
                                :key="item.id"
                            >
                                <div class="mb-3 flex items-start gap-2 text-sm text-slate-600">
                                    <span class="font-bold text-rose-500">✕</span>
                                    <span x-text="item.text"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                </section>

                <!-- Process Steps -->
                <section x-show="selectedPackage?.process_steps?.length">
                    <h3 class="mb-5 text-lg font-extrabold text-slate-900">
                        How Our Service Works
                    </h3>

                    <div class="space-y-4">
                        <template
                            x-for="(step, index) in selectedPackage?.process_steps || []"
                            :key="step.id"
                        >
                            <div class="flex gap-4">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-100 font-extrabold text-indigo-700"
                                    x-text="index + 1"
                                ></div>

                                <div class="flex-1 border-b border-slate-100 pb-4">
                                    <h4
                                        class="font-bold text-slate-900"
                                        x-text="step.title"
                                    ></h4>

                                    <p
                                        class="mt-1 text-sm leading-6 text-slate-500"
                                        x-text="step.description"
                                    ></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </section>

                <!-- FAQs -->
                <section x-show="selectedPackage?.faqs?.length">
                    <h3 class="mb-4 text-lg font-extrabold text-slate-900">
                        Frequently Asked Questions
                    </h3>

                    <div class="space-y-3">
                        <template
                            x-for="faq in selectedPackage?.faqs || []"
                            :key="faq.id"
                        >
                            <details class="group rounded-xl border border-slate-200 bg-white">
                                <summary class="flex cursor-pointer list-none items-center justify-between gap-3 p-4 text-sm font-bold text-slate-800">
                                    <span x-text="faq.question"></span>
                                    <span class="text-lg text-indigo-600">+</span>
                                </summary>

                                <p
                                    class="px-4 pb-4 text-sm leading-6 text-slate-500"
                                    x-text="faq.answer"
                                ></p>
                            </details>
                        </template>
                    </div>
                </section>

            </div>
        </div>

        
        <!-- STICKY FOOTER -->
        <div
            x-show="selectedPackage"
            class="shrink-0 border-t border-slate-200 bg-white px-5 py-4 sm:px-7"
        >
            <!-- Error -->
            <div
                x-show="packageError"
                x-text="packageError"
                class="mb-3 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-600"
            ></div>

            <div class="flex flex-wrap items-center justify-between gap-4">

                <!-- Total Price -->
                <div>
                    <p class="text-xs text-slate-500">
                        Total Amount
                    </p>

                    <p
                        class="text-2xl font-black text-slate-900"
                        x-text="
                            packageTotal() === null
                                ? 'Select options'
                                : '₹' + formatPackagePrice(packageTotal())
                        "
                    ></p>
                </div>

                <!-- Add to Cart -->
                <template x-if="!currentCartItem()">
                    <button
                        type="button"
                        @click="addConfiguredPackage()"
                        :disabled="packageLoading || packageTotal() === null"
                        class="rounded-xl bg-indigo-600 px-6 py-3 font-bold text-white disabled:opacity-50"
                    >
                        <span
                            x-text="packageLoading ? 'Adding...' : 'Add to Cart'"
                        ></span>
                    </button>
                </template>

                <!-- Quantity Controls -->
                <template x-if="currentCartItem()">
                    <div class="flex flex-wrap items-center gap-3">

                        <div class="flex items-center overflow-hidden rounded-xl border border-indigo-200">

                            <!-- Minus -->
                            <button
                                type="button"
                                @click="decreaseQuantity(selectedPackage)"
                                :disabled="packageLoading"
                                class="flex h-11 w-11 items-center justify-center bg-indigo-50 text-xl font-bold text-indigo-600 hover:bg-indigo-100 disabled:opacity-50"
                            >
                                −
                            </button>

                            <!-- Quantity -->
                            <span
                                class="flex h-11 min-w-[45px] items-center justify-center px-3 font-bold text-slate-900"
                                x-text="currentCartItem()?.quantity ?? 1"
                            ></span>

                            <!-- Plus -->
                            <button
                                type="button"
                                @click="increaseQuantity(selectedPackage)"
                                :disabled="packageLoading"
                                class="flex h-11 w-11 items-center justify-center bg-indigo-50 text-xl font-bold text-indigo-600 hover:bg-indigo-100 disabled:opacity-50"
                            >
                                +
                            </button>

                        </div>

                        <a
                            href="<?php echo e(route('cart.index')); ?>"
                            class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white"
                        >
                            View Cart →
                        </a>

                    </div>
                </template>

            </div>
        </div>
    </div>
</div>



<?php $__env->startPush('scripts'); ?>

<script>

function subcategoryServices(config) {
    return {
        subCategoryId: config.subCategoryId,
        collections: config.collections || [],

        selectedCollection: null,
        packageGroups: [],
        loading: false,
        error: null,

        cart: [],

        // Package details modal
        packageModal: false,
        packageLoading: false,
        packageError: null,
        selectedPackage: null,
        guestToken: null,
        selectedVariantId: null,
        sectionSelections: [],

        init() {
            this.guestToken =
                localStorage.getItem('servicehub_guest_token');

            if (!this.guestToken) {
                this.guestToken = crypto.randomUUID();

                localStorage.setItem(
                    'servicehub_guest_token',
                    this.guestToken
                );
            }

            if (this.collections.length) {
                this.selectCollection(this.collections[0]);
            }

        },

        async selectCollection(collection) {
            this.selectedCollection = collection;
            this.packageGroups = [];
            this.loading = true;
            this.error = null;

            try {
                const response = await fetch(
                    `/service-collections/${collection.id}/package-groups`,
                    {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        credentials: 'same-origin',
                    }
                );

                const result = await response.json();

                if (!response.ok || !result.status) {
                    throw new Error(
                        result.message || 'Unable to load services.'
                    );
                }

                this.packageGroups = result.data || [];

            } catch (error) {
                console.error('Package group error:', error);

                this.error =
                    error.message || 'Unable to load services.';

            } finally {
                this.loading = false;
            }
        },

        async openPackageDetails(pkg) {

            console.log('OPEN PACKAGE:', pkg);

            if (!pkg || !pkg.id) {
                console.error('Invalid package:', pkg);
                return;
            }

            // Open modal IMMEDIATELY
            this.packageModal = true;

            this.packageLoading = true;
            this.packageError = null;
            this.selectedPackage = null;

            try {
                const response = await fetch(
                    `/packages/${pkg.id}/details`,
                    {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        credentials: 'same-origin',
                    }
                );

                const result = await response.json();

                console.log('PACKAGE DETAILS:', result);

                if (!response.ok || !result.status) {
                    throw new Error(
                        result.message ||
                        'Unable to load package details.'
                    );
                }

                this.selectedPackage = result.data;
                this.selectedVariantId = null;
                this.sectionSelections = [];
                this.initializePackageRequirements();
                // Seed the exact cart item returned by the details endpoint, if available.
                // For configurable packages, the customer must select a matching configuration first.
                const apiCartItem = result.data?.cart_item;
                if (apiCartItem?.id && !['variant', 'requirement', 'combined'].includes(result.data.pricing_mode)) {
                    const id = Number(apiCartItem.cart_item_id ?? apiCartItem.id);
                    if (!this.cart.some(item => Number(item.cart_item_id) === id)) {
                        this.cart.push({
                            cart_item_id: id,
                            package_id: Number(result.data.id),
                            package_variant_id: apiCartItem.package_variant_id ?? null,
                            selection_combination: this.cartSelectionCombination(apiCartItem.selections),
                            quantity: Number(apiCartItem.quantity ?? 1),
                            price: Number(apiCartItem.unit_price ?? 0),
                        });
                    }
                }
                this.syncSelectedCartItem();


            } catch (error) {

                console.error(
                    'Package details error:',
                    error
                );

                this.packageError =
                    error.message ||
                    'Unable to load package details.';

            } finally {

                this.packageLoading = false;
            }
        },

        currentCartItem() {
            const pkg = this.selectedPackage;
            if (!pkg) return null;

            const variantId = ['variant', 'combined'].includes(pkg.pricing_mode)
                ? this.selectedVariantId
                : null;

            const selections = ['requirement', 'combined'].includes(pkg.pricing_mode)
                ? this.selectedRequirementOptions()
                : {};

            return this.cart.find(item => {
                if (Number(item.package_id) !== Number(pkg.id)) {
                    return false;
                }

                if (
                    String(item.package_variant_id ?? '') !==
                    String(variantId ?? '')
                ) {
                    return false;
                }

                const stored = {};

                for (const selection of item.selections || []) {
                    if (selection.selection_type === 'requirement') {
                        stored[String(selection.reference_id)] =
                            Number(selection.option_id);
                    }
                }

                const expected = Object.fromEntries(
                    Object.entries(selections).map(([key, value]) => [
                        key,
                        Number(value)
                    ])
                );

                return this.combinationsMatch(stored, expected);
            }) || null;
        },

        syncSelectedCartItem() {
            if (!this.selectedPackage) return;
            const item = this.currentCartItem();
            this.selectedPackage.iscart = item ? 1 : 0;
            this.selectedPackage.in_cart = !!item;
            this.selectedPackage.cart_item_id = item?.cart_item_id ?? null;
            this.selectedPackage.cart_quantity = Number(item?.quantity ?? 0);
        },

        async increaseQuantity(pkg) {
            const item = this.currentCartItem();

            if (!item) {
                this.packageError = 'Cart item not found.';
                return;
            }

            await this.updateCartQuantity(
                Number(item.cart_item_id ?? item.id),
                Number(item.quantity) + 1
            );
        },

        async decreaseQuantity(pkg) {
            const item = this.currentCartItem();

            if (!item) {
                this.packageError = 'Cart item not found.';
                return;
            }

            const quantity = Number(item.quantity);

            if (quantity <= 1) {
                // Use your existing remove-item API here.
                // The item must be removed from the cart and
                // local state after successful deletion.
                this.packageError = 'Remove this service from your cart to continue.';
                return;
            }

            await this.updateCartQuantity(
                Number(item.cart_item_id ?? item.id),
                quantity - 1
            );
        },

        async updateCartQuantity(cartItemId, quantity) {
            const item = this.cart.find(
                item => Number(item.cart_item_id ?? item.id) === Number(cartItemId)
            );

            if (!item) {
                this.packageError = 'Cart item not found.';
                return;
            }

            this.packageLoading = true;
            this.packageError = null;

            try {
                const response = await fetch(
                    `/cart/items/${cartItemId}`,
                    {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN':
                                document.querySelector('meta[name="csrf-token"]')
                                    ?.getAttribute('content') || ''
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify({
                            quantity: Number(quantity),
                            guest_token: this.guestToken
                        })
                    }
                );

                const result = await response.json();

                if (!response.ok || result.status === false) {
                    throw new Error(
                        result.message || 'Unable to update quantity.'
                    );
                }

                item.quantity = Number(result.data?.quantity ?? quantity);

                this.selectedPackage.cart_quantity = item.quantity;

                window.dispatchEvent(new CustomEvent('cart-updated'));

            } catch (error) {
                this.packageError = error.message;
            } finally {
                this.packageLoading = false;
            }
        },

        async removeCartItem(item) {
            if (this.packageLoading || !item?.cart_item_id) return;
            this.packageLoading = true;
            this.packageError = null;
            try {
                const response = await fetch(`/cart/items/${item.cart_item_id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({ guest_token: this.guestToken }),
                });
                const result = await response.json();
                if (!response.ok || result.status === false) throw new Error(result.message || 'Unable to remove item.');
                this.cart = this.cart.filter(row => Number(row.cart_item_id) !== Number(item.cart_item_id));
                this.syncSelectedCartItem();
                window.dispatchEvent(new CustomEvent('cart-updated'));
            } catch (error) {
                this.packageError = error.message || 'Unable to remove item.';
            } finally {
                this.packageLoading = false;
            }
        },

        closePackageModal() {
            this.packageModal = false;
            this.selectedPackage = null;
            this.packageError = null;
        },


        
        packageSelections: {},

        // Initialize requirement selections
        initializePackageRequirements() {
            this.packageSelections = {};
            this.packageError = '';

            const groups = this.selectedPackage?.requirement_groups || [];

            groups.forEach(group => {
                const multiple = ['multiple', 'multi']
                    .includes(group.selection_type);

                this.packageSelections[group.id] = multiple ? [] : '';
            });
        },

        // Select radio option
        setPackageSelection(group, optionId) {
            this.packageSelections = {
                ...this.packageSelections,
                [group.id]: Number(optionId)
            };

            this.packageError = '';
            this.syncSelectedCartItem();
        },

        // Toggle checkbox option
        togglePackageOption(group, optionId) {
            const current = [...(this.packageSelections[group.id] || [])];

            const index = current.findIndex(
                id => Number(id) === Number(optionId)
            );

            if (index >= 0) {
                current.splice(index, 1);
            } else {
                current.push(Number(optionId));
            }

            this.packageSelections = {
                ...this.packageSelections,
                [group.id]: current
            };

            this.packageError = '';
            this.syncSelectedCartItem();
        },

        // Build the option combination for pricing
        pricingCombination() {
            const combination = {};

            const groups = this.selectedPackage?.requirement_groups || [];

            for (const group of groups) {
                if (Number(group.affects_price) !== 1) continue;

                const selected = this.packageSelections[group.id];

                if (
                    selected === '' ||
                    selected == null ||
                    (Array.isArray(selected) && selected.length === 0)
                ) {
                    return null;
                }

                combination[String(group.id)] = Array.isArray(selected)
                    ? selected.map(String).sort()
                    : String(selected);
            }

            return Object.keys(combination).length ? combination : null;
        },

        // Match two option combinations
        combinationsMatch(first, second) {
            if (!first || !second) return false;

            const firstKeys = Object.keys(first).sort();
            const secondKeys = Object.keys(second).sort();

            if (firstKeys.length !== secondKeys.length) return false;

            return firstKeys.every((key, index) => {
                if (key !== secondKeys[index]) return false;

                const a = first[key];
                const b = second[key];

                if (Array.isArray(a) || Array.isArray(b)) {
                    if (!Array.isArray(a) || !Array.isArray(b)) {
                        return false;
                    }

                    return JSON.stringify(a.map(String).sort()) ===
                        JSON.stringify(b.map(String).sort());
                }

                return String(a) === String(b);
            });
        },

        // Find selected rate card
        selectedRateCard() {
            if (!['requirement', 'combined'].includes(this.selectedPackage?.pricing_mode)) {
                return null;
            }

            const combination = this.pricingCombination();

            if (!combination) return null;

            const cards = this.selectedPackage?.rate_cards || [];

            return cards.find(card => {
                if (Number(card.is_active) !== 1 || card.deleted_at) {
                    return false;
                }

                if (this.selectedPackage.pricing_mode === 'combined') {
                    if (this.selectedVariantId === null || card.variant_id == null ||
                        Number(card.variant_id) !== Number(this.selectedVariantId)) return false;
                }
                return this.combinationsMatch(combination, card.option_combination);
            }) || null;
        },

        // Display price on individual radio option
        optionRateCardPrice(group, option) {
            const pricingGroups = (
                this.selectedPackage?.requirement_groups || []
            ).filter(g => Number(g.affects_price) === 1);

            // Only show independent option prices when
            // a single pricing group controls the rate card.
            if (
                pricingGroups.length !== 1 ||
                Number(pricingGroups[0].id) !== Number(group.id)
            ) {
                return null;
            }

            const cards = this.selectedPackage?.rate_cards || [];

            const card = cards.find(card => {
                if (Number(card.is_active) !== 1 || card.deleted_at) {
                    return false;
                }

                return this.combinationsMatch(
                    { [String(group.id)]: String(option.id) },
                    card.option_combination
                );
            });

            return card ? Number(card.price) : null;
        },

        // Variant selection and pricing
        setPackageVariant(variant) {
            this.selectedVariantId = Number(variant.id);
            this.packageError = '';
            this.syncSelectedCartItem();
        },

        selectedPackageVariant() {
            if (this.selectedVariantId === null) return null;
            return (this.selectedPackage?.variants || []).find(
                variant => Number(variant.id) === Number(this.selectedVariantId)
            ) || null;
        },

        // The API must return a final combination price for combined mode.
        packagePriceSource() {
            if (!this.selectedPackage) return null;
            const mode = this.selectedPackage.pricing_mode;
            if (mode === 'fixed') return this.selectedPackage;
            if (mode === 'variant') return this.selectedPackageVariant();
            if (mode === 'requirement') return this.selectedRateCard();
            if (mode === 'combined') {
                const variant = this.selectedPackageVariant();
                const rateCard = this.selectedRateCard();
                if (!variant || !rateCard) return null;
                // Only use a card explicitly associated with this variant.
                return Number(rateCard.variant_id) === Number(variant.id) ? rateCard : null;
            }
            return null;
        },

        packageTotal() {
            const source = this.packagePriceSource();
            return source?.price != null
                ? Number(source.price)
                : (source?.base_price != null ? Number(source.base_price) : null);
        },

        packageStrikePrice() {
            const source = this.packagePriceSource();
            return source?.strike_price != null ? Number(source.strike_price) : null;
        },

        // Discount percentage
        packageDiscount() {
            const price = this.packageTotal();
            const strike = this.packageStrikePrice();

            if (
                price === null ||
                strike === null ||
                strike <= price
            ) {
                return 0;
            }

            return Math.round(((strike - price) / strike) * 100);
        },

        // Format INR price
        formatPackagePrice(value) {
            if (value === null || value === undefined) return '—';

            return Number(value).toLocaleString('en-IN', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 2
            });
        },

        // Validate required groups and rate card
        validatePackageRequirements() {
            const groups = this.selectedPackage?.requirement_groups || [];

            for (const group of groups) {
                if (Number(group.is_required) !== 1) continue;

                const selected = this.packageSelections[group.id];

                if (
                    selected === '' ||
                    selected == null ||
                    (Array.isArray(selected) && selected.length === 0)
                ) {
                    this.packageError = `Please select ${group.question}.`;
                    return false;
                }
            }

            if (
                ['requirement', 'combined'].includes(this.selectedPackage?.pricing_mode) &&
                !this.selectedRateCard()
            ) {
                this.packageError =
                    'Pricing is unavailable for the selected configuration.';

                return false;
            }

            this.packageError = '';
            return true;
        },

        // Build selection payload
        selectedRequirementOptions() {
            const result = {};

            const groups = this.selectedPackage?.requirement_groups || [];

            for (const group of groups) {
                const selected = this.packageSelections[group.id];

                if (
                    selected === '' ||
                    selected == null ||
                    (Array.isArray(selected) && selected.length === 0)
                ) {
                    continue;
                }

                result[String(group.id)] = Array.isArray(selected)
                    ? selected.map(String)
                    : String(selected);
            }

            return result;
        },

        // Validate and call existing cart function
        addConfiguredPackage() {
            this.confirmAddPackage();
        },

        // The CMS store validator requires arrays, NOT JSON-encoded strings.
        buildAddToCartPayload() {
            const pkg = this.selectedPackage;
            if (!pkg) throw new Error('Select a service first.');
            const mode = pkg.pricing_mode;
            const payload = { package_id: Number(pkg.id), quantity: 1 };

            if (['variant', 'combined'].includes(mode)) {
                if (this.selectedVariantId === null) throw new Error('Please choose a service variant.');
                payload.variant_id = Number(this.selectedVariantId);
            }
            if (['requirement', 'combined'].includes(mode)) {
                if (!this.validatePackageRequirements()) throw new Error(this.packageError || 'Select requirements.');
                const selections = this.selectedRequirementOptions();
                payload.selections = {};
                for (const [groupId, optionId] of Object.entries(selections)) {
                    if (Array.isArray(optionId)) {
                        throw new Error('Multiple choices per group are not supported by the current CMS cart API.');
                    }
                    payload.selections[String(groupId)] = Number(optionId);
                }
            }
            if (this.sectionSelections.length) {
                payload.section_selections = this.sectionSelections.map(selection => ({
                    section_item_id: Number(selection.section_item_id),
                    option_id: Number(selection.option_id ?? 0),
                }));
            }
            // The website controller should resolve the server-side guest token.
            return payload;
        },

        // Convert returned CMS selection records into a groupId -> optionId map.
        cartSelectionCombination(selections) {
            const combination = {};
            for (const selection of (Array.isArray(selections) ? selections : [])) {
                if (selection.selection_type === 'requirement') {
                    combination[String(selection.reference_id)] = String(selection.option_id);
                }
            }
            return combination;
        },

        async confirmAddPackage() {
            if (this.packageLoading || !this.selectedPackage) return;
            let payload;
            try {
                payload = this.buildAddToCartPayload();
                // Combined prices may require a server quote; do not fabricate one.
                if (this.selectedPackage.pricing_mode !== 'combined' && this.packageTotal() === null) {
                    throw new Error('Price is unavailable for this configuration.');
                }
            } catch (error) {
                this.packageError = error.message;
                return;
            }

            this.packageLoading = true;
            this.packageError = null;
            try {
                const response = await fetch('<?php echo e(route('cart.items.store')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(payload),
                });
                const result = await response.json();
                if (!response.ok || result.status !== true) {
                    throw new Error(result.message || 'Unable to add service to cart.');
                }
                // CMS store() returns the cart item directly in data.
                const apiItem = result.data?.cart_item ?? result.data?.item ?? result.data;
                const cartItemId = apiItem?.cart_item_id ?? apiItem?.id;
                if (!cartItemId) {
                    throw new Error('Service added, but cart item ID was not returned. Please open your cart.');
                }
                const row = {
                    cart_item_id: Number(cartItemId),
                    package_id: Number(payload.package_id),
                    package_variant_id: apiItem.package_variant_id ?? payload.variant_id ?? null,
                    selection_combination: this.cartSelectionCombination(apiItem.selections),
                    selections: apiItem.selections || [],
                    quantity: Number(apiItem.quantity ?? 1),
                    price: Number(apiItem.unit_price ?? 0),
                };
                const index = this.cart.findIndex(item => Number(item.cart_item_id) === Number(cartItemId));
                if (index >= 0) this.cart.splice(index, 1, row);
                else this.cart.push(row);
                this.syncSelectedCartItem();
                window.dispatchEvent(new CustomEvent('cart-updated'));
            } catch (error) {
                this.packageError = error.message || 'Unable to add service to cart.';
            } finally {
                this.packageLoading = false;
            }
        },

        get cartCount() {
            return this.cart.reduce(
                (total, item) => total + item.quantity,
                0
            );
        },

        get cartTotal() {
            return this.cart.reduce(
                (total, item) =>
                    total +
                    (Number(item.price) * item.quantity),
                0
            );
        },
    }
}

</script>

<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\homo\resources\views/services/services.blade.php ENDPATH**/ ?>