@extends('layouts.app')
@section('title', 'My Appointments')
@section('content')
<div class="bg-brown py-10">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
        <div><h1 class="text-2xl md:text-3xl font-bold text-white">My Appointments</h1><p class="text-stone-400 mt-1">Your booking history</p></div>
        <a href="{{ route('client.book') }}" class="btn-gold text-white px-5 py-2.5 rounded-2xl font-semibold text-sm transition hidden sm:inline-flex items-center"><svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>New Booking</a>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 py-8">
    @if($appointments->isEmpty())
        <div class="bg-white rounded-2xl p-12 shadow-sm border border-stone-200 text-center">
            <h3 class="text-lg font-semibold text-brown">No appointments yet</h3>
            <p class="text-stone-500 text-sm mt-1">Start by booking your first appointment!</p>
            <a href="{{ route('client.book') }}" class="inline-block mt-4 btn-gold text-white px-6 py-2.5 rounded-2xl font-semibold text-sm">Browse Salons</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($appointments as $apt)
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-stone-200">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 btn-gold rounded-2xl flex items-center justify-center flex-shrink-0"><span class="text-white font-bold">{{ mb_substr($apt->specialist->user->name, 0, 1) }}</span></div>
                        <div>
                            <h4 class="font-semibold text-brown">{{ $apt->service->name }}</h4>
                            <p class="text-sm text-stone-500">{{ $apt->specialist->user->name }} · {{ $apt->salon->name }}</p>
                            <p class="text-xs text-stone-400 mt-0.5">{{ $apt->appointment_date->format('M d, Y') }} at {{ \Carbon\Carbon::parse($apt->appointment_time)->format('H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        @php $sc = ['confirmed'=>'bg-green-50 text-green-700 border-green-200','completed'=>'bg-blue-50 text-blue-700 border-blue-200','cancelled'=>'bg-red-50 text-red-700 border-red-200']; @endphp
                        <span class="px-3 py-1 text-xs font-semibold rounded-full border {{ $sc[$apt->status] }}">{{ ucfirst($apt->status) }}</span>
                        <span class="text-gold font-bold text-sm">{{ number_format($apt->service->price, 0, '.', ' ') }} ₸</span>
                    </div>
                </div>
                @if($apt->status === 'completed' && !$apt->review)
                <div class="mt-4 pt-4 border-t border-stone-100" x-data="{ showReview: false }">
                    <button @click="showReview = !showReview" class="text-sm text-gold font-semibold hover:underline flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>Leave a Review</button>
                    <div x-show="showReview" x-transition class="mt-3">
                        <form method="POST" action="{{ route('client.review.store', $apt) }}" class="space-y-3">
                            @csrf
                            <div><label class="block text-sm font-medium text-stone-700 mb-1">Rating</label>
                                <div class="flex space-x-1" x-data="{ rating: 0 }">
                                    @for($i=1;$i<=5;$i++)<button type="button" @click="rating = {{ $i }}" class="focus:outline-none"><svg class="w-7 h-7 transition" :class="rating >= {{ $i }} ? 'text-gold' : 'text-stone-200'" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg></button>@endfor
                                    <input type="hidden" name="rating" :value="rating">
                                </div>
                            </div>
                            <div><label class="block text-sm font-medium text-stone-700 mb-1">Comment (optional)</label><textarea name="comment" rows="2" placeholder="Share your experience..." class="w-full px-4 py-2.5 rounded-2xl border border-stone-200 focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none text-sm bg-cream/50 resize-none"></textarea></div>
                            <button type="submit" class="btn-gold text-white px-5 py-2 rounded-2xl text-sm font-semibold transition">Submit Review</button>
                        </form>
                    </div>
                </div>
                @endif
                @if($apt->review)
                <div class="mt-4 pt-4 border-t border-stone-100 flex items-start space-x-2">
                    <div class="flex">@for($i=1;$i<=5;$i++)<svg class="w-4 h-4 {{ $i <= $apt->review->rating ? 'text-gold' : 'text-stone-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor</div>
                    @if($apt->review->comment)<p class="text-sm text-stone-500 italic">"{{ $apt->review->comment }}"</p>@endif
                </div>
                @endif
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
