<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';
http_response_code(404);
render_header('Page not found', 'The page you requested is not available on the OMNITECH Systems site.', 'page-404');
?>
<section class="section container prose">
  <h1>Page not found</h1>
  <p>That address is not part of this site. Use the menu to continue, or return home.</p>
  <p><a class="btn btn-solid" href="<?= e(url()) ?>">Back to home</a></p>
</section>
<?php render_footer(); ?>
