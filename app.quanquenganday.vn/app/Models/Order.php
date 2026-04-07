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
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'completed' => 'Đã hoàn thành',
            'paid'      => 'Đã thanh toán',
            'pending'   => 'Đang xử lý',
            'rejected'  => 'Đã từ chối',
            default     => 'Không xác định',
        };
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'completed' => 'text-green-600 bg-green-50 border-green-200',
            'paid'      => 'text-blue-600 bg-blue-50 border-blue-200',
            'pending'   => 'text-orange-600 bg-orange-50 border-orange-200',
            'rejected'  => 'text-red-600 bg-red-50 border-red-200',
            default     => 'text-gray-600 bg-gray-50 border-gray-200',
        };
    }
}
