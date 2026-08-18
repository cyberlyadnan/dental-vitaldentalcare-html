<?php
// Testimonial card component.

function render_review_card(array $r): void {
    $initials = '';
    foreach (explode(' ', $r['name']) as $w) { if ($w !== '') $initials .= $w[0]; }
    $initials = strtoupper(substr($initials, 0, 2));
    ?>
<div class="card review-card reveal">
  <div class="rc-stars"><?= renderStars($r['rating']) ?></div>
  <p class="rc-text">"<?= e($r['review']) ?>"</p>
  <div class="rc-author">
    <span class="rc-avatar"><?= e($initials) ?></span>
    <span>
      <span class="rc-name"><?= e($r['name']) ?></span>
      <?php if (!empty($r['treatment'])): ?><br><span class="rc-treatment"><?= e($r['treatment']) ?></span><?php endif; ?>
    </span>
  </div>
</div>
<?php
}
