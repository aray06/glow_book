@extends('layouts.app')
@section('title', 'My Dashboard')
@section('content')
<div class="bg-brown py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-2xl md:text-3xl font-bold text-white">Welcome, {{ auth()->user()->name }}!</h1>
        <p class="text-stone-400 mt-1">Manage your beauty appointments</p>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <h2 class="text-xl font-semibold text-brown">Upcoming Appointments</h2>
        <a href="{{ route('client.book') }}" class="btn-gold text-white px-6 py-2.5 rounded-2xl font-semibold text-sm transition inline-flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Book Now</a>
    </div>
    @if($upcoming->isEmpty())
        <div class="bg-white rounded-2xl p-12 shadow-sm border border-stone-200 text-center">
            <h3 class="text-lg font-semibold text-brown">No upcoming appointments</h3>
            <p class="text-stone-500 text-sm mt-1">Book your first appointment to get started!</p>
            <a href="{{ route('client.book') }}" class="inline-block mt-4 btn-gold text-white px-6 py-2.5 rounded-2xl font-semibold text-sm transition">Browse Salons</a>
        </div>
    @else
        <div class="grid gap-4">
            @foreach($upcoming as $apt)
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-stone-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 btn-gold rounded-2xl flex items-center justify-center flex-shrink-0"><span class="text-white font-bold">{{ mb_substr($apt->specialist->user->name, 0, 1) }}</span></div>
                    <div>
                        <h4 class="font-semibold text-brown">{{ $apt->service->name }}</h4>
                        <p class="text-sm text-stone-500">{{ $apt->specialist->user->name }} · {{ $apt->salon->name }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-sm"><p class="font-medium text-brown">{{ $apt->appointment_date->format('M d, Y') }}</p><p class="text-stone-400">{{ \Carbon\Carbon::parse($apt->appointment_time)->format('H:i') }}</p></div>
                    <span class="px-3 py-1 bg-green-50 text-green-700 text-xs font-semibold rounded-full border border-green-200">Confirmed</span>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    <div class="mt-6 text-center"><a href="{{ route('client.appointments') }}" class="text-gold font-semibold text-sm hover:underline">View All Appointments &rarr;</a></div>
</div>
@endsection
