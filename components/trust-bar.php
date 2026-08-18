<?php
// Modern Luxury Trust Bar Component.

function render_trust_bar(): void {
    ?>
<section class="trust-section" id="trust">
  <div class="container container--wide">
    <div class="trust-grid reveal">
      <!-- Item 1: Rating (Gold / Amber) -->
      <div class="trust-card trust-card--gold">
        <div class="tc-top-accent"></div>
        <div class="tc-icon-wrap tc-icon-wrap--gold">
          <?= icon('star') ?>
        </div>
        <div class="tc-content">
          <div class="tc-num"><span data-count="4.9">4.9</span><span class="star-gold">★</span></div>
          <div class="tc-label">Google Rating</div>
          <div class="tc-desc">500+ Verified 5-Star Reviews</div>
        </div>
      </div>

      <!-- Item 2: Smiles (Cyan / Teal) -->
      <div class="trust-card trust-card--teal">
        <div class="tc-top-accent"></div>
        <div class="tc-icon-wrap tc-icon-wrap--teal">
          <?= icon('smile') ?>
        </div>
        <div class="tc-content">
          <div class="tc-num"><span data-count="10000" data-suffix="+">10,000+</span></div>
          <div class="tc-label">Happy Patients</div>
          <div class="tc-desc">Smiles transformed in Delhi NCR</div>
        </div>
      </div>

      <!-- Item 3: Experience (Royal Sapphire) -->
      <div class="trust-card trust-card--navy">
        <div class="tc-top-accent"></div>
        <div class="tc-icon-wrap tc-icon-wrap--navy">
          <?= icon('shield') ?>
        </div>
        <div class="tc-content">
          <div class="tc-num"><span data-count="15" data-suffix="+">15+</span></div>
          <div class="tc-label">Years of Trust</div>
          <div class="tc-desc">MDS specialist dental surgeons</div>
        </div>
      </div>

      <!-- Item 4: Sterilization (Emerald Green) -->
      <div class="trust-card trust-card--green">
        <div class="tc-top-accent"></div>
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

    <!-- Micro Assurance Grid / Strip -->
    <div class="trust-strip reveal reveal-delay-1">
      <div class="ts-item ts-item--teal">
        <span class="ts-icon-pill"><?= icon('pin') ?></span>
        <span class="ts-text">2 Modern Clinics <small>(Dwarka &amp; Gurgaon)</small></span>
      </div>
      <div class="ts-item ts-item--blue">
        <span class="ts-icon-pill"><?= icon('clock') ?></span>
        <span class="ts-text">Open 7 Days <small>(9 AM – 9 PM)</small></span>
      </div>
      <div class="ts-item ts-item--amber">
        <span class="ts-icon-pill"><?= icon('alert') ?></span>
        <span class="ts-text">Same-Day Emergency Slots</span>
      </div>
      <div class="ts-item ts-item--green">
        <span class="ts-icon-pill"><?= icon('shield') ?></span>
        <span class="ts-text">0% Interest EMI Available</span>
      </div>
    </div>
  </div>
</section>
<?php
}
