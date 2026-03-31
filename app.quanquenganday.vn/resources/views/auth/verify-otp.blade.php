<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="py-3">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800 text-center">Xác thực OTP & đặt mật khẩu mới</h1>
                <p class="text-sm text-gray-500 mt-2">
                    Nhập mã OTP đã gửi về email <strong>{{ session('reset_email') }}</strong>, sau đó tạo mật khẩu mới
                    để đăng nhập lại vào hệ thống.
                </p>
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.update.otp') }}" id="otp-form">
                @csrf
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Mã OTP</label>
                    <div class="flex justify-center gap-2 md:gap-3" id="otp-inputs">
                        @for ($i = 0; $i < 6; $i++)
                            <input type="text" maxlength="1"
                                class="otp-field w-10 h-12 md:w-12 md:h-14 text-center text-xl font-bold border border-gray-200 rounded-xl focus:ring-2 focus:ring-black focus:border-black outline-none transition-all"
                                pattern="\d*" inputmode="numeric">
                        @endfor
                    </div>
                    <input type="hidden" name="otp" id="otp_full">
                    <p class="text-xs text-gray-400 mt-4 italic">OTP đã được gửi về email đăng ký của bạn.</p>
                </div>

                <div class="space-y-4 mb-6">
                    <div>
                        <x-label value="Mật khẩu mới" />
                        <x-input id="password" class="block mt-1 w-full bg-gray-50 border border-gray-100 rounded-2xl"
                            type="password" name="password" required placeholder="Nhập mật khẩu mới" />
                    </div>

                    <div>
                        <x-label value="Nhập lại mật khẩu mới" />
                        <x-input id="password_confirmation"
                            class="block mt-1 w-full bg-gray-50 border border-gray-100 rounded-2xl" type="password"
                            name="password_confirmation" required placeholder="Xác nhận lại mật khẩu" />
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit"
                        class="w-full py-3 bg-black text-white rounded-2xl font-bold hover:bg-gray-800 transition shadow-lg">
                        Xác nhận đổi mật khẩu
                    </button>

                    <a href="{{ route('password.request') }}"
                        class="w-full py-3 bg-gray-100 text-gray-600 rounded-2xl font-bold hover:bg-gray-200 transition text-center text-sm">
                        Gửi lại mã OTP
                    </a>
                </div>
            </form>
        </div>
    </x-authentication-card>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.otp-field');
            const fullInput = document.getElementById('otp_full');
            const form = document.getElementById('otp-form');

            inputs.forEach((input, index) => {
                // Xử lý khi nhập số
                input.addEventListener('input', (e) => {
                    if (e.target.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    updateFullValue();
                });

                // Xử lý khi bấm Backspace để quay lại ô trước
                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && !e.target.value && index > 0) {
                        inputs[index - 1].focus();
                    }
                });

                // Xử lý khi Paste (dán) cả mã 6 số vào ô đầu tiên
                input.addEventListener('paste', (e) => {
                    const data = e.clipboardData.getData('text');
                    if (data.length === 6 && /^\d+$/.test(data)) {
                        const digits = data.split('');
                        inputs.forEach((input, i) => input.value = digits[i]);
                        updateFullValue();
                        inputs[5].focus();
                    }
                });
            });

            function updateFullValue() {
                let val = "";
                inputs.forEach(input => val += input.value);
                fullInput.value = val;
            }

            // Kiểm tra trước khi submit
            form.addEventListener('submit', function(e) {
                if (fullInput.value.length !== 6) {
                    e.preventDefault();
                    alert('Vui lòng nhập đủ 6 chữ số OTP');
                }
            });
        });
    </script>
</x-guest-layout>
