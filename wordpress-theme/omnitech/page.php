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
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/about-hero.png'); ?>" alt="The OMNITECH team in the Washington DC area, delivering systems for companies and government">
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