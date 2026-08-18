<?php
// Core helpers shared across the site.

require_once __DIR__ . '/config.php';

function base_path(): string {
    static $base = null;
    if ($base !== null) return $base;

    $scriptName = $_SERVER['SCRIPT_NAME'] ?? ($_SERVER['PHP_SELF'] ?? '');
    if (!empty($scriptName)) {
        $dir = str_replace('\\', '/', dirname($scriptName));
        $base = rtrim($dir, '/');
        if ($base === '.' || $base === '/') {
            $base = '';
        }
    } else {
        $base = '';
    }
    return $base;
}

function assets(string $path): string {
    $base = base_path();
    return ($base !== '' ? $base : '') . '/assets/' . ltrim($path, '/') . '?v=' . rawurlencode(ASSET_VERSION);
}

function url(string $path = ''): string {
    $base = base_path();
    $p = ltrim($path, '/');
    if ($p === '') {
        return ($base !== '' ? $base : '') . '/';
    }
    if ($p[0] === '#') {
        return ($base !== '' ? $base : '') . '/' . $p;
    }
    return ($base !== '' ? $base : '') . '/' . $p;
}

function e($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function imageData(string $key): string {
    static $map = null;
    if ($map === null) { $map = require __DIR__ . '/../data/images.php'; }
    $path = $map[$key] ?? ($map['og_default'] ?? '/assets/images/og/og-default.svg');
    $base = base_path();
    if ($base !== '' && strpos($path, '/assets/') === 0) {
        return $base . $path;
    }
    return $path;
}

function doctors(): array {
    static $data = null;
    if ($data === null) { $data = require __DIR__ . '/../data/doctors.php'; }
    return $data;
}

function getDoctor(string $slug): ?array {
    foreach (doctors() as $d) { if ($d['slug'] === $slug) return $d; }
    return null;
}

function treatments(): array {
    static $data = null;
    if ($data === null) { $data = require __DIR__ . '/../data/treatments.php'; }
    return $data;
}

function getTreatment(string $slug): ?array {
    $treatments = treatments();
    return $treatments[$slug] ?? null;
}

function locations(): array {
    static $data = null;
    if ($data === null) { $data = require __DIR__ . '/../data/locations.php'; }
    return $data;
}

function getLocation(string $slug): ?array {
    $locs = locations();
    if (isset($locs[$slug])) return $locs[$slug];
    foreach ($locs as $loc) { if (($loc['slug'] ?? '') === $slug) return $loc; }
    return null;
}

function testimonials(): array {
    static $data = null;
    if ($data === null) { $data = require __DIR__ . '/../data/testimonials.php'; }
    return $data;
}

function faqs(): array {
    static $data = null;
    if ($data === null) { $data = require __DIR__ . '/../data/faqs.php'; }
    return $data;
}

// WhatsApp link with optional contextual message
function whatsappLink(string $message = ''): string {
    $msg = $message !== '' ? $message : 'Hi Vital Dental Care, I would like to book an appointment.';
    return 'https://wa.me/' . WHATSAPP_NUMBER . '?text=' . rawurlencode($msg);
}

function telLink(string $tel = PRIMARY_PHONE_TEL): string {
    return 'tel:' . preg_replace('/\s+/', '', $tel);
}

// Render inline SVG icon by key
function icon(string $name, string $class = 'icon'): string {
    $icons = [
        'phone'   => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
        'whatsapp'=> '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38a9.9 9.9 0 0 0 4.79 1.22c5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm5.8 14.06c-.24.68-1.42 1.31-1.95 1.38-.5.07-1.13.1-1.82-.11-.42-.13-.96-.31-1.65-.61-2.9-1.25-4.8-4.17-4.94-4.37-.15-.2-1.18-1.57-1.18-3 0-1.43.75-2.13 1.02-2.42.27-.29.59-.36.79-.36.2 0 .39 0 .56.01.18.01.42-.07.66.5.24.59.82 2.03.89 2.18.07.15.12.32.02.52-.1.2-.15.32-.29.5-.15.18-.31.4-.44.54-.15.15-.3.31-.13.6.17.29.76 1.25 1.63 2.03 1.12 1 2.07 1.31 2.36 1.46.29.15.46.13.63-.08.17-.2.73-.85.92-1.14.2-.29.39-.24.66-.15.27.1 1.71.81 2 .96.29.15.49.22.56.34.07.12.07.71-.17 1.39z"/></svg>',
        'pin'     => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
        'clock'   => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
        'check'   => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>',
        'arrow'   => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>',
        'star'    => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
        'shield'  => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
        'laser'   => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M5 5l2 2M17 17l2 2M19 5l-2 2M7 17l-2 2"/></svg>',
        'tooth'   => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5.5c-1.5-1.5-3.5-2-5-2-2.5 0-4 2-4 5 0 2 .5 3 1 5 .4 1.6.6 3 1 5 .3 1.5 1 2.5 2 2.5s1.3-1.5 1.5-3c.2-1.5.5-3 1.5-3s1.3 1.5 1.5 3c.2 1.5.5 3 1.5 3s1.7-1 2-2.5c.4-2 .6-3.4 1-5 .5-2 1-3 1-5 0-3-1.5-5-4-5-1.5 0-3.5.5-5 2z"/></svg>',
        'implant' => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2c3 0 5 2 5 5 0 2-1 3-2 5l-1 3-1 4-1-4-1-3c-1-2-2-3-2-5 0-3 2-5 5-5z"/><path d="M9 14h6M9.5 17h5"/></svg>',
        'smile'   => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
        'sparkle' => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v18M3 12h18M5.5 5.5l13 13M18.5 5.5l-13 13"/></svg>',
        'child'   => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="6" r="3"/><path d="M9 22v-6l-2-2 1-5h8l1 5-2 2v6"/></svg>',
        'align'   => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18M3 12h18M3 18h18"/></svg>',
        'crown'   => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7l4 5 5-7 5 7 4-5v11H3z"/></svg>',
        'fill'    => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2c3 0 5 2 5 5 0 2-1 3-2 5l-1 3-1 4-1-4-1-3c-1-2-2-3-2-5 0-3 2-5 5-5z"/><circle cx="10" cy="7" r="1.2" fill="currentColor"/></svg>',
        'extract' => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2c3 0 5 2 5 5 0 2-1 3-2 5l-1 3-1 4-1-4-1-3c-1-2-2-3-2-5 0-3 2-5 5-5z"/><line x1="4" y1="4" x2="20" y2="20"/></svg>',
        'alert'   => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
        'camera'  => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>',
        'xray'    => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M8 7v10M12 7v10M16 7v10"/></svg>',
        'sterile' => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>',
        'menu'    => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>',
        'close'   => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>',
        'calendar'=> '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>',
        'sparkles'=> '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3L12 3z"/><path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/></svg>',
        'award'   => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>',
        'zap'     => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
        'chevron' => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>',
        'check-circle' => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
        'user-check'   => '<svg class="'.$class.'" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/></svg>',
    ];
    return $icons[$name] ?? '';
}

function renderStars(int $rating): string {
    $out = '<span class="stars" aria-label="' . $rating . ' out of 5 stars">';
    for ($i = 1; $i <= 5; $i++) {
        $out .= '<span class="star' . ($i <= $rating ? ' is-filled' : '') . '">' . icon('star') . '</span>';
    }
    return $out . '</span>';
}
