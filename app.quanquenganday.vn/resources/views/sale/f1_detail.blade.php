<x-sale-layout>
    <div class="md:py-12 container mx-auto max-md:mb-10 min-h-screen">
        <div class="bg-white overflow-hidden shadow-xl round-2xl md:rounded-2xl p-4 md:p-5 lg:p-7">
            <div class="flex items-center mb-4 md:mb-6 w-full">
                <a href="javascript:history.back()"
                    class="p-1 bg-gray-100 border rounded-full flex-shrink-0 flex items-center justify-center w-10 h-10 md:w-12 md:h-12 hover:opacity-75">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5 md:h-5 md:w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div class="ml-4">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Sale đã mời</h1>
                </div>
            </div>


            <div class="relative z-10 px-6 mb-8">
                <div class="bg-white rounded-3xl p-6 shadow-xl shadow-gray-100 border border-gray-50 ">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 md:w-20 md:h-20 bg-black rounded-2xl flex items-center justify-center text-white shrink-0">
                            <svg class="h-6 w-5 md:h-10 md:w-10" xmlns="http://www.w3.org/2000/svg" width="32"
                                height="32" fill="currentColor" viewBox="0 0 256 256">
                                <path
                                    d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex items-center gap-2 flex-1 justify-between">
                            <div class="flex flex-col gap-2">
                                <h2 class="text-2xl font-black text-gray-900 leading-tight capitalize">
                                    {{ $f1->name }}
                                </h2>
                                <div class="flex flex-col mt-1">
                                    <p class="text-xs md:text-sm text-gray-400 font-bold capitalize tracking-tighter">Mã
                                        sale:
                                        {{ $f1->affiliate_id }}</p>
                                    <p class="text-xs md:text-sm text-gray-400 font-medium">Thuộc hệ thống F1 của bạn
                                    </p>
                                </div>
                            </div>
                            <div class="ml-auto">
                                <span
                                    class="px-3 py-1 bg-blue-50 text-blue-500 rounded-full text-xs md:text-sm font-bold border border-blue-100 uppercase tracking-wider">
                                    {{ $f1->status_label }}
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="mt-4 flex gap-3">
                        <p class="text-sm md:text-base font-bold text-red-500 capitalize">
                            Quán đã mời: {{ $f1->shops_count ?? 0 }}
                        </p>
                        <span class="text-red-300">-</span>
                        <p class="text-sm md:text-base font-bold text-red-500 capitalize">
                            Sale đã mời: {{ $f1->f1s_count ?? 0 }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="relative z-10 px-6 space-y-4">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-black text-gray-800">Tổng quan thu nhập</h3>
                    <i class="fas fa-chart-line text-gray-300"></i>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-5 rounded-[2rem] border border-gray-100">
                        <p class="text-xs md:text-sm text-gray-400 font-bold uppercase mb-2">Tổng thu nhập 3 tháng</p>
                        <p class="text-lg font-black text-gray-900 leading-none">
                            ss {{-- {{ number_format($earnings['total'] * 2.5) }}đ Giả lập số liệu --}}
                        </p>
                        <p class="text-xs md:text-sm text-gray-400 mt-2 italic font-medium">Cộng dồn 3 tháng gần nhất
                        </p>
                    </div>

                    <div class="bg-gray-50 p-5 rounded-[2rem] border border-gray-100">
                        <p class="text-xs md:text-sm text-gray-400 font-bold uppercase mb-2">Thu nhập tháng gần nhất</p>
                        <p class="text-lg font-black text-gray-900 leading-none">
                            {{-- {{ number_format($earnings['total']) }}đ</p> --}}
                        <p class="text-xs md:text-sm text-gray-400 mt-2 font-medium">{{ now()->format('m/Y') }}</p>
                    </div>

                    <div class="bg-gray-50 p-5 rounded-[2rem] border border-gray-100">
                        <p class="text-xs md:text-sm text-gray-400 font-bold uppercase mb-2">Tổng POS đã bán</p>
                        {{-- <p class="text-lg font-black text-gray-900 leading-none">{{ $earnings['my_count'] }} POS</p> --}}
                        <p class="text-xs md:text-sm text-gray-400 mt-2 italic font-medium">3 tháng gần nhất</p>
                    </div>

                    <div class="bg-gray-50 p-5 rounded-[2rem] border border-gray-100">
                        <p class="text-xs md:text-sm text-gray-400 font-bold uppercase mb-2 leading-tight">Hoa hồng bạn
                            được
                            hưởng</p>
                        <p class="text-lg font-black text-emerald-600 leading-none">
                            {{-- {{ number_format($earnings['f1_share']) }}đ</p> --}}
                        <p class="text-xs md:text-sm text-gray-400 mt-2 italic font-medium">5% từ thu nhập F1</p>
                    </div>
                </div>
            </div>

            <div class="relative z-10 px-6 mt-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-black text-gray-800">Thu nhập từng tháng</h3>
                    <i class="far fa-calendar-alt text-gray-300"></i>
                </div>

                <div class="bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm shadow-gray-100 mb-4">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h4 class="font-black text-gray-800">Thu nhập tháng {{ now()->format('m/Y') }}</h4>
                            <p class="text-xs md:text-sm text-gray-400 font-bold uppercase tracking-widest">Trạng thái:
                                <span class="text-amber-500">Đã chốt tháng</span>
                            </p>
                        </div>
                        {{-- <p class="text-lg font-black text-gray-900">{{ number_format($earnings['total']) }}đ</p> --}}
                    </div>

                    <div class="space-y-3 border-t border-dashed border-gray-100 pt-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400 font-medium">POS trực tiếp</span>
                            {{-- <span class="font-black text-gray-700">{{ number_format($earnings['direct']) }}đ</span> --}}
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400 font-medium">Thưởng KPI</span>
                            {{-- <span class="font-black text-gray-700">{{ number_format($earnings['kpi']) }}đ</span> --}}
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400 font-medium">Hoa hồng team</span>
                            {{-- <span class="font-black text-gray-700">{{ number_format($earnings['team']) }}đ</span> --}}
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400 font-medium">Thu nhập từ F1</span>
                            {{-- <span class="font-black text-gray-700">{{ number_format($earnings['f1_share']) }}đ</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-sale-layout>
