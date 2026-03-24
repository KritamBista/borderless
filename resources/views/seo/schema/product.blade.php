@php
    use Illuminate\Support\Str;

    $product = $product ?? null;

    $imageUrl = null;
    if (!empty($product?->image)) {
        $imageUrl = Str::startsWith($product->image, ['http://', 'https://'])
            ? $product->image
            : asset('storage/' . ltrim($product->image, '/'));
    }

    $schema = array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $product?->name ?: null,
        'url' => !empty($product?->product_url) ? $product->product_url : url()->current(),
        'description' => !empty($product?->description)
            ? trim(\Illuminate\Support\Str::limit(strip_tags($product->description), 500, ''))
            : null,
        'image' => $imageUrl ? [$imageUrl] : null,
        'sku' => !empty($product?->slug) ? $product->slug : null,
        'brand' => [
            '@type' => 'Brand',
            'name' => config('app.name', 'BorderlessBazzar'),
        ],
        'offers' => (isset($product?->price) && is_numeric($product->price)) ? array_filter([
            '@type' => 'Offer',
            'url' => !empty($product?->product_url) ? $product->product_url : url()->current(),
            'priceCurrency' => $product?->currency ?: 'NPR',
            'price' => number_format((float) $product->price, 2, '.', ''),
            'availability' => !empty($product?->is_active)
                ? 'https://schema.org/InStock'
                : 'https://schema.org/OutOfStock',
            'itemCondition' => 'https://schema.org/NewCondition',
        ]) : null,
    ], fn ($value) => !is_null($value) && $value !== '' && $value !== []);
@endphp

@if(!empty($product?->name))
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif
