<?php
declare(strict_types=1);
/** @var string $fullTitle */
/** @var string $description */
/** @var string $bodyClass */
$nav = [
    ['Home', url()],
    ['About', url('about')],
    ['Solutions & Services', url('solutions')],
    ['Contact', url('contact')],
    ['Careers', url('careers')],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($fullTitle) ?></title>
  <meta name="description" content="<?= e($description) ?>">
  <link rel="icon" href="<?= e(asset('img/favicon.svg')) ?>" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600&family=Manrope:wght@400;500;600;700;800&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
  <script>document.documentElement.classList.add("js");</script>
</head>
<body class="<?= e($bodyClass) ?>">
  <a class="skip-link" href="#content">Skip to content</a>
  <header class="site-header" id="top">
    <div class="container header-bar">
      <?= site_logo() ?>
      <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-nav">
        <span class="menu-toggle-box" aria-hidden="true"><span></span><span></span><span></span></span>
        <span class="menu-label">Menu</span>
      </button>
      <nav class="site-nav" id="site-nav" aria-label="Primary">
        <ul>
          <?php foreach ($nav as [$label, $href]): ?>
            <li><a class="<?= e(nav_active($href)) ?>" href="<?= e($href) ?>"><?= e($label) ?></a></li>
          <?php endforeach; ?>
          <li><a class="nav-portal" href="<?= e(EMPLOYEE_PORTAL) ?>" target="_blank" rel="noopener noreferrer">Employee Portal</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <main id="content">
