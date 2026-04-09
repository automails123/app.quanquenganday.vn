<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyClosing extends Model
{
    protected $fillable = [
        'user_id', 'month', 'year', 'personal_pos_count', 
        'direct_commission', 'kpi_bonus', 'balanced_bonus', 
        'system_pool_bonus', 'f1_share_bonus', 'total_earnings', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
