<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/data.php';

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function url(string $path = ''): string
{
    $path = ltrim($path, '/');
    return $path === '' ? '/' : '/' . $path;
}

function asset(string $path): string
{
    return '/assets/' . ltrim($path, '/');
}

function current_path(): string
{
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    return rtrim($path, '/') ?: '/';
}

function nav_active(string $href): string
{
    $current = current_path();
    $target = rtrim($href, '/') ?: '/';
    if ($target === '/') {
        return $current === '/' ? 'is-active' : '';
    }
    return str_starts_with($current, $target) ? 'is-active' : '';
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_valid(?string $token): bool
{
    return is_string($token) && isset($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token);
}

function c_mark(string $accent = '#b5cf4a', int $size = 42): string
{
    $accent = e($accent);
    $size = max(16, $size);
    return <<<SVG
<svg class="c-mark" width="{$size}" height="{$size}" viewBox="0 0 64 64" aria-hidden="true" focusable="false">
  <path fill="#234576" d="M48.5 10.2C33.2 9.2 20 19.6 20 32.4 20 46 33.6 55.6 48.8 54.2l-4.1-8.6c-8.4.4-15.2-5.4-15.2-13.2 0-7.6 6.5-13.2 14.8-12.8l4.2-9.4z"/>
  <path fill="{$accent}" d="M52 16.4c-9.6-.2-17.2 6.2-17.2 15.8 0 9.2 7.2 15.4 16.6 15.2l-3.2-7.6c-6.2.2-10.4-3.6-10.4-7.6 0-4.2 4.4-7.8 10.6-7.6l3.6-8.2z"/>
</svg>
SVG;
}

function site_logo(bool $compact = false): string
{
    $label = e(SITE_NAME);
    $src = e(asset('img/logo.png'));
    return <<<HTML
<a class="brand" href="/" aria-label="{$label}">
  <img class="brand-mark" src="{$src}" alt="">
</a>
HTML;
}

function flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function take_flash(): ?array
{
    if (empty($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function clean_text(string $value, int $max = 4000): string
{
    $value = trim(preg_replace('/\s+/u', ' ', $value) ?? '');
    if (mb_strlen($value) > $max) {
        $value = mb_substr($value, 0, $max);
    }
    return $value;
}

function save_record(string $filename, array $record): void
{
    if (!is_dir(STORAGE_DIR) && !mkdir(STORAGE_DIR, 0775, true) && !is_dir(STORAGE_DIR)) {
        throw new RuntimeException('Unable to create storage directory.');
    }
    $path = STORAGE_DIR . '/' . $filename;
    $fp = fopen($path, 'c+');
    if ($fp === false) {
        throw new RuntimeException('Unable to open storage file.');
    }
    try {
        if (!flock($fp, LOCK_EX)) {
            throw new RuntimeException('Unable to lock storage file.');
        }
        $raw = stream_get_contents($fp);
        $rows = $raw ? json_decode($raw, true) : [];
        if (!is_array($rows)) {
            $rows = [];
        }
        $rows[] = $record;
        $json = json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        if ($json === false) {
            throw new RuntimeException('Unable to encode record.');
        }
        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, $json);
        fflush($fp);
    } finally {
        flock($fp, LOCK_UN);
        fclose($fp);
    }
}

function store_resume(array $file): string
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Please attach a resume.');
    }
    if (($file['size'] ?? 0) > MAX_RESUME_BYTES) {
        throw new RuntimeException('Resume must be 5 MB or smaller.');
    }
    $tmp = $file['tmp_name'] ?? '';
    if (!is_uploaded_file($tmp)) {
        throw new RuntimeException('Resume upload was not accepted.');
    }
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($tmp) ?: '';
    $map = [
        'application/pdf' => 'pdf',
        'application/msword' => 'doc',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
    ];
    if (!isset($map[$mime])) {
        throw new RuntimeException('Resume must be a PDF, DOC, or DOCX file.');
    }
    $dir = STORAGE_DIR . '/resumes';
    if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
        throw new RuntimeException('Unable to store resume.');
    }
    $name = date('Ymd-His') . '-' . bin2hex(random_bytes(4)) . '.' . $map[$mime];
    $dest = $dir . '/' . $name;
    if (!move_uploaded_file($tmp, $dest)) {
        throw new RuntimeException('Unable to store resume.');
    }
    return 'resumes/' . $name;
}

function render_header(string $title, string $description, string $bodyClass = ''): void
{
    $fullTitle = $title === '' ? SITE_NAME : $title . ' - ' . SITE_NAME;
    $page = basename($_SERVER['SCRIPT_NAME'] ?? '');
    require __DIR__ . '/header.php';
}

function render_footer(): void
{
    require __DIR__ . '/footer.php';
}

function request_value(string $key): string
{
    return clean_text((string) ($_POST[$key] ?? ''));
}
