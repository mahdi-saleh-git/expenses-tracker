@extends('layouts.login')

@section('title', 'Register')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-center">Register</h2>

@if($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('register.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label class="block mb-1">Name</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block mb-1">Email</label>
        <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block mb-1">Password</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block mb-1">Confirm Password</label>
        <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
    </div>

    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded">Register</button>
</form>

<p class="mt-4 text-center text-sm">
    Already have an account? <a href="{{ route('login.index') }}" class="text-blue-500 hover:underline">Login here</a>
</p>
@endsection
