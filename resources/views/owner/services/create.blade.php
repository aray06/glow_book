@extends('layouts.app')
@section('title', 'Add Service')
@section('content')
<div class="bg-brown py-10"><div class="max-w-7xl mx-auto px-4"><h1 class="text-2xl font-bold text-white">Add New Service</h1></div></div>
<div class="max-w-2xl mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 p-6 md:p-8">
        <form method="POST" action="{{ route('owner.services.store') }}" class="space-y-5">@csrf
            <div><label class="block text-sm font-medium text-stone-700 mb-1">Service Name</label><input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 rounded-2xl border border-stone-200 focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none text-sm bg-cream/50">@error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror</div>
            <div><label class="block text-sm font-medium text-stone-700 mb-1">Description</label><textarea name="description" rows="3" class="w-full px-4 py-3 rounded-2xl border border-stone-200 focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none text-sm bg-cream/50 resize-none">{{ old('description') }}</textarea></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-stone-700 mb-1">Price (₸)</label><input type="number" name="price" value="{{ old('price') }}" required min="0" step="100" class="w-full px-4 py-3 rounded-2xl border border-stone-200 focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none text-sm bg-cream/50">@error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror</div>
                <div><label class="block text-sm font-medium text-stone-700 mb-1">Duration (min)</label><input type="number" name="duration_minutes" value="{{ old('duration_minutes') }}" required min="15" step="15" class="w-full px-4 py-3 rounded-2xl border border-stone-200 focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none text-sm bg-cream/50">@error('duration_minutes')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror</div>
            </div>
            <div><label class="block text-sm font-medium text-stone-700 mb-1">Category</label><input type="text" name="category" value="{{ old('category') }}" placeholder="e.g. Hair, Nails, Makeup" class="w-full px-4 py-3 rounded-2xl border border-stone-200 focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none text-sm bg-cream/50"></div>
            <div class="flex space-x-3 pt-2"><button type="submit" class="flex-1 btn-gold text-white py-3 rounded-2xl font-semibold text-sm transition">Create Service</button><a href="{{ route('owner.services') }}" class="flex-1 text-center py-3 bg-stone-100 text-stone-700 rounded-2xl font-semibold text-sm hover:bg-stone-200 transition">Cancel</a></div>
        </form>
    </div>
</div>
@endsection
