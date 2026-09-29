<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

render_header(
    'Home',
    'OMNITECH Systems designs, builds, and sustains enterprise data, contract, AI, and cloud systems for commercial and federal clients.',
    'page-home'
);

$lanes = [
    ['label' => 'Commercial', 'detail' => 'Fortune-scale businesses'],
    ['label' => 'Federal', 'detail' => 'Agencies and public missions'],
];
$outputs = [
    ['slug' => 'data-management', 'label' => 'Data platforms'],
    ['slug' => 'clm', 'label' => 'Contract lifecycle'],
    ['slug' => 'analytics-ai', 'label' => 'Analytics & AI'],
    ['slug' => 'devops', 'label' => 'Cloud & infrastructure'],
];
$blurbs = [
    'data-management' => 'Architecture, warehousing, migration, and data quality.',
    'clm' => 'Vendor selection, strategy, implementation, and managed services.',
    'analytics-ai' => 'Analytics, visualization, and AI/ML on the data you already own.',
    'devops' => 'AWS, Azure, VMware, and the platforms that keep systems running.',
    'application-development' => 'Salesforce, ServiceNow, and full-stack application delivery.',
    'strategic-consulting' => 'Data strategy, re-platforming, and legacy database migrations.',
    'database' => 'Design, administration, and tuning across enterprise databases.',
];
?>
<section class="hero hero-home">
  <div class="hero-stage" aria-hidden="true">
    <span class="orb orb-a"></span>
    <span class="orb orb-b"></span>
    <span class="orb orb-c"></span>
    <span class="hero-grid"></span>
  </div>
  <div class="hero-shade"></div>
  <div class="container hero-layout">
    <div class="hero-copy">
      <p class="eyebrow light hero-kicker"><?= e(SITE_TAGLINE) ?></p>
      <h1>The Accountable<br><span>Enterprise</span></h1>
      <p>OMNITECH Systems builds the data, contract, intelligence, and cloud systems that commercial firms and federal agencies run on, then stays to keep them accountable.</p>
      <div class="hero-actions">
        <a class="btn btn-solid" href="<?= e(url('contact')) ?>">Get Started</a>
        <a class="btn btn-outline" href="#work">See the work</a>
      </div>
    </div>
    <div class="fabric" aria-label="Commercial and federal work flowing through OMNITECH into data, contracts, AI, and cloud">
      <div class="fabric-col">
        <?php foreach ($lanes as $lane): ?>
          <div class="fabric-node source">
            <strong><?= e($lane['label']) ?></strong>
            <span><?= e($lane['detail']) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="fabric-track" aria-hidden="true">
        <span class="packet"></span>
        <span class="packet delay"></span>
      </div>
      <div class="fabric-core">
        <span>Vienna · since 1999</span>
        <strong>OMNITECH</strong>
        <em>Deliver, then sustain</em>
      </div>
      <div class="fabric-track out" aria-hidden="true">
        <span class="packet"></span>
        <span class="packet delay"></span>
      </div>
      <div class="fabric-col">
        <?php foreach ($outputs as $output): ?>
          <a class="fabric-node" href="<?= e(url('solutions') . '#' . $output['slug']) ?>"><?= e($output['label']) ?></a>
        <?php endforeach; ?>
      </div>
    </div>
    <ul class="hero-metrics">
      <li><strong>1999</strong><span>Founded in the DC metro</span></li>
      <li><strong>2</strong><span>Commercial and federal missions</span></li>
      <li><strong><?= count(services()) ?></strong><span>Practices from data to cloud</span></li>
    </ul>
  </div>
</section>

<section class="section work-section" id="work">
  <div class="container">
    <div class="section-head">
      <p class="eyebrow">What the company actually runs</p>
      <h2>Systems for the whole mission</h2>
      <p>Not a slide of service names. These are the systems OMNITECH architects, implements, and keeps alive for U.S. and international firms and for federal and state government.</p>
    </div>
    <div class="practice-grid">
      <?php foreach (services() as $service): ?>
        <a class="practice practice-<?= e($service['slug']) ?>" href="<?= e(url('solutions') . '#' . $service['slug']) ?>">
          <span class="practice-viz" aria-hidden="true">
            <i></i><i></i><i></i><i></i>
          </span>
          <h3><?= e($service['title']) ?></h3>
          <p><?= e($blurbs[$service['slug']] ?? '') ?></p>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section sustain-section">
  <div class="container sustain-grid">
    <article class="sustain-card">
      <p class="eyebrow">Today</p>
      <h2>Relevant systems, in production</h2>
      <p>Data architecture, analytics, AI, contract lifecycle management, cloud, applications, and databases. The work is built for the mission that is already on the desk.</p>
    </article>
    <article class="sustain-card sustain-next">
      <p class="eyebrow">After go-live</p>
      <h2>The means to keep them running</h2>
      <p>OMNITECH stays for managed services, DevOps, database administration, and the methods that keep a solution accountable after the first release.</p>
    </article>
  </div>
</section>

<section class="section clients-section">
  <div class="container">
    <div class="section-head">
      <p class="eyebrow">Who trusts the work</p>
      <h2 class="clients-title">Representative clients</h2>
    </div>
    <div class="marquee">
      <div class="marquee-track">
        <?php for ($copy = 0; $copy < 2; $copy++): ?>
          <ul<?= $copy === 1 ? ' aria-hidden="true"' : '' ?>>
            <?php foreach (clients() as $client): ?>
              <li><?= e($client) ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endfor; ?>
      </div>
    </div>
  </div>
</section>

<section class="section careers-teaser">
  <div class="container">
    <div class="section-head">
      <p class="eyebrow">Join the team</p>
      <h2>Careers</h2>
      <p class="narrow">If you’re looking for a place that’s more than just a job, a place where you can join a team, look no further.</p>
      <a class="text-link" href="<?= e(url('careers')) ?>">Learn More <span aria-hidden="true">&rarr;</span></a>
    </div>
    <div class="job-list">
      <?php foreach (jobs() as $job): ?>
        <article class="job-row">
          <?= c_mark('#B4D33D', 36) ?>
          <h3><?= e($job['title']) ?></h3>
          <a class="btn btn-outline lime" href="<?= e(url('career/' . $job['slug'])) ?>">Apply Now</a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php render_footer(); ?>
