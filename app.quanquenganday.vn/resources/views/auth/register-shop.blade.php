<x-guest-layout>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @vite(['resources/css/custom.css', 'resources/js/app.js'])

    <div class="bg-gray-50 min-h-screen flex flex-col items-center justify-center p-5 md:p-8">
        <div class="max-w-xl md:max-w-2xl mx-auto ">
            <div class="text-center mb-8">
                <img src="{{ asset('logo.webp') }}" class="w-20 mx-auto">
            </div>

            <div class="">
                <div class="flex items-start mb-6">
                    <div class="p-3 bg-black rounded-2xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold">Đăng ký thông tin quán</h2>
                        <p class="text-sm text-gray-500">Điền thông tin cơ bản để hệ thống tạo hồ sơ quán</p>
                    </div>
                </div>
                {{-- @if ($errors->any())
                    <div
                        style="background: #fee2e2; color: #b91c1c; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                        <strong>Ối! Có lỗi rồi:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                <form action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium mb-1">Mã giới thiệu (sale) <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                            </span>
                            <input type="text" name="ref_code" value="{{ old('ref_code', $ref) }}"
                                {{ $ref ? 'readonly' : '' }}
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-2xl {{ $ref ? 'bg-gray-50 cursor-not-allowed' : 'bg-white border border-red-100 text-red-500' }}">
                        </div>
                    </div>
                    @error('ref_code')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Tên quán <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">

                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                                    </svg>


                                </span>
                                <input type="text" name="shop_name" value="{{ old('shop_name') }}" required
                                    placeholder="Ví dụ: Cafe Mộc"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-2xl focus:ring-black">
                            </div>
                            @error('shop_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Tên chủ quán <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </span>
                                <input type="text" name="owner_name" value="{{ old('owner_name') }}" required
                                    placeholder="Nhập tên chủ quán"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-2xl focus:ring-black">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Số điện thoại <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </span>
                            <input type="text" name="phone" value="{{ old('phone') }}" required
                                placeholder="Nhập số điện thoại"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-2xl focus:ring-black">
                        </div>
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Số nhà <span
                                    class="text-red-500">*</span></label>

                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                </span>
                                <input type="text" name="address_number" value="{{ old('address_number') }}"
                                    placeholder="Ví dụ: 814"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-2xl">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Tên đường <span
                                    class="text-red-500">*</span></label>


                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                </span>

                                <input type="text" name="street" value="{{ old('street') }}"
                                    placeholder="Ví dụ: Âu Cơ" required
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-2xl">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Phường <span
                                    class="text-red-500">*</span></label>

                            <div class="relative">
                                <span class="absolute z-[1] inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                </span>
                                <select id="ward_select" name="ward"
                                    class="mt-1 w-full pl-10 pr-4 py-3 border border-gray-200 rounded-2xl"
                                    required></select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Tỉnh/TP <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                </span>
                                {{-- <input required type="text" name="city" value="{{ old('city') }}"
                                    placeholder="Nhập Tỉnh/TP" required
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-2xl"> --}}

                                <input type="text" id="province_display" readonly
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-2xl"
                                    placeholder="Tự động hiện Tỉnh/TP">
                                <input type="hidden" name="city" id="province_code">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm mt-8">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-bold text-lg text-gray-800">Hồ sơ pháp lý</h3>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-xs text-gray-500 mb-4 italic">Có thể bổ sung khi đăng ký hoặc để sale cập nhật
                            sau</p>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1 text-gray-700">Mã số thuế</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </span>
                                <input type="text" name="tax_code" placeholder="Nhập mã số thuế nếu có"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-100 bg-gray-50 rounded-2xl focus:ring-black">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div
                                class="border-2 border-dashed border-gray-200 rounded-3xl p-6 text-center max-md:mb-4 flex flex-col items-center justify-center ">
                                <p class="text-sm font-bold text-gray-800">Giấy phép kinh doanh (GPKD)</p>
                                <p class="text-xs text-gray-400 mb-3 text-center">Tải ảnh hoặc file GPKD của quán nếu
                                    có
                                </p>
                                <input type="file" name="gpkd_file" class="hidden" id="gpkd_file"
                                    accept="image/*,.pdf">
                                <label for="gpkd_file"
                                    class="inline-block bg-white border px-10 py-2 rounded-2xl text-sm font-medium cursor-pointer hover:bg-gray-50">Tải
                                    file lên</label>
                                <div id="gpkd_preview_container" class="mt-2 hidden">
                                    <img id="gpkd_preview_img" src="#"
                                        class="max-w-[150px] h-auto rounded-lg border hidden">

                                    <div id="gpkd_preview_pdf"
                                        class="flex items-center p-3 bg-red-50 text-red-700 rounded-lg border border-red-200 hidden">
                                        <svg class="w-8 h-8 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z">
                                            </path>
                                        </svg>
                                        <span id="gpkd_pdf_name"
                                            class="text-xs font-medium truncate">file_name.pdf</span>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="border-2 border-dashed border-gray-200 rounded-3xl p-6 text-center flex flex-col items-center justify-center ">
                                <p class="text-sm font-bold text-gray-800">CCCD mặt trước</p>
                                <p class="text-xs text-gray-400 mb-3 text-center">Nếu chưa có mã số thuế hoặc GPKD, có
                                    thể tải CCCD mặt trước của chủ quán</p>
                                <input type="file" name="cccd_file" class="hidden" id="cccd_file"
                                    accept="image/*">
                                <label for="cccd_file"
                                    class="inline-block bg-white border px-10 py-2 rounded-2xl text-sm font-medium cursor-pointer hover:bg-gray-50">Tải
                                    file lên</label>
                                <div class="mt-2 hidden" id="cccd_preview_container">
                                    <img id="cccd_preview" src="#" alt="CCCD Preview"
                                        class="max-w-[200px] h-auto rounded-lg border shadow-sm">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="pos_price" value="1800000">
                    </div>

                    {{-- @if (session('success'))
                        <div
                            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif --}}
                    <button type="submit"
                        class="w-full bg-black text-white py-4 rounded-full font-bold flex items-center justify-center space-x-2 mt-6">
                        <svg class="w-5 h-5 transform rotate-45" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        <span>Gửi đăng ký quán</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
           
            $('#ward_select').select2({
                ajax: {
                    url: "/api/search-wards",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        // VÌ CONTROLLER ĐÃ TRẢ VỀ { results: [...] } 
                        // NÊN Ở ĐÂY CHỈ CẦN RETURN LUÔN DATA LÀ XONG
                        return {
                            results: data.results
                        };
                    },
                    cache: true
                },
                minimumInputLength: 2,
                placeholder: "Gõ để tìm phường/xã",
                allowClear: true,
                language: {
                    inputTooShort: function() {
                        return "Vui lòng nhập 2 ký tự trở lên...";
                    },
                    noResults: function() {
                        return "Không tìm thấy phường này";
                    },
                    searching: function() {
                        return "Đang tìm kiếm...";
                    }
                },
            });

            // Khi chọn một phường, lấy thêm thông tin tỉnh để điền vào các ô khác
            $('#ward_select').on('select2:select', function(e) {
                var data = e.params.data; // Đây chính là item trong formattedData của Controller
                
                // Gán tên tỉnh vào ô hiển thị (ID phải khớp với HTML của Duyqt)
                $('#province_display').val(data.province_name);
                // Gán mã tỉnh vào input ẩn
                $('#province_code').val(data.province_code);
            });
        });
    </script>
    <script>
        function setupSmartPreview(inputId, imgPreviewId, pdfPreviewId, containerId, nameId) {
            const input = document.getElementById(inputId);
            const imgPrev = document.getElementById(imgPreviewId);
            const pdfPrev = document.getElementById(pdfPreviewId);
            const container = document.getElementById(containerId);
            const fileName = document.getElementById(nameId);

            if (!input) return;

            input.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    container.classList.remove('hidden');

                    // Kiểm tra định dạng file
                    if (file.type === "application/pdf") {
                        // Xử lý nếu là PDF
                        imgPrev.classList.add('hidden');
                        pdfPrev.classList.remove('hidden');
                        fileName.textContent = file.name;
                    } else if (file.type.startsWith("image/")) {
                        // Xử lý nếu là Ảnh
                        pdfPrev.classList.add('hidden');
                        imgPrev.classList.remove('hidden');

                        const reader = new FileReader();
                        reader.onload = e => imgPrev.src = e.target.result;
                        reader.readAsDataURL(file);
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Kích hoạt cho GPKD
            setupSmartPreview('gpkd_file', 'gpkd_preview_img', 'gpkd_preview_pdf', 'gpkd_preview_container',
                'gpkd_pdf_name');
        });
        // Hàm xử lý hiển thị ảnh preview
        function setupPreview(inputId, previewId, containerId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            const container = document.getElementById(containerId);

            if (input) {
                input.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            container.classList.remove('hidden'); // Hiện khung chứa ảnh
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }
        }

        // Chạy hàm khi trang đã load xong
        document.addEventListener('DOMContentLoaded', function() {
            // setupPreview('gpkd_file', 'gpkd_preview', 'gpkd_preview_container');
            setupPreview('cccd_file', 'cccd_preview', 'cccd_preview_container');
        });
    </script>
</x-guest-layout>
