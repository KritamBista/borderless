{{-- <section>
    @if ($open)
<div class="fixed inset-0 z-[999] flex items-center justify-center  px-4 sm:px-6 py-6">
    <div class="absolute inset-0 bg-black/70" wire:click="closeModal"></div>

    <div class="relative w-full max-w-md glass rounded-3xl border border-white/10 max-h-[85vh] overflow-hidden">
        <div class="flex items-center justify-between">
            <div class="font-extrabold text-xl">
                @if ($screen === 'register') Create Account @endif
                @if ($screen === 'login') Login @endif
                @if ($screen === 'otp') Verify OTP @endif
            </div>
            <button class="text-gray-400 hover:text-white" wire:click="closeModal">✕</button>
        </div>

        @if ($screen === 'register')
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

        @if ($screen === 'login')
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

        @if ($screen === 'otp')
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

</section> --}}
<section>
    @if ($open)

        {{-- Prevent background scroll --}}
        <style>
            body {
                overflow: hidden;
            }
        </style>

        <div class="fixed inset-0 z-[999] flex items-start sm:items-center justify-center px-4 sm:px-6 py-6">

            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" wire:click="closeModal"></div>

            {{-- Modal Box --}}
            <div
                class="relative w-full max-w-md glass rounded-3xl border border-white/10
                    max-h-[85vh] overflow-hidden shadow-2xl">

                {{-- Scrollable Content Wrapper --}}
                <div class="p-6 overflow-y-auto max-h-[85vh] scroll-hidden">

                    {{-- Header --}}
                    <div class="flex items-center justify-between">
                        <div class="font-extrabold text-xl">
                            @if ($screen === 'register')
                                Create Account
                            @endif
                            @if ($screen === 'login')
                                Login
                            @endif
                            @if ($screen === 'otp')
                                Verify OTP
                            @endif
                        </div>

                        <button
                            class="h-10 w-10 rounded-xl border border-white/10 bg-white/5
                               flex items-center justify-center hover:bg-white/10 transition"
                            wire:click="closeModal" aria-label="Close">
                            ✕
                        </button>
                    </div>

                    {{-- REGISTER SCREEN --}}
                    @if ($screen === 'register')
                        <p class="text-gray-400 text-sm mt-2">
                            Register and verify your email to continue.
                        </p>

                        <div class="mt-5 space-y-3">

                            <div>
                                <label class="text-xs text-gray-400">Name</label>
                                <input wire:model="name"
                                    class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                                    placeholder="Your name">
                                @error('name')
                                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="text-xs text-gray-400">Email</label>
                                <input wire:model="email"
                                    class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                                    placeholder="you@example.com">
                                @error('email')
                                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="text-xs text-gray-400">Phone (optional)</label>
                                <input wire:model="phone"
                                    class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                                    placeholder="98XXXXXXXX">
                                @error('phone')
                                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="text-xs text-gray-400">Password</label>
                                <input type="password" wire:model="password"
                                    class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                                    placeholder="••••••••">
                                @error('password')
                                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="text-xs text-gray-400">Confirm Password</label>
                                <input type="password" wire:model="password_confirmation"
                                    class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                                    placeholder="••••••••">
                            </div>

                            <button wire:click="register" wire:loading.attr="disabled"
                                class="btn-gold w-full mt-2 px-5 py-3 rounded-2xl flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed">

                                <span wire:loading.remove wire:target="register">
                                    Register & Verify →
                                </span>


                                <span wire:loading.flex wire:target="register" class="flex items-center gap-2">
                                    <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24" fill="none">
                                        <circle class="opacity-20" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-80" d="M4 12a8 8 0 018-8" stroke="currentColor"
                                            stroke-width="4" stroke-linecap="round"></path>
                                    </svg>
                                    Processing...
                                </span>
                            </button>

                            <div class="text-sm text-gray-400 mt-3">
                                Already have an account?
                                <button class="text-gold font-semibold hover:underline" wire:click="goLogin">
                                    Login
                                </button>
                            </div>

                        </div>
                    @endif

                    {{-- LOGIN SCREEN --}}
                    @if ($screen === 'login')
                        <p class="text-gray-400 text-sm mt-2">
                            Login to continue. If not verified, OTP will be required.
                        </p>

                        <div class="mt-5 space-y-3">

                            <div>
                                <label class="text-xs text-gray-400">Email</label>
                                <input wire:model="login_email"
                                    class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                                    placeholder="you@example.com">
                                @error('login_email')
                                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="text-xs text-gray-400">Password</label>
                                <input type="password" wire:model="login_password"
                                    class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                                    placeholder="••••••••">
                                @error('login_password')
                                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button wire:click="login" class="btn-gold w-full mt-2 px-5 py-3 rounded-2xl">
                                Login →
                            </button>
                            <div class="text-right">
                                <button class="text-sm text-gold hover:underline" wire:click="openForgot"
                                    type="button">
                                    Forgot password?
                                </button>
                            </div>

                            <div class="text-sm text-gray-400 mt-3">
                                New here?
                                <button class="text-gold font-semibold hover:underline" wire:click="goRegister">
                                    Create account
                                </button>
                            </div>

                        </div>
                    @endif

                    {{-- OTP SCREEN --}}
                    @if ($screen === 'otp')
                        <p class="text-gray-400 text-sm mt-2">
                            We sent an OTP to
                            <span class="text-gold font-semibold">{{ $otp_email }}</span>
                        </p>

                        <div class="mt-5">
                            <label class="text-xs text-gray-400">OTP Code</label>
                            <input wire:model="otp" inputmode="numeric" maxlength="6"
                                class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white tracking-[6px]"
                                placeholder="••••••">
                            @error('otp')
                                <div class="text-red-400 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex gap-3 mt-5">
                            <button wire:click="resendOtp" class="btn-dark w-full px-5 py-3 rounded-2xl">
                                Resend
                            </button>

                            <button wire:click="login" wire:loading.attr="disabled"
                                class="btn-gold w-full mt-2 px-5 py-3 rounded-2xl flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed">
                                <!-- Normal / idle state -->
                                <span wire:loading.remove wire:target="login">
                                    Login →
                                </span>

                                <!-- Loading state -->
                                <span wire:loading.flex wire:target="login" class="flex items-center gap-2">
                                    <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24" fill="none">
                                        <circle class="opacity-20" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-80" d="M4 12a8 8 0 018-8" stroke="currentColor"
                                            stroke-width="4" stroke-linecap="round"></path>
                                    </svg>
                                    Processing...
                                </span>
                            </button>
                        </div>

                        <div class="text-sm text-gray-400 mt-4">
                            Want to use different email?
                            <button class="text-gold font-semibold hover:underline" wire:click="goRegister">
                                Back
                            </button>
                        </div>
                    @endif

                    @if ($showForgot)

                        <div class="mt-6 border-t border-white/10 pt-6">

                            <div class="font-bold text-lg mb-4">Reset Password</div>

                            {{-- Step 1: Email --}}
                            @if ($forgotStep === 1)
                                <div>
                                    <label class="text-xs text-gray-400">Enter your email</label>
                                    <input wire:model="forgot_email"
                                        class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 text-white"
                                        placeholder="you@example.com">
                                    @error('forgot_email')
                                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                                    @enderror

                                    <button wire:click="sendForgotOtp" class="btn-gold w-full mt-4 py-3 rounded-2xl">
                                        Send OTP →
                                    </button>
                                </div>
                            @endif

                            {{-- Step 2: Verify OTP --}}
                            @if ($forgotStep === 2)
                                <div>
                                    <label class="text-xs text-gray-400">Enter OTP</label>
                                    <input wire:model="forgot_otp"
                                        class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 text-white"
                                        placeholder="••••••">
                                    @error('forgot_otp')
                                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                                    @enderror

                                    <button wire:click="verifyForgotOtp"
                                        class="btn-gold w-full mt-4 py-3 rounded-2xl">
                                        Verify OTP →
                                    </button>
                                </div>
                            @endif

                            {{-- Step 3: New Password --}}
                            @if ($forgotStep === 3)
                                <div class="space-y-3">
                                    <div>
                                        <label class="text-xs text-gray-400">New Password</label>
                                        <input type="password" wire:model="forgot_password"
                                            class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 text-white">
                                    </div>

                                    <div>
                                        <label class="text-xs text-gray-400">Confirm Password</label>
                                        <input type="password" wire:model="forgot_password_confirmation"
                                            class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 text-white">
                                    </div>

                                    @error('forgot_password')
                                        <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                                    @enderror

                                    <button wire:click="resetForgotPassword"
                                        class="btn-gold w-full mt-3 py-3 rounded-2xl">
                                        Reset Password →
                                    </button>
                                </div>
                            @endif

                        </div>

                    @endif

                </div>
            </div>
        </div>
    @endif
</section>
