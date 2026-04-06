<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Cho phép lưu các trường này vào DB
    protected $fillable = [
        'sender_id', 
        'title', 
        'content', 
        'type', 
        'image', 
        'action_url'
    ];

    /**
     * Quan hệ: Thông báo này của ai gửi (Admin hoặc User)
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    protected $table = 'notifications';

    /**
     * Quan hệ Many-to-Many: Thông báo này gửi cho những User nào
     * Kèm theo trạng thái read_at từ bảng trung gian
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'notification_user')
                    ->withPivot('read_at')
                    ->withTimestamps();
    }
}
