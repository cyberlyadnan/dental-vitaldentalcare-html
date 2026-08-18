<?php
// Reusable appointment booking form component (frontend-only in Phase 1).

function render_booking_form(string $formType = 'appointment'): void {
    $treatments = treatments();
    $locs = locations();
    ?>
<form data-form="<?= e($formType) ?>" novalidate>
  <?php if ($formType === 'appointment'): ?>
  <div class="form-grid">
    <div class="field field--full">
      <label for="treatment">Treatment <span class="req">*</span></label>
      <select id="treatment" name="treatment" required>
        <option value="">Select a treatment</option>
        <?php foreach ($treatments as $t): ?>
        <option value="<?= e($t['slug']) ?>"><?= e($t['name']) ?></option>
        <?php endforeach; ?>
        <option value="other">Other / Not sure</option>
      </select>
      <div class="error-msg">Please choose a treatment.</div>
    </div>
    <div class="field">
      <label for="clinic">Preferred clinic <span class="req">*</span></label>
      <select id="clinic" name="clinic" required>
        <option value="">Select clinic</option>
        <?php foreach ($locs as $loc): ?>
        <option value="<?= e($loc['slug']) ?>"><?= e($loc['name']) ?> — <?= e($loc['city']) ?></option>
        <?php endforeach; ?>
      </select>
      <div class="error-msg">Please choose a clinic.</div>
    </div>
    <div class="field">
      <label for="date">Preferred date</label>
      <input type="date" id="date" name="date">
    </div>
    <div class="field">
      <label for="time">Preferred time</label>
      <select id="time" name="time">
        <option value="">Any time</option>
        <option>Morning (9 AM – 12 PM)</option>
        <option>Afternoon (12 PM – 4 PM)</option>
        <option>Evening (4 PM – 9 PM)</option>
      </select>
    </div>
  </div>
  <?php endif; ?>

  <div class="form-grid">
    <div class="field">
      <label for="name">Name <span class="req">*</span></label>
      <input type="text" id="name" name="name" autocomplete="name" required>
      <div class="error-msg">Please enter your name.</div>
    </div>
    <div class="field">
      <label for="phone">Phone <span class="req">*</span></label>
      <input type="tel" id="phone" name="phone" autocomplete="tel" placeholder="e.g. +91 98XXXXXXXX" required>
      <div class="error-msg">Please enter a valid phone number.</div>
    </div>
  </div>

  <button type="submit" class="btn btn--accent btn--lg btn--block mt-4"><?= icon('check') ?> Request Appointment</button>
  <div class="form-status" role="status" aria-live="polite"></div>
  <p style="font-size:var(--fs-xs);color:var(--text-muted);margin-top:12px">By submitting, you agree to be contacted by <?= e(SITE_NAME) ?> about your appointment. We respect your privacy.</p>
</form>
<?php
}
