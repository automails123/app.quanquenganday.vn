<x-app-layout>

    <div class="md:py-12 container mx-auto md:min-h-[calc(100vh-65px)] flex items-center">
        <div
            class="bg-white overflow-hidden shadow-xl rounded-xl md:rounded-3xl px-4 py-6 md:p-6 w-full max-w-screen-sm mx-auto h-full">
            <div class="flex items-center justify-between gap-1 mb-3 md:mb-6">
                <h2 class="font-bold text-gray-700 text-lg md:text-xl capitalize">Đổi mật khẩu</h2>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M15 7a2 2 0 012 2m4 0a6 6 0. 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
            @if ($errors->any())
                <div class="mb-4"> {{-- Thay {{ $attributes }} bằng class CSS bình thường --}}
                    <div class="font-medium text-red-600">
                        {{ __('Rất tiếc! Đã có lỗi xảy ra.') }}
                    </div>

                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('user.password.update') }}">
                @csrf
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <div>
                    <x-label for="current_password" value="{{ __('Mật khẩu hiện tại') }}" />
                    <div class="relative">
                        <x-input id="current_password" class="block mt-1 md:mt-2 md:py-3.5 w-full" type="password"
                            name="current_password" required autocomplete="off" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 cursor-pointer"
                            onclick="togglePassword('current_password', 'eye_icon_1')">
                            <svg id="eye_icon_1" class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                width="32" height="32" viewBox="0 0 256 256">
                                <path
                                    d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z">
                                </path>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Mật khẩu') }}" />
                    <div class="relative">
                    <x-input id="password" class="block mt-1 md:mt-2 md:py-3.5 w-full" type="password" name="password"
                        required autocomplete="off" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 cursor-pointer"
                            onclick="togglePassword('password', 'eye_icon_2')">
                            <svg id="eye_icon_2" class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                width="32" height="32" viewBox="0 0 256 256">
                                <path
                                    d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z">
                                </path>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Xác nhận mật khẩu') }}" />
                    <div class="relative">
                    <x-input id="password_confirmation" class="block mt-1 md:mt-2 md:py-3.5 w-full" type="password"
                        name="password_confirmation" required autocomplete="off" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 cursor-pointer"
                            onclick="togglePassword('password_confirmation', 'eye_icon_3')">
                            <svg id="eye_icon_3" class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                width="32" height="32" viewBox="0 0 256 256">
                                <path
                                    d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z">
                                </path>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="flex items-center justify-center mt-4 md:mt-6">
                    <x-button class="w-full text-center justify-center gap-2 py-3 md:py-4 md:w-80 ">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                            fill="currentColor" viewBox="0 0 256 256">
                            <path
                                d="M208,80H176V56a48,48,0,0,0-96,0V80H48A16,16,0,0,0,32,96V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V96A16,16,0,0,0,208,80ZM96,56a32,32,0,0,1,64,0V80H96ZM208,208H48V96H208V208Zm-68-56a12,12,0,1,1-12-12A12,12,0,0,1,140,152Z">
                            </path>
                        </svg>
                        {{ __('Cập nhật mật khẩu') }}
                    </x-button>
                </div>
            </form>
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
</x-app-layout>
