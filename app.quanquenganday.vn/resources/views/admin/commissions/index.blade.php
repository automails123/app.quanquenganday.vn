<x-app-layout>
    <div class="p-6 bg-[#f8faff] min-h-screen" x-data="{ amount: '' }">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-bold">6. Danh sách hoa hồng theo tháng</h3>
                        <p class="text-xs text-gray-400">Theo dõi thu nhập và hoa hồng của user</p>
                    </div>
                    <i class="ph-file-text text-xl text-gray-300"></i>
                </div>

                <div class="space-y-4">
                    @forelse($monthlyCommissions as $item)
                    <div class="bg-gray-50 p-5 rounded-[2rem] border border-gray-100">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-400 text-sm font-medium">User</span>
                            <span class="font-bold text-sm">{{ $item->user->name }} - {{ $item->user->affiliate_id }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-400 text-sm font-medium">Tháng</span>
                            <span class="font-bold text-sm">{{ $item->created_at->format('m/Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400 text-sm font-medium">Hoa hồng</span>
                            <span class="font-bold text-sm text-blue-600">{{ number_format($item->amount) }}đ</span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-10 text-gray-400 italic">Chưa có dữ liệu hoa hồng</div>
                    @endforelse
                </div>
                <div class="mt-4">{{ $monthlyCommissions->links() }}</div>
            </div>

            <div class="space-y-8">
                @if($selectedUser)
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-bold">8. Quản lý hoa hồng từng user</h3>
                            <p class="text-xs text-gray-400">Theo dõi số dư và điều chỉnh cộng / trừ</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-[2rem] mb-8 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-400 text-sm font-medium">User</span>
                            <span class="font-bold text-sm text-blue-600">{{ $selectedUser->name }} - {{ $selectedUser->affiliate_id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400 text-sm font-medium">Số dư hoa hồng</span>
                            <span class="font-bold text-lg">{{ number_format($selectedUser->balance) }}đ</span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="text-xs font-bold text-gray-400 uppercase ml-2">Nhập số tiền điều chỉnh</label>
                        <input type="number" x-model="amount" placeholder="Ví dụ: 500000" 
                               class="w-full mt-2 p-4 bg-gray-50 border-none rounded-2xl font-bold focus:ring-2 focus:ring-black">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <form action="{{ route('admin.commissions.adjust', $selectedUser->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="plus">
                            <input type="hidden" name="amount" :value="amount">
                            <button class="w-full py-4 bg-green-50 text-green-600 rounded-2xl font-bold hover:bg-green-100 transition">
                                + Cộng số dư
                            </button>
                        </form>

                        <form action="{{ route('admin.commissions.adjust', $selectedUser->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="minus">
                            <input type="hidden" name="amount" :value="amount">
                            <button class="w-full py-4 bg-red-50 text-red-600 rounded-2xl font-bold hover:bg-red-100 transition">
                                - Trừ số dư
                            </button>
                        </form>
                    </div>

                    <button class="w-full mt-4 py-4 bg-black text-white rounded-2xl font-bold flex items-center justify-center gap-2">
                        <i class="ph-user-focus"></i> Xem chi tiết hoa hồng user
                    </button>
                </div>
                @else
                <div class="bg-white p-12 rounded-[2.5rem] border-2 border-dashed border-gray-100 flex flex-col items-center justify-center text-center">
                    <p class="text-gray-400">Vui lòng chọn một User từ danh sách hoặc tìm kiếm để quản lý số dư.</p>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>