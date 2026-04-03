@php

    use BaconQrCode\Renderer\Image\SvgImageBackEnd;
    use BaconQrCode\Renderer\ImageRenderer;
    use BaconQrCode\Renderer\RendererStyle\RendererStyle;
    use BaconQrCode\Writer;

    $affId = auth()->user()->affiliate_id ?? auth()->user()->id;
    $saleLink = route('register.sale', ['ref' => $affId]);
    $shopLink = route('register.shop', ['ref' => $affId]);

    // BƯỚC 2: TẠO HÀM RENDER QR NGAY TẠI ĐÂY
    $renderQr = function ($link) {
        $renderer = new ImageRenderer(new RendererStyle(250), new SvgImageBackEnd());
        $writer = new Writer($renderer);
        return $writer->writeString($link);
    };

    // BƯỚC 3: TẠO SẴN MÃ SVG ĐỂ TRUYỀN VÀO ALPINE
    $svgSale = $renderQr($saleLink);
    $svgShop = $renderQr($shopLink);
@endphp
<x-sale-layout>
    <x-slot name="header">
    </x-slot>

    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 p-5 md:p-8" x-data="{
        openQR: false,
        qrContent: '',
        {{-- Dùng chung 1 biến để chứa nội dung SVG --}}
        qrTitle: '',
        copyToClipboard(text, message) {
            if (!navigator.clipboard) {
                // Cách fallback nếu trình duyệt cũ không hỗ trợ navigator.clipboard
                let textArea = document.createElement('textarea');
                textArea.value = text;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                alert(message);
                return;
            }
            navigator.clipboard.writeText(text).then(() => {
                alert(message);
            });
        }
    }">
        <div
            class="w-full md:max-w-screen-md mx-auto bg-white rounded-2xl md:rounded-3xl shadow-xl md:p-8 border border-gray-100 space-y-6">
            <h2 class="text-xl font-bold text-gray-800 flex items-center justify-between">
                Công cụ lấy link mời
                <span class="text-xs font-normal text-gray-400">2 loại link</span>
            </h2>

            <div class="bg-gray-50 p-6 rounded-3xl border border-gray-100 space-y-4">
                <div>
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center border shadow-sm text-black">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                fill="currentColor" viewBox="0 0 256 256">
                                <path
                                    d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800">Link mời sale</h3>
                            <p class="text-xs text-gray-500 leading-relaxed">Dùng để tuyển sale/CTV mới vào hệ thống.
                            </p>
                        </div>
                    </div>
                    <div class="bg-white p-3 rounded-xl border break-all text-gray-600 text-sm font-semibold md:ms-16">
                        {{ $saleLink }}
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-2 md:gap-5 lg:gap-8">
                    <button @click="copyToClipboard('{{ $saleLink }}', 'Đã copy link mời Sale!')"
                        class="flex items-center justify-center gap-2 py-3 bg-gray-100 rounded-2xl text-sm font-bold text-gray-700 hover:bg-gray-200 transition">
                        <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="currentColor" viewBox="0 0 256 256">
                            <path
                                d="M216,32H88a8,8,0,0,0-8,8V80H40a8,8,0,0,0-8,8V216a8,8,0,0,0,8,8H168a8,8,0,0,0,8-8V176h40a8,8,0,0,0,8-8V40A8,8,0,0,0,216,32ZM160,208H48V96H160Zm48-48H176V88a8,8,0,0,0-8-8H96V48H208Z">
                            </path>
                        </svg>
                        Copy
                    </button>
                    <button @click="qrContent = `{{ $svgSale }}`; qrTitle = 'Mã QR mời Sale'; openQR = true;"
                        class="flex items-center justify-center gap-2 py-3 bg-gray-100 rounded-2xl text-sm font-bold text-gray-700 hover:bg-gray-200 transition">
                        <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="currentColor" viewBox="0 0 256 256">
                            <path
                                d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm0,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48ZM200,40H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-64,72V144a8,8,0,0,1,16,0v32a8,8,0,0,1-16,0Zm80-16a8,8,0,0,1-8,8H184v40a8,8,0,0,1-8,8H144a8,8,0,0,1,0-16h24V144a8,8,0,0,1,16,0v8h24A8,8,0,0,1,216,160Zm0,32v16a8,8,0,0,1-16,0V192a8,8,0,0,1,16,0Z">
                            </path>
                        </svg>
                        QR code
                    </button>
                    {{-- <button
                        class="flex items-center justify-center gap-2 py-3 bg-black rounded-2xl text-sm font-bold text-white hover:bg-gray-800 transition">
                        <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.49,29.8L102,154l41.3,84.87A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14,0-.07-40.06-82.3,48-48a8,8,0,0,0-11.31-11.31l-48,48L24.08,98.25l-.07,0,.14,0L216,40Z"></path></svg>
                        Gửi ngay
                    </button> --}}

                    {{-- @livewire('send-affiliate-link', ['link' => $saleLink, 'type' => 'Sale']) --}}
                    <livewire:send-affiliate-link :link="$saleLink" :type="'Sale'" :wire:key="'send-link-sale'" />
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-3xl border border-gray-100 space-y-4">
                <div>
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center border shadow-sm text-gray-600">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                fill="currentColor" viewBox="0 0 256 256">
                                <path
                                    d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96h0v16a40,40,0,0,0,16,32v72a8,8,0,0,0,8,8H208a8,8,0,0,0,8-8V144a40,40,0,0,0,16-32V96ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-35.12,21.26,7.88,7.88,0,0,0-1.82-1.06A24,24,0,0,1,40,112v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm4.93-75.8a8.08,8.08,0,0,0-1.8,1.05A24,24,0,0,1,168,112v-8h48v8A24,24,0,0,1,204.93,132.2Z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800">Link mời quán</h3>
                            <p class="text-xs text-gray-500 leading-relaxed">Dùng để chủ quán đăng ký vào đúng tài khoản
                                sale của bạn.</p>
                        </div>
                    </div>

                    <div class="bg-white p-3 rounded-xl border break-all text-gray-600 text-sm font-semibold md:ms-16">
                        {{ $shopLink }}
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2 md:gap-5 lg:gap-8">
                    <button @click="copyToClipboard('{{ $shopLink }}', 'Đã copy link mời Quán!')"
                        class="flex items-center justify-center gap-2 py-3 bg-gray-100 rounded-2xl text-sm font-bold text-gray-700 hover:bg-gray-200 transition">
                        <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="currentColor" viewBox="0 0 256 256">
                            <path
                                d="M216,32H88a8,8,0,0,0-8,8V80H40a8,8,0,0,0-8,8V216a8,8,0,0,0,8,8H168a8,8,0,0,0,8-8V176h40a8,8,0,0,0,8-8V40A8,8,0,0,0,216,32ZM160,208H48V96H160Zm48-48H176V88a8,8,0,0,0-8-8H96V48H208Z">
                            </path>
                        </svg>
                        Copy
                    </button>
                    <button @click="qrContent = `{{ $svgShop }}`; qrTitle = 'Mã QR mời Quán'; openQR = true;"
                        class="flex items-center justify-center gap-2 py-3 bg-gray-100 rounded-2xl text-sm font-bold text-gray-700 hover:bg-gray-200 transition">
                        <svg class="w-4 h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="currentColor" viewBox="0 0 256 256">
                            <path
                                d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm0,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48ZM200,40H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-64,72V144a8,8,0,0,1,16,0v32a8,8,0,0,1-16,0Zm80-16a8,8,0,0,1-8,8H184v40a8,8,0,0,1-8,8H144a8,8,0,0,1,0-16h24V144a8,8,0,0,1,16,0v8h24A8,8,0,0,1,216,160Zm0,32v16a8,8,0,0,1-16,0V192a8,8,0,0,1,16,0Z">
                            </path>
                        </svg>
                        QR code
                    </button>

                    <livewire:send-affiliate-link :link="$shopLink" :type="'Quán'" :wire:key="'btn-shop'" />
                </div>
            </div>

            <div x-show="openQR" x-cloak
                class="fixed inset-0 z-[99] flex items-center justify-center bg-black/60 backdrop-blur-sm">
                <div @click.away="openQR = false"
                    class="bg-white p-8 rounded-[2rem] max-w-sm w-full text-center shadow-2xl">
                    <h3 class="font-bold text-xl mb-4" x-text="qrTitle"></h3>

                    <div class="bg-gray-50 p-4 rounded-2xl border mb-4 flex justify-center items-center"
                        x-html="qrContent">
                    </div>                    
                    <button @click="openQR = false" class="w-full py-4 bg-black text-white rounded-2xl font-bold">
                        Đóng lại
                    </button>
                </div>
            </div>

        </div>
    </div>

</x-sale-layout>
