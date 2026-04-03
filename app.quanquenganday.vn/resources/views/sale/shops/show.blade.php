<x-sale-layout>
    <div class="p-4 md:p-5 max-w-xl mx-auto bg-[#F8F9FA] min-h-screen pb-20">

        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('sale.shops.index') }}"
                class="w-9 md:w-10 h-9 md:h-10 flex-shrink-0 bg-white rounded-full flex items-center justify-center shadow-sm">
                <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" stroke-width="2.5" />
                </svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-gray-900">Chi tiết quản lý quán</h1>
                <p class="text-xs text-gray-400">Quản lý kiểm tra và sale bổ sung hồ sơ quán</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl md:rounded-3xl p-4 md:p-6 shadow-sm mb-4 md:mb-6 flex items-center gap-4">
            <div class="w-12 h-12 md:w-16 md:h-16 bg-black rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 md:w-8 md:h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="32"
                    height="32" fill="currentColor" viewBox="0 0 256 256">
                    <path
                        d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96h0v16a40,40,0,0,0,16,32v72a8,8,0,0,0,8,8H208a8,8,0,0,0,8-8V144a40,40,0,0,0,16-32V96ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-35.12,21.26,7.88,7.88,0,0,0-1.82-1.06A24,24,0,0,1,40,112v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm4.93-75.8a8.08,8.08,0,0,0-1.8,1.05A24,24,0,0,1,168,112v-8h48v8A24,24,0,0,1,204.93,132.2Z">
                    </path>
                </svg>
            </div>
            <div>
                <h2 class="text-lg md:text-xl font-bold text-gray-900 capitalize">{{ $shop->name }}</h2>
                <p class="text-xs md:text-sm text-gray-400 font-medium">Mã quán:
                    SHOP{{ str_pad($shop->id, 3, '0', STR_PAD_LEFT) }}</p>
                <span
                    class="inline-block mt-1 px-3 py-1 bg-amber-50 text-amber-500 text-xs md:text-sm font-bold rounded-full border border-amber-100 italic">
                    {{ $shop->status_text }}
                </span>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-4 md:p-6 shadow-sm mb-4 md:mb-6">
            <h3 class="font-bold text-gray-900 mb-4 md:mb-6">Thông tin quán</h3>

            <div class="flex items-center gap-3 md:gap-4 mb-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                <div
                    class="w-9 md:w-10 h-9 md:h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center text-gray-400 shadow-sm border">
                    <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96h0v16a40,40,0,0,0,16,32v72a8,8,0,0,0,8,8H208a8,8,0,0,0,8-8V144a40,40,0,0,0,16-32V96ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-35.12,21.26,7.88,7.88,0,0,0-1.82-1.06A24,24,0,0,1,40,112v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm4.93-75.8a8.08,8.08,0,0,0-1.8,1.05A24,24,0,0,1,168,112v-8h48v8A24,24,0,0,1,204.93,132.2Z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-bold">Tên quán</p>
                    <p class="font-bold text-sm md:text-base leading-none text-gray-800 capitalize">{{ $shop->name }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3 md:gap-4 mb-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                <div
                    class="w-9 md:w-10 h-9 md:h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center text-gray-400 shadow-sm border">
                    <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-bold">Tên chủ quán</p>
                    <p class="font-bold text-sm md:text-base leading-none text-gray-800 capitalize">
                        {{ $shop->owner_name ?? 'Chưa cập nhật' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3 md:gap-4 mb-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                <div
                    class="w-9 md:w-10 h-9 md:h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center text-gray-400 shadow-sm border">
                    <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M222.37,158.46l-47.11-21.11-.13-.06a16,16,0,0,0-15.17,1.4,8.12,8.12,0,0,0-.75.56L134.87,160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16,16,0,0,0,1.32-15.06l0-.12L97.54,33.64a16,16,0,0,0-16.62-9.52A56.26,56.26,0,0,0,32,80c0,79.4,64.6,144,144,144a56.26,56.26,0,0,0,55.88-48.92A16,16,0,0,0,222.37,158.46ZM176,208A128.14,128.14,0,0,1,48,80,40.2,40.2,0,0,1,82.87,40a.61.61,0,0,0,0,.12l21,47L83.2,111.86a6.13,6.13,0,0,0-.57.77,16,16,0,0,0-1,15.7c9.06,18.53,27.73,37.06,46.46,46.11a16,16,0,0,0,15.75-1.14,8.44,8.44,0,0,0,.74-.56L168.89,152l47,21.05h0s.08,0,.11,0A40.21,40.21,0,0,1,176,208Z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-bold">Số điện thoại</p>
                    <p class="font-bold text-sm md:text-base leading-none text-gray-800 capitalize">
                        {{ $shop->phone ?? 'Chưa cập nhật' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3 md:gap-4 mb-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                <div
                    class="w-9 md:w-10 h-9 md:h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center text-gray-400 shadow-sm border">
                    <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-bold">Số nhà</p>
                    <p class="font-bold text-sm md:text-base leading-none text-gray-800 capitalize">
                        {{ $shop->address_number ?? 'Chưa cập nhật' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3 md:gap-4 mb-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                <div
                    class="w-9 md:w-10 h-9 md:h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center text-gray-400 shadow-sm border">
                    <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-bold">Tên đường</p>
                    <p class="font-bold text-sm md:text-base leading-none text-gray-800 capitalize">
                        {{ $shop->street ?? 'Chưa cập nhật' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3 md:gap-4 mb-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                <div
                    class="w-9 md:w-10 h-9 md:h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center text-gray-400 shadow-sm border">
                    <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-bold">Phường</p>
                    <p class="font-bold text-sm md:text-base leading-none text-gray-800 capitalize">
                        {{ $shop->ward ?? 'Chưa cập nhật' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3 md:gap-4 mb-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                <div
                    class="w-9 md:w-10 h-9 md:h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center text-gray-400 shadow-sm border">
                    <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M240,208h-8V88a8,8,0,0,0-8-8H160a8,8,0,0,0-8,8v40H104V40a8,8,0,0,0-8-8H32a8,8,0,0,0-8,8V208H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM168,96h48V208H168Zm-16,48v64H104V144ZM40,48H88V208H40ZM72,72V88a8,8,0,0,1-16,0V72a8,8,0,0,1,16,0Zm0,48v16a8,8,0,0,1-16,0V120a8,8,0,0,1,16,0Zm0,48v16a8,8,0,0,1-16,0V168a8,8,0,0,1,16,0Zm48,16V168a8,8,0,0,1,16,0v16a8,8,0,0,1-16,0Zm64,0V168a8,8,0,0,1,16,0v16a8,8,0,0,1-16,0Zm0-48V120a8,8,0,0,1,16,0v16a8,8,0,0,1-16,0Z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-bold">Tỉnh / TP</p>
                    <p class="font-bold text-sm md:text-base leading-none text-gray-800 capitalize">
                        {{ $shop->city ?? 'Chưa cập nhật' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-4 md:p-6 shadow-sm mb-4 md:mb-6">
            <h3 class="font-bold text-gray-900 mb-4">Hồ sơ pháp lý</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <p class="text-xs font-bold text-gray-400 mb-1 ml-2">Giấy phép kinh doanh</p>
                    <div class="bg-gray-50 p-4 rounded-2xl border-2 border-dashed border-gray-200">
                        @if ($shop->gpkd_path)
                            @php $isPdf = Str::endsWith($shop->gpkd_path, '.pdf'); @endphp

                            <div class="relative group">
                                @if ($isPdf)
                                    {{-- Hiển thị Icon nếu là PDF --}}
                                    <a href="{{ asset('storage/' . $shop->gpkd_path) }}" target="_blank"
                                        class="flex flex-col items-center justify-center py-4">
                                        <svg class="w-12 h-12 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 18h12V6h-4V2H4v16zm4-7h4v2H8v-2z" />
                                        </svg>
                                        <span class="text-xs mt-2 font-bold text-blue-600 underline">Xem file
                                            PDF</span>
                                    </a>
                                @else
                                    {{-- Hiển thị Ảnh nếu là hình --}}
                                    <img src="{{ asset('storage/' . $shop->gpkd_path) }}"
                                        class="w-full h-32 object-cover rounded-xl shadow-sm">
                                    <div
                                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition rounded-xl flex items-center justify-center">
                                        <a href="{{ asset('storage/' . $shop->gpkd_path) }}" target="_blank"
                                            class="text-white text-xs font-bold bg-black/50 px-3 py-1 rounded-full">Xem
                                            ảnh lớn</a>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-4">
                                <p class="text-xs text-gray-400 mb-2">Chưa có GPKD</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-2">
                    <p class="text-xs font-bold text-gray-400 mb-1 ml-2">Mặt trước CCCD</p>
                    <div class="bg-gray-50 p-4 rounded-2xl border-2 border-dashed border-gray-200">
                        @if ($shop->cccd_path)
                            <img src="{{ asset('storage/' . $shop->cccd_path) }}"
                                class="w-full h-32 object-cover rounded-xl shadow-sm">
                        @else
                            <div class="text-center py-4">
                                <p class="text-xs text-gray-400 mb-2">Chưa có CCCD</p>

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-3xl p-4 md:p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="">
                    <h3 class="font-bold text-gray-900 ">Sale phụ trách</h3>
                    <p class="text-xs text-gray-400">Người theo sát và bổ sung hồ sơ quán</p>
                </div>
                <svg class="w-6 h-6 flex-shrink-0 text-gray-500" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" />
                </svg>
            </div>
            <div class="bg-gray-100 p-5 rounded-3xl">
                <h4 class="font-bold text-gray-900 text-lg leading-tight mb-1">{{ auth()->user()->name }}</h4>
                <p class="text-xs text-gray-500 font-medium">
                    {{ auth()->user()->affiliate_id }} 
                    {{-- •
                    {{ auth()->user()->district ?? '' }}     --}}
                </p>

                {{-- Nút Cập nhật hồ sơ quán --}}
                <button
                    class="w-full mt-5 bg-black text-white font-bold py-4 rounded-2xl active:scale-95 transition-transform shadow-lg shadow-black/10">
                    Cập nhật hồ sơ quán
                </button>
            </div>
        </div>

    </div>
</x-sale-layout>
