<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/location', [LocationController::class, 'update'])->name('location.update');
Route::get('/location', [LocationController::class, 'current'])->name('location.current');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->whereNumber('service')->name('services.show');
Route::get('/categories/{category}/sub-categories', [HomeController::class, 'categorySubCategories'])->name('frontend.categories.sub-categories');
Route::get('/sub-categories/{subcategory}/services', [HomeController::class, 'services'])->name('subcategories.services');
Route::get('/service-collections/{collection}/package-groups', [HomeController::class, 'packageGroups'])->name('service-collections.package-groups');
Route::get('/packages/{package}/details', [HomeController::class, 'details'])->name('packages.details');

Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('/cart/items', [CartController::class, 'store'])->name('cart.items.store');
Route::put('/cart/items/{item}', [CartController::class, 'update'])->name('cart.items.update');
Route::delete('/cart/items/{item}', [CartController::class, 'destroy'])->name('cart.items.destroy');
Route::get('/cart/addresses', [AddressController::class, 'index'])->middleware('auth')->name('cart.addresses');
Route::get('/cart/count', [CartController::class, 'cartCount'])->name('cart.count');

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send-otp');
    Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend-otp');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify-otp');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/addresses', [ProfileController::class, 'addresses'])->name('profile.addresses');
    Route::get('/profile/addresses/add', [ProfileController::class, 'addressAdd'])->name('profile.addresses.add');
    Route::post('/profile/addresses', [AddressController::class, 'store'])->name('profile.addresses.store');
    Route::get('/profile/addresses/{address}/edit', [ProfileController::class, 'addressEdit'])->name('profile.addresses.edit');
    Route::put('/profile/addresses/{address}', [AddressController::class, 'update'])->name('profile.addresses.update');
    Route::delete('/profile/addresses/{address}', [AddressController::class, 'destroy'])->name('profile.addresses.delete');
    Route::post('/profile/addresses/{address}/default', [AddressController::class, 'makeDefault'])->name('profile.addresses.default');

    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('/bookings/{booking}/review', [BookingController::class, 'review'])->name('bookings.review');
    Route::get('/bookings/{booking}/payment', [BookingController::class, 'payment'])->name('bookings.payment');
    Route::post('/bookings/{booking}/pay', [BookingController::class, 'pay'])->name('bookings.pay');

    Route::get('/booking/address', [BookingController::class, 'address'])->name('booking.address');
    Route::post('/booking/address', [BookingController::class, 'selectAddress'])->name('booking.address.select');
    Route::get('/booking/add-address', [BookingController::class, 'addAddress'])->name('booking.add-address');
    Route::post('/booking/add-address', [BookingController::class, 'createAddress'])->name('booking.add-address.store');
    Route::get('/booking/date-time', [BookingController::class, 'dateTime'])->name('booking.date-time');
    Route::post('/booking/date-time', [BookingController::class, 'selectDateTime'])->name('booking.date-time.select');
    Route::get('/booking/slots', [BookingController::class, 'slots'])->name('booking.slots');
    Route::get('/booking/add-ons', [BookingController::class, 'addOns'])->name('booking.add-ons');
    Route::post('/booking/add-ons/select', [BookingController::class, 'selectAddons'])->name('booking.add-ons.select');
    Route::get('/booking/summary', [BookingController::class, 'bookingSummary'])->name('booking.summary');
    Route::get('/booking/customer-details', [BookingController::class, 'customerDetails'])->name('booking.customer-details');
    Route::get('/booking/success', [BookingController::class, 'bookingSuccess'])->name('booking.success');
    Route::post('/booking/{booking}/extra-work/{extraWork}/respond', [BookingController::class, 'respondExtraWork'])->name('booking.extra-work.respond');
    Route::post('/booking/{booking}/razorpay/create', [BookingController::class, 'createBookingPayment'])->name('booking.razorpay.create');
    Route::post('/booking/{booking}/razorpay/verify', [BookingController::class, 'verifyBookingPayment'])->name('booking.razorpay.verify');

    Route::post('/payment/create-order', [PaymentController::class, 'createOrder'])->name('payment.create');
    Route::post('/payment/verify', [PaymentController::class, 'verifyPayment'])->name('payment.verify');
    Route::post('/cart/place-order', [PaymentController::class, 'placeOrder'])->name('cart.place-order');

    Route::get('/wallet', [ProfileController::class, 'wallet'])->name('wallet');
    Route::get('/invoices', [ProfileController::class, 'invoices'])->name('invoices');
    Route::get('/refunds', [ProfileController::class, 'refunds'])->name('refunds');
    Route::get('/notifications', [ProfileController::class, 'notifications'])->name('notifications');
});

Route::get('/login', fn () => view('auth.login'))->name('login');
Route::get('/register', fn () => view('auth.login'))->name('register');
Route::get('/forgot-password', fn () => view('auth.login'))->name('password.request');
Route::get('/verify-otp', fn () => view('auth.login'))->name('auth.verify-otp');
Route::get('/reset-password', fn () => view('auth.login'))->name('password.reset');

Route::get('/help', fn () => view('support.index', ['categories'=>[], 'faqs'=>[], 'tickets'=>[]]))->name('support.index');
Route::get('/help/contact', fn () => view('support.contact'))->name('support.contact');
Route::get('/help/ticket/{ticket}', fn ($ticket) => view('support.ticket', ['ticketId'=>$ticket]))->name('support.ticket');
