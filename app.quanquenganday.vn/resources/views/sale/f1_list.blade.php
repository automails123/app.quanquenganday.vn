<x-sale-layout>
    <div class="md:py-12 container mx-auto max-md:mb-10 min-h-screen">
        <div class="bg-white overflow-hidden shadow-xl round-2xl md:rounded-2xl p-4 md:p-5 lg:p-7">
            <div class="flex items-center mb-4 md:mb-6 w-full">
                <a href="javascript:history.back()"
                    class="p-1 bg-gray-100 border rounded-full flex-shrink-0 flex items-center justify-center w-10 h-10 md:w-12 md:h-12 hover:opacity-75">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5 md:h-5 md:w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div class="ml-4">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Sale đã mời</h1>
                </div>
                <div class="flex items-baseline gap-2 mt-2 ml-auto">
                    <span class="text-3xl font-black">{{ $f1Sales->count() }}</span>
                    <span class="text-lg font-bold text-gray-500">sale</span>
                </div>
            </div>



            <div class="space-y-3">
                @forelse($f1Sales as $f1)
                    <a href="{{ route('sale.f1.detail', $f1->id) }}"
                        class="flex justify-between items-center p-5 bg-gray-50 rounded-3xl border border-gray-100 hover:bg-gray-100 transition-all">

                        <div class="flex flex-col">
                            <span class="font-bold text-gray-800 text-base capitalize md:text-lg">{{ $f1->name }}</span>
                            <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">
                                ID: {{ $f1->affiliate_id }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            {{-- Dùng accessor status_label và status_class Duyqt đã viết trong Model --}}
                            <span class="{{ $f1->status_class }} text-xs font-bold">
                                {{ $f1->status_label }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-20">
                        <p class="text-gray-400">Duyqt chưa mời sale nào. Hãy chia sẻ link nhé!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-sale-layout>
