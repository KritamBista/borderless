@section('og_title', $company?->meta_title ?? config('app.name'))

@section('og_description', \Illuminate\Support\Str::limit(strip_tags($company?->description ?? ''), 150))

@section('og_image', $company?->preview_image ? Storage::url($company->preview_image) : asset('default-event.jpg'))

@section('og_url', url()->current())
@push('schema')
@include('seo.schema.organization', ['company' => $company])

@include('seo.schema.faq', [
    'faqItems' => $faqs->map(
            fn($faq) => [
                'question' => $faq->question,
                'answer' => $faq->answer,
            ])->toArray(),
])

@endpush
<div class="bg-darkbg w-full text-white">
    <section class="relative w-full mx-auto px-6 lg:px-8 pt-14 sm:pt-20 pb-12 sm:pb-20 animate-fadeUp">
        <div class="absolute inset-0 pointer-events-none select-none overflow-hidden"> <img src="{{ asset('world.svg') }}"
                alt=""
                class="absolute inset-0 w-full h-full object-cover object-center opacity-[0.5] scale-100" />
            <div class="absolute inset-0 opacity-50"
                style="background: radial-gradient(circle at 55% 42%, rgba(214,177,94,.18), transparent 60%);"> </div>
            <div class="absolute top-0 left-0 right-0 h-28 sm:h-32"
                style="background: linear-gradient(to bottom, rgba(11,15,20,0.98), rgba(11,15,20,0));"> </div>
            <div class="absolute inset-0"
                style="background: radial-gradient(circle at 50% 45%, rgba(11,15,20,.10) 0%, rgba(11,15,20,.55) 65%, rgba(11,15,20,.85) 100%);">
            </div>
        </div>
        <div class="max-w-7xl mx-auto relative z-[100]">
            <div class="max-w-4xl"> {{-- Badge row --}} <div class="flex flex-wrap items-center gap-3 mb-6">
                    <div class="hidden sm:flex items-center gap-5 text-xs text-gray-400"> <span
                            class="inline-flex items-center gap-2"> <span
                                class="h-1.5 w-1.5 rounded-full bg-gold"></span> Clear breakdown </span> <span
                            class="inline-flex items-center gap-2"> <span
                                class="h-1.5 w-1.5 rounded-full bg-gold"></span> Fast checkout </span> <span
                            class="inline-flex items-center gap-2"> <span
                                class="h-1.5 w-1.5 rounded-full bg-gold"></span> Track orders </span> </div>
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.05] tracking-tight"> Place your
                    order in <span class="text-gold">under 1 minute.</span> </h1>
                <p class="mt-6 text-gray-300 sm:text-lg max-w-2xl"> Shop from Amazon, AliExpress, Myntra and more. We
                    handle shipping & customs, deliver to your doorstep in Nepal. </p> {{-- URL input --}} <div
                    class="mt-8">
                    <form action="{{ route('request.order') }}" method="GET"
                        class="glass rounded-2xl p-3 sm:p-4 flex flex-col sm:flex-row gap-3 max-w-2xl"> <input
                            type="url" name="product-url"
                            class="flex-1 bg-transparent outline-none text-white placeholder-gray-500 px-3 py-3 rounded-xl"
                            placeholder="Paste product URL here…" required> <button type="submit"
                            class="btn-gold px-6 py-3 rounded-xl whitespace-nowrap"> Create Order → </button> </form>
                    <div class="mt-3 text-xs text-gray-500"> Supports: Amazon, AliExpress, Myntra, eBay, UK/USA stores &
                        more. </div>
                </div>
            </div> {{-- 3 Step flow --}} {{-- 3 Step flow --}}
            <div class="mt-10 sm:mt-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-4 lg:gap-8 items-start"> {{-- Step 1 --}}
                    <div class="relative text-center max-w-[360px] mx-auto">
                        <div
                            class="hero-step-icon mx-auto h-20 w-20 sm:h-24 sm:w-24 rounded-full bg-gradient-to-br from-[#f8c84a] via-[#f4b52a] to-[#ee9d12] flex items-center justify-center">
                            <i class="fa-solid fa-bag-shopping text-white text-[34px] sm:text-[40px]"></i>
                        </div>
                        {{-- <div class="hidden md:flex items-center absolute top-[38px] right-[-16%] w-[120px]">
                            <div class="flex-1 h-[2px] bg-gradient-to-r from-[#f4b52a] to-[#f4b52a]/20"></div> <svg
                                class="w-4 h-4 text-[#f4b52a]" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                        </div> --}}
                        {{-- Desktop arrow (horizontal) --}}
                        <div class="hidden md:flex items-center absolute top-[38px] right-[-16%] w-[120px]">
                            <div class="flex-1 h-[2px] bg-gradient-to-r from-[#f4b52a] to-[#f4b52a]/20"></div>
                            <svg class="w-4 h-4 text-[#f4b52a]" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                        </div>

                        {{-- Mobile arrow (vertical) --}}
                        <div class="flex md:hidden justify-center mt-6">
                            <svg class="w-5 h-5 text-[#f4b52a]" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M6 13l6 6 6-6" />
                            </svg>
                        </div>
                        <div class="mt-5 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <span class="text-gray-400 text-[22px] sm:text-[26px] font-medium">01</span>
                                <h3 class="text-[28px] sm:text-[32px] font-semibold text-[#f4aa22] leading-none">Find
                                </h3>
                            </div>
                        </div>
                        <p
                            class="mt-4 text-[17px] sm:text-[18px] leading-8 text-[rgba(255,255,255,0.84)] max-w-[320px] mx-auto">
                            Find the product from any international online store and copy the link. </p>
                    </div> {{-- Step 2 --}}
                    <div class="relative text-center max-w-[360px] mx-auto">
                        <div
                            class="hero-step-icon mx-auto h-20 w-20 sm:h-24 sm:w-24 rounded-full bg-gradient-to-br from-[#f8c84a] via-[#f4b52a] to-[#ee9d12] flex items-center justify-center">
                            <i class="fa-solid fa-link text-white text-[34px] sm:text-[40px]"></i>
                        </div>
                        {{-- <div class="hidden md:flex items-center absolute top-[38px] right-[-16%] w-[120px]">
                            <div class="flex-1 h-[2px] bg-gradient-to-r from-[#f4b52a] to-[#f4b52a]/20"></div> <svg
                                class="w-4 h-4 text-[#f4b52a]" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                        </div> --}}
                        {{-- Desktop arrow (horizontal) --}}
                        <div class="hidden md:flex items-center absolute top-[38px] right-[-16%] w-[120px]">
                            <div class="flex-1 h-[2px] bg-gradient-to-r from-[#f4b52a] to-[#f4b52a]/20"></div>
                            <svg class="w-4 h-4 text-[#f4b52a]" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                        </div>

                        {{-- Mobile arrow (vertical) --}}
                        <div class="flex md:hidden justify-center mt-6">
                            <svg class="w-5 h-5 text-[#f4b52a]" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M6 13l6 6 6-6" />
                            </svg>
                        </div>
                        <div class="mt-5 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <span class="text-gray-400 text-[22px] sm:text-[26px] font-medium">02</span>
                                <h3 class="text-[28px] sm:text-[32px] font-semibold text-[#f4aa22] leading-none">Paste
                                </h3>
                            </div>
                        </div>
                        <p
                            class="mt-4 text-[17px] sm:text-[18px] leading-8 text-[rgba(255,255,255,0.84)] max-w-[320px] mx-auto">
                            Paste the link in the box above or submit product details to us. </p>
                    </div>

                    {{-- Step 3 --}}

                    <div class="relative text-center max-w-[360px] mx-auto">
                        <div
                            class="hero-step-icon mx-auto h-20 w-20 sm:h-24 sm:w-24 rounded-full bg-gradient-to-br from-[#f8c84a] via-[#f4b52a] to-[#ee9d12] flex items-center justify-center">
                            <i class="fa-solid fa-box-open text-white text-[34px] sm:text-[40px]"></i>
                        </div>
                        <div class="mt-5 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <span class="text-gray-400 text-[22px] sm:text-[26px] font-medium">03</span>
                                <h3 class="text-[28px] sm:text-[32px] font-semibold text-[#f4aa22] leading-none">
                                    Delivered</h3>
                            </div>
                        </div>
                        <p
                            class="mt-4 text-[17px] sm:text-[18px] leading-8 text-[rgba(255,255,255,0.84)] max-w-[320px] mx-auto">
                            We handle the rest and deliver your product safely to your doorstep. </p>
                    </div>
                </div>
            </div> {{-- <div class="mt-10 sm:mt-12"> <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-5 lg:gap-8 items-start"> <div class="relative text-center max-w-[360px] mx-auto"> <div class="mx-auto h-20 w-20 sm:h-24 sm:w-24 rounded-full bg-gradient-to-br from-[#f7c443] to-[#f2a51a] flex items-center justify-center shadow-[0_10px_28px_rgba(242,165,26,0.22)]"> <i class="fa-solid fa-bag-shopping text-white text-[34px] sm:text-[40px]"></i> </div> <div class="hidden md:block absolute top-8 right-[-8%] lg:right-[-10%] text-[rgba(242,165,26,0.75)] text-3xl"> → </div> <h3 class="mt-5 text-[34px] sm:text-[40px] font-extrabold leading-none text-[#f0a62a]"> Find </h3> <p class="mt-4 text-[17px] sm:text-[18px] leading-8 text-[rgba(255,255,255,0.82)] max-w-[320px] mx-auto"> Find the product from any international online store and copy the link. </p> </div> <div class="relative text-center max-w-[360px] mx-auto"> <div class="mx-auto h-20 w-20 sm:h-24 sm:w-24 rounded-full bg-gradient-to-br from-[#f7c443] to-[#f2a51a] flex items-center justify-center shadow-[0_10px_28px_rgba(242,165,26,0.22)]"> <i class="fa-solid fa-link text-white text-[34px] sm:text-[40px]"></i> </div> <div class="hidden md:block absolute top-8 right-[-8%] lg:right-[-10%] text-[rgba(242,165,26,0.75)] text-3xl"> → </div> <h3 class="mt-5 text-[34px] sm:text-[40px] font-extrabold leading-none text-[#f0a62a]"> Submit </h3> <p class="mt-4 text-[17px] sm:text-[18px] leading-8 text-[rgba(255,255,255,0.82)] max-w-[320px] mx-auto"> Paste the link in the box above or submit product details to us. </p> </div> <div class="relative text-center max-w-[360px] mx-auto"> <div class="mx-auto h-20 w-20 sm:h-24 sm:w-24 rounded-full bg-gradient-to-br from-[#f7c443] to-[#f2a51a] flex items-center justify-center shadow-[0_10px_28px_rgba(242,165,26,0.22)]"> <i class="fa-solid fa-box-open text-white text-[34px] sm:text-[40px]"></i> </div> <h3 class="mt-5 text-[34px] sm:text-[40px] font-extrabold leading-none text-[#f0a62a]"> Delivered </h3> <p class="mt-4 text-[17px] sm:text-[18px] leading-8 text-[rgba(255,255,255,0.82)] max-w-[320px] mx-auto"> We handle the rest and deliver your product safely to your doorstep. </p> </div> </div> </div> --}}
        </div>
    </section>



    <section class="py-24 relative bg-gradient-to-b from-black to-neutral-950">

        <div class="w-full mx-auto px-6">

            {{-- Section Header --}}
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">
                    Powering cross-border commerce in Nepal
                </h2>
                <p class="mt-4 text-gray-400 max-w-2xl mx-auto text-sm sm:text-base">
                    Delivering measurable growth and seamless e-commerce experiences across global markets.
                </p>
            </div>

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 text-center">

                {{-- Orders Placed --}}
                <div
                    class="glass rounded-3xl p-10 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_15px_40px_rgba(214,177,94,0.25)] transition duration-500 ease-out">
                    <div class="text-5xl sm:text-6xl font-extrabold text-gold counter"
                        data-target="{{ $company->orders_placed ?? 1000 }}">
                        0
                    </div>
                    <div class="mt-4 text-base font-semibold text-white">
                        Orders Processed
                    </div>
                    <p class="mt-2 text-sm text-gray-400">
                        Successfully fulfilled transactions across our ecosystem.
                    </p>
                </div>

                {{-- E-commerce Stores --}}
                <div
                    class="glass rounded-3xl p-10 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_15px_40px_rgba(214,177,94,0.25)] transition duration-500 ease-out">
                    <div class="text-5xl sm:text-6xl font-extrabold text-gold counter"
                        data-target="{{ $company->ecommerce_stores ?? 100 }}">
                        0
                    </div>
                    <div class="mt-4 text-base font-semibold text-white">
                        Active E-commerce Stores
                    </div>
                    <p class="mt-2 text-sm text-gray-400">
                        Optimized and accessible storefronts delivering real results.
                    </p>
                </div>

                {{-- Countries --}}
                <div
                    class="glass rounded-3xl p-10 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_15px_40px_rgba(214,177,94,0.25)] transition duration-500 ease-out">
                    <div class="text-5xl sm:text-6xl font-extrabold text-gold counter"
                        data-target="{{ $company->countries ?? 7 }}">
                        0
                    </div>
                    <div class="mt-4 text-base font-semibold text-white">
                        Countries Reached
                    </div>
                    <p class="mt-2 text-sm text-gray-400">
                        Expanding global presence through scalable commerce solutions.
                    </p>
                </div>

            </div>

        </div>
    </section>
    <section id="why-borderless" class="relative py-20 md:py-28 bg-[#0b0f14] overflow-hidden">

        {{-- <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-gold/5 rounded-full blur-3xl -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-gold/5 rounded-full blur-3xl translate-y-1/2"></div>
        </div> --}}
        <div class="max-w-7xl mx-auto px-5 sm:px-6">

            <!-- Header -->
            <div class="max-w-3xl lg:w-full mb-16 md:mb-16">

                <div
                    class="inline-flex items-center rounded-full
                border border-gold/30 bg-gold/10
                px-4 md:px-5 py-1.5
                text-xs md:text-sm tracking-[0.25em] uppercase text-gold">
                    Why Borderless Bazzar
                </div>

                <h2 class="mt-5 text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-tight">
                    Cross-border shopping made simple for Nepal
                </h2>

                <p class="mt-4 text-gray-400 text-base md:text-lg leading-relaxed max-w-2xl">
                    Clear pricing, faster quotes, and end-to-end visibility — from product link to delivery at your
                    door.
                </p>

            </div>

            <!-- Grid -->
            <div class="grid gap-6 md:gap-8 sm:grid-cols-2 lg:grid-cols-3">

                <!-- CARD 1 -->
                <div class="relative rounded-2xl p-[1px] bg-gradient-to-b from-white/10 to-transparent group">
                    <div
                        class="relative bg-[#0f141a] rounded-2xl p-6 md:p-8 h-full overflow-hidden
                   transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:border-gold/30 hover:border-gold/30">

                        <!-- Soft Glow -->
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500">
                            <div class="absolute -top-20 -left-20 w-72 h-72 bg-gold/10 rounded-full blur-3xl"></div>
                        </div>

                        <div class="relative flex items-start gap-4">

                            <div
                                class="h-12 w-12 flex-shrink-0 rounded-xl
                            bg-gradient-to-br from-gold/20 to-gold/5
                            border border-gold/30
                            flex items-center justify-center text-gold">

                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 2L3 14h7l-1 8 12-14h-7l1-6z" />
                                </svg>

                            </div>

                            <div>
                                <h3 class="text-lg md:text-xl font-semibold text-white">
                                    Instant quote estimator
                                </h3>

                                <p class="mt-2 text-sm md:text-base text-gray-400 leading-relaxed">
                                    Paste the product link, add weight and price — get a quick NPR estimate instantly.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="relative rounded-2xl p-[1px] bg-gradient-to-b from-white/10 to-transparent group">
                    <div
                        class="relative bg-[#0f141a] rounded-2xl p-6 md:p-8 h-full overflow-hidden
                   transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:border-gold/30 hover:border-gold/30">

                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500">
                            <div class="absolute -top-20 -left-20 w-72 h-72 bg-gold/10 rounded-full blur-3xl"></div>
                        </div>

                        <div class="relative flex items-start gap-4">

                            <div
                                class="h-12 w-12 flex-shrink-0 rounded-xl
                            bg-gradient-to-br from-gold/20 to-gold/5
                            border border-gold/30
                            flex items-center justify-center text-gold">

                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4h6v6H4V4zm10 0h6v6h-6V4zM4 14h6v6H4v-6zm10 4h2m-2-4h6v6h-6v-6z" />
                                </svg>

                            </div>

                            <div>
                                <h3 class="text-lg md:text-xl font-semibold text-white">
                                    Easy payment options
                                </h3>

                                <p class="mt-2 text-sm md:text-base text-gray-400 leading-relaxed">
                                    Pay via eSewa, Khalti or bank transfer — with clear steps and confirmations.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="relative rounded-2xl p-[1px] bg-gradient-to-b from-white/10 to-transparent group">
                    <div
                        class="relative bg-[#0f141a] rounded-2xl p-6 md:p-8 h-full overflow-hidden
                   transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:border-gold/30 hover:border-gold/30">

                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500">
                            <div class="absolute -top-20 -left-20 w-72 h-72 bg-gold/10 rounded-full blur-3xl"></div>
                        </div>

                        <div class="relative flex items-start gap-4">

                            <div
                                class="h-12 w-12 flex-shrink-0 rounded-xl
                            bg-gradient-to-br from-gold/20 to-gold/5
                            border border-gold/30
                            flex items-center justify-center text-gold">

                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 14h6m-6-4h6M7 3h10a2 2 0 012 2v16l-3-2-3 2-3-2-3 2V5a2 2 0 012-2z" />
                                </svg>

                            </div>

                            <div>
                                <h3 class="text-lg md:text-xl font-semibold text-white">
                                    Transparent cost breakdown
                                </h3>

                                <p class="mt-2 text-sm md:text-base text-gray-400 leading-relaxed">
                                    Duty, freight, and service fees — fully itemized before you confirm.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- CARD 4 -->
                <div class="relative rounded-2xl p-[1px] bg-gradient-to-b from-white/10 to-transparent group">
                    <div
                        class="relative bg-[#0f141a] rounded-2xl p-6 md:p-8 h-full overflow-hidden
                   transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:border-gold/30 hover:border-gold/30">

                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500">
                            <div class="absolute -top-20 -left-20 w-72 h-72 bg-gold/10 rounded-full blur-3xl"></div>
                        </div>

                        <div class="relative flex items-start gap-4">

                            <div
                                class="h-12 w-12 flex-shrink-0 rounded-xl
                            bg-gradient-to-br from-gold/20 to-gold/5
                            border border-gold/30
                            flex items-center justify-center text-gold">

                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 2l7 4v6c0 5-3 9-7 10-4-1-7-5-7-10V6l7-4z" />
                                </svg>

                            </div>

                            <div>
                                <h3 class="text-lg md:text-xl font-semibold text-white">
                                    Verified order handling
                                </h3>

                                <p class="mt-2 text-sm md:text-base text-gray-400 leading-relaxed">
                                    We double-check product details before shipment to prevent surprises.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- CARD 5 -->
                <div class="relative rounded-2xl p-[1px] bg-gradient-to-b from-white/10 to-transparent group">
                    <div
                        class="relative bg-[#0f141a] rounded-2xl p-6 md:p-8 h-full overflow-hidden
                   transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:border-gold/30 hover:border-gold/30">

                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500">
                            <div class="absolute -top-20 -left-20 w-72 h-72 bg-gold/10 rounded-full blur-3xl"></div>
                        </div>

                        <div class="relative flex items-start gap-4">

                            <div
                                class="h-12 w-12 flex-shrink-0 rounded-xl
                            bg-gradient-to-br from-gold/20 to-gold/5
                            border border-gold/30
                            flex items-center justify-center text-gold">

                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 21s7-4.5 7-11a7 7 0 10-14 0c0 6.5 7 11 7 11z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>

                            </div>

                            <div>
                                <h3 class="text-lg md:text-xl font-semibold text-white">
                                    Track progress end-to-end
                                </h3>

                                <p class="mt-2 text-sm md:text-base text-gray-400 leading-relaxed">
                                    Quote → payment → shipment → delivery updates in one dashboard.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- CARD 6 -->
                <div class="relative rounded-2xl p-[1px] bg-gradient-to-b from-white/10 to-transparent group">
                    <div
                        class="relative bg-[#0f141a] rounded-2xl p-6 md:p-8 h-full overflow-hidden
                   transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:border-gold/30 hover:border-gold/30">

                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500">
                            <div class="absolute -top-20 -left-20 w-72 h-72 bg-gold/10 rounded-full blur-3xl"></div>
                        </div>

                        <div class="relative flex items-start gap-4">

                            <div
                                class="h-12 w-12 flex-shrink-0 rounded-xl
                            bg-gradient-to-br from-gold/20 to-gold/5
                            border border-gold/30
                            flex items-center justify-center text-gold">

                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 8l-9 5-9-5m18 0l-9-5-9 5m18 0v10l-9 5-9-5V8" />
                                </svg>

                            </div>

                            <div>
                                <h3 class="text-lg md:text-xl font-semibold text-white">
                                    Special handling when needed
                                </h3>

                                <p class="mt-2 text-sm md:text-base text-gray-400 leading-relaxed">
                                    Fragile or high-value items receive extra care and protective dispatch.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    {{-- How it works --}}
    {{-- <section id="how" class="py-20 md:py-28 bg-gradient-to-b from-[#0f141a] to-[#0c1117]  relative overflow-hidden"> --}}
    <section id="how"
        class="py-20 md:py-28 bg-gradient-to-b from-black to-neutral-950  relative overflow-hidden">

        <!-- Subtle background glows -->
        {{-- <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-gold/5 rounded-full blur-3xl -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-gold/5 rounded-full blur-3xl translate-y-1/2"></div>
        </div> --}}
        <div class="max-w-7xl mx-auto px-6">

            <!-- Header -->
            <div class="text-center mb-16 md:mb-24">

                {{-- <div
                    class="inline-flex items-center rounded-full border border-gold/30 bg-gold/10 px-4 md:px-5 py-1.5 text-xs md:text-sm text-gold mb-5 md:mb-6  text-gold">
                    How it works
                </div> --}}
                <div
                    class="inline-flex items-center rounded-full
                border border-gold/30 bg-gold/10
                px-4 md:px-5 py-1.5 mb-2
                text-xs md:text-sm tracking-[0.25em] uppercase text-gold">
                    How it works
                </div>

                <h2
                    class="text-3xl sm:text-4xl  md:text-6xl font-bold text-white mb-6 md:mb-6 tracking-tight leading-tight">
                    Simple, transparent process
                </h2>

                <p class="text-gray-400 text-base md:text-lg max-w-xl md:max-w-2xl mx-auto">
                    From order to delivery, we make international shopping effortless for Nepal.
                </p>

            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">

                <!-- CARD -->
                <div class="relative rounded-2xl p-[1px] bg-gradient-to-b from-white/10 to-transparent group">

                    <div class="relative bg-[#0f141a] rounded-2xl p-8 h-full overflow-hidden transition duration-500">

                        <!-- Glow -->
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500">
                            <div class="absolute -top-20 -left-20 w-72 h-72 bg-gold/10 rounded-full blur-3xl"></div>
                        </div>

                        <!-- Number -->
                        <div class="absolute top-5 right-5 text-5xl md:text-6xl font-bold text-white/5">
                            01
                        </div>

                        <!-- Icon -->
                        <div
                            class="relative w-12 h-12 flex items-center justify-center
                        bg-gradient-to-br from-gold/20 to-gold/5
                        border border-gold/30
                        rounded-xl text-gold mb-5 md:mb-6">

                            <!-- Link Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.828 10.172a4 4 0 015.656 5.656l-3 3a4 4 0 01-5.656-5.656m0 0l-1.414-1.414a4 4 0 00-5.656 5.656l3 3a4 4 0 005.656-5.656" />
                            </svg>
                        </div>

                        <h3 class="text-white text-lg font-semibold mb-3">
                            Paste Product Link
                        </h3>

                        <p class="text-gray-400 text-sm leading-relaxed">
                            Copy the product URL from Amazon, AliExpress, Myntra or any supported store and paste it in
                            our order form.
                        </p>
                    </div>
                </div>


                <!-- CARD 02 -->
                <div class="relative rounded-2xl p-[1px] bg-gradient-to-b from-white/10 to-transparent group">
                    <div class="relative bg-[#0f141a] rounded-2xl p-8 h-full overflow-hidden transition duration-500">
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500">
                            <div class="absolute -top-20 -left-20 w-72 h-72 bg-gold/10 rounded-full blur-3xl"></div>
                        </div>

                        <div class="absolute top-6 right-6 text-6xl font-bold text-white/5">02</div>

                        <div
                            class="relative w-12 h-12 flex items-center justify-center
                        bg-gradient-to-br from-gold/20 to-gold/5
                        border border-gold/30
                        rounded-xl text-gold mb-6">
                            <!-- Box Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                            </svg>
                        </div>

                        <h3 class="text-white text-lg font-semibold mb-3">
                            We Purchase & Verify
                        </h3>

                        <p class="text-gray-400 text-sm leading-relaxed">
                            We place your order, verify the product quality and prepare it for safe international
                            shipping.
                        </p>
                    </div>
                </div>

                <!-- CARD 03 -->
                <div class="relative rounded-2xl p-[1px] bg-gradient-to-b from-white/10 to-transparent group">
                    <div class="relative bg-[#0f141a] rounded-2xl p-8 h-full overflow-hidden transition duration-500">
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500">
                            <div class="absolute -top-20 -left-20 w-72 h-72 bg-gold/10 rounded-full blur-3xl"></div>
                        </div>

                        <div class="absolute top-6 right-6 text-6xl font-bold text-white/5">03</div>

                        <div
                            class="relative w-12 h-12 flex items-center justify-center
                        bg-gradient-to-br from-gold/20 to-gold/5
                        border border-gold/30
                        rounded-xl text-gold mb-6">
                            <!-- Plane Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.5 19l19-7-19-7v5l13 2-13 2v5z" />
                            </svg>
                        </div>

                        <h3 class="text-white text-lg font-semibold mb-3">
                            Customs Cleared
                        </h3>

                        <p class="text-gray-400 text-sm leading-relaxed">
                            We handle customs paperwork, duties and taxes — no surprises at delivery.
                        </p>
                    </div>
                </div>

                <!-- CARD 04 -->
                <div class="relative rounded-2xl p-[1px] bg-gradient-to-b from-white/10 to-transparent group">
                    <div class="relative bg-[#0f141a] rounded-2xl p-8 h-full overflow-hidden transition duration-500">
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500">
                            <div class="absolute -top-20 -left-20 w-72 h-72 bg-gold/10 rounded-full blur-3xl"></div>
                        </div>

                        <div class="absolute top-6 right-6 text-6xl font-bold text-white/5">04</div>

                        <div
                            class="relative w-12 h-12 flex items-center justify-center
                        bg-gradient-to-br from-gold/20 to-gold/5
                        border border-gold/30
                        rounded-xl text-gold mb-6">
                            <!-- Home Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 10l9-7 9 7v10a2 2 0 01-2 2h-4v-6H9v6H5a2 2 0 01-2-2V10z" />
                            </svg>
                        </div>

                        <h3 class="text-white text-lg font-semibold mb-3">
                            Delivered to You
                        </h3>

                        <p class="text-gray-400 text-sm leading-relaxed">
                            Your package arrives at your doorstep in Nepal — fully tracked from start to finish.
                        </p>

                        <div class="text-green-400 text-sm mt-4">
                            ✓ Complete
                        </div>
                    </div>
                </div>

            </div>


            <div class="mt-20 text-center text-gray-500 text-sm">
                No hidden fees • Real-time tracking • Full transparency at every step
            </div>

        </div>
    </section>




    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-14">


        <div class=" gap-8 items-start">

            <div class="lg:col-span-5">

                <div
                    class="inline-flex items-center rounded-full
                border border-gold/30 bg-gold/10
                px-4 md:px-5 py-1.5
                text-xs md:text-sm tracking-[0.25em] uppercase text-gold">
                    TRUSTED STORES
                </div>

                <h2 class="mt-4 text-3xl sm:text-4xl font-extrabold leading-tight">
                    Order from the stores you already trust.
                </h2>


                <p class="mt-3 text-gray-400 text-sm sm:text-base max-w-md">
                    Amazon, AliExpress, Myntra and more — paste the product link, we handle the rest.
                </p>
                <div class="mt-6">
                    <div class="glass rounded-3xl p-4 sm:p-6 overflow-hidden relative">

                        <div class="pointer-events-none absolute -top-24 -right-24 h-64 w-64 rounded-full"
                            style="background: radial-gradient(circle, rgba(214,177,94,.18), transparent 60%);"></div>

                        <div class="flex items-center justify-between mb-4">
                            <div class="text-sm font-extrabold text-white">Popular stores</div>
                        </div>

                        @php
                            $stores = $trustedStores ?? collect();
                        @endphp

                        <div class="space-y-4">

                            {{-- ROW 1 → Left to Right --}}
                            <div class="bb-marquee group">
                                <div class="bb-track bb-left">
                                    @foreach ($stores as $s)
                                        <a href="{{ $s->link ?? '#' }}" target="_blank" class="bb-card">
                                            <div class="bb-logo">
                                                <img src="{{ asset('storage/' . $s->logo) }}"
                                                    alt="{{ $s->name }}"
                                                    class="h-8 w-auto object-contain opacity-90">
                                            </div>
                                            <div class="bb-name">{{ $s->name }}</div>
                                        </a>
                                    @endforeach

                                    {{-- duplicate --}}
                                    @foreach ($stores as $s)
                                        <a href="{{ $s->link ?? '#' }}" target="_blank" class="bb-card"
                                            aria-hidden="true">
                                            <div class="bb-logo">
                                                <img src="{{ asset('storage/' . $s->logo) }}"
                                                    alt="{{ $s->name }}"
                                                    class="h-8 w-auto object-contain opacity-90">
                                            </div>
                                            <div class="bb-name">{{ $s->name }}</div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            {{-- ROW 2 → Right to Left --}}
                            <div class="bb-marquee group">
                                <div class="bb-track bb-right">
                                    @foreach ($stores as $s)
                                        <a href="{{ $s->link ?? '#' }}" target="_blank" class="bb-card">
                                            <div class="bb-logo">
                                                <img src="{{ asset('storage/' . $s->logo) }}"
                                                    alt="{{ $s->name }}"
                                                    class="h-8 w-auto object-contain opacity-90">
                                            </div>
                                            <div class="bb-name">{{ $s->name }}</div>
                                        </a>
                                    @endforeach

                                    {{-- duplicate --}}
                                    @foreach ($stores as $s)
                                        <a href="{{ $s->link ?? '#' }}" target="_blank" class="bb-card"
                                            aria-hidden="true">
                                            <div class="bb-logo">
                                                <img src="{{ asset('storage/' . $s->logo) }}"
                                                    alt="{{ $s->name }}"
                                                    class="h-8 w-auto object-contain opacity-90">
                                            </div>
                                            <div class="bb-name">{{ $s->name }}</div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        <p class="text-xs text-gray-500 mt-4">
                            Don’t see a store? Paste any link — we’ll verify and handle it.
                        </p>

                    </div>
                </div>

                {{-- <div class="grid sm:grid-cols-2 mt-6 gap-4">

                    <div class="glass rounded-2xl p-4">
                        <div class="flex items-start gap-3">
                            <div
                                class="h-10 w-10 rounded-xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center">
                                <!-- Shield Check Icon -->
                                <svg class="h-5 w-5 text-yellow-300" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 2l7 4v6c0 5-3 9-7 10-4-1-7-5-7-10V6l7-4z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4" />
                                </svg>
                            </div>

                            <div>
                                <div class="font-bold text-white">Price checks, no surprises</div>
                                <div class="text-sm text-gray-400 mt-1">
                                    We confirm price, weight, and real shipping before you approve.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="glass rounded-2xl p-4">
                        <div class="flex items-start gap-3">
                            <div
                                class="h-10 w-10 rounded-xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center">
                                <!-- Lightbulb Icon -->
                                <svg class="h-5 w-5 text-yellow-300" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 18h6m-5 3h4m-7-9a7 7 0 1114 0c0 2.5-1.5 4-3 5.5-.8.8-1 1.5-1 2.5H10c0-1-.2-1.7-1-2.5C7.5 16 6 14.5 6 12z" />
                                </svg>
                            </div>

                            <div>
                                <div class="font-bold text-white">Recommendations that make sense</div>
                                <div class="text-sm text-gray-400 mt-1">
                                    We suggest stores and sellers that work best for Nepal.
                                </div>
                            </div>
                        </div>
                    </div>

                </div> --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 mt-6 gap-4">

                    {{-- Card 1 --}}
                    <div class="glass rounded-2xl p-4 sm:p-5">
                        <div class="flex items-start gap-3 sm:gap-4">
                            <div
                                class="shrink-0 h-11 w-11 sm:h-12 sm:w-12 rounded-xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center">
                                {{-- Shield Check --}}
                                <svg class="h-5 w-5 sm:h-6 sm:w-6 text-yellow-300" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.9">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3l7 4v5c0 5-3.5 8.5-7 9.8C8.5 20.5 5 17 5 12V7l7-4z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.5 12.5l1.7 1.7 3.8-4.2" />
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <div class="font-bold text-white text-sm sm:text-base leading-snug">
                                    Price checks, no surprises
                                </div>
                                <div class="text-sm text-gray-400 mt-1 leading-6">
                                    We confirm price, weight, and real shipping before you approve.
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Card 2 --}}
                    <div class="glass rounded-2xl p-4 sm:p-5">
                        <div class="flex items-start gap-3 sm:gap-4">
                            <div
                                class="shrink-0 h-11 w-11 sm:h-12 sm:w-12 rounded-xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center">
                                {{-- Better bulb / idea icon --}}
                                <svg class="h-5 w-5 sm:h-6 sm:w-6 text-yellow-300" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.9">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 18h6" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 21h4" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.2 14.5c-.8-.8-1.2-1.7-1.2-3a5 5 0 1110 0c0 1.3-.4 2.2-1.2 3-.7.7-1.2 1.4-1.4 2.5h-4.4c-.2-1.1-.7-1.8-1.4-2.5z" />
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <div class="font-bold text-white text-sm sm:text-base leading-snug">
                                    Recommendations that make sense
                                </div>
                                <div class="text-sm text-gray-400 mt-1 leading-6">
                                    We suggest stores and sellers that work best for Nepal.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



            </div>
    </section>

    @if ($hotProducts->count())
        <section class="py-20 relative bg-gradient-to-b from-black to-neutral-950">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 relative">

                {{-- Section Header --}}
                <div class="flex items-center justify-between mb-10">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                            🔥 Trending Products
                        </h2>
                        <p class="text-gray-400 mt-2">
                            Popular items currently shipping to Nepal.
                        </p>
                    </div>
                </div>

                {{-- Products Grid --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 items-stretch">

                    @foreach ($hotProducts as $product)
                        <div
                            class="group glass rounded-3xl p-4 sm:p-5 h-full flex flex-col transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(0,0,0,0.4)]">

                            {{-- Image (CDN SAFE aspect ratio) --}}
                            <div class="relative overflow-hidden rounded-2xl bg-darkcard ring-1 ring-white/5"
                                style="aspect-ratio: 4/3;">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-600">
                                        No Image
                                    </div>
                                @endif

                                {{-- Badge --}}
                                <div
                                    class="absolute top-3 left-3 text-xs px-3 py-1 rounded-full bg-gold text-darkbg font-bold shadow">
                                    Hot
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="mt-4 flex flex-col flex-1">

                                <h3 class="font-bold text-sm sm:text-lg leading-snug group-hover:text-gold transition"
                                    style="
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                    min-height: 2.5rem;
                                ">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-xs text-gray-500 mt-1" style="min-height: 1rem;">
                                    @if ($product->origin_country)
                                        Shipping from {{ $product->origin_country }}
                                    @else
                                        &nbsp;
                                    @endif
                                </p>

                                <div class="mt-3 text-gold font-extrabold text-base sm:text-lg"
                                    style="min-height: 1.5rem;">
                                    @if ($product->price)
                                        {{ $product->currency }} {{ number_format($product->price, 2) }}
                                    @else
                                        &nbsp;
                                    @endif
                                </div>

                                @if ($product->product_url)
                                    <a href="{{ $product->product_url }}" target="_blank"
                                        class="mt-auto inline-block w-full text-center btn-gold py-2 rounded-xl">
                                        View Product
                                    </a>
                                @endif
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    @endif




    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-14" x-data="reviewSlider()" x-init="init()">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="max-w-2xl">
                <div
                    class="inline-flex items-center rounded-full
            border border-gold/30 bg-gold/10
            px-4 md:px-5 py-1.5
            text-xs md:text-sm tracking-[0.25em] uppercase text-gold">
                    What Shoppers Say
                </div>
            </div>

            <div class="flex items-center gap-2 self-start sm:self-auto sm:ml-auto">
                <button type="button" @click="scrollLeft" :disabled="atStart"
                    class="h-10 w-10 sm:h-11 sm:w-11 rounded-2xl border border-white/10 bg-white/5 text-white
                   flex items-center justify-center transition
                   hover:bg-white/10 disabled:opacity-40 disabled:cursor-not-allowed shrink-0">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <button type="button" @click="scrollRight" :disabled="atEnd"
                    class="h-10 w-10 sm:h-11 sm:w-11 rounded-2xl border border-white/10 bg-white/5 text-white
                   flex items-center justify-center transition
                   hover:bg-white/10 disabled:opacity-40 disabled:cursor-not-allowed shrink-0">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="relative mt-8">
            <div
                class="pointer-events-none absolute inset-y-0 left-0 w-8 bg-gradient-to-r from-[#0b0f14] to-transparent z-10">
            </div>
            <div
                class="pointer-events-none absolute inset-y-0 right-0 w-8 bg-gradient-to-l from-[#0b0f14] to-transparent z-10">
            </div>

            <div x-ref="track" @scroll.debounce.50ms="updateButtons"
                class="flex gap-4 sm:gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory scroll-hidden pb-2">

                @foreach ($reviews ?? [] as $r)
                    <div class="snap-start shrink-0 w-full md:w-[calc((100%-1.5rem)/2)] lg:w-[calc((100%-3rem)/3)]">
                        <div class="glass rounded-3xl p-6 h-full min-h-[240px] flex flex-col">

                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-start gap-3 min-w-0">
                                    @if ($r->avatar)
                                        <img src="{{ Storage::url($r->avatar) }}" alt="{{ $r->name }}"
                                            class="h-10 w-10 rounded-full object-cover border border-white/10 shrink-0">
                                    @else
                                        <div
                                            class="h-10 w-10 rounded-full bg-gold/20 text-gold flex items-center justify-center font-bold border border-gold/30 shrink-0">
                                            {{ strtoupper(substr($r->name, 0, 1)) }}
                                        </div>
                                    @endif

                                    <div class="min-w-0">
                                        <div class="font-extrabold text-white leading-tight truncate">
                                            {{ $r->name }}
                                        </div>

                                        <div class="mt-1 sm:mt-0">
                                            <span
                                                class="inline-flex max-w-full items-center rounded-full border border-white/10 bg-white/5
                                            px-2.5 py-1 text-[11px] sm:text-xs text-gray-300 truncate">
                                                {{ $r->destination }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 flex items-center gap-1 text-gold text-sm">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= $r->stars ? '' : 'opacity-30' }}">★</span>
                                @endfor
                            </div>

                            <p class="mt-3 text-sm text-gray-300 leading-relaxed">
                                {{ $r->review }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Reviews --}}
    {{-- <section class="max-w-7xl mx-auto px-4 sm:px-6 py-14">

        <div class="flex items-end justify-between gap-6">
            <div class="max-w-2xl">

                <div
                    class="inline-flex items-center rounded-full
                border border-gold/30 bg-gold/10
                px-4 md:px-5 py-1.5
                text-xs md:text-sm tracking-[0.25em] uppercase text-gold">
                    What Shoppers Say
                </div>

            </div>
        </div>

        <div class="mt-8 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($reviews ?? [] as $r)
                <div class="glass rounded-3xl p-6">

                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-start gap-3 min-w-0">
                            @if ($r->avatar)
                                <img src="{{ Storage::url($r->avatar) }}" alt="{{ $r->name }}"
                                    class="h-10 w-10 rounded-full object-cover border border-white/10 shrink-0">
                            @else
                                <div
                                    class="h-10 w-10 rounded-full bg-gold/20 text-gold flex items-center justify-center font-bold border border-gold/30 shrink-0">
                                    {{ strtoupper(substr($r->name, 0, 1)) }}
                                </div>
                            @endif

                            <div class="min-w-0">
                                <div class="font-extrabold text-white leading-tight truncate">
                                    {{ $r->name }}
                                </div>

                                <div class="mt-1 sm:mt-0">
                                    <span
                                        class="inline-flex max-w-full items-center rounded-full border border-white/10 bg-white/5
                             px-2.5 py-1 text-[11px] sm:text-xs text-gray-300 truncate">
                                        {{ $r->destination }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 flex items-center gap-1 text-gold text-sm">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $r->stars ? '' : 'opacity-30' }}">★</span>
                        @endfor
                    </div>

                    <p class="mt-3 text-sm text-gray-300 leading-relaxed">
                        {{ $r->review }}
                    </p>
                </div>
            @endforeach
        </div>
    </section> --}}



    {{-- FAQ --}}
    <section id="faq" x-data="{ showAllFaqs: false }"
        class="max-w-7xl mx-auto px-4 sm:px-6 py-14 bg-gradient-to-b from-black to-neutral-950">

        <div class="max-w-2xl">
            <h2 class="text-2xl text-gold font-extrabold">FAQs</h2>
            <p class="text-gray-400 mt-2">Short and direct answers.</p>
        </div>

        @php
            $faqLimit = 4;
            $faqItems = collect($faqs ?? []);
            $initialFaqs = $faqItems->take($faqLimit);
            $remainingFaqs = $faqItems->slice($faqLimit);
        @endphp

        <div class="mt-8 grid lg:grid-cols-2 gap-6">

            {{-- First 4 FAQs --}}
            @foreach ($initialFaqs as $index => $f)
                <div class="glass rounded-3xl p-6">
                    <button type="button" onclick="toggleFAQ({{ $index }})"
                        class="w-full flex items-center justify-between text-left">

                        <span class="font-extrabold text-gold">
                            {{ $f->question }}
                        </span>

                        <svg id="arrow-{{ $index }}"
                            class="w-5 text-gold h-5 transition-transform duration-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>

                    </button>

                    <div id="answer-{{ $index }}" class="hidden text-sm text-gray-400 mt-4 leading-relaxed">
                        {{ $f->answer }}
                    </div>
                </div>
            @endforeach



            <template x-if="showAllFaqs">
                <div class="contents">

                    @foreach ($remainingFaqs as $index => $f)
                        @php $realIndex = $index + $faqLimit; @endphp

                        <div class="glass rounded-3xl p-6">
                            <button type="button" onclick="toggleFAQ({{ $realIndex }})"
                                class="w-full flex items-center justify-between text-left">

                                <span class="font-extrabold text-gold">
                                    {{ $f->question }}
                                </span>

                                <svg id="arrow-{{ $realIndex }}"
                                    class="w-5 h-5 text-gold transition-transform duration-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>

                            </button>

                            <div id="answer-{{ $realIndex }}"
                                class="hidden text-sm text-gray-400 mt-4 leading-relaxed">
                                {{ $f->answer }}
                            </div>
                        </div>
                    @endforeach

                </div>
            </template>

        </div>

        {{-- Show More Button --}}
        @if ($remainingFaqs->count() > 0)
            <div class="mt-8 flex justify-center">

                <button @click="showAllFaqs = !showAllFaqs"
                    class="px-6 py-3 rounded-xl border border-white/10 bg-white/5 text-white
                       hover:bg-white/10 transition">

                    <span x-show="!showAllFaqs">Show more FAQs</span>
                    <span x-show="showAllFaqs">Show less</span>

                </button>

            </div>
        @endif

    </section>


    <script>
        function toggleFAQ(index) {
            const answer = document.getElementById('answer-' + index);
            const arrow = document.getElementById('arrow-' + index);

            if (answer.classList.contains('hidden')) {
                answer.classList.remove('hidden');
                arrow.classList.add('rotate-180');
            } else {
                answer.classList.add('hidden');
                arrow.classList.remove('rotate-180');
            }
        }
    </script>

    {{-- CTA --}}
    <section id="estimate" class="max-w-7xl mx-auto px-4 sm:px-6 py-16 bg-gradient-to-b from-[#0f141a] to-[#0c1117]">
        <!-- Subtle background glows -->

        <div
            class="glass rounded-3xl p-8 sm:p-12 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
            <div class="max-w-2xl">
                <h2 class="text-2xl sm:text-3xl font-extrabold">Ready to import to Nepal?</h2>
                <p class="text-gray-400 mt-2">Get a clear estimate, place order, upload payment proof — done.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                <a href="/request-order" class="btn-gold px-6 py-3 rounded-2xl text-center w-full sm:w-auto">
                    Start Estimate →
                </a>
                @auth
                    <a href="{{ route('user.orders') }}"
                        class="border border-white/15 text-white px-6 py-3 rounded-2xl text-center hover:bg-white/5 transition w-full sm:w-auto">
                        Go to Dashboard
                    </a>
                @else
                    <a href="#"
                        class="border border-white/15 text-white px-6 py-3 rounded-2xl text-center hover:bg-white/5 transition w-full sm:w-auto">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- Footer --}}


</div>
