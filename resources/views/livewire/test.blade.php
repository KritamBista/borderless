<div class="max-w-7xl mx-auto px-6 py-10">
    <div class="flex items-start justify-between gap-6 flex-col ">
        <div>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                Request Quote <span class="text-gold">— Live Estimate</span>
            </h1>
            <p class="text-gray-400 mt-2 max-w-2xl">
                Enter product price, quantity, weight and category. Totals update instantly (CIF → Duty → VAT).
            </p>
        </div>

        <div class="glass rounded-2xl p-4 w-full lg:w-[380px]">
            <div class="text-sm font-bold">Shipping From</div>
            <div class="mt-3">
                <select wire:model.live="country_id"
                    class="w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white">
                    @foreach ($countries as $c)
                        <option value="{{ $c['id'] }}" class="bg-[#0b0f14]">
                            {{ $c['name'] }} ({{ $c['currency_code'] }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-3 text-xs text-gray-400 leading-relaxed">
                <div>Exchange: <span
                        class="text-gold font-semibold">{{ number_format($country['exchange_rate_to_npr'] ?? 0, 2) }}</span>
                    NPR / 1 {{ $country['currency_code'] ?? '' }}</div>
                <div>Shipping: <span
                        class="text-gold font-semibold">{{ number_format($country['shipping_rate_per_kg'] ?? 0, 2) }}</span>
                    NPR/kg</div>
                <div>Service Fee: <span
                        class="text-gold font-semibold">{{ number_format($country['service_fee_npr'] ?? 0, 2) }}</span>
                    NPR (per quote)</div>
                <div>VAT: <span class="text-gold font-semibold">{{ number_format($vatPercent, 2) }}%</span></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mt-8">
        <div class="lg:col-span-8 space-y-4">
            @foreach ($items as $index => $item)
                <div class="glass rounded-3xl p-5">
                    <div class="flex items-center justify-between gap-3">
                        <div class="font-bold">
                            Item #{{ $index + 1 }}
                            <span class="text-xs text-gray-400 font-medium ml-2">Per-product estimate</span>
                        </div>

                        <button wire:click="removeItem({{ $index }})"
                            class="text-sm text-gray-400 hover:text-white transition"
                            @if (count($items) <= 1) disabled @endif>
                            Remove
                        </button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 mt-4">
                        <div class="sm:col-span-6">
                            <label class="text-xs text-gray-400">Product Name</label>
                            <input wire:model.live="items.{{ $index }}.product_name"
                                class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                                placeholder="e.g., AirPods Pro">
                        </div>

                        <div class="sm:col-span-6">
                            <label class="text-xs text-gray-400">Product Link (optional)</label>
                            <input wire:model.live="items.{{ $index }}.product_link"  value="{{$link}}"
                                class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                                placeholder="Paste URL for reference">
                        </div>

                        <div class="sm:col-span-4">
                            <label class="text-xs text-gray-400">Category (Duty %)</label>
                            <select wire:model.live="items.{{ $index }}.category_id"
                                class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat['id'] }}" class="bg-[#0b0f14]">
                                        {{ $cat['name'] }} ({{ (int) round($cat['duty_rate'] * 100) }}%)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sm:col-span-3">
                            <label class="text-xs text-gray-400">Unit Price
                                ({{ $country['currency_code'] ?? '' }})</label>
                            <input type="number" step="0.01" min="0"
                                wire:model.live="items.{{ $index }}.unit_price_foreign"
                                class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                                placeholder="0.00">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="text-xs text-gray-400">Qty</label>
                            <input type="number" min="1" wire:model.live="items.{{ $index }}.quantity"
                                class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                                placeholder="1">
                        </div>

                        <div class="sm:col-span-3">
                            <label class="text-xs text-gray-400">Weight (kg)</label>
                            <input type="number" step="0.001" min="0"
                                wire:model.live="items.{{ $index }}.weight_kg"
                                class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                                placeholder="0.500">
                            <div class="text-[11px] text-gray-500 mt-1">
                                Min chargeable weight applies.
                            </div>
                        </div>
                    </div>


                    <div class="mt-5 grid grid-cols-2 sm:grid-cols-3 gap-3">
                        <div class="rounded-2xl p-3 border border-white/10">
                            <div class="text-xs text-gray-400">Item Cost (NPR)</div>
                            <div class="text-lg font-extrabold">{{ number_format($item['item_cost_npr'], 2) }}</div>
                        </div>
                        <div class="rounded-2xl p-3 border border-white/10">
                            <div class="text-xs text-gray-400">Shipping (NPR)</div>
                            <div class="text-lg font-extrabold">{{ number_format($item['shipping_npr'], 2) }}</div>
                        </div>
                        <div class="rounded-2xl p-3 border border-white/10">
                            <div class="text-xs text-gray-400">Duty (NPR)</div>
                            <div class="text-lg font-extrabold">{{ number_format($item['duty_npr'], 2) }}</div>
                        </div>
                        <div class="rounded-2xl p-3 border border-white/10">
                            <div class="text-xs text-gray-400">VAT (NPR)</div>
                            <div class="text-lg font-extrabold">{{ number_format($item['vat_npr'], 2) }}</div>
                        </div>
                        <div class="rounded-2xl p-3 border border-white/10 sm:col-span-2">
                            <div class="text-xs text-gray-400">Item Total (NPR)</div>
                            <div class="text-lg font-extrabold text-gold">{{ number_format($item['total_npr'], 2) }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <button wire:click="addItem" class="btn-gold px-5 py-3 rounded-2xl inline-flex items-center gap-2">
                + Add another item
            </button>
        </div>


        <div class="lg:col-span-4">
            <div class="glass rounded-3xl p-6 sticky top-24">
                <div class="flex items-center justify-between">
                    <div class="font-extrabold text-xl">Quote Summary</div>
                    <div class="text-xs text-gray-400">Live</div>
                </div>

                <div class="mt-5 space-y-3 text-sm">
                    <div class="flex justify-between text-gray-300">
                        <span>Items Cost</span>
                        <span>{{ number_format($totals['items_cost'], 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-300">
                        <span>Shipping</span>
                        <span>{{ number_format($totals['shipping'], 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-300">
                        <span>Duty</span>
                        <span>{{ number_format($totals['duty'], 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-300">
                        <span>VAT</span>
                        <span>{{ number_format($totals['vat'], 2) }}</span>
                    </div>

                    <div class="flex justify-between text-gray-300">
                        <span>Service Fee</span>
                        <span>{{ number_format($totals['service'], 2) }}</span>
                    </div>
                                           {{-- Coupon --}}
<div class="mt-5 border-t border-white/10 pt-4">
    <div class="text-sm font-bold mb-2">Discount Coupon</div>

    @if($applied_coupon)
        <div class="flex items-center justify-between gap-3 rounded-2xl p-3 border border-white/10">
            <div>
                <div class="text-sm font-extrabold text-gold">{{ $applied_coupon['code'] }}</div>
                <div class="text-xs text-gray-400">
                    @if($applied_coupon['type'] === 'percent')
                        {{ number_format((float)$applied_coupon['value'], 2) }}% off
                    @else
                        NPR {{ number_format((float)$applied_coupon['value'], 2) }} off
                    @endif
                </div>
            </div>

            <button wire:click="removeCoupon"
                    class="text-sm text-gray-400 hover:text-white transition">
                Remove
            </button>
        </div>
    @else
        <div class="flex gap-2">
            <input wire:model.defer="coupon_code"
                   class="flex-1 bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white"
                   placeholder="Enter coupon code">
            <button wire:click="applyCoupon"
                    class="btn-dark px-4 py-3 rounded-2xl">
                Apply
            </button>
        </div>
        @error('coupon_code')
            <div class="text-red-400 text-xs mt-2">{{ $message }}</div>
        @enderror
    @endif
</div>

                    <div class="border-t border-white/10 pt-4 flex justify-between text-base font-extrabold">


                        <span>Total Estimate</span>
                        <span class="text-gold">{{ number_format($totals['grand'], 2) }} NPR</span>
                    </div>
                    <div class="border-t border-white/10 pt-4 space-y-2">
    <div class="flex justify-between text-sm text-gray-300">
        <span>Grand Total</span>
        <span>{{ number_format($totals['grand'], 2) }} NPR</span>
    </div>

    <div class="flex justify-between text-sm text-gray-300">
        <span>Discount</span>
        <span>- {{ number_format($discount_npr, 2) }} NPR</span>
    </div>

    <div class="flex justify-between text-base font-extrabold">
        <span>Payable</span>
        <span class="text-gold">{{ number_format($payable_npr, 2) }} NPR</span>
    </div>
</div>


                    <div class="text-xs text-gray-500 leading-relaxed mt-3">
                        Note: Final invoice may vary slightly due to actual weight, customs reassessment or rate
                        changes.
                    </div>
                </div>

                <div class="mt-6">
                <button
    wire:click="proceed"
    wire:loading.attr="disabled"
    wire:target="proceed,saveQuote"
    class="btn-gold w-full px-5 py-3 rounded-2xl flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed"
>
    <span wire:loading.remove wire:target="proceed,saveQuote">
        Proceed
    </span>

    <span wire:loading wire:target="proceed,saveQuote" class="flex items-center gap-2">
        <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24" fill="none">
            <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-80" d="M4 12a8 8 0 018-8" stroke="currentColor" stroke-width="4" stroke-linecap="round"></path>
        </svg>
        Processing...
    </span>
</button>


                </div>
                <div class="mt-6">
                    <button
    wire:click="openRevisionModal"
    class=" w-full border border-white/20 text-white py-3 rounded-2xl hover:bg-white/5 transition"
>
    Request for Revision
</button>

                </div>


               @include('livewire.utils.quote-revision-modal')
            </div>
        </div>
    </div>
</div>
