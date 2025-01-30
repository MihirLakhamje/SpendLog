<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\LimitController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(Auth::check()){
        return redirect()->route('users.home');
    }
    return view('welcome');
});



Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store'])->name('login.store');

Route::get('/google/redirect', [SocialiteController::class, 'googleLogin'])->name('login.google');
Route::get('/google/callback', [SocialiteController::class, 'googleCallback'])->name('google.callback');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
    Route::get('/home', [UserController::class, 'home'])->name('users.home');
    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
    Route::patch('/profile-update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/password/update', [UserController::class, 'updatePassword'])->name('password.update');

    Route::prefix('incomes')->group(function () {
        Route::get('/', [IncomeController::class, 'index'])
        ->name('incomes.index');

        Route::get('/create', [IncomeController::class, 'create'])
        ->name('incomes.create');

        Route::post('/store', [IncomeController::class, 'store'])
        ->name('incomes.store');

        Route::get('/{income}/edit', [IncomeController::class, 'edit'])
        ->name('incomes.edit');

        Route::patch('/{income}/update', [IncomeController::class, 'update'])
        ->name('incomes.update');

        Route::delete('/{income}/delete', [IncomeController::class, 'destroy'])
        ->name('incomes.delete');
    });

    Route::prefix('expenses')->group(function () {
        Route::get('/', [ExpenseController::class, 'index'])
        ->name('expenses.index');

        Route::get('/create', [ExpenseController::class, 'create'])
        ->name('expenses.create');

        Route::post('/store', [ExpenseController::class, 'store'])
        ->name('expenses.store');

        Route::get('/{expense}/edit', [ExpenseController::class, 'edit'])
        ->name('expenses.edit');

        Route::patch('/{expense}/update', [ExpenseController::class, 'update'])
        ->name('expenses.update');

        Route::delete('/{expense}/delete', [ExpenseController::class, 'destroy'])
        ->name('expenses.delete');
    });

    Route::prefix('limits')->group(function () {
        Route::get('/', [LimitController::class, 'index'])
        ->name('limits.index');

        Route::get('/create', [LimitController::class, 'create'])
        ->name('limits.create');

        Route::post('/store', [LimitController::class, 'store'])
        ->name('limits.store');

        Route::get('/{limit}/edit', [LimitController::class, 'edit'])
        ->name('limits.edit');

        Route::patch('/{limit}/update', [LimitController::class, 'update'])
        ->name('limits.update');

        Route::delete('/{limit}/delete', [LimitController::class, 'destroy'])
        ->name('limits.delete');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])
        ->name('categories.index');

        Route::get('/create', [CategoryController::class, 'create'])
        ->name('categories.create');

        Route::post('/store', [CategoryController::class, 'store'])
        ->name('categories.store');

        Route::post('/addcategory', [CategoryController::class, 'addcategory'])
        ->name('categories.addcategory');

        Route::get('/{category}/edit', [CategoryController::class, 'edit'])
        ->name('categories.edit');

        Route::patch('/{category}/update', [CategoryController::class, 'update'])
        ->name('categories.update');

        Route::delete('/{category}/delete', [CategoryController::class, 'destroy'])
        ->name('categories.delete');
    });
});
