<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        return view('incomes.index');
    }

    public function create()
    {
        return view('incomes.create');
    }

    public function edit()
    {
        return view('incomes.edit');
    }

    
}
