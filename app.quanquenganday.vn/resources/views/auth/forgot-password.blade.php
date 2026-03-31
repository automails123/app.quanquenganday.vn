<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <div class="flex items-center gap-3 mb-3 md:mb-3 py-2">
            <span class="bg-gray-900 flex-shrink-0 w-12 h-12 inline-flex items-center justify-center text-white rounded-xl">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M224,48H32a8,8,0,0,0-8,8V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A8,8,0,0,0,224,48Zm-96,85.15L52.57,64H203.43ZM98.71,128,40,181.81V74.19Zm11.84,10.85,12,11.05a8,8,0,0,0,10.82,0l12-11.05,58,53.15H52.57ZM157.29,128,216,74.18V181.82Z"></path></svg>
            </span>
            <h1 class="text-2xl font-bold text-gray-800">Lấy lại mật khẩu</h1>
        </div>
        <div class="mb-4 text-sm text-gray-500">
            {{ __('Nhập email đã đăng ký. Hệ thống sẽ gửi mã OTP về email để bạn xác thực và đặt lại mật khẩu mới.') }}
        </div>

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email đăng ký') }}" />
                <x-input id="email" class="block mt-1 w-full md:rounded-2xl placeholder:text-sm placeholder:text-gray-400" type="email" placeholder="Nhập email của bạn" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4 md:mt-6 text-center">
                <x-button class="w-4/5 sm:w-60 mx-auto justify-center py-3 sm:py-4 md:rounded-2xl">
                    {{ __('Gửi mã OTP về mail') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
