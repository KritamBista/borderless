<div class="space-y-6">

    <div>
        <h1 class="text-2xl font-extrabold text-white">My Profile</h1>
        <p class="text-sm text-gray-400">Manage your profile and security settings.</p>
    </div>

    @if(session('success'))
        <div class="glass rounded-2xl p-4 text-sm text-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Profile Card --}}
    <div class="glass rounded-3xl p-6 space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-white">Profile Details</h2>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <div class="text-xs text-gray-400">Name</div>
                <div class="mt-1 text-white font-semibold">{{ $name }}</div>
            </div>

            <div>
                <div class="text-xs text-gray-400">Email</div>
                <div class="mt-1 text-white font-semibold">{{ $email }}</div>
            </div>

            <div class="sm:col-span-2">
                <div class="text-xs text-gray-400">Phone</div>

                @if($phone)
                    <div class="mt-1 text-white font-semibold">{{ $phone }}</div>
                @else
                    <div class="mt-2 flex flex-col sm:flex-row gap-3">
                        <input wire:model="new_phone"
                               class="flex-1 bg-transparent border border-white/10 rounded-2xl px-4 py-3 text-white outline-none"
                               placeholder="Enter phone number">
                        <button wire:click="savePhoneIfEmpty"
                                wire:loading.attr="disabled"
                                wire:target="savePhoneIfEmpty"
                                class="btn-gold px-5 py-3 rounded-2xl disabled:opacity-60 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="savePhoneIfEmpty">Save Phone</span>
                            <span wire:loading wire:target="savePhoneIfEmpty">Saving...</span>
                        </button>
                    </div>
                    @error('new_phone') <div class="text-red-400 text-xs mt-2">{{ $message }}</div> @enderror
                @endif
            </div>
        </div>
    </div>

    {{-- Change Password (OTP) --}}
    <div class="glass rounded-3xl p-6 space-y-4">
        <h2 class="font-extrabold text-white">Change Password</h2>
        <p class="text-sm text-gray-400">
            We will send an OTP to your email for verification.
        </p>

        @if($step === 1)
            <button wire:click="sendChangePasswordOtp"
                    wire:loading.attr="disabled"
                    wire:target="sendChangePasswordOtp"
                    class="btn-gold w-full sm:w-auto px-6 py-3 rounded-2xl disabled:opacity-60 disabled:cursor-not-allowed">
                <span wire:loading.remove wire:target="sendChangePasswordOtp">Send OTP</span>
                <span wire:loading wire:target="sendChangePasswordOtp">Sending...</span>
            </button>
        @endif

        @if($step === 2)
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="text-xs text-gray-400">OTP Code</label>
                    <input wire:model="otp" maxlength="6" inputmode="numeric"
                           class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 text-white outline-none tracking-[6px]"
                           placeholder="••••••">
                    @error('otp') <div class="text-red-400 text-xs mt-2">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="text-xs text-gray-400">New Password</label>
                    <input type="password" wire:model="new_password"
                           class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 text-white outline-none"
                           placeholder="••••••••">
                    @error('new_password') <div class="text-red-400 text-xs mt-2">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="text-xs text-gray-400">Confirm Password</label>
                    <input type="password" wire:model="new_password_confirmation"
                           class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 text-white outline-none"
                           placeholder="••••••••">
                </div>

                @if(!$phone)
                    <div class="sm:col-span-2">
                        <label class="text-xs text-gray-400">Phone (optional)</label>
                        <input wire:model="new_phone"
                               class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 text-white outline-none"
                               placeholder="You can add phone now">
                        @error('new_phone') <div class="text-red-400 text-xs mt-2">{{ $message }}</div> @enderror
                    </div>
                @endif

                <div class="sm:col-span-2 flex flex-col sm:flex-row gap-3 mt-2">
                    <button wire:click="backToStep1"
                            class="w-full sm:w-auto border border-white/15 text-white px-6 py-3 rounded-2xl hover:bg-white/5 transition">
                        Back
                    </button>

                    <button wire:click="verifyOtpAndChangePassword"
                            wire:loading.attr="disabled"
                            wire:target="verifyOtpAndChangePassword"
                            class="btn-gold w-full sm:flex-1 px-6 py-3 rounded-2xl disabled:opacity-60 disabled:cursor-not-allowed">
                        <span wire:loading.remove wire:target="verifyOtpAndChangePassword">Verify & Change Password</span>
                        <span wire:loading wire:target="verifyOtpAndChangePassword">Processing...</span>
                    </button>
                </div>

                <button wire:click="sendChangePasswordOtp"
                        wire:loading.attr="disabled"
                        wire:target="sendChangePasswordOtp"
                        class="text-sm text-gold underline mt-2">
                    Resend OTP
                </button>
            </div>
        @endif
    </div>

</div>
