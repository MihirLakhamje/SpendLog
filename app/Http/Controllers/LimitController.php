<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LimitController extends Controller
{
    public function index()
    {
        $limits = Limit::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(8);
        // dd($limits);
        return view('limits.index', ['limits' => $limits]);
    }

    public function create()
    {
        return view('limits.create', [
            'categories' => Category::all()
        ]);
    }

    public function edit(Limit $limit)
    {
        if(!$limit){
            abort(404);
        }
        return view('limits.edit', [
            'categories' => Category::all(),
            'limit' => $limit
        ]);
    }   

    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required', 'string'],
            'limit_amount' => ['required', 'numeric'],
        ]);


        Limit::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category,
            'limit_amount' => $request->limit_amount,
        ]);
        return redirect()->route('limits.index')->with('success', 'Limit set successfully');
    }

    public function update(Request $request, Limit $limit)
    {
        if (!$limit) {
            abort(404);
        }
        $request->validate([
            'category' => ['required', 'string'],
            'limit_amount' => ['required', 'numeric', 'min:1'],
        ]);

        $limit->update([
            'category_id' => $request->category,
            'limit_amount' => $request->limit_amount,
        ]);
        return redirect()->route('limits.index')->with('success', 'Limit updated successfully');
    }

    public function destroy(Limit $limit)
    {
        $limit->delete();
        return redirect()->route('limits.index')->with('success', 'Limit deleted successfully');
    }
}
