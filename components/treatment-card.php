<?php
// Treatment card component.

function render_treatment_card(array $t): void {
    ?>
<a class="card treatment-card reveal" href="<?= url($t['slug']) ?>">
  <div class="tc-img"><img src="<?= e(imageData($t['image'])) ?>" alt="<?= e($t['name']) ?>" width="480" height="300" loading="lazy"></div>
  <span class="badge"><?= e($t['category']) ?></span>
  <h3><?= e($t['name']) ?></h3>
  <p><?= e($t['summary']) ?></p>
  <span class="tc-link">Learn more <?= icon('arrow') ?></span>
</a>
<?php
}
