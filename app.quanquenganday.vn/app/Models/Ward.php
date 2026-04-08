<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'wards';

    // Khai báo khóa chính là cột 'code' thay vì 'id'
    protected $primaryKey = 'code';

    // QUAN TRỌNG: Sửa lỗi Syntax ở đây
    public $incrementing = false; // Khóa chính không tự tăng
    protected $keyType = 'string'; // Khóa chính là kiểu chuỗi (string)

    protected $fillable = ['code', 'name', 'province_code'];

    public $timestamps = false; // Nếu bảng wards của bạn không có cột created_at/updated_at
    public function province()
    {
        // Giả sử bảng wards có cột province_code nối sang code của bảng provinces
        return $this->belongsTo(\App\Models\Province::class, 'province_code', 'code');
    }
}