@php
    $breadcrumbs = $breadcrumbs ?? [];

    $itemList = collect($breadcrumbs)
        ->filter(fn ($item) => !empty($item['name']) && !empty($item['url']))
        ->values()
        ->map(function ($item, $index) {
            return [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => trim(strip_tags($item['name'])),
                'item' => $item['url'],
            ];
        })
        ->all();

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $itemList,
    ];
@endphp

@if(!empty($itemList))
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif
