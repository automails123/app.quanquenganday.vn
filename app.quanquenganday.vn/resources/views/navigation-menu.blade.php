<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 max-md:fixed max-md:bottom-0 w-full">
    <!-- Primary Navigation Menu -->
    <div class="container mx-auto">
        <div class="flex justify-between items-center h-16 max-md:px-0.5 max-md:shadow-xl">
            <!-- Navigation Links -->
            <x-nav-link class="gap-1 md:gap-2 max-md:flex-col max-md:items-center max-md:flex-1 max-md:text-xs"
                href="{{ auth()->user()->role === 'sale' ? route('sale.dashboard') : route('dashboard') }}" :active="request()->routeIs('sale.dashboard') || request()->routeIs('dashboard')">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentcolor"
                    viewBox="0 0 256 256">
                    <path
                        d="M240,208H224V136l2.34,2.34A8,8,0,0,0,237.66,127L139.31,28.68a16,16,0,0,0-22.62,0L18.34,127a8,8,0,0,0,11.32,11.31L32,136v72H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM48,120l80-80,80,80v88H160V152a8,8,0,0,0-8-8H104a8,8,0,0,0-8,8v56H48Zm96,88H112V160h32Z">
                    </path>
                </svg> {{ __('Home') }}
            </x-nav-link>
            <div class="relative max-md:flex-1">
                <x-dropdown align="right" width="100">
                    <x-slot name="trigger">
                        <span
                            class="inline-flex items-center gap-1 md:gap-1 cursor-pointer text-gray-500 max-md:flex-col max-md:items-center max-md:text-xs">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                fill="currentColor" viewBox="0 0 256 256">
                                <path
                                    d="M221.8,175.94C216.25,166.38,208,139.33,208,104a80,80,0,1,0-160,0c0,35.34-8.26,62.38-13.81,71.94A16,16,0,0,0,48,200H88.81a40,40,0,0,0,78.38,0H208a16,16,0,0,0,13.8-24.06ZM128,216a24,24,0,0,1-22.62-16h45.24A24,24,0,0,1,128,216ZM48,184c7.7-13.24,16-43.92,16-80a64,64,0,1,1,128,0c0,36.05,8.28,66.73,16,80Z">
                                </path>
                            </svg>
                            Thông báo
                        </span>
                    </x-slot>

                    <x-slot name="content">
                        <div class=" max-w-sm px-4 py-2 md:py-4 w-full">
                            <div class="flex items-center justify-between gap-2 md:gap-4">
                                <div class="inline-flex items-center gap-2">
                                    <span
                                        class="flex-shrink-0 rounded-full border bg-white text-black w-8 h-8 inline-flex items-center justify-center">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="32"
                                            height="32" fill="currentColor" viewBox="0 0 256 256">
                                            <path
                                                d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z">
                                            </path>
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="font-bold">Thông báo</p>
                                        <p class="text-gray-500 text-sm">Quán & sale từ link của bạn</p>
                                    </div>
                                </div>
                                <span
                                    class="w-8 h-8 bg-black rounded-xl text-white flex items-center justify-center flex-shrink-0">
                                    <span class="relative">
                                        <i
                                            class="rounded-full w-2 h-2 bg-red-500 block absolute -top-0.5 -right-0.5"></i>
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="32"
                                            height="32" fill="currentColor" viewBox="0 0 256 256">
                                            <path
                                                d="M221.8,175.94C216.25,166.38,208,139.33,208,104a80,80,0,1,0-160,0c0,35.34-8.26,62.38-13.81,71.94A16,16,0,0,0,48,200H88.81a40,40,0,0,0,78.38,0H208a16,16,0,0,0,13.8-24.06ZM128,216a24,24,0,0,1-22.62-16h45.24A24,24,0,0,1,128,216ZM48,184c7.7-13.24,16-43.92,16-80a64,64,0,1,1,128,0c0,36.05,8.28,66.73,16,80Z">
                                            </path>
                                        </svg>
                                    </span>
                                </span>
                            </div>
                            <div class="pb-2 pt-3 md:pt-4 flex flex-col gap-4">
                                <div class="rounded-2xl bg-black p-3 flex">
                                    <div class="flex gap-1 md:gap-2">
                                        <span
                                            class="bg-blue-100 rounded-2xl w-9 h-9 flex items-center justify-center text-blue-500 flex-shrink-0">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="32"
                                                height="32" fill="currentColor" viewBox="0 0 256 256">
                                                <path
                                                    d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96h0v16a40,40,0,0,0,16,32v72a8,8,0,0,0,8,8H208a8,8,0,0,0,8-8V144a40,40,0,0,0,16-32V96ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-35.12,21.26,7.88,7.88,0,0,0-1.82-1.06A24,24,0,0,1,40,112v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm4.93-75.8a8.08,8.08,0,0,0-1.8,1.05A24,24,0,0,1,168,112v-8h48v8A24,24,0,0,1,204.93,132.2Z">
                                                </path>
                                            </svg>
                                        </span>
                                        <div class="text-white">
                                            <p class="font-bold">Có quán mới đăng ký</p>
                                            <p class="text-xs text-gray-300">Cafe mộc đăng ký từ link của bạn
                                            </p>
                                            <p class="text-xs text-gray-300 mt-0.5">Hôm nay, 08:40</p>
                                        </div>
                                    </div>
                                    <i class="rounded-full w-2 h-2 bg-red-500 block mt-1 flex-shrink-0"></i>
                                </div>
                                <!--Sale-->
                                <div class="rounded-2xl bg-black p-3 flex">
                                    <div class="flex gap-1 md:gap-2">
                                        <span
                                            class="bg-green-100 rounded-2xl w-9 h-9 flex items-center justify-center text-green-500 flex-shrink-0">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="32"
                                                height="32" fill="currentColor" viewBox="0 0 256 256">
                                                <path
                                                    d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96h0v16a40,40,0,0,0,16,32v72a8,8,0,0,0,8,8H208a8,8,0,0,0,8-8V144a40,40,0,0,0,16-32V96ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-35.12,21.26,7.88,7.88,0,0,0-1.82-1.06A24,24,0,0,1,40,112v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm4.93-75.8a8.08,8.08,0,0,0-1.8,1.05A24,24,0,0,1,168,112v-8h48v8A24,24,0,0,1,204.93,132.2Z">
                                                </path>
                                            </svg>
                                        </span>
                                        <div class="text-white">
                                            <p class="font-bold">Có sale mới</p>
                                            <p class="text-xs text-gray-300">Trần văn B đăng ký từ link của bạn
                                            </p>
                                            <p class="text-xs text-gray-300 mt-0.5">Hôm nay, 08:40</p>
                                        </div>
                                    </div>
                                    <i class="rounded-full w-2 h-2 bg-red-500 block mt-1 flex-shrink-0"></i>
                                </div>
                                <!--admin-->
                                <div class="rounded-2xl bg-slate-100 p-3 flex">
                                    <div class="flex gap-1 md:gap-2">
                                        <span
                                            class="bg-green-100 rounded-2xl w-9 h-9 flex items-center justify-center text-green-500 flex-shrink-0">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="32"
                                                height="32" fill="currentColor" viewBox="0 0 256 256">
                                                <path
                                                    d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96h0v16a40,40,0,0,0,16,32v72a8,8,0,0,0,8,8H208a8,8,0,0,0,8-8V144a40,40,0,0,0,16-32V96ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-35.12,21.26,7.88,7.88,0,0,0-1.82-1.06A24,24,0,0,1,40,112v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm4.93-75.8a8.08,8.08,0,0,0-1.8,1.05A24,24,0,0,1,168,112v-8h48v8A24,24,0,0,1,204.93,132.2Z">
                                                </path>
                                            </svg>
                                        </span>
                                        <div class="text-black">
                                            <p class="font-bold">Thông báo Admin</p>
                                            <p class="text-xs text-gray-500">Nhắc nhở bổ sung quán
                                            </p>
                                            <p class="text-xs text-gray-500 mt-0.5">Hôm nay, 08:40</p>
                                        </div>
                                    </div>
                                    <i class="rounded-full w-2 h-2 bg-red-500 block mt-1 flex-shrink-0"></i>
                                </div>
                            </div>

                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
            <x-nav-link title="Tạo đơn hàng"
                class="gap-1 md:gap-1 max-md:flex-col max-md:items-center max-md:flex-1 max-md:text-xs relative max-md:h-full"
                href="{{ route('sale.orders.create') }}">
                <span
                    class="bg-black text-white rounded-full min-w-14 min-h-14 md:min-w-12 md:min-h-12 flex items-center justify-center shadow-lg max-md:absolute max-md:-top-2">
                    <svg class="w-8 h-8 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                        fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H136v32a8,8,0,0,1-16,0V136H88a8,8,0,0,1,0-16h32V88a8,8,0,0,1,16,0v32h32A8,8,0,0,1,176,128Z">
                        </path>
                    </svg>
                </span>
            </x-nav-link>


            <x-nav-link class="gap-1 md:gap-1 max-md:flex-col max-md:items-center max-md:flex-1 max-md:text-xs"
                href="{{ route('sale.orders.index') }}">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                    fill="currentcolor" viewBox="0 0 256 256">
                    <path
                        d="M152,120H136V56h8a32,32,0,0,1,32,32,8,8,0,0,0,16,0,48.05,48.05,0,0,0-48-48h-8V24a8,8,0,0,0-16,0V40h-8a48,48,0,0,0,0,96h8v64H104a32,32,0,0,1-32-32,8,8,0,0,0-16,0,48.05,48.05,0,0,0,48,48h16v16a8,8,0,0,0,16,0V216h16a48,48,0,0,0,0-96Zm-40,0a32,32,0,0,1,0-64h8v64Zm40,80H136V136h16a32,32,0,0,1,0,64Z">
                    </path>
                </svg>
                {{ __('Đơn hàng') }}
            </x-nav-link>

            <!-- Teams Dropdown -->
            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="relative">
                    <x-dropdown align="right" width="60">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center gap-1 md:gap-1 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ Auth::user()->currentTeam->name }}

                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-60">
                                <!-- Team Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                    {{ __('Team Settings') }}
                                </x-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-dropdown-link href="{{ route('teams.create') }}">
                                        {{ __('Create New Team') }}
                                    </x-dropdown-link>
                                @endcan

                                <!-- Team Switcher -->
                                @if (Auth::user()->allTeams()->count() > 1)
                                    <div class="border-t border-gray-200"></div>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-switchable-team :team="$team" />
                                    @endforeach
                                @endif
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endif

            <!-- Settings Dropdown -->
            <div class="relative max-md:flex-1">
                <x-dropdown align="right" width="100">
                    <x-slot name="trigger">
                        {{-- @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition max-md:w-full">
                                <img class="size-8 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else --}}
                        <button type="button"
                            class="max-md:w-full inline-flex max-md:flex-col max-md:items-center gap-1 md:gap-1 border-transparent max-md:text-xs text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                fill="currentColor" viewBox="0 0 256 256">
                                <path
                                    d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z">
                                </path>
                            </svg>
                            {{ __('Cá nhân') }}

                        </button>
                        {{-- @endif --}}
                    </x-slot>

                    <x-slot name="content">
                        <div class="">
                            <div class="bg-white px-4 pb-4 pt-3 md:px-5 md:pb-5 md:pt-4 shadow-xl mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="relative">                                        
                                        @if (auth()->user()->profile_photo_path)
                                            <div
                                                class="w-20 h-20 bg-gray-100 rounded-3xl overflow-hidden shadow-sm border border-gray-100">
                                                <img src="{{ auth()->user()->profile_photo_url }}"
                                                    alt="{{ auth()->user()->name }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            {{-- Nếu không có ảnh, hiện chữ cái đầu tiên như cũ --}}
                                            <div
                                                class="w-20 h-20 bg-black rounded-3xl flex items-center justify-center text-white text-3xl font-bold">
                                                {{ substr(auth()->user()->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <button
                                            class="absolute -bottom-1 -right-1 bg-white p-1.5 rounded-full shadow-md border border-gray-100">
                                            <svg class="h-4 w-4 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                                                width="32" height="32" fill="currentColor"
                                                viewBox="0 0 256 256">
                                                <path
                                                    d="M208,56H180.28L166.65,35.56A8,8,0,0,0,160,32H96a8,8,0,0,0-6.65,3.56L75.71,56H48A24,24,0,0,0,24,80V192a24,24,0,0,0,24,24H208a24,24,0,0,0,24-24V80A24,24,0,0,0,208,56Zm8,136a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V80a8,8,0,0,1,8-8H80a8,8,0,0,0,6.66-3.56L100.28,48h55.43l13.63,20.44A8,8,0,0,0,176,72h32a8,8,0,0,1,8,8ZM128,88a44,44,0,1,0,44,44A44.05,44.05,0,0,0,128,88Zm0,72a28,28,0,1,1,28-28A28,28,0,0,1,128,160Z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-bold text-gray-900 capitalize">
                                            {{ auth()->user()->name }}</h2>
                                        <div class="flex items-center gap-2 mt-2">
                                            <span
                                                class="text-xs text-gray-500 uppercase">{{ auth()->user()->affiliate_id }}</span>
                                            @php
                                                $user = auth()->user();
                                            @endphp
                                            @if ($user->is_area_manager && $user->area)
                                                <span
                                                    class="text-xs text-red-500 capitalize">{{ $user->area->name }}</span>
                                            @endif
                                        </div>
                                        <p class="mt-2">
                                            @if (auth()->user()->email_verified_at)
                                                <span
                                                    class="bg-emerald-50 text-emerald-500 text-xs px-2 py-1 md:px-3 rounded-2xl font-bold inline-flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Đã xác minh
                                                </span>
                                            @else
                                                <span
                                                    class="bg-gray-100 text-gray-500 text-xs px-2 py-1 md:px-3 rounded-2xl font-bold inline-flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                    </svg>
                                                    Chưa xác minh
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="px-6 pb-4 space-y-4 overflow-y-auto max-h-screen">
                                <h3 class="text-lg font-black text-gray-900 mb-2">Cài đặt cá nhân</h3>

                                <div class="bg-white space-y-4 ">
                                    <a href="{{ route('profile.show') }}"
                                        class="flex items-center justify-between p-3 md:p-4 bg-gray-100 hover:bg-gray-200 transition-colors border-b border-gray-50 rounded-2xl">
                                        <div class="flex items-center gap-2 md:gap-4">
                                            <div
                                                class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center text-black border">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <span class="font-bold text-gray-700 text-sm md:text-base">Thông tin cá
                                                nhân</span>
                                        </div>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('verify.index') }}"
                                        class="flex items-center justify-between p-3 md:p-4 bg-gray-100 hover:bg-gray-200 transition-colors border-b border-gray-50 rounded-2xl">
                                        <div class="flex items-center gap-2 md:gap-4">
                                            <div
                                                class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center text-black border">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                </svg>
                                            </div>
                                            <span class="font-bold text-gray-700 text-sm md:text-base">Xác minh tài
                                                khoản</span>
                                        </div>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('bank.index') }}"
                                        class="flex items-center justify-between p-3 md:p-4 bg-gray-100 hover:bg-gray-200 transition-colors border-b border-gray-50 rounded-2xl">
                                        <div class="flex items-center gap-2 md:gap-4">
                                            <div
                                                class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center text-black border">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                                </svg>
                                            </div>
                                            <span class="font-bold text-gray-700 text-sm md:text-base">Tài khoản ngân
                                                hàng</span>
                                        </div>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('password.change') }}"
                                        class="flex items-center justify-between p-3 md:p-4 bg-gray-100 hover:bg-gray-200 transition-colors border-b border-gray-50 rounded-2xl">
                                        <div class="flex items-center gap-2 md:gap-4">
                                            <div
                                                class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center text-black border">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                                </svg>
                                            </div>
                                            <span class="font-bold text-gray-700 text-sm md:text-base">Đổi mật
                                                khẩu</span>
                                        </div>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('tools.index') }}"
                                        class="flex items-center justify-between p-3 md:p-4 bg-gray-100 hover:bg-gray-200 transition-colors border-b border-gray-50 rounded-2xl">
                                        <div class="flex items-center gap-2 md:gap-4">
                                            <div
                                                class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center text-black border">
                                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                    width="32" height="32" fill="currentColor"
                                                    viewBox="0 0 256 256">
                                                    <path
                                                        d="M165.66,90.34a8,8,0,0,1,0,11.32l-64,64a8,8,0,0,1-11.32-11.32l64-64A8,8,0,0,1,165.66,90.34ZM215.6,40.4a56,56,0,0,0-79.2,0L106.34,70.45a8,8,0,0,0,11.32,11.32l30.06-30a40,40,0,0,1,56.57,56.56l-30.07,30.06a8,8,0,0,0,11.31,11.32L215.6,119.6a56,56,0,0,0,0-79.2ZM138.34,174.22l-30.06,30.06a40,40,0,1,1-56.56-56.57l30.05-30.05a8,8,0,0,0-11.32-11.32L40.4,136.4a56,56,0,0,0,79.2,79.2l30.06-30.07a8,8,0,0,0-11.32-11.31Z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <span class="font-bold text-gray-700 text-sm md:text-base">Công cụ</span>
                                        </div>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                    <a href="https://www.youtube.com/shorts/FBHUuvXpJDM"
                                        class="flex items-center justify-between p-3 md:p-4 bg-gray-100 hover:bg-gray-200 transition-colors border-b border-gray-50 rounded-2xl">
                                        <div class="flex items-center gap-2 md:gap-4">
                                            <div
                                                class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center text-black border">
                                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                    width="32" height="32" fill="currentColor"
                                                    viewBox="0 0 256 256">
                                                    <path
                                                        d="M176,232a8,8,0,0,1-8,8H88a8,8,0,0,1,0-16h80A8,8,0,0,1,176,232Zm40-128a87.55,87.55,0,0,1-33.64,69.21A16.24,16.24,0,0,0,176,186v6a16,16,0,0,1-16,16H96a16,16,0,0,1-16-16v-6a16,16,0,0,0-6.23-12.66A87.59,87.59,0,0,1,40,104.5C39.74,56.83,78.26,17.15,125.88,16A88,88,0,0,1,216,104Zm-16,0a72,72,0,0,0-73.74-72c-39,.92-70.47,33.39-70.26,72.39a71.64,71.64,0,0,0,27.64,56.3h0A32,32,0,0,1,96,186v6h24V147.31L90.34,117.66a8,8,0,0,1,11.32-11.32L128,132.69l26.34-26.35a8,8,0,0,1,11.32,11.32L136,147.31V192h24v-6a32.12,32.12,0,0,1,12.47-25.35A71.65,71.65,0,0,0,200,104Z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <span class="font-bold text-gray-700 text-sm md:text-base">Hướng dẫn</span>
                                        </div>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <x-dropdown-link href="{{ route('logout') }}"
                                            @click.prevent="$root.submit();" class="!p-0 !hover:bg-none">
                                            <div
                                                class="flex items-center justify-between p-3 md:p-4 bg-red-100 hover:bg-red-200 transition-colors border-b border-gray-50 rounded-2xl text-red-500">
                                                <div class="flex items-center gap-2 md:gap-4">
                                                    <div
                                                        class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center text-red-500 border">
                                                        <svg class="w-6 h-6 fill-red-500"
                                                            xmlns="http://www.w3.org/2000/svg" width="32"
                                                            height="32" fill="currentColor" viewBox="0 0 256 256">
                                                            <path
                                                                d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L204.69,120H112a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,229.66,122.34Z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <span
                                                        class="font-bold text-red-500 text-sm md:text-base">{{ __('Đăng xuất') }}</span>
                                                </div>
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path d="M9 5l7 7-7 7" />
                                                </svg>

                                            </div>
                                        </x-dropdown-link>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
            <!-- Hamburger -->
            {{-- <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div> --}}
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
