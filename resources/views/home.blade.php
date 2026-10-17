<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HomeCare - Home Services at Your Doorstep</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#2563eb',
                        dark: '#111827',
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >
</head>

<body class="bg-gray-50 text-gray-900 font-sans">

<!-- =========================================================
     HEADER
========================================================= -->

<header class="bg-white border-b border-gray-100 sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="h-20 flex items-center justify-between">

            <!-- Logo -->

            <a href="#" class="flex items-center gap-2">

                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
                    <span class="text-white text-xl font-bold">H</span>
                </div>

                <div>
                    <div class="text-xl font-bold text-gray-900">
                        HomeCare
                    </div>

                    <div class="text-xs text-gray-500">
                        Services at your doorstep
                    </div>
                </div>

            </a>


            <!-- Desktop Navigation -->

            <nav class="hidden lg:flex items-center gap-8">

                <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                    Home
                </a>

                <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                    Services
                </a>

                <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                    About Us
                </a>

                <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                    Contact
                </a>

            </nav>


            <!-- Right -->

            <div class="flex items-center gap-4">

                <button
                    class="hidden sm:flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-blue-600">

                    <span>📍</span>

                    Ahmedabad

                    <span class="text-gray-400">⌄</span>

                </button>


                <button
                    class="hidden sm:block px-5 py-2.5 border border-gray-200 rounded-lg text-sm font-semibold hover:bg-gray-50">

                    Login

                </button>


                <button
                    class="lg:hidden text-2xl">

                    ☰

                </button>

            </div>

        </div>

    </div>

</header>


<!-- =========================================================
     HERO
========================================================= -->

<section class="bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-12 items-center py-16 lg:py-24">

            <!-- Left -->

            <div>

                <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold mb-6">

                    <span>✨</span>

                    Trusted home services

                </div>


                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight">

                    Home services

                    <span class="text-blue-600">
                        made simple.
                    </span>

                </h1>


                <p class="mt-6 text-lg text-gray-600 max-w-xl leading-relaxed">

                    Book trusted professionals for cleaning, repairs,
                    beauty, appliance services and more — right at your doorstep.

                </p>


                <!-- Search -->

                <div class="mt-8">

                    <div class="flex items-center bg-white border border-gray-200 rounded-2xl shadow-lg p-2 max-w-xl">

                        <div class="px-3 text-xl">
                            🔍
                        </div>

                        <input
                            type="text"
                            placeholder="What service do you need?"
                            class="flex-1 px-2 py-3 outline-none text-sm"
                        >

                        <button
                            class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700">

                            Search

                        </button>

                    </div>

                </div>


                <!-- Trust -->

                <div class="mt-8 flex flex-wrap items-center gap-6 text-sm text-gray-500">

                    <div class="flex items-center gap-2">
                        <span class="text-green-500">✓</span>
                        Verified professionals
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-green-500">✓</span>
                        Transparent pricing
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-green-500">✓</span>
                        Easy booking
                    </div>

                </div>

            </div>


            <!-- Right Hero Image -->

            <div class="relative">

                <div class="rounded-3xl overflow-hidden bg-gray-100 aspect-[4/3]">

                    <img
                        src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=1200&q=85"
                        alt="Home service professional"
                        class="w-full h-full object-cover"
                    >

                </div>


                <!-- Floating card -->

                <div class="absolute bottom-6 left-6 bg-white rounded-2xl shadow-xl p-4 flex items-center gap-3">

                    <div class="w-11 h-11 bg-green-100 rounded-full flex items-center justify-center">
                        ✓
                    </div>

                    <div>

                        <div class="font-bold text-gray-900">
                            10,000+
                        </div>

                        <div class="text-xs text-gray-500">
                            Happy customers
                        </div>

                    </div>

                </div>


                <!-- Rating -->

                <div class="absolute top-6 right-6 bg-white rounded-xl shadow-lg px-4 py-3">

                    <div class="flex items-center gap-1">

                        <span class="text-yellow-500">
                            ★
                        </span>

                        <span class="font-bold">
                            4.8
                        </span>

                    </div>

                    <div class="text-xs text-gray-500">
                        2,500+ reviews
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================================================
     CATEGORIES
========================================================= -->

<section class="py-16 bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-end justify-between mb-8">

            <div>

                <p class="text-blue-600 font-semibold text-sm">
                    EXPLORE SERVICES
                </p>

                <h2 class="text-3xl font-bold mt-2">
                    What do you need help with?
                </h2>

            </div>

            <a href="#" class="hidden sm:block text-blue-600 font-semibold text-sm">
                View all →
            </a>

        </div>


        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">


            <!-- Category -->

            <a href="#"
               class="bg-white rounded-2xl p-5 text-center hover:shadow-lg transition group">

                <div class="w-16 h-16 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center text-3xl group-hover:scale-110 transition">
                    🧹
                </div>

                <h3 class="font-semibold mt-4">
                    Cleaning
                </h3>

                <p class="text-xs text-gray-500 mt-1">
                    25+ services
                </p>

            </a>


            <a href="#"
               class="bg-white rounded-2xl p-5 text-center hover:shadow-lg transition group">

                <div class="w-16 h-16 mx-auto bg-orange-50 rounded-2xl flex items-center justify-center text-3xl group-hover:scale-110 transition">
                    🔧
                </div>

                <h3 class="font-semibold mt-4">
                    Plumbing
                </h3>

                <p class="text-xs text-gray-500 mt-1">
                    18+ services
                </p>

            </a>


            <a href="#"
               class="bg-white rounded-2xl p-5 text-center hover:shadow-lg transition group">

                <div class="w-16 h-16 mx-auto bg-cyan-50 rounded-2xl flex items-center justify-center text-3xl group-hover:scale-110 transition">
                    ❄️
                </div>

                <h3 class="font-semibold mt-4">
                    AC Services
                </h3>

                <p class="text-xs text-gray-500 mt-1">
                    15+ services
                </p>

            </a>


            <a href="#"
               class="bg-white rounded-2xl p-5 text-center hover:shadow-lg transition group">

                <div class="w-16 h-16 mx-auto bg-pink-50 rounded-2xl flex items-center justify-center text-3xl group-hover:scale-110 transition">
                    💇
                </div>

                <h3 class="font-semibold mt-4">
                    Beauty
                </h3>

                <p class="text-xs text-gray-500 mt-1">
                    30+ services
                </p>

            </a>


            <a href="#"
               class="bg-white rounded-2xl p-5 text-center hover:shadow-lg transition group">

                <div class="w-16 h-16 mx-auto bg-yellow-50 rounded-2xl flex items-center justify-center text-3xl group-hover:scale-110 transition">
                    🔌
                </div>

                <h3 class="font-semibold mt-4">
                    Electrical
                </h3>

                <p class="text-xs text-gray-500 mt-1">
                    20+ services
                </p>

            </a>


            <a href="#"
               class="bg-white rounded-2xl p-5 text-center hover:shadow-lg transition group">

                <div class="w-16 h-16 mx-auto bg-green-50 rounded-2xl flex items-center justify-center text-3xl group-hover:scale-110 transition">
                    🛠️
                </div>

                <h3 class="font-semibold mt-4">
                    Repairs
                </h3>

                <p class="text-xs text-gray-500 mt-1">
                    22+ services
                </p>

            </a>

        </div>

    </div>

</section>


<!-- =========================================================
     POPULAR SERVICES
========================================================= -->

<section class="py-16 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-end justify-between mb-8">

            <div>

                <p class="text-blue-600 font-semibold text-sm">
                    POPULAR
                </p>

                <h2 class="text-3xl font-bold mt-2">
                    Services people love
                </h2>

            </div>

            <a href="#" class="text-blue-600 font-semibold text-sm">
                View all →
            </a>

        </div>


        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">


            <!-- Service Card -->

            <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl transition">

                <div class="relative h-56">

                    <img
                        src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=800&q=80"
                        class="w-full h-full object-cover"
                        alt="Deep cleaning"
                    >

                    <span class="absolute top-4 left-4 bg-white px-3 py-1 rounded-full text-xs font-semibold">
                        Bestseller
                    </span>

                </div>


                <div class="p-5">

                    <div class="flex items-center justify-between">

                        <h3 class="font-bold text-lg">
                            Home Deep Cleaning
                        </h3>

                        <div class="flex items-center gap-1 text-sm">
                            ⭐ 4.8
                        </div>

                    </div>


                    <p class="text-gray-500 text-sm mt-2">
                        Complete home cleaning by trained professionals.
                    </p>


                    <div class="flex items-center justify-between mt-5">

                        <div>

                            <span class="text-xl font-bold">
                                ₹999
                            </span>

                            <span class="text-sm text-gray-400">
                                / service
                            </span>

                        </div>


                        <a
                            href="#"
                            class="bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-700">

                            Book Now

                        </a>

                    </div>

                </div>

            </div>


            <!-- Service -->

            <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl transition">

                <div class="relative h-56">

                    <img
                        src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&w=800&q=80"
                        class="w-full h-full object-cover"
                        alt="AC service"
                    >

                </div>


                <div class="p-5">

                    <div class="flex items-center justify-between">

                        <h3 class="font-bold text-lg">
                            AC Service
                        </h3>

                        <div class="flex items-center gap-1 text-sm">
                            ⭐ 4.7
                        </div>

                    </div>


                    <p class="text-gray-500 text-sm mt-2">
                        Professional AC service and maintenance.
                    </p>


                    <div class="flex items-center justify-between mt-5">

                        <div>

                            <span class="text-xl font-bold">
                                ₹499
                            </span>

                            <span class="text-sm text-gray-400">
                                / service
                            </span>

                        </div>


                        <a
                            href="#"
                            class="bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold">

                            Book Now

                        </a>

                    </div>

                </div>

            </div>


            <!-- Service -->

            <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl transition">

                <div class="relative h-56">

                    <img
                        src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=800&q=80"
                        class="w-full h-full object-cover"
                        alt="Plumbing service"
                    >

                </div>


                <div class="p-5">

                    <div class="flex items-center justify-between">

                        <h3 class="font-bold text-lg">
                            Plumbing Service
                        </h3>

                        <div class="flex items-center gap-1 text-sm">
                            ⭐ 4.9
                        </div>

                    </div>


                    <p class="text-gray-500 text-sm mt-2">
                        Fast and reliable plumbing solutions.
                    </p>


                    <div class="flex items-center justify-between mt-5">

                        <div>

                            <span class="text-xl font-bold">
                                ₹299
                            </span>

                            <span class="text-sm text-gray-400">
                                / service
                            </span>

                        </div>


                        <a
                            href="#"
                            class="bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold">

                            Book Now

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================================================
     OFFER BANNER
========================================================= -->

<section class="py-10">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-blue-600 rounded-3xl overflow-hidden">

            <div class="grid md:grid-cols-2 items-center">

                <div class="p-8 lg:p-12 text-white">

                    <span class="text-sm font-semibold bg-white/10 px-3 py-1.5 rounded-full">
                        LIMITED TIME OFFER
                    </span>

                    <h2 class="text-3xl lg:text-4xl font-bold mt-5">
                        Get ₹200 OFF
                        <br>
                        on your first booking
                    </h2>

                    <p class="mt-4 text-blue-100">
                        Book any service today and enjoy your first service at a special price.
                    </p>

                    <button class="mt-6 bg-white text-blue-600 px-6 py-3 rounded-xl font-bold">
                        Book Now
                    </button>

                </div>


                <div class="hidden md:block h-full">

                    <img
                        src="https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&fit=crop&w=900&q=80"
                        class="w-full h-full object-cover"
                        alt="Home service offer"
                    >

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================================================
     HOW IT WORKS
========================================================= -->

<section class="py-20 bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

        <p class="text-blue-600 font-semibold text-sm">
            SIMPLE & EASY
        </p>

        <h2 class="text-3xl font-bold mt-2">
            How it works
        </h2>

        <p class="text-gray-500 mt-4">
            Getting professional help has never been easier.
        </p>


        <div class="grid md:grid-cols-3 gap-10 mt-14">


            <div>

                <div class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center text-3xl">
                    🔍
                </div>

                <h3 class="font-bold text-lg mt-5">
                    1. Choose a service
                </h3>

                <p class="text-gray-500 text-sm mt-2">
                    Browse our services and select what you need.
                </p>

            </div>


            <div>

                <div class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center text-3xl">
                    📅
                </div>

                <h3 class="font-bold text-lg mt-5">
                    2. Pick a time
                </h3>

                <p class="text-gray-500 text-sm mt-2">
                    Choose a convenient date and time for your service.
                </p>

            </div>


            <div>

                <div class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center text-3xl">
                    🏠
                </div>

                <h3 class="font-bold text-lg mt-5">
                    3. Relax
                </h3>

                <p class="text-gray-500 text-sm mt-2">
                    Our professional arrives at your doorstep.
                </p>

            </div>

        </div>

    </div>

</section>


<!-- =========================================================
     REVIEWS
========================================================= -->

<section class="py-20 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center">

            <p class="text-blue-600 font-semibold text-sm">
                CUSTOMER REVIEWS
            </p>

            <h2 class="text-3xl font-bold mt-2">
                What our customers say
            </h2>

        </div>


        <div class="grid md:grid-cols-3 gap-6 mt-12">


            <div class="border border-gray-100 rounded-2xl p-6 shadow-sm">

                <div class="text-yellow-500">
                    ★★★★★
                </div>

                <p class="text-gray-600 mt-4 leading-relaxed">
                    "The booking process was very easy and the professional arrived on time.
                    The service quality was excellent."
                </p>

                <div class="flex items-center gap-3 mt-6">

                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center font-bold text-blue-600">
                        RS
                    </div>

                    <div>

                        <div class="font-semibold">
                            Rahul Sharma
                        </div>

                        <div class="text-xs text-gray-500">
                            Ahmedabad
                        </div>

                    </div>

                </div>

            </div>


            <div class="border border-gray-100 rounded-2xl p-6 shadow-sm">

                <div class="text-yellow-500">
                    ★★★★★
                </div>

                <p class="text-gray-600 mt-4 leading-relaxed">
                    "Very professional service. I booked AC service and everything
                    was completed quickly."
                </p>

                <div class="flex items-center gap-3 mt-6">

                    <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center font-bold text-pink-600">
                        PS
                    </div>

                    <div>

                        <div class="font-semibold">
                            Priya Shah
                        </div>

                        <div class="text-xs text-gray-500">
                            Ahmedabad
                        </div>

                    </div>

                </div>

            </div>


            <div class="border border-gray-100 rounded-2xl p-6 shadow-sm">

                <div class="text-yellow-500">
                    ★★★★★
                </div>

                <p class="text-gray-600 mt-4 leading-relaxed">
                    "Great experience from booking to completion. I would definitely
                    use the service again."
                </p>

                <div class="flex items-center gap-3 mt-6">

                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center font-bold text-green-600">
                        AM
                    </div>

                    <div>

                        <div class="font-semibold">
                            Amit Mehta
                        </div>

                        <div class="text-xs text-gray-500">
                            Ahmedabad
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================================================
     CTA
========================================================= -->

<section class="py-16 bg-gray-900">

    <div class="max-w-4xl mx-auto px-4 text-center text-white">

        <h2 class="text-3xl sm:text-4xl font-bold">
            Need a service at home?
        </h2>

        <p class="text-gray-400 mt-4">
            Book a trusted professional today.
        </p>

        <button class="mt-7 bg-blue-600 hover:bg-blue-700 px-8 py-3.5 rounded-xl font-semibold">
            Explore Services
        </button>

    </div>

</section>


<!-- =========================================================
     FOOTER
========================================================= -->

<footer class="bg-gray-950 text-gray-400">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10">


            <div>

                <div class="flex items-center gap-2">

                    <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">
                        H
                    </div>

                    <span class="text-white text-xl font-bold">
                        HomeCare
                    </span>

                </div>

                <p class="text-sm mt-4 leading-relaxed">
                    Trusted professionals for all your home service needs.
                </p>

            </div>


            <div>

                <h3 class="text-white font-semibold mb-4">
                    Services
                </h3>

                <ul class="space-y-3 text-sm">

                    <li><a href="#" class="hover:text-white">Cleaning</a></li>
                    <li><a href="#" class="hover:text-white">AC Services</a></li>
                    <li><a href="#" class="hover:text-white">Plumbing</a></li>
                    <li><a href="#" class="hover:text-white">Electrical</a></li>

                </ul>

            </div>


            <div>

                <h3 class="text-white font-semibold mb-4">
                    Company
                </h3>

                <ul class="space-y-3 text-sm">

                    <li><a href="#" class="hover:text-white">About Us</a></li>
                    <li><a href="#" class="hover:text-white">Contact</a></li>
                    <li><a href="#" class="hover:text-white">Careers</a></li>
                    <li><a href="#" class="hover:text-white">Privacy Policy</a></li>

                </ul>

            </div>


            <div>

                <h3 class="text-white font-semibold mb-4">
                    Get in touch
                </h3>

                <ul class="space-y-3 text-sm">

                    <li>📍 Ahmedabad, Gujarat</li>
                    <li>📞 +91 98765 43210</li>
                    <li>✉️ support@homecare.com</li>

                </ul>

            </div>

        </div>


        <div class="border-t border-gray-800 mt-12 pt-6 text-sm text-center">

            © 2026 HomeCare. All rights reserved.

        </div>

    </div>

</footer>


</body>
</html>