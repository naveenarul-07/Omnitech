<?php get_header(); ?>
<section class="hero hero-careers">
  <video class="hero-video hero-banner-video" autoplay muted loop playsinline poster="<?php echo esc_url(get_template_directory_uri() . '/assets/img/careers-hero-poster.jpg'); ?>" aria-hidden="true">
    <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/careers-hero.mp4'); ?>" type="video/mp4">
  </video>
  <div class="hero-banner-fade" aria-hidden="true"></div>
  <div class="container careers-hero">
    <div class="careers-hero-copy">
      <p class="eyebrow light"><?php echo esc_html(get_bloginfo('description')); ?></p>
      <h1><?php esc_html_e('Find a Career', 'omnitech'); ?></h1>
      <p class="hero-sub"><?php esc_html_e('Start your career with OMNITECH.', 'omnitech'); ?></p>
    </div>
  </div>
</section>
<section class="section">
  <div class="container">
    <?php echo omnitech_mark('#B4D33D', 48); ?>
    <h2><?php esc_html_e('Benefits', 'omnitech'); ?></h2>
    <div class="benefit-grid">
      <article class="benefit-card">
        <span class="benefit-icon" aria-hidden="true"><svg viewBox="0 0 48 48"><rect x="14" y="10" width="20" height="26" rx="2" fill="none" stroke="#234576" stroke-width="2"/><path d="M18 18h12M18 24h12M18 30h8" stroke="#234576" stroke-width="2"/></svg></span>
        <h3><?php esc_html_e('Health Insurance', 'omnitech'); ?></h3>
        <p><?php esc_html_e('We offer our full-time employees and all their dependents medical and dental health coverage.', 'omnitech'); ?></p>
      </article>
      <article class="benefit-card">
        <span class="benefit-icon" aria-hidden="true"><svg viewBox="0 0 48 48"><rect x="14" y="10" width="20" height="26" rx="2" fill="none" stroke="#234576" stroke-width="2"/><path d="M18 18h12M18 24h12M18 30h8" stroke="#234576" stroke-width="2"/></svg></span>
        <h3><?php esc_html_e('Paid Vacation', 'omnitech'); ?></h3>
        <p><?php esc_html_e('We offer our full time employees 10 working days of paid vacation per year', 'omnitech'); ?></p>
      </article>
      <article class="benefit-card">
        <span class="benefit-icon" aria-hidden="true"><svg viewBox="0 0 48 48"><rect x="14" y="10" width="20" height="26" rx="2" fill="none" stroke="#234576" stroke-width="2"/><path d="M18 18h12M18 24h12M18 30h8" stroke="#234576" stroke-width="2"/></svg></span>
        <h3><?php esc_html_e('Paid Sick Leave', 'omnitech'); ?></h3>
        <p><?php esc_html_e('We offer our full time employees 5 working days of sick leave per year', 'omnitech'); ?></p>
      </article>
    </div>
  </div>
</section>
<section class="section jobs-open">
  <div class="container jobs-intro">
    <div>
      <?php echo omnitech_mark('#B4D33D', 46); ?>
      <p class="eyebrow"><?php esc_html_e('join the team', 'omnitech'); ?></p>
      <h2><?php esc_html_e('Open Job Positions', 'omnitech'); ?></h2>
      <p><?php esc_html_e('If you’re looking for a place that’s more than just a job, a place where you can join a team, look no further.', 'omnitech'); ?></p>
      <a class="btn btn-navy" href="#job-list"><?php esc_html_e('View Jobs', 'omnitech'); ?></a>
    </div>
    <div class="team-art" aria-hidden="true">
      <svg viewBox="0 0 460 240"><rect width="460" height="240" rx="8" fill="#d9e6c8"/><circle cx="120" cy="92" r="28" fill="#f2d2b6"/><rect x="92" y="124" width="56" height="78" rx="8" fill="#1f3b66"/><circle cx="210" cy="86" r="30" fill="#e7c2a4"/><rect x="178" y="120" width="64" height="86" rx="8" fill="#f4f1ea"/><circle cx="300" cy="96" r="26" fill="#c98b62"/><rect x="274" y="126" width="54" height="78" rx="8" fill="#8e3d4a"/><circle cx="380" cy="90" r="28" fill="#f0c9a0"/><rect x="350" y="122" width="60" height="82" rx="8" fill="#243e63"/></svg>
    </div>
  </div>
  <div class="container job-list" id="job-list">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article class="job-row">
          <?php echo omnitech_mark('#B4D33D', 40); ?>
          <h3><?php the_title(); ?></h3>
          <a class="btn btn-outline lime" href="<?php the_permalink(); ?>"><?php esc_html_e('Apply Now', 'omnitech'); ?></a>
        </article>
      <?php endwhile; ?>
      <?php the_posts_pagination(); ?>
    <?php else : ?>
      <p><?php esc_html_e('There are no open positions right now.', 'omnitech'); ?></p>
    <?php endif; ?>
  </div>
</section>
<?php get_footer(); ?>