@extends('layouts.app')
@section('title','Invoices')
@section('content')
<div class="mx-auto max-w-6xl px-4 py-10"><h1 class="text-3xl font-bold">Invoices</h1><div class="mt-6 overflow-hidden rounded-2xl border bg-white"><div class="divide-y">@forelse($invoices as $invoice)<div class="flex items-center justify-between p-5"><div><p class="font-semibold">{{ $invoice['invoice_number'] ?? $invoice['number'] ?? ('Invoice #'.($invoice['id']??'')) }}</p><p class="text-sm text-gray-500">{{ $invoice['created_at'] ?? '' }}</p></div><p class="font-bold">₹{{ number_format((float)($invoice['total'] ?? $invoice['amount'] ?? 0),2) }}</p></div>@empty<div class="p-10 text-center text-gray-500">No invoices found.</div>@endforelse</div></div></div>
@endsection
