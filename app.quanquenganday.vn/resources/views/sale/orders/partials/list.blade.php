@foreach ($orders as $order)

    <div class="bg-gray-50 p-4 rounded-[2rem] mb-4 border border-gray-100">
        <div class="flex justify-between items-start mb-3 md:mb-4">
            <div>
                <h4 class="font-black text-gray-900">{{ $order->order_code }}</h4>
                <p class="text-[10px] text-gray-400 font-bold">{{ $order->created_at->format('d/m/Y') }}</p>
            </div>
            <span
                class="px-3 py-1 md:py-2 rounded-xl inline-flex items-center justify-center text-xs gap-1 font-bold ring-1 {{ $order->status == 'paid' ? 'bg-emerald-50 text-emerald-500 ring-green-500' : 'bg-yellow-50 text-orange-500 ring-orange-400' }}">
                {!! $order->status == 'paid' ? '<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M173.66,98.34a8,8,0,0,1,0,11.32l-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35A8,8,0,0,1,173.66,98.34ZM232,128A104,104,0,1,1,128,24,104.11,104.11,0,0,1,232,128Zm-16,0a88,88,0,1,0-88,88A88.1,88.1,0,0,0,216,128Z"></path></svg> Đã thanh toán' : '<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path></svg> Đang xử lý' !!}
            </span>
        </div>

        <div class="space-y-1 md:space-y-2 text-xs mb-4">
            @if (optional($order->shop)->name)
            <p class="text-gray-500 flex items-center gap-1 md:gap-3 capitalize"><svg class="w-4 h-4 md:w-5 md:h-5"
                    xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    viewBox="0 0 256 256">
                    <path
                        d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96h0v16a40,40,0,0,0,16,32v72a8,8,0,0,0,8,8H208a8,8,0,0,0,8-8V144a40,40,0,0,0,16-32V96ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-35.12,21.26,7.88,7.88,0,0,0-1.82-1.06A24,24,0,0,1,40,112v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm4.93-75.8a8.08,8.08,0,0,0-1.8,1.05A24,24,0,0,1,168,112v-8h48v8A24,24,0,0,1,204.93,132.2Z">
                    </path>
                </svg>
                {{ $order->shop->name ?? 'N/A' }}
            </p>
            @endif
            @if (optional($order->user)->name)
                <p class="text-gray-500 flex items-center gap-1 md:gap-3 capitalize"><svg class="w-4 h-4 md:w-5 md:h-5"
                        xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                        viewBox="0 0 256 256">
                        <path
                            d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z">
                        </path>
                    </svg>
                    {{ $order->user->name ?? '' }}
                </p>
            @endif
            <div class="flex justify-between">
                <span class="text-gray-500">Sản phẩm</span>
                <span class="text-gray-900">POS {{ $defaultPrice }}đ / {{ $order->cycle }} năm</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Giá trị đơn</span>
                <span class="font-black text-gray-900">{{ number_format($order->amount) }}đ</span>
            </div>
        </div>

        <button
            class="w-full md:w-64 bg-white py-3 rounded-2xl text-xs font-bold text-gray-700 border border-gray-100 shadow-sm flex items-center justify-center gap-1 md:gap-1 md:ml-auto">
            Xem chi tiết đơn <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"></path></svg>
        </button>
    </div>
@endforeach
