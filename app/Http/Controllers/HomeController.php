<?php

namespace App\Http\Controllers;

use App\Services\CatalogApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(CatalogApiService $catalogApi)
    {
        try {
            $response = $catalogApi->home();
            $home = $response['data'] ?? [];

            if (!empty($home['app_config']['name'])) {
                view()->share('appName', $home['app_config']['name']);
            }

            return view('home.index', [
                'location' => $home['location'] ?? null,
                'search' => $home['search'] ?? null,
                'banners' => $home['banners'] ?? [],
                'categories' => $home['categories'] ?? [],
                'featuredPackages' => $home['featured_packages'] ?? [],
                'popularPackages' => $home['popular_packages'] ?? [],
                'recentBookings' => $home['recent_bookings'] ?? [],
                'appConfig' => $home['app_config'] ?? [],
            ]);
        } catch (\Throwable $e) {
            report($e);
            return view('home.index', [
                'location' => null,
                'search' => null,
                'banners' => [],
                'categories' => [],
                'featuredPackages' => [],
                'popularPackages' => [],
                'recentBookings' => [],
                'appConfig' => [],
                'apiError' => 'Unable to load services right now.',
            ]);
        }
    }

    public function search(Request $request, CatalogApiService $catalogApi): JsonResponse
    {
        $q = trim((string) $request->input('q'));
        if ($q === '') {
            return response()->json(['status' => true, 'message' => 'OK', 'data' => []]);
        }

        try {
            return response()->json($catalogApi->search($q));
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['status' => false, 'message' => 'Search failed.', 'data' => []], 500);
        }
    }

    public function packageGroups(int $collection, CatalogApiService $catalogApi): JsonResponse
    {
        try {
            return response()->json($catalogApi->packageGroups($collection));
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['status' => false, 'message' => 'Unable to load package groups.', 'data' => []], 500);
        }
    }

    public function services(int $subcategory, CatalogApiService $catalogApi)
    {
        try {
            $response = $catalogApi->serviceCollections($subcategory);
            $data = $response['data'] ?? [];
            return view('services.services', [
                'subCategoryId' => $subcategory,
                'collections' => $data['service_collections'] ?? $data['collections'] ?? [],
                'brandTiers' => $data['brand_tiers'] ?? [],
            ]);
        } catch (\Throwable $e) {
            report($e);
            return view('services.services', [
                'subCategoryId' => $subcategory,
                'collections' => [],
                'brandTiers' => [],
                'apiError' => 'Unable to load services.',
            ]);
        }
    }

    public function categorySubCategories(int $category, CatalogApiService $catalogApi): JsonResponse
    {
        try {
            return response()->json($catalogApi->subCategories($category));
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['status' => false, 'message' => 'Unable to load sub-categories.', 'data' => []], 500);
        }
    }

    public function details(int $package, CatalogApiService $catalogApi): JsonResponse
    {
        try {

            $response = $catalogApi->packageDetails($package);
            
            if (($response['status'] ?? true) === false || empty($response['data'])) {
                return response()->json($response);
            }

            $data = $response['data'];

            $guestToken = $this->ensureGuestToken($catalogApi);

            $cartResponse = $catalogApi->cart($guestToken);

            $cartData = $cartResponse['data']['cart_groups'] ?? [];
            
            $cartItems = $cartData[0]['items']
                ?? (
                    is_array($cartData) && array_is_list($cartData)
                        ? $cartData
                        : []
                );
            
            $matchedCartItem = null;

            foreach ((array) $cartItems as $cartItem) {

                $cartItem = (array) $cartItem;

                $cartPackage = is_array($cartItem['package'] ?? null)
                    ? $cartItem['package']
                    : [];

                $cartPackageId = $cartItem['package_id']
                    ?? $cartPackage['id']
                    ?? null;

                if ((int) $cartPackageId === (int) $package) {
                    $matchedCartItem = $cartItem;
                    break;
                }
            }

            $data['iscart'] = $matchedCartItem ? 1 : 0;

            $data['in_cart'] = $matchedCartItem !== null;

            $data['cart_item_id'] = $matchedCartItem['cart_item_id']
                ?? $matchedCartItem['id']
                ?? null;

            $data['cart_quantity'] = $matchedCartItem
                ? (int) ($matchedCartItem['quantity'] ?? 1)
                : 0;

            $data['cart_item'] = $matchedCartItem;

            $response['data'] = $data;

            return response()->json($response);

        } catch (\Throwable $e) {

            report($e);

            return response()->json([
                'status' => false,
                'message' => 'Unable to load package details.',
                'data' => null,
            ], 500);
        }
    }

    private function ensureGuestToken(CatalogApiService $catalogApi): string
    {
        /*
         * Already have guest token in session
         */
        if ($token = session('catalog_guest_token')) {
            return $token;
        }

        try {

            /*
             * Ask API for guest token
             */
            $response = $catalogApi->guestToken();

            $data = $response['data'] ?? [];

            $token = $data['guest_token']
                ?? $data['token']
                ?? $response['guest_token']
                ?? $response['token']
                ?? null;

            if ($token) {

                session([
                    'catalog_guest_token' => $token,
                ]);

                return $token;
            }

        } catch (\Throwable $e) {

            report($e);
        }

        /*
         * Fallback token
         */
        $token = (string) \Illuminate\Support\Str::uuid();

        session([
            'catalog_guest_token' => $token,
        ]);

        return $token;
    }
}
