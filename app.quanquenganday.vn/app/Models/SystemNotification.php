<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemNotification extends Model
{
    /** @use HasFactory<\Database\Factories\SystemNotificationFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'content', 'type', 'is_read'];
}
