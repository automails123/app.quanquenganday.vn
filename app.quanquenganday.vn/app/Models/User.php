<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;

    /** @use HasFactory<UserFactory> */
    use HasFactory;
    use Notifiable;

    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'affiliate_id', 
        'parent_id',    
        'path',          
        'level',         
        'role',          
        'balance',
        'cccd_front_image',
        'cccd_back_image',
        'cccd_status',
        'tax_code',
        'status'
    ];
    protected static function booted()
{
    static::creating(function ($user) {
        // Tự động tạo mã SALE... nếu chưa có
        if (!$user->affiliate_id) {
            $lastUser = self::where('affiliate_id', 'like', 'SALE%')->orderBy('id', 'desc')->first();
            $number = $lastUser ? (int) str_replace('SALE', '', $lastUser->affiliate_id) + 1 : 1;
            $user->affiliate_id = 'SALE' . str_pad($number, 3, '0', STR_PAD_LEFT);
        }
    });
}

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function orders()
{
    // Giả sử trong bảng orders bạn dùng cột sale_id để lưu ID người bán
    return $this->hasMany(Order::class, 'sale_id');
}
    public function f1s()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    // Lấy danh sách đơn hàng POS đã thanh toán của User này
    public function paidOrders()
    {
        return $this->hasMany(Order::class, 'sale_id')->where('status', 'paid');
    }

    public function getMonthlyEarningsAttribute()
    {
        $price = (float) get_pos_setting('default_price', 1800000);
        $directRate = (float) get_pos_setting('commission_rate', 15) / 100;
        $myOrders = $this->orders()
            ->where('status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year);

        $myCount = $myOrders->count();
        // ===== 2. Direct =====
        $direct = $myCount * ($price * $directRate);

        // ===== 3. KPI (tổng tháng) =====
        $kpi = $this->calculateKpi($myCount);

        // ===== 4. CÂN BẰNG =====
        $teamBalanced = 0;

        foreach ($this->f1s as $f1) {
            $f1Count = $f1->orders()
                ->where('status', 'paid')
                ->whereMonth('created_at', now()->month)
                ->count();

            $teamBalanced += min($myCount, $f1Count) * 100000;
        }
        // ===== 5. HỆ THỐNG =====
        $totalSystemPos = Order::where('status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->count();

        $pool = $totalSystemPos * 180000; // 10%

        $systemBonus = 0;

        // Đếm số người đủ điều kiện
        $users = User::all();

        $group1 = $users->filter(fn($u) => $u->monthly_pos >= 1)->count();
        $group2 = $users->filter(fn($u) => $u->monthly_pos >= 2)->count();
        $group3 = $users->filter(fn($u) => $u->monthly_pos >= 3)->count();

        if ($myCount >= 1 && $group1 > 0) {
            $systemBonus += ($pool * 0.02) / $group1;
        }
        if ($myCount >= 2 && $group2 > 0) {
            $systemBonus += ($pool * 0.03) / $group2;
        }
        if ($myCount >= 3 && $group3 > 0) {
            $systemBonus += ($pool * 0.05) / $group3;
        }
         // ===== 6. F1 5% =====
        $f1Share = 0;

        foreach ($this->f1s as $f1) {
            $f1Income = $f1->monthly_earnings['direct']
                + $f1->monthly_earnings['kpi']
                + $f1->monthly_earnings['team']
                + $f1->monthly_earnings['system'];

            $f1Share += $f1Income * 0.05;
        }
         // ===== 7. KHU VỰC =====
       $wards = \DB::table('user_ward')
        ->where('user_id', auth()->id())
        ->pluck('ward_code');

    $areaRevenue = Order::join('shops', 'orders.shop_id', '=', 'shops.id')
        ->whereIn('shops.ward', $wards)
        ->where('orders.status', 'paid')
        ->whereMonth('orders.created_at', now()->month)
        ->whereYear('orders.created_at', now()->year)
        ->sum('orders.amount');

    $areaBonus = $areaRevenue * 0.05;
            
            dd($areaBonus);

        // $areaRevenue = Order::where('status', 'paid')
        //     ->whereMonth('created_at', now()->month)
        //     ->whereHas('shop', function ($q) use ($wards) {
        //         $q->whereIn('ward', $wards);
        //     })
        //     ->sum('amount');

// $shops = \App\Models\Shop::whereIn('ward', $wards)->get();

// dd([
//     'wards' => $wards,
//     'shops_found' => $shops->count(),
//     'shops_sample' => $shops->take(5)
// ]);
    
        $total = $direct + $kpi + $teamBalanced + $systemBonus + $f1Share + $areaBonus;

        return [
            'direct' => round($direct),
            'kpi' => $kpi,
            'team' => $teamBalanced,
            'system' => $systemBonus, // THÊM
            'f1_share' => $f1Share,
            'area' => $areaBonus,
            'total' => round($total),
            'my_count' => $myCount,
            // 'f1_count' => $f1TotalOrdersCount
        ];
    }
private function calculateKpi($count)
    {
        if ($count < 2) return 0;
        if ($count == 2) return 100000;
        if ($count == 3) return 300000;

        return 300000 + ($count - 3) * 100000;
    }
    
    public function getAllSubordinateIds()
    {
        $ids = [$this->id];
        foreach ($this->f1s as $f1) {
            $ids = array_merge($ids, $f1->getAllSubordinateIds());
        }
        return $ids;
    }
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function bankAccount()
    {
        // Mặc định Laravel tìm user_id, nếu bạn đặt tên khác thì điền vào tham số thứ 2
        return $this->hasOne(BankAccount::class); 
    }

    public function wards() {
        return $this->belongsToMany(Ward::class, 'user_ward', 'user_id', 'ward_code');
    }

    public function notifications() {
        return $this->belongsToMany(Notification::class, 'notification_user')
                    ->withPivot('read_at')
                    ->withTimestamps();
    }
    public function unreadNotificationsCount()
    {
        return $this->notifications()->wherePivot('read_at', null)->count();
    }

    public function getStatusLabelAttribute()
{
    return match ($this->status) {
        'active'  => 'Đã xác minh',
        'pending' => 'Chờ xác minh',
        'blocked' => 'Đã khóa',
        default   => 'Chờ xác minh',
    };
}

public function getStatusClassAttribute()
{
    return match ($this->status) {
        'active'  => 'text-green-500',
        'pending' => 'text-orange-500',
        'blocked' => 'text-red-500',
        default   => 'text-gray-500',
    };
}
/**
     * Kết nối với bảng hoa hồng (Commissions)
     */
    public function commissions(): HasMany
    {
        return $this->hasMany(Commission::class);
    }

    /**
     * Kết nối với bảng nhật ký số dư (BalanceLogs)
     */
    public function balanceLogs(): HasMany
    {
        return $this->hasMany(BalanceLog::class);
    }
    public function shops()
    {
        return $this->hasMany(Shop::class, 'sale_id');
    }
    public function f2s()
    {
        return $this->hasManyThrough(User::class, User::class, 'parent_id', 'parent_id', 'id', 'id');
    }

    public function monthly_closings()
    {
        // Một User có nhiều bản chốt lương hàng tháng
        return $this->hasMany(MonthlyClosing::class);
    }

    /**
     * Nếu Duyqt muốn lấy thêm lịch sử hoa hồng F1 (F1 Commission Logs)
     */
    public function f1_commission_logs()
    {
        // Giả sử Duyqt tạo bảng lưu vết hoa hồng từ F1
        return $this->hasMany(F1CommissionLog::class, 'user_id');
    }
}
