<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    // Khai báo các cột được phép lưu dữ liệu (Mass Assignment)
    protected $fillable = [
        'name',
        'owner_name',
        'phone',
        'address_number',
        'street',
        'ward',
        'city',
        'tax_code',
        'gpkd_path',
        'cccd_path',
        'sale_id',
        'pos_price',
        'status',
    ];

    /**
     * Thiết lập mối quan hệ: Một quán thuộc về một người giới thiệu (Sale)
     */
    public function sale()
    {
        return $this->belongsTo(User::class, 'sale_id');
    }
}
