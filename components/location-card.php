<?php
// Luxury Location Card with Vibrant City Header & Action Buttons.

function render_location_card(array $loc): void {
    $isDwarka = strpos($loc['slug'], 'dwarka') !== false;
    $themeClass = $isDwarka ? 'lc-theme--dwarka' : 'lc-theme--gurgaon';
    ?>
<div class="card location-card <?= e($themeClass) ?> reveal">
  <div class="lc-img-box">
    <img src="<?= e(imageData($loc['image'])) ?>" alt="<?= e(SITE_NAME) ?> — <?= e($loc['name']) ?> clinic" width="640" height="360" loading="lazy">
    <div class="lc-badge-top">
      <span class="pulse-dot"></span>
      <span>Open Today 9 AM – 9 PM</span>
    </div>
    <div class="lc-city-tag"><?= e($loc['city']) ?> CLINIC</div>
  </div>

  <div class="lc-body">
    <div class="lc-title-row">
      <h3><?= e($loc['name']) ?></h3>
      <span class="lc-rating-pill">★ 4.9 (Google)</span>
    </div>

    <div class="lc-info-stack">
      <div class="lc-info-item">
        <span class="lc-icon-capsule"><?= icon('pin') ?></span>
        <span><?= e($loc['address']) ?></span>
      </div>
      <div class="lc-info-item">
        <span class="lc-icon-capsule"><?= icon('clock') ?></span>
        <span><strong><?= e($loc['hours']) ?></strong> (All 7 Days)</span>
      </div>
      <div class="lc-info-item">
        <span class="lc-icon-capsule"><?= icon('phone') ?></span>
        <span><a href="<?= telLink($loc['phone_tel']) ?>" class="lc-tel-link"><?= e($loc['phone']) ?></a></span>
      </div>
    </div>

    <div class="lc-actions">
      <a href="<?= e($loc['map_link']) ?>" class="btn btn--ghost btn--sm" target="_blank" rel="noopener">
        <?= icon('pin') ?> <span>Directions</span>
      </a>
      <a href="<?= url($loc['slug']) ?>" class="btn btn--accent btn--sm">
        <span>Explore Clinic</span> <?= icon('arrow') ?>
      </a>
    </div>
  </div>
</div>
<?php
}
