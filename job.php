<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$slug = clean_text((string) ($_GET['slug'] ?? ''), 80);
$job = job_by_slug($slug);
if ($job === null) {
    http_response_code(404);
    render_header('Role not found', 'The requested career posting is not available.', 'page-job');
    echo '<section class="section container"><h1>Role not found</h1><p>That posting is no longer listed. Visit the careers page to see open roles.</p><p><a class="btn btn-solid" href="' . e(url('careers')) . '">View careers</a></p></section>';
    render_footer();
    exit;
}

$errors = [];
$old = ['name' => '', 'email' => '', 'phone' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old['name'] = request_value('name');
    $old['email'] = request_value('email');
    $old['phone'] = request_value('phone');
    $honeypot = trim((string) ($_POST['company_website'] ?? ''));

    if (!csrf_valid($_POST['csrf'] ?? null)) {
        $errors[] = 'Your session expired. Please submit the application again.';
    }
    if ($honeypot !== '') {
        $errors[] = 'The application could not be sent.';
    }
    if ($old['name'] === '' || mb_strlen($old['name']) < 2) {
        $errors[] = 'Please enter your name.';
    }
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    if ($old['phone'] !== '' && !preg_match('/^[0-9+().\-\s]{7,24}$/', $old['phone'])) {
        $errors[] = 'Please enter a valid phone number.';
    }

    $resumePath = '';
    if (!$errors) {
        try {
            $resumePath = store_resume($_FILES['resume'] ?? []);
            save_record('applications.json', [
                'id' => bin2hex(random_bytes(8)),
                'job' => $job['slug'],
                'title' => $job['title'],
                'name' => $old['name'],
                'email' => $old['email'],
                'phone' => $old['phone'],
                'resume' => $resumePath,
                'created_at' => gmdate('c'),
            ]);
            flash('success', 'Application received for ' . $job['title'] . '. We will be in touch if your background is a match.');
            header('Location: ' . url('career/' . $job['slug']) . '#apply');
            exit;
        } catch (Throwable $exception) {
            if ($resumePath !== '' && is_file(STORAGE_DIR . '/' . $resumePath)) {
                unlink(STORAGE_DIR . '/' . $resumePath);
            }
            $errors[] = $exception->getMessage();
        }
    }
}

$flash = take_flash();
render_header(
    $job['title'],
    $job['title'] . ' opening at OMNITECH Systems. ' . $job['location'] . '.',
    'page-job'
);
?>
<section class="page-head">
  <div class="container">
    <p class="eyebrow"><?= e(SITE_TAGLINE) ?></p>
    <h1><?= e($job['title']) ?></h1>
    <a class="btn btn-outline lime" href="#apply">Apply Now</a>
  </div>
</section>

<section class="section">
  <div class="container prose">
    <p><?= e($job['intro']) ?></p>
    <?php if (!empty($job['body'])): ?>
      <p><?= e($job['body']) ?></p>
    <?php endif; ?>
    <?php foreach ($job['sections'] as $section): ?>
      <h2><?= e($section['heading']) ?></h2>
      <ul>
        <?php foreach ($section['items'] as $item): ?>
          <li><?= e($item) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endforeach; ?>
    <h2>Location</h2>
    <p><?= e($job['location']) ?></p>
    <p><a class="text-link" href="<?= e(url('careers')) ?>">Related openings</a></p>
  </div>
</section>

<section class="section apply-section" id="apply">
  <div class="container">
    <div class="apply-card">
      <h2>Submit Application</h2>
      <?php if ($flash): ?>
        <p class="notice notice-<?= e($flash['type']) ?>" role="status"><?= e($flash['message']) ?></p>
      <?php endif; ?>
      <?php if ($errors): ?>
        <div class="notice notice-error" role="alert">
          <ul>
            <?php foreach ($errors as $error): ?>
              <li><?= e($error) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
      <form method="post" action="<?= e(url('career/' . $job['slug'])) ?>#apply" enctype="multipart/form-data" novalidate>
        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
        <p class="hp">
          <label for="company_website">Company website</label>
          <input id="company_website" name="company_website" type="text" tabindex="-1" autocomplete="off">
        </p>
        <label for="name">Name</label>
        <input id="name" name="name" type="text" required maxlength="120" value="<?= e($old['name']) ?>">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" required maxlength="180" value="<?= e($old['email']) ?>">
        <label for="phone">Phone</label>
        <input id="phone" name="phone" type="tel" maxlength="24" value="<?= e($old['phone']) ?>">
        <label for="resume">Attach Resume</label>
        <input id="resume" name="resume" type="file" required accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
        <p class="hint">PDF, DOC, or DOCX. 5 MB maximum. Resumes sent to the general contact inbox are not accepted.</p>
        <button class="btn btn-solid" type="submit">Submit Application</button>
      </form>
    </div>
  </div>
</section>
<?php render_footer(); ?>
