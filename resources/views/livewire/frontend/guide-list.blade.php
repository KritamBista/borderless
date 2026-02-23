<section class="py-16 md:py-24 bg-darkbg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <!-- Header + Filters -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div class="text-center md:text-left">
                <div class="inline-flex items-center gap-2 rounded-full border border-gold/25 bg-gold/10 px-4 py-1.5 text-sm uppercase tracking-wider text-gold mb-4">
                    Step-by-Step Guides
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                    Guides & How-Tos
                </h1>
                <p class="mt-4 text-lg text-gray-400 max-w-2xl">
                    Detailed walkthroughs on cross-border shopping, customs clearance, duties, and getting your orders delivered safely to Nepal.
                </p>
            </div>

            <div class="w-full md:w-auto flex flex-col sm:flex-row gap-4">
                <!-- Search -->
                <input
                    type="text"
                    wire:model.live.debounce.500ms="search"
                    placeholder="Search guides..."
                    class="w-full sm:w-64 px-5 py-3 rounded-xl bg-darkcard border border-white/10 text-white placeholder-gray-500 focus:border-gold/50 focus:ring-2 focus:ring-gold/20 transition"
                >

                <!-- Category Filter (if categories exist) -->
                @if ($categories->isNotEmpty())
                    <select
                        wire:model.live="category"
                        class="w-full sm:w-48 px-4 py-3 rounded-xl bg-darkcard border border-white/10 text-white focus:border-gold/50 focus:ring-2 focus:ring-gold/20 transition"
                    >
                        <option value="">All Categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
        </div>

        <!-- Guides Grid -->
        @if ($guides->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($guides as $guide)
                    <a href="{{ route('guide.show', $guide->slug) }}" class="group block">
                        <div class="glass rounded-2xl overflow-hidden border border-white/5 hover:border-gold/30 transition-all duration-300 hover:shadow-2xl hover:shadow-gold/10 h-full flex flex-col">
                            @if ($guide->featured_image)
                                <div class="aspect-[5/3] overflow-hidden">
                                    <img src="{{ asset('storage/' . $guide->featured_image) }}"
                                         alt="{{ $guide->title }}"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                            @endif

                            <div class="p-6 md:p-7 flex flex-col flex-grow">
                                <!-- Category Badge (if exists) -->
                                @if ($guide->category)
                                    <div class="inline-block px-3 py-1 rounded-full bg-gold/10 border border-gold/20 text-gold text-xs uppercase tracking-wider mb-3">
                                        {{ $guide->category }}
                                    </div>
                                @endif

                                <div class="text-xs text-gold/80 uppercase tracking-wider mb-3">
                                    {{ $guide->published_at?->format('M d, Y') }}
                                </div>

                                <h3 class="text-xl font-bold leading-tight mb-4 group-hover:text-gold transition-colors line-clamp-2">
                                    {{ $guide->title }}
                                </h3>

                                <p class="text-gray-400 text-sm leading-relaxed mb-6 flex-grow line-clamp-3">
                                    {!! Str::words(strip_tags($guide->content), 35) !!}
                                </p>

                                <div class="flex items-center text-gold text-sm font-medium mt-auto">
                                    Read Guide
                                    <svg class="ml-2 w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $guides->links() }}
            </div>
        @else
            <div class="text-center py-20 text-gray-500">
                No guides found. Try adjusting your search or category!
            </div>
        @endif

    </div>
</section>
