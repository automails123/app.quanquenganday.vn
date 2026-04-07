<x-app-layout>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <div class="pt-4 pb-10 md:py-12 container mx-auto max-md:mb-10 min-h-screen">
        <div class="max-lg:px-4 mb-4 md:mb-6 flex items-center justify-between gap-1">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Danh sách User</h1>
                <p class="text-xs md:text-sm text-gray-500 font-medium">Quản lý sale, user, cộng tác viên</p>
            </div>
            <div class="bg-gray-100 p-3 rounded-2xl">
                <svg class="w-5 h-5 md:w-8 md:h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="32"
                    height="32" fill="currentColor" viewBox="0 0 256 256">
                    <path
                        d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z">
                    </path>
                </svg>
            </div>
        </div>

        <div class="mb-4 md:mb-6">
            <form action="{{ route('admin.users.index') }}" method="GET" class="relative">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full pl-12 pr-4 py-3 bg-white border-none shadow-sm rounded-2xl focus:ring-2 focus:ring-black"
                    placeholder="Tìm tên, mã sale, email...">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </form>
        </div>

        <div class="grid bg-white rounded-3xl overflow-hidden divide-y-2 border">
            @forelse($users as $user)
                <div
                    class="bg-white p-3 md:p-4 shadow-sm flex items-center justify-between hover:bg-gray-100 transition">
                    <div>
                        <h3 class="font-bold text-gray-900">
                            {{ $user->name }}
                            <span class="text-gray-400 font-normal"> • {{ $user->affiliate_id ?? 'USER' }} • </span>
                            <span class="{{ $user->status_class }} font-medium">
                                {{ $user->status_label }}
                            </span>
                        </h3>
                        <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider font-semibold">
                            Vai trò: {{ $user->role }}
                        </p>
                    </div>
                    <button
                        @click="$dispatch('edit-user', { 
                            id: {{ $user->id }}, 
                            name: '{{ addslashes($user->name) }}', 
                            role: '{{ $user->role }}', 
                            status: '{{ $user->status }}' 
                        })"
                        class="p-2 bg-gray-50 rounded-xl hover:bg-gray-100">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125">
                            </path>
                        </svg>
                    </button>
                </div>
            @empty
                <div class="text-center py-10 bg-white rounded-3xl">
                    <p class="text-gray-400 italic">Không tìm thấy user nào...</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6 max-md:px-4">
            {{ $users->links() }}
        </div>
    </div>
    <div x-data="{ open: false, user: {} }" 
     @edit-user.window="open = true; user = $event.detail"
     x-show="open"
        class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black opacity-40" @click="open = false"></div>

            <div
                class="bg-white rounded-3xl overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full p-6 z-10">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Cập nhật: <span x-text="user.name"></span></h3>

                <form :action="'/admin/users/' + user.id + '/update-quick'" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vai trò</label>
                        <select name="role" x-model="user.role"
                            class="w-full border-gray-200 rounded-xl focus:ring-black">
                            <option value="admin">Admin</option>
                            <option value="sale">Sale</option>
                            <option value="ctv">Cộng tác viên</option>
                            <option value="user">Người dùng</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Trạng thái</label>
                        <select name="status" x-model="user.status"
                            class="w-full border-gray-200 rounded-xl focus:ring-black">
                            <option value="active">Đã xác minh (Active)</option>
                            <option value="pending">Chờ xác minh (Pending)</option>
                            <option value="blocked">Khóa tài khoản</option>
                        </select>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" @click="open = false"
                            class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-xl font-bold">Hủy</button>
                        <button type="submit" class="flex-1 px-4 py-2 bg-black text-white rounded-xl font-bold">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</x-app-layout>
