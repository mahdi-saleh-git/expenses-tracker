@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">My Profile</h1>

    <div class="mb-4">
        <label class="block font-medium text-gray-700">Name</label>
        <p class="mt-1 text-gray-900">{{ $user->name }}</p>
    </div>

    <div class="mb-4">
        <label class="block font-medium text-gray-700">Email</label>
        <p class="mt-1 text-gray-900">{{ $user->email }}</p>
    </div>

    <div class="mt-6 flex space-x-2">
        <a href="{{ route('register.edit', ['register' => $user->id]) }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
           Edit Profile
        </a>
        <a href="{{ route('user.expenses.index', ['user' => $user->id]) }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
           Dashboard
        </a>
    </div>
</div>
@endsection
