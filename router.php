<?php
declare(strict_types=1);

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');

if (str_starts_with($uri, '/storage')) {
    http_response_code(403);
    echo 'Forbidden';
    return true;
}

if ($uri !== '/' && is_file(__DIR__ . $uri)) {
    return false;
}

if (preg_match('#^/career/([a-z0-9-]+)/?$#', $uri, $matches)) {
    $_GET['slug'] = $matches[1];
    require __DIR__ . '/job.php';
    return true;
}

$routes = [
    '/' => '/index.php',
    '/about' => '/about.php',
    '/about/' => '/about.php',
    '/solutions' => '/solutions.php',
    '/solutions/' => '/solutions.php',
    '/contact' => '/contact.php',
    '/contact/' => '/contact.php',
    '/careers' => '/careers.php',
    '/careers/' => '/careers.php',
    '/privacy' => '/privacy.php',
    '/privacy/' => '/privacy.php',
];

if (isset($routes[$uri])) {
    require __DIR__ . $routes[$uri];
    return true;
}

require __DIR__ . '/404.php';
return true;
