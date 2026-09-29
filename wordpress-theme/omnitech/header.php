<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
<script>document.documentElement.classList.add("js");</script>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#content"><?php esc_html_e('Skip to content', 'omnitech'); ?></a>
<header class="site-header" id="top">
  <div class="container header-bar">
    <?php if (has_custom_logo()) : ?>
      <?php the_custom_logo(); ?>
    <?php else : ?>
      <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
        <img class="brand-mark" src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo.png'); ?>" alt="">
      </a>
    <?php endif; ?>
    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-nav">
      <span class="menu-toggle-box" aria-hidden="true"><span></span><span></span><span></span></span>
      <span class="menu-label"><?php esc_html_e('Menu', 'omnitech'); ?></span>
    </button>
    <nav class="site-nav" id="site-nav" aria-label="<?php esc_attr_e('Primary', 'omnitech'); ?>">
      <?php
      $portal_url = get_theme_mod('omnitech_employee_portal', 'https://columbiaedp.evolutionpayroll.com/ess#/login');
      $menu_items_wrap = '<ul>%3$s';
      if ($portal_url !== '') {
        $menu_items_wrap .= '<li><a href="' . esc_url($portal_url) . '" target="_blank" rel="noopener noreferrer">' . esc_html__('Employee Portal', 'omnitech') . '</a></li>';
      }
      wp_nav_menu([
          'theme_location' => 'primary',
          'container' => false,
          'fallback_cb' => 'wp_page_menu',
          'menu_class' => '',
        'items_wrap' => $menu_items_wrap . '</ul>',
      ]);
      ?>
    </nav>
  </div>
</header>
<main id="content">