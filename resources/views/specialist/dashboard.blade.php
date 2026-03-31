@extends('layouts.app')
@section('title', 'Specialist Dashboard')
@section('content')
<div class="bg-brown py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-2xl md:text-3xl font-bold text-white">Welcome, {{ auth()->user()->name }}!</h1>
        <p class="text-stone-400 mt-1">Manage your appointments and schedule</p>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-xl font-semibold text-brown mb-4">Today's Schedule — {{ now()->format('M d, Y') }}</h2>
    @if($todayAppointments->isEmpty())
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-stone-200 text-center mb-10"><p class="text-stone-500">No appointments scheduled for today.</p></div>
    @else
        <div class="grid gap-3 mb-10">
            @foreach($todayAppointments as $apt)
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-stone-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div class="text-center bg-cream rounded-2xl px-3 py-2 min-w-[60px]"><p class="text-lg font-bold text-brown">{{ \Carbon\Carbon::parse($apt->appointment_time)->format('H:i') }}</p></div>
                    <div><h4 class="font-semibold text-brown">{{ $apt->service->name }}</h4><p class="text-sm text-stone-500">Client: {{ $apt->client->name }}</p>@if($apt->notes)<p class="text-xs text-stone-400 mt-0.5">{{ $apt->notes }}</p>@endif</div>
                </div>
                <div class="flex items-center space-x-2">
                    @php $sc = ['confirmed'=>'bg-green-50 text-green-700 border-green-200','completed'=>'bg-blue-50 text-blue-700 border-blue-200','cancelled'=>'bg-red-50 text-red-700 border-red-200']; @endphp
                    <span class="px-3 py-1 text-xs font-semibold rounded-full border {{ $sc[$apt->status] }}">{{ ucfirst($apt->status) }}</span>
                    @if($apt->status === 'confirmed')
                    <form method="POST" action="{{ route('specialist.appointments.status', $apt) }}" class="inline">@csrf @method('PATCH')<input type="hidden" name="status" value="completed"><button class="px-3 py-1.5 bg-blue-500 text-white text-xs font-semibold rounded-full hover:bg-blue-600 transition">Complete</button></form>
                    <form method="POST" action="{{ route('specialist.appointments.status', $apt) }}" class="inline">@csrf @method('PATCH')<input type="hidden" name="status" value="cancelled"><button class="px-3 py-1.5 bg-red-100 text-red-600 text-xs font-semibold rounded-full hover:bg-red-200 transition">Cancel</button></form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    @endif

    <h2 class="text-xl font-semibold text-brown mb-4">All Appointments</h2>
    @if($allAppointments->isEmpty())
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-stone-200 text-center"><p class="text-stone-500">No appointments yet.</p></div>
    @else
        <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-cream border-b border-stone-200"><tr>
                        <th class="text-left px-5 py-3 font-semibold text-stone-600">Date & Time</th>
                        <th class="text-left px-5 py-3 font-semibold text-stone-600">Service</th>
                        <th class="text-left px-5 py-3 font-semibold text-stone-600">Client</th>
                        <th class="text-left px-5 py-3 font-semibold text-stone-600">Status</th>
                        <th class="text-left px-5 py-3 font-semibold text-stone-600">Actions</th>
                    </tr></thead>
                    <tbody class="divide-y divide-stone-50">
                        @foreach($allAppointments as $apt)
                        <tr class="hover:bg-cream/50">
                            <td class="px-5 py-3"><p class="font-medium text-brown">{{ $apt->appointment_date->format('M d, Y') }}</p><p class="text-xs text-stone-400">{{ \Carbon\Carbon::parse($apt->appointment_time)->format('H:i') }}</p></td>
                            <td class="px-5 py-3 text-stone-700">{{ $apt->service->name }}</td>
                            <td class="px-5 py-3 text-stone-700">{{ $apt->client->name }}</td>
                            <td class="px-5 py-3">@php $s=['confirmed'=>'bg-green-50 text-green-700 border-green-200','completed'=>'bg-blue-50 text-blue-700 border-blue-200','cancelled'=>'bg-red-50 text-red-700 border-red-200']; @endphp<span class="px-2.5 py-0.5 text-xs font-semibold rounded-full border {{ $s[$apt->status] }}">{{ ucfirst($apt->status) }}</span></td>
                            <td class="px-5 py-3"><div class="flex items-center space-x-1">
                                @if($apt->status === 'confirmed')
                                <form method="POST" action="{{ route('specialist.appointments.status', $apt) }}" class="inline">@csrf @method('PATCH')<input type="hidden" name="status" value="completed"><button class="px-2 py-1 bg-blue-500 text-white text-xs rounded-lg hover:bg-blue-600">Complete</button></form>
                                <form method="POST" action="{{ route('specialist.appointments.status', $apt) }}" class="inline">@csrf @method('PATCH')<input type="hidden" name="status" value="cancelled"><button class="px-2 py-1 bg-red-100 text-red-600 text-xs rounded-lg hover:bg-red-200">Cancel</button></form>
                                @endif
                            </div></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
