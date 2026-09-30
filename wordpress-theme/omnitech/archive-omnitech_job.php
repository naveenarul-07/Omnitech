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
<section class="section jobs-open">
  <div class="container job-list">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article class="job-row">
          <h2><?php the_title(); ?></h2>
          <a class="btn btn-outline lime" href="<?php the_permalink(); ?>"><?php esc_html_e('View Position', 'omnitech'); ?></a>
        </article>
      <?php endwhile; ?>
      <?php the_posts_pagination(); ?>
    <?php else : ?>
      <p><?php esc_html_e('There are no open positions right now.', 'omnitech'); ?></p>
    <?php endif; ?>
  </div>
</section>
<?php get_footer(); ?>