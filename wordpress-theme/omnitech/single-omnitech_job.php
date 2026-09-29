<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
  <?php $application_form = get_post_meta(get_the_ID(), '_omnitech_application_form', true); ?>
  <section class="page-head">
    <div class="container">
      <p class="eyebrow"><?php echo esc_html(get_bloginfo('description')); ?></p>
      <h1><?php the_title(); ?></h1>
      <?php if ($application_form !== '') : ?>
        <a class="btn btn-outline lime" href="#apply"><?php esc_html_e('Apply Now', 'omnitech'); ?></a>
      <?php endif; ?>
    </div>
  </section>
  <section class="section">
    <div class="container prose">
      <?php the_content(); ?>
      <p><a class="text-link" href="<?php echo esc_url(get_post_type_archive_link('omnitech_job')); ?>"><?php esc_html_e('Related openings', 'omnitech'); ?></a></p>
    </div>
  </section>
  <?php if ($application_form !== '') : ?>
    <section class="section apply-section" id="apply">
      <div class="container">
        <div class="apply-card">
          <h2><?php esc_html_e('Submit Application', 'omnitech'); ?></h2>
          <?php echo do_shortcode($application_form); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php endwhile; ?>
<?php get_footer(); ?>