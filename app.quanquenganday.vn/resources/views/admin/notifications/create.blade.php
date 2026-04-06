<x-app-layout>
    {{-- <x-slot name="header">

    </x-slot> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="md:py-12 container mx-auto max-md:mb-10 min-h-screen p-4">
        <div class="mb-4 md:mb-6 flex items-center justify-between">
            <div class="">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Tạo thông báo</h1>
                <p class="text-xs md:text-sm text-gray-500 font-medium">Gửi text hoặc ảnh tới toàn bộ user / nhóm user
                </p>
            </div>
            <span>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    viewBox="0 0 256 256">
                    <path
                        d="M221.8,175.94C216.25,166.38,208,139.33,208,104a80,80,0,1,0-160,0c0,35.34-8.26,62.38-13.81,71.94A16,16,0,0,0,48,200H88.81a40,40,0,0,0,78.38,0H208a16,16,0,0,0,13.8-24.06ZM128,216a24,24,0,0,1-22.62-16h45.24A24,24,0,0,1,128,216ZM48,184c7.7-13.24,16-43.92,16-80a64,64,0,1,1,128,0c0,36.05,8.28,66.73,16,80Z">
                    </path>
                </svg>
            </span>
        </div>

        <div class="w-full bg-white p-4 md:p-6 rounded-3xl shadow-sm border border-gray-100">

            <form action="{{ route('admin.notifications.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-5">
                @csrf

                <div>
                    <input type="text" name="title" placeholder="Tiêu đề thông báo" required
                        class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/5 transition-all font-medium">
                </div>

                <div>
                    <textarea name="content" rows="6" placeholder="Nội dung text thông báo..." required
                        class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-black/5 transition-all resize-none"></textarea>
                </div>

                <div id="previewBox"
                    class="hidden relative w-full h-48 lg:h-60 rounded-3xl overflow-hidden border border-dashed border-gray-200 bg-gray-50 mb-4">
                    <img id="imgTag" src="#" class="w-full h-full object-cover">
                    <button type="button" onclick="removeImg()"
                        class="absolute top-3 right-3 bg-black/50 text-white p-2 rounded-full hover:bg-black">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"></path></svg>
                    </button>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="document.getElementById('fileInp').click()"
                        class="flex-1 bg-gray-100 text-black py-4 rounded-2xl font-bold hover:bg-gray-200 transition-all">
                        Tải ảnh lên
                    </button>
                    <input type="file" id="fileInp" name="image" class="hidden" accept="image/*"
                        onchange="preview(this)">

                    <button type="submit"
                        class="flex-1 bg-black text-white py-4 rounded-2xl font-bold shadow-lg hover:opacity-90 active:scale-95 transition-all">
                        Gửi thông báo
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    function preview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imgTag').src = e.target.result;
                document.getElementById('previewBox').classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImg() {
        document.getElementById('fileInp').value = "";
        document.getElementById('previewBox').classList.add('hidden');
    }
</script>
