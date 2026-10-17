<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function update(Request $request): JsonResponse
    {
        $data = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'pincode' => ['required', 'string', 'regex:/^\\d{4,10}$/'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        session()->put('catalog_location', [
            'latitude' => (float) $data['latitude'],
            'longitude' => (float) $data['longitude'],
            'pincode' => $data['pincode'],
            'address' => $data['address'] ?? null,
        ]);

        // Backward compatibility for existing views.
        session()->put('catalog_latitude', (float) $data['latitude']);
        session()->put('catalog_longitude', (float) $data['longitude']);
        session()->put('catalog_pincode', $data['pincode']);
        session()->put('catalog_address', $data['address'] ?? null);

        return response()->json([
            'status' => true,
            'message' => 'Location updated.',
            'location' => session('catalog_location'),
        ]);
    }

    public function current(): JsonResponse
    {
        $location = session('catalog_location');

        return response()->json([
            'status' => true,
            'location' => $location ?: [
                'latitude' => (float) config('services.catalog.latitude'),
                'longitude' => (float) config('services.catalog.longitude'),
                'pincode' => (string) config('services.catalog.pincode', '380015'),
                'address' => null,
            ],
        ]);
    }
}
