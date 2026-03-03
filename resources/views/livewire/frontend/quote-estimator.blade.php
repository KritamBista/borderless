<div class="max-w-7xl mx-auto px-6">

    <div class="flex items-start justify-between gap-6 flex-col py-4 ">


        <div class="glass rounded-2xl p-4 w-full lg:w-[380px]">
            <div class="text-sm font-bold">Shipping From</div>
            <div class="mt-3">
                <div x-data="{
                    open: false,
                    selectedId: @entangle('country_id'),
                    countries: @js($countries),
                    get selected() {
                        return this.countries.find(c => Number(c.id) === Number(this.selectedId)) || null;
                    }
                }" class="relative w-64">
                    <!-- Button -->
                    <button type="button" @click="open = !open"
                        class="w-full bg-[#0b0f14] border border-white/10 rounded-2xl px-4 py-3 text-white flex items-center justify-between focus:border-gold focus:ring-2 focus:ring-gold transition outline-none">
                        <span class="flex items-center gap-2">
                            <template x-if="selected?.flag">
                                <img :src="selected.flag" class="w-5 h-5 rounded" alt="">
                            </template>

                            <span x-text="selected?.name ?? 'Select Country'"></span>
                        </span>

                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <ul x-show="open" x-cloak @click.outside="open = false"
                        class="absolute z-50 w-full mt-1 bg-[#0b0f14] border border-white/10 rounded-xl max-h-60 overflow-y-auto">
                        <template x-for="c in countries" :key="c.id">
                            <li @click="selectedId = c.id;   $wire.set('country_id', c.id); open = false"
                                class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer gap-2">
                                <img :src="c.flag" class="w-5 h-5 rounded" alt="">
                                <span x-text="`${c.name} (${c.currency_code})`"></span>
                            </li>
                        </template>
                    </ul>
                </div>

                @error('country_id')
                    <div class="text-red-400 text-xs mt-2">{{ $message }}</div>
                @enderror
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

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 ">
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
                            <input wire:model.live="items.{{ $index }}.product_name" required
                                class="mt-1  w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3  text-white  focus:border-gold focus:ring-2 focus:ring-gold transition outline-none"
                                placeholder="e.g., AirPods Pro">
                        </div>

                        <div class="sm:col-span-6">
                            <label class="text-xs text-gray-400">Product Link </label>
                            <input wire:model.live="items.{{ $index }}.product_link" required
                                value="{{ $link }}"
                                class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white focus:border-gold focus:ring-2 focus:ring-gold transition"
                                placeholder="Paste URL for reference">
                        </div>

                        {{-- <div class="sm:col-span-4">
                            <label class="text-xs text-gray-400">Category (Duty %)</label>
                            <select wire:model.live="items.{{ $index }}.category_id"
                                class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white focus:border-gold focus:ring-2 focus:ring-gold transition ">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat['id'] }}" class="bg-[#0b0f14]">
                                        {{ $cat['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="sm:col-span-4">
                            <label class="text-xs text-gray-400">Category (Duty %)</label>

                            <select wire:model.live="items.{{ $index }}.category_id"
                                class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white focus:border-gold focus:ring-2 focus:ring-gold transition">

                                <!-- Placeholder option -->
                                <option value="" class="bg-[#0b0f14] text-gray-400" selected>
                                    Select Category
                                </option>

                                @foreach ($categories as $cat)
                                    <option value="{{ $cat['id'] }}" class="bg-[#0b0f14]">
                                        {{ $cat['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sm:col-span-3">
                            <label class="text-xs text-gray-400">Unit Price
                                ({{ $country['currency_code'] ?? '' }})</label>
                            <input type="number" step="0.01"
                                wire:model.live.debounce.500ms="items.{{ $index }}.unit_price_foreign"
                                class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white focus:border-gold focus:ring-2 focus:ring-gold transition "
                                placeholder="0.00">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="text-xs text-gray-400">Qty</label>
                            <input type="number" min="1" wire:model.live.debounce.500m="items.{{ $index }}.quantity"
                                class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white focus:border-gold focus:ring-2 focus:ring-gold transition "
                                placeholder="1">
                        </div>

                        <div class="sm:col-span-3">
                            <label class="text-xs text-gray-400">Weight (kg)</label>
                            <input type="number" step="0.001" min="0.5"
                                wire:model.live.debounce.500ms="items.{{ $index }}.weight_kg"
                                class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white focus:border-gold focus:ring-2 focus:ring-gold transition"
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

                        @if ($applied_coupon)
                            <div
                                class="flex items-center justify-between gap-3 rounded-2xl p-3 border border-white/10">
                                <div>
                                    <div class="text-sm font-extrabold text-gold">{{ $applied_coupon['code'] }}</div>
                                    <div class="text-xs text-gray-400">
                                        @if ($applied_coupon['type'] === 'percent')
                                            {{ number_format((float) $applied_coupon['value'], 2) }}% off
                                        @else
                                            NPR {{ number_format((float) $applied_coupon['value'], 2) }} off
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
                                    class="flex-1 bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white focus:border-gold focus:ring-2 focus:ring-gold transition"
                                    placeholder="Enter coupon code">
                                <button wire:click="applyCoupon" class="btn-dark px-4 py-3 rounded-2xl">
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

                {{-- @error("items.$index.unit_price_foreign")
                    <div class="text-red-400 text-xs mt-1">
                        {{ $message }}
                    </div>
                @enderror --}}

                @error('country_id')
                    <div class="text-red-400 text-xs mt-2">{{ $message }}</div>
                @enderror
                @php
                    $groupedItemErrors = [];

                    foreach ($errors->getMessages() as $field => $messages) {
                        if (preg_match('/^items\.(\d+)\./', $field, $m)) {
                            $idx = (int) $m[1];
                            $groupedItemErrors[$idx] = array_merge($groupedItemErrors[$idx] ?? [], $messages);
                        }
                    }

                    // remove duplicates
                    foreach ($groupedItemErrors as $idx => $msgs) {
                        $groupedItemErrors[$idx] = array_values(array_unique($msgs));
                    }
                @endphp

                @if (!empty($groupedItemErrors))
                    <div class="mt-3 p-4 bg-red-500/10 border border-red-500/30 rounded-2xl">
                        <p class="font-semibold text-red-300 mb-3">Please fix the following:</p>

                        <div class="space-y-3">
                            @foreach ($groupedItemErrors as $idx => $msgs)
                                <div class="rounded-xl border border-red-500/20 p-3 bg-black/10">
                                    <div class="font-semibold text-red-200 mb-2">
                                        Item #{{ $idx + 1 }}
                                    </div>
                                    <ul class="list-disc list-inside text-red-200 space-y-1 text-sm">
                                        @foreach ($msgs as $msg)
                                            <li>{{ $msg }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="mt-6 relative w-full">
                    <button id="proceed-btn" wire:click="proceed" wire:loading.attr="disabled"
                        wire:target="proceed,saveQuote"
                        class="btn-gold w-full px-5 py-3 rounded-2xl  disabled:opacity-60 disabled:cursor-not-allowed">
                        <span wire:loading.remove wire:target="proceed,saveQuote">
                            Proceed to Order
                        </span>

                        <span wire:loading.flex wire:target="proceed,saveQuote"
                            class="flex items-center justify-center gap-2">
                            <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <circle class="opacity-20" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-80" d="M4 12a8 8 0 018-8" stroke="currentColor" stroke-width="4"
                                    stroke-linecap="round"></path>
                            </svg>
                            Processing...
                        </span>
                    </button>
                </div>
                <div class="mt-6">
                    {{-- @if ($errors->any())
                        <div class="bg-red-500/10 border border-red-500/30 text-red-300 rounded-2xl p-4 text-sm">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                    <button wire:click="openRevisionModal"
                        class=" w-full border border-white/20 text-white py-3 rounded-2xl hover:bg-white/5 transition">
                        Request for Revision
                    </button>


                </div>


            </div>
        </div>
    </div>
    @include('livewire.utils.quote-revision-modal')

</div>
