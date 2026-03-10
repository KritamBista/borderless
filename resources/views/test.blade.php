
<section class="relative w-full mx-auto  px-6    lg:px-8   pt-14 sm:pt-20 pb-12 sm:pb-20 animate-fadeUp">

        <div class="absolute inset-0 pointer-events-none  select-none overflow-hidden">

            <img src="{{ asset('world.svg') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover object-center
               opacity-[0.4] scale-100" />

            <div class="absolute inset-0 opacity-50"
                style="background: radial-gradient(circle at 55% 42%, rgba(214,177,94,.18), transparent 60%);">
            </div>


            <div class="absolute top-0 left-0 right-0 h-28 sm:h-32"
                style="background: linear-gradient(to bottom, rgba(11,15,20,0.98), rgba(11,15,20,0));">
            </div>

            <div class="absolute inset-0"
                style="background: radial-gradient(circle at 50% 45%, rgba(11,15,20,.10) 0%, rgba(11,15,20,.55) 65%, rgba(11,15,20,.85) 100%);">
            </div>
        </div>
        <div class=" max-w-7xl mx-auto grid lg:grid-cols-12 gap-12 items-center  " style="position: relative; z-index: 100;">

            {{-- Left --}}
            <div class="lg:col-span-8">
                {{-- Badge row --}}
                <div class="flex flex-wrap items-center gap-3 mb-6 ">


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

                <h1 class="text-4xl sm:text-5xl font-extrabold leading-[1.05] tracking-tight">
                    Place your order in
                    <span class="text-gold"> under 1 minute.</span>
                </h1>
                {{-- @endif --}}



                <p class="mt-6 text-gray-300 sm:text-lg max-w-2xl">
                    Shop from Amazon, AliExpress, Myntra and more. We handle shipping & customs,
                    deliver to your doorstep in Nepal.
                </p>
                {{-- @endif --}}

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
