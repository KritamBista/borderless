@php
    use Illuminate\Support\Str;

    $blog = $blog ?? null;
    $company = $company ?? null;

    $imageUrl = null;
    if (!empty($blog?->featured_image)) {
        $imageUrl = asset('storage/' . ltrim($blog->featured_image, '/'));
    } elseif (!empty($company?->preview_image)) {
        $imageUrl = asset('storage/' . ltrim($company->preview_image, '/'));
    }

    $schema = array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $blog?->title ?: null,
        'description' => $blog?->meta_description
            ?: ($blog?->excerpt ?: Str::limit(trim(strip_tags($blog?->content ?? '')), 155, '')),
        'image' => $imageUrl ? [$imageUrl] : null,
        'datePublished' => !empty($blog?->published_at)
            ? \Carbon\Carbon::parse($blog->published_at)->toIso8601String()
            : null,
        'dateModified' => !empty($blog?->updated_at)
            ? \Carbon\Carbon::parse($blog->updated_at)->toIso8601String()
            : null,
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => route('blog.show', $blog->slug),
        ],
        'author' => [
            '@type' => 'Organization',
            'name' => $company?->name ?: config('app.name'),
        ],
        'publisher' => array_filter([
            '@type' => 'Organization',
            'name' => $company?->name ?: config('app.name'),
            'logo' => !empty($company?->logo)
                ? [
                    '@type' => 'ImageObject',
                    'url' => asset('storage/' . ltrim($company->logo, '/')),
                ]
                : null,
        ], fn ($value) => !is_null($value) && $value !== '' && $value !== []),
    ], fn ($value) => !is_null($value) && $value !== '' && $value !== []);
@endphp

@if(!empty($blog?->title))
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif
