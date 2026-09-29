<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

render_header(
    'Home',
    'OMNITECH Systems is a commercial and federal enterprise IT solutions provider delivering accountable, scalable mission outcomes.',
    'page-home'
);
$preview = array_slice(services(), 0, 4);
?>
<section class="hero hero-home">
  <div class="hero-stage" aria-hidden="true">
    <span class="orb orb-a"></span>
    <span class="orb orb-b"></span>
    <span class="orb orb-c"></span>
    <span class="hero-grid"></span>
  </div>
  <div class="hero-shade"></div>
  <div class="container hero-layout">
    <div class="hero-copy">
      <p class="eyebrow light hero-kicker"><?= e(SITE_TAGLINE) ?></p>
      <h1>The Accountable<br><span>Enterprise</span></h1>
      <p>OMNITECH Systems is a thriving Commercial &amp; Federal Enterprise IT solutions provider that delivers cost-effective, scalable, repeatable, and predictable mission outcomes with a strategic agility second to none.</p>
      <div class="hero-actions">
        <a class="btn btn-solid" href="<?= e(url('contact')) ?>">Get Started</a>
        <a class="btn btn-outline" href="<?= e(url('solutions')) ?>">View Solutions</a>
      </div>
    </div>
    <aside class="hero-panel" aria-label="Featured practice areas">
      <?php foreach ($preview as $index => $service): ?>
        <a class="float-card" style="--i: <?= (int) $index ?>" href="<?= e(url('solutions') . '#' . $service['slug']) ?>">
          <?= c_mark($service['accent'], 34) ?>
          <span><?= e($service['title']) ?></span>
        </a>
      <?php endforeach; ?>
    </aside>
    <ul class="hero-metrics">
      <li><strong>1999</strong><span>Founded in the DC metro</span></li>
      <li><strong><?= count(services()) ?></strong><span>Enterprise practice areas</span></li>
      <li><strong>SBA</strong><span>Certified small business</span></li>
    </ul>
  </div>
</section>

<section class="section services-home" id="services">
  <div class="container">
    <div class="section-head">
      <?= c_mark('#234576', 46) ?>
      <p class="eyebrow">what we do</p>
      <h2>Enterprise IT Solutions &amp; Services</h2>
      <p>From data platforms and contract lifecycle management to AI, cloud, and applications, the work is built to stay accountable after go-live.</p>
    </div>
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
      <h2>Your accountable IT partner</h2>
      <p>From Data Architecture, Data Analytics, AI/ML and Data Management, to innovative software developments like, platform development, cloud computing, virtualization and optimization and DevOps, our clients trust us because they know we deliver relevant solutions today, and set them up for success in the future.</p>
      <p>With a unique understanding of the increasing Data Management &amp; Data Analytics needs, OMNITECH Systems delivers not just solutions, but also the means and methods for sustaining those solutions.</p>
      <p>Powered by a passionate commitment for exceptional customer experience, OMNITECH Systems is the choice for those who seek an accountable IT Partner.</p>
    </div>
  </div>
</section>

<section class="section clients-section">
  <div class="container">
    <div class="section-head">
      <?= c_mark('#234576', 46) ?>
      <h2 class="clients-title">Representative Clients That Trust OMNITECH</h2>
    </div>
    <div class="marquee">
      <div class="marquee-track">
        <?php for ($copy = 0; $copy < 2; $copy++): ?>
          <ul<?= $copy === 1 ? ' aria-hidden="true"' : '' ?>>
            <?php foreach (clients() as $client): ?>
              <li><?= e($client) ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endfor; ?>
      </div>
    </div>
  </div>
</section>

<section class="section careers-teaser">
  <div class="container">
    <div class="section-head">
      <?= c_mark('#B4D33D', 46) ?>
      <p class="eyebrow">join the team</p>
      <h2>Careers</h2>
      <p class="narrow">If you’re looking for a place that’s more than just a job, a place where you can join a team, look no further.</p>
      <a class="text-link" href="<?= e(url('careers')) ?>">Learn More <span aria-hidden="true">&rarr;</span></a>
    </div>
    <div class="job-list">
      <?php foreach (jobs() as $job): ?>
        <article class="job-row">
          <?= c_mark('#B4D33D', 40) ?>
          <h3><?= e($job['title']) ?></h3>
          <a class="btn btn-outline lime" href="<?= e(url('career/' . $job['slug'])) ?>">Apply Now</a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php render_footer(); ?>
