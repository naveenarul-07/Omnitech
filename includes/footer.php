  </main>
  <section class="cta-band">
    <div class="container cta-inner">
      <h2>Are you ready to make your enterprise accountable?</h2>
      <a class="btn btn-outline" href="<?= e(url('contact')) ?>">Reach Out</a>
    </div>
  </section>
  <footer class="site-footer">
    <nav class="footer-nav" aria-label="Footer">
      <div class="container">
        <ul>
          <li><a href="<?= e(url()) ?>">Home</a></li>
          <li><a href="<?= e(url('about')) ?>">About</a></li>
          <li><a href="<?= e(url('solutions')) ?>">Solutions &amp; Services</a></li>
          <li><a href="<?= e(url('contact')) ?>">Contact</a></li>
          <li><a href="<?= e(url('careers')) ?>">Careers</a></li>
          <li><a href="<?= e(EMPLOYEE_PORTAL) ?>" target="_blank" rel="noopener noreferrer">Employee Portal</a></li>
        </ul>
      </div>
    </nav>
    <div class="container footer-meta">
      <p>Copyright &copy; <?= date('Y') ?> OMNITECH Systems</p>
      <a href="<?= e(url('privacy')) ?>">Privacy Policy</a>
      <a class="linkedin" href="<?= e(LINKEDIN_URL) ?>" target="_blank" rel="noopener noreferrer" aria-label="OMNITECH Systems on LinkedIn">in</a>
    </div>
  </footer>
  <script src="<?= e(asset('js/main.js')) ?>"></script>
</body>
</html>
