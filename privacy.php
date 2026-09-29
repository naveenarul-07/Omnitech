<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

render_header(
    'Privacy Policy',
    'Privacy statement for the OMNITECH Systems website, covering information collected, how it is used, and how to contact us.',
    'page-privacy'
);
?>
<section class="page-head">
  <div class="container">
    <p class="eyebrow"><?= e(SITE_TAGLINE) ?></p>
    <h1>Privacy Policy</h1>
  </div>
</section>
<section class="section">
  <div class="container prose">
    <h2>OMNITECH Systems Privacy</h2>
    <p>(“Omnitech,” “we,” or “us”) recognizes the importance of protecting the privacy of your information. This Privacy Statement governs the collection of your data received through this website or other online service (collectively, the “Services”) that links or refers to it. Any personal information received by Omnitech through this site is also treated according to Omnitech Systems’ Privacy Policy.</p>

    <h2>Consent to Use and Transfer Personal Data</h2>
    <p>If you submit personal data through the Omnitech website, you send it to Omnitech in the United States. We collect, process, and transfer your personal data in accordance with this Privacy Statement and Omnitech’s Privacy Policy, which may differ from the laws of the jurisdiction where you reside. By submitting your personal data you consent to collection, use, storage, and transfer to our databases and other repositories, wherever located, including in the cloud, for the purposes for which it is submitted and in accordance with this Privacy Statement.</p>

    <h2>Information We Collect</h2>
    <h3>Information You Provide Directly</h3>
    <p>We collect information you provide directly, including when you use a contact form, send an email, or submit a job application. That can include your name, email address, phone number, the contents of your message, and a resume file.</p>
    <h3>Information We Collect Automatically</h3>
    <p>Servers may log information about visits, such as IP address, browser and operating system, the time and duration of a visit, and the pages you view. This replica stores form submissions you choose to send. It does not run third-party advertising or analytics beacons.</p>
    <h3>Information from Third Parties</h3>
    <p>We may receive additional information from publicly and commercially available sources, as permitted by law. We may combine information we collect or receive and use or disclose it as described in this statement.</p>

    <h2>What Data We Collect and Why</h2>
    <ul>
      <li>Name, phone, company, comments, and interests: to respond to inquiries and provide requested information, products, or services.</li>
      <li>Email address: to reply to inquiries and, where you have asked for them, send notices about services, events, or news.</li>
      <li>Resume and application details: to evaluate you for a role you applied for. Resumes sent to the general contact inbox are not accepted.</li>
      <li>Device and browsing data: to understand how the site is used, keep it reliable, and protect it.</li>
    </ul>

    <h2>Use of Your Information</h2>
    <p>We use personal information to manage your relationship with Omnitech, respond to you, and improve the Services. We may also use it to protect legal rights, privacy, safety, or property, and to comply with applicable law.</p>

    <h2>Sharing Your Information</h2>
    <p>In the ordinary course of business Omnitech does not sell, trade, or rent your individual identifying information. Consistent with applicable law, information may be shared with subsidiaries and affiliates; with service providers who host data or support the site; when required by law or to protect the Services; if a business or assets are sold or transferred; and when you or your organization consent.</p>
    <p>Information may be transferred outside your country to a country that does not have similar data protection legislation. By using the Services or providing information you consent to those transfers.</p>

    <h2>Links to Other Websites</h2>
    <p>The Services may link to third-party sites, including the employee portal and LinkedIn. Omnitech is not responsible for the privacy or security practices of those sites.</p>

    <h2>Choice and Opt-Out</h2>
    <p>Marketing messages include a way to decline future communications. You can also opt out by emailing <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a>.</p>

    <h2>Cookies and Similar Technologies</h2>
    <p>This site uses a session cookie so contact and application forms can include a security token. The cookie is not used for advertising. You can refuse cookies in your browser; the forms need the session cookie in order to submit.</p>

    <h2>Protection of Information</h2>
    <p>Omnitech uses reasonable safeguards for information under our control. No internet transmission can be guaranteed. Omnitech assumes no liability for disclosure caused by transmission errors or unauthorized third parties.</p>

    <h2>Children’s Information</h2>
    <p>The Services are intended for adults and organizations interested in Omnitech. They are not intended for children, and Omnitech does not knowingly collect personal information about children under 13.</p>

    <h2>Changes to this Privacy Statement</h2>
    <p>We may revise this statement as technology, legal requirements, or the Services change. Updates will be posted on this page.</p>

    <h2>Do Not Track</h2>
    <p>Some browsers send a “do-not-track” signal. We do not currently change site behavior in response to that signal.</p>

    <h2>Access and Correction</h2>
    <ul>
      <li>We take reasonable steps to verify identity before granting access or making corrections.</li>
      <li>We do not place a fee on ordinary access requests, and we may decline unreasonable requests and explain why.</li>
      <li>If information is not kept in retrievable form, we will explain how that type of information is collected and used.</li>
      <li>If information is retrievable, we aim to respond within fifteen working days. Access is provided by disclosure and does not include direct access to our repositories.</li>
    </ul>

    <h2>Questions and Contact Information</h2>
    <p>Questions about this statement can be sent to <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a> or by mail to <?= e(SITE_ADDRESS_1) ?>, <?= e(SITE_ADDRESS_2) ?>.</p>
    <p>CVs and resumes sent to the general inbox will not be accepted. To apply for a job, use the <a href="<?= e(url('careers')) ?>">Careers</a> section.</p>
  </div>
</section>
<?php render_footer(); ?>
