<section>
    @if($open)
<div class="fixed inset-0 z-[999] flex items-center justify-center">
    <div class="absolute inset-0 bg-black/70" wire:click="closeModal"></div>

    <div class="relative w-[92%] max-w-md glass rounded-3xl p-6">
        <div class="flex items-center justify-between">
            <div class="font-extrabold text-xl">
                @if($screen === 'register') Create Account @endif
                @if($screen === 'login') Login @endif
                @if($screen === 'otp') Verify OTP @endif
            </div>
            <button class="text-gray-400 hover:text-white" wire:click="closeModal">✕</button>
        </div>

        @if($screen === 'register')
            <p class="text-gray-400 text-sm mt-2">Register and verify your email to continue.</p>

            <div class="mt-5 space-y-3">
                <div>
                    <label class="text-xs text-gray-400">Name</label>
                    <input wire:model="name"
                        class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                        placeholder="Your name">
                    @error('name') <div class="text-red-400 text-xs mt-1">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="text-xs text-gray-400">Email</label>
                    <input wire:model="email"
                        class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                        placeholder="you@example.com">
                    @error('email') <div class="text-red-400 text-xs mt-1">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="text-xs text-gray-400">Phone (optional)</label>
                    <input wire:model="phone"
                        class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                        placeholder="98XXXXXXXX">
                    @error('phone') <div class="text-red-400 text-xs mt-1">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="text-xs text-gray-400">Password</label>
                    <input type="password" wire:model="password"
                        class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                        placeholder="••••••••">
                    @error('password') <div class="text-red-400 text-xs mt-1">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="text-xs text-gray-400">Confirm Password</label>
                    <input type="password" wire:model="password_confirmation"
                        class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                        placeholder="••••••••">
                </div>

                <button wire:click="register" class="btn-gold w-full mt-2 px-5 py-3 rounded-2xl">
                    Register & Verify →
                </button>

                <div class="text-sm text-gray-400 mt-3">
                    Already have an account?
                    <button class="text-gold font-semibold hover:underline" wire:click="goLogin">Login</button>
                </div>
            </div>
        @endif

        @if($screen === 'login')
            <p class="text-gray-400 text-sm mt-2">Login to continue. If not verified, OTP will be required.</p>

            <div class="mt-5 space-y-3">
                <div>
                    <label class="text-xs text-gray-400">Email</label>
                    <input wire:model="login_email"
                        class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                        placeholder="you@example.com">
                    @error('login_email') <div class="text-red-400 text-xs mt-1">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="text-xs text-gray-400">Password</label>
                    <input type="password" wire:model="login_password"
                        class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                        placeholder="••••••••">
                    @error('login_password') <div class="text-red-400 text-xs mt-1">{{ $message }}</div> @enderror
                </div>

                <button wire:click="login" class="btn-gold w-full mt-2 px-5 py-3 rounded-2xl">
                    Login →
                </button>

                <div class="text-sm text-gray-400 mt-3">
                    New here?
                    <button class="text-gold font-semibold hover:underline" wire:click="goRegister">Create account</button>
                </div>
            </div>
        @endif

        @if($screen === 'otp')
            <p class="text-gray-400 text-sm mt-2">
                We sent an OTP to <span class="text-gold font-semibold">{{ $otp_email }}</span>
            </p>

            <div class="mt-5">
                <label class="text-xs text-gray-400">OTP Code</label>
                <input wire:model="otp" inputmode="numeric" maxlength="6"
                    class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white tracking-[6px]"
                    placeholder="••••••">
                @error('otp') <div class="text-red-400 text-xs mt-2">{{ $message }}</div> @enderror
            </div>

            <div class="flex gap-3 mt-5">
                <button wire:click="resendOtp" class="btn-dark w-full px-5 py-3 rounded-2xl">Resend</button>
                <button wire:click="verifyOtp" class="btn-gold w-full px-5 py-3 rounded-2xl">Verify</button>
            </div>

            <div class="text-sm text-gray-400 mt-4">
                Want to use different email?
                <button class="text-gold font-semibold hover:underline" wire:click="goRegister">Back</button>
            </div>
        @endif
    </div>
</div>
@endif

</section>
