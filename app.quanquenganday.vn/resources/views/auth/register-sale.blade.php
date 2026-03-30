<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 p-4">
        <div class="w-full max-w-md bg-white rounded-2xl md:rounded-3xl shadow-xl p-8 border border-gray-100">
            <div class="text-center mb-8">
                <img src="{{ asset('logo.webp') }}" class="w-20 mx-auto mb-4">
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Đăng ký Sale</h2>
            <p class="text-gray-400 text-sm md:text-base">Tham gia hệ thống để bắt đầu kiếm tiền.</p>


            <form action="{{ route('register.sale.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Họ và tên" required
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-orange-500 transition">
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại" required
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none">
                <input type="password" name="password"  placeholder="Mật khẩu" required
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none">
                <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" required class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none">

                <div class="relative">
                    <input type="text" name="ref_code" value="{{ $ref }}" readonly
                        placeholder="Mã giới thiệu (bắt buộc)"
                        class="w-full px-5 py-4 bg-red-50 border border-red-100 rounded-2xl text-red-500 font-bold outline-none">
                    <span class="absolute right-5 top-4 text-red-500">*</span>
                </div>
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <div>
                    <button type="submit"
                    class="w-full bg-black text-white py-5 rounded-full font-bold text-lg hover:bg-gray-800 transition transform active:scale-95 shadow-lg mt-5">
                    Tạo tài khoản
                </button>
                </div>
            </form>

            <p class="mt-5 text-center text-gray-600">
                Nếu đã có tài khoản, vui lòng <a href="/login" class="text-red-500 font-bold">Đăng Nhập</a> tại đây
            </p>
        </div>
    </div>
</x-guest-layout>
