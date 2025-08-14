@extends('layouts.app')

@section('title', 'Edit Expense')

@section('content')
<div class="flex justify-center items-start">
    <div class="w-full max-w-lg bg-white rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-700">Edit Expense</h1>

    @if($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('user.expenses.update', ['user' => $user, 'expense' => $expenses->id])}}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" id="title" readonly
                    value="{{ old('title', $expenses->title) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 bg-gray-100 cursor-not-allowed">
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" cols="5" rows="5"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description', $expenses->description) }}</textarea>
        </div>

        <div>
            <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
            <input type="text" name="amount" id="amount"
                    value="{{ old('amount', $expenses->amount) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
            <input type="date" name="date" id="date"
                    value="{{ old('date', $expenses->date) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        @php
            $categories = ['shopping', 'medical', 'entertainment'];
        @endphp

        <div>
            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select name="category" id="category"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                @foreach ($categories as $category)
                    <option value="{{ $category }}" {{ old('category', $expenses->category) == $category ? 'selected' : '' }}>
                        {{ ucfirst($category) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('user.expenses.index', ['user' => $user]) }}" class="url-cancel"> Cancel </a>            
            <button type="submit" class="btn">Update</button>
        </div>
    </form>
    </div>
</div>
@endsection
