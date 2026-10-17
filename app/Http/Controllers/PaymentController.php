<?php

namespace App\Http\Controllers;

use App\Services\CatalogApiService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Crypt;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function createOrder(Request $request, CatalogApiService $api)
    {
        $amount=(float)$request->input('amount');
        if($amount<=0) return response()->json(['success'=>false,'message'=>'Invalid payment amount.'],422);
        try {
            $order=(new Api(config('services.razorpay.key'),config('services.razorpay.secret')))->order->create([
                'receipt'=>'BOOK_'.now()->format('YmdHis').'_'.random_int(1000,9999),
                'amount'=>(int)round($amount*100),'currency'=>'INR','payment_capture'=>1,
            ]);
            return response()->json(['success'=>true,'order_id'=>$order['id'],'amount'=>$order['amount'],'currency'=>$order['currency'],'key'=>config('services.razorpay.key'),'receipt'=>$order['receipt'] ?? null]);
        } catch (\Throwable $e) { report($e); return response()->json(['success'=>false,'message'=>'Unable to create payment order.'],500); }
    }

    public function verifyPayment(Request $request, CatalogApiService $api ) 
    {
        $v = $request->validate([
            'razorpay_order_id' => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'required|string',
            'address_id' => 'required',
            'slots' => 'required|array',
        ]);

        try {
            // Step 1: Verify Razorpay signature
            $razor = new Api(
                config('services.razorpay.key'),
                config('services.razorpay.secret')
            );

            $razor->utility->verifyPaymentSignature([
                'razorpay_order_id' => $v['razorpay_order_id'],
                'razorpay_payment_id' => $v['razorpay_payment_id'],
                'razorpay_signature' => $v['razorpay_signature'],
            ]);

            Log::info('Razorpay signature verified', [
                'order_id' => $v['razorpay_order_id'],
            ]);

            // Step 2: Call checkout API
            $checkout = $api->checkout(
                $v['address_id'],
                $v['slots']
            );

            // Step 3: Log complete checkout response
            Log::info('CMS CHECKOUT API RESPONSE', [
                'checkout' => $checkout,
            ]);

            // Step 4: Check checkout status
            if (!($checkout['status'] ?? false)) {
                throw new \RuntimeException(
                    $checkout['message'] ??
                    'Checkout API returned an error.'
                );
            }

            // Step 5: Extract booking ID
            $bookingId =
                data_get($checkout, 'data.bookings.0.id')
                ?? data_get($checkout, 'data.booking.id')
                ?? data_get($checkout, 'data.booking_ids.0')
                ?? data_get($checkout, 'data.id');

            if (!$bookingId) {
                Log::error('BOOKING ID NOT FOUND', [
                    'checkout' => $checkout,
                ]);

                throw new \RuntimeException(
                    'Booking was not returned by checkout API.'
                );
            }

            // Step 6: Return success
            return response()->json([
                'success' => true,
                'message' => 'Payment verified successfully.',
                'checkout' => $checkout,
                'redirect' => route('booking.success', [
                    'booking_id' => Crypt::encryptString(
                        (string) $bookingId
                    ),
                ]),
            ]);

        } catch (SignatureVerificationError $e) {

            Log::warning('Razorpay signature verification failed', [
                'order_id' => $v['razorpay_order_id'],
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Razorpay signature verification failed.',
            ], 400);

        } catch (\Throwable $e) {

            Log::error('PAYMENT VERIFICATION ERROR', [
                'message' => $e->getMessage(),
                'order_id' => $v['razorpay_order_id'],
            ]);

            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Unable to verify payment.',
            ], 500);
        }
    }

    public function placeOrder(Request $request, CatalogApiService $catalogApi): JsonResponse 
    {
        $validated = $request->validate([
            'address_id' => ['required', 'integer', 'min:1'],
            'slots' => ['required', 'array', 'min:1'],
            'slots.*.slot_date' => ['required', 'date_format:Y-m-d'],
            'slots.*.slot_time' => ['required', 'date_format:H:i'],
        ]);

        try {
            if (!session('catalog_auth_token')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Please login to place your order.',
                ], 401);
            }

            // Calls existing CMS checkout API.
            $checkout = $catalogApi->checkout(
                $validated['address_id'],
                $validated['slots']
            );

            if (!($checkout['status'] ?? false)) {
                return response()->json([
                    'status' => false,
                    'message' => $checkout['message']
                        ?? 'Unable to place order.',
                    'errors' => $checkout['errors'] ?? null,
                ], 422);
            }

            // Support different booking response structures.
            $bookingId =
                data_get($checkout, 'data.bookings.0.id')
                ?? data_get($checkout, 'data.booking.id')
                ?? data_get($checkout, 'data.booking_ids.0')
                ?? data_get($checkout, 'data.id');

            if (!$bookingId) {
                report(new \RuntimeException(
                    'Checkout succeeded but booking ID was not returned.'
                ));

                return response()->json([
                    'status' => false,
                    'message' => 'Order submitted, but booking confirmation is pending. Please check your bookings before trying again.',
                ], 202);
            }

            return response()->json([
                'status' => true,
                'message' => 'Order placed successfully.',
                'checkout' => $checkout,
                'redirect' => route('booking.success', [
                    'booking_id' => Crypt::encryptString(
                        (string) $bookingId
                    ),
                ]),
            ]);

        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'status' => false,
                'message' => 'Unable to place order. Please check your bookings before retrying.',
            ], 500);
        }
    }
}
