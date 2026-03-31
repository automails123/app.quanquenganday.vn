@php
    $displayPhone = session('sale_phone', '');
@endphp
<x-guest-layout>
    <div class="py-3">
        <x-authentication-card-logo />
        <div class="max-w-screen-sm mx-auto px-4">
            <div class="text-center pt-4">
                <div class="mb-4 flex items-center gap-3">
                    <span
                        class="flex items-center justify-center rounded-xl w-12 h-12 flex-shrink-0 bg-blue-100 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" width="32" height="32"
                            fill="currentcolor" viewBox="0 0 256 256">
                            <path
                                d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96h0v16a40,40,0,0,0,16,32v72a8,8,0,0,0,8,8H208a8,8,0,0,0,8-8V144a40,40,0,0,0,16-32V96ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-35.12,21.26,7.88,7.88,0,0,0-1.82-1.06A24,24,0,0,1,40,112v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm4.93-75.8a8.08,8.08,0,0,0-1.8,1.05A24,24,0,0,1,168,112v-8h48v8A24,24,0,0,1,204.93,132.2Z">
                            </path>
                        </svg>
                    </span>
                    <h2 class="text-2xl font-bold text-gray-800 text-left">Thông tin đã được gửi thành công</h2>
                </div>
                <p class="text-gray-500 text-left">
                    Vui lòng giữ điện trong trạng thái liên lạc. Sale sẽ chủ động gọi lại để xác nhận thông tin quán và
                    hỗ trợ các bước tiếp theo.
                </p>
            </div>
            <div class="bg-white shadow-md my-4 rounded-2xl p-5 md:px-7">
                <h2 class="text-2xl font-bold text-gray-800 text-left mb-3">Hotline sale hỗ trợ</h2>
                <div class="rounded-2xl bg-gray-100 p-4 md:p-6 mb-3">
                    <p class="text-gray-600 text-sm mb-1">Số hotline</p>
                    <a href="tel:{{$displayPhone}}"
                        class="text-black font-bold text-3xl no-underline inline-block mb-1">{{ substr($displayPhone, 0, 4) . ' ' . substr($displayPhone, 4, 3) . ' ' . substr($displayPhone, 7) }}</a>
                    <p class="text-gray-600 text-sm">Hỗ trợ tư vấn đăng ký quán, POS, hỗ trợ và kích hoạt dịch vụ.</p>
                </div>
                <div class="flex items-center justify-center mt-4 gap-2 sm:gap-4 md:gap-6">
                    <a href="tel:{{$displayPhone}}"
                        class="bg-black font-bold text-white  no-underline flex-1 px-2 py-3 rounded-2xl hover:opacity-55">
                        <span class="flex items-center justify-center gap-2"><svg class="w-5 h-5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>Gọi hotline</span>
                    </a>
                    <a href="#"
                        class="bg-gray-50 border border-gray-400 font-bold text-gray-500  no-underline flex-1 px-2 py-3 rounded-2xl hover:opacity-55">
                        <span class="flex items-center justify-center gap-2"><svg class="w-5 h-5"
                                xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                viewBox="0 0 256 256">
                                <path
                                    d="M128,24A104,104,0,0,0,36.18,176.88L24.83,210.93a16,16,0,0,0,20.24,20.24l34.05-11.35A104,104,0,1,0,128,24Zm0,192a87.87,87.87,0,0,1-44.06-11.81,8,8,0,0,0-6.54-.67L40,216,52.47,178.6a8,8,0,0,0-.66-6.54A88,88,0,1,1,128,216Z">
                                </path>
                            </svg>Chat hỗ trợ</span>
                    </a>

                </div>
                <div class="mt-4 text-gray-600">
                    <div class="flex items-start gap-2 md:gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            viewBox="0 0 256 256">
                            <path
                                d="M229.66,58.34l-32-32a8,8,0,0,0-11.32,0l-96,96A8,8,0,0,0,88,128v32a8,8,0,0,0,8,8h32a8,8,0,0,0,5.66-2.34l96-96A8,8,0,0,0,229.66,58.34ZM124.69,152H104V131.31l64-64L188.69,88ZM200,76.69,179.31,56,192,43.31,212.69,64ZM224,128v80a16,16,0,0,1-16,16H48a16,16,0,0,1-16-16V48A16,16,0,0,1,48,32h80a8,8,0,0,1,0,16H48V208H208V128a8,8,0,0,1,16,0Z">
                            </path>
                        </svg>
                        <div>
                            <p class="font-bold mb-1">Lưu ý</p>
                            <p class="leading-5 font-italic">Nếu cần hỗ trợ gấp, bạn có thể gọi trực tiếp hotline sale để được xử lý nhanh hơn.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
