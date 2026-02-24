{{-- <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="max-w-3xl mx-auto text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-900">
            Assisted Order Request
        </h1>
        <p class="mt-3 text-gray-600">
            Send us your product details and our team will prepare a custom quote for you.
        </p>
    </div>

    <!-- Main Card -->
    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-2xl p-8 space-y-8">

        <!-- Country Section -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Select Destination Country
            </label>
            <select wire:model="country_id"
                class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Choose country</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Contact Section -->
        <div class="grid md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Full Name
                </label>
                <input type="text"
                    wire:model="contact_name"
                    class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="John Doe">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Email Address
                </label>
                <input type="email"
                    wire:model="contact_email"
                    class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="john@email.com">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Phone Number
                </label>
                <input type="text"
                    wire:model="contact_phone"
                    class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="+123456789">
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t pt-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Product Items
            </h2>

            @foreach($items as $index => $item)
                <div class="bg-gray-50 rounded-xl p-6 mb-6 relative">

                    <button type="button"
                        wire:click="removeItem({{ $index }})"
                        class="absolute top-4 right-4 text-red-500 hover:text-red-700 text-sm">
                        Remove
                    </button>

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Product Name
                            </label>
                            <input type="text"
                                wire:model="items.{{ $index }}.product_name"
                                class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Nike Shoes">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Product Link
                            </label>
                            <input type="text"
                                wire:model="items.{{ $index }}.product_link"
                                class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="https://...">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Quantity
                            </label>
                            <input type="number"
                                wire:model="items.{{ $index }}.quantity"
                                class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Weight (kg)
                            </label>
                            <input type="number" step="0.01"
                                wire:model="items.{{ $index }}.weight_kg"
                                class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                    </div>
                </div>
            @endforeach

            <!-- Add Item Button -->
            <button type="button"
                wire:click="addItem"
                class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-600 font-medium rounded-xl hover:bg-indigo-100 transition">
                + Add Another Item
            </button>

        </div>

        <!-- Submit Section -->
        <div class="pt-6 border-t">
            <button type="button"
                wire:click="submit"
                class="w-full py-4 bg-indigo-600 text-white font-semibold rounded-2xl shadow-lg hover:bg-indigo-700 transition duration-200">
                Submit Assisted Order
            </button>
        </div>

    </div>

</div> --}}

<div class="min-h-screen bg-darkbg py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
    <!-- Country Selection -->
        <div class="glass rounded-2xl mb-4 p-4 shadow-2xl border border-white/5">
            <div class="text-sm font-bold">Shipping From</div>

          <div class="mt-3 mb-4 w-full">
                <div x-data="{ open: false, selected: @entangle('country_id') }" class="relative w-full">
                    <!-- Selected Button -->
                    <button @click="open = !open"

                        class=" flex items-center justify-between mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3  text-white focus:border-gold/50 focus:ring-2 focus:ring-gold transition outline-none">
                        <template x-if="selected">
                            <span class="flex items-center gap-2">
                                <img :src="selected.flag" class="w-5 h-5 rounded" alt="">
                                <span x-text="selected.name ?? 'Select Country' "></span>
                            </span>
                        </template>
                        <template x-if="!selected">
                            <span>Select the country </span>
                        </template>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown List -->
                    <ul x-show="open" @click.outside="open = false"
                        class="absolute z-50 w-full mt-1 bg-[#0b0f14] border border-white/10 rounded-xl max-h-60 overflow-y-auto">
                        @foreach ($countries as $c)
                            <li @click="selected = { id: {{ $c['id'] }}, name: '{{ $c['name'] }}', currency: '{{ $c['currency_code'] }}', flag: '{{ Storage::url($c['flag']) }}' }; $wire.set('country_id', {{ $c['id'] }}); open = false"
                                class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer gap-2">
                                <img src="{{ Storage::url($c['flag']) }}" class="w-5 h-5 rounded" alt="">
                                {{ $c['name'] }} ({{ $c['currency_code'] }})
                            </li>
                        @endforeach
                    </ul>
                </div>
          </div>
    </div>
        <!-- Main Form Card -->
        <div class="glass rounded-2xl p-6 md:p-10 shadow-2xl border border-white/5">


            <!-- Contact Info -->
            <div class="grid md:grid-cols-3 gap-6 mb-10">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Full Name</label>
                    <input type="text" wire:model="contact_name"
                           class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3  text-white focus:border-gold/50 focus:ring-2 focus:ring-gold transition outline-none"
                           placeholder="Your full name">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Email Address</label>
                    <input type="email" wire:model="contact_email"
                           class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3  text-white focus:border-gold focus:ring-2 focus:ring-gold transition outline-none"
                           placeholder="your@email.com">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Phone Number</label>
                    <input type="text" wire:model="contact_phone"
                           class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3  text-white  focus:border-gold focus:ring-2 focus:ring-gold transition outline-none"
                           placeholder="+977 98XXXXXXXX">
                </div>
            </div>

            <!-- Product Items -->
            <div class="mb-10">
                    <h2 class="text-xl font-extrabold mb-4 text-white">Product Items</h2>

                @foreach($items as $index => $item)
                    <div class="glass rounded-2xl p-6 mb-6 relative border border-white/5">
                        <button type="button" wire:click="removeItem({{ $index }})"
                                class="absolute top-4 right-4 text-gray-400 hover:text-red-400 transition text-sm font-medium"
                                @if(count($items) <= 1) disabled @endif>
                            Remove
                        </button>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm text-gray-400 mb-2">Product Name</label>
                                <input type="text" wire:model="items.{{ $index }}.product_name"
                                       class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white focus:border-gold focus:ring-2 focus:ring-gold transition "
                                       placeholder="e.g. Wireless Earbuds">
                            </div>

                            <div>
                                <label class="block text-sm text-gray-400 mb-2">Product Link (optional)</label>
                                <input type="text" wire:model="items.{{ $index }}.product_link"
                                       class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3  text-white focus:border-gold focus:ring-2 focus:ring-gold transition outline-none"
                                       placeholder="https://...">
                            </div>

                            <div>
                                <label class="block text-sm text-gray-400 mb-2">Quantity</label>
                                <input type="number" min="1" wire:model="items.{{ $index }}.quantity"
                                       class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3  text-white focus:border-gold focus:ring-2 focus:ring-gold transition outline-none">
                            </div>

                            <div>
                                <label class="block text-sm text-gray-400 mb-2">Weight (kg)</label>
                                <input type="number" step="0.01" min="0" wire:model="items.{{ $index }}.weight_kg"
                                       class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3  text-white focus:border-gold focus:ring-2 focus:ring-gold transition outline-none"
                                       placeholder="0.5">
                            </div>
                        </div>
                    </div>
                @endforeach
                     <div class="flex items-center justify-end mb-6">
                    <button type="button" wire:click="addItem"
                            class="btn-gold px-5 py-3 rounded-2xl inline-flex items-center gap-2">
                        + Add another item
                    </button>
                </div>

            </div>

            <!-- Submit -->
            <div class="pt-6 border-t border-white/10">
                <button type="button" wire:click="submit"
                        class="w-full py-5 bg-gold text-[#0b0f14] font-bold text-lg rounded-2xl hover:shadow-2xl hover:shadow-gold/30 transition duration-300 disabled:opacity-60 disabled:cursor-not-allowed">
                    Submit Assisted Order Request
                </button>
                <p class="text-center text-xs text-gray-500 mt-4">
                    Our team will review and send you a detailed quote within 24 hours.
                </p>
            </div>
        </div>
    </div>
</div>
