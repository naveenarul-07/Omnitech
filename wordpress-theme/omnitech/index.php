<?php get_header(); ?>
<section class="page-head">
  <div class="container">
    <p class="eyebrow"><?php echo esc_html(get_bloginfo('description')); ?></p>
    <h1><?php esc_html_e('Latest News', 'omnitech'); ?></h1>
  </div>
</section>
<section class="section">
  <div class="container prose">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <?php the_excerpt(); ?>
        </article>
      <?php endwhile; ?>
      <?php the_posts_pagination(); ?>
    <?php else : ?>
      <p><?php esc_html_e('No content found.', 'omnitech'); ?></p>
    <?php endif; ?>
  </div>
</section>
<?php get_footer(); ?>