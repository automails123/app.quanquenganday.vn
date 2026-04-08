<x-app-layout>
    {{-- Đưa x-data bao quát toàn bộ nội dung, kể cả Modal --}}
    <div class="md:py-12 container mx-auto max-md:mb-10 min-h-screen p-4" x-data="{
        openModal: false,
        selectedUser: { id: '', name: '', affiliate_id: '', balance: 0 },
        adjustAmount: '',
        adjustNote: ''
    }">

        <div class="flex items-center justify-between mb-8">
            <div>
                <h3 class="text-lg md:text-2xl font-bold text-gray-900">Danh sách hoa hồng theo tháng</h3>
                <p class="text-xs md:text-sm text-gray-600 mt-1">Theo dõi thu nhập và hoa hồng của user theo tháng</p>
            </div>
            <div class="p-3 bg-gray-50 rounded-2xl text-gray-400">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    viewBox="0 0 256 256">
                    <path
                        d="M216,64H56a8,8,0,0,1,0-16H192a8,8,0,0,0,0-16H56A24,24,0,0,0,32,56V184a24,24,0,0,0,24,24H216a16,16,0,0,0,16-16V80A16,16,0,0,0,216,64Zm0,128H56a8,8,0,0,1-8-8V78.63A23.84,23.84,0,0,0,56,80H216Zm-48-60a12,12,0,1,1,12,12A12,12,0,0,1,168,132Z">
                    </path>
                </svg>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @forelse($monthlyCommissions as $comm)
                {{-- Đã xóa con số 6 thừa và dọn dẹp @click --}}
                <div class="p-4 md:p-6 bg-white rounded-3xl border border-gray-50 shadow-sm hover:border-blue-100 transition cursor-pointer"
                    @click="
                        openModal = true; 
                        selectedUser = { 
                            id: '{{ $comm->user_id }}', 
                            name: '{{ $comm->user->name }}', 
                            affiliate_id: '{{ $comm->user->affiliate_id }}',
                            balance: {{ $comm->user->balance ?? 0 }}
                        };
                        adjustAmount = ''; {{-- Reset lại số tiền khi mở user mới --}}
                    ">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-gray-600 text-xs font-bold uppercase tracking-wider">User</span>
                        <span class="font-bold text-gray-800">{{ $comm->user->name }} -
                            <span>{{ $comm->user->affiliate_id }}</span></span>
                    </div>
                    <div class="flex justify-between items-center mb-3 text-sm">
                        <span class="text-gray-600">Tháng</span>
                        <span
                            class="font-semibold ">{{ $comm->created_at ? $comm->created_at->format('m/Y') : 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 text-sm">Hoa hồng</span>
                        <span class="font-semibold text-blue-500">{{ number_format($comm->amount) }}đ</span>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center text-gray-400 italic">Chưa có dữ liệu hoa hồng.</div>
            @endforelse
        </div>

        <div class="mt-6">{{ $monthlyCommissions->links() }}</div>

        <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60" x-cloak
            x-transition>
            <div @click.away="openModal = false" class="bg-white rounded-3xl p-3 md:p-8 max-w-xl w-full shadow-2xl">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-black text-gray-900">Quản lý số dư</h3>
                    <button @click="openModal = false" class="text-gray-400 hover:text-black text-2xl">&times;</button>
                </div>

                <div
                    class="bg-white p-4 md:p-6 rounded-3xl mb-5 md:mb-8 md:flex md:justify-between md:items-center border border-blue-50">
                    <div>
                        <p class="text-xs text-blue-400 font-bold capitalize mb-1">User</p>
                        <h4 class="text-sm md:text-base font-black text-gray-800"
                            x-text="selectedUser.name + ' - ' + selectedUser.affiliate_id"></h4>
                    </div>
                    <div class="md:text-right max-md:mt-4">
                        <p class="text-xs text-gray-400 font-bold capitalize mb-1">Số dư hiện tại</p>
                        <span class="text-base md:text-lg font-black text-blue-600"
                            x-text="new Intl.NumberFormat('vi-VN').format(selectedUser.balance) + 'đ'"></span>
                    </div>
                </div>

                <div class="space-y-4 md:space-y-6 max-md:mt-4">
                    <div>
                        <label class="text-xs font-bold text-gray-400 capitalize ml-3">Số tiền điều chỉnh</label>
                        <input type="number" x-model="adjustAmount" placeholder="0"
                            class="w-full mt-2 p-4 md:p-5 bg-gray-50 border-none rounded-3xl font-black text-xl focus:ring-2 focus:ring-black outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <form :action="'/admin/commissions/adjust-balance/' + selectedUser.id" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="plus">
                            <input type="hidden" name="amount" :value="adjustAmount">
                            <button type="submit"
                                class="w-full py-3 md:py-5 bg-green-50 text-green-600 rounded-[1.5rem] font-bold hover:bg-green-100 transition">
                                + Cộng số dư
                            </button>
                        </form>

                        <form :action="'/admin/commissions/adjust-balance/' + selectedUser.id" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="minus">
                            <input type="hidden" name="amount" :value="adjustAmount">
                            <button type="submit"
                                class="w-full py-3 md:py-5 bg-red-50 text-red-600 rounded-[1.5rem] font-bold hover:bg-red-100 transition">
                                - Trừ số dư
                            </button>
                        </form>
                    </div>
                    <a :href="'{{ route('admin.commissions.user_detail', ['id' => 'TEMP_ID']) }}'.replace('TEMP_ID', selectedUser
                        .id)"
                        class="w-full mt-4 py-4 bg-black text-white rounded-2xl font-bold flex items-center justify-center gap-2 hover:bg-gray-800 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white"
                            viewBox="0 0 256 256">
                            <path
                                d="M244.66,91.34l-40-40a8,8,0,0,0-11.32,11.32L220.69,92H104a72.08,72.08,0,0,0-72,72v48a8,8,0,0,0,16,0V164a56.06,56.06,0,0,1,56-56H220.69l-27.35,27.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,244.66,91.34Z">
                            </path>
                        </svg>
                        Xem chi tiết hoa hồng user
                    </a>
                </div>
            </div>
        </div>

    </div> {{-- Đóng x-data ở đây --}}
</x-app-layout>
