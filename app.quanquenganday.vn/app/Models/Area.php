<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code'];

    /**
     * Một khu vực có nhiều người dùng (Managers/Sales)
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'area_id');
    }
        public function managers()
    {
        return $this->hasMany(User::class, 'area_id')->where('is_area_manager', true);
    }
}