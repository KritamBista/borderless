<div
    x-data="{ tab: 'instant' }"
    class="mx-auto px-4 py-8"
>



    {{-- CONTENT SWITCH --}}
    <div class="">
    <section
        class="relative rounded-3xl overflow-hidden border border-white/10 bg-[#0f141b] px-6 sm:px-10 py-12 sm:py-16">

        {{-- subtle gold glow --}}
        <div class="pointer-events-none absolute -top-24 -right-24 h-72 w-72 rounded-full bg-yellow-400/10 blur-3xl">
        </div>
        <div class="pointer-events-none absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-yellow-400/10 blur-3xl">
        </div>

        <div class="relative z-10 max-w-4xl">

                   <div class="inline-flex items-center rounded-full
                border border-gold/30 bg-gold/10
                px-4 md:px-5 py-1.5
                text-xs md:text-sm tracking-[0.25em] uppercase text-gold">
      Borderless bazzar
            </div>
            <h1 class="mt-6 text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-[1.1]">
                Get Your Quote <span class="text-gold">— Submit Order</span>
            </h1>

            <p class="text-gray-400 mt-4 max-w-2xl sm:text-lg leading-relaxed">
                Enter product price, quantity, weight and category.
                Totals update instantly (CIF → Duty → VAT) or you can choose for assisted order.
            </p>

            {{-- optional quick highlight row --}}
            <div class="mt-6 flex flex-wrap gap-4 text-xs text-gray-400">
                <span class="inline-flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-yellow-400"></span>
                    Real-time calculation
                </span>
                   <span class="inline-flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-yellow-400"></span>
              Assisted Quote
                </span>

                <span class="inline-flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-yellow-400"></span>
                    Transparent breakdown
                </span>
                <span class="inline-flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-yellow-400"></span>
                    Confirm before order
                </span>
            </div>
        </div>
           {{-- TAB SWITCH --}}


    </section>
        <div class="flex mt-8 bg-[#0b0f14] border border-white/10 rounded-2xl p-2 gap-2 shadow-lg">

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
        <div x-show="tab === 'instant'" x-transition>
            @livewire('frontend.quote-estimator')
        </div>

        <div x-show="tab === 'assisted'" x-transition>
            @livewire('frontend.assisted-order-form')
        </div>

    </div>

</div>
