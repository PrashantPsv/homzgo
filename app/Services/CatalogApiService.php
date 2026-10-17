<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CatalogApiService
{
    protected string $baseUrl;
    protected string $token;
    protected string $storageBaseUrl;
    protected string $pincode;
    protected float $latitude;
    protected float $longitude;

    public function __construct()
    {
        $this->baseUrl = rtrim((string) config('services.catalog.base_url'), '/');
        $this->token = (string) config('services.catalog.token');
        $this->storageBaseUrl = rtrim((string) config('app.catalog_storage_base_url'), '/');
        $this->pincode = (string) config('services.catalog.pincode', '380015');
        $this->latitude = (float) config('services.catalog.latitude', 23.0089643);
        $this->longitude = (float) config('services.catalog.longitude', 72.5541252);
    }

    protected function request(?string $token = null): PendingRequest
    {
        $location = session('catalog_location', []);
        $latitude = $location['latitude'] ?? $this->latitude;
        $longitude = $location['longitude'] ?? $this->longitude;
        $pincode = $location['pincode'] ?? $this->pincode;

        $request = Http::acceptJson()
            ->withHeaders([
                'X-Secret-Key' => $this->token,
                'X-Latitude' => (string) $latitude,
                'X-Longitude' => (string) $longitude,
                'X-Pincode' => (string) $pincode,
            ])
            ->timeout(20)
            ->retry(2, 250, throw: false);

        $bearer = $token ?: session('catalog_auth_token');
        if ($bearer) {
            $request = $request->withToken($bearer);
        }

        return $request;
    }

    protected function multipartRequest(?string $token = null): PendingRequest
    {
        $request = $this->request($token);
        return $request->asMultipart();
    }

    protected function get(string $path, array $query = [], ?string $token = null): array
    {
        return $this->request($token)->get($this->url($path), $query)->throw()->json() ?: [];
    }

    protected function post(string $path, array $data = [], ?string $token = null): array
    {
        return $this->request($token)->post($this->url($path), $data)->throw()->json() ?: [];
    }

    protected function put(string $path, array $data = [], ?string $token = null): array
    {
        return $this->request($token)->put($this->url($path), $data)->throw()->json() ?: [];
    }

    protected function patch(string $path, array $data = [], ?string $token = null): array
    {
        return $this->request($token)->patch($this->url($path), $data)->throw()->json() ?: [];
    }

    protected function delete(string $path, array $data = [], ?string $token = null): array
    {
        return $this->request($token)->delete($this->url($path), $data)->throw()->json() ?: [];
    }

    protected function url(string $path): string
    {
        return $this->baseUrl . '/' . ltrim($path, '/');
    }

    public function imageUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', '//', 'data:'])) {
            return $path;
        }

        return $this->storageBaseUrl . '/' . ltrim($path, '/');
    }

    public function categories(): array { return $this->get('v2/catalog/categories'); }
    public function home(): array { return $this->get('v2/catalog/home'); }
    public function banners(): array { return $this->get('v2/catalog/banners'); }
    public function search(string $query): array { return $this->get('v2/catalog/search', ['q' => $query]); }
    public function subCategories(int|string $id): array { return $this->get("v2/catalog/categories/{$id}/sub-categories"); }
    public function serviceCollections(int|string $id): array { return $this->get("v2/catalog/sub-categories/{$id}/service-collections"); }
    public function packageGroups(int|string $id): array { return $this->get("v2/catalog/service-collections/{$id}/package-groups"); }
    public function packageDetails(int|string $id): array { return $this->get("v2/catalog/packages/{$id}"); }
    public function calculatePrice(int|string $id, array $data): array { return $this->post("v2/catalog/packages/{$id}/calculate-price", $data); }

    public function guestToken(): array { return $this->get('v2/catalog/auth/guest-token'); }
    public function sendOtp(string $mobile): array { return $this->post('v2/catalog/auth/send-otp', ['mobile' => $mobile]); }
    public function resendOtp(string $mobile): array { return $this->post('v2/catalog/auth/resend-otp', ['mobile' => $mobile]); }

    public function verifyOtp(
        string $mobile,
        string $otp,
        ?string $name = null,
        ?string $deviceId = null,
        ?string $deviceType = null,
        ?string $fcmToken = null,
        ?string $referralCode = null,
        ?string $bearerToken = null,
    ): array {
        $data = array_filter([
            'mobile' => $mobile,
            'otp' => $otp,
            'name' => $name,
            'device_id' => $deviceId,
            'device_type' => $deviceType,
            'fcm_token' => $fcmToken,
            'referral_code' => $referralCode,
        ], static fn ($value) => $value !== null && $value !== '');

        return $this->post('v2/catalog/auth/verify-otp', $data, $bearerToken);
    }

    public function logout(?string $token = null): array { return $this->post('v2/catalog/auth/logout', [], $token); }
    public function profile(): array { return $this->get('v2/catalog/auth/profile'); }

    public function updateProfile(array $data, ?string $profileImagePath = null): array
    {
        $multipart = [];
        foreach ($data as $key => $value) {
            if ($value !== null) {
                $multipart[] = ['name' => $key, 'contents' => (string) $value];
            }
        }

        if ($profileImagePath && is_file($profileImagePath)) {
            $multipart[] = [
                'name' => 'profile_image',
                'contents' => fopen($profileImagePath, 'r'),
                'filename' => basename($profileImagePath),
            ];
        }

        return $this->multipartRequest()->post($this->url('v2/catalog/auth/update-profile'), $multipart)->throw()->json() ?: [];
    }

    public function updateDevice(array $data): array { return $this->post('v2/catalog/auth/update-device', $data); }

    public function cart(?string $guestToken = null): array
    {
        $authToken = session('catalog_auth_token');

        // Logged-in customer
        if ($authToken) {
            return $this->get(
                'v2/catalog/cart',
                [],
                $authToken
            );
        }

        // Guest customer
        return $this->get(
            'v2/catalog/cart',
            array_filter([
                'guest_token' => $guestToken,
            ])
        );
    }

    // Replace only CatalogApiService::addToCart().
    // IMPORTANT: $this->post() must send JSON, not form-encoded data.
    public function addToCart(
        int $packageId,
        int $quantity,
        ?string $guestToken = null,
        ?int $variantId = null,
        array|string|null $selections = null,
        array|string|null $sectionSelections = null
    ): array {
        $data = ['package_id' => $packageId, 'quantity' => $quantity];
        if ($variantId !== null) $data['variant_id'] = $variantId;
        if ($guestToken) $data['guest_token'] = $guestToken;
        if ($selections !== null) {
            $data['selections'] = is_string($selections)
                ? json_decode($selections, true, 512, JSON_THROW_ON_ERROR)
                : $selections;
        }
        if ($sectionSelections !== null) {
            $data['section_selections'] = is_string($sectionSelections)
                ? json_decode($sectionSelections, true, 512, JSON_THROW_ON_ERROR)
                : $sectionSelections;
        }
        return $this->post('v2/catalog/cart/items', $data);
    }


    public function updateCartItem(int|string $id, int $quantity, ?string $guestToken = null, array $extra = []): array
    {
        $data = array_merge(['quantity' => $quantity], $extra);
        if ($guestToken) $data['guest_token'] = $guestToken;
        return $this->put("v2/catalog/cart/items/{$id}", $data);
    }

    public function deleteCartItem(int|string $id, ?string $guestToken = null): array
    {
        return $this->delete("v2/catalog/cart/items/{$id}", array_filter(['guest_token' => $guestToken]));
    }

    public function mergeCart(string $guestToken): array { return $this->post('v2/catalog/cart/merge', ['guest_token' => $guestToken]); }
    public function slots(string $date): array { return $this->get('v2/catalog/slots', ['date' => $date]); }

    public function addresses(): array { return $this->get('v2/catalog/addresses'); }
    public function address(int|string $id): array { return $this->get("v2/catalog/addresses/{$id}"); }
    public function createAddress(array $data): array { return $this->post('v2/catalog/addresses', $data); }
    public function updateAddress(int|string $id, array $data, bool $patch = false): array { return $patch ? $this->patch("v2/catalog/addresses/{$id}", $data) : $this->put("v2/catalog/addresses/{$id}", $data); }
    public function deleteAddress(int|string $id): array { return $this->delete("v2/catalog/addresses/{$id}"); }

    public function validateCoupon(string $code, ?string $guestToken = null): array
    {
        return $this->post('v2/catalog/coupons/validate', array_filter(['code' => $code, 'guest_token' => $guestToken]));
    }

    public function checkout(int|string $addressId, array|string $slots, ?string $couponCode = null): array
    {
        return $this->post('v2/catalog/checkout', array_filter([
            'address_id' => $addressId,
            'coupon_code' => $couponCode,
            'slots' => is_string($slots) ? $slots : json_encode($slots),
        ], static fn ($v) => $v !== null && $v !== ''));
    }

    public function bookings(?string $status = null): array
    {
        return $this->get('v2/catalog/bookings', array_filter(['status' => $status]));
    }

    public function bookingDetails(int|string $id): array { return $this->get("v2/catalog/bookings/{$id}"); }
    public function cancelBooking(int|string $id, string $reason = ''): array { return $this->post("v2/catalog/bookings/{$id}/cancel", ['reason' => $reason]); }
    public function bookingPayment(int|string $id): array { return $this->get("v2/catalog/bookings/{$id}/payment"); }
    public function payBooking(int|string $id, string $paymentMethod): array { return $this->post("v2/catalog/bookings/{$id}/pay", ['payment_method' => $paymentMethod]); }
    public function reviewBooking(int|string $id, int $rating, ?string $comment = null): array { return $this->post("v2/catalog/bookings/{$id}/review", array_filter(['rating' => $rating, 'comment' => $comment])); }

    public function notifications(): array { return $this->get('v2/catalog/notifications'); }
    public function markNotificationRead(int|string $id): array { return $this->post("v2/catalog/notifications/{$id}/read"); }
    public function notificationPreferences(): array { return $this->get('v2/catalog/notification-preferences'); }
    public function saveNotificationPreference(string $channel, bool $enabled): array { return $this->post('v2/catalog/notification-preferences', ['channel' => $channel, 'enabled' => $enabled]); }

    public function wallet(): array { return $this->get('v2/catalog/wallet'); }
    public function walletHistory(): array { return $this->get('v2/catalog/wallet/history'); }
    public function invoices(): array { return $this->get('v2/catalog/invoices'); }
    public function invoice(int|string $id): array { return $this->get("v2/catalog/invoices/{$id}"); }
    public function bookingInvoice(int|string $id): array { return $this->get("v2/catalog/bookings/{$id}/invoice"); }
    public function refunds(): array { return $this->get('v2/catalog/refunds'); }

    public function extraWork(int|string $bookingId, array $data): array { return $this->post("v2/catalog/vendor/bookings/{$bookingId}/extra-work", $data); }
    public function respondExtraWork(int|string $bookingId, int|string $extraWorkId, string $action): array { return $this->post("v2/catalog/bookings/{$bookingId}/extra-work/{$extraWorkId}/respond", ['action' => $action]); }

    public function createBookingRazorpayOrder(int $bookingId, float $amount): array
    {
        return $this->post("v2/catalog/bookings/{$bookingId}/pay", [
            'amount' => $amount, // rupees, CMS validates actual due amount
            'payment_method' => 'razorpay',
        ]);
    }

    public function verifyBookingRazorpayPayment(string $orderId, string $paymentId, string $signature): array
    {
        return $this->post('v2/catalog/bookings/verifypayment', [
            'razorpay_order_id' => $orderId,
            'razorpay_payment_id' => $paymentId,
            'razorpay_signature' => $signature,
        ]);
    }
}
