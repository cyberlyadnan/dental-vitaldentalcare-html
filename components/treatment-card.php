<?php
// Ultra-Luxury Treatment Card Component with Category Color Accents, Badges & Feature Chips.

function render_treatment_card(array $t): void {
    $category = $t['category'] ?? 'General';
    $catSlug = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $category));
    $badgeClass = 'badge--' . $catSlug;

    // Quick feature badges per treatment type
    $benefit1 = 'MDS Specialist';
    $benefit2 = 'Digital 3D Guided';
    if (!empty($t['technology'])) {
        $benefit1 = $t['technology'][0] ?? 'Advanced Tech';
        if (isset($t['technology'][1])) {
            $benefit2 = $t['technology'][1];
        }
    } elseif (!empty($t['quick_facts']['pain'])) {
        $benefit2 = 'Painless Method';
    }

    $visitsInfo = $t['quick_facts']['visits'] ?? 'Personalized Care';
    if (stripos($visitsInfo, 'single') !== false) {
        $speedPill = '⚡ Single Sitting';
    } elseif (stripos($t['name'], 'invisalign') !== false || stripos($t['name'], 'align') !== false) {
        $speedPill = '✨ Invisible Aligners';
    } elseif (stripos($t['name'], 'implant') !== false) {
        $speedPill = '🛡️ Lifetime Durable';
    } elseif (stripos($t['name'], 'whitening') !== false) {
        $speedPill = '⚡ Instant Results';
    } else {
        $speedPill = '★ High Precision';
    }
    ?>
<a class="card treatment-card treatment-card--<?= e($catSlug) ?> reveal" href="<?= url($t['slug']) ?>">
  <div class="tc-accent-bar"></div>
  
  <div class="tc-media">
    <div class="tc-img">
      <img src="<?= e(imageData($t['image'])) ?>" alt="<?= e($t['name']) ?>" width="480" height="300" loading="lazy">
    </div>
    <span class="badge <?= e($badgeClass) ?> tc-floating-badge"><?= e($category) ?></span>
    <span class="tc-speed-pill"><?= e($speedPill) ?></span>
  </div>

  <div class="tc-content">
    <div class="tc-header">
      <span class="tc-category-tag"><?= e($category) ?> Care</span>
      <h3 class="tc-title"><?= e($t['name']) ?></h3>
    </div>

    <p class="tc-desc"><?= e($t['summary']) ?></p>

    <div class="tc-features">
      <span class="tc-feat-chip"><?= icon('check') ?> <?= e($benefit1) ?></span>
      <span class="tc-feat-chip"><?= icon('shield') ?> <?= e($benefit2) ?></span>
    </div>

    <div class="tc-footer">
      <div class="tc-cta-bar">
        <span>Explore Treatment</span>
        <span class="tc-cta-arrow"><?= icon('arrow') ?></span>
      </div>
    </div>
  </div>
</a>
<?php
}
