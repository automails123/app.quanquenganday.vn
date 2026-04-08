<x-app-layout>
     <div class="md:py-12 container mx-auto max-md:mb-10 min-h-screen p-4">
        <div class="max-w-4xl mx-auto">
           
            <div class="flex items-center mb-4 md:mb-6">
                <a href="{{ route('admin.commissions.index') }}"
                    class="p-1 bg-white border rounded-full flex-shrink-0 flex items-center justify-center w-10 h-10 md:w-12 md:h-12 hover:opacity-75">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5 md:h-5 md:w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div class="ml-4">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Chi tiết tài chính User</h1>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-5 md:p-8 shadow-sm border border-gray-100 mb-8 relative overflow-hidden">               
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                    <div>
                        <p class="text-xs font-bold text-gray-400 tracking-widest mb-2">Thông tin cá nhân</p>
                        <h3 class="text-xl md:text-2xl font-black text-gray-800">{{ $user->name }}</h3>
                        <p class="text-gray-500 font-bold mt-2">Mã: {{ $user->affiliate_id }}</p>
                        <p class="text-gray-500 text-sm mt-2">SĐT: {{ $user->phone ?? 'N/A' }}</p>
                    </div>
                    <div class="md:text-right flex flex-col justify-end">
                        <p class="text-xs font-bold text-gray-400 tracking-widest mb-2">Số dư khả dụng</p>
                        <h3 class="text-3xl font-black text-blue-600">{{ number_format($user->balance) }}đ</h3>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div class="bg-green-50 border border-green-100 p-6 rounded-3xl">
                    <p class="text-green-600 text-xs font-bold mb-1">Hoa hồng tháng {{ now()->month }}</p>
                    <p class="text-2xl font-black text-green-700">{{ number_format($currentMonthCommission) }}đ</p>
                </div>
                <div class="bg-gray-50 border border-gray-100 p-6 rounded-3xl">
                    <p class="text-gray-500 text-xs font-bold mb-1">Tổng giao dịch</p>
                    <p class="text-2xl font-black text-gray-800">{{ $logs->total() }}</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-5 md:p-8 shadow-sm border border-gray-100">
                <h4 class="text-sm font-black text-gray-400 mb-6 tracking-widest">Lịch sử biến động chi tiết</h4>
                
                <div class="space-y-4">
                    @forelse($logs as $log)
                        <div class="flex items-center justify-between p-5 bg-[#fafbfc] rounded-3xl border border-gray-50">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center {{ $log->type == 'plus' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    @if($log->type == 'plus')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256"><path d="M205.66,117.66a8,8,0,0,1-11.32,0L136,59.31V216a8,8,0,0,1-16,0V59.31L61.66,117.66a8,8,0,0,1-11.32-11.32l72-72a8,8,0,0,1,11.32,0l72,72A8,8,0,0,1,205.66,117.66Z"></path></svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256"><path d="M205.66,149.66a8,8,0,0,1,0,11.32l-72,72a8,8,0,0,1-11.32,0l-72-72a8,8,0,0,1,11.32-11.32L120,208.69V40a8,8,0,0,1,16,0V208.69l58.34-59.03A8,8,0,0,1,205.66,149.66Z"></path></svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">{{ $log->description }}</p>
                                    <p class="text-xs text-gray-400">{{ $log->created_at->format('H:i - d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-black text-base {{ $log->type == 'plus' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $log->type == 'plus' ? '+' : '-' }}{{ number_format($log->amount) }}đ
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="py-10 text-center text-gray-400 italic text-sm">User này chưa có lịch sử giao dịch.</div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>