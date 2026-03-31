<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 p-5 md:p-8">
        <div
            class="w-full max-w-xl md:max-w-2xl bg-white rounded-2xl md:rounded-3xl shadow-xl md:p-8 border border-gray-100">
            <div class="text-center mb-8">
                <img src="{{ asset('logo.webp') }}" class="w-20 mx-auto mb-4">
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Đăng ký Sale</h2>
            <p class="text-gray-400 text-sm md:text-base">Tham gia hệ thống để bắt đầu kiếm tiền.</p>


            <form action="{{ route('register.sale.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                            </path>
                        </svg>
                    </span>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Họ và tên" required
                        class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-orange-500 transition">
                </div>

                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                    </span>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại"
                        required
                        class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl outline-none">
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z" />
                        </svg>

                    </span>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                        class="w-full pl-10 pr-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none">
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400"
                        onclick="togglePassword('password', 'eye_icon_1')">
                        <svg id="eye_icon_1" class="w-5 h-5" fill="currentColor"  xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256"><path d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z"></path></svg>
                    </span>
                    <input type="password" name="password" placeholder="Mật khẩu" id="password" required
                        class="w-full pr-10 pl-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none">
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400" onclick="togglePassword('password_confirmation', 'eye_icon_2')">
                        <svg id="eye_icon_2" class="w-5 h-5" fill="currentColor"  xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256"><path d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z"></path></svg>
                    </span>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Xác nhận mật khẩu" required
                        class="w-full pr-10 pl-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none">
                </div>

                <div class="relative">
                    <input type="text" name="ref_code" value="{{ $ref }}"  {{ $ref ? 'readonly' : '' }}
                        placeholder="Mã giới thiệu (bắt buộc)"
                        class="w-full px-5 py-4 bg-red-50 border border-red-100 rounded-2xl text-red-500 font-bold outline-none">
                    <span class="absolute right-5 top-4 text-red-500">*</span>
                </div>
                <p class="text-gray-400 text-sm md:text-base">*Mã giới thiệu là bắt buộc để tham gia hệ thống.</p>
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div>
                    <button type="submit"
                        class="w-full bg-black text-white py-5 rounded-full font-bold text-lg hover:bg-gray-800 transition transform active:scale-95 shadow-lg mt-5">
                        Tạo tài khoản
                    </button>
                </div>
            </form>

            <p class="mt-5 text-center text-gray-600">
                Nếu đã có tài khoản, vui lòng <a href="/login" class="text-red-500 font-bold">Đăng Nhập</a> tại đây
            </p>
        </div>
    </div>
    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);

            if (passwordInput.type === 'password') {
                // Hiện mật khẩu
                passwordInput.type = 'text';
                // Đổi icon sang trạng thái "gạch chéo" (ẩn)
                eyeIcon.innerHTML = `
            <path d="M53.92,34.62A8,8,0,1,0,42.08,45.38L61.32,66.55C25,88.84,9.38,123.2,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208a127.11,127.11,0,0,0,52.07-10.83l22,24.21a8,8,0,1,0,11.84-10.76Zm47.33,75.84,41.67,45.85a32,32,0,0,1-41.67-45.85ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.16,133.16,0,0,1,25,128c4.69-8.79,19.66-33.39,47.35-49.38l18,19.75a48,48,0,0,0,63.66,70l14.73,16.2A112,112,0,0,1,128,192Zm6-95.43a8,8,0,0,1,3-15.72,48.16,48.16,0,0,1,38.77,42.64,8,8,0,0,1-7.22,8.71,6.39,6.39,0,0,1-.75,0,8,8,0,0,1-8-7.26A32.09,32.09,0,0,0,134,96.57Zm113.28,34.69c-.42.94-10.55,23.37-33.36,43.8a8,8,0,1,1-10.67-11.92A132.77,132.77,0,0,0,231.05,128a133.15,133.15,0,0,0-23.12-30.77C185.67,75.19,158.78,64,128,64a118.37,118.37,0,0,0-19.36,1.57A8,8,0,1,1,106,49.79,134,134,0,0,1,128,48c34.88,0,66.57,13.26,91.66,38.35,18.83,18.83,27.3,37.62,27.65,38.41A8,8,0,0,1,247.31,131.26Z"></path>
        `;
            } else {
                // Ẩn mật khẩu
                passwordInput.type = 'password';
                // Đổi icon về trạng thái bình thường (mở mắt)
                eyeIcon.innerHTML = `
            <path d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z"></path>
        `;
            }
        }
    </script>
</x-guest-layout>
