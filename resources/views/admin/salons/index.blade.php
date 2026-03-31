@extends('layouts.app')
@section('title', 'Manage Salons')
@section('content')
<div class="bg-brown py-10">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
        <div><h1 class="text-2xl md:text-3xl font-bold text-white">Manage Salons</h1><p class="text-stone-400 mt-1">Create and manage beauty salons</p></div>
        <a href="{{ route('admin.salons.create') }}" class="btn-gold text-white px-5 py-2.5 rounded-2xl font-semibold text-sm transition inline-flex items-center"><svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Add Salon</a>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($salons as $salon)
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200">
            <h3 class="text-lg font-semibold text-brown">{{ $salon->name }}</h3>
            <p class="text-sm text-stone-500 mt-1">{{ $salon->address }}</p>
            <p class="text-sm text-stone-400 mt-1">Owner: {{ $salon->owner->name }}</p>
            <div class="flex items-center space-x-4 mt-3 text-xs text-stone-400"><span>{{ $salon->specialists->count() }} specialists</span><span>{{ $salon->services->count() }} services</span></div>
            <div class="flex items-center space-x-2 mt-4 pt-3 border-t border-stone-100">
                <a href="{{ route('admin.salons.edit', $salon) }}" class="flex-1 text-center py-2 bg-cream text-stone-700 text-sm font-medium rounded-xl hover:bg-stone-100 transition">Edit</a>
                <form method="POST" action="{{ route('admin.salons.destroy', $salon) }}" class="flex-1" onsubmit="return confirm('Delete this salon?')">@csrf @method('DELETE')<button class="w-full py-2 bg-red-50 text-red-600 text-sm font-medium rounded-xl hover:bg-red-100 transition">Delete</button></form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
