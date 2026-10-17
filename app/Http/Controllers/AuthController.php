<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CatalogApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function sendOtp(
        Request $request,
        CatalogApiService $catalogApi
    ): JsonResponse {
        $validated = $request->validate([
            'mobile' => ['required', 'string', 'max:10'],
        ]);

        try {

            $response = $catalogApi->sendOtp(
                $validated['mobile']
            );

            return response()->json($response);

        } catch (\Throwable $e) {

            report($e);

            return response()->json([
                'status' => false,
                'message' => 'Unable to send OTP.',
                'data' => null,
            ], 500);
        }
    }

    public function resendOtp(
        Request $request,
        CatalogApiService $catalogApi
    ): JsonResponse {
        $validated = $request->validate([
            'mobile' => ['required', 'string', 'max:20'],
        ]);

        try {

            $response = $catalogApi->resendOtp(
                $validated['mobile']
            );

            return response()->json($response);

        } catch (\Throwable $e) {

            report($e);

            return response()->json([
                'status' => false,
                'message' => 'Unable to resend OTP.',
                'data' => null,
            ], 500);
        }
    }

    public function verifyOtp(
        Request $request,
        CatalogApiService $catalogApi
    ): JsonResponse {
        $validated = $request->validate([
            'mobile' => ['required', 'string', 'max:10'],
            'otp' => ['required', 'string', 'max:6'],
        ]);

        try {

            $response = $catalogApi->verifyOtp(
                mobile: $validated['mobile'],
                otp: $validated['otp'],
                name: $validated['name'] ?? null,
                deviceId: 'web_' . session()->getId(),
                deviceType: 'web',
                fcmToken: null,
                referralCode: null,
                bearerToken: null
            );

            /*
             * API response.
             */
            $token = $response['data']['token']
                ?? $response['data']['access_token']
                ?? $response['token']
                ?? $response['access_token']
                ?? null;

            if (!$token) {
                return response()->json([
                    'status' => false,
                    'message' => 'Login successful but authentication token was not returned.',
                    'data' => null,
                ], 500);
            }

            /*
             * Store API authentication
             * on the Laravel server-side session.
             */
            session([
                'catalog_auth_token' => $token,
            ]);

            /*
             * Store basic customer information if API returns it.
             */
            if (!empty($response['data']['customer'])) {
                session([
                    'catalog_user' => $response['data']['customer'],
                ]);
            }

            /*
             * Regenerate Laravel session ID after login.
             */
            $request->session()->regenerate();

            if ($guest = session('catalog_guest_token')) {
                try { $catalogApi->mergeCart($guest); } catch (\Throwable $e) { report($e); }
            }

            return response()->json([
                'status' => true,
                'message' => $response['message'] ?? 'Login successful.',
                'data' => [
                    'logged_in' => true,
                ],
            ]);

        } catch (\Throwable $e) {

            report($e);

            return response()->json([
                'status' => false,
                'message' => 'Unable to verify OTP.',
                'data' => null,
            ], 500);
        }
    }

    public function logout(
        Request $request,
        CatalogApiService $catalogApi
    ) {
        $token = session('catalog_auth_token');

        if ($token) {
            try {
                $catalogApi->logout($token);
            } catch (\Throwable $e) {
                report($e);
            }
        }

        $request->session()->forget('catalog_auth_token');

        return redirect()->route('home');
    }
}