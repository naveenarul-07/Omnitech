<?php
$services = [
    ['slug' => 'data-management', 'title' => 'Data Management', 'accent' => '#B4D33D'],
    ['slug' => 'clm', 'title' => 'Contract Lifecycle Management (CLM)', 'accent' => '#234576'],
    ['slug' => 'analytics-ai', 'title' => 'Analytics & AI', 'accent' => '#B4D33D'],
    ['slug' => 'devops', 'title' => 'DevOps & Infrastructure', 'accent' => '#B4D33D'],
    ['slug' => 'application-development', 'title' => 'Application Development & Support', 'accent' => '#B4D33D'],
    ['slug' => 'strategic-consulting', 'title' => 'Strategic Consulting', 'accent' => '#B4D33D'],
    ['slug' => 'database', 'title' => 'Database Design & Administration', 'accent' => '#B4D33D'],
];
$clients = [
    'Merrill', 'FIS', 'SunTrust', 'Freddie Mac', 'Booz Allen Hamilton', 'NSF',
    'The World Bank', 'IFC', 'CACI', 'Autodesk', 'Societe Generale', 'Citigroup',
    'Sodexo', 'TECAN', 'SanDisk', 'PTC', 'Fannie Mae',
];
$contact_page = get_page_by_path('contact');
$solutions_page = get_page_by_path('solutions');
$careers_page = get_page_by_path('careers');
$contact_url = $contact_page ? get_permalink($contact_page) : home_url('/contact/');
$solutions_url = $solutions_page ? get_permalink($solutions_page) : home_url('/solutions/');
$careers_url = $careers_page ? get_permalink($careers_page) : home_url('/careers/');
$jobs = get_posts([
    'post_type' => 'omnitech_job',
    'post_status' => 'publish',
    'numberposts' => 3,
    'orderby' => 'ID',
    'order' => 'ASC',
]);
get_header();
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
      <p class="eyebrow light hero-kicker"><?php echo esc_html(get_bloginfo('description') ?: 'OMNITECH SYSTEMS - IT ENTERPRISE SOLUTIONS'); ?></p>
      <h1>The Accountable<br><span>Enterprise</span></h1>
      <p>OMNITECH Systems is a thriving Commercial &amp; Federal Enterprise IT solutions provider that delivers cost-effective, scalable, repeatable, and predictable mission outcomes with a strategic agility second to none.</p>
      <div class="hero-actions">
        <a class="btn btn-solid" href="<?php echo esc_url($contact_url); ?>">Get Started</a>
        <a class="btn btn-outline" href="<?php echo esc_url($solutions_url); ?>">View Solutions</a>
      </div>
    </div>
    <aside class="hero-panel" aria-label="Featured practice areas">
      <?php foreach (array_slice($services, 0, 4) as $index => $service) : ?>
        <a class="float-card" style="--i: <?php echo esc_attr((string) $index); ?>" href="<?php echo esc_url($solutions_url . '#' . $service['slug']); ?>">
          <?php echo omnitech_mark($service['accent'], 34); ?>
          <span><?php echo esc_html($service['title']); ?></span>
        </a>
      <?php endforeach; ?>
    </aside>
    <ul class="hero-metrics">
      <li><strong>1999</strong><span>Founded in the DC metro</span></li>
      <li><strong><?php echo esc_html((string) count($services)); ?></strong><span>Enterprise practice areas</span></li>
      <li><strong>SBA</strong><span>Certified small business</span></li>
    </ul>
  </div>
</section>

<section class="section services-home" id="services">
  <div class="container">
    <div class="section-head">
      <?php echo omnitech_mark('#234576', 46); ?>
      <p class="eyebrow">what we do</p>
      <h2>Enterprise IT Solutions &amp; Services</h2>
      <p>From data platforms and contract lifecycle management to AI, cloud, and applications, the work is built to stay accountable after go-live.</p>
    </div>
    <div class="pill-grid">
      <?php foreach ($services as $service) : ?>
        <a class="service-pill" href="<?php echo esc_url($solutions_url . '#' . $service['slug']); ?>">
          <?php echo omnitech_mark($service['accent'], 34); ?>
          <span><?php echo esc_html($service['title']); ?></span>
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
      <?php echo omnitech_mark('#234576', 46); ?>
      <h2 class="clients-title">Representative Clients That Trust OMNITECH</h2>
    </div>
    <div class="marquee">
      <div class="marquee-track">
        <?php for ($copy = 0; $copy < 2; $copy++) : ?>
          <ul<?php echo $copy === 1 ? ' aria-hidden="true"' : ''; ?>>
            <?php foreach ($clients as $client) : ?>
              <li><?php echo esc_html($client); ?></li>
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
      <?php echo omnitech_mark('#B4D33D', 46); ?>
      <p class="eyebrow">join the team</p>
      <h2>Careers</h2>
      <p class="narrow">If you’re looking for a place that’s more than just a job, a place where you can join a team, look no further.</p>
      <a class="text-link" href="<?php echo esc_url($careers_url); ?>">Learn More <span aria-hidden="true">&rarr;</span></a>
    </div>
    <div class="job-list">
      <?php foreach ($jobs as $job) : ?>
        <article class="job-row">
          <?php echo omnitech_mark('#B4D33D', 40); ?>
          <h3><?php echo esc_html(get_the_title($job)); ?></h3>
          <a class="btn btn-outline lime" href="<?php echo esc_url(get_permalink($job)); ?>">Apply Now</a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>