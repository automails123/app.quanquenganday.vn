<x-app-layout>
    {{-- <x-slot name="header">

    </x-slot> --}}

    <div class="py-12 container mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="max-w-md mx-auto min-h-screen">
                <div class="p-6 flex items-center gap-4">
                    <a href="javascript:history.back()"
                        class="w-10 h-10 rounded-full border border-gray-100 flex items-center justify-center text-gray-900 shadow-sm bg-white">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <div>
                        <h1 class="text-xl font-extrabold text-gray-900">Tạo đơn POS</h1>
                        <p class="text-[11px] text-gray-400 font-medium">Sale tạo đơn, web tự nhập giá POS</p>
                    </div>
                </div>

                <form action="{{ route('sale.orders.store') }}" method="POST" class="px-6 space-y-6">
                    @csrf

                    <div
                        class="flex justify-between items-center bg-white p-5 rounded-[1.5rem] border border-gray-50 shadow-sm">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Sản phẩm áp dụng</p>
                            <h2 class="text-lg font-extrabold text-gray-800">Phần mềm POS</h2>
                        </div>
                        <span
                            class="bg-black text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-tighter">POS001</span>
                    </div>

                    <div>
                        <label class="label-custom">Chọn quán</label>
                        <div class="input-group">
                            <i class="fa-solid fa-store text-gray-400 text-sm"></i>
                            <select name="shop_id" required>
                                <option value="">Chọn quán đối tác...</option>
                                @foreach ($shops as $shop)
                                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="label-custom">Giá sản phẩm</label>
                        <div class="input-group">
                            <i class="fa-solid fa-credit-card text-gray-400 text-sm"></i>
                            <input type="number" id="price_input" value="{{ $defaultPrice }}" class="text-gray-800">
                            <span class="text-[11px] text-gray-400 font-bold">/ năm</span>
                        </div>
                    </div>

                    <div>
                        <label class="label-custom">Chu kỳ</label>
                        <div class="input-group">
                            <i class="fa-solid fa-calendar-days text-gray-400 text-sm"></i>
                            <select id="cycle" name="cycle">
                                <option value="1">1 năm</option>
                                <option value="2">2 năm</option>
                                <option value="3">3 năm</option>
                                <option value="4">4 năm</option>
                                <option value="5">5 năm</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="label-custom">Thành tiền</label>
                        <div class="input-group bg-gray-100 border-none">
                            <i class="fa-solid fa-coins text-gray-400 text-sm"></i>
                            <input type="text" id="total_display" readonly class="text-xl font-black text-gray-900">
                            <input type="hidden" name="amount" id="amount_hidden">
                        </div>
                    </div>

                    <div class="bg-white border border-gray-100 rounded-[2.2rem] p-7 shadow-sm">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <p class="text-gray-400 text-[11px] font-bold uppercase">Hoa hồng dự kiến</p>
                                <h3 class="text-2xl font-black text-gray-900 mt-1" id="comm_main">0đ</h3>
                            </div>
                            <p class="text-[9px] text-gray-400 font-bold text-right leading-tight uppercase">Tự tính
                                theo<br>chính sách POS</p>
                        </div>

                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-semibold text-gray-500">Giá POS</span>
                                <span class="text-sm font-extrabold text-gray-800" id="detail_price">0đ</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-semibold text-gray-500">Hoa hồng trực tiếp
                                    ({{ get_pos_setting('commission_rate', 15) }}%)</span>
                                <span class="text-sm font-extrabold text-gray-800" id="detail_comm">0đ</span>
                            </div>
                            <div class="flex justify-between items-center pt-2 border-t border-dashed">
                                <span class="text-xs font-semibold text-gray-500">KPI tháng</span>
                                <span id="kpi_status" class="text-[10px] font-black uppercase tracking-tighter italic">
                                    Đang tính...
                                </span>

                            </div>
                            @if (Auth::user()->is_area_manager)
                                <div
                                    class="flex justify-between items-center pt-3 mt-2 border-t border-dashed border-gray-100">
                                    <span class="text-xs font-bold text-green-600 uppercase">6. Quản lý khu vực</span>
                                    <span class="text-xs font-bold text-green-600">+ 5% Vùng</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-black text-white rounded-[1.5rem] py-5 font-black text-sm uppercase tracking-[0.2em] shadow-xl active:scale-95 transition-transform">
                        Tạo đơn POS
                    </button>
                </form>
            </div>

            <script>
                const priceInput = document.getElementById('price_input');
                const cycleSelect = document.getElementById('cycle');
                const totalDisplay = document.getElementById('total_display');
                const amountHidden = document.getElementById('amount_hidden');

                const commMain = document.getElementById('comm_main');
                const detailPrice = document.getElementById('detail_price');
                const detailComm = document.getElementById('detail_comm');

                const RATE = {{ get_pos_setting('commission_rate', 15) }} / 100;

                 //kpi
                const currentOrders = {{ $currentMonthOrders }};
                const kpiStatus = document.getElementById('kpi_status');

                function updateCalculations() {
                    let price = parseInt(priceInput.value) || 0;
                    let cycle = parseInt(cycleSelect.value) || 1;

                    // Tính toán hoa hồng: 1.800.000 * 0.15 = 270.000
                    let total = price * cycle;
                    let commission = Math.floor(price * 0.15); // 15%

                    // Format tiền VNĐ
                    let fmtTotal = new Intl.NumberFormat('vi-VN').format(total) + 'đ';
                    let fmtPrice = new Intl.NumberFormat('vi-VN').format(price) + 'đ';
                    let fmtComm = new Intl.NumberFormat('vi-VN').format(commission) + 'đ';

                    totalDisplay.value = fmtTotal;
                    amountHidden.value = total;

                    commMain.innerText = fmtComm;
                    detailPrice.innerText = fmtPrice;
                    detailComm.innerText = fmtComm;

                    // LOGIC TÍNH KPI DỰ KIẾN
                    // Tổng đơn = Đơn cũ + 1 (đơn đang tạo này)
                    let totalOrdersIfFinished = currentOrders + 1;
                    let kpiBonus = 0;
                    let message = "";

                    if (totalOrdersIfFinished >= 3) {
                        kpiBonus = 300000;
                        message = "+ 300.000đ";
                    } else if (totalOrdersIfFinished >= 2) {
                        kpiBonus = 100000;
                        message = "+ 100.000đ";
                    } else {
                        message = "Cần thêm " + (2 - totalOrdersIfFinished) + " đơn để nhận 100k";
                    }

                    // Hiển thị màu sắc cho sinh động
                    if (kpiBonus > 0) {
                        kpiStatus.innerText = message;
                        kpiStatus.className = "text-[10px] font-black uppercase tracking-tighter italic text-orange-500";
                    } else {
                        kpiStatus.innerText = message;
                        kpiStatus.className = "text-[10px] font-black uppercase tracking-tighter italic text-gray-400";
                    }
                }

                priceInput.addEventListener('input', updateCalculations);
                cycleSelect.addEventListener('change', updateCalculations);

                // Chạy lần đầu khi load trang
                updateCalculations();               

            </script>
        </div>
    </div>
</x-app-layout>
