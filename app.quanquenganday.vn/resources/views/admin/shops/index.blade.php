<x-app-layout>
    <div class="pt-4 pb-10 md:py-12 container mx-auto max-md:mb-10 min-h-screen">
        <div class="max-lg:px-4 mb-4 md:mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Quản lý tổng danh sách quán</h1>
                <p class="text-xs md:text-sm text-gray-500 font-medium">Tìm kiếm, lọc, xem trạng thái hồ sơ quán</p>
            </div>
            <span>
                <svg class="w-5 h-5 md:w-8 md:h-8" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                    fill="currentColor" viewBox="0 0 256 256">
                    <path
                        d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96h0v16a40,40,0,0,0,16,32v72a8,8,0,0,0,8,8H208a8,8,0,0,0,8-8V144a40,40,0,0,0,16-32V96ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-35.12,21.26,7.88,7.88,0,0,0-1.82-1.06A24,24,0,0,1,40,112v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm4.93-75.8a8.08,8.08,0,0,0-1.8,1.05A24,24,0,0,1,168,112v-8h48v8A24,24,0,0,1,204.93,132.2Z">
                    </path>
                </svg>
            </span>
        </div>

        <div class="py-4 md:p-6 bg-white w-full max-md:overflow-x-auto shadow-sm md:rounded-2xl border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-gray-400 text-sm border-b border-gray-100">
                        <th class="pb-3 px-4 font-medium max-md:whitespace-nowrap max-md:min-w-60 text-left">TÊN QUÁN</th>
                        <th class="pb-3 px-4 font-medium max-md:whitespace-nowrap text-left">CHỦ QUÁN</th>
                        <th class="pb-3 px-4 font-medium max-md:whitespace-nowrap text-left max-md:min-w-52">SALE HỖ TRỢ</th>
                        <th class="pb-3 px-4 font-medium max-md:whitespace-nowrap text-center md:w-60">TRẠNG THÁI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($shops as $shop)
                        <tr>
                            <td class="px-4 py-4">
                                <p class="font-bold text-gray-800 capitalize">{{ $shop->name }}</p>
                                <p class="text-xs text-gray-400">{{ $shop->phone }}</p>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600 capitalize">{{ $shop->owner_name }}</td>
                            <td class="px-4 py-4">
                                <span class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded-lg">
                                    {{ $shop->sale->name ?? 'Hệ thống' }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                {{-- <span
                                    class="px-3 py-1 text-[11px] font-bold uppercase rounded-full border {{ $shop->status_color }}">
                                    {{ $shop->status_text }}
                                </span> --}}
                                <div class="relative flex items-center gap-2">
                                    <select onchange="updateShopStatus(this, {{ $shop->id }})"
                                        class="status-select text-center px-2 md:px-3 py-1 md:py-2 text-xs font-bold capitalize rounded-full border transition-all cursor-pointer focus:ring-0 {{ $shop->status_color }}">
                                        <option value="pending" {{ $shop->status == 'pending' ? 'selected' : '' }}>Đang
                                            tư vấn</option>
                                        <option value="paid" {{ $shop->status == 'paid' ? 'selected' : '' }}>Đã mua
                                            POS</option>
                                        <option value="published" {{ $shop->status == 'published' ? 'selected' : '' }}>
                                            Đã lên App quán quen</option>
                                        <option value="active" {{ $shop->status == 'active' ? 'selected' : '' }}>Đã mua POS, Đã lên App quán quen</option>
                                        <option value="rejected" {{ $shop->status == 'rejected' ? 'selected' : '' }}>Bị
                                            từ chối</option>
                                    </select>

                                    <div id="loading-{{ $shop->id }}" class="hidden">
                                        <svg class="animate-spin h-4 w-4 text-gray-500"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </td>
                            {{-- <td class="px-4 py-4 text-right">
                                <a href="{{ route('admin.shops.show', $shop->id) }}"
                                    class="text-blue-500 hover:underline text-sm">Chi tiết</a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 max-md:px-4">
                {{ $shops->links() }}
            </div>
        </div>
    </div>
    <script>
        function updateShopStatus(selectElement, shopId) {
            const newStatus = selectElement.value;
            const loadingIcon = document.getElementById(`loading-${shopId}`);
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Hiện icon loading và làm mờ select
            loadingIcon.classList.remove('hidden');
            selectElement.classList.add('opacity-50');

            fetch(`/admin/shops/${shopId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    status: newStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật lại màu sắc của Select dựa trên dữ liệu trả về từ Controller
                    // (Hoặc đơn giản là reload nhẹ nếu bạn muốn cập nhật toàn bộ thuộc tính màu của Model)
                    location.reload(); 
                } else {
                    alert('Có lỗi xảy ra: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Không thể kết nối máy chủ!');
            })
            .finally(() => {
                loadingIcon.classList.add('hidden');
                selectElement.classList.remove('opacity-50');
            });
        }
    </script>
</x-app-layout>
