<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

render_header(
    'About',
    'OMNITECH Systems is a minority-owned software solutions and services firm headquartered in the Washington DC metropolitan area since 1999.',
    'page-about'
);
?>
<section class="hero hero-about">
  <video class="hero-video hero-banner-video" autoplay muted loop playsinline poster="<?= e(asset('img/about-hero-poster.jpg')) ?>" aria-hidden="true">
    <source src="<?= e(asset('video/about-hero.mp4')) ?>" type="video/mp4">
  </video>
  <div class="hero-banner-fade" aria-hidden="true"></div>
  <div class="container about-hero">
    <div class="about-hero-copy">
      <p class="eyebrow light"><?= e(SITE_TAGLINE) ?></p>
      <h1>About US</h1>
    </div>
  </div>
</section>

<section class="about-story">
  <div class="container story-copy">
    <p class="eyebrow lime">Our History and Purpose</p>
    <p>OMNITECH Systems is a Software Solutions and Software Services provider that caters to a wide range of U.S based and international firms and the Federal and State governments.</p>
    <p>Headquartered in the Washington DC Metropolitan area, OMNITECH was established in 1999 as a minority-owned small business by IT Professionals with diverse experience in the field of Software Development and IT Consulting for fortune 500 companies.</p>
    <p>In keeping with our goal of being “The Accountable Enterprise”, OMNITECH’s profitably managed growth is due in part to our expert team’s razor focus on the customer’s needs and commitment to deliver the highest quality service possible.</p>
    <p class="story-close">Reach us today for a free assessment of your business needs.</p>
  </div>
</section>

<section class="badges">
  <div class="container badge-row">
    <article class="badge">
      <p class="badge-mark">SBA</p>
      <p>Certified Small<br>Disadvantaged<br>Business</p>
    </article>
    <article class="badge badge-gsa">
      <p class="badge-mark">GSA</p>
      <p>IT Schedule<br><strong>70</strong></p>
    </article>
  </div>
</section>
<?php render_footer(); ?>
