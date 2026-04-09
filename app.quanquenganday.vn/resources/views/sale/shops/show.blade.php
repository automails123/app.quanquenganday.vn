<x-sale-layout>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @vite(['resources/css/custom.css', 'resources/js/app.js'])
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
        <form action="{{ route('sale.shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Alert thông báo --}}
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-2xl font-bold text-sm">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white rounded-2xl md:rounded-3xl p-4 md:p-6 shadow-sm mb-4 md:mb-6 flex items-center gap-4">
                <div
                    class="w-12 h-12 md:w-16 md:h-16 bg-black rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 md:w-8 md:h-8 text-white" xmlns="http://www.w3.org/2000/svg" width="32"
                        height="32" fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96h0v16a40,40,0,0,0,16,32v72a8,8,0,0,0,8,8H208a8,8,0,0,0,8-8V144a40,40,0,0,0,16-32V96ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-35.12,21.26,7.88,7.88,0,0,0-1.82-1.06A24,24,0,0,1,40,112v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm4.93-75.8a8.08,8.08,0,0,0-1.8,1.05A24,24,0,0,1,168,112v-8h48v8A24,24,0,0,1,204.93,132.2Z">
                        </path>
                    </svg>
                </div>
                <div class="flex-1">
                    <input type="text" name="name" value="{{ old('name', $shop->name) }}"
                        class="w-full bg-transparent border-none p-0 font-bold text-gray-800 focus:ring-1 focus:ring-blue-500 focus:px-2 focus:py-1.5 rounded-xl capitalize"
                        placeholder="Tên quán">
                    <p class="text-xs md:text-sm text-gray-400 font-medium">Mã quán:
                        SHOP{{ str_pad($shop->id, 3, '0', STR_PAD_LEFT) }}</p>

                    <select id="status_select" name="status"
                        class="w-full bg-gray-50 rounded-2xl border-none text-sm font-bold focus:ring-0 mt-1 {{ $shop->status_select_class }}">
                        <option value="pending" {{ $shop->status == 'pending' ? 'selected' : '' }}>Đang tư vấn</option>
                        <option value="paid" {{ $shop->status == 'paid' ? 'selected' : '' }}>Đã mua POS</option>
                        <option value="published" {{ $shop->status == 'published' ? 'selected' : '' }}>Đã lên App quán
                            quen</option>
                        <option value="active" {{ $shop->status == 'active' ? 'selected' : '' }}>Đã mua POS & Lên App
                        </option>
                        <option value="rejected" {{ $shop->status == 'rejected' ? 'selected' : '' }}>Bị từ chối
                        </option>
                    </select>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-4 md:p-6 shadow-sm mb-4 md:mb-6">
                <h3 class="font-bold text-gray-900 mb-4 md:mb-6">Thông tin quán</h3>

                <div class="flex items-center gap-3 md:gap-4 mb-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                    <div
                        class="w-9 md:w-10 h-9 md:h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center text-gray-400 shadow-sm border">
                        <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="currentColor" viewBox="0 0 256 256">
                            <path
                                d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96h0v16a40,40,0,0,0,16,32v72a8,8,0,0,0,8,8H208a8,8,0,0,0,8-8V144a40,40,0,0,0,16-32V96ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-35.12,21.26,7.88,7.88,0,0,0-1.82-1.06A24,24,0,0,1,40,112v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm4.93-75.8a8.08,8.08,0,0,0-1.8,1.05A24,24,0,0,1,168,112v-8h48v8A24,24,0,0,1,204.93,132.2Z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-400 font-bold">Tên quán</p>
                        <input type="text" name="name" value="{{ old('name', $shop->name) }}"
                            class="w-full bg-transparent border-none p-0 font-bold text-gray-800 focus:ring-1 focus:ring-blue-500 focus:px-2 focus:py-1.5 focus:text-sm rounded-xl capitalize"
                            placeholder="Nhập tên chủ quán">

                    </div>
                </div>

                <div class="flex items-center gap-3 md:gap-4 mb-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                    <div
                        class="w-9 md:w-10 h-9 md:h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center text-gray-400 shadow-sm border">
                        <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="currentColor" viewBox="0 0 256 256">
                            <path
                                d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-400 font-bold">Tên chủ quán</p>
                        <input type="text" name="owner_name" value="{{ old('owner_name', $shop->owner_name) }}"
                            class="w-full bg-transparent border-none p-0 font-bold text-gray-800 focus:ring-1 focus:ring-blue-500 focus:px-2 focus:py-1.5 focus:text-sm rounded-xl capitalize"
                            placeholder="Nhập tên chủ quán">
                    </div>
                </div>
                <div class="flex items-center gap-3 md:gap-4 mb-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                    <div
                        class="w-9 md:w-10 h-9 md:h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center text-gray-400 shadow-sm border">
                        <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="currentColor" viewBox="0 0 256 256">
                            <path
                                d="M222.37,158.46l-47.11-21.11-.13-.06a16,16,0,0,0-15.17,1.4,8.12,8.12,0,0,0-.75.56L134.87,160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16,16,0,0,0,1.32-15.06l0-.12L97.54,33.64a16,16,0,0,0-16.62-9.52A56.26,56.26,0,0,0,32,80c0,79.4,64.6,144,144,144a56.26,56.26,0,0,0,55.88-48.92A16,16,0,0,0,222.37,158.46ZM176,208A128.14,128.14,0,0,1,48,80,40.2,40.2,0,0,1,82.87,40a.61.61,0,0,0,0,.12l21,47L83.2,111.86a6.13,6.13,0,0,0-.57.77,16,16,0,0,0-1,15.7c9.06,18.53,27.73,37.06,46.46,46.11a16,16,0,0,0,15.75-1.14,8.44,8.44,0,0,0,.74-.56L168.89,152l47,21.05h0s.08,0,.11,0A40.21,40.21,0,0,1,176,208Z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-400 font-bold">Số điện thoại</p>
                        <input type="text" name="phone" value="{{ old('phone', $shop->phone) }}"
                            class="w-full bg-transparent border-none p-0 font-bold text-gray-800 focus:ring-1 focus:ring-blue-500 focus:px-2 focus:py-1.5 focus:text-sm rounded-xl capitalize"
                            placeholder="Số điện thoaị">
                    </div>
                </div>
                <div class="flex items-center gap-3 md:gap-4 mb-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                    <div
                        class="w-9 md:w-10 h-9 md:h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center text-gray-400 shadow-sm border">
                        <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="currentColor" viewBox="0 0 256 256">
                            <path
                                d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-400 font-bold">Số nhà</p>
                        <input type="text" name="address_number"
                            value="{{ old('address_number', $shop->address_number) }}"
                            class="w-full bg-transparent border-none p-0 font-bold text-gray-800 focus:ring-1 focus:ring-blue-500 focus:px-2 focus:py-1.5 focus:text-sm rounded-xl capitalize"
                            placeholder="Số nhà">
                    </div>
                </div>
                <div class="flex items-center gap-3 md:gap-4 mb-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                    <div
                        class="w-9 md:w-10 h-9 md:h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center text-gray-400 shadow-sm border">
                        <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="currentColor" viewBox="0 0 256 256">
                            <path
                                d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-400 font-bold">Tên đường</p>
                        <input type="text" name="street" value="{{ old('street', $shop->street) }}"
                            class="w-full bg-transparent border-none p-0 font-bold text-gray-800 focus:ring-1 focus:ring-blue-500 focus:px-2 focus:py-1.5 focus:text-sm rounded-xl capitalize"
                            placeholder="Tên đường">
                    </div>
                </div>

                {{-- Địa chỉ: Chọn lại Phường --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 cus-select">
                    {{-- Chọn Phường --}}
                    <div class="bg-gray-50 p-3 rounded-2xl border border-gray-100">
                        <label class="text-xs text-gray-400 font-bold uppercase flex items-center gap-2">
                            <div
                                class="w-9 md:w-10 h-9 md:h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center text-gray-400 shadow-sm border">
                                <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32"
                                    height="32" fill="currentColor" viewBox="0 0 256 256">
                                    <path
                                        d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z">
                                    </path>
                                </svg>
                            </div>Phường/Xã
                        </label>
                        <select name="ward" id="ward_select_update"
                            class="w-full bg-transparent border-none p-0 font-bold text-sm focus:ring-0 ml-6">
                            @if ($shop->ward_info)
                                <option value="{{ $shop->ward }}" selected>{{ $shop->ward_info->name }}</option>
                            @endif
                        </select>
                    </div>

                    {{-- Hiển thị Tỉnh (Tự động nhảy khi chọn Phường) --}}
                    <div class="bg-gray-50 p-3 rounded-2xl border border-gray-100">
                        <label class="text-xs text-gray-400 font-bold uppercase flex items-center gap-2">
                            <div
                                class="w-9 md:w-10 h-9 md:h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center text-gray-400 shadow-sm border">
                                <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32"
                                    height="32" fill="currentColor" viewBox="0 0 256 256">
                                    <path
                                        d="M240,208h-8V88a8,8,0,0,0-8-8H160a8,8,0,0,0-8,8v40H104V40a8,8,0,0,0-8-8H32a8,8,0,0,0-8,8V208H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM168,96h48V208H168Zm-16,48v64H104V144ZM40,48H88V208H40ZM72,72V88a8,8,0,0,1-16,0V72a8,8,0,0,1,16,0Zm0,48v16a8,8,0,0,1-16,0V120a8,8,0,0,1,16,0Zm0,48v16a8,8,0,0,1-16,0V168a8,8,0,0,1,16,0Zm48,16V168a8,8,0,0,1,16,0v16a8,8,0,0,1-16,0Zm64,0V168a8,8,0,0,1,16,0v16a8,8,0,0,1-16,0Zm0-48V120a8,8,0,0,1,16,0v16a8,8,0,0,1-16,0Z">
                                    </path>
                                </svg>
                            </div>
                            Tỉnh / Thành phố
                        </label>
                        <input type="text" id="province_display_update"
                            value="{{ $shop->ward_info->province->name ?? 'N/A' }}"
                            class="w-full bg-transparent border-none p-0 font-bold text-sm text-gray-500 focus:ring-0 ml-6"
                            readonly>
                    </div>
                </div>
            </div>


            <div class="bg-white rounded-3xl p-4 md:p-6 shadow-sm mb-4 md:mb-6">
                <h3 class="font-bold text-gray-900 mb-4">Hồ sơ pháp lý</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- Giấy phép kinh doanh --}}
                    <div class="space-y-2">
                        <p class="text-xs font-bold text-gray-400 mb-1 ml-2">Giấy phép kinh doanh</p>
                        <div
                            class="relative bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 p-2 min-h-[140px] flex items-center justify-center overflow-hidden">
                            @if ($shop->gpkd_path)
                                @php $isPdf = Str::endsWith($shop->gpkd_path, '.pdf'); @endphp
                                <div class="relative w-full h-full group">
                                    @if ($isPdf)
                                        <div class="flex flex-col items-center justify-center h-32">
                                            <svg class="w-10 h-10 text-red-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M4 18h12V6h-4V2H4v16zm4-7h4v2H8v-2z" />
                                            </svg>
                                            <span class="text-[10px] font-bold mt-1 text-gray-500">File PDF đã
                                                upload</span>
                                        </div>
                                    @else
                                        <img src="{{ asset('storage/' . $shop->gpkd_path) }}"
                                            class="w-full h-32 object-cover rounded-xl">
                                    @endif
                                    {{-- Nút thay đổi khi đã có hình --}}
                                    <label
                                        class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center cursor-pointer rounded-xl">
                                        <svg class="w-6 h-6 text-white mb-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                                                stroke-width="2" />
                                        </svg>
                                        <span class="text-white text-[10px] font-bold">Thay đổi file</span>
                                        <input type="file" name="gpkd_image" class="hidden"
                                            onchange="previewImage(this)">
                                    </label>
                                </div>
                            @else
                                {{-- Khung upload khi chưa có hình --}}
                                <label
                                    class="flex flex-col items-center justify-center w-full h-32 cursor-pointer hover:bg-gray-100 transition-colors">
                                    <div class="bg-white p-2 rounded-full shadow-sm mb-2">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M12 4v16m8-8H4" stroke-width="2" />
                                        </svg>
                                    </div>
                                    <p class="text-[10px] font-bold text-gray-400">Bấm để tải lên GPKD</p>
                                    <input type="file" name="gpkd_image" class="hidden">
                                </label>
                            @endif
                        </div>
                        @error('gpkd_image')
                            <p class="text-red-500 text-sm font-bold mt-1 ml-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Mặt trước CCCD --}}
                    <div class="space-y-2">
                        <p class="text-xs font-bold text-gray-400 mb-1 ml-2">Mặt trước CCCD</p>
                        <div
                            class="relative bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 p-2 min-h-[140px] flex items-center justify-center overflow-hidden">
                            @if ($shop->cccd_path)
                                <div class="relative w-full h-full group">
                                    <img src="{{ asset('storage/' . $shop->cccd_path) }}"
                                        class="w-full h-32 object-cover rounded-xl">
                                    {{-- Nút thay đổi --}}
                                    <label
                                        class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center cursor-pointer rounded-xl">
                                        <svg class="w-6 h-6 text-white mb-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                                                stroke-width="2" />
                                        </svg>
                                        <span class="text-white text-[10px] font-bold">Thay đổi ảnh</span>
                                        <input type="file" name="cccd_image" class="hidden">
                                    </label>
                                </div>
                            @else
                                {{-- Khung upload khi chưa có ảnh --}}
                                <label
                                    class="flex flex-col items-center justify-center w-full h-32 cursor-pointer hover:bg-gray-100 transition-colors">
                                    <div class="bg-white p-2 rounded-full shadow-sm mb-2">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M12 4v16m8-8H4" stroke-width="2" />
                                        </svg>
                                    </div>
                                    <p class="text-[10px] font-bold text-gray-400">Bấm để tải lên CCCD</p>
                                    <input type="file" name="cccd_image" class="hidden">
                                </label>
                            @endif
                        </div>
                        @error('cccd_image')
                            <p class="text-red-500 text-sm font-bold mt-1 ml-2">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="bg-white rounded-3xl p-4 md:p-6 shadow-sm mb-4 md:mb-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="">
                        <h3 class="font-bold text-gray-900 ">Sale phụ trách</h3>
                        <p class="text-xs text-gray-400">Người theo sát và bổ sung hồ sơ quán</p>
                    </div>
                    <svg class="w-6 h-6 flex-shrink-0 text-gray-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            stroke-width="2" />
                    </svg>
                </div>
                <div class="bg-gray-100 p-5 rounded-3xl">
                    <h4 class="font-bold text-gray-900 text-lg leading-tight mb-1">{{ auth()->user()->name }}</h4>
                    <p class="text-xs text-gray-500 font-medium">
                        {{ auth()->user()->affiliate_id }}

                    </p>

                </div>
            </div>
            <div class="bg-white rounded-3xl p-4 md:p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="">
                        <h3 class="font-bold text-gray-900 ">Ghi chú nội bộ</h3>
                        <p class="text-xs text-gray-400">Thông tin do sale hoặc quản lý cập nhật</p>
                    </div>
                    <svg class="w-6 h-6 flex-shrink-0 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M229.66,58.34l-32-32a8,8,0,0,0-11.32,0l-96,96A8,8,0,0,0,88,128v32a8,8,0,0,0,8,8h32a8,8,0,0,0,5.66-2.34l96-96A8,8,0,0,0,229.66,58.34ZM124.69,152H104V131.31l64-64L188.69,88ZM200,76.69,179.31,56,192,43.31,212.69,64ZM224,128v80a16,16,0,0,1-16,16H48a16,16,0,0,1-16-16V48A16,16,0,0,1,48,32h80a8,8,0,0,1,0,16H48V208H208V128a8,8,0,0,1,16,0Z"></path></svg>
                </div>
                <div class="bg-gray-100 p-5 rounded-3xl">
                    <textarea cols="30" rows="5"
                        class="text-black placeholder:text-gray-400 placeholder:text-sm w-full px-6 py-4 rounded-2xl border border-gray-500 bg-white  focus:outline-none focus:ring-2 focus:ring-black/5 transition-all font-medium"
                        name="note"
                        placeholder="Nhập ghi chú thêm về tình trạng hồ sơ, lý do thiếu giấy tờ, hoặc hẹn ngày sale bổ sung">{{ old('note', $shop->note) }}</textarea>
                </div>
            </div>
            <button type="submit"
                class="w-full mt-5 bg-black text-white font-bold py-4 rounded-2xl active:scale-95 transition-transform shadow-lg shadow-black/10 hover:opacity-65 ">
                Cập nhật hồ sơ quán
            </button>
        </form>

    </div>
    <script>
        function previewImage(input) {
            const container = input.closest('.relative.group') || input.closest('.relative');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Tìm thẻ img trong khung đó
                    let img = container.querySelector('img');

                    // Nếu trước đó là PDF hoặc chưa có thẻ img, ta tạo mới thẻ img
                    if (!img) {
                        // Xóa cái icon PDF hoặc icon upload cũ đi
                        container.innerHTML =
                            `<img src="${e.target.result}" class="w-full h-32 object-cover rounded-xl shadow-sm">` +
                            container.innerHTML;
                    } else {
                        // Nếu đã có thẻ img thì chỉ cần thay src
                        img.src = e.target.result;
                    }
                }
                reader.readAsDataURL(file);
            }
        }

        // Gán sự kiện cho tất cả input file trong trang
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                previewImage(this);
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#ward_select_update').select2({
                ajax: {
                    url: "/api/search-wards", // Đường dẫn API bạn đã viết
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results
                        };
                    },
                    cache: true
                },
                minimumInputLength: 2,
                placeholder: "Tìm phường mới...",
                width: '100%'
            });

            // Khi chọn phường mới, cập nhật ngay tên Tỉnh lên ô bên cạnh
            $('#ward_select_update').on('select2:select', function(e) {
                var data = e.params.data;
                $('#province_display_update').val(data.province_name);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status_select');

            // Định nghĩa bảng màu tương ứng với từng value
            const statusColors = {
                'active': ['bg-emerald-50', 'text-emerald-600'],
                'published': ['bg-blue-50', 'text-blue-500'],
                'paid': ['bg-purple-50', 'text-purple-500'],
                'rejected': ['bg-red-50', 'text-red-500'],
                'pending': ['bg-amber-50', 'text-amber-500']
            };

            statusSelect.addEventListener('change', function() {
                // 1. Xóa hết các class màu cũ
                Object.values(statusColors).forEach(classes => {
                    statusSelect.classList.remove(...classes);
                });

                // 2. Thêm class màu mới dựa trên giá trị được chọn
                const selectedValue = this.value;
                if (statusColors[selectedValue]) {
                    statusSelect.classList.add(...statusColors[selectedValue]);
                }
            });
        });
    </script>
</x-sale-layout>
