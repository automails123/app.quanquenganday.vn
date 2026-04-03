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
    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            'active'    => 'Đã mua POS, Đã lên App quán quen',
            'published' => 'Đã lên App quán quen',
            'paid'      => 'Đã mua POS',
            'rejected'  => 'Bị từ chối',
            'pending'   => 'Đang tư vấn',
            default     => 'Đang tư vấn',
        };
    }
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'active'    => 'text-emerald-600 font-bold', // Xanh đậm - Hoàn tất
            'published' => 'text-blue-500 font-medium',  // Xanh dương - Đã lên app
            'paid'      => 'text-purple-500 font-medium',// Tím - Đã đóng tiền
            'rejected'  => 'text-red-500',               // Đỏ - Bị loại
            'pending'   => 'text-amber-500 italic',      // Vàng cam - Chờ đợi
            default     => 'text-gray-400',
        };
    }
}
