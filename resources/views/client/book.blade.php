@extends('layouts.app')
@section('title', 'Book Appointment')
@section('content')
<div class="bg-brown py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-2xl md:text-3xl font-bold text-white">Book an Appointment</h1>
        <p class="text-stone-400 mt-1">Choose your salon, service, specialist, and time</p>
    </div>
</div>
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 p-6 md:p-8">
        <div class="flex items-center justify-center mb-8 space-x-2 md:space-x-4">
            <div class="flex items-center space-x-2"><div class="w-8 h-8 rounded-full {{ $selectedSalon ? 'bg-green-500 text-white' : 'btn-gold text-white' }} flex items-center justify-center text-sm font-semibold">1</div><span class="text-sm font-medium text-stone-700 hidden sm:inline">Salon</span></div>
            <div class="w-8 md:w-12 h-px bg-stone-200"></div>
            <div class="flex items-center space-x-2"><div class="w-8 h-8 rounded-full {{ $selectedService ? 'bg-green-500 text-white' : ($selectedSalon ? 'btn-gold text-white' : 'bg-stone-100 text-stone-400') }} flex items-center justify-center text-sm font-semibold">2</div><span class="text-sm font-medium text-stone-700 hidden sm:inline">Service</span></div>
            <div class="w-8 md:w-12 h-px bg-stone-200"></div>
            <div class="flex items-center space-x-2"><div class="w-8 h-8 rounded-full {{ $selectedSpecialist ? 'bg-green-500 text-white' : ($selectedService ? 'btn-gold text-white' : 'bg-stone-100 text-stone-400') }} flex items-center justify-center text-sm font-semibold">3</div><span class="text-sm font-medium text-stone-700 hidden sm:inline">Specialist</span></div>
            <div class="w-8 md:w-12 h-px bg-stone-200"></div>
            <div class="flex items-center space-x-2"><div class="w-8 h-8 rounded-full {{ $selectedDate && $selectedSpecialist ? 'btn-gold text-white' : 'bg-stone-100 text-stone-400' }} flex items-center justify-center text-sm font-semibold">4</div><span class="text-sm font-medium text-stone-700 hidden sm:inline">Date/Time</span></div>
        </div>

        @if(!$selectedSalon)
            <h2 class="text-lg font-semibold text-brown mb-4">Select a Salon</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($salons as $salon)
                <a href="{{ route('client.book', ['salon_id' => $salon->id]) }}" class="p-4 rounded-2xl border border-stone-200 hover:border-gold hover:bg-cream transition group">
                    <h3 class="font-medium text-brown group-hover:text-gold transition">{{ $salon->name }}</h3>
                    <p class="text-xs text-stone-400 mt-0.5">{{ $salon->address }}</p>
                </a>
                @endforeach
            </div>
        @else
            <div class="mb-6 p-4 bg-cream rounded-2xl flex items-center justify-between">
                <div><p class="text-xs text-stone-500 uppercase tracking-wider font-medium">Salon</p><p class="font-semibold text-brown">{{ $selectedSalon->name }}</p></div>
                <a href="{{ route('client.book') }}" class="text-sm text-gold hover:underline font-medium">Change</a>
            </div>

            @if(!$selectedService)
                <h2 class="text-lg font-semibold text-brown mb-4">Select a Service</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($services as $svc)
                    <a href="{{ route('client.book', ['salon_id' => $selectedSalon->id, 'service_id' => $svc->id]) }}" class="p-4 rounded-2xl border border-stone-200 hover:border-gold hover:bg-cream transition flex items-center justify-between group">
                        <div><h3 class="font-medium text-brown group-hover:text-gold transition">{{ $svc->name }}</h3><p class="text-xs text-stone-400 mt-0.5">{{ $svc->duration_minutes }} min · {{ $svc->category }}</p></div>
                        <span class="text-gold font-bold">{{ number_format($svc->price, 0, '.', ' ') }} ₸</span>
                    </a>
                    @endforeach
                </div>
            @else
                <div class="mb-6 p-4 bg-cream rounded-2xl flex items-center justify-between">
                    <div><p class="text-xs text-stone-500 uppercase tracking-wider font-medium">Service</p><p class="font-semibold text-brown">{{ $selectedService->name }} — {{ number_format($selectedService->price, 0, '.', ' ') }} ₸</p></div>
                    <a href="{{ route('client.book', ['salon_id' => $selectedSalon->id]) }}" class="text-sm text-gold hover:underline font-medium">Change</a>
                </div>

                @if(!$selectedSpecialist)
                    <h2 class="text-lg font-semibold text-brown mb-4">Choose a Specialist</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($specialists as $spec)
                        <a href="{{ route('client.book', ['salon_id' => $selectedSalon->id, 'service_id' => $selectedService->id, 'specialist_id' => $spec->id]) }}" class="p-4 rounded-2xl border border-stone-200 hover:border-gold hover:bg-cream transition flex items-center space-x-3 group">
                            <div class="w-10 h-10 btn-gold rounded-full flex items-center justify-center flex-shrink-0"><span class="text-white font-semibold text-sm">{{ mb_substr($spec->user->name, 0, 1) }}</span></div>
                            <div>
                                <h3 class="font-medium text-brown group-hover:text-gold transition">{{ $spec->user->name }}</h3>
                                <div class="flex items-center mt-0.5">@for($i=1;$i<=5;$i++)<svg class="w-3 h-3 {{ $i <= round($spec->rating) ? 'text-gold' : 'text-stone-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor<span class="ml-1 text-xs text-stone-400">{{ number_format($spec->rating, 1) }}</span></div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                @else
                    <div class="mb-6 p-4 bg-cream rounded-2xl flex items-center justify-between">
                        <div><p class="text-xs text-stone-500 uppercase tracking-wider font-medium">Specialist</p><p class="font-semibold text-brown">{{ $selectedSpecialist->user->name }}</p></div>
                        <a href="{{ route('client.book', ['salon_id' => $selectedSalon->id, 'service_id' => $selectedService->id]) }}" class="text-sm text-gold hover:underline font-medium">Change</a>
                    </div>

                    @if(!$selectedDate)
                        <h2 class="text-lg font-semibold text-brown mb-4">Pick a Date</h2>
                        <form method="GET" action="{{ route('client.book') }}" class="flex flex-col sm:flex-row gap-3">
                            <input type="hidden" name="salon_id" value="{{ $selectedSalon->id }}">
                            <input type="hidden" name="service_id" value="{{ $selectedService->id }}">
                            <input type="hidden" name="specialist_id" value="{{ $selectedSpecialist->id }}">
                            <input type="date" name="date" min="{{ date('Y-m-d') }}" required class="flex-1 px-4 py-3 rounded-2xl border border-stone-200 focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none text-sm bg-cream/50">
                            <button type="submit" class="btn-gold text-white px-6 py-3 rounded-2xl font-semibold text-sm transition">Check Availability</button>
                        </form>
                    @else
                        <div class="mb-6 p-4 bg-cream rounded-2xl flex items-center justify-between">
                            <div><p class="text-xs text-stone-500 uppercase tracking-wider font-medium">Date</p><p class="font-semibold text-brown">{{ \Carbon\Carbon::parse($selectedDate)->format('l, M d, Y') }}</p></div>
                            <a href="{{ route('client.book', ['salon_id' => $selectedSalon->id, 'service_id' => $selectedService->id, 'specialist_id' => $selectedSpecialist->id]) }}" class="text-sm text-gold hover:underline font-medium">Change</a>
                        </div>
                        <h2 class="text-lg font-semibold text-brown mb-4">Select a Time Slot</h2>
                        @if(count($availableSlots) === 0)
                            <div class="text-center py-8"><p class="text-stone-500">No available slots for this date.</p><a href="{{ route('client.book', ['salon_id' => $selectedSalon->id, 'service_id' => $selectedService->id, 'specialist_id' => $selectedSpecialist->id]) }}" class="text-gold font-semibold text-sm hover:underline mt-2 inline-block">Try another date</a></div>
                        @else
                            <form method="POST" action="{{ route('client.book.store') }}">
                                @csrf
                                <input type="hidden" name="salon_id" value="{{ $selectedSalon->id }}">
                                <input type="hidden" name="service_id" value="{{ $selectedService->id }}">
                                <input type="hidden" name="specialist_id" value="{{ $selectedSpecialist->id }}">
                                <input type="hidden" name="appointment_date" value="{{ $selectedDate }}">
                                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-2 mb-6">
                                    @foreach($availableSlots as $slot)
                                    <label class="relative cursor-pointer"><input type="radio" name="appointment_time" value="{{ $slot }}" class="peer sr-only" required><div class="text-center py-2.5 px-2 rounded-2xl border border-stone-200 text-sm font-medium text-stone-600 peer-checked:border-gold peer-checked:bg-gold/10 peer-checked:text-gold hover:border-gold/50 transition">{{ $slot }}</div></label>
                                    @endforeach
                                </div>
                                <div class="mb-6"><label class="block text-sm font-medium text-stone-700 mb-1">Notes (optional)</label><textarea name="notes" rows="2" placeholder="Any special requests..." class="w-full px-4 py-3 rounded-2xl border border-stone-200 focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none text-sm bg-cream/50 resize-none"></textarea></div>
                                <button type="submit" class="w-full btn-gold text-white py-3.5 rounded-2xl font-semibold transition">Confirm Booking</button>
                            </form>
                        @endif
                    @endif
                @endif
            @endif
        @endif
    </div>
</div>
@endsection
