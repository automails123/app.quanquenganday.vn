<x-app-layout>
    <div class="px-4 pt-4 pb-20 md:py-12 container mx-auto min-h-screen">
        <div class="max-lg:px-4 mb-4 md:mb-6 flex items-center justify-between gap-1">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Danh sách đơn hàng user gửi&nbsp;lên</h1>
                <p class="text-xs md:text-sm text-gray-500">Xem toàn bộ đơn hàng do sale/user tạo và trạng&nbsp;thái xử lý</p>
            </div>
            <span class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                    <path
                        d="M213.66,66.34l-40-40A8,8,0,0,0,168,24H88A16,16,0,0,0,72,40V56H56A16,16,0,0,0,40,72V216a16,16,0,0,0,16,16H168a16,16,0,0,0,16-16V200h16a16,16,0,0,0,16-16V72A8,8,0,0,0,213.66,66.34ZM168,216H56V72h76.69L168,107.31v84.53c0,.06,0,.11,0,.16s0,.1,0,.16V216Zm32-32H184V104a8,8,0,0,0-2.34-5.66l-40-40A8,8,0,0,0,136,56H88V40h76.69L200,75.31Zm-56-32a8,8,0,0,1-8,8H88a8,8,0,0,1,0-16h48A8,8,0,0,1,144,152Zm0,32a8,8,0,0,1-8,8H88a8,8,0,0,1,0-16h48A8,8,0,0,1,144,184Z">
                    </path>
                </svg>
            </span>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($orders as $order)
                <div class="bg-white p-3 md:p-6 rounded-xl md:rounded-3xl shadow-sm border border-gray-50 relative">                    
                    <div class="space-y-3 md:space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-400 font-medium text-sm">Mã đơn</span>
                            <span class="font-bold text-gray-800 text-sm">{{ $order->order_code }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400 font-medium text-sm">User gửi</span>
                            <span class="font-bold text-gray-800 text-sm">{{ $order->sale->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400 font-medium text-sm">Quán</span>
                            <span class="font-bold text-gray-800 text-sm">{{ $order->shop->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400 font-medium text-sm">Số tiền</span>
                            <span class="font-bold text-gray-900 text-sm">{{ number_format($order->amount) }}đ</span>
                        </div>
                        @php
                            $statusStyle = match($order->status) {
                                'completed' => ['label' => 'Đã hoàn thành', 'class' => 'text-green-600 bg-green-50 border-green-100'],
                                'paid'      => ['label' => 'Đã thanh toán', 'class' => 'text-blue-600 bg-blue-50 border-blue-100'],
                                'pending'   => ['label' => 'Đang xử lý', 'class' => 'text-orange-600 bg-orange-50 border-orange-100'],
                                'rejected'  => ['label' => 'Đã từ chối', 'class' => 'text-red-600 bg-red-50 border-red-100'],
                                default     => ['label' => 'Không xác định', 'class' => 'text-gray-600 bg-gray-50 border-gray-100'],
                            };
                        @endphp
                        <div class="flex justify-between">
                            <span class="text-gray-400 font-medium text-sm">Trạng thái</span>
                            <span
                                class="font-bold px-2 py-1 text-xs rounded-full {{ $order->status_color }}">
                                {{ $order->status_label }}
                            </span>
                        </div>
                    </div>

                    @if ($order->status == 'pending')
                        <div class="mt-8 flex gap-3">
                            <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button
                                    class="w-full py-2.5 text-xs bg-gray-100 text-gray-600 rounded-2xl font-bold hover:bg-gray-200 transition">Từ
                                    chối</button>
                            </form>
                            <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST"
                                class="flex-1">
                                @csrf
                                <button
                                    class="w-full py-2.5 bg-black text-white rounded-2xl text-xs font-bold hover:bg-gray-800 transition">Duyệt
                                    thanh toán</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-6 md:mt-8 ">
            {{ $orders->links() }}
        </div>
    </div>
</x-app-layout>
