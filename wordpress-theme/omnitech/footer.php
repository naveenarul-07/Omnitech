</main>
<section class="cta-band">
  <div class="container cta-inner">
    <h2><?php esc_html_e('Are you ready to make your enterprise accountable?', 'omnitech'); ?></h2>
    <?php $contact_page = get_page_by_path('contact'); ?>
    <?php if ($contact_page) : ?>
      <a class="btn btn-outline" href="<?php echo esc_url(get_permalink($contact_page)); ?>"><?php esc_html_e('Reach Out', 'omnitech'); ?></a>
    <?php endif; ?>
  </div>
</section>
<footer class="site-footer">
  <nav class="footer-nav" aria-label="<?php esc_attr_e('Footer', 'omnitech'); ?>">
    <div class="container">
      <?php
      wp_nav_menu([
          'theme_location' => 'footer',
          'container' => false,
          'fallback_cb' => 'wp_page_menu',
          'items_wrap' => '<ul>%3$s</ul>',
      ]);
      ?>
    </div>
  </nav>
  <div class="container footer-meta">
    <p><?php echo esc_html(sprintf(__('Copyright %1$s %2$s', 'omnitech'), date_i18n('Y'), get_bloginfo('name'))); ?></p>
    <?php $privacy_page = get_page_by_path('privacy'); ?>
    <?php if ($privacy_page) : ?>
      <a href="<?php echo esc_url(get_permalink($privacy_page)); ?>"><?php echo esc_html(get_the_title($privacy_page)); ?></a>
    <?php endif; ?>
    <?php $contact_email = get_theme_mod('omnitech_contact_email', 'contact@omnitechsys.com'); ?>
    <?php if ($contact_email !== '') : ?>
      <a href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a>
    <?php endif; ?>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>