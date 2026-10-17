@extends('layouts.app')
@section('title','My Wallet')
@section('content')
<div class="mx-auto max-w-5xl px-4 py-10"><h1 class="text-3xl font-bold">My Wallet</h1><div class="mt-6 rounded-2xl bg-white p-6 shadow-sm border"><p class="text-sm text-gray-500">Available balance</p><p class="mt-2 text-4xl font-bold">₹{{ number_format((float)($wallet['balance'] ?? $wallet['wallet_balance'] ?? 0),2) }}</p></div></div>
@endsection
