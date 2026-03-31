@extends('layouts.app')
@section('title', $salon->name)
@section('content')
<div class="bg-brown py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold text-white">{{ $salon->name }}</h1>
        <p class="text-stone-400 mt-2 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>{{ $salon->address }}</p>
        <div class="flex items-center space-x-1 mt-3">
            @for($i = 1; $i <= 5; $i++)
                <svg class="w-5 h-5 {{ $i <= round($salon->averageRating()) ? 'text-gold' : 'text-stone-600' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            @endfor
            <span class="ml-2 text-stone-400 text-sm">{{ number_format($salon->averageRating(), 1) }}</span>
        </div>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="bg-white rounded-2xl p-6 border border-stone-200 shadow-sm mb-10">
        <h2 class="text-lg font-semibold text-brown mb-2">About</h2>
        <p class="text-stone-600 text-sm leading-relaxed">{{ $salon->description }}</p>
        @if($salon->phone)<p class="text-sm text-stone-500 mt-2">Phone: {{ $salon->phone }}</p>@endif
    </div>

    <h2 class="text-2xl font-bold text-brown mb-6">Services</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-10">
        @foreach($salon->services as $service)
        <div class="bg-white rounded-2xl p-5 border border-stone-200 shadow-sm">
            <div class="flex justify-between items-start mb-2">
                <span class="px-2.5 py-0.5 bg-gold/10 text-gold text-xs font-medium rounded-full">{{ $service->category }}</span>
                <span class="text-gold font-bold">{{ number_format($service->price, 0, '.', ' ') }} ₸</span>
            </div>
            <h3 class="font-semibold text-brown">{{ $service->name }}</h3>
            <p class="text-stone-500 text-sm mt-1">{{ $service->description }}</p>
            <div class="flex justify-between items-center mt-3 pt-2 border-t border-stone-100">
                <span class="text-xs text-stone-400">{{ $service->duration_minutes }} min</span>
                @auth<a href="{{ route('client.book', ['salon_id' => $salon->id, 'service_id' => $service->id]) }}" class="text-gold text-sm font-semibold hover:underline">Book &rarr;</a>@else<a href="{{ route('login') }}" class="text-gold text-sm font-semibold hover:underline">Book &rarr;</a>@endauth
            </div>
        </div>
        @endforeach
    </div>

    <h2 class="text-2xl font-bold text-brown mb-6">Specialists</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        @foreach($salon->specialists as $specialist)
        <div class="bg-white rounded-2xl p-6 border border-stone-200 shadow-sm text-center">
            <div class="w-16 h-16 btn-gold rounded-full flex items-center justify-center mx-auto mb-3"><span class="text-white text-xl font-bold">{{ mb_substr($specialist->user->name, 0, 1) }}</span></div>
            <h3 class="font-semibold text-brown">{{ $specialist->user->name }}</h3>
            <div class="flex items-center justify-center mt-1">
                @for($i=1;$i<=5;$i++)<svg class="w-4 h-4 {{ $i <= round($specialist->rating) ? 'text-gold' : 'text-stone-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                <span class="ml-1 text-xs text-stone-400">{{ number_format($specialist->rating, 1) }}</span>
            </div>
            <p class="text-stone-500 text-xs mt-2">{{ $specialist->experience_years }} yrs experience</p>
            <p class="text-stone-500 text-sm mt-2">{{ Str::limit($specialist->bio, 80) }}</p>
            <div class="flex flex-wrap justify-center gap-1 mt-3">
                @foreach($specialist->services as $s)<span class="text-xs bg-cream text-brown px-2 py-0.5 rounded-full border border-stone-200">{{ $s->name }}</span>@endforeach
            </div>
        </div>
        @endforeach
    </div>

    @if($reviews->count())
    <h2 class="text-2xl font-bold text-brown mb-6">Recent Reviews</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($reviews as $review)
        <div class="bg-white rounded-2xl p-5 border border-stone-200 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <span class="font-medium text-brown text-sm">{{ $review->client->name }}</span>
                <div class="flex">@for($i=1;$i<=5;$i++)<svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-gold' : 'text-stone-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor</div>
            </div>
            <p class="text-sm text-stone-500 italic">"{{ $review->comment }}"</p>
            <p class="text-xs text-stone-400 mt-2">about {{ $review->specialist->user->name }}</p>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
