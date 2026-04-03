<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Thông tin cá nhân') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Cập nhật thông tin hồ sơ của bạn.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->


        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Họ và tên') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required
                autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Phone -->

        <div class="col-span-6 sm:col-span-4">
            <x-label for="phone" value="{{ __('Số điện thoại') }}" />
            <x-input id="phone" type="text"
                class="mt-1 block w-full {{ $errors->has('phone') ? 'border-red-500' : '' }}" wire:model="state.phone"
                placeholder="Ví dụ: 0901234567" />

            <x-input-error for="phone" class="mt-2" />
        </div>
        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required
                autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                    !$this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        @if (auth()->user()->role === 'sale')
            <div class="col-span-6 sm:col-span-4">
                <x-label for="tax_code" value="{{ __('Mã số thuế cá nhân') }}" />
                <x-input id="tax_code" type="text" class="mt-1 block w-full uppercase" wire:model="state.tax_code"
                    placeholder="Nhập mã số thuế..." />
                <x-input-error for="tax_code" class="mt-2" />
            </div>
        @endif
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <x-label for="photo" value="{{ __('Hình ảnh cá nhân') }}" />
                <div class="flex flex-wrap">
                    <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                        x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />


                    <div class="flex gap-2 md:gap-3 items-center">
                        <!-- Current Profile Photo -->
                        <div class="mt-2 border rounded-3xl overflow-hidden" x-show="! photoPreview">
                            <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                                class=" size-20 object-cover">
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <span class="block rounded-3xl size-20 bg-cover bg-no-repeat bg-center border"
                                x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>
                        <div>
                            <x-secondary-button class="mt-2 me-2 border border-gray-100 rounded-3xl inline-flex items-center gap-2" type="button"
                                x-on:click.prevent="$refs.photo.click()">
                               <svg class="h-4 w-4 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                                                width="32" height="32" fill="currentColor"
                                                viewBox="0 0 256 256">
                                                <path
                                                    d="M208,56H180.28L166.65,35.56A8,8,0,0,0,160,32H96a8,8,0,0,0-6.65,3.56L75.71,56H48A24,24,0,0,0,24,80V192a24,24,0,0,0,24,24H208a24,24,0,0,0,24-24V80A24,24,0,0,0,208,56Zm8,136a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V80a8,8,0,0,1,8-8H80a8,8,0,0,0,6.66-3.56L100.28,48h55.43l13.63,20.44A8,8,0,0,0,176,72h32a8,8,0,0,1,8,8ZM128,88a44,44,0,1,0,44,44A44.05,44.05,0,0,0,128,88Zm0,72a28,28,0,1,1,28-28A28,28,0,0,1,128,160Z">
                                                </path>
                                            </svg> {{ __('Chọn ảnh mới') }}
                            </x-secondary-button>
                        </div>
                    </div>
                </div>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Xoá ảnh') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Đã lưu.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Lưu tài khoản') }}
        </x-button>
    </x-slot>
</x-form-section>
