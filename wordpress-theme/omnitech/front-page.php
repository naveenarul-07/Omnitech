<?php
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
$services = [
    ['slug' => 'data-management', 'title' => 'Data Management'],
    ['slug' => 'clm', 'title' => 'Contract Lifecycle Management'],
    ['slug' => 'analytics-ai', 'title' => 'Analytics & AI'],
    ['slug' => 'devops', 'title' => 'DevOps & Infrastructure'],
    ['slug' => 'application-development', 'title' => 'Application Development & Support'],
    ['slug' => 'strategic-consulting', 'title' => 'Strategic Consulting'],
    ['slug' => 'database', 'title' => 'Database Design & Administration'],
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
$practice_art = [
    'data-management' => 'practice-data.png',
    'clm' => 'practice-clm.png',
    'analytics-ai' => 'practice-analytics.png',
    'devops' => 'practice-devops.png',
    'application-development' => 'practice-apps.png',
    'strategic-consulting' => 'practice-strategy.png',
    'database' => 'practice-database.png',
];
$client_logos = [
    ['name' => 'SunTrust', 'file' => 'suntrust.png'],
    ['name' => 'Freddie Mac', 'file' => 'freddie-mac.png'],
    ['name' => 'The World Bank', 'file' => 'world-bank.png'],
    ['name' => 'IFC', 'file' => 'ifc.png'],
    ['name' => 'Merrill', 'file' => 'merrill.png'],
    ['name' => 'Autodesk', 'file' => 'autodesk.png'],
];
$contact_page = get_page_by_path('contact');
$solutions_page = get_page_by_path('solutions');
$careers_page = get_page_by_path('careers');
$contact_url = $contact_page ? get_permalink($contact_page) : home_url('/contact/');
$solutions_url = $solutions_page ? get_permalink($solutions_page) : home_url('/solutions/');
$careers_url = $careers_page ? get_permalink($careers_page) : home_url('/careers/');
$jobs = get_posts([
    'post_type' => 'omnitech_job',
    'post_status' => 'publish',
    'numberposts' => 3,
    'orderby' => 'ID',
    'order' => 'ASC',
]);
$theme_assets = get_template_directory_uri() . '/assets/img/';
get_header();
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
      <p class="eyebrow light hero-kicker"><?php echo esc_html(get_bloginfo('description') ?: 'OMNITECH SYSTEMS - IT ENTERPRISE SOLUTIONS'); ?></p>
      <h1>The Accountable<br><span>Enterprise</span></h1>
      <p>OMNITECH Systems builds the data, contract, intelligence, and cloud systems that commercial firms and federal agencies run on, then stays to keep them accountable.</p>
      <div class="hero-actions">
        <a class="btn btn-solid" href="<?php echo esc_url($contact_url); ?>">Get Started</a>
        <a class="btn btn-outline" href="#work">See the work</a>
      </div>
    </div>
    <div class="fabric" aria-label="Commercial and federal work flowing through OMNITECH into data, contracts, AI, and cloud">
      <div class="fabric-col">
        <?php foreach ($lanes as $lane) : ?>
          <div class="fabric-node source">
            <strong><?php echo esc_html($lane['label']); ?></strong>
            <span><?php echo esc_html($lane['detail']); ?></span>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="fabric-track" aria-hidden="true">
        <span class="packet"></span>
        <span class="packet delay"></span>
      </div>
      <div class="fabric-core">
        <span>Vienna &middot; since 1999</span>
        <strong>OMNITECH</strong>
        <em>Deliver, then sustain</em>
      </div>
      <div class="fabric-track out" aria-hidden="true">
        <span class="packet"></span>
        <span class="packet delay"></span>
      </div>
      <div class="fabric-col">
        <?php foreach ($outputs as $output) : ?>
          <a class="fabric-node" href="<?php echo esc_url($solutions_url . '#' . $output['slug']); ?>"><?php echo esc_html($output['label']); ?></a>
        <?php endforeach; ?>
      </div>
    </div>
    <ul class="hero-metrics">
      <li><strong>1999</strong><span>Founded in the DC metro</span></li>
      <li><strong>2</strong><span>Commercial and federal missions</span></li>
      <li><strong><?php echo esc_html((string) count($services)); ?></strong><span>Practices from data to cloud</span></li>
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
      <?php foreach ($services as $service) : ?>
        <a class="practice practice-<?php echo esc_attr($service['slug']); ?>" href="<?php echo esc_url($solutions_url . '#' . $service['slug']); ?>">
          <img class="practice-bg" src="<?php echo esc_url($theme_assets . 'practices/' . ($practice_art[$service['slug']] ?? 'practice-data.png')); ?>" alt="">
          <span class="practice-viz" aria-hidden="true"><i></i><i></i><i></i><i></i></span>
          <h3><?php echo esc_html($service['title']); ?></h3>
          <p><?php echo esc_html($blurbs[$service['slug']] ?? ''); ?></p>
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
      <h2 class="clients-title">Representative clients that trust OMNITECH</h2>
    </div>
    <div class="marquee">
      <div class="marquee-track">
        <?php for ($copy = 0; $copy < 2; $copy++) : ?>
          <ul class="client-logos"<?php echo $copy === 1 ? ' aria-hidden="true"' : ''; ?>>
            <?php foreach ($client_logos as $client) : ?>
              <li><img src="<?php echo esc_url($theme_assets . 'clients/' . $client['file']); ?>" alt="<?php echo esc_attr($client['name']); ?>"></li>
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
      <a class="text-link" href="<?php echo esc_url($careers_url); ?>">Learn More <span aria-hidden="true">&rarr;</span></a>
    </div>
    <div class="job-list">
      <?php foreach ($jobs as $job) : ?>
        <article class="job-row">
          <?php echo omnitech_mark('#B4D33D', 36); ?>
          <h3><?php echo esc_html(get_the_title($job)); ?></h3>
          <a class="btn btn-outline lime" href="<?php echo esc_url(get_permalink($job)); ?>">Apply Now</a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>