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
                @foreach ($countries as $country)
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

            @foreach ($items as $index => $item)
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

{{-- <div class="relative z-100"> --}}
            <!-- Header -->
<!-- Country Selection -->
<div class="relative rounded-2xl mb-4 p-4
       bg-[#0f1621]/90
       border border-white/10
       {{-- shadow-[0_10px_40px_rgba(0,0,0,0.45)] --}}
       {{-- before:absolute before:inset-0
       before:rounded-2xl
       before:bg-gradient-to-b before:from-white/5 before:to-transparent --}}
       before:pointer-events-none">
    <div class="text-sm font-bold">Shipping From</div>

    <div class="mt-3">
        <div
            x-data="{
                open: false,
                countryId: @entangle('country_id'),
                selectedCountry: null,
                countries: @js($countries),

                init() {
                    // If already selected (edit mode / validation fail)
                    if (this.countryId) {
                        const found = this.countries.find(c => c.id == this.countryId);
                        if (found) {
                            this.selectedCountry = {
                                id: found.id,
                                name: found.name,
                                currency: found.currency_code,
                                flag: found.flag ? '/storage/' + found.flag : null
                            };
                        }
                    }
                },

                selectCountry(country) {
                    this.selectedCountry = {
                        id: country.id,
                        name: country.name,
                        currency: country.currency_code,
                        flag: country.flag ? '/storage/' + country.flag : null
                    };

                    this.countryId = country.id;
                    this.open = false;
                }
            }"
            class="relative w-64"
        >

            <!-- Selected Button -->
            <button
                type="button"
                @click="open = !open"
                class="w-full bg-[#0b0f14] border border-white/10 rounded-2xl px-4 py-3 z-100 text-white flex items-center justify-between focus:border-gold focus:ring-2 focus:ring-gold transition outline-none"
            >
                <template x-if="selectedCountry">
                    <span class="flex items-center gap-2">

                        <!-- Flag (only if exists) -->
                        <template x-if="selectedCountry.flag">
                            <img :src="selectedCountry.flag" class="w-5 h-5 rounded" alt="">
                        </template>

                        <span x-text="selectedCountry.name"></span>
                    </span>
                </template>

                <template x-if="!selectedCountry">
                    <span>Select country</span>
                </template>

                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Dropdown List -->
            <ul
                x-show="open"
                @click.outside="open = false"
                x-transition
                class="absolute z-50 w-full mt-1 bg-[#0b0f14] border border-white/10 rounded-xl max-h-60 "
            >
                <template x-for="country in countries" :key="country.id">
                    <li
                        @click="selectCountry(country)"
                        class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer gap-2"
                    >
                        <template x-if="country.flag">
                            <img :src="'/storage/' + country.flag" class="w-5 h-5 rounded" alt="">
                        </template>

                        <span x-text="country.name"></span>
                        <span class="text-xs text-gray-400" x-text="'(' + country.currency_code + ')'"></span>
                    </li>
                </template>
            </ul>
        </div>
    </div>

    @error('country_id')
        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
    @enderror
</div>

{{-- </div> --}}
        <!-- Main Form Card -->
        <div class="glass rounded-2xl p-6 md:p-10 shadow-2xl border border-white/5">


            <!-- Contact Info -->
            <div class="grid md:grid-cols-3 gap-6 mb-10">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Full Name</label>
                    <input type="text" wire:model="contact_name" required
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
                    <input type="text" wire:model="contact_phone" required
                        class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3  text-white  focus:border-gold focus:ring-2 focus:ring-gold transition outline-none"
                        placeholder="+977 98XXXXXXXX">
                </div>
            </div>

            <!-- Product Items -->
            <div class="mb-10">
                <h2 class="text-xl font-extrabold mb-4 text-white">Product Items</h2>

                @foreach ($items as $index => $item)
                    <div class="glass rounded-2xl p-6 mb-6 relative border border-white/5">
                        <button type="button" wire:click="removeItem({{ $index }})"
                            class="absolute top-4 right-4 text-gray-400 hover:text-red-400 transition text-sm font-medium"
                            @if (count($items) <= 1) disabled @endif>
                            Remove
                        </button>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm text-gray-400 mb-2">Product Name(Optional)</label>
                                <input type="text" wire:model="items.{{ $index }}.product_name"
                                    class="mt-1 w-full bg-transparent border border-white/10 rounded-2xl px-4 py-3 outline-none text-white focus:border-gold focus:ring-2 focus:ring-gold transition "
                                    placeholder="e.g. Wireless Earbuds">
                            </div>

                            <div>
                                <label class="block text-sm text-gray-400 mb-2">Product Link </label>
                                <input type="text" wire:model="items.{{ $index }}.product_link" required
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
                                <input type="number" step="0.01" min="0"
                                    wire:model="items.{{ $index }}.weight_kg"
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

                @error('contact_phone')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
                @error('country_id')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
                @error('items')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror <!-- custom message -->

                <!-- For items loop -->
                @foreach ($items as $index => $item)
                    @error("items.{$index}.product_link")
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                @endforeach
                {{-- <button type="button" wire:click="submit"
                        class="w-full py-5 bg-gold text-[#0b0f14] font-bold text-lg rounded-2xl hover:shadow-2xl hover:shadow-gold/30 transition duration-300 disabled:opacity-60 disabled:cursor-not-allowed">
                    Submit Assisted Order Request
                </button> --}}
                <div class="relative w-full">
                    <button type="button" wire:click="submit" wire:loading.attr="disabled"
                        class="w-full py-5 bg-gold text-[#0b0f14] font-bold text-lg rounded-2xl
               hover:shadow-2xl hover:shadow-gold/30 transition duration-300
               disabled:opacity-60 disabled:cursor-not-allowed">
                        <!-- Default text -->
                        <span wire:loading.remove>Submit Assisted Order Request</span>

                        <!-- Loading state -->
                        <span wire:loading class="flex items-center justify-center gap-3">
                            <svg class="animate-spin h-5 w-5 mr-3 text-[#0b0f14]" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Submitting...
                        </span>
                    </button>
                </div>
                <p class="text-center text-xs text-gray-500 mt-4">
                    Our team will review and send you a detailed quote within 24 hours.
                </p>
            </div>
        </div>
    </div>
</div>
