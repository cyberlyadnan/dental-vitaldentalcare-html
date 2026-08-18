<?php
// JSON-LD structured data builders.

function schema_dentist(array $location = null): array {
    $base = [
        '@context'  => 'https://schema.org',
        '@type'     => 'Dentist',
        'name'      => SITE_NAME,
        'image'     => SITE_URL . DEFAULT_OG_IMAGE,
        'url'       => SITE_URL . '/',
        'telephone' => PRIMARY_PHONE_TEL,
        'email'     => EMAIL,
        'priceRange'=> '$$',
        'openingHoursSpecification' => [[
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'],
            'opens'     => '09:00',
            'closes'    => '21:00',
        ]],
    ];
    if ($location) {
        $base['name'] = SITE_NAME . ' — ' . $location['name'];
        $base['@id']  = SITE_URL . '/' . $location['slug'] . '/#dentist';
        $base['telephone'] = $location['phone_tel'];
        $base['address'] = [
            '@type'   => 'PostalAddress',
            'streetAddress' => $location['address'],
            'addressLocality' => $location['city'],
            'addressRegion'   => $location['city'] === 'Delhi' ? 'DL' : 'HR',
            'addressCountry'  => 'IN',
        ];
        $base['hasMap'] = $location['map_link'];
    } else {
        $base['department'] = array_map(function($loc){
            return [
                '@type' => 'Dentist',
                'name'  => SITE_NAME . ' — ' . $loc['name'],
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $loc['address'],
                    'addressLocality' => $loc['city'],
                    'addressCountry' => 'IN',
                ],
            ];
        }, array_values(locations()));
    }
    return $base;
}

function schema_organization(): array {
    return [
        '@context' => 'https://schema.org',
        '@type'    => 'Organization',
        'name'     => SITE_NAME,
        'url'      => SITE_URL . '/',
        'logo'     => SITE_URL . imageData('logo'),
        'telephone'=> PRIMARY_PHONE_TEL,
        'email'    => EMAIL,
        'sameAs'   => [
            'https://www.google.com/maps/search/Vital+Dental+Care',
        ],
    ];
}

function schema_breadcrumbs(array $crumbs): array {
    $items = [];
    foreach ($crumbs as $i => $c) {
        $items[] = [
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'name'     => $c['name'],
            'item'     => SITE_URL . $c['url'],
        ];
    }
    return [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    ];
}

function schema_person(array $doctor): array {
    $treatments = treatments();
    return [
        '@context'      => 'https://schema.org',
        '@type'         => 'Physician',
        'name'          => $doctor['name'],
        'image'         => SITE_URL . imageData($doctor['image']),
        'medicalSpecialty' => $doctor['specialization'],
        'qualification' => $doctor['qualification'],
        'url'           => SITE_URL . '/our-team/' . $doctor['slug'] . '/',
        'worksFor'      => ['@type' => 'Dentist', 'name' => SITE_NAME],
    ];
}

function schema_medicalprocedure(array $t): array {
    return [
        '@context'    => 'https://schema.org',
        '@type'       => 'MedicalProcedure',
        'name'        => $t['name'],
        'description' => $t['summary'],
        'url'         => SITE_URL . '/' . $t['slug'] . '/',
        'howPerformed'=> $t['procedure'] ?? '',
        'bodyLocation'=> 'Oral cavity',
    ];
}

function schema_faq(array $faqs): array {
    $entities = [];
    foreach ($faqs as $f) {
        $entities[] = [
            '@type'    => 'Question',
            'name'     => $f['question'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['answer']],
        ];
    }
    return [
        '@context' => 'https://schema.org',
        '@type'    => 'FAQPage',
        'mainEntity' => $entities,
    ];
}

function schema_aggregate_rating(array $reviews): array {
    $total = count($reviews);
    $sum = 0;
    foreach ($reviews as $r) $sum += $r['rating'];
    $avg = $total ? round($sum / $total, 1) : 5;
    return [
        '@context'       => 'https://schema.org',
        '@type'          => 'AggregateRating',
        'ratingValue'    => $avg,
        'reviewCount'    => $total,
        'bestRating'     => 5,
        'itemReviewed'   => ['@type' => 'Dentist', 'name' => SITE_NAME],
    ];
}

function emit_schema(array ...$graphs): void {
    $g = ['@context' => 'https://schema.org', '@graph' => $graphs];
    echo '<script type="application/ld+json">' . json_encode($g, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
