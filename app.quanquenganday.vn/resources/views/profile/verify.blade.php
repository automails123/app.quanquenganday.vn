<x-app-layout>
    {{-- Khởi tạo Alpine.js cho toàn bộ vùng nội dung --}}
    <div x-data="{
        step: '{{ auth()->user()->email_verified_at ? 'verified' : 'request' }}',
        cccdStep: '{{ auth()->user()->cccd_status === 'pending' ? 'request' : auth()->user()->cccd_status }}',
    
        loading: false,
        cccdLoading: false,
    
    
        frontPreview: null,
        backPreview: null,
        {{-- Hàm xử lý xem trước ảnh khi chọn file --}}
        previewImage(event, type) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    if (type === 'front') this.frontPreview = e.target.result;
                    if (type === 'back') this.backPreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        {{-- Hàm gửi Form CCCD bằng AJAX --}}
        submitCCCD() {
            this.cccdLoading = true;
            const formData = new FormData(document.getElementById('cccd-form'));
    
            fetch('{{ route('cccd.upload') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    this.cccdLoading = false;
                    if (data.success) {
                        alert(data.message);
                        window.location.href = data.redirect; // Reload trang
                    } else {
                        alert(data.message || 'Có lỗi xảy ra');
                    }
                })
                .catch(error => {
                    this.cccdLoading = false;
                    console.error(error);
                    alert('Lỗi kết nối');
                });
        },
    
        sendOTP() {
            this.loading = true;
            fetch('{{ route('otp.send') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    this.loading = false;
                    this.step = 'verify';
                })
                .catch(error => {
                    this.loading = false;
                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                });
        }
    }" class="md:py-12 container mx-auto md:min-h-[calc(100vh-65px)] flex items-center">

        <div class="bg-white shadow-xl rounded-xl md:rounded-3xl px-4 py-6 md:p-6 w-full max-w-screen-sm mx-auto h-full">

            {{-- Header --}}
            <div class="flex items-center justify-between gap-1 mb-3 md:mb-6">
                <h2 class="font-bold text-gray-700 text-lg md:text-xl capitalize">Xác minh tài khoản</h2>
                <svg class="w-6 h-6 fill-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                    <path
                        d="M208,40H48A16,16,0,0,0,32,56v56c0,52.72,25.52,84.67,46.93,102.19,23.06,18.86,46,25.26,47,25.53a8,8,0,0,0,4.2,0c1-.27,23.91-6.67,47-25.53C198.48,196.67,224,164.72,224,112V56A16,16,0,0,0,208,40Zm0,72c0,37.07-13.66,67.16-40.6,89.42A129.3,129.3,0,0,1,128,223.62a128.25,128.25,0,0,1-38.92-21.81C61.82,179.51,48,149.3,48,112l0-56,160,0ZM82.34,141.66a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35a8,8,0,0,1,11.32,11.32l-56,56a8,8,0,0,1-11.32,0Z">
                    </path>
                </svg>
            </div>

            <div class="space-y-4">
                {{-- MỤC XÁC MINH EMAIL --}}
                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    {{-- Trạng thái 1: Chưa gửi OTP --}}
                    <div x-show="step === 'request'" class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 bg-white border rounded-xl flex items-center justify-center shadow-sm text-gray-600">

                                @if (auth()->user()->email_verified_at)
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                @else
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32"
                                        height="32" fill="currentColor" viewBox="0 0 256 256">
                                        <path
                                            d="M224,48H32a8,8,0,0,0-8,8V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A8,8,0,0,0,224,48Zm-96,85.15L52.57,64H203.43ZM98.71,128,40,181.81V74.19Zm11.84,10.85,12,11.05a8,8,0,0,0,10.82,0l12-11.05,58,53.15H52.57ZM157.29,128,216,74.18V181.82Z">
                                        </path>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Xác minh Email</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        @if (auth()->user()->email_verified_at)
                            <button disabled="true"
                                class="px-4 py-2 bg-emerald-500 text-emerald-50 rounded-xl text-xs font-bold hover:bg-gray-200 transition">
                                <span x-show="!loading">Đã xác minh</span>
                            </button>
                        @else
                            <button @click="sendOTP()" :disabled="loading"
                                class="px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-xs font-bold hover:bg-gray-200 transition">
                                <span x-show="!loading">Xác minh ngay</span>
                                <span x-show="loading">Đang gửi...</span>
                            </button>
                        @endif
                    </div>

                    {{-- Trạng thái 2: Đang nhập OTP (Hiện ra khi click) --}}
                    <div x-show="step === 'verify'" x-cloak class="pt-2"
                        x-effect="if(step === 'verify') { $nextTick(() => { document.querySelector('.otp-field').focus() }) }">
                        <p class="text-xs text-blue-600 mb-4 italic">Vui lòng nhập mã OTP 6 số đã gửi tới email của bạn.
                        </p>
                        <form id="otp-form" action="{{ route('otp.verify') }}" method="POST">
                            @csrf
                            <div class="flex justify-between gap-2 mb-6" id="otp-inputs">
                                @for ($i = 1; $i <= 6; $i++)
                                    <input type="text" maxlength="1" inputmode="numeric"
                                        class="otp-field w-12 h-14 md:w-16 md:h-16 border border-gray-300 rounded-xl text-center text-2xl font-bold focus:border-black focus:ring-0 outline-none transition-all"
                                        data-index="{{ $i }}">
                                @endfor
                            </div>

                            {{-- Input ẩn để chứa giá trị cuối cùng gửi lên Server --}}
                            <input type="hidden" name="otp" id="otp-full-value">

                            <div class="flex justify-between items-center text-xs">
                                <span class="text-gray-500">Chưa nhận được mã?</span>
                                <button type="button" @click="sendOTP()" class="font-bold text-black underline">Gửi
                                    lại</button>
                            </div>
                            <button type="submit" class="w-full mt-4 py-3 bg-black text-white rounded-xl font-bold">Xác
                                nhận OTP</button>
                        </form>
                    </div>

                    {{-- Trạng thái 3: Đã xác minh --}}
                    <div x-show="step === 'verified'" class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 bg-white border rounded-xl flex items-center justify-center text-emerald-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Xác minh Email</p>
                                <p class="text-xs text-emerald-600 italic">Đã bảo mật tài khoản</p>
                            </div>
                        </div>
                        <span
                            class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold border border-emerald-100">Đã
                            xác minh</span>
                    </div>
                </div>

                {{-- MỤC XÁC MINH CCCD --}}
                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 border bg-white rounded-xl flex items-center justify-center shadow-sm text-gray-600">

                            @if (auth()->user()->cccd_status === 'approved')
                                <svg class="w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                    fill="currentColor" viewBox="0 0 256 256">
                                    <path
                                        d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z">
                                    </path>
                                </svg>
                            @else
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M224,48H32A16,16,0,0,0,16,64V192a16,16,0,0,0,16,16H224a16,16,0,0,0,16-16V64A16,16,0,0,0,224,48Zm0,16V88H32V64Zm0,128H32V104H224v88Zm-16-24a8,8,0,0,1-8,8H168a8,8,0,0,1,0-16h32A8,8,0,0,1,208,168Zm-64,0a8,8,0,0,1-8,8H120a8,8,0,0,1,0-16h16A8,8,0,0,1,144,168Z">
                                    </path>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">Xác minh CCCD</p>

                            @if (auth()->user()->cccd_status === 'pending')
                                <p class="text-xs text-gray-500">
                                    Chưa cập nhật
                                </p>
                            @elseif(auth()->user()->cccd_status === 'processing')
                                <p class="text-xs text-gray-500">
                                    Đang chờ duyệt
                                </p>
                            @elseif(auth()->user()->cccd_status === 'approved')
                                <p class="text-xs text-green-500">
                                    Đã xác minh
                                </p>
                            @elseif(auth()->user()->cccd_status === 'rejected')
                                <p class="text-xs text-gray-500">
                                    Bị từ chối
                                </p>
                            @endif

                        </div>
                    </div>


                    <template x-if="cccdStep === 'request'">
                        <button @click="cccdStep = 'upload'"
                            class="px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-xs font-bold hover:bg-gray-200 transition">
                            Xác minh ngay
                        </button>
                    </template>

                    <template x-if="cccdStep === 'processing'">
                        <span
                            class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-bold border border-blue-100">Đang
                            chờ duyệt</span>
                    </template>

                    <template x-if="cccdStep === 'approved'">
                        <span
                            class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold border border-emerald-100">Đã
                            xác minh</span>
                    </template>

                    <template x-if="cccdStep === 'rejected'">
                        <button @click="cccdStep = 'upload'"
                            class="px-4 py-2 bg-red-100 text-red-600 rounded-xl text-xs font-bold hover:bg-red-200 transition">
                            Thử lại
                        </button>
                    </template>
                </div>
                {{-- FORM UPLOAD ẢNH (Hiện ra khi nhấn Xác minh ngay) --}}
                <div x-show="cccdStep === 'upload'" x-cloak class="pt-4 border-t border-gray-100" x-transition>
                    <form id="cccd-form" @submit.preventDefault="submitCCCD()">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            {{-- Mặt trước --}}
                            <div class="relative group">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Mặt trước CCCD</label>
                                <div class="w-full h-48 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center cursor-pointer hover:border-black transition overflow-hidden bg-white"
                                    @click="$refs.frontInput.click()">

                                    <template x-if="!frontPreview">
                                        <div class="text-center p-4">
                                            <svg class="w-10 h-10 text-gray-400 mx-auto mb-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                            <span class="text-xs text-gray-500 font-medium">Chọn ảnh mặt trước</span>
                                        </div>
                                    </template>

                                    <template x-if="frontPreview">
                                        <img :src="frontPreview" class="w-full h-full object-cover">
                                    </template>
                                </div>
                                {{-- Input file ẩn --}}
                                <input type="file" name="front_image" x-ref="frontInput" class="hidden"
                                    accept="image/*" @change="previewImage($event, 'front')" required>
                            </div>

                            {{-- Mặt sau --}}
                            <div class="relative group">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Mặt sau CCCD</label>
                                <div class="w-full h-48 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center cursor-pointer hover:border-black transition overflow-hidden bg-white"
                                    @click="$refs.backInput.click()">

                                    <template x-if="!backPreview">
                                        <div class="text-center p-4">
                                            <svg class="w-10 h-10 text-gray-400 mx-auto mb-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                            <span class="text-xs text-gray-500 font-medium">Chọn ảnh mặt sau</span>
                                        </div>
                                    </template>

                                    <template x-if="backPreview">
                                        <img :src="backPreview" class="w-full h-full object-cover">
                                    </template>
                                </div>
                                <input type="file" name="back_image" x-ref="backInput" class="hidden"
                                    accept="image/*" @change="previewImage($event, 'back')" required>
                            </div>
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button" @click="cccdStep = 'request'"
                                class="px-4 py-2 text-sm text-gray-600 hover:text-black">Hủy</button>
                            <button type="submit"
                                class="px-6 py-2 bg-black text-white rounded-xl text-sm font-bold flex items-center gap-2"
                                :class="cccdLoading ? 'opacity-50 cursor-not-allowed' : ''" :disabled="cccdLoading">
                                <span x-show="cccdLoading"
                                    class="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></span>
                                <span x-text="cccdLoading ? 'Đang tải lên...' : 'Hoàn tất tải lên'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Footer Note --}}
            <div class="mt-8 p-4 bg-blue-50 rounded-2xl border border-blue-100">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-xs text-blue-700 leading-relaxed">Việc xác minh tài khoản giúp tăng tính bảo mật và
                        cho phép bạn thực hiện các lệnh rút tiền nhanh chóng hơn.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const otpForm = document.getElementById('otp-form');
            const fields = document.querySelectorAll('.otp-field');
            const hiddenInput = document.getElementById('otp-full-value');

            if (otpForm) {
                otpForm.addEventListener('submit', function(e) {
                    e.preventDefault(); // Chặn load lại trang mặc định

                    const otpValue = hiddenInput.value;

                    fetch('{{ route('otp.verify') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                otp: otpValue
                            })
                        })
                        // ĐÂY LÀ NƠI BẠN CHÈN ĐOẠN CODE ĐÓ:
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Load lại trang verify-account để cập nhật trạng thái "Đã xác minh"
                                window.location.href = data.redirect;
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Có lỗi xảy ra, vui lòng thử lại.');
                        });
                });
            }

            if (fields.length > 0) {
                fields.forEach((input, index) => {
                    // 1. Tự động nhảy ô khi nhập
                    input.addEventListener('input', (e) => {
                        if (e.target.value.length > 1) {
                            e.target.value = e.target.value.slice(0, 1);
                        }
                        if (e.target.value && index < fields.length - 1) {
                            fields[index + 1].focus();
                        }
                        combineOtp();
                    });

                    // 2. Nhấn Backspace để quay lại ô trước
                    input.addEventListener('keydown', (e) => {
                        if (e.key === 'Backspace' && !e.target.value && index > 0) {
                            fields[index - 1].focus();
                        }
                    });

                    // 3. Chỉ cho phép nhập số
                    input.addEventListener('keypress', (e) => {
                        if (!/[0-9]/.test(e.key)) {
                            e.preventDefault();
                        }
                    });
                });
            }

            function combineOtp() {
                let otpValue = "";
                fields.forEach(input => {
                    otpValue += input.value;
                });
                if (hiddenInput) {
                    hiddenInput.value = otpValue;
                }
            }
        });
    </script>
</x-app-layout>
