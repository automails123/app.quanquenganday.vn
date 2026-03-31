<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Nguyễn Văn Sale',
            'email' => 'sale@gmail.com',
            'phone' => '0901234567',
            'password' => Hash::make('12345678'),
            'affiliate_id' => 'SALE001', // <--- Đây chính là mã bạn đang nhập trong Form
            'role' => 'sale',
        ]);
    }
}
