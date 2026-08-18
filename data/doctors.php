<?php
// Centralized doctor records. Replace static arrays with MySQL queries later.

return [
    [
        'slug'           => 'dr-anurag-khandelwal',
        'name'           => 'Dr. Anurag Khandelwal',
        'qualification'  => 'BDS',
        'specialization' => 'Implantologist & Laser Dentistry',
        'experience'     => '10+ Years',
        'image'          => 'doctor_anurag',
        'short_bio'      => 'Implantologist and laser dentist with advanced training in single-sitting root canal treatment.',
        'education'      => [
            'BDS — Bharati Vidyapeeth Dental College, Pune',
            'Residency — Sir Ganga Ram Hospital, New Delhi',
            'Advanced training in root canal treatment',
        ],
        'interests'      => ['Dental implants', 'Laser dentistry', 'Single-sitting RCT'],
        'locations'      => ['dwarka', 'gurgaon'],
        'treatments'     => ['dental-implants-dwarka', 'laser-dentistry', 'emergency-dentist-dwarka'],
    ],
    [
        'slug'           => 'dr-aishwarya-khandelwal',
        'name'           => 'Dr. Aishwarya Khandelwal',
        'qualification'  => 'MDS',
        'specialization' => 'Periodontist & Oral Implantologist',
        'experience'     => '8+ Years',
        'image'          => 'doctor_aishwarya',
        'short_bio'      => 'Periodontist and oral implantologist with a special interest in cosmetic and laser dentistry.',
        'education'      => [
            'BDS — Bharati Vidyapeeth Dental College, Pune',
            'MDS — D.Y. Patil School of Dentistry, Mumbai',
        ],
        'interests'      => ['Gum treatment', 'Cosmetic dentistry', 'Laser dentistry'],
        'locations'      => ['dwarka', 'gurgaon'],
        'treatments'     => ['gum-treatment-periodontist', 'smile-makeover-cosmetic-dentistry', 'laser-dentistry'],
    ],
    [
        'slug'           => 'dr-ankita-sawant',
        'name'           => 'Dr. Ankita Sawant Sheoran',
        'qualification'  => 'MDS',
        'specialization' => 'Orthodontist',
        'experience'     => '[CONTENT TO BE PROVIDED]',
        'image'          => 'doctor_ankita',
        'short_bio'      => '[CONTENT TO BE PROVIDED]',
        'education'      => ['[CONTENT TO BE PROVIDED]'],
        'interests'      => [],
        'locations'      => ['dwarka'],
        'treatments'     => ['braces-orthodontic-treatment-dwarka', 'invisalign-clear-aligners-dwarka'],
    ],
];
