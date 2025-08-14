@extends('layouts.app')

@section('content')


{{-- <div class="min-h-screen p-6 bg-gray-50"> --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">Expenses List</h1>
        <a class="url px-4 py-2 bg-blue-100 rounded hover:bg-blue-200" href="{{ route('user.expenses.create', ['user' => session('user_id')]) }}">
            + Add New Expense
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-center">
            <thead class="bg-gray-100">
                <tr>
                    <th class="row-header">#</th>
                    <th class="row-header">Item</th>
                    <th class="row-header">Amount</th>
                    <th class="row-header">Category</th>
                    <th class="row-header">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($expenses as $expense)
                <tr class="hover:bg-gray-50">
                    <td class="row-details">{{ $expense->id }}</td>
                    <td class="row-details">
                        <a class="url" href="{{ route('user.expenses.show', ['user' => session('user_id'), 'expense' => $expense->id]) }}">
                            {{ $expense->title }}
                        </a>
                    </td>
                    <td class="row-details">RM {{ $expense->amount }}</td>
                    <td class="row-details">{{ $expense->category }}</td>
                    <td class="row-details space-x-4">
                        <a class="url" href="{{ route('user.expenses.edit', ['user' => session('user_id'), 'expense' => $expense->id]) }}">Edit</a>
                        <form action="{{ route('user.expenses.destroy', ['user' => session('user_id'), 'expense' => $expense->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Delete this task?')">Delete</button>
                        </form>                    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
{{-- </div> --}}
@endsection
