<?php
// Vital Dental Care — Main Router & Page Controller
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/footer.php';
require_once __DIR__ . '/components/hero.php';
require_once __DIR__ . '/components/trust-bar.php';
require_once __DIR__ . '/components/location-card.php';
require_once __DIR__ . '/components/treatment-card.php';
require_once __DIR__ . '/components/doctor-card.php';
require_once __DIR__ . '/components/testimonial-card.php';
require_once __DIR__ . '/components/cta.php';
require_once __DIR__ . '/components/faq.php';
require_once __DIR__ . '/components/contact-form.php';

// Resolve incoming route
$route = $_GET['route'] ?? '';
if ($route === '') {
    $requestUri = $_SERVER['REQUEST_URI'] ?? '';
    $path = trim(parse_url($requestUri, PHP_URL_PATH) ?? '', '/');
    $base = trim(base_path(), '/');
    if ($base !== '' && strpos($path, $base) === 0) {
        $path = trim(substr($path, strlen($base)), '/');
    }
    $route = $path;
}
$route = trim($route, '/');
if ($route === 'index.php') {
    $route = '';
}

// -------------------------------------------------------------
// 1. ROUTE: HOMEPAGE
// -------------------------------------------------------------
if ($route === '') {
    setSEO([
        'title'       => SITE_NAME . ' · Advanced Dentistry in Dwarka & Gurgaon',
        'description' => 'Specialist dental care across Dwarka and Gurgaon — dental implants, root canal, braces, Invisalign, smile makeover and laser dentistry. Book your appointment.',
        'canonical'   => SITE_URL . '/',
    ]);

    render_header([
        'schemas' => [
            schema_dentist(),
            schema_organization(),
            schema_faq(array_slice(faqs(), 0, 8)),
        ],
    ]);

    $allTreatments = treatments();
    $allDoctors    = doctors();
    $allLocations  = locations();
    $reviews       = array_slice(testimonials(), 0, 6);
    $homeFaqs      = array_slice(faqs(), 0, 8);
    ?>

    <main id="main">
    <?php
    render_hero();
    render_trust_bar();
    ?>

    <!-- WELCOME STORY & CLINIC INTRODUCTION -->
    <section class="section" id="about-intro">
      <div class="container">
        <div class="welcome-split">
          <div class="welcome-img-frame reveal">
            <img src="<?= e(imageData('clinic_welcome')) ?>" alt="Vital Dental Care Clinic Dwarka & Gurgaon" width="600" height="400" loading="lazy">
            <div class="welcome-badge-float">
              <?= icon('award') ?>
              <div>
                <div>10+ Years Excellence</div>
                <div style="font-size:0.7rem;font-weight:400;opacity:0.8">500+ Root Canals &amp; Implants</div>
              </div>
            </div>
          </div>
          <div class="welcome-text reveal reveal-delay-1">
            <span class="eyebrow">Welcome to Vital Dental Care</span>
            <h2>Top-Rated Dental Clinics in Dwarka Sector 6 &amp; Gurugram Sector 65</h2>
            <p class="lede" style="margin-bottom:var(--sp-4)">
              Our clinics are strategically located in <strong>Dwarka Sector 6 (Delhi)</strong> and <strong>M3M 65th Avenue (Gurgaon)</strong> with ample parking space and state-of-the-art dental operatories.
            </p>
            <p style="color:var(--text-soft);line-height:1.65;margin-bottom:var(--sp-5)">
              Led by Dr. Anurag Khandelwal and a highly qualified MDS specialist team, Vital Dental Care provides comprehensive general, cosmetic, and pediatric dentistry. We utilize high-resolution intraoral cameras, 3D digital imaging, and uncompromising European-grade materials to ensure every procedure is precise, comfortable, and pain-managed.
            </p>
            <div class="flex flex-wrap gap-3">
              <a href="<?= url('about-us') ?>" class="btn btn--ghost">Read Our Story <?= icon('arrow') ?></a>
              <a href="<?= url('book-appointment') ?>" class="btn btn--accent">Book a Consultation</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- LOCATIONS -->
    <section class="section section--alt" id="locations">
      <div class="container">
        <div class="section-head center reveal">
          <span class="eyebrow">Two convenient locations</span>
          <h2>Choose the clinic that works for you</h2>
          <p class="lede">Both clinics are open seven days a week, 9 AM to 9 PM, with specialist doctors and modern technology.</p>
        </div>
        <div class="grid grid-2">
          <?php foreach ($allLocations as $loc) render_location_card($loc); ?>
        </div>
      </div>
    </section>

    <!-- TREATMENTS -->
    <section class="section" id="treatments">
      <div class="container">
        <div class="section-head center reveal">
          <span class="eyebrow">Complete dental care</span>
          <h2>Complete Dental Care, Under One Roof</h2>
          <p class="lede">From preventive scaling to advanced restorative, orthodontic and implant dentistry.</p>
        </div>
        <div class="grid grid-3">
          <?php
          $count = 0;
          foreach ($allTreatments as $t):
            if ($count >= 9) break;
            render_treatment_card($t);
            $count++;
          endforeach;
          ?>
        </div>
        <div class="text-center mt-7">
          <a href="<?= url('dental-treatment-cost-delhi') ?>" class="btn btn--ghost btn--lg">View all treatments &amp; pricing <?= icon('arrow') ?></a>
        </div>
      </div>
    </section>

    <!-- IMPORTANCE OF SPECIALIZED DENTAL PROCEDURES -->
    <section class="section section--alt">
      <div class="container">
        <div class="section-head center reveal">
          <span class="eyebrow">Specialized Expertise</span>
          <h2>Why Specialist Care Matters</h2>
          <p class="lede">Advanced techniques and specialized training for lasting dental health.</p>
        </div>
        <div class="importance-grid">
          <div class="importance-card reveal">
            <div class="importance-card-img">
              <img src="<?= e(imageData('treatment_gum')) ?>" alt="Importance of Periodontics" loading="lazy">
            </div>
            <div class="importance-card-body">
              <h3>Importance of Periodontics</h3>
              <p>Gum health is the foundation of every healthy smile. Periodontics prevents chronic inflammation, bone loss, and systemic health complications through laser gum care and specialized scaling.</p>
            </div>
          </div>
          <div class="importance-card reveal reveal-delay-1">
            <div class="importance-card-img">
              <img src="<?= e(imageData('treatment_implants')) ?>" alt="Importance of Dental Implants" loading="lazy">
            </div>
            <div class="importance-card-body">
              <h3>Importance of Dental Implants</h3>
              <p>Unlike traditional dentures, titanium implants fuse directly with the jawbone to stop bone loss, preserve natural facial structure, and restore 100% natural biting power.</p>
            </div>
          </div>
          <div class="importance-card reveal reveal-delay-2">
            <div class="importance-card-img">
              <img src="<?= e(imageData('treatment_braces')) ?>" alt="Importance of Orthodontics" loading="lazy">
            </div>
            <div class="importance-card-body">
              <h3>Importance of Orthodontics &amp; Aligners</h3>
              <p>Proper teeth alignment is essential for long-term oral hygiene, correct speech, balanced bite function, and preventing premature tooth wear or jaw pain.</p>
            </div>
          </div>
          <div class="importance-card reveal reveal-delay-3">
            <div class="importance-card-img">
              <img src="<?= e(imageData('treatment_laser')) ?>" alt="Importance of Laser Dentistry" loading="lazy">
            </div>
            <div class="importance-card-body">
              <h3>Importance of Laser Dentistry</h3>
              <p>Minimally invasive laser wavelengths sterilize bacterial pockets, reduce post-op swelling, eliminate needle anxiety, and allow rapid healing for root canals and soft tissue surgeries.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FEATURED: DENTAL IMPLANTS -->
    <section class="section">
      <div class="container">
        <div class="featured-split">
          <div class="fs-img reveal">
            <img src="<?= e(imageData('treatment_implants')) ?>" alt="Dental implant treatment at Vital Dental Care" width="720" height="576" loading="lazy">
          </div>
          <div class="reveal reveal-delay-1">
            <span class="eyebrow">Featured treatment</span>
            <h2>Replace Missing Teeth With Confidence</h2>
            <p class="lede">Dental implants provide a long-lasting, natural-feeling replacement for missing teeth — designed to restore both function and the look of your smile.</p>
            <ul class="fs-benefits">
              <li><?= icon('check') ?> Titanium implants that integrate securely with your jaw</li>
              <li><?= icon('check') ?> Custom crowns matched to your natural tooth shade</li>
              <li><?= icon('check') ?> Performed by a certified Fellow in Implantology</li>
              <li><?= icon('check') ?> <strong>Personalized pricing &amp; 0% EMI options</strong></li>
            </ul>
            <div class="flex flex-wrap gap-3">
              <a href="<?= url('dental-implants-dwarka') ?>" class="btn btn--accent">Explore Dental Implants <?= icon('arrow') ?></a>
              <a href="<?= whatsappLink('Hi Vital Dental Care, I would like to know more about Dental Implants.') ?>" class="btn btn--whatsapp" target="_blank" rel="noopener"><?= icon('whatsapp') ?> Enquire on WhatsApp</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- WHY VITAL -->
    <section class="section section--alt">
      <div class="container">
        <div class="section-head center reveal">
          <span class="eyebrow">Why Vital Dental Care</span>
          <h2>Care built around safety, comfort and expertise</h2>
        </div>
        <div class="grid grid-4">
          <div class="feature-block reveal">
            <span class="icon-chip icon-chip--navy"><?= icon('shield') ?></span>
            <h3>MDS Specialist Team</h3>
            <p>Treatments are delivered by qualified specialists with masters-level training in their fields.</p>
          </div>
          <div class="feature-block reveal reveal-delay-1">
            <span class="icon-chip icon-chip--navy"><?= icon('laser') ?></span>
            <h3>Advanced Laser Dentistry</h3>
            <p>Laser-assisted procedures for gums and soft tissue that aim for less discomfort and faster healing.</p>
          </div>
          <div class="feature-block reveal reveal-delay-2">
            <span class="icon-chip icon-chip--navy"><?= icon('sterile') ?></span>
            <h3>Class B Sterilisation</h3>
            <p>Hospital-grade vacuum autoclaves and multi-step protocols keep every instrument safe.</p>
          </div>
          <div class="feature-block reveal reveal-delay-3">
            <span class="icon-chip icon-chip--navy"><?= icon('tooth') ?></span>
            <h3>Single-Sitting RCT</h3>
            <p>Advanced root canal treatment completed in a single sitting where clinically appropriate.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- TECHNOLOGY -->
    <section class="section section--deep">
      <div class="container">
        <div class="section-head reveal" style="max-width:680px">
          <span class="eyebrow" style="color:var(--teal-300)">Technology</span>
          <h2>Modern Technology. Better Dental Experiences.</h2>
          <p class="lede">From high-resolution intraoral cameras to digital X-rays and laser dentistry, our clinics are equipped for precise, comfortable care.</p>
        </div>
        <div class="tech-gallery reveal">
          <div class="tg-item tg-item--lg">
            <img src="<?= e(imageData('clinic_photo_1')) ?>" alt="Vital Dental Care modern clinic operatory" loading="lazy">
            <span class="tg-label">Modern Operatory</span>
          </div>
          <div class="tg-item">
            <img src="<?= e(imageData('treatment_laser')) ?>" alt="Laser dentistry" loading="lazy">
            <span class="tg-label">Laser Dentistry</span>
          </div>
          <div class="tg-item">
            <img src="<?= e(imageData('treatment_rct')) ?>" alt="Digital X-ray" loading="lazy">
            <span class="tg-label">Digital X-Ray</span>
          </div>
          <div class="tg-item">
            <img src="<?= e(imageData('treatment_scaling')) ?>" alt="Modern dental instruments" loading="lazy">
            <span class="tg-label">Ultrasonic Scaling</span>
          </div>
          <div class="tg-item">
            <img src="<?= e(imageData('clinic_photo_2')) ?>" alt="Sterilisation room" loading="lazy">
            <span class="tg-label">Class B Sterilizer</span>
          </div>
        </div>
      </div>
    </section>

    <!-- DOCTORS -->
    <section class="section">
      <div class="container">
        <div class="section-head center reveal">
          <span class="eyebrow">Meet the specialists</span>
          <h2>Meet Your Dental Specialists</h2>
          <p class="lede">An experienced team of qualified dentists across implantology, periodontics and orthodontics.</p>
        </div>
        <div class="grid grid-3">
          <?php foreach ($allDoctors as $d) render_doctor_card($d); ?>
        </div>
      </div>
    </section>

    <!-- PATIENT RESULTS / SMILE GALLERY -->
    <section class="section section--alt">
      <div class="container">
        <div class="section-head center reveal">
          <span class="eyebrow">Smile gallery</span>
          <h2>Real Patients. Real Transformations.</h2>
          <p class="lede">A selection of actual clinical outcomes from our clinics. <a href="<?= url('smile-gallery') ?>">View all cases &amp; clinic photos →</a></p>
        </div>
        <div class="grid grid-4">
          <?php
          $homeCases = [
            ['img' => 'gallery_1', 'tag' => 'Porcelain Veneers'],
            ['img' => 'gallery_2', 'tag' => 'Full Mouth Implants'],
            ['img' => 'gallery_3', 'tag' => 'Clear Aligners'],
            ['img' => 'gallery_4', 'tag' => 'Laser Whitening'],
          ];
          foreach ($homeCases as $c): ?>
          <div class="ba-card reveal">
            <div class="ba-img"><img src="<?= e(imageData($c['img'])) ?>" alt="<?= e($c['tag']) ?> result" loading="lazy"></div>
            <div class="ba-meta"><span class="ba-tag"><?= e($c['tag']) ?></span></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- VIDEO TESTIMONIALS -->
    <section class="section">
      <div class="container">
        <div class="section-head center reveal">
          <span class="eyebrow">Video Stories</span>
          <h2>Putting Smiles Through: Patient Video Stories</h2>
          <p class="lede">Watch real Vital Dental Care patients share their treatment journeys.</p>
        </div>
        <div class="grid grid-4">
          <a href="https://youtu.be/PiMgnnFbbUc" target="_blank" rel="noopener" class="video-card reveal">
            <div class="video-thumb">
              <img src="<?= e(imageData('video_thumb_1')) ?>" alt="Patient Video Review" loading="lazy">
              <span class="play-btn-overlay"><svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg></span>
            </div>
            <div class="video-info">
              <h4>Patient Experience</h4>
              <p>Painless Root Canal &amp; Restorations</p>
            </div>
          </a>
          <a href="https://www.youtube.com/watch?v=R2tT_QuQKcU" target="_blank" rel="noopener" class="video-card reveal reveal-delay-1">
            <div class="video-thumb">
              <img src="<?= e(imageData('video_thumb_2')) ?>" alt="Patient Video Review" loading="lazy">
              <span class="play-btn-overlay"><svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg></span>
            </div>
            <div class="video-info">
              <h4>Dental Implants Story</h4>
              <p>Smooth, surgical precision treatment</p>
            </div>
          </a>
          <a href="https://youtu.be/VIrfRHIElyY" target="_blank" rel="noopener" class="video-card reveal reveal-delay-2">
            <div class="video-thumb">
              <img src="<?= e(imageData('video_thumb_3')) ?>" alt="Patient Video Review" loading="lazy">
              <span class="play-btn-overlay"><svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg></span>
            </div>
            <div class="video-info">
              <h4>Orthodontic Journey</h4>
              <p>Braces &amp; Clear Aligner confidence</p>
            </div>
          </a>
          <a href="https://www.youtube.com/watch?v=SU2ruo1Mi-g" target="_blank" rel="noopener" class="video-card reveal reveal-delay-3">
            <div class="video-thumb">
              <img src="<?= e(imageData('video_thumb_4')) ?>" alt="Patient Video Review" loading="lazy">
              <span class="play-btn-overlay"><svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg></span>
            </div>
            <div class="video-info">
              <h4>Smile Makeover</h4>
              <p>Complete aesthetic smile transformation</p>
            </div>
          </a>
        </div>
      </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="section section--alt">
      <div class="container">
        <div class="section-head center reveal">
          <span class="eyebrow">Patient reviews</span>
          <h2>What Our Patients Say</h2>
          <p class="lede">Rated 4.9★ on Google across 500+ verified patient visits. <a href="<?= url('patient-reviews') ?>">Read all reviews →</a></p>
        </div>
        <div class="grid grid-3">
          <?php foreach ($reviews as $r) render_review_card($r); ?>
        </div>
      </div>
    </section>

    <!-- PRICING -->
    <section class="section section--alt">
      <div class="container container--narrow">
        <div class="section-head center reveal">
          <span class="eyebrow">Transparent pricing</span>
          <h2>Know What to Expect</h2>
          <p class="lede">Transparent treatment guidance before you visit.</p>
        </div>
        <div class="card reveal">
          <?php
          $prices = [
            ['Dental Consultation', 'On consultation', 'Initial assessment & treatment plan'],
            ['Dental Cleaning / Scaling', 'On consultation', 'Routine preventive care'],
            ['Root Canal Treatment', 'On consultation', 'Single or multi-visit'],
            ['Dental Implant', 'On consultation', 'Titanium fixture + abutment + crown'],
            ['Braces / Orthodontics', 'On consultation', 'Metal, Ceramic, or Aligners'],
            ['Teeth Whitening', 'On consultation', 'In-clinic laser whitening'],
          ];
          foreach ($prices as $p): ?>
          <div class="price-row">
            <div><div class="pr-name"><?= e($p[0]) ?></div><div class="pr-detail"><?= e($p[2]) ?></div></div>
            <div class="pr-price"><?= e($p[1]) ?></div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="text-center mt-6">
          <a href="<?= url('dental-treatment-cost-delhi') ?>" class="btn btn--ghost btn--lg">View complete treatment costs <?= icon('arrow') ?></a>
        </div>
      </div>
    </section>

    <!-- MEMBERSHIP -->
    <section class="section">
      <div class="container">
        <div class="split">
          <div class="reveal">
            <span class="eyebrow">Membership plan</span>
            <h2>Better Dental Care, Year After Year</h2>
            <p class="lede">An annual family membership designed to keep your family's oral health on track with preventive check-ups and member benefits.</p>
            <ul class="fs-benefits" style="margin: var(--sp-5) 0">
              <li><?= icon('check') ?> Routine check-ups and cleaning included</li>
              <li><?= icon('check') ?> Member pricing on all treatments</li>
              <li><?= icon('check') ?> Covers the entire family</li>
              <li><?= icon('check') ?> Priority scheduling & reminder service</li>
            </ul>
            <a href="<?= url('membership-plan') ?>" class="btn btn--accent">Explore Membership <?= icon('arrow') ?></a>
          </div>
          <div class="reveal reveal-delay-1">
            <div class="card" style="padding:clamp(32px,4vw,56px);background:linear-gradient(160deg,#fff,var(--ivory-100))">
              <span class="badge badge--amber">Family plan</span>
              <h3 style="margin-top:var(--sp-3)">Vital Care Membership</h3>
              <p style="color:var(--text-soft);font-size:var(--fs-sm)">Designed for families who want proactive preventive care and exclusive savings.</p>
              <div class="price-row" style="border-top:1px solid var(--border);padding-top:var(--sp-5);margin-top:var(--sp-5)">
                <div><div class="pr-name">Annual membership</div><div class="pr-detail">Per family</div></div>
                <div class="pr-price">On enquiry</div>
              </div>
              <a href="<?= url('membership-plan') ?>" class="btn btn--accent btn--block mt-5">Learn more</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section class="section section--alt">
      <div class="container container--narrow">
        <div class="section-head center reveal">
          <span class="eyebrow">Questions answered</span>
          <h2>Frequently Asked Questions</h2>
        </div>
        <?php render_faq($homeFaqs); ?>
      </div>
    </section>

    <?php render_emergency(); ?>

    <!-- FINAL BOOKING -->
    <section class="section">
      <div class="container">
        <div class="split">
          <div class="reveal">
            <span class="eyebrow">Book your visit</span>
            <h2>Let's Take Care of Your Smile</h2>
            <p class="lede">Tell us a little about what you need and our team will call you back to confirm your appointment at our Dwarka or Gurgaon clinic.</p>
            <div class="flex flex-wrap gap-3 mt-5">
              <a href="<?= telLink() ?>" class="btn btn--ghost"><?= icon('phone') ?> <?= e(PRIMARY_PHONE) ?></a>
              <a href="<?= whatsappLink() ?>" class="btn btn--whatsapp" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp</a>
            </div>
          </div>
          <div class="card reveal reveal-delay-1">
            <?php render_booking_form('appointment'); ?>
          </div>
        </div>
      </div>
    </section>
    </main>

    <?php
    render_footer();
    exit;
}

// -------------------------------------------------------------
// 2. ROUTE: DOCTORS / OUR TEAM
// -------------------------------------------------------------
if ($route === 'our-team' || strpos($route, 'our-team/') === 0) {
    $docSlug = str_replace('our-team/', '', $route);
    $singleDoc = ($docSlug !== '' && $docSlug !== 'our-team') ? getDoctor($docSlug) : null;

    if ($singleDoc) {
        // Individual Doctor Profile
        setSEO([
            'title'       => $singleDoc['name'] . ' · ' . $singleDoc['specialization'] . ' | ' . SITE_NAME,
            'description' => $singleDoc['short_bio'],
            'canonical'   => SITE_URL . '/our-team/' . $singleDoc['slug'],
        ]);

        render_header(['schemas' => [schema_person($singleDoc)]]);
        ?>
        <main id="main">
          <section class="page-hero">
            <div class="container">
              <?= breadcrumbs([
                  ['name' => 'Home', 'url' => ''],
                  ['name' => 'Our Doctors', 'url' => 'our-team'],
                  ['name' => $singleDoc['name'], 'url' => 'our-team/' . $singleDoc['slug']],
              ]) ?>
              <div class="split mt-5">
                <div>
                  <span class="eyebrow"><?= e($singleDoc['specialization']) ?></span>
                  <h1><?= e($singleDoc['name']) ?></h1>
                  <p class="lede"><?= e($singleDoc['short_bio']) ?></p>
                  <div class="flex flex-wrap gap-4 mt-4">
                    <span class="badge"><?= icon('shield') ?> <?= e($singleDoc['qualification']) ?></span>
                    <span class="badge badge--amber"><?= icon('clock') ?> <?= e($singleDoc['experience']) ?> Experience</span>
                  </div>
                </div>
                <div class="dc-img" style="max-width:360px;border-radius:var(--r-lg);overflow:hidden">
                  <img src="<?= e(imageData($singleDoc['image'])) ?>" alt="<?= e($singleDoc['name']) ?>" width="400" height="500">
                </div>
              </div>
            </div>
          </section>

          <section class="section">
            <div class="container">
              <div class="split">
                <div class="prose">
                  <h2>Education & Qualifications</h2>
                  <ul class="bullets">
                    <?php foreach ($singleDoc['education'] as $edu): ?>
                    <li><?= icon('check') ?> <span><?= e($edu) ?></span></li>
                    <?php endforeach; ?>
                  </ul>
                  <?php if (!empty($singleDoc['interests'])): ?>
                  <h2 class="mt-6">Clinical Interests</h2>
                  <div class="flex flex-wrap gap-2 mt-3">
                    <?php foreach ($singleDoc['interests'] as $int): ?>
                    <span class="badge badge--navy"><?= e($int) ?></span>
                    <?php endforeach; ?>
                  </div>
                  <?php endif; ?>
                </div>
                <div class="card">
                  <h3>Consult with <?= e($singleDoc['name']) ?></h3>
                  <p class="mb-4" style="color:var(--text-soft);font-size:var(--fs-sm)">Book a personal consultation at Vital Dental Care.</p>
                  <?php render_booking_form('appointment'); ?>
                </div>
              </div>
            </div>
          </section>
        </main>
        <?php
        render_footer();
        exit;
    }

    // All Doctors Directory
    setSEO([
        'title'       => 'Our Specialists & Dentists · Vital Dental Care Dwarka & Gurgaon',
        'description' => 'Meet our team of experienced MDS specialists in implantology, orthodontics, periodontics and general dentistry.',
        'canonical'   => SITE_URL . '/our-team',
    ]);

    render_header();
    $allDocs = doctors();
    ?>
    <main id="main">
      <section class="page-hero">
        <div class="container">
          <?= breadcrumbs([
              ['name' => 'Home', 'url' => ''],
              ['name' => 'Our Doctors', 'url' => 'our-team'],
          ]) ?>
          <span class="eyebrow">MDS Specialist Care</span>
          <h1>Meet Our Team of Specialists</h1>
          <p class="lede">Experienced dental surgeons dedicated to clinical precision and patient comfort.</p>
        </div>
      </section>

      <section class="section">
        <div class="container">
          <div class="grid grid-3">
            <?php foreach ($allDocs as $d) render_doctor_card($d); ?>
          </div>
        </div>
      </section>

      <?php render_emergency(); ?>
      <?php render_cta(); ?>
    </main>
    <?php
    render_footer();
    exit;
}

// -------------------------------------------------------------
// 3. ROUTE: TREATMENT DETAIL PAGE
// -------------------------------------------------------------
$treatment = getTreatment($route);
if ($treatment) {
    setSEO([
        'title'       => $treatment['title'] . ' | ' . SITE_NAME,
        'description' => $treatment['summary'],
        'canonical'   => SITE_URL . '/' . $treatment['slug'],
    ]);

    render_header([
        'schemas' => [
            schema_medicalprocedure($treatment),
            schema_dentist(),
        ]
    ]);
    ?>
    <main id="main">
      <section class="page-hero">
        <div class="container">
          <?= breadcrumbs([
              ['name' => 'Home', 'url' => ''],
              ['name' => 'Treatments', 'url' => '#treatments'],
              ['name' => $treatment['name'], 'url' => $treatment['slug']],
          ]) ?>
          <div class="split mt-5">
            <div>
              <span class="eyebrow"><?= e($treatment['category']) ?> Dentistry</span>
              <h1><?= e($treatment['title']) ?></h1>
              <p class="lede"><?= e($treatment['summary']) ?></p>
              <div class="flex flex-wrap gap-3 mt-5">
                <a href="#book" class="btn btn--accent btn--lg"><?= icon('check') ?> Book Consultation</a>
                <a href="<?= whatsappLink('Hi Vital Dental Care, I would like to know more about ' . $treatment['name']) ?>" class="btn btn--whatsapp btn--lg" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp</a>
              </div>
            </div>
            <div style="border-radius:var(--r-xl);overflow:hidden;box-shadow:var(--shadow-md)">
              <img src="<?= e(imageData($treatment['image'])) ?>" alt="<?= e($treatment['name']) ?>" width="600" height="400">
            </div>
          </div>
        </div>
      </section>

      <section class="section">
        <div class="container">
          <div class="split">
            <div>
              <div class="prose">
                <h2>Treatment Overview</h2>
                <p><?= e($treatment['procedure']) ?></p>

                <h2 class="mt-6">Who Needs This Treatment?</h2>
                <p><?= e($treatment['who_needs']) ?></p>

                <?php if (!empty($treatment['symptoms'])): ?>
                <h3 class="mt-5">Common Symptoms & Signs</h3>
                <ul class="bullets">
                  <?php foreach ($treatment['symptoms'] as $sym): ?>
                  <li><?= icon('check') ?> <span><?= e($sym) ?></span></li>
                  <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <?php if (!empty($treatment['technology'])): ?>
                <h3 class="mt-5">Advanced Technology We Use</h3>
                <div class="flex flex-wrap gap-2 mt-3">
                  <?php foreach ($treatment['technology'] as $tech): ?>
                  <span class="badge badge--navy"><?= icon('laser') ?> <?= e($tech) ?></span>
                  <?php endforeach; ?>
                </div>
                <?php endif; ?>
              </div>

              <?php if (!empty($treatment['quick_facts'])): ?>
              <div class="mt-7">
                <h3>Quick Facts</h3>
                <dl class="facts mt-4">
                  <?php foreach ($treatment['quick_facts'] as $k => $v): ?>
                  <dt><?= ucfirst(e($k)) ?></dt>
                  <dd><?= e($v) ?></dd>
                  <?php endforeach; ?>
                </dl>
              </div>
              <?php endif; ?>
            </div>

            <div id="book">
              <div class="card">
                <h3>Book Your Consultation</h3>
                <p class="mb-4" style="color:var(--text-soft);font-size:var(--fs-sm)">Get personalized treatment advice and transparent pricing.</p>
                <?php render_booking_form('appointment'); ?>
              </div>
            </div>
          </div>
        </div>
      </section>

      <?php render_emergency(); ?>
    </main>
    <?php
    render_footer();
    exit;
}

// -------------------------------------------------------------
// 4. ROUTE: LOCATION DETAIL PAGE
// -------------------------------------------------------------
$loc = getLocation($route);
if ($loc) {
    setSEO([
        'title'       => 'Vital Dental Care · ' . $loc['name'] . ', ' . $loc['city'],
        'description' => 'Visit our dental clinic at ' . $loc['address'] . '. Specialist doctors, modern technology, open 7 days a week.',
        'canonical'   => SITE_URL . '/' . $loc['slug'],
    ]);

    render_header(['schemas' => [schema_dentist($loc)]]);
    ?>
    <main id="main">
      <section class="page-hero">
        <div class="container">
          <?= breadcrumbs([
              ['name' => 'Home', 'url' => ''],
              ['name' => 'Locations', 'url' => '#locations'],
              ['name' => $loc['name'], 'url' => $loc['slug']],
          ]) ?>
          <span class="eyebrow"><?= e($loc['city']) ?> Dental Clinic</span>
          <h1>Vital Dental Care — <?= e($loc['name']) ?></h1>
          <p class="lede"><?= e($loc['address']) ?></p>
          <div class="flex flex-wrap gap-3 mt-4">
            <a href="<?= telLink($loc['phone_tel']) ?>" class="btn btn--accent"><?= icon('phone') ?> Call <?= e($loc['phone']) ?></a>
            <a href="<?= whatsappLink('Hi Vital Dental Care ' . $loc['name'] . ', I would like to book an appointment.') ?>" class="btn btn--whatsapp" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp</a>
            <a href="<?= e($loc['map_link']) ?>" class="btn btn--ghost" target="_blank" rel="noopener"><?= icon('pin') ?> Get Directions</a>
          </div>
        </div>
      </section>

      <section class="section">
        <div class="container">
          <div class="split">
            <div>
              <h2>Clinic Information</h2>
              <dl class="facts mt-4">
                <dt>Address</dt><dd><?= e($loc['address']) ?></dd>
                <dt>Timings</dt><dd><?= e($loc['hours']) ?></dd>
                <dt>Phone</dt><dd><a href="<?= telLink($loc['phone_tel']) ?>"><?= e($loc['phone']) ?></a></dd>
                <dt>Emergency Care</dt><dd>Same-day emergency slots available</dd>
              </dl>
              <div class="mt-6" style="border-radius:var(--r-lg);overflow:hidden">
                <iframe class="map-embed" src="<?= e($loc['map_embed']) ?>" loading="lazy" title="Map of <?= e($loc['name']) ?> Clinic"></iframe>
              </div>
            </div>
            <div>
              <div class="card">
                <h3>Book at <?= e($loc['name']) ?></h3>
                <p class="mb-4" style="color:var(--text-soft);font-size:var(--fs-sm)">Choose your preferred time and our front desk will confirm.</p>
                <?php render_booking_form('appointment'); ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <?php
    render_footer();
    exit;
}

// -------------------------------------------------------------
// 5. ROUTE: PRICING GUIDE
// -------------------------------------------------------------
if ($route === 'dental-treatment-cost-delhi' || $route === 'pricing') {
    setSEO([
        'title'       => 'Dental Treatment Cost & Pricing Guide · Vital Dental Care',
        'description' => 'Transparent dental treatment pricing guide for Dwarka & Gurgaon — implants, RCT, braces, crowns, and cleaning.',
        'canonical'   => SITE_URL . '/dental-treatment-cost-delhi',
    ]);

    render_header();
    $allTreatments = treatments();
    ?>
    <main id="main">
      <section class="page-hero">
        <div class="container">
          <?= breadcrumbs([
              ['name' => 'Home', 'url' => ''],
              ['name' => 'Treatment Costs', 'url' => 'dental-treatment-cost-delhi'],
          ]) ?>
          <span class="eyebrow">Transparent Pricing</span>
          <h1>Dental Treatment Cost Guide</h1>
          <p class="lede">We believe in complete transparency before you sit in the dental chair. Here is our treatment guidance overview.</p>
        </div>
      </section>

      <section class="section">
        <div class="container container--narrow">
          <div class="card">
            <?php foreach ($allTreatments as $t): ?>
            <div class="price-row">
              <div>
                <div class="pr-name"><?= e($t['name']) ?></div>
                <div class="pr-detail"><?= e($t['summary']) ?></div>
              </div>
              <div class="pr-price"><?= e($t['quick_facts']['cost'] ?? 'On Consultation') ?></div>
            </div>
            <?php endforeach; ?>
          </div>

          <div class="card mt-6" style="background:var(--ivory-100)">
            <h3>Why consultation is required for final pricing</h3>
            <p style="color:var(--text-soft);font-size:var(--fs-sm)">Every smile is unique. Factors like bone density for implants, single vs multi-canal root anatomy, and bite alignment influence the exact procedure and material requirements.</p>
          </div>
        </div>
      </section>

      <?php render_cta(); ?>
    </main>
    <?php
    render_footer();
    exit;
}

// -------------------------------------------------------------
// 6. ROUTE: SMILE GALLERY
// -------------------------------------------------------------
if ($route === 'smile-gallery') {
    setSEO([
        'title'       => 'Smile Gallery & Patient Results · Vital Dental Care',
        'description' => 'View before and after treatment transformations and modern clinic facilities at Vital Dental Care.',
        'canonical'   => SITE_URL . '/smile-gallery',
    ]);

    render_header();
    $cases = [
        ['img' => 'gallery_1', 'tag' => 'Porcelain Veneers', 'desc' => 'Aesthetic smile redesign with porcelain veneers and shade balancing.'],
        ['img' => 'gallery_2', 'tag' => 'Dental Implants', 'desc' => 'Full arch restoration with titanium implants and custom crowns.'],
        ['img' => 'gallery_3', 'tag' => 'Clear Aligners', 'desc' => 'Invisalign orthodontic alignment correcting bite and spacing.'],
        ['img' => 'gallery_4', 'tag' => 'Laser Whitening', 'desc' => 'In-clinic laser teeth whitening with multi-shade brightening.'],
        ['img' => 'gallery_5', 'tag' => 'Single-Sitting RCT', 'desc' => 'Precision root canal therapy topped with a durable zirconia crown.'],
        ['img' => 'gallery_6', 'tag' => 'Gum Contouring', 'desc' => 'Laser aesthetic gingival recontouring for a balanced smile line.'],
        ['img' => 'gallery_7', 'tag' => 'Composite Bonding', 'desc' => 'Seamless cosmetic repair of chipped and worn enamel.'],
        ['img' => 'gallery_8', 'tag' => 'Crowns & Bridges', 'desc' => 'Custom metal-free ceramic bridge restoring chewing functionality.'],
    ];
    $clinicPhotos = [
        ['img' => 'clinic_photo_1', 'caption' => 'Dwarka Sector 6 Operatory & Dental Chair'],
        ['img' => 'clinic_photo_2', 'caption' => 'Sterilisation Room & Class B Autoclave'],
        ['img' => 'clinic_photo_3', 'caption' => 'Gurgaon M3M Avenue Consultation Room'],
        ['img' => 'clinic_photo_4', 'caption' => 'High-Resolution Intraoral Diagnostic Setup'],
        ['img' => 'clinic_photo_5', 'caption' => 'Reception & Patient Waiting Lounge'],
        ['img' => 'clinic_photo_6', 'caption' => 'Treatment Room & Digital X-Ray Setup'],
    ];
    ?>
    <main id="main">
      <section class="page-hero">
        <div class="container">
          <?= breadcrumbs([
              ['name' => 'Home', 'url' => ''],
              ['name' => 'Smile Gallery', 'url' => 'smile-gallery'],
          ]) ?>
          <span class="eyebrow">Real Transformations</span>
          <h1>Smile Gallery &amp; Clinic Facilities</h1>
          <p class="lede">Explore real patient treatment transformations and take a look inside our high-tech clinics in Dwarka and Gurgaon.</p>
        </div>
      </section>

      <!-- CLINICAL CASES -->
      <section class="section">
        <div class="container">
          <div class="section-head reveal">
            <span class="eyebrow">Patient Outcomes</span>
            <h2>Clinical Smile Transformations</h2>
          </div>
          <div class="grid grid-4">
            <?php foreach ($cases as $c): ?>
            <div class="ba-card reveal">
              <div class="ba-img"><img src="<?= e(imageData($c['img'])) ?>" alt="<?= e($c['tag']) ?>" loading="lazy"></div>
              <div class="ba-meta">
                <span class="ba-tag badge"><?= e($c['tag']) ?></span>
                <p class="mt-2" style="font-size:var(--fs-xs);color:var(--text-soft)"><?= e($c['desc']) ?></p>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <!-- CLINIC INFRASTRUCTURE & OPERATORIES -->
      <section class="section section--alt">
        <div class="container">
          <div class="section-head reveal">
            <span class="eyebrow">Our Facilities</span>
            <h2>Inside Our Clinics in Dwarka &amp; Gurgaon</h2>
            <p class="lede">Hygienic, welcoming spaces equipped with the latest dental technology for your safety and comfort.</p>
          </div>
          <div class="grid grid-3">
            <?php foreach ($clinicPhotos as $cp): ?>
            <div class="card reveal" style="padding:0;overflow:hidden">
              <div style="aspect-ratio:16/10;overflow:hidden">
                <img src="<?= e(imageData($cp['img'])) ?>" alt="<?= e($cp['caption']) ?>" style="width:100%;height:100%;object-fit:cover" loading="lazy">
              </div>
              <div style="padding:var(--sp-4)">
                <h4 style="font-size:var(--fs-sm);margin:0;color:var(--primary-ink)"><?= e($cp['caption']) ?></h4>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <?php render_cta(); ?>
    </main>
    <?php
    render_footer();
    exit;
}

// -------------------------------------------------------------
// 7. ROUTE: PATIENT REVIEWS
// -------------------------------------------------------------
if ($route === 'patient-reviews') {
    setSEO([
        'title'       => 'Patient Reviews & Testimonials · Vital Dental Care',
        'description' => 'Read reviews from our patients in Dwarka and Gurgaon. Rated 4.9 stars on Google.',
        'canonical'   => SITE_URL . '/patient-reviews',
    ]);

    render_header();
    $reviews = testimonials();
    ?>
    <main id="main">
      <section class="page-hero">
        <div class="container">
          <?= breadcrumbs([
              ['name' => 'Home', 'url' => ''],
              ['name' => 'Patient Reviews', 'url' => 'patient-reviews'],
          ]) ?>
          <span class="eyebrow">4.9★ Google Rating</span>
          <h1>What Our Patients Say</h1>
          <p class="lede">Real feedback from patients across our Dwarka and Gurgaon dental clinics.</p>
        </div>
      </section>

      <section class="section">
        <div class="container">
          <div class="grid grid-3">
            <?php foreach ($reviews as $r) render_review_card($r); ?>
          </div>
        </div>
      </section>

      <?php render_cta(); ?>
    </main>
    <?php
    render_footer();
    exit;
}

// -------------------------------------------------------------
// 8. ROUTE: ABOUT US
// -------------------------------------------------------------
if ($route === 'about-us') {
    setSEO([
        'title'       => 'About Us · Vital Dental Care Dwarka & Gurgaon',
        'description' => 'Learn about Vital Dental Care, our philosophy of patient-first dentistry, strict sterilisation standards, and MDS specialists.',
        'canonical'   => SITE_URL . '/about-us',
    ]);

    render_header();
    ?>
    <main id="main">
      <section class="page-hero">
        <div class="container">
          <?= breadcrumbs([
              ['name' => 'Home', 'url' => ''],
              ['name' => 'About Us', 'url' => 'about-us'],
          ]) ?>
          <span class="eyebrow">About Vital Dental Care</span>
          <h1>Advanced Dentistry. Personal Care.</h1>
          <p class="lede">A multidisciplinary dental practice founded on transparency, safety, and modern clinical techniques.</p>
        </div>
      </section>

      <section class="section">
        <div class="container">
          <div class="welcome-split mb-8">
            <div class="welcome-img-frame reveal">
              <img src="<?= e(imageData('clinic_welcome')) ?>" alt="Vital Dental Care Clinic Dwarka & Gurgaon" width="600" height="400" loading="lazy">
            </div>
            <div class="reveal reveal-delay-1">
              <span class="eyebrow">Our Story</span>
              <h2>A Legacy of Painless, Specialist-Led Dental Care</h2>
              <p class="lede" style="margin-bottom:var(--sp-3)">
                Founded by Dr. Anurag Khandelwal, Vital Dental Care has grown into one of Delhi NCR's most trusted multispeciality dental centers.
              </p>
              <p style="color:var(--text-soft);line-height:1.65">
                Our clinics in Dwarka Sector 6 and Gurgaon Sector 65 were established to offer patients a warm, hospital-sterile environment where advanced root canal treatments, implants, clear aligners, and cosmetic smile makeovers are performed with precision and genuine personal empathy.
              </p>
            </div>
          </div>

          <div class="split">
            <div class="prose">
              <h2>Our Clinical Philosophy</h2>
              <p>At Vital Dental Care, we believe that great dental care starts with listening. We take time to understand your concerns, explain all treatment options with complete transparency, and recommend conservative solutions tailored to your long-term oral health.</p>
              
              <h2 class="mt-6">Strict Hospital-Grade Sterilisation Standards</h2>
              <p>Patient safety is paramount. Our clinics are equipped with Class B vacuum autoclaves, ensuring 100% sterilization for every instrument. Disposable barriers and non-contact protocols are rigorously enforced before every appointment.</p>
              
              <h2 class="mt-6">Two Convenient Modern Clinics</h2>
              <p>Conveniently located in Dwarka Sector 6 (Delhi) and Gurgaon Sector 65 (Gurugram), both facilities feature digital X-rays, high-resolution intraoral cameras, and modern laser dental systems.</p>
            </div>
            <div>
              <div class="card">
                <h3>Our Core Pillars</h3>
                <ul class="fs-benefits" style="margin:var(--sp-4) 0">
                  <li><?= icon('shield') ?> <strong>MDS Specialists:</strong> Masters-trained dental surgeons</li>
                  <li><?= icon('laser') ?> <strong>Modern Tech:</strong> Digital radiography and laser precision</li>
                  <li><?= icon('sterile') ?> <strong>Class B Sterilization:</strong> Hospital-grade hygiene</li>
                  <li><?= icon('clock') ?> <strong>Open 7 Days:</strong> 9:00 AM to 9:00 PM for your convenience</li>
                </ul>
                <a href="<?= url('book-appointment') ?>" class="btn btn--accent btn--block mt-5">Book an Appointment</a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- CLINIC FACILITIES SHOWCASE -->
      <section class="section section--alt">
        <div class="container">
          <div class="section-head center reveal">
            <span class="eyebrow">Clinic Infrastructure</span>
            <h2>State-of-the-Art Facilities</h2>
            <p class="lede">Designed for comfort, privacy, and maximum clinical sterility.</p>
          </div>
          <div class="grid grid-3">
            <div class="card reveal" style="padding:0;overflow:hidden">
              <div style="aspect-ratio:16/10;overflow:hidden">
                <img src="<?= e(imageData('clinic_photo_1')) ?>" alt="Operatory & Chair" style="width:100%;height:100%;object-fit:cover" loading="lazy">
              </div>
              <div style="padding:var(--sp-4)">
                <h4 style="font-size:var(--fs-sm);margin:0;color:var(--primary-ink)">Advanced Treatment Operatory</h4>
              </div>
            </div>
            <div class="card reveal reveal-delay-1" style="padding:0;overflow:hidden">
              <div style="aspect-ratio:16/10;overflow:hidden">
                <img src="<?= e(imageData('clinic_photo_2')) ?>" alt="Sterilization Setup" style="width:100%;height:100%;object-fit:cover" loading="lazy">
              </div>
              <div style="padding:var(--sp-4)">
                <h4 style="font-size:var(--fs-sm);margin:0;color:var(--primary-ink)">Class B Sterilisation Room</h4>
              </div>
            </div>
            <div class="card reveal reveal-delay-2" style="padding:0;overflow:hidden">
              <div style="aspect-ratio:16/10;overflow:hidden">
                <img src="<?= e(imageData('clinic_photo_5')) ?>" alt="Waiting Lounge" style="width:100%;height:100%;object-fit:cover" loading="lazy">
              </div>
              <div style="padding:var(--sp-4)">
                <h4 style="font-size:var(--fs-sm);margin:0;color:var(--primary-ink)">Welcoming Patient Lounge</h4>
              </div>
            </div>
          </div>
        </div>
      </section>

      <?php render_cta(); ?>
    </main>
    <?php
    render_footer();
    exit;
}

// -------------------------------------------------------------
// 9. ROUTE: CONTACT & APPOINTMENT
// -------------------------------------------------------------
if ($route === 'contact' || $route === 'book-appointment') {
    setSEO([
        'title'       => 'Book an Appointment & Contact · Vital Dental Care',
        'description' => 'Book your dental consultation at our Dwarka or Gurgaon clinics. Call or WhatsApp our front desk team directly.',
        'canonical'   => SITE_URL . '/' . $route,
    ]);

    render_header();
    $locs = locations();
    ?>
    <main id="main">
      <section class="page-hero">
        <div class="container">
          <?= breadcrumbs([
              ['name' => 'Home', 'url' => ''],
              ['name' => $route === 'contact' ? 'Contact' : 'Book Appointment', 'url' => $route],
          ]) ?>
          <span class="eyebrow">Get In Touch</span>
          <h1>Book Your Dental Visit</h1>
          <p class="lede">Fill out the form below or contact our clinics directly. Open 7 days a week, 9 AM – 9 PM.</p>
        </div>
      </section>

      <section class="section">
        <div class="container">
          <div class="split">
            <div class="card">
              <h3>Request an Appointment</h3>
              <p class="mb-4" style="color:var(--text-soft);font-size:var(--fs-sm)">Fill in your details and our team will contact you to confirm your slot.</p>
              <?php render_booking_form('appointment'); ?>
            </div>

            <div>
              <h2>Clinic Locations</h2>
              <div class="grid mt-4">
                <?php foreach ($locs as $l): ?>
                <div class="card">
                  <div class="lc-city"><?= e($l['city']) ?></div>
                  <h3><?= e($l['name']) ?></h3>
                  <p style="font-size:var(--fs-sm);color:var(--text-soft);margin-bottom:8px"><?= icon('pin') ?> <?= e($l['address']) ?></p>
                  <p style="font-size:var(--fs-sm);color:var(--text-soft);margin-bottom:8px"><?= icon('clock') ?> <?= e($l['hours']) ?></p>
                  <p style="font-size:var(--fs-sm);color:var(--text-soft);margin-bottom:12px"><?= icon('phone') ?> <a href="<?= telLink($l['phone_tel']) ?>"><?= e($l['phone']) ?></a></p>
                  <div class="flex gap-2">
                    <a href="<?= telLink($l['phone_tel']) ?>" class="btn btn--ghost btn--sm"><?= icon('phone') ?> Call</a>
                    <a href="<?= whatsappLink('Hi Vital Dental Care ' . $l['name']) ?>" class="btn btn--whatsapp btn--sm" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp</a>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <?php
    render_footer();
    exit;
}

// -------------------------------------------------------------
// 10. ROUTE: MEMBERSHIP PLAN
// -------------------------------------------------------------
if ($route === 'membership-plan') {
    setSEO([
        'title'       => 'Family Dental Membership Plan · Vital Dental Care',
        'description' => 'Comprehensive annual dental membership for families — preventive exams, cleanings, and exclusive treatment savings.',
        'canonical'   => SITE_URL . '/membership-plan',
    ]);

    render_header();
    ?>
    <main id="main">
      <section class="page-hero">
        <div class="container">
          <?= breadcrumbs([
              ['name' => 'Home', 'url' => ''],
              ['name' => 'Membership Plan', 'url' => 'membership-plan'],
          ]) ?>
          <span class="eyebrow">Preventive Family Plan</span>
          <h1>Vital Care Membership</h1>
          <p class="lede">An annual family membership designed to keep your family's smiles healthy with routine preventive check-ups and member savings.</p>
        </div>
      </section>

      <section class="section">
        <div class="container">
          <div class="split">
            <div class="prose">
              <h2>What Is Included?</h2>
              <ul class="bullets">
                <li><?= icon('check') ?> <span><strong>Free Comprehensive Dental Exams:</strong> 2 check-ups per member per year</span></li>
                <li><?= icon('check') ?> <span><strong>Free Ultrasonic Cleanings & Scaling:</strong> Routine preventive hygiene</span></li>
                <li><?= icon('check') ?> <span><strong>Digital Diagnostic X-Rays:</strong> Included with check-ups as clinically required</span></li>
                <li><?= icon('check') ?> <span><strong>15% Member Discount:</strong> Applied across all dental treatments</span></li>
                <li><?= icon('check') ?> <span><strong>Family Coverage:</strong> Covers parents, children, and grandparents</span></li>
              </ul>
            </div>

            <div class="card">
              <h3>Enquire About Membership</h3>
              <p class="mb-4" style="color:var(--text-soft);font-size:var(--fs-sm)">Speak with our care coordinator about enrolling your family.</p>
              <?php render_booking_form('contact'); ?>
            </div>
          </div>
        </div>
      </section>

      <?php render_cta(); ?>
    </main>
    <?php
    render_footer();
    exit;
}

// -------------------------------------------------------------
// 11. ROUTE: BLOG / RESOURCES
// -------------------------------------------------------------
if ($route === 'blog') {
    setSEO([
        'title'       => 'Dental Health Resources & Patient Guides · Vital Dental Care',
        'description' => 'Helpful dental health articles and guides on implants, clear aligners, root canal recovery, and pediatric oral care.',
        'canonical'   => SITE_URL . '/blog',
    ]);

    render_header();
    $articles = [
        ['title' => 'Dental Implants vs Dentures: Which Is Right for You?', 'tag' => 'Restorative', 'summary' => 'Understand the differences in longevity, comfort, and bone preservation between dental implants and removable dentures.'],
        ['title' => 'Clear Aligners vs Metal Braces: What You Need to Know', 'tag' => 'Orthodontics', 'summary' => 'A practical comparison of Invisalign vs traditional braces for adults and teenagers.'],
        ['title' => 'What to Expect During a Single-Sitting Root Canal', 'tag' => 'Endodontics', 'summary' => 'How modern rotary instruments and digital X-rays make root canal therapy fast and pain-free.'],
        ['title' => 'Laser Dentistry: Why It Means Less Pain & Faster Healing', 'tag' => 'Technology', 'summary' => 'Discover how dental lasers are transforming gum treatments, depigmentation, and soft tissue procedures.'],
    ];
    ?>
    <main id="main">
      <section class="page-hero">
        <div class="container">
          <?= breadcrumbs([
              ['name' => 'Home', 'url' => ''],
              ['name' => 'Resources', 'url' => 'blog'],
          ]) ?>
          <span class="eyebrow">Dental Knowledge</span>
          <h1>Dental Health Resources</h1>
          <p class="lede">Expert insights and guidance from our specialist dental surgeons.</p>
        </div>
      </section>

      <section class="section">
        <div class="container">
          <div class="grid grid-2">
            <?php foreach ($articles as $a): ?>
            <div class="card reveal">
              <span class="badge"><?= e($a['tag']) ?></span>
              <h3 class="mt-3"><?= e($a['title']) ?></h3>
              <p style="color:var(--text-soft);font-size:var(--fs-sm)"><?= e($a['summary']) ?></p>
              <a href="<?= url('book-appointment') ?>" class="tc-link mt-4">Consult a Doctor <?= icon('arrow') ?></a>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <?php render_cta(); ?>
    </main>
    <?php
    render_footer();
    exit;
}

// -------------------------------------------------------------
// 12. ROUTE: LEGAL / POLICIES
// -------------------------------------------------------------
if (in_array($route, ['privacy-policy', 'terms-and-conditions', 'cookie-policy', 'disclaimer'])) {
    $titles = [
        'privacy-policy'       => 'Privacy Policy',
        'terms-and-conditions' => 'Terms & Conditions',
        'cookie-policy'        => 'Cookie Policy',
        'disclaimer'           => 'Medical Disclaimer',
    ];
    $title = $titles[$route];

    setSEO([
        'title'       => $title . ' · Vital Dental Care',
        'description' => $title . ' for Vital Dental Care patient website and services.',
        'canonical'   => SITE_URL . '/' . $route,
    ]);

    render_header();
    ?>
    <main id="main">
      <section class="page-hero">
        <div class="container">
          <?= breadcrumbs([
              ['name' => 'Home', 'url' => ''],
              ['name' => $title, 'url' => $route],
          ]) ?>
          <h1><?= e($title) ?></h1>
        </div>
      </section>

      <section class="section">
        <div class="container container--narrow">
          <div class="card prose">
            <p>Last updated: <?= date('F Y') ?></p>
            <p>Welcome to Vital Dental Care. The information provided on this website is for general informational purposes only and does not constitute formal medical diagnosis or treatment advice.</p>
            <p>Dental treatments, outcomes, and costs vary based on individual clinical evaluation. Please schedule an in-person consultation with our qualified dental specialists for diagnostic evaluation and customized treatment plans.</p>
            <p>We respect your privacy and are committed to safeguarding all personal and health information submitted via our forms or communication channels.</p>
          </div>
        </div>
      </section>
    </main>
    <?php
    render_footer();
    exit;
}

// -------------------------------------------------------------
// 13. ROUTE: 404 NOT FOUND FALLBACK
// -------------------------------------------------------------
http_response_code(404);
setSEO([
    'title'       => 'Page Not Found · Vital Dental Care',
    'description' => 'The page you are looking for does not exist.',
    'canonical'   => SITE_URL . '/',
]);

render_header();
?>
<main id="main">
  <section class="page-hero">
    <div class="container text-center">
      <span class="eyebrow">404 Error</span>
      <h1>Page Not Found</h1>
      <p class="lede" style="margin-inline:auto">The page you requested could not be found. Please return to our homepage or contact our clinics.</p>
      <div class="flex justify-center gap-3 mt-6">
        <a href="<?= url('') ?>" class="btn btn--accent btn--lg">Return Home</a>
        <a href="<?= telLink() ?>" class="btn btn--ghost btn--lg"><?= icon('phone') ?> Call Us</a>
      </div>
    </div>
  </section>
</main>
<?php
render_footer();
