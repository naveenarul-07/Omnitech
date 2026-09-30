<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
  <?php if (is_page('about')) : ?>
    <section class="hero hero-about">
      <div class="container about-hero">
        <div class="about-hero-copy">
          <p class="eyebrow light"><?php echo esc_html(get_bloginfo('description')); ?></p>
          <h1><?php the_title(); ?></h1>
        </div>
        <figure class="about-hero-art">
          <video class="hero-video" autoplay muted loop playsinline poster="<?php echo esc_url(get_template_directory_uri() . '/assets/img/about-hero.png'); ?>" aria-label="The OMNITECH team in the Washington DC area, delivering systems for companies and government">
            <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/about-hero.mp4'); ?>" type="video/mp4">
          </video>
        </figure>
      </div>
    </section>
  <?php elseif (is_page('solutions')) : ?>
    <section class="hero hero-solutions">
      <div class="container solutions-hero">
        <div class="solutions-hero-copy">
          <p class="eyebrow light"><?php echo esc_html(get_bloginfo('description')); ?></p>
          <h1><?php the_title(); ?></h1>
        </div>
        <figure class="solutions-hero-art">
          <video class="hero-video" autoplay muted loop playsinline poster="<?php echo esc_url(get_template_directory_uri() . '/assets/img/solutions-hero.png'); ?>" aria-label="Data, contracts, analytics, cloud, applications, and databases connected as one system">
            <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/solutions-hero.mp4'); ?>" type="video/mp4">
          </video>
        </figure>
      </div>
    </section>
  <?php elseif (is_page('contact')) : ?>
    <section class="hero hero-contact">
      <div class="container contact-hero">
        <div class="contact-hero-copy">
          <p class="eyebrow light"><?php echo esc_html(get_bloginfo('description')); ?></p>
          <h1><?php the_title(); ?></h1>
        </div>
        <figure class="contact-hero-art">
          <video class="hero-video" autoplay muted loop playsinline poster="<?php echo esc_url(get_template_directory_uri() . '/assets/img/contact-hero.png'); ?>" aria-label="The Vienna office, with a map pin, email, phone, and a message">
            <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/contact-hero.mp4'); ?>" type="video/mp4">
          </video>
        </figure>
      </div>
    </section>
  <?php else : ?>
  <section class="page-head">
    <div class="container">
      <p class="eyebrow"><?php echo esc_html(get_bloginfo('description')); ?></p>
      <h1><?php the_title(); ?></h1>
    </div>
  </section>
  <?php endif; ?>
  <section class="section">
    <div class="container prose">
      <?php the_content(); ?>
    </div>
  </section>
<?php endwhile; ?>
<?php get_footer(); ?>