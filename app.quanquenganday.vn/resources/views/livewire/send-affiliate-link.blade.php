<div>
    <button wire:click="send" wire:loading.attr="disabled"
        class="flex w-full items-center justify-center gap-2 py-3 bg-black rounded-2xl text-sm font-bold text-white hover:bg-gray-800 transition">
        <svg wire:loading.remove class="w-4 h-4 rotate-45" fill="currentColor" viewBox="0 0 256 256">
            <path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.1,0L31.58,82.84a16,16,0,0,0-2.73,29.88l81,44.1,44.1,81a16,16,0,0,0,14.67,8.18,15.86,15.86,0,0,0,15.21-10.91L231.42,44.44A16,16,0,0,0,227.32,28.68Z"></path>
        </svg>
        
        <svg wire:loading class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>

        <span wire:loading.remove>Gửi ngay</span>
        <span wire:loading>Đang gửi...</span>
    </button>
</div>