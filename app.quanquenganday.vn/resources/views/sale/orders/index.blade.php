<x-app-layout>
    {{-- <x-slot name="header">

    </x-slot> --}}

    <div class="md:py-12 container mx-auto max-md:mb-10 min-h-screen">
        <div class="bg-white overflow-hidden shadow-xl round-2xl md:rounded-2xl p-4 md:p-5 lg:p-7">
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
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Quản lý đơn hàng</h1>
                    <p class="text-xs md:text-sm text-gray-500 font-medium">Theo dõi các đơn hàng do sale tạo</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl md:rounded-[2.5rem] p-4 md:p-6 shadow-sm border border-gray-100 mb-6 md:mb-10">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <p class="text-gray-400 font-bold text-base mb-1">Tổng quan đơn hàng</p>
                        <h2 class="text-2xl md:text-3xl font-black text-gray-900">{{ $totalOrders }} <span
                                class="text-sm md:text-base text-gray-500">đơn</span></h2>
                    </div>
                    <div class="bg-black p-2 md:p-3 rounded-2xl shadow-lg text-white">
                        <svg class="w-4 h-4 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="currentColor" viewBox="0 0 256 256">
                            <path
                                d="M216,40H40A16,16,0,0,0,24,56V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A16,16,0,0,0,216,40Zm0,16V72H40V56Zm0,144H40V88H216V200Zm-40-88a48,48,0,0,1-96,0,8,8,0,0,1,16,0,32,32,0,0,0,64,0,8,8,0,0,1,16,0Z">
                            </path>
                        </svg>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 md:gap-6 lg:gap-8">
                    <div class="bg-gray-50 p-4 md:px-6 rounded-2xl md:rounded-[2rem]">
                        <p class="text-gray-500 text-sm font-bold mb-1">Đang xử lý</p>
                        <p class="text-xl font-black text-gray-900">{{ $pendingOrders }} <span class="text-sm">đơn</span></p>
                        <p class="text-xs text-gray-400 mt-1 font-medium leading-tight">Chờ xác nhận / chờ thanh
                            toán</p>
                    </div>

                    <div class="bg-gray-50 p-4 md:px-6 rounded-2xl md:rounded-[2rem]">
                        <p class="text-gray-500 text-sm font-bold mb-1">Đã thanh toán</p>
                        <p class="text-xl font-black text-gray-900">{{ $paidOrders }} <span class="text-sm">đơn</span></p>
                        <p class="text-xs text-gray-400 mt-1 font-medium leading-tight">Đã hoàn tất thanh toán
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 md:px-6 rounded-2xl md:rounded-[2rem]">
                        <p class="text-gray-500 text-sm font-bold mb-1">Doanh số đơn</p>
                        <p class="text-lg font-black text-gray-900">{{ number_format($totalRevenue) }}đ</p>
                        <p class="text-xs text-gray-400 mt-1 font-medium italic">{{ $totalOrders }} đơn POS</p>
                    </div>

                    <div class="bg-gray-50 p-4 md:px-6 rounded-2xl md:rounded-[2rem]">
                        <p class="text-gray-500 text-sm font-bold mb-1">Hoa hồng dự kiến</p>
                        <p class="text-lg font-black text-gray-900">{{ number_format($expectedCommission) }}đ</p>
                        <p class="text-xs text-gray-400 mt-1 font-medium italic">Theo chính sách POS</p>
                    </div>
                </div>
            </div>

            <div class="mb-6 md:mb-4">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-black text-gray-900">Bộ lọc trạng thái</h3>
                        <p class="text-sm text-gray-500">Giúp quản lý kiểm tra nhanh đơn cần xử lý</p>
                    </div>
                    <span class="text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                    </span>
                </div>


                <div class="flex gap-4 md:gap-7 mb-6">
                    <button onclick="filterOrders('pending', this)"
                        class="filter-btn flex-1 py-4 bg-yellow-50 text-orange-500 rounded-2xl font-bold ring-orange-400">
                        Đang xử lý
                    </button>
                    <button onclick="filterOrders('paid', this)"
                        class="filter-btn flex-1 py-4 bg-emerald-50 text-emerald-500 rounded-2xl font-bold ring-green-500">
                        Đã thanh toán
                    </button>
                </div>

                <div id="order-list-container">
                    <div id="order-list">
                        <div class="text-center py-5 md:py-8">
                            <p class="text-gray-400 text-sm font-medium italic">Vui lòng chọn trạng thái để xem danh
                                sách đơn&nbsp;hàng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function filterOrders(status, element) {
                // 1. Hiệu ứng loading đơn giản
                const container = document.getElementById('order-list');

                // 2. Gọi Fetch API
                fetch(`{{ route('sale.orders.index') }}?status=${status}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        container.innerHTML = html;
                        container.style.opacity = '1';

                        // 3. Cập nhật UI nút bấm (Active state)
                        document.querySelectorAll('.filter-btn').forEach(btn => {
                            btn.classList.remove('ring-2', 'ring-orange-500');
                        });
                        element.classList.add('ring-2', 'ring-orange-500');
                    })
                    .catch(error => console.warn('Lỗi fetch:', error));
            }
        </script>
    </div>
</x-app-layout>
