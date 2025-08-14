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
            'date' => 'required|before_or_equal:today',
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
            'date' => 'required|before_or_equal:today',
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

    public function report(Request $request) {
        
        $year = $request->get('year', date('Y'));
        $userid = session('user_id');

        $rawData = Expenses::monthlyCategoryExpenses($userid, $year)->get();


        $labels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];


        $categories = $rawData->pluck('category')->unique()->values();

        $datasets = [];
        foreach ($categories as $category) {
            $data = [];
            for ($month = 1; $month <= 12; $month++) {
                $amount = $rawData
                    ->where('month', $month)
                    ->where('category', $category)
                    ->pluck('total_amount')
                    ->first();
                $data[] = $amount ?? 0;
            }
            $datasets[] = [
                'label' => $category,
                'data' => $data,
            ];
        }

        return view('expenses.report_category_monthly', ['labels' => $labels, 'datasets' => $datasets, 'year' => $year]);
    }

    // public function report(Request $request) {
        
    //     $type = $request->get('type', 'monthly');
    //     $userid = session('user_id');
    //     $labels = $data = [];

    //     switch ($type) {

    //         case 'weekly':
    //             $expenses = Expenses::weeklyExpenses($userid)->pluck('total_amount', 'week');
    //             $labels = $expenses->keys();
    //             $data = $expenses->values();
    //             break;
            
    //         case 'yearly':
    //             $expenses = Expenses::yearlyExpenses($userid)->pluck('total_amount', 'year');
    //             $labels = $expenses->keys();
    //             $data = $expenses->values();
    //             break;

    //         case 'monthly':
    //         default:
    //             $expenses = Expenses::monthlyExpenses($userid)->pluck('total_amount', 'month');
    //             $labels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    //             for ($i = 1; $i <= 12; $i++) {
    //                 $data[] = $expenses[$i] ?? 0;
    //             }
    //             break;
            
    //     }

    //     return view('expenses.report', ['labels' => $labels, 'data' => $data, 'type' => $type]);
    // }
}
