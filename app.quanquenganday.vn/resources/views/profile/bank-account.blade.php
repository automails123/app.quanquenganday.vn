<x-app-layout>
    <div class="md:py-12 container mx-auto md:min-h-[calc(100vh-65px)] flex items-center">
        <div
            class="bg-white overflow-hidden shadow-xl rounded-xl md:rounded-3xl px-4 py-6 md:p-6 w-full max-w-screen-md mx-auto h-full">

            <div class="flex items-center justify-between gap-1 mb-3 md:mb-6">
                <h2 class="font-bold text-gray-700 text-lg md:text-xl capitalize">Thông tin ngân hàng</h2>
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    viewBox="0 0 256 256">
                    <path
                        d="M24,104H48v64H32a8,8,0,0,0,0,16H224a8,8,0,0,0,0-16H208V104h24a8,8,0,0,0,4.19-14.81l-104-64a8,8,0,0,0-8.38,0l-104,64A8,8,0,0,0,24,104Zm40,0H96v64H64Zm80,0v64H112V104Zm48,64H160V104h32ZM128,41.39,203.74,88H52.26ZM248,208a8,8,0,0,1-8,8H16a8,8,0,0,1,0-16H240A8,8,0,0,1,248,208Z">
                    </path>
                </svg>
            </div>
            @if ($errors->any())
                <div class="mb-4"> {{-- Thay {{ $attributes }} bằng class CSS bình thường --}}
                    <div class="font-medium text-red-600">
                        {{ __('Rất tiếc! Đã có lỗi xảy ra.') }}
                    </div>

                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('bank.store') }}">
                @csrf             

                <div>
                    <x-label for="bank_name" value="{{ __('Tên ngân hàng') }}" />
                    <x-input id="bank_name" class="block mt-1 md:mt-2 md:py-3.5 w-full" type="text"
                        name="bank_name" value="{{ old('account_number', $bank->account_number ?? '') }}" required/>
                </div>
                <div class="mt-4">
                    <x-label for="account_number" value="{{ __('Số tài khoản') }}" />
                    <x-input id="account_number" class="block mt-1 md:mt-2 md:py-3.5 w-full" type="text" name="account_number" value="{{ old('branch', $bank->account_number ?? '') }}" 
                        required />
                </div>

                <div class="mt-4">
                    <x-label for="account_holder" value="{{ __('Chủ tài khoản') }}" />
                    <x-input id="account_holder" class="block mt-1 md:mt-2 md:py-3.5 w-full" type="text"
                        name="account_holder" value="{{ old('branch', $bank->account_holder ?? '') }}" required />
                </div>
                <div class="mt-4">
                    <x-label for="branch" value="{{ __('Chi nhánh') }}" />
                    <x-input id="branch" class="block mt-1 md:mt-2 md:py-3.5 w-full" type="text"
                        name="branch" value="{{ old('branch', $bank->branch ?? '') }}" />
                </div>
                

                <div class="flex items-center justify-center mt-4 md:mt-6">
                    <x-button class="w-full text-center justify-center gap-2 py-3 md:py-4 md:w-80 ">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H136v32a8,8,0,0,1-16,0V136H88a8,8,0,0,1,0-16h32V88a8,8,0,0,1,16,0v32h32A8,8,0,0,1,176,128Z"></path></svg>
                        {{ __('Thêm tài khoản bank') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
