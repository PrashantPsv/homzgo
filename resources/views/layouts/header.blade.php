
<header class="sticky top-0 z-50 border-b border-gray-100 bg-white">

    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            @if($logo)
                <img
                    src="{{ filter_var($logo, FILTER_VALIDATE_URL) ? $logo : ($baseUrl . '/' . ltrim($logo, '/')) }}"
                    alt="Logo"
                    class="h-9 rounded-xl object-contain"
                >
            @else
                <span class="text-xl font-bold tracking-tight">
                    Hom<span class="text-gray-500">Zgo</span>
                </span>
            @endif

        </a>

        {{-- Desktop Navigation --}}
        <nav class="hidden items-center gap-8 md:flex">

            <a href="{{ route('home') }}"
               class="text-sm font-medium text-gray-900 hover:text-gray-500">
                Home
            </a>

            <!-- <a href="{{ route('services.index') }}"
               class="text-sm font-medium text-gray-600 hover:text-gray-900">
                Services
            </a> -->

            <a href="{{ route('home') }}#how-it-works"
               class="text-sm font-medium text-gray-600 hover:text-gray-900">
                How It Works
            </a>

        </nav>

        {{-- Right Side --}}
        <div class="flex items-center gap-3">

            {{-- Location --}}
            <button
                type="button"
                onclick="window.openLocationPicker && window.openLocationPicker()"
                class="hidden max-w-[280px] items-center gap-3 rounded-xl px-3 py-2 text-left transition hover:bg-gray-50 sm:flex"
                title="Change location"
            >
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gray-100 text-gray-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21s7-6.2 7-12a7 7 0 10-14 0c0 5.8 7 12 7 12z"/>
                        <circle cx="12" cy="9" r="2.5" stroke-width="1.8"/>
                    </svg>
                </span>
                <span class="min-w-0 leading-tight">
                    <span class="block text-[10px] font-semibold uppercase tracking-wide text-gray-400">Deliver to</span>
                    <span id="header-location-label" class="block truncate text-sm font-semibold text-gray-900">
                        {{ $locationAddress ?: ($hasSelectedLocation ? $locationPincode : 'Select location') }}
                    </span>
                </span>
                <svg class="h-4 w-4 shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 9l6 6 6-6"/>
                </svg>
            </button>

            <button
                type="button"
                onclick="window.openLocationPicker && window.openLocationPicker()"
                class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 text-gray-700 hover:bg-gray-50 sm:hidden"
                aria-label="Select location"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21s7-6.2 7-12a7 7 0 10-14 0c0 5.8 7 12 7 12z"/>
                    <circle cx="12" cy="9" r="2.5" stroke-width="1.8"/>
                </svg>
            </button>

            {{-- Login --}}

            
            <!-- Header Cart -->
            <div
                x-data="headerCart()"
                x-init="loadCartCount()"
                @cart-updated.window="loadCartCount()"
                class="relative"
            >
                <a
                    href="{{ route('cart.index') }}"
                    class="relative flex h-11 w-11 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-800 transition hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-600"
                    aria-label="View cart"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="23"
                        height="23"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M6 7h12l1 13H5L6 7Z"/>
                        <path d="M9 9V6a3 3 0 0 1 6 0v3"/>
                    </svg>

                    <!-- Dynamic Cart Count -->
                    <span
                        x-show="count > 0"
                        x-cloak
                        x-text="count > 99 ? '99+' : count"
                        class="absolute -right-2 -top-2 flex min-w-[20px] h-5 items-center justify-center rounded-full bg-indigo-600 px-1 text-[10px] font-bold text-white ring-2 ring-white"
                    ></span>
                </a>
            </div>

            @if(session()->has('catalog_auth_token'))

                <div
                    x-data="{ open: false }"
                    class="relative"
                >

                    {{-- Account Button --}}
                    <button
                        type="button"
                        @click="open = !open"
                        @click.outside="open = false"
                        class="flex items-center gap-2 rounded-lg border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-900 transition hover:bg-gray-50"
                    >

                        {{-- User Icon --}}
                        <svg
                            class="h-5 w-5 text-gray-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0"
                            />
                        </svg>

                        <span>My Account</span>

                        {{-- Arrow --}}
                        <svg
                            class="h-4 w-4 text-gray-500 transition-transform"
                            :class="open ? 'rotate-180' : ''"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>

                    </button>


                    {{-- Dropdown --}}
                    <div
                        x-show="open"
                        x-cloak
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                        class="absolute right-0 z-50 mt-2 w-56 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-lg"
                    >

                        {{-- Profile --}}
                        <a
                            href="{{ route('profile') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 transition hover:bg-gray-50"
                        >

                            <span
                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600"
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
                                        stroke-width="1.8"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0"
                                    />
                                </svg>
                            </span>

                            <span>
                                <span class="block font-semibold text-gray-900">
                                    My Profile
                                </span>

                                <span class="text-xs text-gray-500">
                                    View your profile
                                </span>
                            </span>

                        </a>


                        {{-- Divider --}}
                        <div class="border-t border-gray-100"></div>


                        {{-- Logout --}}
                        <form
                            method="POST"
                            action="{{ route('auth.logout') }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="flex w-full items-center gap-3 px-4 py-3 text-left text-sm text-red-600 transition hover:bg-red-50"
                            >

                                <span
                                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-600"
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
                                            stroke-width="1.8"
                                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H3"
                                        />
                                    </svg>
                                </span>

                                <span>
                                    <span class="block font-semibold">
                                        Logout
                                    </span>

                                    <span class="text-xs text-red-400">
                                        Sign out of your account
                                    </span>
                                </span>

                            </button>

                        </form>

                    </div>

                </div>

            @else

                <button
                    type="button"
                    onclick="window.dispatchEvent(new CustomEvent('open-login'))"
                    class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-900 transition hover:bg-gray-50"
                >
                    Login
                </button>

            @endif
            <!-- <a
                @click="$dispatch('open-login')"
                class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-50"
            >
                Login
            </a> -->

        </div>

    </div>

    {{-- location picker --}}
    <div
        id="location-picker"
        class="fixed inset-0 z-[100] hidden items-end justify-center bg-black/50 p-0 backdrop-blur-[1px] sm:items-center sm:p-4"
        aria-hidden="true"
    >
        <div class="w-full max-w-xl overflow-hidden rounded-t-3xl bg-white shadow-2xl sm:rounded-3xl" onclick="event.stopPropagation()">
            <div class="flex items-start justify-between border-b border-gray-100 px-5 py-5 sm:px-6">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-400">Service location</p>
                    <h3 class="mt-1 text-xl font-bold tracking-tight text-gray-900">Where should we provide the service?</h3>
                    <p class="mt-1 text-sm text-gray-500">We’ll show services and time slots available at this location.</p>
                </div>
                <button type="button" onclick="window.closeLocationPicker()" class="rounded-full p-2 text-gray-400 hover:bg-gray-100" aria-label="Close">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.8" stroke-linecap="round" d="M6 6l12 12M18 6L6 18"/></svg>
                </button>
            </div>

            <div class="p-5 sm:p-6">
                <button
                    type="button"
                    id="detect-location-btn"
                    onclick="window.detectCurrentLocation()"
                    class="flex w-full items-center gap-3 rounded-2xl border border-gray-200 bg-white px-4 py-4 text-left shadow-sm transition hover:border-gray-300 hover:bg-gray-50"
                >
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gray-100 text-gray-800">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.8" stroke-linecap="round" d="M12 3v3m0 12v3M3 12h3m12 0h3M5.6 5.6l2.1 2.1m8.6 8.6l2.1 2.1m0-12.8l-2.1 2.1m-8.6 8.6l-2.1 2.1"/><circle cx="12" cy="12" r="4.1" stroke-width="1.8"/></svg>
                    </span>
                    <span class="min-w-0 flex-1">
                        <span class="block text-sm font-bold text-gray-900">Use my current location</span>
                        <span class="mt-0.5 block text-xs text-gray-500">Allow location access to find the nearest service area.</span>
                    </span>
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6"/></svg>
                </button>

                <div class="my-5 flex items-center gap-3 text-xs font-semibold uppercase tracking-wider text-gray-400">
                    <div class="h-px flex-1 bg-gray-200"></div>
                    <span>or search</span>
                    <div class="h-px flex-1 bg-gray-200"></div>
                </div>

                <label class="block">
                    <span class="sr-only">Search area or pincode</span>
                    <div class="flex items-center gap-3 rounded-2xl border border-gray-200 px-4 py-3 transition focus-within:border-gray-400 focus-within:ring-4 focus-within:ring-gray-100">
                        <svg class="h-5 w-5 shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.8" stroke-linecap="round" d="M21 21l-4.35-4.35m2.1-5.15a7.25 7.25 0 11-14.5 0 7.25 7.25 0 0114.5 0z"/></svg>
                        <input id="location-search" type="text" autocomplete="off" value="" placeholder="Search area, locality, landmark or pincode" class="w-full border-0 bg-transparent text-sm font-medium outline-none ring-0 placeholder:text-gray-400 focus:ring-0">
                    </div>
                </label>

                <div id="location-results" class="mt-3 hidden max-h-64 overflow-y-auto rounded-2xl border border-gray-100 bg-white shadow-sm"></div>

                <div id="location-map-wrap" class="mt-4 hidden overflow-hidden rounded-2xl border border-gray-200 bg-gray-100">
                    <div id="location-map" class="h-64 w-full"></div>
                    <div class="flex items-center justify-between gap-3 bg-white px-4 py-3">
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Fine-tune location</p>
                            <p class="mt-0.5 text-xs text-gray-500">Move the pin to your exact service location.</p>
                        </div>
                        <button type="button" onclick="window.useMapCenter && window.useMapCenter()" class="shrink-0 rounded-xl border border-gray-200 px-3 py-2 text-xs font-bold text-gray-900 hover:bg-gray-50">Use this point</button>
                    </div>
                </div>

                <div id="selected-location-card" class="mt-4 hidden rounded-2xl border border-gray-200 bg-gray-50 p-4">
                    <div class="flex gap-3">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white text-gray-700 shadow-sm">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.8" stroke-linecap="round" d="M12 21s7-6.2 7-12a7 7 0 10-14 0c0 5.8 7 12 7 12z"/><circle cx="12" cy="9" r="2.5" stroke-width="1.8"/></svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Selected location</p>
                            <p id="selected-location-text" class="mt-1 text-sm font-semibold leading-5 text-gray-900"></p>
                        </div>
                    </div>
                </div>

                <p id="location-picker-message" class="mt-3 min-h-5 text-sm text-gray-500"></p>

                <input id="location-pincode" type="hidden" value="{{ $locationPincode }}">
                <input id="location-latitude" type="hidden" value="{{ $location['latitude'] ?? '' }}">
                <input id="location-longitude" type="hidden" value="{{ $location['longitude'] ?? '' }}">
                <input id="location-address" type="hidden" value="{{ $locationAddress ?? '' }}">

                <button
                    type="button"
                    id="save-location-btn"
                    onclick="window.saveSelectedLocation()"
                    disabled
                    class="mt-2 w-full rounded-2xl bg-black px-4 py-4 text-sm font-bold text-white transition hover:bg-gray-800 disabled:cursor-not-allowed disabled:bg-gray-200 disabled:text-gray-400"
                >
                    Confirm location
                </button>
            </div>
        </div>
    </div>

</header>

@push('scripts')
<script>
(function () {
    const picker = document.getElementById('location-picker');
    const message = document.getElementById('location-picker-message');
    const detectBtn = document.getElementById('detect-location-btn');
    const saveBtn = document.getElementById('save-location-btn');
    const searchInput = document.getElementById('location-search');
    const resultsBox = document.getElementById('location-results');
    const selectedCard = document.getElementById('selected-location-card');
    const selectedText = document.getElementById('selected-location-text');
    const pincodeInput = document.getElementById('location-pincode');
    const latitudeInput = document.getElementById('location-latitude');
    const longitudeInput = document.getElementById('location-longitude');
    const addressInput = document.getElementById('location-address');
    const headerLabel = document.getElementById('header-location-label');
    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    let searchTimer = null;

    function setMessage(text, error = false) {
        if (!message) return;
        message.textContent = text || '';
        message.className = 'mt-3 min-h-5 text-sm ' + (error ? 'text-red-600' : 'text-gray-500');
    }

    function showSelected(location) {
        latitudeInput.value = location.latitude ?? '';
        longitudeInput.value = location.longitude ?? '';
        pincodeInput.value = location.pincode ?? '';
        addressInput.value = location.address ?? '';
        selectedText.textContent = location.address || location.pincode || 'Selected location';
        selectedCard.classList.remove('hidden');
        saveBtn.disabled = !(location.latitude && location.longitude && location.pincode);
        setMessage('Services will refresh for this location after confirmation.');
    }

    window.openLocationPicker = function () {
        picker.classList.remove('hidden');
        picker.classList.add('flex');
        picker.setAttribute('aria-hidden', 'false');
        setMessage('');
        const initialLat = parseFloat(latitudeInput?.value || '');
        const initialLon = parseFloat(longitudeInput?.value || '');
        if (Number.isFinite(initialLat) && Number.isFinite(initialLon) && googleMapsApiKey) {
            loadGoogleMaps().then(() => ensureMap(initialLat, initialLon)).catch(() => {});
        }
        if (searchInput) setTimeout(() => searchInput.focus(), 100);
    };

    window.closeLocationPicker = function () {
        picker.classList.add('hidden');
        picker.classList.remove('flex');
        picker.setAttribute('aria-hidden', 'true');
    };

    const googleMapsApiKey = @json($googleMapsApiKey);
    let googleReadyPromise = null;
    let autocompleteSessionToken = null;
    let googleMap = null;
    let googleMarker = null;
    let googleGeocoder = null;
    let selectedPlace = null;

    function loadGoogleMaps() {
        if (!googleMapsApiKey) {
            return Promise.reject(new Error('Google Maps API key is not configured.'));
        }
        if (window.google?.maps) return Promise.resolve(window.google.maps);
        if (googleReadyPromise) return googleReadyPromise;

        googleReadyPromise = new Promise((resolve, reject) => {
            const existing = document.getElementById('google-maps-script');
            if (existing) {
                existing.addEventListener('load', () => resolve(window.google.maps));
                existing.addEventListener('error', () => reject(new Error('Google Maps failed to load.')));
                return;
            }
            const script = document.createElement('script');
            script.id = 'google-maps-script';
            script.async = true;
            script.defer = true;
            script.src = 'https://maps.googleapis.com/maps/api/js?key=' + encodeURIComponent(googleMapsApiKey) + '&v=weekly&libraries=places';
            script.onload = () => resolve(window.google.maps);
            script.onerror = () => reject(new Error('Google Maps failed to load. Check the API key and enabled APIs.'));
            document.head.appendChild(script);
        });
        return googleReadyPromise;
    }

    function ensureMap(lat, lon) {
        const wrap = document.getElementById('location-map-wrap');
        if (!wrap) return;
        wrap.classList.remove('hidden');
        const center = { lat: Number(lat), lng: Number(lon) };

        if (!googleMap) {
            googleMap = new google.maps.Map(document.getElementById('location-map'), {
                center,
                zoom: 16,
                mapTypeControl: false,
                streetViewControl: false,
                fullscreenControl: false,
                clickableIcons: false,
                gestureHandling: 'greedy',
            });
            googleMarker = new google.maps.Marker({
                map: googleMap,
                position: center,
                draggable: true,
            });
            googleMarker.addListener('dragend', async () => {
                const pos = googleMarker.getPosition();
                if (pos) await applyGoogleCoordinates(pos.lat(), pos.lng(), true);
            });
        } else {
            googleMap.setCenter(center);
            googleMarker.setPosition(center);
        }
    }

    function addressComponentsToLocation(result, lat, lon) {
        const components = result?.address_components || [];
        const pick = (...types) => {
            const component = components.find(item => types.some(type => item.types?.includes(type)));
            return component?.long_name || '';
        };
        const pincode = pick('postal_code').replace(/\D/g, '');
        const locality = pick('sublocality_level_1', 'sublocality', 'locality', 'neighborhood');
        const area = pick('administrative_area_level_2', 'administrative_area_level_1');
        return {
            latitude: Number(lat).toFixed(7),
            longitude: Number(lon).toFixed(7),
            pincode,
            address: result?.formatted_address || [locality, area].filter(Boolean).join(', '),
        };
    }

    async function reverseGeocode(lat, lon) {
        await loadGoogleMaps();
        googleGeocoder ||= new google.maps.Geocoder();
        const response = await googleGeocoder.geocode({ location: { lat: Number(lat), lng: Number(lon) } });
        const results = response?.results || [];
        if (!results.length) throw new Error('We could not identify this location.');
        const best = results.find(r => r.address_components?.some(c => c.types?.includes('postal_code'))) || results[0];
        return addressComponentsToLocation(best, lat, lon);
    }

    async function applyGoogleCoordinates(lat, lon, silent = false) {
        try {
            const location = await reverseGeocode(lat, lon);
            if (!location.pincode) throw new Error('We could not find a pincode for this location.');
            showSelected(location);
            ensureMap(location.latitude, location.longitude);
            if (!silent) setMessage('Location selected. Move the pin if needed, then confirm.');
        } catch (error) {
            setMessage(error.message || 'Unable to identify this location.', true);
        }
    }

    window.useMapCenter = async function () {
        if (!googleMarker) return;
        const pos = googleMarker.getPosition();
        if (pos) await applyGoogleCoordinates(pos.lat(), pos.lng());
    };

    window.detectCurrentLocation = function () {
        if (!navigator.geolocation) {
            setMessage('Your browser does not support location detection.', true);
            return;
        }

        detectBtn.disabled = true;
        setMessage('Detecting your current location...');

        navigator.geolocation.getCurrentPosition(async (position) => {
            try {
                await loadGoogleMaps();
                await applyGoogleCoordinates(position.coords.latitude, position.coords.longitude);
                setMessage('Current location detected. Confirm to continue.');
            } catch (error) {
                setMessage(error.message || 'Unable to detect your location.', true);
            } finally {
                detectBtn.disabled = false;
            }
        }, (error) => {
            setMessage(error.code === 1
                ? 'Location access was denied. Please allow it in your browser settings and try again.'
                : 'Unable to detect your current location. Please try again.', true);
            detectBtn.disabled = false;
        }, { enableHighAccuracy: true, timeout: 15000, maximumAge: 300000 });
    };

    async function searchLocations(query) {
        await loadGoogleMaps();
        const placesLib = await google.maps.importLibrary('places');
        const AutocompleteSessionToken = placesLib.AutocompleteSessionToken;
        const AutocompleteSuggestion = placesLib.AutocompleteSuggestion;
        autocompleteSessionToken ||= new AutocompleteSessionToken();

        const request = {
            input: query,
            includedRegionCodes: ['in'],
            language: 'en-IN',
            region: 'in',
            sessionToken: autocompleteSessionToken,
            pureServiceAreaBusinessesIncluded: true,
        };

        const { suggestions = [] } = await AutocompleteSuggestion.fetchAutocompleteSuggestions(request);
        return suggestions.map(suggestion => suggestion.placePrediction).filter(Boolean);
    }

    function escapeHtml(value) {
        return String(value ?? '')
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }
    
    async function selectGooglePrediction(prediction) {
        const place = prediction.toPlace();
        await place.fetchFields({ fields: ['displayName', 'formattedAddress', 'location', 'addressComponents'] });
        selectedPlace = place;
        autocompleteSessionToken = null;
        const loc = place.location;
        if (!loc) throw new Error('This place does not have a usable map location.');
        const components = place.addressComponents || [];
        const pick = (...types) => components.find(item => types.some(type => item.types?.includes(type)))?.longText || '';
        const pincode = pick('postal_code').replace(/\D/g, '');
        const location = {
            latitude: Number(loc.lat()).toFixed(7),
            longitude: Number(loc.lng()).toFixed(7),
            pincode,
            address: place.formattedAddress || place.displayName || '',
        };
        if (!location.pincode) {
            const reverse = await reverseGeocode(loc.lat(), loc.lng());
            location.pincode = reverse.pincode;
            location.address = location.address || reverse.address;
        }
        if (!location.pincode) throw new Error('Please choose a location with a valid Indian pincode.');
        showSelected(location);
        ensureMap(location.latitude, location.longitude);
        resultsBox.classList.add('hidden');
        searchInput.value = place.formattedAddress || place.displayName || '';
    }

    function renderResults(items) {
        resultsBox.innerHTML = '';
        if (!items.length) {
            resultsBox.innerHTML = '<div class="px-4 py-4 text-sm text-gray-500">No matching locations found.</div>';
            resultsBox.classList.remove('hidden');
            return;
        }

        items.forEach(prediction => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'flex w-full items-start gap-3 px-4 py-3 text-left transition hover:bg-gray-50';
            const main = prediction.mainText?.text || prediction.text?.text || 'Location';
            const secondary = prediction.secondaryText?.text || '';
            button.innerHTML = `
                <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-gray-100 text-gray-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.8" stroke-linecap="round" d="M12 21s7-6.2 7-12a7 7 0 10-14 0c0 5.8 7 12 7 12z"/><circle cx="12" cy="9" r="2.5" stroke-width="1.8"/></svg>
                </span>
                <span class="min-w-0">
                    <span class="block truncate text-sm font-semibold text-gray-900">${escapeHtml(main)}</span>
                    <span class="mt-0.5 block truncate text-xs text-gray-500">${escapeHtml(secondary)}</span>
                </span>`;
            button.addEventListener('click', async () => {
                try {
                    setMessage('Loading selected location...');
                    await selectGooglePrediction(prediction);
                } catch (error) {
                    setMessage(error.message || 'Unable to select this location.', true);
                }
            });
            resultsBox.appendChild(button);
        });
        resultsBox.classList.remove('hidden');
    }

    if (searchInput) {
        searchInput.addEventListener('input', () => {
            const query = searchInput.value.trim();
            clearTimeout(searchTimer);
            selectedPlace = null;
            if (query.length < 3) {
                resultsBox.classList.add('hidden');
                return;
            }
            searchTimer = setTimeout(async () => {
                try {
                    setMessage('Searching locations...');
                    renderResults(await searchLocations(query));
                } catch (error) {
                    setMessage(error.message || 'Unable to search locations.', true);
                }
            }, 300);
        });
    }


    


    window.saveSelectedLocation = async function () {
        const latitude = parseFloat(latitudeInput.value);
        const longitude = parseFloat(longitudeInput.value);
        const pincode = pincodeInput.value.trim();
        const address = addressInput.value.trim();

        if (!Number.isFinite(latitude) || !Number.isFinite(longitude) || !/^\d{4,10}$/.test(pincode)) {
            setMessage('Please choose a valid location before confirming.', true);
            return;
        }

        saveBtn.disabled = true;
        saveBtn.textContent = 'Updating services...';
        try {
            const response = await fetch('{{ route('location.update') }}', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                },
                body: JSON.stringify({ latitude, longitude, pincode, address }),
            });
            const data = await response.json().catch(() => ({}));
            if (!response.ok) {
                const firstError = data?.errors ? Object.values(data.errors)[0]?.[0] : null;
                throw new Error(firstError || data?.message || 'Unable to update location.');
            }
            window.location.reload();
        } catch (error) {
            setMessage(error.message || 'Unable to update location.', true);
            saveBtn.disabled = false;
            saveBtn.textContent = 'Confirm location';
        }
    };

    if (picker) {
        picker.addEventListener('click', event => {
            if (event.target === picker) window.closeLocationPicker();
        });

        const hasLocation = @json($hasSelectedLocation);
        if (!hasLocation) {
            setTimeout(() => window.openLocationPicker(), 350);
        }
    }
})();
</script>
@endpush

