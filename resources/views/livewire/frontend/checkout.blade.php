<div class="max-w-3xl mx-auto px-4 py-8">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-white">
            Checkout <span class="text-gold">— Step {{ $step }} of 2</span>
        </h1>
    </div>

    {{-- STEP 1: ADDRESS --}}
    @if ($step === 1)
        <div class="glass rounded-3xl p-6 space-y-5">

            {{-- Full Name --}}
            <div>
                <label class="text-xs text-gray-400">Full Name</label>
                <input wire:model="full_name"
                    class="w-full mt-1 bg-transparent border border-white/10 rounded-xl px-4 py-3 text-white">
                @error('full_name')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Phone --}}
            <div>
                <label class="text-xs text-gray-400">Phone</label>
                <input wire:model="phone"
                    class="w-full mt-1 bg-transparent border border-white/10 rounded-xl px-4 py-3 text-white">
                @error('phone')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Province --}}
            <div>
                <label class="text-xs text-gray-400">Province</label>
                <select wire:model="province"
                    class="w-full mt-1 bg-transparent border border-white/10 rounded-xl px-4 py-3 text-white">
                    <option value="">Select Province</option>
                    <option value="Koshi" class="text-black">Koshi</option>
                    <option value="Madhesh" class="text-black">Madhesh</option>
                    <option value="Bagmati" class="text-black">Bagmati</option>
                    <option value="Gandaki" class="text-black">Gandaki</option>
                    <option value="Lumbini" class="text-black">Lumbini</option>
                    <option value="Karnali" class="text-black">Karnali</option>
                    <option value="Sudurpashchim" class="text-black">Sudurpashchim</option>
                </select>
                @error('province')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- City --}}
            <div>
                <label class="text-xs text-gray-400">City</label>
                <input wire:model="city"
                    class="w-full mt-1 bg-transparent border border-white/10 rounded-xl px-4 py-3 text-white"
                    placeholder="e.g. Kathmandu">
                @error('city')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="text-xs text-gray-400">Postal Code(Optional)</label>
                <input type="number" wire:model="postal_code"
                    class="w-full mt-1 bg-transparent border border-white/10 rounded-xl px-4 py-3 text-white"
                    placeholder="Street name, house number, landmark..." rows="3"></input>
                @error('postal_code')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Address Line --}}
            <div>
                <label class="text-xs text-gray-400">Address Line</label>
                <textarea wire:model="address_line"
                    class="w-full mt-1 bg-transparent border border-white/10 rounded-xl px-4 py-3 text-white"
                    placeholder="Street name, house number, landmark..." rows="3"></textarea>
                @error('address_line')
                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>
            {{-- All Validation Errors --}}
            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/30 text-red-400 rounded-xl p-4 text-sm space-y-1">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{--
            <button wire:click="nextStep" class="btn-gold w-full mt-4 py-3 rounded-xl">
                Continue →
            </button> --}}
            <button wire:click="nextStep" wire:loading.attr="disabled" wire:target="nextStep"
                class="btn-gold w-full mt-4 py-3 rounded-xl flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed">
                <span wire:loading.remove wire:target="nextStep">
                    Continue →
                </span>

                <span wire:loading.flex wire:target="nextStep" class="flex items-center gap-2">
                    <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-80" d="M4 12a8 8 0 018-8" stroke="currentColor" stroke-width="4"
                            stroke-linecap="round"></path>
                    </svg>
                    Processing...
                </span>
            </button>

        </div>
    @endif
    {{-- STEP 2: PAYMENT --}}
    @if ($step === 2)
        <div class="glass rounded-3xl p-6 space-y-6">
            {{-- Checkout Total --}}
<div class="rounded-2xl border border-gold/20 bg-gradient-to-br from-gold/10 to-white/5 p-5">
    <div class="flex items-center justify-between gap-4">
        <div>
            <div class="text-xs uppercase tracking-[0.18em] text-gold/80 font-semibold">
                Checkout Total
            </div>
            <div class="text-sm text-gray-300 mt-1">
                Please complete payment for the amount below.
            </div>
        </div>

        <div class="text-right">
            <div class="text-xs text-gray-400">Payable Amount</div>
            <div class="text-2xl sm:text-3xl font-extrabold text-white leading-none mt-1">
                NPR {{ number_format($this->quote->payable_npr, 2) }}
            </div>
        </div>
    </div>
</div>

            <div>

                <label class="text-sm font-bold text-white">Select Payment Method</label>

                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach ($paymentMethods as $method)
                        @php
                            $isSelected = (int) $payment_method_id === (int) $method->id;
                        @endphp

                        <label
                            class="group relative flex items-start gap-3 sm:gap-4 border rounded-2xl p-4 cursor-pointer transition
                               {{ $isSelected ? 'border-gold/60 bg-gold/10 ring-1 ring-gold/30' : 'border-white/10 hover:border-white/20 hover:bg-white/5' }}">
                            {{-- Radio --}}
                            <input type="radio" wire:model.live="payment_method_id" value="{{ $method->id }}"
                                class="mt-1 h-4 w-4 accent-[#D8B04A]">

                            {{-- Text --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <div class="font-semibold text-white truncate">
                                        {{ $method->name }}
                                    </div>

                                    {{-- Small badge when selected --}}
                                    @if ($isSelected)
                                        <span
                                            class="text-[10px] sm:text-xs px-2 py-1 rounded-full bg-gold/15 text-gold border border-gold/25">
                                            Selected
                                        </span>
                                    @endif
                                </div>

                                @if ($method->description)
                                    <div class="text-xs sm:text-sm text-gray-400 mt-1 leading-snug">
                                        {{ $method->description }}
                                    </div>
                                @endif

                                {{-- Show image ONLY when selected --}}

                                {{-- Show image ONLY when selected --}}
@if ($method->image && $isSelected)
    <div class="mt-4 rounded-2xl border border-white/10 bg-black/20 p-4">
        <div class="flex flex-col sm:flex-row sm:items-center gap-4">

            {{-- QR / Payment image (BIG & SCANNABLE) --}}
            <div class="shrink-0">
                <div
                    class="w-28 h-28 sm:w-32 sm:h-32 md:w-40 md:h-40 rounded-2xl bg-white p-2 sm:p-3 shadow-lg">
                    <img
                        src="{{ asset('storage/' . $method->image) }}"
                        alt="{{ $method->name }} QR"
                        class="w-full h-full object-contain"
                        loading="lazy"
                    >
                </div>
            </div>

            {{-- Instructions --}}
            <div class="flex-1 min-w-0">
                <div class="text-sm sm:text-base font-semibold text-white">
                    Scan the QR to pay with {{ $method->name }}
                </div>

                <div class="mt-1 text-xs sm:text-sm text-gray-300 leading-relaxed">
                    After payment, upload your payment proof below.
                    <span class="text-gray-400">Tip: keep your order name in remarks.</span>
                </div>

                {{-- Optional actions --}}
                <div class="mt-3 flex flex-wrap gap-2">
                    <a
                        href="{{ asset('storage/' . $method->image) }}"
                        target="_blank"
                        class="text-xs sm:text-sm px-3 py-2 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 text-white"
                    >
                        Open QR in new tab
                    </a>

              <a
    href="{{ asset('storage/' . $method->image) }}"
    download
    class="text-xs sm:text-sm px-3 py-2 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 text-white"
>
    Download QR
</a>
                </div>
            </div>

        </div>
    </div>
@endif
                            </div>
                        </label>
                    @endforeach
                </div>

                @error('payment_method_id')
                    <div class="text-red-400 text-xs mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Upload --}}
            <div>
                <label class="text-sm font-bold text-white">Upload Payment Proof</label>

                <input type="file" wire:model="payment_proof"
                    class="mt-2 block w-full text-sm text-gray-200
                       file:mr-3 file:rounded-xl file:border-0
                       file:bg-white/10 file:px-4 file:py-2
                       file:text-white hover:file:bg-white/15">

                <div wire:loading wire:target="payment_proof" class="text-sm text-gold mt-2">
                    Uploading...
                </div>

                @error('payment_proof')
                    <div class="text-red-400 text-xs mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="w-full bg-red-500/10 border border-red-500/30 text-red-400 rounded-xl p-4 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Buttons --}}
            <div class="flex flex-col sm:flex-row sm:items-start gap-3">
                <button wire:click="backStep" wire:loading.attr="disabled" wire:target="placeOrder,payment_proof"
                    class="w-full sm:w-auto border border-white/20 text-white py-3 px-5 rounded-xl disabled:opacity-60 disabled:cursor-not-allowed">
                    ← Back
                </button>

                <button wire:click="placeOrder" wire:loading.attr="disabled" wire:target="placeOrder,payment_proof"
                    class="btn-gold w-full sm:flex-1 py-3 rounded-xl flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="placeOrder,payment_proof">
                        Confirm Order →
                    </span>

                    <span wire:loading.flex wire:target="placeOrder,payment_proof" class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24" fill="none">
                            <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-80" d="M4 12a8 8 0 018-8" stroke="currentColor" stroke-width="4"
                                stroke-linecap="round"></path>
                        </svg>
                        Submitting...
                    </span>
                </button>
            </div>

            <div wire:loading wire:target="payment_proof" class="mt-2 text-sm text-gold">
                Uploading...
            </div>
        </div>
    @endif

    {{-- STEP 2: PAYMENT --}}
    {{-- @if ($step === 2)
        <div class="glass rounded-3xl p-6 space-y-6">

            <div>
                <label class="text-sm font-bold text-white">Select Payment Method</label>
                <div class="mt-3 space-y-3">
                    @foreach ($paymentMethods as $method)
                        <label class="flex items-center gap-4 border border-white/10 p-4 rounded-2xl cursor-pointer">
                            <input type="radio" wire:model.live.debounce.200ms="payment_method_id" value="{{ $method->id }}">
                            <div class="flex-1">
                                <div class="font-semibold text-white">{{ $method->name }}</div>
                                @if ($method->description)
                                    <div class="text-xs text-gray-400">{{ $method->description }}</div>
                                @endif
                            </div>
                            @if ($method->image)
                                <img src="{{ asset('storage/' . $method->image) }}" class="h-12 rounded">
                            @endif
                        </label>
                    @endforeach
                </div>
                @error('payment_method_id')
                    <div class="text-red-400 text-xs mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="text-sm font-bold text-white">Upload Payment Proof</label>
                <input type="file" wire:model="payment_proof" class="mt-2 text-white">

                <div wire:loading wire:target="payment_proof" class="text-sm text-gold mt-2">
                    Uploading...
                </div>
            </div>
    @if ($errors->any())
        <div class="w-full sm:order-3 bg-red-500/10 border border-red-500/30 text-red-400 rounded-xl p-4 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="flex flex-col sm:flex-row sm:items-start gap-3">
    <button
        wire:click="backStep"
        wire:loading.attr="disabled"
        wire:target="placeOrder,payment_proof"
        class="w-full sm:w-auto border border-white/20 text-white py-3 px-5 rounded-xl disabled:opacity-60 disabled:cursor-not-allowed"
    >
        ← Back
    </button>



    <button
        wire:click="placeOrder"
        wire:loading.attr="disabled"
        wire:target="placeOrder,payment_proof"
        class="btn-gold w-full sm:flex-1 py-3 rounded-xl flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed"
    >
        <span wire:loading.remove wire:target="placeOrder,payment_proof">
            Confirm Order →
        </span>

        <span wire:loading.flex wire:target="placeOrder,payment_proof" class="items-center gap-2">
            <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24" fill="none">
                <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-80" d="M4 12a8 8 0 018-8" stroke="currentColor" stroke-width="4"
                    stroke-linecap="round"></path>
            </svg>
            Submitting...
        </span>
    </button>
</div>

<div wire:loading wire:target="payment_proof" class="mt-2 text-sm text-gold">
    Uploading...
</div>
        </div>
    @endif --}}

</div>
