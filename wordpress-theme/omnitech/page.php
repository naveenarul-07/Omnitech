<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
  <?php $omnitech_tagline = get_bloginfo('description') ?: 'OMNITECH SYSTEMS - IT ENTERPRISE SOLUTIONS'; ?>
  <?php $omnitech_source_content = omnitech_source_page_content(get_post_field('post_name', get_the_ID())); ?>
  <?php if (is_page('about')) : ?>
    <section class="hero hero-about">
      <video class="hero-video hero-banner-video" autoplay muted loop playsinline poster="<?php echo esc_url(get_template_directory_uri() . '/assets/img/about-hero-poster.jpg'); ?>" aria-hidden="true">
        <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/about-hero.mp4'); ?>" type="video/mp4">
      </video>
      <div class="hero-banner-fade" aria-hidden="true"></div>
      <div class="container about-hero">
        <div class="about-hero-copy">
          <p class="eyebrow light"><?php echo esc_html($omnitech_tagline); ?></p>
          <h1>About US</h1>
        </div>
      </div>
    </section>
  <?php elseif (is_page('solutions')) : ?>
    <section class="hero hero-solutions">
      <video class="hero-video hero-banner-video" autoplay muted loop playsinline poster="<?php echo esc_url(get_template_directory_uri() . '/assets/img/solutions-hero-poster.jpg'); ?>" aria-hidden="true">
        <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/solutions-hero.mp4'); ?>" type="video/mp4">
      </video>
      <div class="hero-banner-fade" aria-hidden="true"></div>
      <div class="container solutions-hero">
        <div class="solutions-hero-copy">
          <p class="eyebrow light"><?php echo esc_html($omnitech_tagline); ?></p>
          <h1>Enterprise IT<br>Solutions &amp; Services</h1>
        </div>
      </div>
    </section>
  <?php elseif (is_page('contact')) : ?>
    <section class="hero hero-contact">
      <video class="hero-video hero-banner-video" autoplay muted loop playsinline poster="<?php echo esc_url(get_template_directory_uri() . '/assets/img/contact-hero-poster.jpg'); ?>" aria-hidden="true">
        <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/contact-hero.mp4'); ?>" type="video/mp4">
      </video>
      <div class="hero-banner-fade" aria-hidden="true"></div>
      <div class="container contact-hero">
        <div class="contact-hero-copy">
          <p class="eyebrow light"><?php echo esc_html($omnitech_tagline); ?></p>
          <h1><?php the_title(); ?></h1>
        </div>
      </div>
    </section>
  <?php elseif (is_page('privacy')) : ?>
    <section class="page-head">
      <div class="container">
        <p class="eyebrow"><?php echo esc_html($omnitech_tagline); ?></p>
        <h1><?php the_title(); ?></h1>
      </div>
    </section>
  <?php elseif (is_page('careers')) : ?>
    <section class="hero hero-careers">
      <video class="hero-video hero-banner-video" autoplay muted loop playsinline poster="<?php echo esc_url(get_template_directory_uri() . '/assets/img/careers-hero-poster.jpg'); ?>" aria-hidden="true">
        <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/careers-hero.mp4'); ?>" type="video/mp4">
      </video>
      <div class="hero-banner-fade" aria-hidden="true"></div>
      <div class="container careers-hero">
        <div class="careers-hero-copy">
          <p class="eyebrow light"><?php echo esc_html($omnitech_tagline); ?></p>
          <h1><?php the_title(); ?></h1>
        </div>
      </div>
    </section>
  <?php else : ?>
  <section class="page-head">
    <div class="container">
      <p class="eyebrow"><?php echo esc_html($omnitech_tagline); ?></p>
      <h1><?php the_title(); ?></h1>
    </div>
  </section>
  <?php endif; ?>
  <?php if ($omnitech_source_content !== null) : ?>
    <?php echo apply_filters('the_content', $omnitech_source_content); ?>
  <?php else : ?>
    <section class="section">
      <div class="container prose">
      <?php the_content(); ?>
      </div>
    </section>
  <?php endif; ?>
<?php endwhile; ?>
<?php get_footer(); ?>