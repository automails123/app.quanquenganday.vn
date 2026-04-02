<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable = ['order_code', 'shop_id', 'sale_id', 'amount', 'status', 'commission', 'kpi_bonus','cycle',];
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function sale()
    {
        return $this->belongsTo(User::class, 'sale_id');
    }
     public function user()
    {
        return $this->belongsTo(User::class, 'sale_id');
    }
}
