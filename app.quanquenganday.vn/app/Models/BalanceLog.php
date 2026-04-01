<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceLog extends Model
{
    use HasFactory;

    // Các trường cho phép lưu vào database
    protected $fillable = [
        'user_id',
        'amount',
        'type',        // 'plus' (cộng tiền) hoặc 'minus' (trừ tiền)
        'description'  // Lý do biến động (VD: Hoa hồng đơn DH-POS-001)
    ];

    /**
     * Thiết lập quan hệ: Một dòng log thuộc về một User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}