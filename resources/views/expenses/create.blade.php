@extends('layouts.app')

@section('title', 'Add Expense')

@section('content')
<div class="flex justify-center items-start">
    <div class="w-full max-w-lg bg-white rounded-lg p-6">

        <h1 class="text-2xl font-bold mb-6 text-gray-700">Add New Expense</h1>

        @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('user.expenses.store', ['user' => $user]) }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="title" class="label">Title</label>
                <input type="text" name="title" id="title" class="input" value="{{ old('title')}}">
            </div>

            <div>
                <label for="description" class="label">Description</label>
                <textarea name="description" id="description" cols="5" rows="5" class="input">{{ old('description')}}</textarea>
            </div>

            <div>
                <label for="amount" class="label">Amount</label>
                <input type="text" name="amount" id="amount" class="input" value="{{old('amount')}}">
            </div>

            <div>
                <label for="date" class="label">Date</label>
                <input type="date" name="date" id="date" class="input" value="{{old('date')}}">
            </div>

            @php
            $categories = ['shopping', 'medical', 'entertainment']; // Expand as needed
            @endphp

            <div>
                <label for="category" class="label">Category</label>
                <select name="category" id="category" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                            {{ ucfirst($category) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-4 mt-4">
                <a href="{{ route('user.expenses.index', ['user' => $user]) }}" class="url-cancel"> Cancel </a>            
                <button type="submit" class="btn"> Save </button>
            </div>
        </form>
    </div>
</div>
@endsection
