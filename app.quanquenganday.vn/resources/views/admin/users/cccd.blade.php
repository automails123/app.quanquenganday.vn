<x-app-layout>
    <div class="px-4 pt-4 pb-20 md:py-12 container mx-auto min-h-screen" x-data="{ openModal: false, front: '', back: '', userId: '', userName: '' }">
        <div class="max-lg:px-4 mb-4 md:mb-6 flex items-center justify-between gap-1">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Danh sách user gửi xác minh CCCD</h1>
                <p class="text-xs md:text-sm text-gray-500">Kiểm tra và duyệt hồ sơ CCCD do user gửi lên</p>
            </div>
            <span class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                    <path
                        d="M213.66,66.34l-40-40A8,8,0,0,0,168,24H88A16,16,0,0,0,72,40V56H56A16,16,0,0,0,40,72V216a16,16,0,0,0,16,16H168a16,16,0,0,0,16-16V200h16a16,16,0,0,0,16-16V72A8,8,0,0,0,213.66,66.34ZM168,216H56V72h76.69L168,107.31v84.53c0,.06,0,.11,0,.16s0,.1,0,.16V216Zm32-32H184V104a8,8,0,0,0-2.34-5.66l-40-40A8,8,0,0,0,136,56H88V40h76.69L200,75.31Zm-56-32a8,8,0,0,1-8,8H88a8,8,0,0,1,0-16h48A8,8,0,0,1,144,152Zm0,32a8,8,0,0,1-8,8H88a8,8,0,0,1,0-16h48A8,8,0,0,1,144,184Z">
                    </path>
                </svg>
            </span>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($users as $user)
                <div class="bg-white p-4 md:p-6 rounded-3xl shadow-sm border border-gray-50">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400 font-medium text-sm">User</span>
                            <span class="font-bold text-gray-800 text-right">{{ $user->name }}<br><small
                                    class="text-gray-400 font-normal">{{ $user->affiliate_id }}</small></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400 font-medium text-sm">SĐT</span>
                            <span class="font-bold text-gray-800">{{ $user->phone ?? 'Chưa cập nhật' }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400 font-medium">Trạng thái CCCD</span>
                            @php
                                $status = $user->cccd_status;
                            @endphp
                            <span
                                class="font-bold {{ match ($status) {
                                    'approved' => 'text-green-600',
                                    'processing' => 'text-orange-600',
                                    'rejected' => 'text-red-600',
                                    default => 'text-gray-500',
                                } }}">

                                @if ($status === 'pending')
                                    Chưa cập nhật
                                @elseif($status === 'processing')
                                    Đang chờ duyệt
                                @elseif($status === 'approved')
                                    Đã xác minh
                                @elseif($status === 'rejected')
                                    Thử lại
                                @else
                                    Chưa cập nhật dữ liệu
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 md:mt-8 flex gap-2 md:gap-3">
                        {{-- Nút xem ảnh dùng Alpine.js để gán link ảnh vào modal --}}
                        <button
                            @click="openModal = true; 
                            userId = '{{ $user->id }}'; 
                            userName = '{{ $user->name }}';
                            front = '{{ $user->cccd_front_image ? asset('storage/users/cccd/' . $user->cccd_front_image) : '' }}'; 
                            back = '{{ $user->cccd_back_image ? asset('storage/users/cccd/' . $user->cccd_back_image) : '' }}';"
                            class="flex-1 py-2.5 bg-gray-100 text-gray-700 rounded-2xl font-bold text-sm hover:bg-gray-200 transition">
                            Xem hồ sơ
                        </button>

                        @if ($user->cccd_status == 'processing')
                            <form action="{{ route('admin.users.verify-cccd', $user->id) }}" method="POST"
                                class="flex-1">
                                @csrf
                                <button
                                    class="w-full py-2.5 bg-black text-white rounded-2xl font-bold text-sm hover:bg-gray-800 shadow-lg shadow-black/20">
                                    Duyệt
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                @empty
                    <div
                        class="col-span-12 py-20 flex flex-col items-center justify-center bg-white rounded-3xl border border-dashed border-gray-200">
                        <div class="p-4 bg-gray-50 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#9ca3af"
                                viewBox="0 0 256 256">
                                <path
                                    d="M208,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM48,48H208V208H48ZM152,120a8,8,0,0,1-8,8H112a8,8,0,0,1,0-16h32A8,8,0,0,1,152,120Zm0,32a8,8,0,0,1-8,8H112a8,8,0,0,1,0-16h32A8,8,0,0,1,152,152Z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-base md:text-lg font-bold text-gray-900">Hiện tại không có hồ sơ nào cần duyệt hoặc cập nhật.</p>
                    </div>
                @endforelse
            </div>

            <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60" x-cloak>
                <div @click.away="openModal = false"
                    class="bg-white rounded-3xl p-8 max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Hồ sơ CCCD: <span x-text="userName"
                                class="text-blue-600"></span></h3>
                        <button @click="openModal = false" class="text-gray-400 hover:text-black text-2xl">&times;</button>
                    </div>

                    {{-- Form này sẽ xử lý upload nếu chưa có ảnh --}}
                    <form :action="'/admin/users/' + userId + '/update-cccd-images'" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <p class="text-sm font-bold text-gray-500 uppercase">Mặt trước CCCD</p>
                                <div class="relative group">
                                    {{-- Nếu có biến front (link hoặc blob) thì hiện img --}}
                                    <template x-if="front">
                                        <img :src="front"
                                            class="w-full h-48 object-cover rounded-3xl border-2 border-gray-100 shadow-sm">
                                    </template>

                                    {{-- Nếu chưa có gì thì hiện khung upload --}}
                                    <template x-if="!front">
                                        <div
                                            class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-200 rounded-3xl bg-gray-50">
                                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            <span class="text-xs text-gray-400 font-bold">Chưa có ảnh</span>
                                        </div>
                                    </template>

                                    {{-- Label bao phủ để bấm vào là chọn file --}}
                                    <label
                                        class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition rounded-3xl cursor-pointer">
                                        <span class="text-white text-xs font-bold">Bấm để chọn ảnh</span>
                                        <input type="file" name="cccd_front_image" class="hidden"
                                            @change="front = URL.createObjectURL($event.target.files[0])">
                                    </label>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <p class="text-sm font-bold text-gray-500 uppercase">Mặt sau CCCD</p>
                                <div class="relative group">
                                    <template x-if="back">
                                        <img :src="back"
                                            class="w-full h-48 object-cover rounded-3xl border-2 border-gray-100 shadow-sm">
                                    </template>
                                    <template x-if="!back">
                                        <div
                                            class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-200 rounded-3xl bg-gray-50">
                                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            <span class="text-xs text-gray-400 font-bold">Chưa có ảnh</span>
                                        </div>
                                    </template>
                                    <label
                                        class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition rounded-3xl cursor-pointer">
                                        <span class="text-white text-xs font-bold">Bấm để chọn ảnh</span>
                                        <input type="file" name="cccd_back_image" class="hidden"
                                            @change="back = URL.createObjectURL($event.target.files[0])">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex gap-3">
                            <button type="button" @click="openModal = false"
                                class="flex-1 py-4 bg-gray-100 text-gray-600 rounded-2xl font-bold uppercase text-xs tracking-widest">Hủy</button>
                            <button type="submit"
                                class="flex-1 py-4 bg-black text-white rounded-2xl font-bold uppercase text-xs tracking-widest shadow-lg shadow-black/20">Lưu
                                hồ sơ</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-6 max-md:px-4">{{ $users->links() }}</div>
        </div>
    </x-app-layout>
