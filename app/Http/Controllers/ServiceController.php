<?php

namespace App\Http\Controllers;

use App\Services\CatalogApiService;

class ServiceController extends Controller
{
    private function normalizePackage(array $p): array
    {
        $category = $p['category'] ?? $p['category_name'] ?? null;
        if (is_array($category)) {
            $category = $category['name'] ?? null;
        }
        $rating = $p['rating'] ?? $p['average_rating'] ?? 0;
        $reviews = $p['reviews_count'] ?? $p['review_count'] ?? (is_numeric($p['reviews'] ?? null) ? $p['reviews'] : 0);
        return [
            'id' => $p['id'] ?? $p['package_id'] ?? null,
            'slug' => $p['slug'] ?? $p['id'] ?? null,
            'name' => $p['name'] ?? $p['title'] ?? 'Service',
            'category' => $category ?? 'Home Services',
            'image' => $p['image'] ?? $p['image_url'] ?? ($p['thumbnail'] ?? null),
            'rating' => (float) $rating,
            'reviews' => (int) $reviews,
            'price' => (float) ($p['price'] ?? $p['sale_price'] ?? $p['current_price'] ?? 0),
            'old_price' => (float) ($p['old_price'] ?? $p['mrp'] ?? $p['original_price'] ?? 0),
            'discount' => $p['discount_label'] ?? $p['discount'] ?? null,
            'duration' => $p['duration'] ?? $p['service_duration'] ?? null,
        ];
    }

    public function index(CatalogApiService $catalogApi)
    {
        try {
            $home = $catalogApi->home()['data'] ?? [];
            $packages = array_merge($home['featured_packages'] ?? [], $home['popular_packages'] ?? []);
            $seen = [];
            $services = [];
            foreach ($packages as $package) {
                $id = $package['id'] ?? $package['package_id'] ?? null;
                if ($id !== null && isset($seen[$id])) continue;
                if ($id !== null) $seen[$id] = true;
                $services[] = $this->normalizePackage($package);
            }

            $categories = $home['categories'] ?? ($catalogApi->categories()['data'] ?? []);
            return view('services.index', compact('categories', 'services'));
        } catch (\Throwable $e) {
            report($e);
            return view('services.index', ['categories' => [], 'services' => [], 'apiError' => 'Unable to load services.']);
        }
    }

    public function show(int|string $service, CatalogApiService $catalogApi)
    {
        if (!ctype_digit((string) $service)) {
            return redirect()
                ->route('services.index')
                ->with('error', 'This service could not be found.');
        }

        try {
            $response = $catalogApi->packageDetails((int) $service);
            
            if (($response['status'] ?? true) === false || empty($response['data'])) {
                return view('services.show', [
                    'service' => [
                        'id' => (int) $service,
                        'name' => 'Service not available',
                    ],
                    'reviews' => [],
                    'packageResponse' => $response,
                    'serviceUnavailable' => true,
                    'serviceUnavailableMessage' => $response['message']
                        ?? 'Currently we are not providing service in this area',
                ]);
            }

            $data = $response['data'] ?? [];

            $package = $data['package'] ?? $data;

            if (!is_array($package) || empty($package)) {
                return view('services.show', [
                    'service' => [
                        'id' => (int) $service,
                        'name' => 'Service not available',
                    ],
                    'reviews' => [],
                    'packageResponse' => $response,
                    'serviceUnavailable' => true,
                    'serviceUnavailableMessage' => 'This service is currently not available.',
                ]);
            }

            $serviceData = $this->normalizePackage($package);

            $serviceData = array_merge(
                $package,
                $serviceData
            );

            $serviceData['id'] = $package['id'] ?? (int) $service;

            $serviceData['name'] = $package['name']
                ?? $serviceData['name'];

            $serviceData['images'] = $package['images']
                ?? array_values(
                    array_filter([
                        $serviceData['image']
                    ])
                );

            $serviceData['included'] = $package['included']
                ?? $package['inclusions']
                ?? [];

            $serviceData['excluded'] = $package['excluded']
                ?? $package['exclusions']
                ?? [];

            $serviceData['highlights'] = $package['highlights']
                ?? [];

            $reviews = $data['reviews']
                ?? $package['reviews']
                ?? [];

            return view('services.show', [
                'service' => $serviceData,
                'reviews' => is_array($reviews) ? $reviews : [],
                'packageResponse' => $response,
                'serviceUnavailable' => false,
                'serviceUnavailableMessage' => null,
            ]);

        } catch (\Throwable $e) {

            report($e);

            return view('services.show', [
                'service' => [
                    'id' => (int) $service,
                    'name' => 'Service unavailable',
                ],
                'reviews' => [],
                'packageResponse' => [],
                'serviceUnavailable' => true,
                'serviceUnavailableMessage' =>
                    'Unable to load this service right now.',
            ]);
        }
    }
}
