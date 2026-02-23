<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">

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

</div>
