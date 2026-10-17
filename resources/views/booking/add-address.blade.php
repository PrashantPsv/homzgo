@extends('layouts.app')
@section('title','Add Address | HomZgo')
@section('content')
<div class="mx-auto max-w-4xl px-4 py-10"><div class="mb-6"><a href="{{ route('booking.address') }}" class="text-sm text-indigo-600">← Back to addresses</a><h1 class="mt-3 text-3xl font-bold">Add new address</h1></div>@if(session('error'))<div class="mb-4 rounded-xl bg-red-50 p-4 text-sm text-red-700">{{ session('error') }}</div>@endif
<form method="POST" action="{{ route('booking.add-address.store') }}" class="rounded-2xl border bg-white p-6 shadow-sm">@csrf
<div class="grid gap-5 sm:grid-cols-2">
<div><label class="text-sm font-semibold">Address type</label><select name="type" class="mt-2 w-full rounded-xl border px-4 py-3"><option value="home">Home</option><option value="work">Work</option><option value="other">Other</option></select></div>
<div><label class="text-sm font-semibold">Pincode</label><input name="pincode" value="{{ old('pincode', config('services.catalog.pincode')) }}" class="mt-2 w-full rounded-xl border px-4 py-3"></div>
<div class="sm:col-span-2"><label class="text-sm font-semibold">Address</label><textarea name="address" required rows="3" class="mt-2 w-full rounded-xl border px-4 py-3">{{ old('address') }}</textarea></div>
<div><label class="text-sm font-semibold">Landmark</label><input name="landmark" value="{{ old('landmark') }}" class="mt-2 w-full rounded-xl border px-4 py-3"></div>
<div><label class="text-sm font-semibold">Floor</label><input name="floor" value="{{ old('floor') }}" class="mt-2 w-full rounded-xl border px-4 py-3"></div>
<div><label class="text-sm font-semibold">City</label><input name="city" value="{{ old('city') }}" class="mt-2 w-full rounded-xl border px-4 py-3"></div>
<div><label class="text-sm font-semibold">State</label><input name="state" value="{{ old('state') }}" class="mt-2 w-full rounded-xl border px-4 py-3"></div>
<div class="sm:col-span-2"><label class="text-sm font-semibold">Delivery instructions</label><textarea name="instructions" rows="2" class="mt-2 w-full rounded-xl border px-4 py-3">{{ old('instructions') }}</textarea></div>
<div class="sm:col-span-2"><label class="inline-flex items-center gap-2 text-sm"><input type="checkbox" name="is_default" value="1" class="rounded" {{ old('is_default',true) ? 'checked' : '' }}> Make this my default address</label></div>
</div>
<div class="mt-6 flex justify-end"><button class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white">Save Address</button></div>
</form></div>
@endsection
