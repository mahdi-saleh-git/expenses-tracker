<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'amount', 'date', 'category', 'user_id'];

    public function user() : BelongsTo {

        return $this->belongsTo(User::class);
    }

    public function scopeExpenses(Builder $query, string $userid = ''): Builder {

        return $query->where('user_id', '=', $userid);
    }

    public function scopeExpensesDetails(Builder $query, string $userid = '', int $expid = null): Builder {

        return $query->expenses($userid)
            ->where('id', '=', $expid);
    }

    public function scopeMonthlyCategoryExpenses($query, string $userid = '', int $year = null) {
        
        $year = $year ?? date('Y');

        return $query->expenses($userid)
            ->selectRaw('MONTH(date) as month, category, SUM(amount) as total_amount')
            ->whereYear('date', $year)
            ->groupBy('month', 'category')
            ->orderBy('month');
    }
    // public function scopeMonthlyExpenses(Builder $query, string $userid = '', int $year = null): Builder {
        
    //     return $query->expenses($userid)
    //         ->selectRaw('MONTH(date) as month, SUM(amount) as total_amount')
    //         ->whereYear('date', $year)
    //         ->groupBy('month')
    //         ->orderBy('month');
    // }

    // public function scopeWeeklyExpenses(Builder $query, string $userid = '', int $weeks = 12): Builder {
    //     return $query->expenses($userid)
    //         ->selectRaw('YEARWEEK(date, 1) as week, SUM(amount) as total_amount')
    //         ->where('date', '>=', now()->subWeeks($weeks))
    //         ->groupBy('week')
    //         ->orderBy('week');
    // }

    // public function scopeYearlyExpenses(Builder $query, string $userid = ''): Builder {
        
    //     return $query->expenses($userid)
    //         ->selectRaw('YEAR(date) as year, SUM(amount) as total_amount')
    //         ->groupBy('year')
    //         ->orderBy('year');
    // }


}
