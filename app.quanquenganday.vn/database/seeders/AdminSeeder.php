<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
    'name' => 'Admin Quán Quen',
    'email' => 'admin@gmail.com',
    'password' => bcrypt('12345678'),
    'affiliate_id' => 'SALE001',
    'role' => 'admin',
]);
    }
}
