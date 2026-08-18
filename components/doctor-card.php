<?php
// Doctor card component.

function render_doctor_card(array $d): void {
    ?>
<a class="card doctor-card reveal" href="<?= url('our-team/' . $d['slug']) ?>">
  <div class="dc-img"><img src="<?= e(imageData($d['image'])) ?>" alt="<?= e($d['name']) ?>" width="400" height="500" loading="lazy"></div>
  <h3><?= e($d['name']) ?></h3>
  <div class="dc-spec"><?= e($d['specialization']) ?></div>
  <div class="dc-meta">
    <span><?= icon('shield') ?> <?= e($d['qualification']) ?></span>
    <span><?= icon('clock') ?> <?= e($d['experience']) ?></span>
  </div>
  <p class="dc-bio"><?= e($d['short_bio']) ?></p>
  <span class="tc-link">View profile <?= icon('arrow') ?></span>
</a>
<?php
}
