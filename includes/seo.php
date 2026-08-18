<?php
// Reusable SEO helper. Call setSEO() before rendering <head>.

$GLOBALS['seo'] = [
    'title'       => SITE_NAME . ' · Advanced Dentistry in Dwarka & Gurgaon',
    'description' => 'Specialist dental care across Dwarka and Gurgaon, combining advanced technology, experienced doctors and a patient-first approach.',
    'canonical'   => SITE_URL . '/',
    'image'       => SITE_URL . DEFAULT_OG_IMAGE,
    'type'        => 'website',
    'og'          => true,
    'twitter'     => true,
    'extra'       => [],
];

function setSEO(array $opts): void {
    foreach (['title','description','canonical','image','type'] as $k) {
        if (isset($opts[$k])) $GLOBALS['seo'][$k] = $opts[$k];
    }
    if (isset($opts['og'])) $GLOBALS['seo']['og'] = (bool)$opts['og'];
    if (isset($opts['twitter'])) $GLOBALS['seo']['twitter'] = (bool)$opts['twitter'];
    if (isset($opts['extra'])) $GLOBALS['seo']['extra'] = array_merge($GLOBALS['seo']['extra'], (array)$opts['extra']);
}

function seo(): array { return $GLOBALS['seo']; }

function seo_title(): string { return e(seo()['title']); }
function seo_description(): string { return e(seo()['description']); }
function seo_canonical(): string { return e(seo()['canonical']); }
function seo_image(): string { return e(seo()['image']); }
