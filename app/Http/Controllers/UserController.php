<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home()
    {
        $user = User::find(Auth::id());
        $expenses = $user->expenses()->sum('expense_amount');
        $incomes = $user->incomes()->sum('income_amount');
        $expenses_this_month = $user->expenses()
            ->whereMonth('expense_date', now()->month)
            ->whereYear('expense_date', now()->year)
            ->sum('expense_amount');
        $incomes_this_month = $user->incomes()
            ->whereMonth('income_date', now()->month)
            ->whereYear('income_date', now()->year)
            ->sum('income_amount');

        $savings = $incomes - $expenses;
        $savings_this_month = $incomes_this_month - $expenses_this_month;
        if ($savings < 0) {
            $savings = 0;
        }
        if ($savings_this_month < 0) {
            $savings_this_month = 0;
        }
        $exceedingLimitsCount = $user->limits->filter(function ($limit) {
            return $limit->category->expenses->sum('expense_amount') >= ($limit->limit_amount * 0.8);
        })->count();
        // dd($savings);
        return view('users.home', [
            'expenses' => $expenses,
            'this_month_expenses' => $expenses_this_month,
            'incomes' => $incomes,
            'this_month_incomes' => $incomes_this_month,
            'savings' => $savings,
            'this_month_savings' => $savings_this_month,
            'exceedingLimitsCount' => $exceedingLimitsCount,
        ]);
    }

    public function stats()
    {
        $user = User::find(Auth::id());
        $expenses = $user->expenses()
            ->whereYear('expense_date', now()->year)
            ->get()
            ->groupBy(function ($expense) {
                return Carbon::parse($expense->expense_date)->format('n'); // Get numeric month (1-12)
            })
            ->map(fn($group) => $group->sum('expense_amount'));
        
        $incomes = $user->incomes()
            ->whereYear('income_date', now()->year)
            ->get()
            ->groupBy(function ($income) {
                return Carbon::parse($income->income_date)->format('n'); // Get numeric month (1-12)
            })
            ->map(fn($group) => $group->sum('income_amount'));
        
        $incomesByMonth = array_fill(1, 12, 0);
        foreach ($incomes as $month => $total) {
            $incomesByMonth[$month] = $total;
        }

        // Ensure all months are present
        $expensesByMonth = array_fill(1, 12, 0);
        foreach ($expenses as $month => $total) {
            $expensesByMonth[$month] = $total;
        }

        return response()->json([
            'expenses' => array_values($expensesByMonth),
            'incomes' => array_values($incomesByMonth),
        ]);
    }

    public function profile()
    {
        return view('users.profile');
    }

    public function updateProfile(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email'],
            ]);

            $user = User::find(Auth::user()->id);
            $userEmail = User::where('email', $request->email)->first();
            if ($userEmail) {
                if ($userEmail->id != Auth::user()->id) {
                    return redirect()->route('users.profile')->with('error', 'Email already exists.');
                }
            }
            if ($user->google_id) {
                $user->name = $request->name;
                $user->save();
                return redirect()->route('users.profile')->with('success', 'You have successfully updated your profile.');
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return redirect()->route('users.profile')->with('success', 'You have successfully updated your profile.');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'password' => ['required', 'min:6', 'confirmed'],
            ]);

            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->route('users.profile')->with('success', 'You have successfully updated your password.');
        } catch (Exception $e) {
            return redirect()->route('users.profile')->with('error', 'Something went wrong.');
        }
    }

    public function destroyUser()
    {
        try {
            $user = User::find(Auth::user()->id);
            $user->delete();
            return redirect()->route('login')->with('success', 'User deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
