@section('og_title', $company?->meta_title ?? config('app.name'))

@section('og_description', \Illuminate\Support\Str::limit(strip_tags($company?->description ?? ''), 150))

@section('og_image', $company?->preview_image ? Storage::url($company->preview_image) : asset('default-event.jpg'))

@section('og_url', url()->current())
<div class="bg-darkbg text-white">

    {{-- Top Gradient Glow --}}
    <div class="pointer-events-none absolute inset-x-0 top-0 h-[520px]"
        style="background: radial-gradient(800px 420px at 50% 0%, rgba(214,177,94,.16), transparent 60%);">
    </div>

    {{-- Navbar --}}

    {{-- Hero --}}
    <section class="relative max-w-7xl mx-auto px-4 sm:px-6 pt-14 sm:pt-20 pb-12 sm:pb-20">
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div class="absolute -top-24 left-1/2 -translate-x-1/2 h-72 w-72 rounded-full bg-yellow-400/10 blur-3xl">
            </div>
            <div class="absolute -bottom-20 right-10 h-64 w-64 rounded-full bg-yellow-400/10 blur-3xl"></div>
        </div>
        <div class=" grid lg:grid-cols-12 gap-10 items-center">

            {{-- Left --}}
            <div class="lg:col-span-8">
                {{-- Badge row --}}
                <div class="flex flex-wrap items-center gap-3 mb-6">


                    <div class="hidden sm:flex items-center gap-5 text-xs text-gray-400">
                        <span class="inline-flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full" style="background: rgba(214,177,94,.9)"></span>
                            Clear breakdown
                        </span>
                        <span class="inline-flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full" style="background: rgba(214,177,94,.9)"></span>
                            Fast checkout
                        </span>
                        <span class="inline-flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full" style="background: rgba(214,177,94,.9)"></span>
                            Track orders
                        </span>
                    </div>
                </div>
                {{-- HERO TITLE --}}
                @if (!empty($company->hero_title))
                    <h1>
                        {!! $company->hero_title !!}
                    </h1>
                @else
                    <h1 class="text-4xl sm:text-5xl font-extrabold leading-[1.05] tracking-tight">
                        Place your order in
                        <span class="text-gold"> under 1 minute.</span>
                    </h1>
                @endif


                {{-- HERO DESCRIPTION --}}
                @if (!empty($company->hero_description))
                    <p>
                        {!! $company->hero_description !!}
                    </p>
                @else
                    <p class="mt-6 text-gray-300 sm:text-lg max-w-2xl">
                        Shop from Amazon, AliExpress, Myntra and more. We handle shipping & customs,
                        deliver to your doorstep in Nepal.
                    </p>
                @endif

                {{-- URL input --}}
                <div class="mt-8">
                    <div class="">
                        <form action="{{ route('request.order') }}" method="GET"
                            class="glass rounded-2xl p-3 sm:p-4 flex flex-col sm:flex-row gap-3 max-w-2xl">

                            <input type="url" name="product-url"
                                class="flex-1 bg-transparent outline-none text-white placeholder-gray-500 px-3 py-3 rounded-xl"
                                placeholder="Paste product URL here…" required>

                            <button type="submit" class="btn-gold px-6 py-3 rounded-xl whitespace-nowrap">
                                Create Order →
                            </button>

                        </form>
                    </div>

                    <div class="mt-3 text-xs text-gray-500">
                        Supports: Amazon, AliExpress, Myntra, eBay, UK/USA stores & more.
                    </div>
                </div>



            </div>
            <div class="hidden lg:block lg:col-span-4">
                <div class="glass rounded-3xl p-6 border border-white/10">
                    <div class="text-sm text-gray-400">Today’s quick flow</div>
                    <div class="mt-4 space-y-3 text-sm">
                        <div class="flex items-center gap-3">
                            <span
                                class="h-7 w-7 rounded-xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center text-yellow-200 font-bold">1</span>
                            <span class="text-gray-200">Paste product link</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span
                                class="h-7 w-7 rounded-xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center text-yellow-200 font-bold">2</span>
                            <span class="text-gray-200">Get full landed cost</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span
                                class="h-7 w-7 rounded-xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center text-yellow-200 font-bold">3</span>
                            <span class="text-gray-200">Confirm & track delivery</span>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </section>



    <section id="why-borderless" class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
        <!-- Top -->
        <div class="max-w-3xl">
            <div
                class="inline-flex items-center gap-2 rounded-full border border-yellow-400/25 bg-yellow-400/10 px-3 py-1 text-xs tracking-[0.3em] uppercase text-yellow-200">
                Why BorderlessBazzar
            </div>

            <h2 class="mt-4 text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                Cross-border shopping made simple for Nepal
            </h2>

            <p class="mt-3 text-gray-300/90 leading-relaxed">
                Clear pricing, faster quotes, and end-to-end visibility — from product link to delivery at your door.
            </p>
        </div>

        <!-- Cards -->
        <div class="mt-10 grid gap-6 lg:grid-cols-3">
            <!-- Card 1 -->
            <div
                class="rounded-3xl p-6 border border-white/10 bg-white/5 backdrop-blur-xl shadow-[0_0_0_1px_rgba(255,255,255,0.04)]">
                <div class="flex items-start gap-4">
                    <div
                        class="h-12 w-12 rounded-2xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center">
                        <!-- bolt icon -->
                        <svg class="h-6 w-6 text-yellow-300" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 2L3 14h7l-1 8 12-14h-7l1-6z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-lg font-extrabold text-white">Instant quote estimator</h3>
                        <p class="mt-2 text-sm text-gray-300/90 leading-relaxed">
                            Paste the product link, add weight/price — get a quick NPR estimate in seconds.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div
                class="rounded-3xl p-6 border border-white/10 bg-white/5 backdrop-blur-xl shadow-[0_0_0_1px_rgba(255,255,255,0.04)]">
                <div class="flex items-start gap-4">
                    <div
                        class="h-12 w-12 rounded-2xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center">
                        <!-- qr icon -->
                        <svg class="h-6 w-6 text-yellow-300" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4h6v6H4V4zm10 0h6v6h-6V4zM4 14h6v6H4v-6zm10 4h2m-2-4h6v6h-6v-6z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-lg font-extrabold text-white">Easy payment options</h3>
                        <p class="mt-2 text-sm text-gray-300/90 leading-relaxed">
                            Pay via eSewa/Khalti/bank transfer — with clear steps and confirmation updates.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div
                class="rounded-3xl p-6 border border-white/10 bg-white/5 backdrop-blur-xl shadow-[0_0_0_1px_rgba(255,255,255,0.04)]">
                <div class="flex items-start gap-4">
                    <div
                        class="h-12 w-12 rounded-2xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center">
                        <!-- receipt icon -->
                        <svg class="h-6 w-6 text-yellow-300" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 14h6m-6-4h6M7 3h10a2 2 0 012 2v16l-3-2-3 2-3-2-3 2V5a2 2 0 012-2z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-lg font-extrabold text-white">Transparent cost breakdown</h3>
                        <p class="mt-2 text-sm text-gray-300/90 leading-relaxed">
                            Duty, freight, service fees — everything itemized before you confirm the order.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div
                class="rounded-3xl p-6 border border-white/10 bg-white/5 backdrop-blur-xl shadow-[0_0_0_1px_rgba(255,255,255,0.04)]">
                <div class="flex items-start gap-4">
                    <div
                        class="h-12 w-12 rounded-2xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center">
                        <!-- shield icon -->
                        <svg class="h-6 w-6 text-yellow-300" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 2l7 4v6c0 5-3 9-7 10-4-1-7-5-7-10V6l7-4z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-lg font-extrabold text-white">Verified order handling</h3>
                        <p class="mt-2 text-sm text-gray-300/90 leading-relaxed">
                            We confirm product details and prevent surprises before it ships.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 5 -->
            <div
                class="rounded-3xl p-6 border border-white/10 bg-white/5 backdrop-blur-xl shadow-[0_0_0_1px_rgba(255,255,255,0.04)]">
                <div class="flex items-start gap-4">
                    <div
                        class="h-12 w-12 rounded-2xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center">
                        <!-- map pin icon -->
                        <svg class="h-6 w-6 text-yellow-300" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 21s7-4.5 7-11a7 7 0 10-14 0c0 6.5 7 11 7 11z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-lg font-extrabold text-white">Track progress end-to-end</h3>
                        <p class="mt-2 text-sm text-gray-300/90 leading-relaxed">
                            Quote → payment → shipment → delivery updates, all in one dashboard.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 6 -->
            <div
                class="rounded-3xl p-6 border border-white/10 bg-white/5 backdrop-blur-xl shadow-[0_0_0_1px_rgba(255,255,255,0.04)]">
                <div class="flex items-start gap-4">
                    <div
                        class="h-12 w-12 rounded-2xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center">
                        <!-- box icon -->
                        <svg class="h-6 w-6 text-yellow-300" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 8l-9 5-9-5m18 0l-9-5-9 5m18 0v10l-9 5-9-5V8" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-lg font-extrabold text-white">Special handling when needed</h3>
                        <p class="mt-2 text-sm text-gray-300/90 leading-relaxed">
                            Fragile or high-value items get extra checks, packing, and careful dispatch.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Trusted Stores (Auto Slider) --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-14">
        <div class=" gap-8 items-start">
            {{-- Left text --}}
            <div class="lg:col-span-5">
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-yellow-400/25 bg-yellow-400/10 px-3 py-1 text-xs tracking-[0.3em] uppercase text-yellow-200">
                    Trusted Stores
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
                        <img src="{{ asset('storage/' . $s->logo) }}" alt="{{ $s->name }}"
                            class="h-8 w-auto object-contain opacity-90">
                    </div>
                    <div class="bb-name">{{ $s->name }}</div>
                </a>
            @endforeach

            {{-- duplicate --}}
            @foreach ($stores as $s)
                <a href="{{ $s->link ?? '#' }}" target="_blank" class="bb-card" aria-hidden="true">
                    <div class="bb-logo">
                        <img src="{{ asset('storage/' . $s->logo) }}" alt="{{ $s->name }}"
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
                        <img src="{{ asset('storage/' . $s->logo) }}" alt="{{ $s->name }}"
                            class="h-8 w-auto object-contain opacity-90">
                    </div>
                    <div class="bb-name">{{ $s->name }}</div>
                </a>
            @endforeach

            {{-- duplicate --}}
            @foreach ($stores as $s)
                <a href="{{ $s->link ?? '#' }}" target="_blank" class="bb-card" aria-hidden="true">
                    <div class="bb-logo">
                        <img src="{{ asset('storage/' . $s->logo) }}" alt="{{ $s->name }}"
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

                <div class="grid sm:grid-cols-2 mt-6 gap-4">

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

                </div>



            </div>
    </section>

    {{-- How it works --}}
    <section id="how" class="max-w-7xl mx-auto px-4 sm:px-6 py-14">
        <div class="max-w-2xl">
            <div
                class="inline-flex items-center gap-2 rounded-full border border-yellow-400/25 bg-yellow-400/10 px-3 py-1 text-xs tracking-[0.3em] uppercase text-yellow-200">
                How it works
            </div>

            <p class="text-gray-400 mt-2">Three simple steps. No confusion, no hidden cost.</p>
        </div>

        <div class="mt-8 grid md:grid-cols-3 gap-6">
            <div class="glass rounded-3xl p-6">
                <div class="h-10 w-10 rounded-2xl flex items-center justify-center mb-4"
                    style="background: rgba(214,177,94,.12); border: 1px solid rgba(214,177,94,.25);">
                    <span class="text-gold font-black">1</span>
                </div>
                <div class="font-extrabold">Paste product link</div>
                <div class="text-sm text-gray-400 mt-2">Add name, price, weight & quantity. Get instant estimate.</div>
            </div>

            <div class="glass rounded-3xl p-6">
                <div class="h-10 w-10 rounded-2xl flex items-center justify-center mb-4"
                    style="background: rgba(214,177,94,.12); border: 1px solid rgba(214,177,94,.25);">
                    <span class="text-gold font-black">2</span>
                </div>
                <div class="font-extrabold">Pay with QR</div>
                <div class="text-sm text-gray-400 mt-2">Choose payment method and upload proof in checkout.</div>
            </div>

            <div class="glass rounded-3xl p-6">
                <div class="h-10 w-10 rounded-2xl flex items-center justify-center mb-4"
                    style="background: rgba(214,177,94,.12); border: 1px solid rgba(214,177,94,.25);">
                    <span class="text-gold font-black">3</span>
                </div>
                <div class="font-extrabold">Track delivery</div>
                <div class="text-sm text-gray-400 mt-2">See status updates: verified → shipping → delivered.</div>
            </div>
        </div>
    </section>

    {{-- Reviews --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-14">
        <div class="flex items-end justify-between gap-6">
            <div class="max-w-2xl">
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-yellow-400/25 bg-yellow-400/10 px-3 py-1 text-xs tracking-[0.3em] uppercase text-yellow-200">
                    What Shoppers Say
                </div>

                <p class="text-gray-400 mt-2">Real reviews from real cross-border shoppers.</p>
            </div>
        </div>

        <div class="mt-8 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($reviews ?? [] as $r)
                <div class="glass rounded-3xl p-6">
                    <div class="flex items-center justify-between">
                        <div class="font-extrabold">{{ $r->name }}</div>
                        <div class="text-xs text-gray-400">{{ $r->destination }}</div>
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
    </section>

    {{-- FAQ --}}
    <section id="faq" class="max-w-7xl mx-auto px-4 sm:px-6 py-14">
        <div class="max-w-2xl">
            <h2 class="text-2xl font-extrabold">FAQ</h2>
            <p class="text-gray-400 mt-2">Short and direct answers.</p>
        </div>

        <div class="mt-8 grid lg:grid-cols-2 gap-6">
            @foreach ($faqs ?? [] as $index => $f)
                <div class="glass rounded-3xl p-6">

                    <!-- Question -->
                    <button type="button" onclick="toggleFAQ({{ $index }})"
                        class="w-full flex items-center justify-between text-left">
                        <span class="font-extrabold">
                            {{ $f->question }}
                        </span>

                        <!-- Arrow -->
                        <svg id="arrow-{{ $index }}" class="w-5 h-5 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Answer -->
                    <div id="answer-{{ $index }}" class="hidden text-sm text-gray-400 mt-4 leading-relaxed">
                        {{ $f->answer }}
                    </div>

                </div>
            @endforeach
        </div>
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
    <section id="estimate" class="max-w-7xl mx-auto px-4 sm:px-6 py-16">
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
