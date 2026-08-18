<?php
// Shared footer + closing markup. Call render_footer() at the bottom of every page.

function render_footer(array $opts = []): void {
    $treatments = treatments();
    $locs = locations();
    $popularTreatments = array_slice(array_keys($treatments), 0, 8);
    ?>
    <footer class="site-footer">
      <div class="container container--wide">
        <div class="footer-grid">
          <div class="footer-brand">
            <a class="brand" href="<?= url('') ?>"><span class="brand-mark"><?= icon('tooth') ?></span><span style="color:#fff">Vital <b style="color:var(--teal-300)">Dental Care</b></span></a>
            <p>Specialist-led dental care across Dwarka and Gurgaon, combining advanced technology, experienced doctors and a patient-first approach.</p>
            <div class="flex gap-3 mt-5">
              <a href="<?= telLink() ?>" class="btn btn--light btn--sm"><?= icon('phone') ?> Call</a>
              <a href="<?= whatsappLink() ?>" class="btn btn--whatsapp btn--sm" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp</a>
            </div>
          </div>
          <div>
            <h4>Treatments</h4>
            <ul class="footer-links">
              <?php foreach ($popularTreatments as $slug): $t = $treatments[$slug]; ?>
              <li><a href="<?= url($t['slug']) ?>"><?= e($t['name']) ?></a></li>
              <?php endforeach; ?>
              <li><a href="<?= url('dental-treatment-cost-delhi') ?>">Treatment Costs</a></li>
            </ul>
          </div>
          <div>
            <h4>Locations</h4>
            <ul class="footer-links">
              <?php foreach ($locs as $loc): ?>
              <li><a href="<?= url($loc['slug']) ?>"><?= e($loc['name']) ?></a></li>
              <?php endforeach; ?>
              <li><a href="<?= url('our-team') ?>">Our Doctors</a></li>
              <li><a href="<?= url('smile-gallery') ?>">Smile Gallery</a></li>
              <li><a href="<?= url('membership-plan') ?>">Membership Plan</a></li>
              <li><a href="<?= url('blog') ?>">Blog</a></li>
            </ul>
          </div>
          <div>
            <h4>Contact</h4>
            <ul class="footer-contact">
              <li><?= icon('phone') ?><span><a href="<?= telLink() ?>"><?= e(PRIMARY_PHONE) ?></a><br><a href="<?= telLink(SECONDARY_PHONE_TEL) ?>"><?= e(SECONDARY_PHONE) ?></a></span></li>
              <li><?= icon('whatsapp') ?><span><a href="<?= whatsappLink() ?>" target="_blank" rel="noopener">WhatsApp Chat</a></span></li>
              <li><?= icon('pin') ?><span><?= e($locs['dwarka']['address']) ?></span></li>
              <li><?= icon('clock') ?><span><?= e(HOURS) ?></span></li>
            </ul>
          </div>
        </div>
        <div class="footer-bottom">
          <span>&copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>. All rights reserved.</span>
          <div class="legal">
            <a href="<?= url('privacy-policy') ?>">Privacy</a>
            <a href="<?= url('terms-and-conditions') ?>">Terms</a>
            <a href="<?= url('cookie-policy') ?>">Cookies</a>
            <a href="<?= url('disclaimer') ?>">Disclaimer</a>
          </div>
        </div>
      </div>
    </footer>

    <nav class="sticky-cta" aria-label="Quick actions">
      <a href="<?= telLink() ?>" class="sc-item sc-call"><?= icon('phone') ?> Call</a>
      <a href="<?= whatsappLink() ?>" class="sc-item sc-wa" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp</a>
      <a href="<?= url('book-appointment') ?>" class="sc-item sc-book">Book</a>
    </nav>

    <?php if (!empty($opts['schemas'])): ?>
      <?php emit_schema(...$opts['schemas']); ?>
    <?php endif; ?>
</body>
</html>
<?php
}
