@extends('layouts.app')
@section('title', 'Manage Users')
@section('content')
<div class="bg-brown py-10"><div class="max-w-7xl mx-auto px-4"><h1 class="text-2xl md:text-3xl font-bold text-white">Manage Users</h1><p class="text-stone-400 mt-1">All registered users</p></div></div>
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-cream border-b border-stone-200"><tr>
                    <th class="text-left px-5 py-3 font-semibold text-stone-600">Name</th>
                    <th class="text-left px-5 py-3 font-semibold text-stone-600">Email</th>
                    <th class="text-left px-5 py-3 font-semibold text-stone-600">Phone</th>
                    <th class="text-left px-5 py-3 font-semibold text-stone-600">Role</th>
                    <th class="text-left px-5 py-3 font-semibold text-stone-600">Joined</th>
                </tr></thead>
                <tbody class="divide-y divide-stone-50">
                    @foreach($users as $user)
                    <tr class="hover:bg-cream/50">
                        <td class="px-5 py-3"><div class="flex items-center space-x-3"><div class="w-8 h-8 btn-gold rounded-full flex items-center justify-center flex-shrink-0"><span class="text-white text-xs font-bold">{{ mb_substr($user->name, 0, 1) }}</span></div><span class="font-medium text-brown">{{ $user->name }}</span></div></td>
                        <td class="px-5 py-3 text-stone-600">{{ $user->email }}</td>
                        <td class="px-5 py-3 text-stone-600">{{ $user->phone ?? '—' }}</td>
                        <td class="px-5 py-3">@php $rc=['admin'=>'bg-red-50 text-red-700 border-red-200','salon_owner'=>'bg-orange-50 text-orange-700 border-orange-200','specialist'=>'bg-purple-50 text-purple-700 border-purple-200','client'=>'bg-blue-50 text-blue-700 border-blue-200']; @endphp<span class="px-2.5 py-0.5 text-xs font-semibold rounded-full border {{ $rc[$user->role] }}">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</span></td>
                        <td class="px-5 py-3 text-stone-500 text-xs">{{ $user->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
