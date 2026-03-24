@push('schema')
    @include('seo.schema.breadcrumbs', [
        'breadcrumbs' => [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Blogs', 'url' => route('blog.index')],
            ['name' => $blog->title, 'url' => route('blog.show', $blog->slug)],
        ],
    ])

    @include('seo.schema.article', [
        'blog' => $blog,
        'company' => $company,
    ])
@endpush
@php
    use Illuminate\Support\Str;

    $seoTitle = $blog->meta_title ?: $blog->title . ' | ' . ($company?->name ?? config('app.name'));

    $seoDescription =
        $blog->meta_description ?: ($blog->excerpt ?: Str::limit(trim(strip_tags($blog->content)), 155, ''));

    $seoImage = $blog->featured_image
        ? asset('storage/' . ltrim($blog->featured_image, '/'))
        : (!empty($company?->preview_image)
            ? asset('storage/' . ltrim($company->preview_image, '/'))
            : asset('default-og.jpg'));

    $seoUrl = route('blog.show', $blog->slug);
@endphp
@section('title', $seoTitle)
@section('meta_title', $seoTitle)
@section('meta_description', $seoDescription)
@section('meta_keywords', $company?->meta_keywords ?? '')
@section('og_title', $seoTitle)
@section('og_description', $seoDescription)
@section('og_image', $seoImage)
@section('og_url', $seoUrl)
@section('canonical', $seoUrl)
@section('twitter_title', $seoTitle)
@section('twitter_description', $seoDescription)
@section('twitter_image', $seoImage)
<section>
    <article class="py-16 md:py-24 bg-darkbg">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">

            <!-- Back Link -->
            <div class="mb-10">
                <a href="{{ route('blog.index') }}"
                    class="inline-flex items-center text-gray-400 hover:text-gold transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Blogs
                </a>
            </div>

            <!-- Header -->
            <header class="text-center mb-16">
                <div class="text-sm text-gold/70 uppercase tracking-wider mb-4">
                    {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') : 'Not published yet' }}

                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                    {{ $blog->title }}
                </h1>

            </header>

            <!-- Featured Image -->
            @if ($blog->featured_image)
                <div class="rounded-2xl overflow-hidden border border-white/5 shadow-2xl mb-16">
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}"
                        class="w-full h-auto">
                </div>
            @endif

            <!-- RichEditor Content -->
            <div class="blog-content text-gray-300 leading-relaxed space-y-6">
                {!! $blog->content !!}
            </div>

        </div>
    </article>

    <!-- CTA Section -->
    <section class="py-16 border-t border-white/10 bg-darkbg/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <h2 class="text-3xl font-bold mb-6">Ready to Shop Smarter?</h2>
            <a href="/"
                class="btn-gold px-8 py-4 rounded-xl text-lg font-bold inline-block hover:shadow-gold/30 transition">
                Create Your Order Now →
            </a>
        </div>
    </section>

</section>
