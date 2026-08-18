<?php
// Location card component.

function render_location_card(array $loc): void {
    ?>
<a class="card location-card reveal" href="<?= url($loc['slug']) ?>">
  <div class="lc-img"><img src="<?= e(imageData($loc['image'])) ?>" alt="<?= e(SITE_NAME) ?> — <?= e($loc['name']) ?> clinic" width="640" height="360" loading="lazy"></div>
  <div>
    <div class="lc-city"><?= e($loc['city']) ?></div>
    <h3><?= e($loc['name']) ?></h3>
  </div>
  <div class="lc-row"><?= icon('pin') ?><span><?= e($loc['address']) ?></span></div>
  <div class="lc-row"><?= icon('clock') ?><span><?= e($loc['hours']) ?></span></div>
  <div class="lc-row"><?= icon('phone') ?><span><?= e($loc['phone']) ?></span></div>
  <div class="lc-actions">
    <span class="btn btn--ghost btn--sm"><?= icon('pin') ?> Get Directions</span>
    <span class="btn btn--accent btn--sm">Explore Clinic <?= icon('arrow') ?></span>
  </div>
</a>
<?php
}
