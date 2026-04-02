<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;
use Illuminate\Support\Str;
class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = ['Phú Thạnh', 'Tân Thới Hòa', 'Hiệp Tân'];
        foreach ($areas as $area) {
        Area::create([
            'name' => $area,
            'code' => strtoupper(Str::random(4)),
        ]);
    }
    }
}
