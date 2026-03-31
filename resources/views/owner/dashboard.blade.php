@extends('layouts.app')
@section('title', 'Salon Dashboard')
@section('content')
<div class="bg-brown py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-2xl md:text-3xl font-bold text-white">{{ $salon->name }}</h1>
        <p class="text-stone-400 mt-1">Salon owner dashboard</p>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200"><p class="text-sm text-stone-500">Today's Bookings</p><p class="text-3xl font-bold text-brown mt-1">{{ $todayBookings }}</p></div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200"><p class="text-sm text-stone-500">Total Revenue</p><p class="text-3xl font-bold text-brown mt-1">{{ number_format($totalRevenue, 0, '.', ' ') }} ₸</p></div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200"><p class="text-sm text-stone-500">Active Specialists</p><p class="text-3xl font-bold text-brown mt-1">{{ $activeSpecialists }}</p></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('owner.specialists') }}" class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200 hover:shadow-md hover:border-gold/30 transition group"><h3 class="font-semibold text-brown group-hover:text-gold transition">Manage Specialists</h3><p class="text-sm text-stone-500 mt-1">Add or remove specialists</p></a>
        <a href="{{ route('owner.services') }}" class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200 hover:shadow-md hover:border-gold/30 transition group"><h3 class="font-semibold text-brown group-hover:text-gold transition">Manage Services</h3><p class="text-sm text-stone-500 mt-1">Add, edit, or remove services</p></a>
        <a href="{{ route('owner.appointments') }}" class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200 hover:shadow-md hover:border-gold/30 transition group"><h3 class="font-semibold text-brown group-hover:text-gold transition">All Appointments</h3><p class="text-sm text-stone-500 mt-1">View salon bookings</p></a>
    </div>
</div>
@endsection
