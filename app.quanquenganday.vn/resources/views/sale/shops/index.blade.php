<x-sale-layout>
    <div class="md:py-12 container mx-auto md:min-h-[calc(100vh-65px)] flex items-center">
        <div
            class="bg-white overflow-hidden md:shadow-xl md:rounded-3xl px-4 py-6 md:p-6 w-full max-w-screen-md mx-auto h-full">
            <a href="{{ route('sale.dashboard') }}" class="inline-flex items-center gap-2 text-gray-500 mb-4 md:mb-6">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" stroke-width="2.5" />
                </svg>
                <span class="text-sm md:text-base">Quay lại</span>
            </a>
            <div class="flex max-md:flex-col md:items-center justify-between md:gap-1 mb-3 md:mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Danh sách quán đã mời</h2>
                    <p class="text-sm text-gray-500">Click vào các quán để xem chi tiết</p>
                </div>
                <span class="text-2xl font-black ">{{ $totalCount }} quán</span>
            </div>

            <div class="space-y-4 max-md:mb-16">
                @forelse($shops as $shop)
                    <a href="{{ route('sale.shops.show', $shop->id) }}"
                        class="bg-white px-5 py-4 rounded-2xl md:rounded-3xl flex items-center justify-between shadow-sm border border-gray-100 no-underline hover:bg-gray-200">
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-800 text-base md:text-lg leading-tight">{{ $shop->name }}</span>
                            <span
                                class="text-xs text-gray-400 mt-1 uppercase tracking-wider">{{ $shop->created_at->format('d/m/Y') }}</span>
                        </div>

                        <div class="text-right">
                            {{-- Hiển thị status_text và status_color từ Model Shop --}}
                            <span class="text-xs md:text-sm {{ $shop->status_color }}">
                                {{ $shop->status_text }}
                            </span>
                        </div>
                    </a>
                    
                @empty
                    <div class="text-center py-10">
                        <p class="text-gray-500 italic font-bold">Bạn chưa mời quán nào thành công.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-sale-layout>
