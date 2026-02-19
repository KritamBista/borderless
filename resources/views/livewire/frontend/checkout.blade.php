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

            <button wire:click="nextStep" class="btn-gold w-full mt-4 py-3 rounded-xl">
                Continue →
            </button>

        </div>
    @endif


    {{-- STEP 2: PAYMENT --}}
    @if ($step === 2)
        <div class="glass rounded-3xl p-6 space-y-6">

            <div>
                <label class="text-sm font-bold text-white">Select Payment Method</label>
                <div class="mt-3 space-y-3">
                    @foreach ($paymentMethods as $method)
                        <label class="flex items-center gap-4 border border-white/10 p-4 rounded-2xl cursor-pointer">
                            <input type="radio" wire:model="payment_method_id" value="{{ $method->id }}">
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
                @error('payment_proof')
                    <div class="text-red-400 text-xs mt-2">{{ $message }}</div>
                @enderror

                <div wire:loading wire:target="payment_proof" class="text-sm text-gold mt-2">
                    Uploading...
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <button wire:click="backStep" wire:loading.attr="disabled" wire:target="placeOrder"
                    class="w-full sm:w-auto border border-white/20 text-white py-3 rounded-xl disabled:opacity-60 disabled:cursor-not-allowed">
                    ← Back
                </button>


                <button wire:click="placeOrder" wire:loading.attr="disabled" wire:target="placeOrder,payment_proof"
                    class="btn-gold w-full sm:flex-1 py-3 rounded-xl flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="placeOrder,payment_proof">
                        Confirm Order →
                    </span>

                    <span wire:loading wire:target="placeOrder,payment_proof" class="flex items-center gap-2">
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
        </div>
    @endif

</div>
