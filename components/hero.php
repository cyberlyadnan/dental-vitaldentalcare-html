<?php
// Streamlined Clean Modern Hero Component for Vital Dental Care.

function render_hero(): void {
    ?>
<section class="hero" id="hero">
  <!-- Glowing Background Ambience Orbs -->
  <div class="hero-ambient hero-ambient--1" aria-hidden="true"></div>
  <div class="hero-ambient hero-ambient--2" aria-hidden="true"></div>

  <div class="container container--wide">
    <div class="hero-grid">
      <!-- LEFT CONTENT COLUMN -->
      <div class="hero-content reveal">
        <!-- Status Pill -->
        <div class="hero-badge">
          <span class="pulse-dot"></span>
          <span>Top-Rated MDS Dental Specialists · Dwarka &amp; Gurgaon</span>
        </div>

        <!-- Headline -->
        <h1 class="hero-title">
          World-Class Dentistry.<br>
          <span class="hero-gradient-text">Artistic Precision.</span> 
          <span class="hero-serif-accent">Confident Smiles.</span>
        </h1>

        <!-- Subtitle -->
        <p class="hero-lede">
          Specialist-led, pain-free dental care with advanced laser technology, single-sitting root canals, and precision dental implants across Delhi NCR.
        </p>

        <!-- Feature Chips -->
        <div class="hero-chips">
          <span class="h-chip"><?= icon('shield') ?> MDS Specialists</span>
          <span class="h-chip"><?= icon('laser') ?> Painless Laser</span>
          <span class="h-chip"><?= icon('sparkle') ?> Single-Sitting RCT</span>
          <span class="h-chip"><?= icon('check-circle') ?> 0% EMI</span>
        </div>

        <!-- CTA Buttons & Rating -->
        <div class="hero-actions">
          <a href="<?= url('book-appointment') ?>" class="btn btn--accent btn--shimmer hero-main-btn">
            <?= icon('check') ?> <span>Book Free Consultation</span> <?= icon('arrow') ?>
          </a>
          <div class="hero-sub-actions">
            <a href="<?= whatsappLink('Hi Vital Dental Care, I would like to book a consultation.') ?>" class="btn btn--whatsapp hero-sub-btn" target="_blank" rel="noopener">
              <?= icon('whatsapp') ?> <span>WhatsApp</span>
            </a>
            <a href="<?= telLink() ?>" class="btn btn--ghost hero-sub-btn hero-call-btn">
              <?= icon('phone') ?> <span>Call Clinic</span>
            </a>
          </div>
        </div>

        <!-- Social Proof Micro Strip -->
        <div class="hero-social-proof">
          <div class="hsp-stars">
            <span class="star-gold">★</span>
            <span class="star-gold">★</span>
            <span class="star-gold">★</span>
            <span class="star-gold">★</span>
            <span class="star-gold">★</span>
            <strong>4.9 / 5.0</strong>
          </div>
          <span class="hsp-sep">•</span>
          <div class="hsp-text">Over 500+ verified Google patient reviews</div>
        </div>
      </div>

      <!-- RIGHT VISUAL COLUMN (REAL DENTAL PHOTO) -->
      <div class="hero-visual reveal reveal-delay-2">
        <div class="hv-wrapper">
          <!-- Real Photo Frame -->
          <div class="hv-frame">
            <img src="<?= assets('images/hero/hero-main.jpg') ?>" alt="Vital Dental Care Dentist with Smiling Patient" width="640" height="480" fetchpriority="high">
            <div class="hv-overlay-gradient"></div>
          </div>

          <!-- Floating Badge 1: Next Slot -->
          <div class="hv-float hv-float--top float-anim">
            <span class="hv-float-icon hv-float-icon--green"><?= icon('calendar') ?></span>
            <div>
              <div class="hv-float-title"><span class="pulse-dot"></span> Next Available Slot</div>
              <div class="hv-float-sub">Today in 30 Mins · Instant Confirm</div>
            </div>
          </div>

          <!-- Floating Badge 2: Google Rating -->
          <div class="hv-float hv-float--bottom float-anim-reverse">
            <span class="hv-float-icon hv-float-icon--gold"><?= icon('star') ?></span>
            <div>
              <div class="hv-float-title">4.9★ Rated on Google</div>
              <div class="hv-float-sub">500+ Verified Patient Reviews</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- QUICK APPOINTMENT STRIP -->
    <div class="hero-quick-bar reveal reveal-delay-3">
      <div class="hqb-label">
        <span class="hqb-tag">QUICK APPOINTMENT</span>
        <strong>Check Slot Availability</strong>
      </div>
      <form class="hqb-form" action="<?= url('book-appointment') ?>" method="GET">
        <div class="hqb-field">
          <label for="hqb-treatment"><?= icon('tooth') ?> Treatment</label>
          <select id="hqb-treatment" name="treatment">
            <option value="">Select Treatment</option>
            <option value="dental-implants-dwarka">Dental Implants</option>
            <option value="root-canal-treatment-dwarka">Root Canal (RCT)</option>
            <option value="braces-orthodontic-treatment-dwarka">Braces &amp; Aligners</option>
            <option value="smile-makeover-cosmetic-dentistry">Smile Makeover</option>
            <option value="teeth-whitening">Teeth Whitening</option>
            <option value="scaling">Cleaning &amp; Scaling</option>
            <option value="emergency">Emergency / Tooth Pain</option>
          </select>
        </div>
        <div class="hqb-field">
          <label for="hqb-clinic"><?= icon('pin') ?> Clinic</label>
          <select id="hqb-clinic" name="clinic">
            <option value="dwarka">Dwarka Sector 6 (Delhi)</option>
            <option value="gurgaon">Gurgaon Sector 65 (M3M)</option>
          </select>
        </div>
        <button type="submit" class="btn btn--accent btn--shimmer hqb-submit">
          <span>Find Slots</span> <?= icon('arrow') ?>
        </button>
      </form>
    </div>
  </div>
</section>
<?php
}
