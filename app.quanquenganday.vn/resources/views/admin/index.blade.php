<x-app-layout>
    {{-- <x-slot name="header">

    </x-slot> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="md:py-12 container mx-auto max-md:mb-10 min-h-screen p-4">
        <div class="mb-4 md:mb-6">
            <h1 class="text-xl md:text-2xl font-bold text-gray-900">Gán phường cho user</h1>
            <p class="text-xs md:text-sm text-gray-500 font-medium">Phân quyền khu vực quản lý địa bàn</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($users as $user)
                <div class="bg-white p-4 md:p-7 rounded-3xl shadow-sm border border-gray-100">

                    <div class="bg-gray-50 p-3 md:p-4 rounded-3xl mb-6">
                        <div class="flex justify-between mb-4 gap-1.5">
                            <span class="text-gray-600">User</span>
                            <span class="font-bold">{{ $user->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Phường hiện tại</span>
                            <div class="text-right">
                                @forelse($user->wards as $ward)
                                    <span class="font-bold block">{{ $ward->name }}</span>
                                @empty
                                    <span class="text-gray-400 italic">Chưa gán</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <button type="button"
                        onclick="openAssignModal('{{ $user->id }}', '{{ $user->name }}', {{ json_encode($user->wards->map(fn($w) => ['code' => $w->code, 'name' => $w->name])) }})"
                        class="w-full bg-black text-white py-2 md:py-4 rounded-2xl font-bold shadow-lg">
                        {{ $user->wards->count() > 0 ? 'Thay đổi phường' : 'Gán phường' }}
                    </button>

                </div>
            @endforeach
        </div>

        <div id="assignModal" class="hidden fixed inset-0 bg-black/50 z-[100] flex items-center justify-center p-4">
            <div class="bg-white w-full max-w-m4 md:p-7 rounded-3xl p-10 shadow-2xl">
                <h2 id="modal_title" class="text-2xl font-bold mb-8">Gán phường</h2>

                <form action="{{ route('admin.assign.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="user_id_input" name="user_id">

                    <div class="mb-8">
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-3 ml-1">Chọn danh sách
                            phường</label>
                        <select id="ward_select_multi" name="ward_codes[]" class="w-full" multiple="multiple"></select>
                    </div>

                    <div class="flex gap-4">
                        <button type="button" onclick="closeModal()" class="flex-1 py-4 font-bold text-gray-400">Hủy
                            bỏ</button>
                        <button type="submit"
                            class="flex-1 bg-black text-white py-4 rounded-2xl font-bold shadow-lg">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Đảm bảo dùng 'jQuery' thay vì '$' để tránh xung đột
    (function() {
        // 1. Hàm đóng Modal (Dùng JS thuần)
        window.closeModal = function() {
            const modal = document.getElementById('assignModal');
            if (modal) modal.classList.add('hidden');
        };

        // 2. Hàm mở Modal (Dùng JS thuần + jQuery cho Select2)
        window.openAssignModal = function(userId, userName, currentWards = []) {
            const modal = document.getElementById('assignModal');
            const title = document.getElementById('modal_title');
            const inputId = document.getElementById('user_id_input');
            const selectEl = document.getElementById('ward_select_multi');

            if (!modal || !selectEl) {
                alert("Lỗi: Không tìm thấy ID assignModal hoặc ward_select_multi trong HTML!");
                return;
            }

            // Điền thông tin
            inputId.value = userId;
            title.innerText = currentWards.length > 0 ? `Thay đổi phường cho ${userName}` :
                `Gán phường cho ${userName}`;

            // Hiện Modal
            modal.classList.remove('hidden');

            // Khởi tạo Select2 bằng jQuery
            const $select = jQuery(selectEl);

            // Làm sạch Select2
            if ($select.data('select2')) {
                $select.select2('destroy'); // Hủy cái cũ nếu có để tránh lỗi khởi tạo đè
            }
            $select.html('').val(null).trigger('change');

            // Khởi tạo mới
            $select.select2({
                dropdownParent: jQuery(modal),
                placeholder: "Tìm kiếm phường...",
                width: '100%',
                ajax: {
                    url: "/api/search-wards",
                    dataType: 'json',
                    delay: 250,
                    data: params => ({
                        q: params.term
                    }),
                    processResults: data => ({
                        results: data
                    })
                }
            });

            // Nạp phường hiện tại (nếu có)
            if (currentWards && currentWards.length > 0) {
                currentWards.forEach(ward => {
                    const option = new Option(ward.name, ward.code, true, true);
                    $select.append(option);
                });
                $select.trigger('change');
            }
        };
    })();
</script>
