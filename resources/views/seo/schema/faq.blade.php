@php
    $faqItems = $faqItems ?? [];

    $mainEntity = collect($faqItems)
        ->filter(fn ($faq) => !empty($faq['question']) && !empty($faq['answer']))
        ->values()
        ->map(function ($faq) {
            return [
                '@type' => 'Question',
                'name' => trim(strip_tags($faq['question'])),
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => trim(strip_tags($faq['answer'])),
                ],
            ];
        })
        ->all();

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $mainEntity,
    ];
@endphp

@if(!empty($mainEntity))
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif
