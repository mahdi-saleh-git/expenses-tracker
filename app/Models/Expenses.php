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
}
