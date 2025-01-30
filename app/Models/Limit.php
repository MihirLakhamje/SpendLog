<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Limit extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'limit_name',
        'limit_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function total_expenses()
    {
        return $this->category->expenses->sum('expense_amount');
    }

    public function limit_usage()
    {
        if(($this->total_expenses() / $this->limit_amount * 100) > 100) {
            return 100;
        }
        return $this->total_expenses() / $this->limit_amount * 100;
    }

    public function limit_status()
    {
        $limitAmount = $this->limit_amount;
        $totalExpenses = $this->category->expenses->sum('expense_amount');

        if ($totalExpenses > $limitAmount) {
            return [
                'status' => 'Exceeded',
                'color' => 'text-red-600 dark:text-red-500',
            ];
        } else {
            return [
                'status' => 'Under Limit',
                'color' => 'text-green-600 dark:text-green-500',
            ];
        }
    }
}
