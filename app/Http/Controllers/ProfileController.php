<?php

namespace App\Http\Controllers;

use App\Services\CatalogApiService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(CatalogApiService $api)
    {
        try {
            $profile = $api->profile()['data'] ?? [];
            $user = $this->normalizeUser($profile ?: (session('catalog_user') ?? []));
            $bookings = $api->bookings()['data'] ?? [];
            
            $upcoming = count($bookings['upcoming']);
            $completed = count($bookings['completed']);
            $cancelled = count($bookings['cancelled']);
            
            $stats = [
                ['label'=>'Bookings','value'=>$upcoming+$completed+$cancelled,'icon'=>'calendar'],
                ['label'=>'Upcoming','value'=>$upcoming,'icon'=>'clock'],
            ];
            session(['catalog_user'=>$profile ?: session('catalog_user')]);
            return view('profile.index', compact('user','stats'));
        } catch (\Throwable $e) {
            report($e);
            $user = $this->normalizeUser(session('catalog_user') ?? []);
            return view('profile.index', ['user'=>$user,'stats'=>[],'apiError'=>'Unable to load profile.']);
        }
    }

    public function edit(CatalogApiService $api)
    {
        $profile = $api->profile()['data'] ?? session('catalog_user') ?? [];
        if (isset($profile['customer']) && is_array($profile['customer'])) $profile = $profile['customer'];
        return view('profile.edit', ['user'=>$this->normalizeUser($profile)]);
    }

    public function update(Request $request, CatalogApiService $api)
    {
        $validated = $request->validate(['name'=>['nullable','string','max:120'],'first_name'=>['nullable','string','max:80'],'last_name'=>['nullable','string','max:80'],'email'=>['nullable','email','max:180'],'profile_image'=>['nullable','image','max:4096']]);
        try {
            $image = $request->file('profile_image');
            $response = $api->updateProfile(['name'=>trim($validated['name'] ?? trim(($validated['first_name'] ?? '').' '.($validated['last_name'] ?? ''))),'email'=>$validated['email'] ?? null], $image?->getRealPath());
            if (!empty($response['data'])) session(['catalog_user'=>$response['data']['customer'] ?? $response['data']['user'] ?? $response['data']]);
            return redirect()->route('profile')->with('success','Profile updated successfully.');
        } catch (\Throwable $e) { report($e); return back()->withInput()->with('error','Unable to update profile.'); }
    }

    public function addresses(CatalogApiService $api)
    {
        try { $data = $this->listData($api->addresses()['data'] ?? []); }
        catch (\Throwable $e) { report($e); $data=[]; }
        return view('profile.addresses', ['addresses'=>array_map([$this,'normalizeAddress'],$data)]);
    }

    public function addressAdd() { return view('profile.address-add'); }

    public function addressEdit(int|string $address, CatalogApiService $api)
    {
        try { $data = $api->address($address)['data'] ?? []; $data = $data['address'] ?? $data; }
        catch (\Throwable $e) { report($e); abort(404); }
        return view('profile.address-edit', ['address'=>array_merge(['id'=>$address],$this->normalizeAddress($data))]);
    }

    public function wallet(CatalogApiService $api) { return view('profile.wallet', ['wallet'=>$api->wallet()['data'] ?? []]); }
    public function invoices(CatalogApiService $api) { return view('profile.invoices', ['invoices'=>$this->listData($api->invoices()['data'] ?? [])]); }
    public function refunds(CatalogApiService $api) { return view('profile.refunds', ['refunds'=>$this->listData($api->refunds()['data'] ?? [])]); }
    public function notifications(CatalogApiService $api) { return view('profile.notifications', ['notifications'=>$this->listData($api->notifications()['data'] ?? []),'preferences'=>$api->notificationPreferences()['data'] ?? []]); }

    private function normalizeUser(array $u): array
    {
        $name = trim((string)($u['name'] ?? ''));
        $parts = preg_split('/\s+/', $name, 2);
        return [
            'name'=>$name ?: 'Customer',
            'first_name'=>$u['first_name'] ?? ($parts[0] ?? 'Customer'),
            'last_name'=>$u['last_name'] ?? ($parts[1] ?? ''),
            'phone'=>$u['phone_number'] ?? $u['phone_number'] ?? '',
            'sid'=>$u['sid'] ?? $u['sid'] ?? '',
            'email'=>$u['email'] ?? '',
            'member_since'=>$u['created_at'] ?? $u['member_since'] ?? null,
            'profile_image'=>$u['profile_image'] ?? $u['profile_image'] ?? null,
        ];
    }

    private function normalizeAddress(array $a): array
    {
        $type = ucfirst((string)($a['type'] ?? 'Other'));
        return [
            'id'=>$a['id'] ?? null,
            'type'=>$type,
            'icon'=>strtolower($type)==='home'?'home':(strtolower($type)==='work'?'office':'location'),
            'name'=>$a['name'] ?? $a['contact_name'] ?? session('catalog_user.name','Customer'),
            'phone'=>$a['phone'] ?? $a['mobile'] ?? session('catalog_user.phone',''),
            'address'=>$a['address'] ?? '',
            'area'=>$a['area'] ?? trim(implode(', ', array_filter([$a['city'] ?? null,$a['state'] ?? null,$a['pincode'] ?? null]))),
            'landmark'=>$a['landmark'] ?? '',
            'default'=>filter_var($a['is_default'] ?? $a['default'] ?? false, FILTER_VALIDATE_BOOL),
            'house'=>$a['house'] ?? $a['house_no'] ?? '',
            'floor'=>$a['floor'] ?? '',
            'street'=>$a['street'] ?? $a['address'] ?? '',
            'city'=>$a['city'] ?? '',
            'state'=>$a['state'] ?? '',
            'pincode'=>$a['pincode'] ?? '',
            'latitude'=>$a['latitude'] ?? '',
            'longitude'=>$a['longitude'] ?? '',
            'instructions'=>$a['instructions'] ?? '',
        ];
    }

    private function listData($data): array
    {
        if (is_array($data) && array_is_list($data)) return $data;
        foreach (['items','bookings','data','results','records','notifications','invoices','refunds'] as $key) {
            if (is_array($data[$key] ?? null)) return $data[$key];
        }
        return is_array($data) && $data ? [$data] : [];
    }
}
