<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

render_header(
    'Solutions & Services',
    'Enterprise IT solutions and services from OMNITECH Systems, including data management, CLM, analytics, DevOps, applications, consulting, and databases.',
    'page-solutions'
);
?>
<section class="hero hero-solutions">
  <video class="hero-video hero-banner-video" autoplay muted loop playsinline poster="<?= e(asset('img/solutions-hero-poster.jpg')) ?>" aria-hidden="true">
    <source src="<?= e(asset('video/solutions-hero.mp4')) ?>" type="video/mp4">
  </video>
  <div class="hero-banner-fade" aria-hidden="true"></div>
  <div class="container solutions-hero">
    <div class="solutions-hero-copy">
      <p class="eyebrow light"><?= e(SITE_TAGLINE) ?></p>
      <h1>Enterprise IT<br>Solutions &amp; Services</h1>
    </div>
  </div>
</section>

<section class="section">
  <div class="container center">
    <?= c_mark('#B4D33D', 48) ?>
    <p class="eyebrow">IT Solutions &amp; Services</p>
  </div>
  <div class="container card-grid">
    <?php foreach (services() as $service): ?>
      <article class="solution-card" id="<?= e($service['slug']) ?>">
        <?= c_mark($service['accent'], 54) ?>
        <h2><?= e($service['title']) ?></h2>
        <ul>
          <?php foreach ($service['items'] as $item): ?>
            <li><?= e($item) ?></li>
          <?php endforeach; ?>
        </ul>
        <a class="btn btn-solid" href="<?= e(url('contact') . '?interest=' . rawurlencode($service['title'])) ?>">Learn More</a>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<section class="section alliances">
  <div class="container center">
    <h2>Key Technology Expertise and Industry Alliances</h2>
  </div>
  <div class="marquee">
    <div class="marquee-track">
      <?php for ($copy = 0; $copy < 2; $copy++): ?>
        <ul class="alliance-logos"<?= $copy === 1 ? ' aria-hidden="true"' : '' ?>>
          <?php foreach (alliance_logos() as $logo): ?>
            <li>
              <img src="<?= e(asset('img/alliances/' . $logo['file'])) ?>" alt="<?= e($logo['name']) ?>">
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endfor; ?>
    </div>
  </div>
</section>
<?php render_footer(); ?>
