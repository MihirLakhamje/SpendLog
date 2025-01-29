<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::where('user_id', Auth::id())->simplePaginate(10);
        dd($incomes);
        // return view('incomes.index');
    }

    public function create()
    {
        return view('incomes.create');
    }

    public function edit(Income $income)
    {
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
}
