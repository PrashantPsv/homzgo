@extends('layouts.app')
@section('title','Select Address | HomZgo')
@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="border-b bg-white"><div class="mx-auto max-w-6xl px-4 py-6"><p class="text-sm font-semibold text-indigo-600">Booking · Step 1 of 6</p><h1 class="mt-1 text-2xl font-bold">Select service address</h1></div></div>
    <div class="mx-auto max-w-6xl px-4 py-8"><div class="grid gap-8 lg:grid-cols-3">
        <div class="lg:col-span-2">
            @if(session('success'))<div class="mb-4 rounded-xl bg-green-50 p-4 text-sm text-green-700">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="mb-4 rounded-xl bg-red-50 p-4 text-sm text-red-700">{{ session('error') }}</div>@endif
            <form method="POST" action="{{ route('booking.address.select') }}">@csrf
                <div class="space-y-4">
                @forelse($addresses as $index => $address)
                    <label class="block cursor-pointer rounded-2xl border bg-white p-5 shadow-sm hover:border-indigo-300"><div class="flex gap-4"><input type="radio" name="address_id" value="{{ $address['id'] }}" class="mt-1 h-4 w-4 text-indigo-600" {{ (string)session('booking.address_id') === (string)$address['id'] || (!session('booking.address_id') && $address['default']) ? 'checked' : '' }}><div class="flex-1"><div class="flex items-center justify-between gap-3"><div><span class="font-semibold">{{ $address['type'] }}</span>@if($address['default'])<span class="ml-2 rounded-full bg-indigo-50 px-2 py-1 text-xs font-semibold text-indigo-700">Default</span>@endif</div>@if($address['id'])<a href="{{ route('profile.addresses.edit',['address'=>$address['id']]) }}" class="text-sm font-semibold text-indigo-600">Edit</a>@endif</div><p class="mt-2 text-sm font-medium text-gray-800">{{ $address['name'] }}</p><p class="mt-1 text-sm leading-6 text-gray-500">{{ $address['address'] }}<br>{{ $address['area'] }}</p><p class="mt-2 text-sm text-gray-500">{{ $address['phone'] }}</p></div></div></label>
                @empty
                    <div class="rounded-2xl border border-dashed bg-white p-10 text-center text-gray-500">No saved address found. Add one to continue.</div>
                @endforelse
                </div>
                <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:justify-between"><a href="{{ route('booking.add-address') }}" class="rounded-xl border bg-white px-5 py-3 text-center text-sm font-semibold">+ Add new address</a><button class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white">Continue</button></div>
            </form>
        </div>
        <aside class="rounded-2xl border bg-white p-6 shadow-sm h-fit"><p class="text-xs font-semibold uppercase tracking-wide text-indigo-600">Service</p><h2 class="mt-2 text-xl font-bold">{{ $service['name'] }}</h2><p class="mt-1 text-sm text-gray-500">{{ $service['category'] }} · {{ $service['duration'] ?: 'Duration varies' }}</p><div class="mt-5 border-t pt-5"><span class="text-sm text-gray-500">Starting at</span><p class="text-2xl font-bold">₹{{ number_format((float)$service['price'],2) }}</p></div></aside>
    </div></div>
</div>
@endsection
