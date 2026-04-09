<?php

if (!function_exists('get_pos_setting')) {
    function get_pos_setting($key, $default = null) {
        $setting = \App\Models\Setting::where('key', $key)->first();
        
        $value = $setting ? $setting->value : config("pos_settings.$key", $default);
        
        // Tự động chuyển về số nếu là các trường giá trị/phần trăm
        return is_numeric($value) ? (float)$value : $value;
    }
}

if (!function_exists('calculate_full_income')) {
    function calculate_full_income($user) {
        $pos_price = (float) get_pos_setting('default_price', 1800000);
        
        // 1. Hoa hồng trực tiếp (15%)
        $my_paid_orders = $user->paidOrders()->count();
        $direct_comm = $my_paid_orders * ($pos_price * 0.15);

        // 2. Thưởng KPI cá nhân
        $kpi_bonus = 0;
        if ($my_paid_orders == 2) $kpi_bonus = 100000;
        if ($my_paid_orders >= 3) $kpi_bonus = 300000;
        // 3 & 5. Thu nhập từ F1 (Team & 5% Thu nhập)
        $team_bonus = 0;
        $f1_tax_bonus = 0;
        $f1_total_pos = 0;

        foreach ($user->f1s as $f1) {
            $f1_orders_count = $f1->paidOrders()->count();
            $f1_total_pos += $f1_orders_count;

            // Mục 3: Nếu bạn có bán (>=1), nhận 100k/mỗi máy F1 bán
            if ($my_paid_orders > 0) {
                $team_bonus += ($f1_orders_count * 100000);
            }

            // Mục 5: 5% thu nhập của F1 (Đệ quy tính thu nhập F1)
            // Lưu ý: Để tránh treo máy nếu hệ thống quá sâu, ta chỉ tính 5% trên hoa hồng trực tiếp của F1
            $f1_direct_comm = $f1_orders_count * ($pos_price * 0.15);
            $f1_tax_bonus += ($f1_direct_comm * 0.05);
        }

        // 4. Thưởng doanh thu toàn hệ thống (Cần query tổng đơn toàn web)
        // Đây là con số ước tính dựa trên % bạn đưa ra
        $system_bonus = 0;
        if ($my_paid_orders >= 3) $system_bonus = "Đang tính (5% Pool)";
        elseif ($my_paid_orders >= 2) $system_bonus = "Đang tính (3% Pool)";
        elseif ($my_paid_orders >= 1) $system_bonus = "Đang tính (2% Pool)";

        return [
            'direct' => $direct_comm,
            'kpi' => $kpi_bonus,
            'team' => $team_bonus,
            'f1_tax' => $f1_tax_bonus,
            'total' => $direct_comm + $kpi_bonus + $team_bonus + $f1_tax_bonus,
            'my_count' => $my_paid_orders,
            'f1_count' => $f1_total_pos,
            'system_share' => $system_bonus
        ];
    }
}

if (!function_exists('calculate_pos_earnings')) {
    function calculate_pos_earnings($user) {
        $price = (float) get_pos_setting('default_price', 1800000);
        $rate = (float) get_pos_setting('commission_rate', 15) / 100;
        
        // Lấy số đơn đã thanh toán trong tháng này của Sale
        $my_count = $user->paidOrders()->whereMonth('created_at', now()->month)->count();
        
        // 1. Hoa hồng trực tiếp (270k/máy)
        $direct = $my_count * ($price * $rate);

        // 2. Thưởng KPI cá nhân
        $kpi = 0;
        if ($my_count >= 3) $kpi = 300000;
        elseif ($my_count >= 2) $kpi = 100000;

        // 3. Hoa hồng cân bằng (Team F1)
        // Điều kiện: Bạn bán >= 1 máy và F1 có bán
        $team_bonus = 0;
        if ($my_count >= 1) {
            foreach ($user->f1s as $f1) {
                $f1_count = $f1->paidOrders()->whereMonth('created_at', now()->month)->count();
                $team_bonus += ($f1_count * 100000);
            }
        }

        // 4. Thưởng doanh thu hệ thống (Ước tính doanh thu toàn sàn là $total_system_sales)
        // Tạm thời để logic % cho Sale biết mục tiêu
        $sys_share_text = "Chưa đạt";
        if ($my_count >= 3) $sys_share_text = "Hưởng 5% Pool";
        elseif ($my_count >= 2) $sys_share_text = "Hưởng 3% Pool";
        elseif ($my_count >= 1) $sys_share_text = "Hưởng 2% Pool";

        // 5. 5% Thu nhập F1
        $f1_income_share = 0;
        foreach ($user->f1s as $f1) {
            $f1_direct = $f1->paidOrders()->whereMonth('created_at', now()->month)->count() * ($price * $rate);
            $f1_income_share += ($f1_direct * 0.05);
        }

        // 6. Quản lý khu vực (5% doanh số khu vực)
        $area_bonus = 0;
        // if ($user->is_area_manager) {
        //     // Giả sử tính trên tổng doanh số các shop cùng Phường/Quận với Sale này
        //     $area_sales = \App\Models\Order::where('status', 'paid')
        //         ->whereHas('shop', function($q) use ($user) {
        //             $q->where('ward', $user->ward); // Giả định user và shop có cùng cột ward
        //         })->sum('amount');
        //     $area_bonus = $area_sales * 0.05;
        // }

        return [
            'direct' => $direct,
            'kpi' => $kpi,
            'team' => $team_bonus,
            'f1_share' => $f1_income_share,
            'area' => $area_bonus,
            'sys_text' => $sys_share_text,
            'total' => $direct + $kpi + $team_bonus + $f1_income_share + $area_bonus
        ];
    }

    
}