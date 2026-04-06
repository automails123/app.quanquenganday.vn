<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        // Tắt kiểm tra khóa ngoại để nạp data cho nhanh
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('wards')->truncate();
    DB::table('provinces')->truncate();

    $this->command->info('Đang tải dữ liệu Tỉnh/Thành phố...');
    $provinces = Http::get('https://provinces.open-api.vn/api/v2/p/')->json();
    
    foreach ($provinces as $p) {
        DB::table('provinces')->insert([
            'code'          => $p['code'],
            'name'          => $p['name'],
            'division_type' => $p['division_type'],
            'codename'      => $p['codename'],
            'phone_code'    => $p['phone_code'] ?? null,
        ]);
    }

    $this->command->info('Đang tải dữ liệu Phường/Xã...');
    $wards = Http::get('https://provinces.open-api.vn/api/v2/w/')->json();

    foreach (array_chunk($wards, 500) as $chunk) {
        $data = [];
        foreach ($chunk as $w) {
            $data[] = [
                'code'          => $w['code'], // Cột này phải trùng với migration
                'name'          => $w['name'],
                'division_type' => $w['division_type'],
                'codename'      => $w['codename'],
                'province_code' => $w['province_code'],
            ];
        }
        DB::table('wards')->insert($data);
    }

    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    $this->command->info('Xong rồi!');
    }
}