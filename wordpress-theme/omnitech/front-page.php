<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
  <section class="hero hero-home">
    <div class="hero-shade"></div>
    <div class="container hero-layout">
      <p class="eyebrow light hero-kicker"><?php echo esc_html(get_bloginfo('description')); ?></p>
      <div class="hero-copy">
        <h1><?php the_title(); ?></h1>
        <?php if (has_excerpt()) : ?><p><?php echo esc_html(get_the_excerpt()); ?></p><?php endif; ?>
        <?php $contact_page = get_page_by_path('contact'); ?>
        <?php if ($contact_page) : ?>
          <a class="btn btn-outline" href="<?php echo esc_url(get_permalink($contact_page)); ?>"><?php esc_html_e('Get Started', 'omnitech'); ?></a>
        <?php endif; ?>
      </div>
    </div>
    <svg class="hero-wave" viewBox="0 0 1440 140" preserveAspectRatio="none" aria-hidden="true"><path fill="#f4f6f8" d="M0 78c140 48 280 62 430 42 170-22 250-78 430-70 170 8 280 70 400 78 70 6 140-4 180-14V140H0V78z"/></svg>
  </section>
  <section class="section">
    <div class="container prose">
      <?php the_content(); ?>
    </div>
  </section>
<?php endwhile; ?>
<?php get_footer(); ?>