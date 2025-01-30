<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::where('user_id', Auth::id())->orderBy('income_date', 'desc')->paginate(8);
        // dd($incomes);
        return view('incomes.index', ['incomes' => $incomes]);
    }

    public function create()
    {
        return view('incomes.create');
    }

    public function edit(Income $income)
    {
        if (!$income){
            abort(404);
        }
        return view('incomes.edit', ['income' => $income]);
    }

    public function store(Request $request)
    {
        $requestDate = Carbon::parse($request->income_date)->format('Y-m-d');
        $request->validate([
            'income_amount' => ['required', 'numeric'],
            'source' => ['required', 'string'],
            'income_date' => ['required', 'date'],
        ]);

        Income::create([
            'user_id' => Auth::id(),
            'income_amount' => $request->income_amount,
            'source' => $request->source,
            'income_date' => $requestDate,
        ]);

        return redirect()->route('incomes.index')->with('success', 'Income added successfully');
    }

    public function update(Request $request, Income $income)
    {
        if (!$income){
            abort(404);
        }

        $requestDate = Carbon::parse($request->income_date)->format('Y-m-d');
        $request->validate([
            'income_amount' => ['required', 'numeric'],
            'source' => ['required', 'string'],
            'income_date' => ['required', 'date'],
        ]);

        $income->update([
            'user_id' => Auth::id(),
            'income_amount' => $request->income_amount,
            'source' => $request->source,
            'income_date' => $requestDate,
        ]);

        return redirect()->route('incomes.index')->with('success', 'Income updated successfully');
    }

    public function destroy(Income $income)
    {
        $income->delete();
        return redirect()->route('incomes.index')->with('success', 'Income deleted successfully');
    }
}
