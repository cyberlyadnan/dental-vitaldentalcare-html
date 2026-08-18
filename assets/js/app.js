// Vital Dental Care — vanilla JS interactions
(function () {
  'use strict';

  // Sticky header state
  var header = document.querySelector('.site-header');
  var onScroll = function () {
    if (!header) return;
    if (window.scrollY > 12) header.classList.add('is-scrolled');
    else header.classList.remove('is-scrolled');
  };
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // Mobile nav
  var toggle = document.querySelector('.nav-toggle');
  var mobileNav = document.querySelector('.mobile-nav');
  var closeBtn = document.querySelector('.mobile-nav .mn-close');
  function openNav() { if (mobileNav) { mobileNav.classList.add('is-open'); mobileNav.setAttribute('aria-hidden', 'false'); document.body.style.overflow = 'hidden'; if (toggle) toggle.setAttribute('aria-expanded', 'true'); } }
  function closeNav() { if (mobileNav) { mobileNav.classList.remove('is-open'); mobileNav.setAttribute('aria-hidden', 'true'); document.body.style.overflow = ''; if (toggle) toggle.setAttribute('aria-expanded', 'false'); } }
  if (toggle) toggle.addEventListener('click', openNav);
  if (closeBtn) closeBtn.addEventListener('click', closeNav);
  if (mobileNav) mobileNav.querySelectorAll('a').forEach(function (a) { a.addEventListener('click', closeNav); });

  // FAQ accordion
  document.querySelectorAll('.faq-item').forEach(function (item) {
    var q = item.querySelector('.faq-q');
    var a = item.querySelector('.faq-a');
    if (!q || !a) return;
    q.setAttribute('aria-expanded', 'false');
    q.addEventListener('click', function () {
      var open = item.classList.toggle('is-open');
      q.setAttribute('aria-expanded', open ? 'true' : 'false');
      a.style.maxHeight = open ? a.scrollHeight + 'px' : '0px';
    });
  });

  // Reveal on scroll
  var reveals = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window && reveals.length) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); } });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    reveals.forEach(function (el) { io.observe(el); });
  } else {
    reveals.forEach(function (el) { el.classList.add('is-in'); });
  }

  // Counter animation for trust bar
  document.querySelectorAll('[data-count]').forEach(function (el) {
    var target = parseFloat(el.getAttribute('data-count'));
    var suffix = el.getAttribute('data-suffix') || '';
    var started = false;
    var run = function () {
      if (started) return; started = true;
      var t0 = performance.now(), dur = 1400;
      var step = function (now) {
        var p = Math.min(1, (now - t0) / dur);
        var eased = 1 - Math.pow(1 - p, 3);
        el.textContent = (target * eased).toFixed(target % 1 === 0 ? 0 : 1) + suffix;
        if (p < 1) requestAnimationFrame(step);
        else el.textContent = target + suffix;
      };
      requestAnimationFrame(step);
    };
    if ('IntersectionObserver' in window) {
      var ob = new IntersectionObserver(function (en) { if (en[0].isIntersecting) { run(); ob.disconnect(); } }, { threshold: 0.5 });
      ob.observe(el);
    } else run();
  });

  // Appointment / contact form — frontend validation + success state
  document.querySelectorAll('form[data-form="appointment"], form[data-form="contact"]').forEach(function (form) {
    form.addEventListener('submit', function (ev) {
      ev.preventDefault();
      var valid = true;
      form.querySelectorAll('[required]').forEach(function (field) {
        var wrap = field.closest('.field');
        if (!wrap) return;
        if (!field.value.trim() || (field.type === 'tel' && !/^[+\d][\d\s\-]{7,}$/.test(field.value.trim()))) {
          wrap.classList.add('has-error'); valid = false;
        } else { wrap.classList.remove('has-error'); }
      });
      var status = form.querySelector('.form-status');
      if (!valid) { if (status) { status.className = 'form-status is-error'; status.innerHTML = 'Please check the highlighted fields.'; } return; }
      var btn = form.querySelector('[type="submit"]');
      if (btn) { btn.disabled = true; btn.dataset.label = btn.textContent; btn.textContent = 'Sending…'; }
      // Phase 1: frontend-only success state
      setTimeout(function () {
        if (status) { status.className = 'form-status is-success'; status.innerHTML = 'Thank you — your request has been received. Our team will call you shortly to confirm.'; }
        form.reset();
        if (btn) { btn.disabled = false; btn.textContent = btn.dataset.label; }
      }, 700);
    });
    form.querySelectorAll('input,select,textarea').forEach(function (f) {
      f.addEventListener('input', function () { var w = f.closest('.field'); if (w) w.classList.remove('has-error'); });
    });
  });

  // Before/after slider (mobile swipe + desktop drag)
  document.querySelectorAll('.ba-slider').forEach(function (slider) {
    var after = slider.querySelector('.ba-after');
    var handle = slider.querySelector('.ba-handle');
    if (!after || !handle) return;
    function setPos(pct) { pct = Math.max(0, Math.min(100, pct)); after.style.clipPath = 'inset(0 0 0 ' + pct + '%)'; handle.style.left = pct + '%'; }
    var dragging = false;
    function move(clientX) { var r = slider.getBoundingClientRect(); setPos(((clientX - r.left) / r.width) * 100); }
    slider.addEventListener('pointerdown', function (e) { dragging = true; move(e.clientX); });
    window.addEventListener('pointermove', function (e) { if (dragging) move(e.clientX); });
    window.addEventListener('pointerup', function () { dragging = false; });
    setPos(50);
  });
})();
