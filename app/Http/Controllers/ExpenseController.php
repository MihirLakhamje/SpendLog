<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::where('user_id', Auth::id())->orderBy('expense_date', 'desc')->Paginate(10);
        // dd($expenses);
        return view('expenses.index', ['expenses' => $expenses]);
    }

    public function create()
    {
        return view('expenses.create', [
            'categories' => Auth::user()->categories,
        ]);
    }

    public function edit(Expense $expense)
    {
        if (!$expense) {
            abort(404);
        }
        return view('expenses.edit', [
            'expense' => $expense,
            'categories' => Category::where('user_id', Auth::id())->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $requestDate = Carbon::parse($request->expense_date)->format('Y-m-d');
        $request->validate([
            'category' => ['required', 'string'],
            'expense_amount' => ['required', 'numeric', 'min:1'],
            'title' => ['required', 'string'],
            'expense_date' => ['required', 'date'],
        ]);


        Expense::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category,
            'expense_amount' => $request->expense_amount,
            'title' => $request->title,
            'expense_date' => $requestDate,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense created successfully');
    }

    public function update(Request $request, Expense $expense)
    {
        if (!$expense) {
            abort(404);
        }
        $requestDate = Carbon::parse($request->expense_date)->format('Y-m-d');
        $request->validate([
            'category' => ['required', 'string'],
            'expense_amount' => ['required', 'numeric', 'min:1'],
            'title' => ['required', 'string'],
            'expense_date' => ['required', 'date'],
        ]);



        $expense->update([
            'user_id' => Auth::id(),
            'category_id' => $request->category,
            'expense_amount' => $request->expense_amount,
            'title' => $request->title,
            'expense_date' => $requestDate,
        ]);
        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully');
    }

    public function destroy(Expense $expense)
    {
        if (!$expense) {
            abort(404);
        }
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully');
    }
}
