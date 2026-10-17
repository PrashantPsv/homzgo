@extends('layouts.app')
@section('title','Notifications')
@section('content')
<div class="mx-auto max-w-5xl px-4 py-10"><h1 class="text-3xl font-bold">Notifications</h1><div class="mt-6 overflow-hidden rounded-2xl border bg-white"><div class="divide-y">@forelse($notifications as $n)<div class="p-5"><div class="flex items-start justify-between gap-4"><div><p class="font-semibold">{{ $n['title'] ?? 'Notification' }}</p><p class="mt-1 text-sm text-gray-600">{{ $n['message'] ?? $n['body'] ?? '' }}</p><p class="mt-2 text-xs text-gray-400">{{ $n['created_at'] ?? '' }}</p></div>@if(empty($n['read_at']) && empty($n['is_read']))<span class="h-2 w-2 rounded-full bg-indigo-600"></span>@endif</div></div>@empty<div class="p-10 text-center text-gray-500">No notifications.</div>@endforelse</div></div></div>
@endsection
