<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CatalogApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    
    public function index(CatalogApiService $api)
    {
        try {
            $response = $api->bookings();

            if (!($response['status'] ?? false)) {
                throw new \RuntimeException(
                    $response['message'] ?? 'Unable to load bookings.'
                );
            }

            $data = $response['data'] ?? [];

            $upcoming = collect($data['upcoming'] ?? [])
                ->map(fn ($booking) => $this->normalizeBooking($booking))
                ->values()
                ->all();

            $completed = collect($data['completed'] ?? [])
                ->map(fn ($booking) => $this->normalizeBooking($booking))
                ->values()
                ->all();

            $cancelled = collect($data['cancelled'] ?? [])
                ->map(fn ($booking) => $this->normalizeBooking($booking))
                ->values()
                ->all();

        } catch (\Throwable $e) {
            report($e);

            $upcoming = [];
            $completed = [];
            $cancelled = [];
        }

        $stats = [
            [
                'label' => 'Total Bookings',
                'value' => count($upcoming) + count($completed) + count($cancelled),
                'icon' => 'calendar',
            ],
            [
                'label' => 'Upcoming',
                'value' => count($upcoming),
                'icon' => 'clock',
            ],
            [
                'label' => 'Completed',
                'value' => count($completed),
                'icon' => 'check',
            ],
            [
                'label' => 'Cancelled',
                'value' => count($cancelled),
                'icon' => 'x',
            ],
        ];

        return view('booking.index', [
            'bookings' => array_merge($upcoming, $completed, $cancelled),
            'upcomingBookings' => $upcoming,
            'completedBookings' => $completed,
            'cancelledBookings' => $cancelled,
            'stats' => $stats,
        ]);
    }

    public function show(int|string $booking, CatalogApiService $api)
    {
        try {
            $data=$api->bookingDetails($booking)['data'] ?? [];
            $bookingData=$data['booking'] ?? $data;
            return view('booking.show',['booking'=>$this->normalizeBooking($bookingData,true),'rawBooking'=>$bookingData]);
        } catch (\Throwable $e) { report($e); abort(404); }
    }

    public function cancel(Request $request,int|string $booking,CatalogApiService $api)
    {
        $reason=$request->validate(['reason'=>['nullable','string','max:500']])['reason'] ?? '';
        try { return $this->apiResponse($request,$api->cancelBooking($booking,$reason),'Booking cancelled.'); }
        catch (\Throwable $e) { report($e); return response()->json(['status'=>false,'message'=>'Unable to cancel booking.'],500); }
    }

    public function review(Request $request,int|string $booking,CatalogApiService $api)
    {
        $v=$request->validate(['rating'=>['required','integer','between:1,5'],'comment'=>['nullable','string','max:1000']]);
        try { return $this->apiResponse($request,$api->reviewBooking($booking,$v['rating'],$v['comment'] ?? null),'Review submitted.'); }
        catch (\Throwable $e) { report($e); return response()->json(['status'=>false,'message'=>'Unable to submit review.'],500); }
    }

    public function payment(int|string $booking,CatalogApiService $api)
    {
        try { $data=$api->bookingPayment($booking); return view('booking.payment',['payment'=>$data['data'] ?? $data,'bookingId'=>$booking]); }
        catch (\Throwable $e) { report($e); abort(404); }
    }

    public function pay(Request $request,int|string $booking,CatalogApiService $api)
    {
        $method=$request->validate(['payment_method'=>['required','string','max:30']])['payment_method'];
        try { return $this->apiResponse($request,$api->payBooking($booking,$method),'Payment completed.'); }
        catch (\Throwable $e) { report($e); return response()->json(['status'=>false,'message'=>'Unable to complete payment.'],500); }
    }

    public function address(CatalogApiService $api)
    {
        $addresses=$this->listData($api->addresses()['data'] ?? []);
        return view('booking.address',['addresses'=>array_map([$this,'normalizeAddress'],$addresses),'service'=>$this->flowService($api)]);
    }

    public function selectAddress(Request $request)
    {
        $id=$request->validate(['address_id'=>['required']])['address_id'];
        session(['booking.address_id'=>$id]);
        return redirect()->route('booking.date-time');
    }

    public function addAddress() { return view('booking.add-address'); }

    public function createAddress(Request $request,CatalogApiService $api)
    {
        $data=$request->validate(['type'=>['required','string','max:30'],'address'=>['required','string','max:500'],'landmark'=>['nullable','string','max:255'],'floor'=>['nullable','string','max:100'],'instructions'=>['nullable','string','max:500'],'is_default'=>['nullable','boolean'],'latitude'=>['nullable'],'longitude'=>['nullable']]);
        try { $res=$api->createAddress($data); $created=$res['data']['address'] ?? $res['data'] ?? []; if(isset($created['id'])) session(['booking.address_id'=>$created['id']]); return redirect()->route('booking.address')->with('success','Address saved.'); }
        catch (\Throwable $e) { report($e); return back()->withInput()->with('error','Unable to save address.'); }
    }

    public function dateTime(CatalogApiService $api)
    {
        $service=$this->flowService($api);
        $dates=[]; for($i=0;$i<7;$i++){ $d=now()->addDays($i); $dates[]=['value'=>$d->format('Y-m-d'),'day'=>$i===0?'Today':($i===1?'Tomorrow':$d->format('D')),'date'=>$d->format('d'),'month'=>$d->format('M'),'full'=>$d->format('l, d F')]; }
        return view('booking.date-time',['service'=>$service,'dates'=>$dates,'selectedDate'=>session('booking.date'),'selectedTime'=>session('booking.time'),'timeSlots'=>[]]);
    }

    public function slots(Request $request,CatalogApiService $api)
    {
        $date=$request->validate(['date'=>['required','date']])['date'];
        try { return response()->json($api->slots($date)); }
        catch(\Throwable $e){ report($e); return response()->json(['status'=>false,'message'=>'Unable to load slots.','data'=>[]],500); }
    }

    public function selectDateTime(Request $request)
    {
        $v=$request->validate(['date'=>['required','date'],'time'=>['required','string','max:20']]); session(['booking.date'=>$v['date'],'booking.time'=>$v['time']]); return redirect()->route('booking.add-ons');
    }

    public function addOns(CatalogApiService $api)
    {
        // The V2 collection does not expose a standalone add-on list endpoint.
        // Package-specific sections/options are available from package details, so show them when present.
        $service=$this->flowService($api); $addons=[];
        if(!empty($service['sections']) && is_array($service['sections'])){
            foreach($service['sections'] as $section){ foreach(($section['items'] ?? []) as $item){
                foreach(($item['options'] ?? []) as $option){ $addons[]=['id'=>$option['id']??null,'name'=>$option['name']??'Option','description'=>$option['description']??($item['name']??''),'price'=>(float)($option['price']??0),'duration'=>$option['duration']??'']; }
            }}
        }
        return view('booking.add-ons',['service'=>$service,'addons'=>$addons,'date'=>session('booking.date'),'time'=>session('booking.time'),'address'=>$this->selectedAddress($api)]);
    }

    public function selectAddons(Request $request)
    {
        $addons = $request->input('addons', []);
        session(['booking.addons' => is_array($addons) ? array_values($addons) : []]);
        return response()->json(['status' => true]);
    }

    public function bookingSummary(CatalogApiService $api)
    {
        $cart=$api->cart(session('catalog_guest_token'))['data'] ?? []; $items=$this->listData($cart); $address=$this->selectedAddress($api); $service=$this->flowService($api);
        $subtotal=(float)($cart['subtotal'] ?? $this->sumItems($items)); $discount=(float)($cart['discount'] ?? 0); $taxes=(float)($cart['tax'] ?? $cart['taxes'] ?? 0); $total=(float)($cart['total'] ?? max(0,$subtotal-$discount+$taxes));
        return view('booking.summary',['service'=>$service,'address'=>$address,'date'=>session('booking.date'),'time'=>session('booking.time'),'addons'=>[],'addonsTotal'=>0,'subtotal'=>$subtotal,'discount'=>$discount,'taxes'=>$taxes,'total'=>$total]);
    }

    public function customerDetails(CatalogApiService $api)
    { $profile=$api->profile()['data'] ?? session('catalog_user') ?? []; $profile=$profile['customer']??$profile; return view('booking.customer-details',['customer'=>$this->normalizeCustomer($profile),'service'=>$this->flowService($api),'addonsTotal'=>0,'discount'=>0,'taxes'=>0,'total'=>0]); }

    public function bookingSuccess(Request $request,CatalogApiService $api)
    {
        try { 
            $encrypted=$request->query('booking_id'); 
            if(!$encrypted) abort(404); 
                $id=Crypt::decryptString($encrypted); 
                $data=$api->bookingDetails($id)['data'] ?? []; 
                return view('booking.success',['booking'=>$data['booking']??$data]); 
        }
        catch(\Throwable $e){ report($e); abort(404); }
    }

    private function flowService(CatalogApiService $api): array
    {
        try {
            $cart=$api->cart(session('catalog_guest_token'))['data'] ?? []; $items=$this->listData($cart); $item=$items[0] ?? [];
            $package=$item['package'] ?? $item; $id=$package['id']??$item['package_id']??null;
            if($id){ $details=$api->packageDetails($id); $data=$details['data']??[]; $package=array_merge($package,$data['package']??$data); }
            return ['id'=>$id,'name'=>$package['name']??$item['name']??'Selected Service','category'=>$package['category']['name']??$package['category_name']??'Home Services','price'=>(float)($item['price']??$package['price']??0),'duration'=>$package['duration']??$package['service_duration']??'','image'=>$package['image']??$package['image_url']??''];
        } catch(\Throwable $e){ report($e); return ['id'=>null,'name'=>'Selected Service','category'=>'Home Services','price'=>0,'duration'=>'','image'=>'']; }
    }

    private function selectedAddress(CatalogApiService $api): ?array
    { $id=session('booking.address_id'); if(!$id) return null; try{$d=$api->address($id)['data']??[]; return $d['address']??$d;}catch(\Throwable $e){return null;} }
    private function sumItems(array $items): float { $sum=0; foreach($items as $i){$sum+=(float)($i['price']??$i['total']??0)*(float)($i['quantity']??1);} return $sum; }
    private function listData($data): array { if(is_array($data)&&array_is_list($data))return$data; foreach(['items','bookings','results','records','data'] as $k){if(is_array($data[$k]??null))return$data[$k];} return is_array($data)&&$data?[$data]:[]; }
    private function normalizeAddress(array $a):array { $type=ucfirst((string)($a['type']??'Other')); return ['id'=>$a['id']??null,'type'=>$type,'icon'=>strtolower($type)==='home'?'home':(strtolower($type)==='work'?'building':'location'),'name'=>$a['name']??$a['contact_name']??'Customer','address'=>$a['address']??'','area'=>$a['area']??trim(implode(', ',array_filter([$a['city']??null,$a['state']??null,$a['pincode']??null]))),'phone'=>$a['phone']??$a['mobile']??'','default'=>(bool)($a['is_default']??$a['default']??false)]; }
    private function normalizeCustomer(array $c):array { $name=$c['name']??''; $p=preg_split('/\s+/',trim($name),2); return ['name'=>$name,'first_name'=>$c['first_name']??($p[0]??''),'last_name'=>$c['last_name']??($p[1]??''),'phone'=>$c['phone']??$c['mobile']??'','email'=>$c['email']??'']; }
    
    private function normalizeBooking(array $b, bool $detail = false): array
    {
        $bookingId = $b['id'] ?? null;

        $items = $b['booking_items']
            ?? $b['items']
            ?? [];

        $firstItem = $items[0] ?? [];

        $vendor = $b['vendor']
            ?? $b['provider']
            ?? null;

        $serviceNames = collect($items)
            ->pluck('package_name')
            ->filter()
            ->implode(', ');

        $out = array_merge($b, [
            'id' => $bookingId,

            'booking_number' => $b['booking_number']
                ?? ($bookingId ? 'BOOK-' . $bookingId : 'N/A'),

            'status' => $b['status'] ?? 'pending',

            'slot_date' => $b['slot_date'] ?? null,
            'slot_time' => $b['slot_time'] ?? null,

            'address' => $b['address'] ?? 'Address not available',

            'service' => $serviceNames ?: 'Service',

            'category' => $b['category_name']
                ?? 'Home Services',

            'image' => $firstItem['thumbnail_image']
                ?? $firstItem['image']
                ?? null,

            'quantity' => (int) ($firstItem['quantity'] ?? 1),

            'variant_name' => $firstItem['variant_name'] ?? null,

            'selections_summary' =>
                $firstItem['selections_summary'] ?? '',

            'booking_items' => $items,

            'subtotal' => (float) ($b['subtotal'] ?? 0),
            'discount' => (float) ($b['discount'] ?? 0),
            'total' => (float) ($b['total'] ?? 0),

            'vendor' => $vendor,
            'provider' => $vendor,

            'extraWorks' => $b['extraWorks']
                ?? $b['extra_works']
                ?? [],

            'payment_status' => $b['payment_status'] ?? null,
            'payment_method' => $b['payment_method'] ?? null,

            'rating' => $b['rating'] ?? null,

            'reason' => $b['cancellation_reason']
                ?? $b['reason']
                ?? null,

            'customer_name' => $b['name'] ?? 'Customer',
            'phone' => $b['phone_number'] ?? '',
        ]);

        if ($detail) {
            $out['addons'] = $out['extraWorks'];
            $out['timeline'] = $b['timeline'] ?? [];
        }

        return $out;
    }

    private function apiResponse(Request $request,array $response,string $message){ return $request->expectsJson()?response()->json($response):back()->with('success',$message); }

    public function respondExtraWork(
        Request $request,
        int $booking,
        int $extraWork,
        CatalogApiService $api
    ): JsonResponse {
        $validated = $request->validate([
            'status' => ['required', 'in:accepted,rejected'],
        ]);

        if (!session('catalog_auth_token')) {
            return response()->json([
                'status' => false,
                'message' => 'Please login to continue.',
            ], 401);
        }

        try {
            $response = $api->respondExtraWork(
                $booking,
                $extraWork,
                $validated['status']
            );
            // print_r($response);
            return response()->json(
                $response,
                ($response['success'] ?? false) ? 200 : 422
            );

        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'status' => false,
                'message' => 'Unable to update additional service.',
            ], 500);
        }
    }

    /** Create a Razorpay order using the existing CMS booking payment API. */
    public function createBookingPayment(int $booking, CatalogApiService $api)
    {
        if (!session('catalog_auth_token')) {
            return response()->json(['status' => false, 'message' => 'Please login.'], 401);
        }
        try {
            $details = $api->bookingDetails($booking);
            if (!($details['status'] ?? false)) {
                return response()->json(['status' => false, 'message' => $details['message'] ?? 'Booking not found.'], 404);
            }
            $b = data_get($details, 'data.booking') ?? data_get($details, 'data');
            if (!is_array($b) || (int) ($b['id'] ?? 0) !== $booking) {
                return response()->json(['status' => false, 'message' => 'Invalid booking details.'], 422);
            }
            if (strtolower((string) ($b['status'] ?? '')) !== 'completed') {
                return response()->json(['status' => false, 'message' => 'Payment is available after service completion.'], 422);
            }
            if (in_array(strtolower((string) ($b['payment_status'] ?? '')), ['paid', 'captured', 'completed'], true)) {
                return response()->json(['status' => false, 'message' => 'Booking is already paid.'], 422);
            }
            // CMS must independently validate the outstanding amount and booking ownership.
            // amount_due/outstanding_amount must be in rupees, not paise.
            $amount = $b['outstanding_amount'] ?? $b['total'] ?? null;
            if (!is_numeric($amount) || (float) $amount <= 0) {
                return response()->json(['status' => false, 'message' => 'No payable amount found.'], 422);
            }
            $result = $api->createBookingRazorpayOrder($booking, (float) $amount);
            if (!($result['status'] ?? false)) {
                return response()->json(['status' => false, 'message' => $result['message'] ?? 'Unable to create payment order.'], 422);
            }
            $order = $result['data'] ?? [];
            if (empty($order['id']) || empty($order['key']) || !is_numeric($order['amount']) || (int) $order['amount'] <= 0) {
                throw new \RuntimeException('Invalid Razorpay order response.');
            }
            return response()->json([
                'status' => true,
                'message' => 'Razorpay order created.',
                'data' => [
                    'key' => $order['key'],
                    'order_id' => $order['id'],
                    'amount' => (int) $order['amount'],
                    'currency' => $order['currency'] ?? 'INR',
                ],
            ]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['status' => false, 'message' => 'Unable to start payment.'], 500);
        }
    }

    /** Forward the Razorpay callback to the CMS verification API. */
    public function verifyBookingPayment(Request $request, int $booking, CatalogApiService $api)
    {
        $v = $request->validate([
            'razorpay_order_id' => ['required', 'string'],
            'razorpay_payment_id' => ['required', 'string'],
            'razorpay_signature' => ['required', 'string'],
        ]);
        if (!session('catalog_auth_token')) {
            return response()->json(['status' => false, 'message' => 'Please login.'], 401);
        }
        try {
            // CMS must verify signature, captured amount, order association,
            // customer ownership and process duplicate callbacks idempotently.
            $result = $api->verifyBookingRazorpayPayment(
                $v['razorpay_order_id'],
                $v['razorpay_payment_id'],
                $v['razorpay_signature']
            );
            if (!($result['status'] ?? false)) {
                return response()->json(['status' => false, 'message' => $result['message'] ?? 'Verification pending.'], 422);
            }
            return response()->json([
                'status' => true,
                'message' => $result['message'] ?? 'Payment verified.',
                'redirect' => route('booking.success', [
                    'booking_id' => Crypt::encryptString((string) $booking),
                ]),
            ]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['status' => false, 'message' => 'Payment confirmation pending. Check booking status before paying again.'], 500);
        }
    }
}
