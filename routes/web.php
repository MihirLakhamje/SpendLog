<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\LimitController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
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

Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('update-password', [ResetPasswordController::class, 'resetPassword'])->name('password.change');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout')->can('authenticated');
    Route::get('/home', [UserController::class, 'home'])->name('users.home')->can('authenticated');
    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile')->can('authenticated');
    Route::patch('/profile-update', [UserController::class, 'updateProfile'])->name('profile.update')->can('authenticated');
    Route::post('/password/update', [UserController::class, 'updatePassword'])->name('password.update')->can('authenticated');
    Route::get('/stats', [UserController::class, 'stats'])->name('users.stats')->can('authenticated');
    Route::delete('/delete', [UserController::class, 'destroyUser'])->name('users.destroy')->can('authenticated');

    Route::prefix('incomes')->group(function () {
        Route::get('/', [IncomeController::class, 'index'])
        ->name('incomes.index')->can('authenticated');

        Route::get('/create', [IncomeController::class, 'create'])
        ->name('incomes.create')->can('authenticated');

        Route::post('/store', [IncomeController::class, 'store'])
        ->name('incomes.store')->can('authenticated');

        Route::get('/{income}/edit', [IncomeController::class, 'edit'])
        ->name('incomes.edit')->can('authenticated');

        Route::patch('/{income}/update', [IncomeController::class, 'update'])
        ->name('incomes.update')->can('authenticated');

        Route::delete('/{income}/delete', [IncomeController::class, 'destroy'])
        ->name('incomes.delete')->can('authenticated');
    });

    Route::prefix('expenses')->group(function () {
        Route::get('/', [ExpenseController::class, 'index'])
        ->name('expenses.index')->can('authenticated');

        Route::get('/create', [ExpenseController::class, 'create'])
        ->name('expenses.create')->can('authenticated');

        Route::post('/store', [ExpenseController::class, 'store'])
        ->name('expenses.store')->can('authenticated');

        Route::get('/{expense}/edit', [ExpenseController::class, 'edit'])
        ->name('expenses.edit')->can('authenticated');

        Route::patch('/{expense}/update', [ExpenseController::class, 'update'])
        ->name('expenses.update')->can('authenticated');

        Route::delete('/{expense}/delete', [ExpenseController::class, 'destroy'])
        ->name('expenses.delete')->can('authenticated');
    });

    Route::prefix('limits')->group(function () {
        Route::get('/', [LimitController::class, 'index'])
        ->name('limits.index')->can('authenticated');

        Route::get('/create', [LimitController::class, 'create'])
        ->name('limits.create')->can('authenticated');

        Route::post('/store', [LimitController::class, 'store'])
        ->name('limits.store')->can('authenticated');

        Route::get('/{limit}/edit', [LimitController::class, 'edit'])
        ->name('limits.edit')->can('authenticated');

        Route::patch('/{limit}/update', [LimitController::class, 'update'])
        ->name('limits.update')->can('authenticated');

        Route::delete('/{limit}/delete', [LimitController::class, 'destroy'])
        ->name('limits.delete')->can('authenticated');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])
        ->name('categories.index')->can('authenticated');

        Route::get('/create', [CategoryController::class, 'create'])
        ->name('categories.create')->can('authenticated');

        Route::post('/store', [CategoryController::class, 'store'])
        ->name('categories.store')->can('authenticated');

        Route::post('/addcategory', [CategoryController::class, 'addcategory'])
        ->name('categories.addcategory')->can('authenticated');

        Route::get('/{category}/edit', [CategoryController::class, 'edit'])
        ->name('categories.edit')->can('authenticated');

        Route::patch('/{category}/update', [CategoryController::class, 'update'])
        ->name('categories.update')->can('authenticated');

        Route::delete('/{category}/delete', [CategoryController::class, 'destroy'])
        ->name('categories.delete')->can('authenticated');
    });
});
