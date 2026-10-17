<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Home Services')</title>

    <script src="https://cdn.tailwindcss.com"></script>

   
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

@php
    $logo = DB::table('settings') ->where('key', 'app_logo') ->value('value');
    $baseUrl = rtrim(config('app.catalog_storage_base_url'), '/');
    $location = session('catalog_location', []);
    $locationPincode = $location['pincode'] ?? config('services.catalog.pincode', '380026');
    $locationAddress = $location['address'] ?? null;
    $hasSelectedLocation = !empty($location['latitude']) && !empty($location['longitude']) && !empty($location['pincode']);
    $googleMapsApiKey = config('services.google.maps_api_key');
@endphp

<body class="bg-gray-50 text-gray-900 antialiased">

    @include('layouts.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    @include('components.login-modal')

    @stack('scripts')
    <script type="text/javascript">
        window.openLocationModal = function () {
            const modal = document.getElementById('location-picker');

            if (!modal) {
                console.error('Location modal not found.');
                return;
            }

            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');

            const input = document.getElementById('locationSearch');

            if (input) {
                setTimeout(() => input.focus(), 100);
            }
        };

        window.closeLocationModal = function () {
            const modal = document.getElementById('location-picker');

            if (!modal) {
                return;
            }

            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        };

        function headerCart() {
            return {
                count: 0,
                loading: false,

                async loadCartCount() {
                    if (this.loading) return;

                    this.loading = true;

                    try {
                        const response = await fetch(
                            @json(route('cart.count')),
                            {
                                headers: {
                                    'Accept': 'application/json'
                                },
                                credentials: 'same-origin'
                            }
                        );

                        const data = await response.json();

                        if (!response.ok || data.status === false) {
                            throw new Error(data.message || 'Unable to load cart.');
                        }

                        this.count = Number(data.count || 0);

                    } catch (error) {
                        console.error('Cart count error:', error);
                    } finally {
                        this.loading = false;
                    }
                }
            };
        }
    </script>
</body>
</html>