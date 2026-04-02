<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<UserFactory> */
    use HasFactory;

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
        
        // Lấy đơn hàng ĐÃ THANH TOÁN trong tháng này của bản thân
        // $myOrders = $this->hasMany(Order::class, 'sale_id')
        //     ->where('status', 'paid')
        //     ->whereMonth('created_at', now()->month)
        //     ->whereYear('created_at', now()->year)
        //     ->get();        
        // $myCount = $myOrders->count();

        $myCount = $this->orders()
        ->where('status', 'paid')
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

        // 1. Hoa hồng trực tiếp (270k x số máy)
        $direct = $myCount * ($price * $directRate);

        // 2. Thưởng KPI cá nhân
        $kpi_bo_2 = floor($myCount / 2) * 100000;    
        // Cứ mỗi bộ 3 máy thưởng 300k
        $kpi_bo_3 = floor($myCount / 3) * 300000;

        $kpi = 0;
        if ($myCount >= 3) {
        // Từ 3 máy trở lên: 100k x tổng số máy
            $kpi = $myCount * 100000;
        } elseif ($myCount == 2) {
            // Đúng 2 máy: thưởng cứng 100k
            $kpi = 100000;
    }

        // 3. Hoa hồng cân bằng (Team F1) - 100k/máy F1 nếu mình có bán
        $teamBalanced = 0;
        $f1TotalOrdersCount = 0;
        if ($myCount >= 1) {
            foreach ($this->f1s as $f1) {
                $f1Count = $f1->hasMany(Order::class, 'sale_id')
                    ->where('status', 'paid')
                    ->whereMonth('created_at', now()->month)
                    ->count();
                $f1TotalOrdersCount += $f1Count;
                $teamBalanced += ($f1Count * 100000);
            }
        }

        // 4. Thưởng doanh thu hệ thống (Giả sử tổng doanh thu tháng của Web là $totalSystemSales)
        // Mục này thường chốt vào cuối tháng, trên Dashboard nên hiện % chia sẻ dự kiến
        $systemPoolPercent = 0;
        if ($myCount >= 3) $systemPoolPercent = 5;
        elseif ($myCount >= 2) $systemPoolPercent = 3;
        elseif ($myCount >= 1) $systemPoolPercent = 2;

        // 5. 5% Thu nhập của F1
        $f1IncomeShare = 0;
        foreach ($this->f1s as $f1) {
            // Chỉ tính trên hoa hồng trực tiếp của F1 để tránh đệ quy vô tận
            $f1Direct = $f1->hasMany(Order::class, 'sale_id')
                ->where('status', 'paid')
                ->whereMonth('created_at', now()->month)
                ->count() * ($price * $directRate);
            $f1IncomeShare += ($f1Direct * 0.05);
        }

        // 6. Quản lý khu vực (5% doanh số khu vực)
        $areaBonus = 0;
        if ($this->is_area_manager) {
            $areaBonus = \App\Models\Order::where('status', 'paid')
                ->whereMonth('created_at', now()->month)
                ->whereHas('shop', function($q) {
                    $q->where('ward', $this->ward); // Giả sử quản lý theo phường
                })->sum('amount') * 0.05;
        }

        return [
            'direct' => $direct,
            'kpi' => $kpi,
            'team' => $teamBalanced,
            'f1_share' => $f1IncomeShare,
            'area' => $areaBonus,
            'pool' => $systemPoolPercent,
            'total' => $direct + $kpi + $teamBalanced + $f1IncomeShare + $areaBonus,
            'my_count' => $myCount,
            'f1_count' => $f1TotalOrdersCount
        ];
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
}
