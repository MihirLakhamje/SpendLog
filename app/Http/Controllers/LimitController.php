<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LimitController extends Controller
{
    public function index()
    {
        return view('limits.index');
    }

    public function create()
    {
        return view('limits.create');
    }

    public function edit()
    {
        return view('limits.edit');
    }   

    
}
