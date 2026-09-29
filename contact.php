<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$errors = [];
$old = [
    'name' => '',
    'email' => '',
    'message' => '',
    'interest' => clean_text((string) ($_GET['interest'] ?? ''), 160),
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old['name'] = request_value('name');
    $old['email'] = request_value('email');
    $old['message'] = request_value('message');
    $old['interest'] = request_value('interest');
    $honeypot = trim((string) ($_POST['company_website'] ?? ''));

    if (!csrf_valid($_POST['csrf'] ?? null)) {
        $errors[] = 'Your session expired. Please submit the form again.';
    }
    if ($honeypot !== '') {
        $errors[] = 'The message could not be sent.';
    }
    if ($old['name'] === '' || mb_strlen($old['name']) < 2) {
        $errors[] = 'Please enter your name.';
    }
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    if (mb_strlen($old['message']) < 10) {
        $errors[] = 'Please enter a message of at least 10 characters.';
    }

    if (!$errors) {
        try {
            save_record('messages.json', [
                'id' => bin2hex(random_bytes(8)),
                'name' => $old['name'],
                'email' => $old['email'],
                'interest' => $old['interest'],
                'message' => $old['message'],
                'created_at' => gmdate('c'),
                'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
            ]);
            flash('success', 'Thank you. Your message has been received and our team will respond shortly.');
            header('Location: ' . url('contact'));
            exit;
        } catch (Throwable $exception) {
            $errors[] = 'We could not save your message. Please email ' . SITE_EMAIL . ' directly.';
        }
    }
}

$flash = take_flash();
render_header(
    'Contact',
    'Contact OMNITECH Systems in Vienna, Virginia for a conversation about enterprise IT solutions.',
    'page-contact'
);
?>
<section class="hero hero-contact">
  <div class="hero-shade"></div>
  <div class="container hero-center">
    <p class="eyebrow light"><?= e(SITE_TAGLINE) ?></p>
    <h1>Contact Us</h1>
  </div>
</section>

<section class="section contact-section">
  <div class="container">
    <div class="contact-card">
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
      <div class="contact-grid">
        <div class="contact-info">
          <?= c_mark('#B4D33D', 48) ?>
          <h2>Office Address</h2>
          <p><?= e(SITE_ADDRESS_1) ?><br><?= e(SITE_ADDRESS_2) ?></p>
          <h2>Contact Info</h2>
          <p>
            <a href="tel:+17032812340"><?= e(SITE_PHONE) ?> (Phone)</a><br>
            <span><?= e(SITE_FAX) ?> (Fax)</span><br>
            <a href="<?= e(SITE_WEB) ?>"><?= e(SITE_WEB) ?></a><br>
            <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a>
          </p>
        </div>
        <div class="contact-form-wrap">
          <div class="building" aria-hidden="true">
            <svg viewBox="0 0 520 250">
              <rect width="520" height="250" fill="#d7e4ea"/>
              <path d="M40 210h440v16H40z" fill="#8ea0a8"/>
              <path d="M70 210 V120 C140 70 380 70 450 120 V210z" fill="#8aa0ad"/>
              <path d="M90 210 V132 C150 92 370 92 430 132 V210z" fill="#1d4e78"/>
              <g fill="#d5e7f2" opacity=".85">
                <?php for ($row = 0; $row < 5; $row++): ?>
                  <?php for ($col = 0; $col < 9; $col++): ?>
                    <rect x="<?= 112 + $col * 34 ?>" y="<?= 142 + $row * 12 ?>" width="18" height="7" rx="1"/>
                  <?php endfor; ?>
                <?php endfor; ?>
              </g>
              <rect x="230" y="176" width="60" height="34" fill="#12324e"/>
              <circle cx="90" cy="188" r="16" fill="#6ea36a"/>
              <circle cx="430" cy="184" r="22" fill="#5d9460"/>
            </svg>
          </div>
          <h2>Engage with OMNITECH</h2>
          <?php if ($old['interest'] !== ''): ?>
            <p class="interest">Interested in: <strong><?= e($old['interest']) ?></strong></p>
          <?php endif; ?>
          <form method="post" action="<?= e(url('contact')) ?>" novalidate>
            <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
            <input type="hidden" name="interest" value="<?= e($old['interest']) ?>">
            <p class="hp">
              <label for="company_website">Company website</label>
              <input id="company_website" name="company_website" type="text" tabindex="-1" autocomplete="off">
            </p>
            <label for="name">Name</label>
            <input id="name" name="name" type="text" required maxlength="120" placeholder="Your Name" value="<?= e($old['name']) ?>">
            <label for="email">Email Address</label>
            <input id="email" name="email" type="email" required maxlength="180" placeholder="Your Email" value="<?= e($old['email']) ?>">
            <label for="message">Message</label>
            <textarea id="message" name="message" required maxlength="4000" rows="5" placeholder="Enter Your Message"><?= e($old['message']) ?></textarea>
            <button class="btn btn-solid btn-block" type="submit">Send Message</button>
          </form>
        </div>
      </div>
    </div>

    <ul class="alliance-grid contact-alliances">
      <?php foreach (alliances() as $name): ?>
        <li><?= e($name) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
<?php render_footer(); ?>
