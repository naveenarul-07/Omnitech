<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

render_header(
    'Home',
    'OMNITECH Systems is a commercial and federal enterprise IT solutions provider delivering accountable, scalable mission outcomes.',
    'page-home'
);
?>
<section class="hero hero-home">
  <div class="hero-shade"></div>
  <div class="container hero-layout">
    <p class="eyebrow light hero-kicker"><?= e(SITE_TAGLINE) ?></p>
    <div class="hero-copy">
      <h1>The Accountable<br>Enterprise</h1>
      <p>OMNITECH Systems is a thriving Commercial &amp; Federal Enterprise IT solutions provider that delivers cost-effective, scalable, repeatable, and predictable mission outcomes with a strategic agility second to none.</p>
      <a class="btn btn-outline" href="<?= e(url('contact')) ?>">Get Started</a>
    </div>
  </div>
  <svg class="hero-wave" viewBox="0 0 1440 140" preserveAspectRatio="none" aria-hidden="true">
    <path fill="#f4f6f8" d="M0 78c140 48 280 62 430 42 170-22 250-78 430-70 170 8 280 70 400 78 70 6 140-4 180-14V140H0V78z"/>
  </svg>
</section>

<section class="section services-home">
  <div class="container center">
    <?= c_mark('#7d4de0', 46) ?>
    <p class="eyebrow">what we do</p>
    <h2>Enterprise IT Solutions &amp; Services</h2>
    <div class="pill-grid">
      <?php foreach (services() as $service): ?>
        <a class="service-pill" href="<?= e(url('solutions') . '#' . $service['slug']) ?>">
          <?= c_mark($service['accent'], 34) ?>
          <span><?= e($service['title']) ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="partner-band">
  <div class="container">
    <div class="partner-panel">
      <h2>OMNITECH: YOUR ACCOUNTABLE IT PARTNER</h2>
      <p>From Data Architecture, Data Analytics, AI/ML and Data Management, to innovative software developments like, platform development, cloud computing, virtualization and optimization and DevOps, our clients trust us because they know we deliver relevant solutions today, and set them up for success in the future.</p>
      <p>With a unique understanding of the increasing Data Management &amp; Data Analytics needs, OMNITECH Systems delivers not just solutions, but also the means and methods for sustaining those solutions.</p>
      <p>Powered by a passionate commitment for exceptional customer experience, OMNITECH Systems is the choice for those who seek an accountable IT Partner.</p>
    </div>
  </div>
</section>

<section class="section clients-section">
  <div class="container center">
    <?= c_mark('#7d4de0', 46) ?>
    <h2 class="clients-title">Representative Clients That Trust OMNITECH</h2>
    <ul class="client-grid">
      <?php foreach (clients() as $client): ?>
        <li><?= e($client) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="section careers-teaser">
  <div class="container">
    <?= c_mark('#8BC53F', 46) ?>
    <p class="eyebrow">join the team</p>
    <h2>Careers</h2>
    <p class="narrow">If you’re looking for a place that’s more than just a job, a place where you can join a team, look no further.</p>
    <a class="text-link" href="<?= e(url('careers')) ?>">Learn More <span aria-hidden="true">&rarr;</span></a>
    <div class="job-list">
      <?php foreach (jobs() as $job): ?>
        <article class="job-row">
          <?= c_mark('#8BC53F', 40) ?>
          <h3><?= e($job['title']) ?></h3>
          <a class="btn btn-outline lime" href="<?= e(url('career/' . $job['slug'])) ?>">Apply Now</a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php render_footer(); ?>
