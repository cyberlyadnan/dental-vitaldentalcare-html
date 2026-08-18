<?php
// FAQ section component. Renders visual accordion + optional FAQPage schema.

function render_faq(array $faqs, bool $withSchema = false): void {
    ?>
<div class="faq-list reveal">
  <?php foreach ($faqs as $f): ?>
  <div class="faq-item">
    <button class="faq-q" type="button" aria-expanded="false">
      <span><?= e($f['question']) ?></span>
      <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    </button>
    <div class="faq-a"><div class="faq-a-inner"><?= e($f['answer']) ?></div></div>
  </div>
  <?php endforeach; ?>
</div>
<?php
    if ($withSchema) {
        emit_schema(schema_faq($faqs));
    }
}
