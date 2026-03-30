<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        'name' => 'Admin Quán Quen',
        'email' => 'admin@gmail.com',
        'phone' => '0901234567',
        'password' => Hash::make('12345678'),
        'role' => 'admin',
        'affiliate_id' => 'SALE001', // Đây là mã để bạn test link ?ref=SALE001
        'level' => 1,
    ]);
    }
}
