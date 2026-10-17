<?php

namespace App\Http\Controllers;

use App\Services\CatalogApiService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    
    public function cart(CatalogApiService $catalogApi)
    {
        $guestToken = null;
        $authToken = session('catalog_auth_token');

        try {
            // Guest user
            if (!$authToken) {
                $guestToken = $this->ensureGuestToken($catalogApi);
            }

            // CatalogApiService must handle authentication
            // and guest token separately.
            $cartResponse = $catalogApi->cart($guestToken);

            if (($cartResponse['status'] ?? false) === false) {
                throw new \RuntimeException(
                    $cartResponse['message'] ?? 'Unable to load cart.'
                );
            }

            $cartData = $cartResponse['data'] ?? [];

            $cartGroups = $cartData['cart_groups'] ?? [];

            // Flatten items from all categories.
            $items = collect($cartGroups)
                ->flatMap(function ($group) {
                    return $group['items'] ?? [];
                })
                ->map(function ($item) {
                    return $this->normalizeItem((array) $item);
                })
                ->values()
                ->all();
            
            return view('cart.index', [
                'cart' => $cartData,
                'cartItems' => $items,
                'guestToken' => $guestToken,
                'authToken' => $authToken,
                'catalogUser' => session('catalog_user'),
                'selectedLocation' => session('catalog_location'),
                'apiError' => null,
            ]);

        } catch (\Throwable $e) {
            report($e);

            return view('cart.index', [
                'cart' => [],
                'cartItems' => [],
                'guestToken' => $guestToken,
                'authToken' => $authToken,
                'catalogUser' => session('catalog_user'),
                'selectedLocation' => session('catalog_location'),
                'apiError' => 'Unable to load cart.',
            ]);
        }
    }


    
    // Add imports: Illuminate\Http\Request, Illuminate\Http\JsonResponse
    public function store(Request $request, CatalogApiService $catalogApi): JsonResponse
    {
        $validated = $request->validate([
            'package_id' => ['required', 'integer', 'min:1'],
            'quantity' => ['required', 'integer', 'min:1'],
            'variant_id' => ['nullable', 'integer', 'min:1'],
            'selections' => ['nullable', 'array'],
            'selections.*' => ['integer', 'min:1'],
            'section_selections' => ['nullable', 'array'],
            'section_selections.*.section_item_id' => ['required', 'integer', 'min:1'],
            'section_selections.*.option_id' => ['nullable', 'integer', 'min:0'],
        ]);
        try {
            $guestToken = session('catalog_auth_token')
                ? null
                : $this->ensureGuestToken($catalogApi);

            $response = $catalogApi->addToCart(
                (int) $validated['package_id'],
                (int) $validated['quantity'],
                $guestToken,
                isset($validated['variant_id']) ? (int) $validated['variant_id'] : null,
                $validated['selections'] ?? null,
                $validated['section_selections'] ?? null
            );
            return response()->json($response, ($response['status'] ?? false) ? 200 : 422);
        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'status' => false,
                'message' => 'Unable to add service to cart.',
            ], 500);
        }
    }


    public function update(Request $request, int|string $item, CatalogApiService $catalogApi)
    {
        $data = $request->validate(['quantity'=>['required','integer','min:1'],'guest_token'=>['nullable','string'],'slot_date'=>['nullable','date'],'slot_time'=>['nullable','string']]);
        try { return response()->json($catalogApi->updateCartItem($item,(int)$data['quantity'],$data['guest_token'] ?? session('catalog_guest_token'), array_filter(['slot_date'=>$data['slot_date'] ?? null,'slot_time'=>$data['slot_time'] ?? null]))); }
        catch (\Throwable $e) { report($e); return response()->json(['status'=>false,'message'=>'Unable to update cart item.','data'=>null],500); }
    }

    public function destroy(Request $request, int|string $item, CatalogApiService $catalogApi)
    {
        try { return response()->json($catalogApi->deleteCartItem($item, $request->input('guest_token') ?? session('catalog_guest_token'))); }
        catch (\Throwable $e) { report($e); return response()->json(['status'=>false,'message'=>'Unable to remove cart item.','data'=>null],500); }
    }


    public function cartCount(CatalogApiService $catalogApi): JsonResponse
    {
        try {
            $guestToken = $this->ensureGuestToken($catalogApi);

            $response = $catalogApi->cart($guestToken);

            if (($response['status'] ?? false) === false) {
                return response()->json([
                    'status' => false,
                    'count' => 0,
                    'message' => $response['message'] ?? 'Unable to load cart.'
                ], 502);
            }

            $cartGroups = $response['data']['cart_groups'] ?? [];

            $count = 0;

            foreach ($cartGroups as $group) {
                foreach (($group['items'] ?? []) as $item) {
                    $count += (int) ($item['quantity'] ?? 1);
                }
            }

            return response()->json([
                'status' => true,
                'count' => $count,
                'total' => $response['data']['total'] ?? 0,
            ]);

        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'status' => false,
                'count' => 0,
                'message' => 'Unable to load cart count.'
            ], 500);
        }
    }

    
    private function normalizeItem(array $item): array
    {
        $package = (array) ($item['package'] ?? []);

        $variant = (array) ($item['package_variant'] ?? []);

        $quantity = max(1, (int) ($item['quantity'] ?? 1));

        $unitPrice = (float) ($item['unit_price'] ?? 0);

        return [
            // Cart item identity
            'id' => (int) ($item['id'] ?? 0),
            'cart_item_id' => (int) ($item['id'] ?? 0),
            'cart_id' => $item['cart_id'] ?? null,

            // Package identity
            'package_id' => (int) ($item['package_id'] ?? 0),
            'package_variant_id' =>
                $item['package_variant_id'] ?? null,

            // Display information
            'name' => $package['name'] ?? 'Service',

            'thumbnail_image' =>
                $package['thumbnail_image'] ?? null,

            'pricing_mode' =>
                $package['pricing_mode'] ?? 'fixed',

            // Price and quantity
            'price' => $unitPrice,
            'unit_price' => $unitPrice,
            'quantity' => $quantity,
            'subtotal' => $unitPrice * $quantity,

            // Selected options
            'selections' => $item['selections'] ?? [],

            // Booking information
            'slot_date' => $item['slot_date'] ?? null,
            'slot_time' => $item['slot_time'] ?? null,

            // Variant information
            'package_variant' => $variant ?: null,

            // Alpine loading state
            'loading' => false,
        ];
    }


    private function ensureGuestToken(CatalogApiService $catalogApi): string
    {
        if ($token = session('catalog_guest_token')) return $token;
        try {
            $response = $catalogApi->guestToken();
            $data = $response['data'] ?? [];
            $token = $data['guest_token'] ?? $data['token'] ?? $response['guest_token'] ?? $response['token'] ?? null;
            if ($token) {
                session(['catalog_guest_token'=>$token]);
                return $token;
            }
        } catch (\Throwable $e) { report($e); }
        $token = (string) \Illuminate\Support\Str::uuid();
        session(['catalog_guest_token'=>$token]);
        return $token;
    }
}
