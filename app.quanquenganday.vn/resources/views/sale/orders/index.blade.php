<x-app-layout>
    {{-- <x-slot name="header">

    </x-slot> --}}

    <div class="py-12 container mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="max-w-md mx-auto bg-white min-h-screen">
                <div class="p-6 flex items-center gap-4">
                    <a href="{{ route('sale.dashboard') }}"
                        class="w-10 h-10 rounded-full border border-gray-100 flex items-center justify-center shadow-sm">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <h1 class="text-xl font-bold">Quản lý đơn hàng</h1>
                </div>

                <div class="px-6 mb-6">
                    <div class="bg-gray-50 rounded-[2.5rem] p-6 border border-gray-100 shadow-sm">
                        <p class="text-xs text-gray-400 font-bold uppercase mb-4">Tổng quan đơn hàng</p>
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Đang xử lý</p>
                                <p class="text-lg font-black">{{ $stats['pending_count'] }} đơn</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Đã thanh toán</p>
                                <p class="text-lg font-black text-green-600">{{ $stats['paid_count'] }} đơn</p>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 pt-4 flex justify-between">
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase font-bold">Doanh số đơn</p>
                                <p class="font-bold text-gray-800">{{ number_format($stats['total_amount']) }}đ</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-gray-400 uppercase font-bold">Hoa hồng dự kiến</p>
                                <p class="font-bold text-orange-500">{{ number_format($stats['total_commission']) }}đ
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-6 space-y-4 pb-20">
                    @foreach ($orders as $order)
                        <div class="bg-white border border-gray-100 rounded-[2rem] p-5 shadow-sm">
                            <div class="flex justify-between items-center mb-4">
                                <span
                                    class="text-xs font-black text-gray-400 uppercase tracking-widest">{{ $order->order_code }}</span>
                                <span
                                    class="px-3 py-1 rounded-full text-[10px] font-bold {{ $order->status == 'paid' ? 'bg-green-100 text-green-600' : 'bg-orange-100 text-orange-500' }}">
                                    {{ $order->status == 'paid' ? 'Đã thanh toán' : 'Đang xử lý' }}
                                </span>
                            </div>

                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400">
                                    <i class="fa-solid fa-shop"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ $order->shop->name }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium">
                                        {{ $order->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>

                            <div class="flex justify-between items-end border-t border-dashed pt-4">
                                <div>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase">Giá trị đơn</p>
                                    <p class="font-extrabold text-gray-900">{{ number_format($order->amount) }}đ</p>
                                </div>
                                <button
                                    class="text-xs font-bold text-gray-400 border border-gray-200 px-4 py-2 rounded-xl">Chi
                                    tiết</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
