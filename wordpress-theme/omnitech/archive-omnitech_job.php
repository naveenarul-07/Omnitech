<?php get_header(); ?>
<section class="page-head">
  <div class="container">
    <p class="eyebrow"><?php echo esc_html(get_bloginfo('description')); ?></p>
    <h1><?php esc_html_e('Open Job Positions', 'omnitech'); ?></h1>
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