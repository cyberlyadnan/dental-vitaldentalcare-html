<?php
// Luxury Testimonial Card with Google Rating, Watermark Quotes, Verified Badge & Gradient Avatar.

function render_review_card(array $r): void {
    $name = $r['name'] ?? 'Verified Patient';
    $initials = '';
    foreach (explode(' ', $name) as $w) { if ($w !== '') $initials .= $w[0]; }
    $initials = strtoupper(substr($initials, 0, 2));
    if ($initials === '') $initials = 'VP';

    $treatment = $r['treatment'] ?? 'Dental Care';
    $location = $r['location'] ?? 'Dwarka / Gurgaon';
    $rating = $r['rating'] ?? 5;

    // Deterministic colorful avatar gradients based on name
    $avatarGradients = [
        'linear-gradient(135deg, #0284c7, #0369a1)',
        'linear-gradient(135deg, #10b981, #059669)',
        'linear-gradient(135deg, #7c3aed, #6d28d9)',
        'linear-gradient(135deg, #f59e0b, #d97706)',
        'linear-gradient(135deg, #e11d48, #be123c)',
        'linear-gradient(135deg, #0d9488, #0f766e)',
    ];
    $gradIndex = abs(crc32($name)) % count($avatarGradients);
    $avatarBg = $avatarGradients[$gradIndex];
    ?>
<div class="card review-card reveal">
  <div class="rc-quote-mark">“</div>
  
  <div class="rc-top-bar">
    <div class="rc-stars-box">
      <span class="rc-stars">★★★★★</span>
      <span class="rc-score"><?= number_format((float)$rating, 1) ?></span>
    </div>
    <span class="rc-verified-badge">
      <svg class="rc-google-g" width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg>
      Verified Review
    </span>
  </div>

  <p class="rc-text">"<?= e($r['review']) ?>"</p>

  <div class="rc-author">
    <div class="rc-avatar" style="background:<?= $avatarBg ?>"><?= e($initials) ?></div>
    <div class="rc-author-info">
      <h4 class="rc-name"><?= e($name) ?></h4>
      <div class="rc-meta-strip">
        <span class="rc-treatment-tag"><?= icon('check') ?> <?= e($treatment) ?></span>
        <span class="rc-loc-tag"><?= icon('pin') ?> <?= e($location) ?></span>
      </div>
    </div>
  </div>
</div>
<?php
}
