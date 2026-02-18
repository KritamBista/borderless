<div>

    {{-- Navbar --}}
    <div class="border-b border-white/10 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div class="flex items-center gap-3">
                @if($company?->logo)
                    <img src="{{ asset('storage/'.$company->logo) }}" class="h-8">
                @endif
                <span class="font-bold text-lg">{{ $company?->name ?? 'Borderless Bazzar' }}</span>
            </div>

            <div class="flex gap-8 items-center">
                <a href="#" class="text-gray-400 hover:text-white">About</a>
                <a href="#" class="text-gray-400 hover:text-white">How it Works</a>

                <a href="#" class="text-gray-400 hover:text-white">FAQ</a>
                <a href="#" class="text-gray-400 hover:text-white">Contact</a>

                <a href="#" class="btn-gold px-4 py-2 rounded-xl">Login / Register</a>
            </div>

        </div>
    </div>

    {{-- Hero Section --}}
    <section class="max-w-7xl mx-auto px-6 py-24 text-center relative">

        {{-- <div class="mb-6 text-sm text-gray-400">
            Trusted by <span class="text-gold font-semibold">200K+</span> shoppers
        </div> --}}

                    <div class="flex flex-wrap items-center justify-center gap-3 mb-6">
                <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs card-glass">
                    <span class="h-2 w-2 rounded-full" style="background: rgba(84, 214, 130, .9)"></span>
                    Trusted by 200K+ shoppers
                </span>

                <div class="flex items-center gap-5 text-xs text-muted">
                    <span class="inline-flex items-center gap-2">
                        <span class="h-1.5 w-1.5 rounded-full" style="background: rgba(214,177,94,.9)"></span>
                        Clear Breakdown
                    </span>
                    <span class="inline-flex items-center gap-2">
                        <span class="h-1.5 w-1.5 rounded-full" style="background: rgba(214,177,94,.9)"></span>
                        Pay in NPR or USD
                    </span>
                    <span class="inline-flex items-center gap-2">
                        <span class="h-1.5 w-1.5 rounded-full" style="background: rgba(214,177,94,.9)"></span>
                        Track Orders
                    </span>
                </div>
            </div>



            {{-- hero description --}}


        <h1 class="text-5xl font-extrabold leading-tight">
            {{ $company?->hero_title ?? 'Place your order in' }}
            <span class="text-gold"> under 1 minute.</span>
        </h1>

        {{-- <p class="mt-6 text-gray-400 max-w-2xl mx-auto">
            {{ $company?->hero_description ?? 'Shop worldwide. We handle customs, shipping and delivery to Nepal.' }}
        </p> --}}

           <p class="mt-6 sm:text-lg  max-w-2xl mx-auto">
                {{ $company?->hero_description ?? 'Shop from Amazon, eBay, and 100+ stores worldwide. We handle customs, shipping, and delivery to your doorstep.' }}
            </p>
        <div class="mt-10 flex justify-center">
            <div class="glass rounded-2xl p-4 flex gap-3 w-full max-w-xl">
                <input type="text"
                       placeholder="Paste product URL here..."
                       class="flex-1 bg-transparent outline-none text-white placeholder-gray-500">

                <button class="btn-gold px-6 py-3 rounded-xl">
                    Create Order →
                </button>
            </div>
        </div>

    </section>

</div>
