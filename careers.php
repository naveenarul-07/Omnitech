<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

render_header(
    'Careers',
    'Explore careers at OMNITECH Systems, including benefits and open roles in AI, data architecture, and data science.',
    'page-careers'
);
$benefits = [
    ['Health Insurance', 'We offer our full-time employees and all their dependents medical and dental health coverage.'],
    ['Paid Vacation', 'We offer our full time employees 10 working days of paid vacation per year'],
    ['Paid Sick Leave', 'We offer our full time employees 5 working days of sick leave per year'],
];
?>
<section class="hero hero-careers">
  <div class="container careers-hero">
    <div class="careers-hero-copy">
      <p class="eyebrow light"><?= e(SITE_TAGLINE) ?></p>
      <h1>Find a Career</h1>
      <p class="hero-sub">Start your career with OMNITECH.</p>
    </div>
    <figure class="careers-hero-art">
      <video class="hero-video" autoplay muted loop playsinline poster="<?= e(asset('img/careers-hero.png')) ?>" aria-label="People joining OMNITECH, with health coverage, paid time off, and open technology roles">
        <source src="<?= e(asset('video/careers-hero.mp4')) ?>" type="video/mp4">
      </video>
    </figure>
  </div>
</section>

<section class="section">
  <div class="container">
    <?= c_mark('#B4D33D', 48) ?>
    <h2>Benefits</h2>
    <div class="benefit-grid">
      <?php foreach ($benefits as [$title, $copy]): ?>
        <article class="benefit-card">
          <span class="benefit-icon" aria-hidden="true">
            <svg viewBox="0 0 48 48"><rect x="14" y="10" width="20" height="26" rx="2" fill="none" stroke="#234576" stroke-width="2"/><path d="M18 18h12M18 24h12M18 30h8" stroke="#234576" stroke-width="2"/></svg>
          </span>
          <h3><?= e($title) ?></h3>
          <p><?= e($copy) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section jobs-open" id="positions">
  <div class="container jobs-intro">
    <div>
      <?= c_mark('#B4D33D', 46) ?>
      <p class="eyebrow">join the team</p>
      <h2>Open Job Positions</h2>
      <p>If you’re looking for a place that’s more than just a job, a place where you can join a team, look no further.</p>
      <a class="btn btn-navy" href="#job-list">View Jobs</a>
    </div>
    <div class="team-art" aria-hidden="true">
      <svg viewBox="0 0 460 240">
        <rect width="460" height="240" rx="8" fill="#d9e6c8"/>
        <circle cx="120" cy="92" r="28" fill="#f2d2b6"/>
        <rect x="92" y="124" width="56" height="78" rx="8" fill="#1f3b66"/>
        <circle cx="210" cy="86" r="30" fill="#e7c2a4"/>
        <rect x="178" y="120" width="64" height="86" rx="8" fill="#f4f1ea"/>
        <circle cx="300" cy="96" r="26" fill="#c98b62"/>
        <rect x="274" y="126" width="54" height="78" rx="8" fill="#8e3d4a"/>
        <circle cx="380" cy="90" r="28" fill="#f0c9a0"/>
        <rect x="350" y="122" width="60" height="82" rx="8" fill="#243e63"/>
      </svg>
    </div>
  </div>
  <div class="container job-list" id="job-list">
    <?php foreach (jobs() as $job): ?>
      <article class="job-row">
        <?= c_mark('#B4D33D', 40) ?>
        <h3><?= e($job['title']) ?></h3>
        <a class="btn btn-outline lime" href="<?= e(url('career/' . $job['slug'])) ?>">Apply Now</a>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<?php render_footer(); ?>
