<?php
// Luxury Specialist Doctor Card with Color Badges & Verified Accents.

function render_doctor_card(array $d): void {
    ?>
<a class="card doctor-card reveal" href="<?= url('our-team/' . $d['slug']) ?>">
  <div class="dc-img-wrapper">
    <div class="dc-img">
      <img src="<?= e(imageData($d['image'])) ?>" alt="<?= e($d['name']) ?>" width="400" height="500" loading="lazy">
    </div>
    <span class="dc-exp-badge"><?= icon('clock') ?> <?= e($d['experience']) ?></span>
  </div>
  
  <div class="dc-content">
    <div class="dc-header">
      <h3><?= e($d['name']) ?> <span class="dc-verified-icon" title="Verified Specialist"><?= icon('check-circle') ?></span></h3>
      <div class="dc-spec-badge"><?= e($d['specialization']) ?></div>
    </div>

    <div class="dc-meta-pills">
      <span class="dc-pill"><?= icon('shield') ?> <?= e($d['qualification']) ?></span>
      <span class="dc-pill"><?= icon('pin') ?> Dwarka &amp; Gurgaon</span>
    </div>

    <p class="dc-bio"><?= e($d['short_bio']) ?></p>

    <div class="dc-cta-row">
      <span class="btn btn--sm btn--accent dc-btn">View Doctor Profile <?= icon('arrow') ?></span>
    </div>
  </div>
</a>
<?php
}
