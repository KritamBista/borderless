
@push('schema')
@include('seo.schema.breadcrumbs', [
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'Blogs', 'url' => route('blog.index')],
    ]
])

@endpush
<section class="py-16 md:py-24 bg-darkbg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <!-- Header + Search -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div class="text-center md:text-left">
                <div class="inline-flex items-center gap-2 rounded-full border border-gold/25 bg-gold/10 px-4 py-1.5 text-sm uppercase tracking-wider text-gold mb-4">
                    Knowledge Hub
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                    Blogs & Guides
                </h1>
                <p class="mt-4 text-lg text-gray-400 max-w-2xl">
                    Expert tips, shipping guides, import advice, and latest updates to shop smarter from Nepal.
                </p>
            </div>

            <!-- Search -->
            <div class="w-full md:w-80">
                <input
                    type="text"
                    wire:model.live.debounce.500ms="search"
                    placeholder="Search blogs..."
                    class="w-full px-5 py-3 rounded-xl bg-darkcard border border-white/10 text-white placeholder-gray-500 focus:border-gold/50 focus:ring-2 focus:ring-gold/20 transition"
                >
            </div>
        </div>

        <!-- Blog Grid -->
        @if ($blogs->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
                @foreach ($blogs as $blog)
                    <a href="{{ route('blog.show', $blog->slug) }}" class="group block h-full">
                        <div class="glass rounded-2xl overflow-hidden border border-white/5 hover:border-gold/30 transition-all duration-300 hover:shadow-2xl hover:shadow-gold/10 h-full flex flex-col">

                            {{-- Image (CDN SAFE aspect ratio) --}}
                            <div class="bg-darkcard ring-1 ring-white/5 overflow-hidden"
                                 style="aspect-ratio: 5/3;">
                                @if ($blog->featured_image)
                                    <img src="{{ asset('storage/' . $blog->featured_image) }}"
                                         alt="{{ $blog->title }}"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-600 text-sm">
                                        No Image
                                    </div>
                                @endif
                            </div>

                            <div class="p-6 md:p-7 flex flex-col flex-grow">
                                <div class="text-xs text-gold/80 uppercase tracking-wider mb-3">
                                    {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') : 'Not published yet' }}
                                </div>

                                {{-- Title (CDN SAFE clamp 2 lines) --}}
                                <h3 class="text-xl font-bold leading-tight mb-4 group-hover:text-gold transition-colors"
                                    style="
                                        display: -webkit-box;
                                        -webkit-line-clamp: 2;
                                        -webkit-box-orient: vertical;
                                        overflow: hidden;
                                        min-height: 3rem;
                                    ">
                                    {{ $blog->title }}
                                </h3>

                                <div class="flex items-center text-gold text-sm font-medium mt-auto">
                                    Read More
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
                {{ $blogs->links() }}
            </div>
        @else
            <div class="text-center py-20 text-gray-500">
                No blogs found matching your search. Try something else!
            </div>
        @endif

    </div>
</section>
