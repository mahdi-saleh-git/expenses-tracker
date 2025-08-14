@extends('layouts.app')

@section('title', 'Expense Details')

@section('content')

<div class="m-4">
        <h1 class="text-2xl font-bold mb-6 text-gray-700">Expense Details</h1>

        <div class="space-y-4">
            <div>
                <span class="font-semibold text-gray-600">Title:</span>
                <span class="text-gray-800">{{ $expenses->title }}</span>
            </div>

            <div>
                <span class="font-semibold text-gray-600">Description:</span>
                <span class="text-gray-800">{{ $expenses->description ?? '-' }}</span>
            </div>

            <div>
                <span class="font-semibold text-gray-600">Amount:</span>
                <span class="text-gray-800">{{ $expenses->amount }}</span>
            </div>

            <div>
                <span class="font-semibold text-gray-600">Category:</span>
                <span class="text-gray-800">{{ ucfirst($expenses->category) }}</span>
            </div>

            <div>
                <span class="font-semibold text-gray-600">Date:</span>
                <span class="text-gray-800">{{ $expenses->date }}</span>
            </div>
        </div>

        <div class="mt-6 space-x-3">
            <a href="{{ route('user.expenses.index', ['user' => session('user_id')]) }}" class="url"> ← Back </a>
            <a class="url" href="{{ route('user.expenses.edit', ['user' => session('user_id'), 'expense' => $expenses->id]) }}">Edit</a>
        </div>
</div>
@endsection
