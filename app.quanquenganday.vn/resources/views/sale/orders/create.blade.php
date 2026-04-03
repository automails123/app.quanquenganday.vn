<x-app-layout>
    {{-- <x-slot name="header">

    </x-slot> --}}

    <div class="md:py-12 container mx-auto max-md:mb-10 min-h-screen">
        <div class="bg-white overflow-hidden shadow-xl round-2xl md:rounded-2xl pt-4 pb-12 px-4 md:p-5 lg:p-7 ">
            <div class="flex items-start mb-4 md:mb-6">
                <a href="javascript:history.back()"
                    class="p-1 bg-gray-100 border rounded-full flex-shrink-0 flex items-center justify-center w-10 h-10 md:w-12 md:h-12 hover:opacity-75">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5 md:h-5 md:w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div class="ml-4">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Tạo đơn POS</h1>
                    <p class="text-xs text-gray-500 font-medium">Sale tạo đơn, web tự nhập giá POS</p>
                </div>
            </div>

            <form action="{{ route('sale.orders.store') }}" method="POST" class="px-6">
                @csrf
                <div class="md:grid md:grid-cols-12 mb-4 md:gap-8 lg:gap-12">
                    <div class="md:col-span-6 space-y-6">
                        <div
                            class="flex justify-between items-center bg-white p-5 rounded-[1.5rem] border border-gray-50 shadow-sm">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Sản phẩm áp dụng
                                </p>
                                <h2 class="text-lg md:text-xl font-extrabold text-gray-800">Phần mềm POS</h2>
                            </div>
                            <span
                                class="bg-black text-white text-xs font-bold px-3 py-2 md:px-5 rounded-full uppercase tracking-tighter">POS001</span>
                        </div>

                        <div>
                            <label for="shop_id" class="label-custom text-sm text-gray-600 font-semibold">Chọn
                                quán</label>
                            <div class="input-group mt-1 relative">
                                <svg class="absolute top-1/2 -translate-y-1/2 left-2.5 w-5 h-5 text-gray-500"
                                    xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96h0v16a40,40,0,0,0,16,32v72a8,8,0,0,0,8,8H208a8,8,0,0,0,8-8V144a40,40,0,0,0,16-32V96ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-35.12,21.26,7.88,7.88,0,0,0-1.82-1.06A24,24,0,0,1,40,112v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm4.93-75.8a8.08,8.08,0,0,0-1.8,1.05A24,24,0,0,1,168,112v-8h48v8A24,24,0,0,1,204.93,132.2Z">
                                    </path>
                                </svg>
                                <select id="shop_id" name="shop_id" required
                                    class="w-full pl-9 pr-4 py-3 text-sm text-gray-500 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 rounded-2xl shadow-sm border border-gray-200">
                                    <option value="">Chọn quán đối tác</option>
                                    @foreach ($shops as $shop)
                                        <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="price_input_2" class="label-custom text-sm text-gray-600 font-semibold">Giá sản phẩm</label>
                            <div class="input-group mt-1 relative">
                                <svg class="absolute top-1/2 -translate-y-1/2 left-2.5 w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M224,48H32A16,16,0,0,0,16,64V192a16,16,0,0,0,16,16H224a16,16,0,0,0,16-16V64A16,16,0,0,0,224,48Zm0,16V88H32V64Zm0,128H32V104H224v88Zm-16-24a8,8,0,0,1-8,8H168a8,8,0,0,1,0-16h32A8,8,0,0,1,208,168Zm-64,0a8,8,0,0,1-8,8H120a8,8,0,0,1,0-16h16A8,8,0,0,1,144,168Z"></path></svg>
                                <input type="text" id="price_input_2"
                                    value="{{ number_format($defaultPrice, 0, ',', '.') }}đ / năm" readonly
                                    class="w-full pl-9 pr-4 py-3 text-sm text-gray-500 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 rounded-2xl shadow-sm border border-gray-200">
                                <input name="price_input" type="hidden" id="price_input" value="{{ $defaultPrice }}"
                                    readonly>
                            </div>
                        </div>

                        <div>
                            <label for="cycle_2" class="label-custom text-sm text-gray-600 font-semibold">Chu
                                kỳ</label>
                            <div class="input-group mt-1 relative">
                                <svg class="absolute top-1/2 -translate-y-1/2 left-2.5 w-5 h-5 text-gray-500"
                                    xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Zm-68-76a12,12,0,1,1-12-12A12,12,0,0,1,140,132Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,184,132ZM96,172a12,12,0,1,1-12-12A12,12,0,0,1,96,172Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,140,172Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,184,172Z">
                                    </path>
                                </svg>
                                <input type="text" id="cycle_2" value="1 năm" readonly
                                    class="w-full pl-9 pr-4 py-3 text-sm text-gray-500 placeholder:text-gray-400 focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 rounded-2xl shadow-sm border border-gray-200">
                                <input name="cycle" type="hidden" id="cycle" value="1">
                            </div>
                        </div>

                        <div>
                            <label for="cycle_2" class="label-custom text-sm text-gray-600 font-semibold">Thành tiền</label>
                            <div class="input-group mt-1 relative">
                                <svg class="absolute top-1/2 -translate-y-1/2 left-2.5 w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm40-68a28,28,0,0,1-28,28h-4v8a8,8,0,0,1-16,0v-8H104a8,8,0,0,1,0-16h36a12,12,0,0,0,0-24H116a28,28,0,0,1,0-56h4V72a8,8,0,0,1,16,0v8h16a8,8,0,0,1,0,16H116a12,12,0,0,0,0,24h24A28,28,0,0,1,168,148Z"></path></svg>
                                <input name="total_display" type="text" id="total_display" value="1 năm" readonly
                                    class="w-full pl-9 pr-4 py-3 font-bold text-sm text-black focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 rounded-2xl shadow-sm border border-gray-200">
                                <input name="cycle" type="hidden" id="cycle" value="1">
                                <input type="hidden" name="amount" id="amount_hidden">
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-6">
                        <div class="bg-white border border-gray-100 rounded-[2.2rem] p-7 shadow-sm">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <p class="text-gray-400 text-[11px] font-bold uppercase">Hoa hồng dự kiến</p>
                                    <h3 class="text-2xl font-black text-gray-900 mt-1" id="comm_main">0đ</h3>
                                </div>
                                <p class="text-xs text-gray-400 font-bold text-right leading-tight">Tự tính theo<br>chính sách POS</p>
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
                                    <span id="kpi_status"
                                        class="text-xs font-black uppercase tracking-tighter italic">
                                        Đang tính...
                                    </span>

                                </div>
                                @if (Auth::user()->is_area_manager)
                                    <div
                                        class="flex justify-between items-center pt-3 mt-2 border-t border-dashed border-gray-100">
                                        <span class="text-xs font-bold text-green-600 uppercase">Quản lý khu vực</span>
                                        <span class="text-xs font-bold text-green-600">+ 5% Vùng</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-black text-white rounded-[1.5rem] py-5 font-black text-sm uppercase tracking-[0.2em] shadow-xl active:scale-95 transition-transform">
                    Tạo đơn POS
                </button>
            </form>
            {{-- </div> --}}

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
                        kpiStatus.className = "text-xs font-black uppercase tracking-tighter italic text-orange-500";
                    } else {
                        kpiStatus.innerText = message;
                        kpiStatus.className = "text-xs font-black uppercase tracking-tighter italic text-gray-400";
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
