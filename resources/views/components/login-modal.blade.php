<div
    x-data="loginModal"
    x-on:open-login.window="open()"
    x-cloak
>
    {{-- Overlay --}}
    <div
        x-show="show"
        x-transition.opacity
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/70 px-4"
        @keydown.escape.window="close()"
    >

        {{-- Modal --}}
        <div
            x-show="show"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.outside="close()"
            class="relative w-full max-w-[448px] overflow-hidden rounded-2xl bg-white shadow-2xl"
        >

            {{-- Close --}}
            <button
                type="button"
                @click="close()"
                class="absolute right-4 top-4 z-10 flex h-8 w-8 items-center justify-center rounded-full bg-white text-gray-700 shadow-sm hover:bg-gray-100"
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
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>


            {{-- ================= PHONE STEP ================= --}}
            <template x-if="step === 'phone'">

                <div class="px-5 pb-7 pt-8 sm:px-7">

                    {{-- Icon --}}
                    <div class="mb-6">
                        <div
                            class="flex h-12 w-12 items-center justify-center"
                        >
                            <svg
                                class="h-10 w-10 text-indigo-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.09l-4.423-1.106a1.125 1.125 0 00-1.173.417l-.97 1.293a1.125 1.125 0 01-1.21.38 12.035 12.035 0 01-7.724-7.724 1.125 1.125 0 01.38-1.21l1.293-.97c.364-.273.53-.74.417-1.173L6.382 2.352A1.125 1.125 0 005.292 1.5H3.75A2.25 2.25 0 001.5 3.75v3z"
                                />
                            </svg>
                        </div>
                    </div>

                    {{-- Heading --}}
                    <h2 class="text-[25px] font-bold leading-tight text-gray-900">
                        Enter your phone number
                    </h2>

                    <p class="mt-2 text-sm leading-5 text-gray-500">
                        We'll send you a text with a verification code.
                        Standard tariff may apply.
                    </p>


                    {{-- Phone --}}
                    <div class="mt-6 flex h-12 overflow-hidden rounded-lg border border-gray-300 bg-white focus-within:border-gray-500">

                        {{-- Country --}}
                        <div class="flex w-[82px] shrink-0 items-center justify-center gap-1 border-r border-gray-300 bg-gray-50 text-sm text-gray-700">

                            <span>+91</span>

                            <svg
                                class="h-4 w-4 text-gray-500"
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

                        </div>

                        <input
                            type="tel"
                            maxlength="10"
                            inputmode="numeric"
                            x-model="mobile"
                            @input="mobile = mobile.replace(/\D/g, '').slice(0, 10)"
                            @keydown.enter="sendOtp()"
                            placeholder="Enter your phone number"
                            class="min-w-0 flex-1 border-0 px-4 text-sm text-gray-900 outline-none placeholder:text-gray-400 focus:ring-0"
                        >

                    </div>


                    {{-- Error --}}
                    <div
                        x-show="error"
                        x-cloak
                        class="mt-3 rounded-lg bg-red-50 px-3 py-2 text-sm text-red-600"
                        x-text="error"
                    ></div>


                    {{-- Continue --}}
                    <button
                        type="button"
                        @click="sendOtp()"
                        :disabled="loading || mobile.length !== 10"
                        class="mt-5 flex h-12 w-full items-center justify-center rounded-lg bg-indigo-600 text-sm font-semibold text-white transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:bg-gray-200 disabled:text-gray-400"
                    >

                        <svg
                            x-show="loading"
                            class="mr-2 h-5 w-5 animate-spin"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            />

                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                            />
                        </svg>

                        <span x-text="loading ? 'Sending...' : 'Continue'"></span>

                    </button>


                    {{-- Terms --}}
                    <p class="mt-5 text-xs leading-5 text-gray-600">
                        By continuing, you agree to our
                        <a href="#" class="underline hover:text-gray-900">
                            T&amp;C
                        </a>
                        and
                        <a href="#" class="underline hover:text-gray-900">
                            Privacy policy
                        </a>.
                    </p>

                </div>

            </template>


            {{-- ================= OTP STEP ================= --}}
            <template x-if="step === 'otp'">

                <div class="px-5 pb-7 pt-8 sm:px-7">

                    {{-- Back --}}
                    <button
                        type="button"
                        @click="step = 'phone'; error = ''"
                        class="mb-5 flex items-center gap-1 text-sm font-medium text-gray-600 hover:text-gray-900"
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

                        Change number
                    </button>


                    {{-- Icon --}}
                    <div class="mb-5">

                        <div class="flex h-12 w-12 items-center justify-center">
                            <svg
                                class="h-10 w-10 text-indigo-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 0h10.5A1.75 1.75 0 0119 12.25v7A1.75 1.75 0 0117.25 21H6.75A1.75 1.75 0 015 19.25v-7a1.75 1.75 0 011.75-1.75z"
                                />
                            </svg>
                        </div>

                    </div>


                    <h2 class="text-[25px] font-bold leading-tight text-gray-900">
                        Enter verification code
                    </h2>

                    <p class="mt-2 text-sm leading-5 text-gray-500">
                        We've sent a verification code to
                        <span
                            class="font-semibold text-gray-800"
                            x-text="'+91 ' + mobile"
                        ></span>
                    </p>


                    {{-- OTP --}}
                    <div class="mt-6">

                        <input
                            type="text"
                            maxlength="6"
                            inputmode="numeric"
                            autocomplete="one-time-code"
                            x-model="otp"
                            @input="otp = otp.replace(/\D/g, '').slice(0, 6)"
                            @keydown.enter="verifyOtp()"
                            placeholder="Enter OTP"
                            class="h-12 w-full rounded-lg border border-gray-300 px-4 text-center text-lg font-semibold tracking-[0.5em] outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                        >

                    </div>


                    {{-- Error --}}
                    <div
                        x-show="error"
                        x-cloak
                        class="mt-3 rounded-lg bg-red-50 px-3 py-2 text-sm text-red-600"
                        x-text="error"
                    ></div>


                    {{-- Verify --}}
                    <button
                        type="button"
                        @click="verifyOtp()"
                        :disabled="loading || otp.length !== 6"
                        class="mt-5 flex h-12 w-full items-center justify-center rounded-lg bg-indigo-600 text-sm font-semibold text-white transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:bg-gray-200 disabled:text-gray-400"
                    >

                        <svg
                            x-show="loading"
                            class="mr-2 h-5 w-5 animate-spin"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            />

                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                            />
                        </svg>

                        <span x-text="loading ? 'Verifying...' : 'Verify & Continue'"></span>

                    </button>


                    {{-- Resend --}}
                    <div class="mt-5 text-center text-sm">

                        <template x-if="resendTimer > 0">

                            <p class="text-gray-500">
                                Resend OTP in
                                <span
                                    class="font-semibold text-gray-800"
                                    x-text="resendTimer"
                                ></span>
                                seconds
                            </p>

                        </template>

                        <template x-if="resendTimer === 0">

                            <button
                                type="button"
                                @click="resendOtp()"
                                class="font-semibold text-indigo-600 hover:text-indigo-700"
                            >
                                Resend OTP
                            </button>

                        </template>

                    </div>

                </div>

            </template>

        </div>

    </div>
</div>


@push('scripts')
<script>
function loginModal() {

    return {

        show: false,

        step: 'phone',

        mobile: '',

        otp: '',

        loading: false,

        error: '',

        resendTimer: 0,

        resendInterval: null,


        open() {

            this.show = true;

            this.step = 'phone';

            this.error = '';

            this.otp = '';

        },


        close() {

            this.show = false;

            this.stopResendTimer();

        },


        async sendOtp() {

            if (this.mobile.length !== 10) {

                this.error = 'Please enter a valid 10-digit mobile number.';

                return;
            }

            this.loading = true;

            this.error = '';

            try {

                const response = await fetch(
                    '{{ route('auth.send-otp') }}',
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN':
                                document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest',
                        },

                        credentials: 'same-origin',

                        body: JSON.stringify({
                            mobile: this.mobile
                        })
                    }
                );

                const result = await response.json();

                console.log('SEND OTP RESPONSE:', result);

                if (!response.ok || !result.status) {

                    throw new Error(
                        result.message ||
                        'Unable to send OTP.'
                    );
                }


                this.step = 'otp';

                this.otp = '';

                this.startResendTimer();

            } catch (error) {

                console.error(error);

                this.error =
                    error.message ||
                    'Unable to send OTP.';

            } finally {

                this.loading = false;
            }
        },


        async resendOtp() {

            this.loading = true;

            this.error = '';

            try {

                const response = await fetch(
                    '{{ route('auth.resend-otp') }}',
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN':
                                document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest',
                        },

                        credentials: 'same-origin',

                        body: JSON.stringify({
                            mobile: this.mobile
                        })
                    }
                );

                const result = await response.json();

                if (!response.ok || !result.status) {

                    throw new Error(
                        result.message ||
                        'Unable to resend OTP.'
                    );
                }

                this.otp = '';

                this.startResendTimer();

            } catch (error) {

                this.error =
                    error.message ||
                    'Unable to resend OTP.';

            } finally {

                this.loading = false;
            }
        },


        async verifyOtp() {

            if (this.otp.length !== 6) {

                this.error = 'Please enter the 6-digit OTP.';

                return;
            }

            this.loading = true;

            this.error = '';

            try {

                const response = await fetch(
                    '{{ route('auth.verify-otp') }}',
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN':
                                document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest',
                        },

                        credentials: 'same-origin',

                        body: JSON.stringify({
                            mobile: this.mobile,
                            otp: this.otp
                        })
                    }
                );

                const result = await response.json();

                console.log('VERIFY OTP RESPONSE:', result);

                if (!response.ok || !result.status) {

                    throw new Error(
                        result.message ||
                        'Invalid OTP.'
                    );
                }


                /*
                 * Login successful.
                 *
                 * Backend should store the API token
                 * in Laravel session.
                 */

                this.stopResendTimer();

                this.show = false;

                window.dispatchEvent(
                    new CustomEvent('user-logged-in', {
                        detail: result
                    })
                );

                /*
                 * Refresh page so header/address/cart
                 * immediately reflect login state.
                 */
                window.location.reload();

            } catch (error) {

                console.error(error);

                this.error =
                    error.message ||
                    'Unable to verify OTP.';

            } finally {

                this.loading = false;
            }
        },


        startResendTimer() {

            this.stopResendTimer();

            this.resendTimer = 30;

            this.resendInterval = setInterval(() => {

                if (this.resendTimer > 0) {

                    this.resendTimer--;

                } else {

                    this.stopResendTimer();
                }

            }, 1000);
        },


        stopResendTimer() {

            if (this.resendInterval) {

                clearInterval(this.resendInterval);

                this.resendInterval = null;
            }

            this.resendTimer = 0;
        }

    };
}
</script>
@endpush