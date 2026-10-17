<?php

namespace App\Http\Controllers;

use App\Services\CatalogApiService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(CatalogApiService $catalogApi)
    {
        try {
            $response = $catalogApi->addresses();
            return response()->json($response);
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['status' => false, 'message' => 'Unable to load addresses.', 'data' => []], 500);
        }
    }

    public function store(Request $request, CatalogApiService $catalogApi)
    {
        $data = $request->validate([
            'type' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:500'],
            'landmark' => ['nullable', 'string', 'max:255'],
            'floor' => ['nullable', 'string', 'max:100'],
            'instructions' => ['nullable', 'string', 'max:500'],
            'is_default' => ['nullable', 'boolean'],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
        ]);
        try { return response()->json($catalogApi->createAddress($data)); }
        catch (\Throwable $e) { report($e); return response()->json(['status'=>false,'message'=>'Unable to create address.','data'=>null],500); }
    }

    public function show(int|string $address, CatalogApiService $catalogApi)
    {
        try { return response()->json($catalogApi->address($address)); }
        catch (\Throwable $e) { report($e); return response()->json(['status'=>false,'message'=>'Unable to load address.','data'=>null],500); }
    }

    public function update(Request $request, int|string $address, CatalogApiService $catalogApi)
    {
        $data = $request->validate([
            'type' => ['sometimes', 'string', 'max:30'],
            'address' => ['sometimes', 'string', 'max:500'],
            'landmark' => ['nullable', 'string', 'max:255'],
            'floor' => ['nullable', 'string', 'max:100'],
            'instructions' => ['nullable', 'string', 'max:500'],
            'is_default' => ['nullable', 'boolean'],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
        ]);
        try { return response()->json($catalogApi->updateAddress($address, $data, $request->boolean('_patch'))); }
        catch (\Throwable $e) { report($e); return response()->json(['status'=>false,'message'=>'Unable to update address.','data'=>null],500); }
    }

    public function makeDefault(int|string $address, CatalogApiService $catalogApi)
    {
        try { return response()->json($catalogApi->updateAddress($address, ['is_default' => true], true)); }
        catch (\Throwable $e) { report($e); return response()->json(['status'=>false,'message'=>'Unable to set default address.','data'=>null],500); }
    }

    public function destroy(int|string $address, CatalogApiService $catalogApi)
    {
        try { return response()->json($catalogApi->deleteAddress($address)); }
        catch (\Throwable $e) { report($e); return response()->json(['status'=>false,'message'=>'Unable to delete address.','data'=>null],500); }
    }
}
