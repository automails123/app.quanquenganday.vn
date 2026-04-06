<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class NotificationUser extends Pivot
{
    protected $table = 'notification_user';

    // Laravel tự hiểu đây là bảng Pivot (trung gian)
    public $incrementing = true; 
}