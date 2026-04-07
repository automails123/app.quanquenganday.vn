<x-app-layout>
    {{-- <x-slot name="header">

    </x-slot> --}}

    <div class="md:py-12 container mx-auto max-md:mb-10 min-h-screen">
        <div class="flex md:gap-8 lg:gap-10">
            <div class="w-96 flex-shrink-0">
                <div
                    class="bg-white overflow-hidden shadow-sm md:shadow-lg round-2xl md:rounded-2xl p-4 md:p-5">

                    <h3 class="text-lg font-bold text-gray-900 mb-4 px-2">Menu chức năng</h3>
                    <div class="space-y-4">
                        <a href="{{route('admin.dashboard')}}"
                            class="flex items-center justify-between bg-black p-4 rounded-2xl text-white shadow-lg shadow-black/20">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                                            stroke-width="2" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold">Dashboard quản trị</p>
                                    <p class="text-xs md:text-sm text-gray-400">Tổng quan hệ thống</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" stroke-width="2" />
                            </svg>
                        </a>

                        <a href="{{ route('admin.assign.index') }}"
                            class="flex items-center justify-between bg-gray-50 p-4 rounded-2xl border shadow-sm hover:bg-black transition group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M112,80a16,16,0,1,1,16,16A16,16,0,0,1,112,80ZM64,80a64,64,0,0,1,128,0c0,59.95-57.58,93.54-60,94.95a8,8,0,0,1-7.94,0C121.58,173.54,64,140,64,80Zm16,0c0,42.2,35.84,70.21,48,78.5,12.15-8.28,48-36.3,48-78.5a48,48,0,0,0-96,0Zm122.77,67.63a8,8,0,0,0-5.54,15C213.74,168.74,224,176.92,224,184c0,13.36-36.52,32-96,32s-96-18.64-96-32c0-7.08,10.26-15.26,26.77-21.36a8,8,0,0,0-5.54-15C29.22,156.49,16,169.41,16,184c0,31.18,57.71,48,112,48s112-16.82,112-48C240,169.41,226.78,156.49,202.77,147.63Z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 group-hover:text-white">Gắn phường cho user</p>
                                    <p class="text-xs md:text-sm text-gray-400">Phân khu vưc quản lý</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" stroke-width="2" />
                            </svg>
                        </a>
                        <a href="{{ route('admin.notifications.create') }}"
                            class="flex items-center justify-between bg-gray-50 p-4 rounded-2xl border shadow-sm hover:bg-black transition group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M221.8,175.94C216.25,166.38,208,139.33,208,104a80,80,0,1,0-160,0c0,35.34-8.26,62.38-13.81,71.94A16,16,0,0,0,48,200H88.81a40,40,0,0,0,78.38,0H208a16,16,0,0,0,13.8-24.06ZM128,216a24,24,0,0,1-22.62-16h45.24A24,24,0,0,1,128,216ZM48,184c7.7-13.24,16-43.92,16-80a64,64,0,1,1,128,0c0,36.05,8.28,66.73,16,80Z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 group-hover:text-white">Tạo thông báo</p>
                                    <p class="text-xs md:text-sm text-gray-400">Gửi text, ảnh đến user</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" stroke-width="2" />
                            </svg>
                        </a>

                        {{-- Item: Danh sách quán --}}
                        <a href="{{ route('admin.shops.index') }}"
                            class="flex items-center justify-between bg-gray-50 p-4 rounded-2xl border shadow-sm hover:bg-black transition group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96h0v16a40,40,0,0,0,16,32v72a8,8,0,0,0,8,8H208a8,8,0,0,0,8-8V144a40,40,0,0,0,16-32V96ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-35.12,21.26,7.88,7.88,0,0,0-1.82-1.06A24,24,0,0,1,40,112v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm4.93-75.8a8.08,8.08,0,0,0-1.8,1.05A24,24,0,0,1,168,112v-8h48v8A24,24,0,0,1,204.93,132.2Z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 group-hover:text-white">Danh sách quán</p>
                                    <p class="text-xs md:text-sm text-gray-400">Quản lý toàn bộ quán</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" stroke-width="2" />
                            </svg>
                        </a>

                        <a href="{{ route('admin.users.index') }}"
                            class="flex items-center justify-between bg-gray-50 p-4 rounded-2xl border shadow-sm hover:bg-black transition group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 group-hover:text-white">Danh sách user</p>
                                    <p class="text-xs md:text-sm text-gray-400">Sale, quản lý, cộng tác viên</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" stroke-width="2" />
                            </svg>
                        </a>

                        <a href="{{ route('admin.orders.index') }}"
                            class="flex items-center justify-between bg-gray-50 p-4 rounded-2xl border shadow-sm hover:bg-black transition group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M230.14,58.87A8,8,0,0,0,224,56H62.68L56.6,22.57A8,8,0,0,0,48.73,16H24a8,8,0,0,0,0,16h18L67.56,172.29a24,24,0,0,0,5.33,11.27,28,28,0,1,0,44.4,8.44h45.42A27.75,27.75,0,0,0,160,204a28,28,0,1,0,28-28H91.17a8,8,0,0,1-7.87-6.57L80.13,152h116a24,24,0,0,0,23.61-19.71l12.16-66.86A8,8,0,0,0,230.14,58.87ZM104,204a12,12,0,1,1-12-12A12,12,0,0,1,104,204Zm96,0a12,12,0,1,1-12-12A12,12,0,0,1,200,204Zm4-74.57A8,8,0,0,1,196.1,136H77.22L65.59,72H214.41Z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 group-hover:text-white ">Duyệt đơn hàng</p>
                                    <p class="text-xs md:text-sm text-gray-400">Đơn hàng sale tạo</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" stroke-width="2" />
                            </svg>
                        </a>

                        <a href="{{ route('admin.cccd.index') }}"
                            class="flex items-center justify-between bg-gray-50 p-4 rounded-2xl border shadow-sm hover:bg-black transition group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M208,40H48A16,16,0,0,0,32,56v56c0,52.72,25.52,84.67,46.93,102.19,23.06,18.86,46,25.26,47,25.53a8,8,0,0,0,4.2,0c1-.27,23.91-6.67,47-25.53C198.48,196.67,224,164.72,224,112V56A16,16,0,0,0,208,40Zm0,72c0,37.07-13.66,67.16-40.6,89.42A129.3,129.3,0,0,1,128,223.62a128.25,128.25,0,0,1-38.92-21.81C61.82,179.51,48,149.3,48,112l0-56,160,0ZM82.34,141.66a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35a8,8,0,0,1,11.32,11.32l-56,56a8,8,0,0,1-11.32,0Z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 group-hover:text-white ">Xác minh tài khoản</p>
                                    <p class="text-xs md:text-sm text-gray-400">Email, CCCD, hồ sơ</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" stroke-width="2" />
                            </svg>
                        </a>
                        <a href="{{ route('commissions.index') }}"
                            class="flex items-center justify-between bg-gray-50 p-4 rounded-2xl border shadow-sm hover:bg-black transition group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M216,64H56a8,8,0,0,1,0-16H192a8,8,0,0,0,0-16H56A24,24,0,0,0,32,56V184a24,24,0,0,0,24,24H216a16,16,0,0,0,16-16V80A16,16,0,0,0,216,64Zm0,128H56a8,8,0,0,1-8-8V78.63A23.84,23.84,0,0,0,56,80H216Zm-48-60a12,12,0,1,1,12,12A12,12,0,0,1,168,132Z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 group-hover:text-white ">Hoa hồng & số dư</p>
                                    <p class="text-xs md:text-sm text-gray-400">Quản lý tiền của từng user</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" stroke-width="2" />
                            </svg>
                        </a>

                    </div>

                </div>
            </div>
            <div class="flex-1">
                <div class="bg-white overflow-hidden shadow-sm md:shadow-lg round-2xl md:rounded-2xl p-4 md:p-5 lg:p-7 h-full">
                    <div class="mb-8">
                        <h1 class="text-2xl font-bold text-gray-900">Quản trị viên</h1>
                        <p class="text-sm text-gray-500">Quản lý user, quán, đơn hàng, xác minh và hoa hồng</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 md:gap-8">
                        <div class="bg-white p-6 rounded-[2rem] shadow-sm border ">
                            <p class="text-xs md:text-sm font-medium text-gray-400">Tổng user</p>
                            <h2 class="text-3xl font-black text-gray-900 my-1">{{ number_format($totalUser) }}</h2>
                            <p class="text-xs md:text-sm text-gray-500">Đang hoạt động <span
                                    class="font-bold">{{ $activeUser }}</span></p>
                        </div>

                        <div class="bg-white p-6 rounded-[2rem] shadow-sm border ">
                            <p class="text-xs md:text-sm font-medium text-gray-400">Tổng quán</p>
                            <h2 class="text-3xl font-black text-gray-900 my-1">{{ $totalShop }}</h2>
                            <p class="text-xs md:text-sm text-gray-500">Đã active <span
                                    class="font-bold">{{ $activeShop }}</span></p>
                        </div>

                        <div class="bg-white p-6 rounded-[2rem] shadow-sm border ">
                            <p class="text-xs md:text-sm font-medium text-gray-400">Đơn chờ duyệt</p>
                            <h2 class="text-3xl font-black text-gray-900 my-1 ">{{ $pendingShops }}</h2>
                            <p class="text-xs md:text-sm text-gray-500">Từ sale tạo</p>
                        </div>

                        <div class="bg-white p-6 rounded-[2rem] shadow-sm border ">
                            <p class="text-xs md:text-sm font-medium text-gray-400">Tổng quỹ hoa hồng</p>
                            <h2 class="text-3xl font-black text-gray-900 my-1">
                                {{ number_format($commissionFund / 1000000, 1) }}tr</h2>
                            <p class="text-xs md:text-sm text-gray-500">Tháng {{ now()->format('m/Y') }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>




    </div>
</x-app-layout>
