<?php
// Modern Luxury Trust Bar Component.

function render_trust_bar(): void {
    ?>
<section class="trust-section" id="trust">
  <div class="container container--wide">
    <div class="trust-grid reveal">
      <!-- Item 1: Rating -->
      <div class="trust-card">
        <div class="tc-icon-wrap tc-icon-wrap--gold">
          <?= icon('star') ?>
        </div>
        <div class="tc-content">
          <div class="tc-num"><span data-count="4.9">4.9</span><span class="star-gold">★</span></div>
          <div class="tc-label">Google Rating</div>
          <div class="tc-desc">500+ Verified 5-Star Reviews</div>
        </div>
      </div>

      <!-- Item 2: Smiles -->
      <div class="trust-card">
        <div class="tc-icon-wrap tc-icon-wrap--teal">
          <?= icon('smile') ?>
        </div>
        <div class="tc-content">
          <div class="tc-num"><span data-count="10000" data-suffix="+">10,000+</span></div>
          <div class="tc-label">Happy Patients</div>
          <div class="tc-desc">Smiles transformed in Delhi NCR</div>
        </div>
      </div>

      <!-- Item 3: Experience -->
      <div class="trust-card">
        <div class="tc-icon-wrap tc-icon-wrap--navy">
          <?= icon('shield') ?>
        </div>
        <div class="tc-content">
          <div class="tc-num"><span data-count="15" data-suffix="+">15+</span></div>
          <div class="tc-label">Years of Trust</div>
          <div class="tc-desc">MDS specialist dental surgeons</div>
        </div>
      </div>

      <!-- Item 4: Sterilization -->
      <div class="trust-card">
        <div class="tc-icon-wrap tc-icon-wrap--green">
          <?= icon('sterile') ?>
        </div>
        <div class="tc-content">
          <div class="tc-num"><span data-count="100" data-suffix="%">100%</span></div>
          <div class="tc-label">Sterilization</div>
          <div class="tc-desc">Class B autoclave hospital protocol</div>
        </div>
      </div>
    </div>

    <!-- Micro Assurance Strip -->
    <div class="trust-strip reveal reveal-delay-1">
      <span class="ts-item"><?= icon('check') ?> 2 Modern Clinic Locations</span>
      <span class="ts-dot" aria-hidden="true">•</span>
      <span class="ts-item"><?= icon('clock') ?> Open 7 Days (9 AM – 9 PM)</span>
      <span class="ts-dot" aria-hidden="true">•</span>
      <span class="ts-item"><?= icon('alert') ?> Same-Day Emergency Slots</span>
      <span class="ts-dot" aria-hidden="true">•</span>
      <span class="ts-item"><?= icon('shield') ?> 0% Interest EMI Available</span>
    </div>
  </div>
</section>
<?php
}
