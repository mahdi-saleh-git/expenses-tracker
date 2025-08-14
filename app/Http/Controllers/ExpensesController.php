<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenses;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $userid)
    {
        $userid = $userid ?? session('user_id');

        $expenses = Expenses::when($userid, fn($query, $userid) => $query->expenses($userid))->get();

        return view('expenses.index', ['expenses' => $expenses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $userid)
    {
        return view('expenses.create', ['user' => $userid]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255|min:8',
            'description' => 'nullable',
            'amount' => 'required|numeric|min:0',
            'date' => 'required',
            'category' => 'required',
        ]);

        $userid = session('user_id');

        $expense = Expenses::create([...$data, 'user_id' => $userid]);

        return redirect()->route('user.expenses.show', ['user' => $userid, 'expense' => $expense->id])->with('success', 'Expenses Succesfully Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $userid, int $expenseid)
    {
        $expenses = Expenses::when($userid, fn($query, $userid) => $query->expensesDetails($userid, $expenseid))->first();

        return view('expenses.details', ['expenses' => $expenses]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $userid, int $expenseid)
    {

        $expenses = Expenses::when($userid, fn($query, $userid) => $query->expensesDetails($userid, $expenseid))->first();

        return view('expenses.edit', ['user' => $userid, 'expenses' => $expenses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $userid, Expenses $expense)
    {
        $data = $request->validate([
            'title' => 'required|max:255|min:8',
            'description' => 'nullable',
            'amount' => 'required|numeric|min:0',
            'date' => 'required',
            'category' => 'required',
        ]);

        $expense->update($data);

        return redirect()->route('user.expenses.show', ['user' => $userid, 'expense' => $expense->id])->with('success', 'Changes Saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userid, string $expenseid)
    {
        $expenses = Expenses::when($userid, fn($query, $userid) => $query->expensesDetails($userid, $expenseid))->first();
        
        $expenses->delete();

        return redirect()->route('user.expenses.index', ['user' => $userid])
            ->with('success', 'Expenses Details Deleted');
    }
}
