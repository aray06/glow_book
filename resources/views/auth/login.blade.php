@extends('layouts.app')
@section('title', 'Sign In')
@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-brown">Welcome Back</h1>
            <p class="text-stone-500 mt-1">Sign in to your GlowBook account</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-8 border border-stone-200">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-stone-700 mb-1">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-3 rounded-2xl border border-stone-200 focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none text-sm bg-cream/50">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-stone-700 mb-1">Password</label>
                    <input id="password" type="password" name="password" required class="w-full px-4 py-3 rounded-2xl border border-stone-200 focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none text-sm bg-cream/50">
                    @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-stone-300 text-gold focus:ring-gold">
                    <span class="ml-2 text-sm text-stone-600">Remember me</span>
                </div>
                <button type="submit" class="w-full btn-gold text-white py-3 rounded-2xl font-semibold text-sm transition">Sign In</button>
            </form>
        </div>
        <p class="text-center text-sm text-stone-500 mt-6">Don't have an account? <a href="{{ route('register') }}" class="text-gold font-semibold hover:underline">Create one</a></p>
    </div>
</div>
@endsection
