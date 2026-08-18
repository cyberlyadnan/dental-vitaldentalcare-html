<?php
// Shared <head> + modern luxury clean header markup.
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/seo.php';
require_once __DIR__ . '/schema.php';
require_once __DIR__ . '/breadcrumbs.php';

function render_header(array $opts = []): void {
    $bodyClass = $opts['body_class'] ?? '';
    $schemas = $opts['schemas'] ?? [];
    $seo = seo();
    ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title><?= seo_title() ?></title>
<meta name="description" content="<?= seo_description() ?>">
<link rel="canonical" href="<?= seo_canonical() ?>">
<meta name="theme-color" content="#07193a">
<link rel="icon" href="<?= e(imageData('favicon')) ?>" type="image/svg+xml">
<link rel="apple-touch-icon" href="<?= e(imageData('favicon')) ?>">

<?php if ($seo['og']): ?>
<meta property="og:title" content="<?= e($seo['title']) ?>">
<meta property="og:description" content="<?= e($seo['description']) ?>">
<meta property="og:type" content="<?= e($seo['type']) ?>">
<meta property="og:url" content="<?= seo_canonical() ?>">
<meta property="og:image" content="<?= seo_image() ?>">
<meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
<?php endif; ?>
<?php if ($seo['twitter']): ?>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($seo['title']) ?>">
<meta name="twitter:description" content="<?= e($seo['description']) ?>">
<meta name="twitter:image" content="<?= seo_image() ?>">
<?php endif; ?>
<?php foreach ($seo['extra'] as $tag) echo $tag, "\n"; ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= assets('css/global.css') ?>">
<script src="<?= assets('js/app.js') ?>" defer></script>
</head>
<body class="<?= e($bodyClass) ?>">
<!-- <a href="#main" class="skip-link">Skip to content</a> -->

<!-- CLEAN TOP ANNOUNCEMENT STRIP -->
<div class="top-bar" id="topBar">
  <div class="container container--wide">
    <div class="top-bar-inner">
      <div class="tb-left">
        <span class="tb-status"><span class="pulse-dot"></span> Open Today 9 AM – 9 PM</span>
        <span class="tb-sep">•</span>
        <span class="tb-loc"><?= icon('pin') ?> Dwarka &amp; Gurgaon</span>
      </div>
      <div class="tb-right">
        <span class="tb-rating"><span class="star-gold">★</span> 4.9/5 (500+ Reviews)</span>
        <span class="tb-sep">•</span>
        <a href="<?= telLink() ?>" class="tb-link"><?= icon('phone') ?> <?= e(PRIMARY_PHONE) ?></a>
      </div>
    </div>
  </div>
</div>

<!-- SLEEK MODERN NAVBAR -->
<header class="site-header" id="siteHeader">
  <div class="container container--wide">
    <nav class="nav" aria-label="Primary Navigation">
      <!-- BRAND LOGO -->
      <a class="brand" href="<?= url('') ?>" aria-label="<?= e(SITE_NAME) ?> home">
        <span class="brand-mark"><?= icon('tooth') ?></span>
        <span class="brand-name">Vital <b>Dental Care</b></span>
      </a>

      <!-- CONCISE CLEAN NAV LINKS -->
      <ul class="nav-links">
        <li><a href="<?= url('#treatments') ?>" class="nav-link">Treatments</a></li>
        <li><a href="<?= url('#locations') ?>" class="nav-link">Locations</a></li>
        <li><a href="<?= url('our-team') ?>" class="nav-link">Doctors</a></li>
        <li><a href="<?= url('smile-gallery') ?>" class="nav-link">Gallery</a></li>
        <li><a href="<?= url('dental-treatment-cost-delhi') ?>" class="nav-link">Pricing</a></li>
        <li><a href="<?= url('about-us') ?>" class="nav-link">About</a></li>
        <li><a href="<?= url('patient-reviews') ?>" class="nav-link">Reviews</a></li>
      </ul>

      <!-- ICON-BASED CLEAN ACTIONS -->
      <div class="nav-actions">
        <!-- Call Icon Button -->
        <a href="<?= telLink() ?>" class="action-icon-btn action-icon-btn--phone" title="Call <?= e(PRIMARY_PHONE) ?>" aria-label="Call <?= e(PRIMARY_PHONE) ?>">
          <?= icon('phone') ?>
        </a>

        <!-- WhatsApp Icon Button -->
        <a href="<?= whatsappLink() ?>" class="action-icon-btn action-icon-btn--wa" target="_blank" rel="noopener" title="Chat on WhatsApp" aria-label="WhatsApp">
          <?= icon('whatsapp') ?>
        </a>

        <!-- High-Contrast Book Appointment Button -->
        <a href="<?= url('book-appointment') ?>" class="btn btn--accent btn--sm btn--book">
          <span>Book Visit</span> <?= icon('arrow') ?>
        </a>

        <!-- Mobile Toggle Button -->
        <button class="nav-toggle" aria-label="Open menu" aria-expanded="false" id="navToggle">
          <span class="nt-bar"></span>
          <span class="nt-bar"></span>
          <span class="nt-bar"></span>
        </button>
      </div>
    </nav>
  </div>
</header>

<!-- SLIDE-IN MOBILE DRAWER (SIDEBAR) -->
<div class="mobile-nav" id="mobileNav" aria-hidden="true">
  <div class="mn-head">
    <a class="brand" href="<?= url('') ?>">
      <span class="brand-mark"><?= icon('tooth') ?></span>
      <span class="brand-name">Vital <b>Dental Care</b></span>
    </a>
    <button class="nav-toggle mn-close" aria-label="Close menu" id="navClose"><?= icon('close') ?></button>
  </div>
  
  <div class="mn-top-cta">
    <div class="mn-status-pill">
      <span class="pulse-dot"></span> Open Today 9 AM – 9 PM · Dwarka &amp; Gurgaon
    </div>
    <a href="<?= url('book-appointment') ?>" class="btn btn--accent btn--block mn-book-btn">
      <?= icon('check') ?> <span>Book Appointment Online</span> <?= icon('arrow') ?>
    </a>
  </div>

  <div class="mn-body">
    <div class="mn-links">
      <a href="<?= url('') ?>" class="mn-item"><?= icon('smile') ?> <span>Home</span></a>
      <a href="<?= url('#treatments') ?>" class="mn-item"><?= icon('laser') ?> <span>Treatments</span></a>
      <a href="<?= url('#locations') ?>" class="mn-item"><?= icon('pin') ?> <span>Clinic Locations</span></a>
      <a href="<?= url('our-team') ?>" class="mn-item"><?= icon('user-check') ?> <span>Our Specialist Doctors</span></a>
      <a href="<?= url('smile-gallery') ?>" class="mn-item"><?= icon('sparkles') ?> <span>Patient Results Gallery</span></a>
      <a href="<?= url('dental-treatment-cost-delhi') ?>" class="mn-item"><?= icon('shield') ?> <span>Treatment Costs &amp; Pricing</span></a>
      <a href="<?= url('about-us') ?>" class="mn-item"><?= icon('tooth') ?> <span>About Us</span></a>
      <a href="<?= url('patient-reviews') ?>" class="mn-item"><?= icon('star') ?> <span>Patient Reviews</span></a>
      <a href="<?= url('membership-plan') ?>" class="mn-item"><?= icon('award') ?> <span>Membership Plan</span></a>
      <a href="<?= url('contact') ?>" class="mn-item"><?= icon('phone') ?> <span>Contact &amp; Clinic Hours</span></a>
    </div>
  </div>

  <div class="mn-actions">
    <a href="<?= telLink() ?>" class="btn btn--ghost"><?= icon('phone') ?> Call Us</a>
    <a href="<?= whatsappLink() ?>" class="btn btn--whatsapp" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp</a>
  </div>
</div>
<?php
}
