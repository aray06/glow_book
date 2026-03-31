@extends('layouts.app')
@section('title', 'Our Salons')
@section('content')
<div class="bg-brown py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-white">Our Salons</h1>
        <p class="text-stone-400 mt-2">Discover beauty salons across Kazakhstan</p>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($salons as $salon)
        <a href="{{ route('salons.show', $salon) }}" class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200 hover:shadow-md hover:border-gold/30 transition-all group">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-brown group-hover:text-gold transition">{{ $salon->name }}</h3>
                    <p class="text-sm text-stone-500 mt-1 flex items-center"><svg class="w-4 h-4 mr-1 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>{{ $salon->address }}</p>
                    @if($salon->phone)<p class="text-sm text-stone-400 mt-1">{{ $salon->phone }}</p>@endif
                </div>
                <div class="flex items-center space-x-1 bg-cream px-2.5 py-1 rounded-full"><svg class="w-4 h-4 text-gold" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg><span class="text-sm font-semibold text-brown">{{ number_format($salon->averageRating(), 1) }}</span></div>
            </div>
            <p class="text-stone-500 text-sm mt-3">{{ $salon->description }}</p>
            <div class="flex items-center space-x-4 mt-4 pt-3 border-t border-stone-100 text-xs text-stone-400">
                <span>{{ $salon->specialists->count() }} specialists</span>
                <span>{{ $salon->services->count() }} services</span>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
