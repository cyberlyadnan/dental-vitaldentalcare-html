<?php
// Luxury Testimonial Card with Google Rating, Verified Patient Badge & Author Avatar.

function render_review_card(array $r): void {
    $initials = '';
    foreach (explode(' ', $r['name']) as $w) { if ($w !== '') $initials .= $w[0]; }
    $initials = strtoupper(substr($initials, 0, 2));
    $treatment = $r['treatment'] ?? 'Dental Care';
    $location = $r['location'] ?? 'Dwarka / Gurgaon';
    ?>
<div class="card review-card reveal">
  <div class="rc-top-bar">
    <div class="rc-stars-box">
      <span class="rc-star">★</span>
      <span class="rc-star">★</span>
      <span class="rc-star">★</span>
      <span class="rc-star">★</span>
      <span class="rc-star">★</span>
      <span class="rc-score">5.0</span>
    </div>
    <span class="rc-verified-badge"><span class="rc-verified-dot"></span> Google Review</span>
  </div>

  <p class="rc-text">"<?= e($r['review']) ?>"</p>

  <div class="rc-author">
    <div class="rc-avatar"><?= e($initials) ?></div>
    <div class="rc-author-info">
      <h4 class="rc-name"><?= e($r['name']) ?></h4>
      <div class="rc-meta-strip">
        <span class="rc-treatment-tag"><?= e($treatment) ?></span>
        <span class="rc-loc-tag">• <?= e($location) ?></span>
      </div>
    </div>
  </div>
</div>
<?php
}
