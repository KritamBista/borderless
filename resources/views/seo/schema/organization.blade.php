@php
    use Illuminate\Support\Str;

    $company = $company ?? null;

    $logoUrl = null;
    if (!empty($company?->logo)) {
        $logoUrl = Str::startsWith($company->logo, ['http://', 'https://'])
            ? $company->logo
            : asset('storage/' . ltrim($company->logo, '/'));
    }

    $organization = array_filter(
        [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $company?->name ?: config('app.name', 'BorderlessBazzar'),
            'url' => url('/'),
            'logo' => $logoUrl,
            'description' => $company?->meta_description ? trim(strip_tags($company->meta_description)) : null,
            'email' => $company?->contact_email ?: null,
            'sameAs' => array_values(
                array_filter([
                    $company?->facebook_url ?: null,
                    $company?->instagram_url ?: null,
                    $company?->linkedin_url ?: null,
                    $company?->youtube_url ?: null,
                ]),
            ),
            'contactPoint' => !empty($company?->contact_phone)
                ? [
                    '@type' => 'ContactPoint',
                    'contactType' => 'customer support',
                    'telephone' => $company->contact_phone,
                    'availableLanguage' => ['English', 'Nepali'],
                    'areaServed' => 'NP',
                ]
                : null,
            'address' => !empty($company?->address)
                ? [
                    '@type' => 'PostalAddress',
                    'streetAddress' => trim(strip_tags($company->address)),
                    'addressCountry' => 'NP',
                ]
                : null,
        ],
        fn($value) => !is_null($value) && $value !== '' && $value !== [],
    );
@endphp

@if (!empty($organization['name']))
    <script type="application/ld+json">
{!! json_encode($organization, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif
