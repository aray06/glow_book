@extends('layouts.app')
@section('title', 'Manage Specialists')
@section('content')
<div class="bg-brown py-10">
    <div class="max-w-7xl mx-auto px-4"><h1 class="text-2xl md:text-3xl font-bold text-white">Specialists — {{ $salon->name }}</h1><p class="text-stone-400 mt-1">Manage your salon's team</p></div>
</div>
<div class="max-w-7xl mx-auto px-4 py-8">
    @if($availableUsers->count())
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200 mb-8">
        <h2 class="text-lg font-semibold text-brown mb-4">Add a Specialist</h2>
        <form method="POST" action="{{ route('owner.specialists.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            @csrf
            <div><label class="block text-sm font-medium text-stone-700 mb-1">User</label><select name="user_id" required class="w-full px-4 py-2.5 rounded-2xl border border-stone-200 text-sm bg-cream/50 focus:border-gold outline-none">@foreach($availableUsers as $u)<option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>@endforeach</select></div>
            <div><label class="block text-sm font-medium text-stone-700 mb-1">Experience (years)</label><input type="number" name="experience_years" required min="0" value="0" class="w-full px-4 py-2.5 rounded-2xl border border-stone-200 text-sm bg-cream/50 focus:border-gold outline-none"></div>
            <div><label class="block text-sm font-medium text-stone-700 mb-1">Bio</label><input type="text" name="bio" class="w-full px-4 py-2.5 rounded-2xl border border-stone-200 text-sm bg-cream/50 focus:border-gold outline-none" placeholder="Short bio..."></div>
            <button type="submit" class="btn-gold text-white py-2.5 rounded-2xl font-semibold text-sm transition">Add</button>
        </form>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($specialists as $spec)
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200">
            <div class="flex items-center space-x-3 mb-3">
                <div class="w-10 h-10 btn-gold rounded-full flex items-center justify-center"><span class="text-white font-semibold">{{ mb_substr($spec->user->name, 0, 1) }}</span></div>
                <div><h3 class="font-semibold text-brown">{{ $spec->user->name }}</h3><p class="text-xs text-stone-400">{{ $spec->experience_years }} yrs experience · Rating: {{ number_format($spec->rating, 1) }}</p></div>
            </div>
            <p class="text-sm text-stone-500 mb-3">{{ $spec->bio }}</p>
            <div class="flex flex-wrap gap-1 mb-3">@foreach($spec->services as $s)<span class="text-xs bg-cream text-brown px-2 py-0.5 rounded-full border border-stone-200">{{ $s->name }}</span>@endforeach</div>
            <form method="POST" action="{{ route('owner.specialists.destroy', $spec) }}" onsubmit="return confirm('Remove this specialist?')">@csrf @method('DELETE')<button class="w-full py-2 bg-red-50 text-red-600 text-sm font-medium rounded-xl hover:bg-red-100 transition">Remove</button></form>
        </div>
        @endforeach
    </div>
</div>
@endsection
