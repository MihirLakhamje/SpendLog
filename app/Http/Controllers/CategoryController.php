<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())->simplePaginate(10);
        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        Category::firstOrCreate([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function addcategory(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        $category =Category::firstOrCreate([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'category' => $category,
        ]);
    }

    public function edit(Category $category)
    {
        if (!$category) {
            abort(404);
        }
        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        if (!$category) {
            abort(404);
        }
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        $category->update([
            'name' => strtolower($request->name),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
