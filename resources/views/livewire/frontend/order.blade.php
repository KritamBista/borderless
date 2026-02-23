<div
    x-data="{ tab: 'instant' }"
    class="max-w-6xl mx-auto px-4 py-10"
>

    {{-- TAB SWITCH --}}
    <div class="flex bg-[#0b0f14] border border-white/10 rounded-2xl p-2 gap-2 shadow-lg">

        {{-- Instant --}}
        <button
            @click="tab = 'instant'"
            :class="tab === 'instant'
                ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg'
                : 'text-gray-400 hover:text-white'"
            class="flex-1 py-3 rounded-xl font-semibold transition-all duration-300"
        >
            ⚡ Instant Auto Quote
        </button>

        {{-- Assisted --}}
        <button
            @click="tab = 'assisted'"
            :class="tab === 'assisted'
                ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg'
                : 'text-gray-400 hover:text-white'"
            class="flex-1 py-3 rounded-xl font-semibold transition-all duration-300"
        >
            🎧 Assisted Order
        </button>

    </div>

    {{-- CONTENT SWITCH --}}
    <div class="mt-8">

        <div x-show="tab === 'instant'" x-transition>
            @include('frontend.quote-estimator')
        </div>

        <div x-show="tab === 'assisted'" x-transition>
            @livewire('frontend.assisted-order-form')
        </div>

    </div>

</div>
