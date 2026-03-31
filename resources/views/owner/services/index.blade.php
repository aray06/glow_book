@extends('layouts.app')
@section('title', 'Manage Services')
@section('content')
<div class="bg-brown py-10">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
        <div><h1 class="text-2xl md:text-3xl font-bold text-white">Services — {{ $salon->name }}</h1><p class="text-stone-400 mt-1">Manage your salon's services</p></div>
        <a href="{{ route('owner.services.create') }}" class="btn-gold text-white px-5 py-2.5 rounded-2xl font-semibold text-sm transition inline-flex items-center"><svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Add Service</a>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($services as $service)
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200">
            <div class="flex items-center justify-between mb-3"><span class="px-3 py-1 bg-gold/10 text-gold text-xs font-medium rounded-full">{{ $service->category }}</span><span class="text-gold font-bold text-lg">{{ number_format($service->price, 0, '.', ' ') }} ₸</span></div>
            <h3 class="text-lg font-semibold text-brown">{{ $service->name }}</h3>
            <p class="text-stone-500 text-sm mt-2">{{ Str::limit($service->description, 80) }}</p>
            <p class="text-xs text-stone-400 mt-2">{{ $service->duration_minutes }} min</p>
            <div class="flex items-center space-x-2 mt-4 pt-3 border-t border-stone-100">
                <a href="{{ route('owner.services.edit', $service) }}" class="flex-1 text-center py-2 bg-cream text-stone-700 text-sm font-medium rounded-xl hover:bg-stone-100 transition">Edit</a>
                <form method="POST" action="{{ route('owner.services.destroy', $service) }}" class="flex-1" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="w-full py-2 bg-red-50 text-red-600 text-sm font-medium rounded-xl hover:bg-red-100 transition">Delete</button></form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
