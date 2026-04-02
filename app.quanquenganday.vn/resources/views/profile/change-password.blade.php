<x-app-layout>

    <div class="md:py-12 container mx-auto min-h-screen">
        <div class="bg-white overflow-hidden shadow-xl rounded-xl md:rounded-3xl p-4 md:p-6 max-w-screen-md mx-auto min-h-screen">
            
            <div class="flex items-center justify-between gap-1 mb-3 md:mb-6">
                <h2 class="font-bold text-gray-700 text-lg md:text-xl capitalize">Đổi mật khẩu</h2>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
            <x-validation-errors class="mb-4" />
            <form method="POST" action="{{ route('user.password.update') }}">
                @csrf
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <div>
                    <x-label for="current_password" value="{{ __('Mật khẩu hiện tại') }}" />
                    <x-input id="current_password" class="block mt-1 md:mt-2 md:py-3.5 w-full" type="password" name="current_password" required
                        autocomplete="new-password" />
                </div>
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Mật khẩu') }}" />
                    <x-input id="password" class="block mt-1 md:mt-2 md:py-3.5 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Xác nhận mật khẩu') }}" />
                    <x-input id="password_confirmation" class="block mt-1 md:mt-2 md:py-3.5 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-center mt-4 md:mt-6">
                    <x-button class="w-full text-center justify-center gap-2 py-3 md:py-4 md:w-80 ">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M208,80H176V56a48,48,0,0,0-96,0V80H48A16,16,0,0,0,32,96V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V96A16,16,0,0,0,208,80ZM96,56a32,32,0,0,1,64,0V80H96ZM208,208H48V96H208V208Zm-68-56a12,12,0,1,1-12-12A12,12,0,0,1,140,152Z"></path></svg>
                        {{ __('Cập nhật mật khẩu') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
