<?php
// Reusable CTA / booking band component.

function render_cta(string $title = "Let's Take Care of Your Smile", string $sub = 'Book an appointment at our Dwarka or Gurgaon clinic — our team will confirm your slot over a quick call.'): void {
    ?>
<section class="section">
  <div class="container">
    <div class="cta-band reveal">
      <div style="max-width:640px">
        <span class="eyebrow" style="color:var(--teal-300)">Book your visit</span>
        <h2><?= e($title) ?></h2>
        <p class="lede"><?= e($sub) ?></p>
      </div>
      <div class="flex flex-wrap gap-3 mt-5">
        <a href="<?= url('book-appointment') ?>" class="btn btn--accent btn--lg"><?= icon('check') ?> Book Appointment</a>
        <a href="<?= telLink() ?>" class="btn btn--light btn--lg"><?= icon('phone') ?> <?= e(PRIMARY_PHONE) ?></a>
        <a href="<?= whatsappLink() ?>" class="btn btn--whatsapp btn--lg" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp</a>
      </div>
    </div>
  </div>
</section>
<?php
}

// Emergency banner variant
function render_emergency(): void {
    ?>
<section class="section--tight">
  <div class="container">
    <div class="emergency-band reveal">
      <span class="em-icon"><?= icon('alert') ?></span>
      <div style="flex:1;min-width:240px">
        <h2>Tooth Pain Today?</h2>
        <p>Call now to check same-day appointment availability.</p>
      </div>
      <div class="em-actions">
        <a href="<?= telLink() ?>" class="btn btn--lg"><?= icon('phone') ?> Call Now</a>
        <a href="<?= whatsappLink('Hi Vital Dental Care, I have a dental emergency and need help.') ?>" class="btn btn--whatsapp btn--lg" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp</a>
        <a href="<?= url('book-appointment') ?>" class="btn btn--accent btn--lg">Book</a>
      </div>
    </div>
  </div>
</section>
<?php
}
