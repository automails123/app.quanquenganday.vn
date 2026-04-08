<x-app-layout>
    <x-slot name="header">

    </x-slot>
    @php $res = auth()->user()->monthly_earnings; @endphp
    <div class="pb-12 pt-5 md:py-12 container mx-auto max-md:px-4 max-md:mb-10">
        <div class="flex justify-between items-start gap-2 md:gap-4 mb-4 md:mb-5 ">
            <div>
                <h1 class="font-bold text-base md:text-2xl">Trang chủ</h1>
                <p class="text-gray-400 text-sm md:text-base">Tổng quan hoạt động hôm nay</p>
            </div>
            <div class="flex-shrink-0 text-right">
                <p class="text-gray-400 text-sm md:text-base font-medium">Hoa hồng thu nhập tháng {{ now()->month }}</p>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mt-1 tracking-normal">
                    {{ number_format($res['total']) }} <span class="font-normal">đ</span></h1>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-xl rounded-2xl md:rounded-3xl p-3 md:p-6 lg:p-8">
            <div class="grid grid-cols-2 gap-4 lg:gap-7 mb-8">
                <a href="{{ route('sale.shops.index') }}" class="bg-gray-50 p-3 md:p-5 rounded-2xl md:rounded-3xl border border-gray-100 text-center no-underline">
                    <p class="text-lg md:text-xl font-bold text-gray-900 mb-1">{{ $countShops }}</p>
                    <p class="text-gray-500 text-xs md:text-base font-semibold">Tổng quán đã mời</p>
                </a>

                <div class="bg-gray-50 p-3 md:p-5 rounded-2xl md:rounded-3xl border border-gray-100 text-center">
                    <p class="text-lg md:text-xl font-bold text-gray-900 mb-1">{{ $countSalesF1 }}</p>
                    <p class="text-gray-500 text-xs md:text-base font-semibold">Tổng sale đã mời</p>

                </div>

                <div class="bg-gray-50 p-3 md:p-5 rounded-2xl md:rounded-3xl border border-gray-100 text-center">
                    <p class="text-lg md:text-xl font-bold text-gray-900 mb-1">{{ $posThisMonth }} </p>
                    <p class="text-gray-500 text-xs md:text-base font-semibold">POS tháng này</p>
                </div>

                <div class="bg-gray-50 p-3 md:p-5 rounded-2xl md:rounded-3xl border border-gray-100 text-center">
                    <p class="text-lg md:text-xl font-bold text-gray-900 mb-1">{{ $activeShops }}</p>
                    <p class="text-gray-500 text-xs md:text-base font-semibold">Quán Active</p>
                </div>
            </div>

            <div class="">
                <div class="flex justify-between items-center mb-3 md:mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Top thu nhập</h3>
                    <span class="text-xs text-gray-400">Cập nhật theo tháng</span>
                </div>

                <div class="space-y-4 md:space-y-6">
                    @foreach ($topSales as $index => $top)
                        @php
                            // Thiết lập màu sắc dựa trên thứ hạng
                            $bgClass = 'bg-gray-50'; // Mặc định cho các hạng còn lại
                            $textRankClass = 'text-gray-300';
                            $iconBg = 'bg-white';
                            $icon = '#' .$index + 1 ;
                            $lbl = 'Ổn định';

                            if ($index == 0) {
                                // Top 1 - Vàng
                                $bgClass = 'bg-yellow-100 border border-yellow-200';
                                $textRankClass = 'text-yellow-600';
                                $iconBg = 'bg-yellow-200';
                                $icon = '<svg class="w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ff4949" viewBox="0 0 256 256"><path d="M232,64H208V48a8,8,0,0,0-8-8H56a8,8,0,0,0-8,8V64H24A16,16,0,0,0,8,80V96a40,40,0,0,0,40,40h3.65A80.13,80.13,0,0,0,120,191.61V216H96a8,8,0,0,0,0,16h64a8,8,0,0,0,0-16H136V191.58c31.94-3.23,58.44-25.64,68.08-55.58H208a40,40,0,0,0,40-40V80A16,16,0,0,0,232,64ZM48,120A24,24,0,0,1,24,96V80H48v32q0,4,.39,8Zm144-8.9c0,35.52-29,64.64-64,64.9a64,64,0,0,1-64-64V56H192ZM232,96a24,24,0,0,1-24,24h-.5a81.81,81.81,0,0,0,.5-8.9V80h24Z"></path></svg>';
                                $lbl = 'Top POS tháng';

                            } elseif ($index == 1) {
                                // Top 2 - Bạc
                                $bgClass = 'bg-slate-100 border border-slate-200';
                                $textRankClass = 'text-slate-500';
                                $iconBg = 'bg-slate-200';
                                $icon = '<svg class="w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M207,40H49A17,17,0,0,0,32,57v49.21a17,17,0,0,0,10,15.47l62.6,28.45a48,48,0,1,0,46.88,0L214,121.68a17,17,0,0,0,10-15.47V57A17,17,0,0,0,207,40ZM160,56v72.67l-32,14.54L96,128.67V56ZM48,106.21V57a1,1,0,0,1,1-1H80v65.39L48.59,107.12A1,1,0,0,1,48,106.21ZM128,224a32,32,0,1,1,32-32A32,32,0,0,1,128,224Zm80-117.79a1,1,0,0,1-.59.91L176,121.39V56h31a1,1,0,0,1,1,1Z"></path></svg>';
                                $lbl = 'Team mạnh';
                            } elseif ($index == 2) {
                                // Top 3 - Đồng
                                $bgClass = 'bg-orange-100 border border-orange-200';
                                $textRankClass = 'text-orange-600';
                                $iconBg = 'bg-orange-200';
                                $icon = '<svg class="w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M216,96A88,88,0,1,0,72,163.83V240a8,8,0,0,0,11.58,7.16L128,225l44.43,22.21A8.07,8.07,0,0,0,176,248a8,8,0,0,0,8-8V163.83A87.85,87.85,0,0,0,216,96ZM56,96a72,72,0,1,1,72,72A72.08,72.08,0,0,1,56,96ZM168,227.06l-36.43-18.21a8,8,0,0,0-7.16,0L88,227.06V174.37a87.89,87.89,0,0,0,80,0ZM128,152A56,56,0,1,0,72,96,56.06,56.06,0,0,0,128,152Zm0-96A40,40,0,1,1,88,96,40,40,0,0,1,128,56Z"></path></svg>';
                                $lbl = 'KPI vượt chuẩn';
                            }
                        @endphp
                        <div class="flex items-center justify-between p-2 {{ $bgClass }} rounded-lg md:rounded-xl flex-wrap">
                            <div class="flex items-center gap-3 md:gap-4">
                                <div class="w-9 h-9 md:w-12 md:h-12 rounded-2xl {{ $iconBg }} flex items-center justify-center text-black font-bold text-base flex-shrink-0">
                                    {!! $icon !!}

                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm md:text-base capitalize">{{ $top->name }}</p>
                                    <p class="text-xs md:text-sm text-gray-500 mt-0.5">
                                        {{ $lbl }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right flex-1">
                                <p class="font-bold text-gray-900 text-sm md:text-lg">
                                    {{ number_format($top->total_income ?? 0) }}đ</p>
                                    <p class="text-xs md:text-sm text-gray-500">/ tháng</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
