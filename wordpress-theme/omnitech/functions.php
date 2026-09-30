<?php
/**
 * Theme setup and WordPress integration.
 */

function omnitech_setup(): void
{
    load_theme_textdomain('omnitech', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height' => 80,
        'width' => 320,
        'flex-height' => true,
        'flex-width' => true,
    ]);
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_editor_style('assets/css/style.css');

    register_nav_menus([
        'primary' => __('Primary menu', 'omnitech'),
        'footer' => __('Footer menu', 'omnitech'),
    ]);
}
add_action('after_setup_theme', 'omnitech_setup');

function omnitech_home_body_class(array $classes): array
{
    if (is_front_page()) {
        $classes[] = 'page-home';
    }

    return $classes;
}
add_filter('body_class', 'omnitech_home_body_class');

function omnitech_primary_nav_fallback(): void
{
    $portal_url = get_theme_mod('omnitech_employee_portal', 'https://columbiaedp.evolutionpayroll.com/ess#/login');
    echo '<ul class="omnitech-fallback-nav">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'omnitech') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about/')) . '">' . esc_html__('About', 'omnitech') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/solutions/')) . '">' . esc_html__('Solutions & Services', 'omnitech') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact/')) . '">' . esc_html__('Contact', 'omnitech') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/careers/')) . '">' . esc_html__('Careers', 'omnitech') . '</a></li>';
    if ($portal_url !== '') {
        echo '<li><a href="' . esc_url($portal_url) . '" target="_blank" rel="noopener noreferrer">' . esc_html__('Employee Portal', 'omnitech') . '</a></li>';
    }
    echo '</ul>';
}

function omnitech_filter_privacy_nav_item(array $items, stdClass $args): array
{
    if (!in_array($args->theme_location ?? '', ['primary', 'footer'], true)) {
        return $items;
    }

    $privacy_path = untrailingslashit((string) wp_parse_url(home_url('/privacy/'), PHP_URL_PATH));

    return array_values(array_filter($items, static function ($item) use ($privacy_path): bool {
        $item_path = untrailingslashit((string) wp_parse_url($item->url ?? '', PHP_URL_PATH));
        return $item_path !== $privacy_path;
    }));
}
add_filter('wp_nav_menu_objects', 'omnitech_filter_privacy_nav_item', 10, 2);

function omnitech_footer_nav_fallback(): void
{
    echo '<ul class="omnitech-footer-nav">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'omnitech') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about/')) . '">' . esc_html__('About', 'omnitech') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/solutions/')) . '">' . esc_html__('Solutions & Services', 'omnitech') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact/')) . '">' . esc_html__('Contact', 'omnitech') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/careers/')) . '">' . esc_html__('Careers', 'omnitech') . '</a></li>';
    echo '</ul>';
}

function omnitech_mark(string $accent = '#B4D33D', int $size = 42): string
{
    $accent = esc_attr($accent);
    $size = max(16, $size);

    return <<<SVG
<svg class="c-mark" width="{$size}" height="{$size}" viewBox="0 0 64 64" aria-hidden="true" focusable="false">
  <path fill="#234576" d="M48.5 10.2C33.2 9.2 20 19.6 20 32.4 20 46 33.6 55.6 48.8 54.2l-4.1-8.6c-8.4.4-15.2-5.4-15.2-13.2 0-7.6 6.5-13.2 14.8-12.8l4.2-9.4z"/>
  <path fill="{$accent}" d="M52 16.4c-9.6-.2-17.2 6.2-17.2 15.8 0 9.2 7.2 15.4 16.6 15.2l-3.2-7.6c-6.2.2-10.4-3.6-10.4-7.6 0-4.2 4.4-7.8 10.6-7.6l3.6-8.2z"/>
</svg>
SVG;
}

function omnitech_enqueue_assets(): void
{
    $theme_version = wp_get_theme()->get('Version');

    wp_enqueue_style(
        'omnitech-fonts',
        'https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600&family=Manrope:wght@400;500;600;700;800&family=Syne:wght@600;700;800&display=swap',
        [],
        null
    );
    wp_enqueue_style('omnitech-theme', get_stylesheet_uri(), [], $theme_version);
    wp_enqueue_style(
        'omnitech-site',
        get_template_directory_uri() . '/assets/css/style.css',
        ['omnitech-theme'],
        $theme_version
    );
    wp_enqueue_script(
        'omnitech-site',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        $theme_version,
        true
    );
}
add_action('wp_enqueue_scripts', 'omnitech_enqueue_assets');

function omnitech_register_careers(): void
{
    register_post_type('omnitech_job', [
        'labels' => [
            'name' => __('Open Positions', 'omnitech'),
            'singular_name' => __('Position', 'omnitech'),
            'add_new_item' => __('Add Position', 'omnitech'),
            'edit_item' => __('Edit Position', 'omnitech'),
            'view_item' => __('View Position', 'omnitech'),
            'search_items' => __('Search Positions', 'omnitech'),
        ],
        'public' => true,
        'has_archive' => 'careers',
        'rewrite' => ['slug' => 'career'],
        'menu_icon' => 'dashicons-id-alt',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'omnitech_register_careers');

function omnitech_order_career_archive(WP_Query $query): void
{
    if (!is_admin() && $query->is_main_query() && $query->is_post_type_archive('omnitech_job')) {
        $query->set('orderby', 'ID');
        $query->set('order', 'ASC');
    }
}
add_action('pre_get_posts', 'omnitech_order_career_archive');

function omnitech_add_job_application_box(): void
{
    add_meta_box(
        'omnitech_job_application_form',
        __('Application Form', 'omnitech'),
        'omnitech_render_job_application_box',
        'omnitech_job',
        'normal'
    );
}
add_action('add_meta_boxes', 'omnitech_add_job_application_box');

function omnitech_render_job_application_box(WP_Post $post): void
{
    wp_nonce_field('omnitech_save_job_application_form', 'omnitech_job_application_nonce');
    $shortcode = get_post_meta($post->ID, '_omnitech_application_form', true);
    ?>
    <label for="omnitech-application-form"><?php esc_html_e('Application form shortcode', 'omnitech'); ?></label>
    <textarea id="omnitech-application-form" name="omnitech_application_form" rows="3" class="widefat"><?php echo esc_textarea($shortcode); ?></textarea>
    <?php
}

function omnitech_save_job_application_form(int $post_id): void
{
    if (
        !isset($_POST['omnitech_job_application_nonce'])
        || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['omnitech_job_application_nonce'])), 'omnitech_save_job_application_form')
        || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        || !current_user_can('edit_post', $post_id)
        || !isset($_POST['omnitech_application_form'])
    ) {
        return;
    }

    update_post_meta(
        $post_id,
        '_omnitech_application_form',
        sanitize_textarea_field(wp_unslash($_POST['omnitech_application_form']))
    );
}
add_action('save_post_omnitech_job', 'omnitech_save_job_application_form');

function omnitech_customize_register(WP_Customize_Manager $customizer): void
{
    $customizer->add_section('omnitech_contact', [
        'title' => __('OMNITECH Contact Details', 'omnitech'),
        'priority' => 35,
    ]);

    $customizer->add_setting('omnitech_employee_portal', [
        'default' => 'https://columbiaedp.evolutionpayroll.com/ess#/login',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $customizer->add_control('omnitech_employee_portal', [
        'label' => __('Employee portal URL', 'omnitech'),
        'section' => 'omnitech_contact',
        'type' => 'url',
    ]);

    $customizer->add_setting('omnitech_contact_email', [
        'default' => 'contact@omnitechsys.com',
        'sanitize_callback' => 'sanitize_email',
    ]);
    $customizer->add_control('omnitech_contact_email', [
        'label' => __('Contact email', 'omnitech'),
        'section' => 'omnitech_contact',
        'type' => 'email',
    ]);
}
add_action('customize_register', 'omnitech_customize_register');

function omnitech_contact_form_shortcode(): string
{
    $interest = sanitize_text_field(wp_unslash($_GET['interest'] ?? ''));
    $status = sanitize_key(wp_unslash($_GET['contact_status'] ?? ''));
    $feedback = '';

    if ($status === 'sent') {
        $feedback = '<p class="notice notice-success" role="status">Thank you. Your message has been received and our team will respond shortly.</p>';
    } elseif ($status === 'error') {
        $feedback = '<p class="notice notice-error" role="alert">We could not send your message. Please email <a href="mailto:contact@omnitechsys.com">contact@omnitechsys.com</a> directly.</p>';
    }

    return $feedback
        . '<form method="post" action="' . esc_url(admin_url('admin-post.php')) . '">'
        . '<input type="hidden" name="action" value="omnitech_contact">'
        . wp_nonce_field('omnitech_contact_form', 'omnitech_contact_nonce', true, false)
        . '<input type="hidden" name="interest" value="' . esc_attr($interest) . '">'
        . '<p class="hp"><label for="company_website">Company website</label><input id="company_website" name="company_website" type="text" tabindex="-1" autocomplete="off"></p>'
        . '<label for="omnitech-name">Name</label><input id="omnitech-name" name="name" type="text" required maxlength="120" placeholder="Your Name">'
        . '<label for="omnitech-email">Email Address</label><input id="omnitech-email" name="email" type="email" required maxlength="180" placeholder="Your Email">'
        . '<label for="omnitech-message">Message</label><textarea id="omnitech-message" name="message" required maxlength="4000" minlength="10" rows="5" placeholder="Enter Your Message"></textarea>'
        . '<button class="btn btn-solid btn-block" type="submit">Send Message</button></form>';
}
add_shortcode('omnitech_contact_form', 'omnitech_contact_form_shortcode');

function omnitech_handle_contact_submission(): void
{
    check_admin_referer('omnitech_contact_form', 'omnitech_contact_nonce');

    $referer = wp_get_referer() ?: home_url('/contact/');
    $status = 'error';
    $honeypot = sanitize_text_field(wp_unslash($_POST['company_website'] ?? ''));
    $name = sanitize_text_field(wp_unslash($_POST['name'] ?? ''));
    $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $interest = sanitize_text_field(wp_unslash($_POST['interest'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));

    if ($honeypot !== '') {
        $status = 'sent';
    } elseif (mb_strlen($name) >= 2 && is_email($email) && mb_strlen($message) >= 10) {
        $recipient = sanitize_email(get_theme_mod('omnitech_contact_email', 'contact@omnitechsys.com'));
        $subject = 'Website inquiry from ' . $name;
        $body = "Name: {$name}\nEmail: {$email}\nInterest: {$interest}\n\n{$message}";
        if ($recipient && wp_mail($recipient, $subject, $body, ['Reply-To: ' . $name . ' <' . $email . '>'])) {
            $status = 'sent';
        }
    }

    wp_safe_redirect(add_query_arg('contact_status', $status, remove_query_arg('contact_status', $referer)));
    exit;
}
add_action('admin_post_omnitech_contact', 'omnitech_handle_contact_submission');
add_action('admin_post_nopriv_omnitech_contact', 'omnitech_handle_contact_submission');

function omnitech_flush_rewrites(): void
{
    omnitech_register_careers();
    omnitech_seed_site_content();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'omnitech_flush_rewrites');

function omnitech_seed_page(string $title, string $slug, string $excerpt, string $content): int
{
    if (function_exists('omnitech_source_page_content')) {
        $content = omnitech_source_page_content($slug) ?? $content;
    }
    $existing_page = get_page_by_path($slug, OBJECT, 'page');
    if ($existing_page instanceof WP_Post) {
        wp_update_post([
            'ID' => $existing_page->ID,
            'post_title' => $title,
            'post_name' => $slug,
            'post_excerpt' => $excerpt,
            'post_content' => $content,
            'post_status' => 'publish',
        ], true);

        return (int) $existing_page->ID;
    }

    $page_id = wp_insert_post([
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_title' => $title,
        'post_name' => $slug,
        'post_excerpt' => $excerpt,
        'post_content' => $content,
    ], true);

    return is_wp_error($page_id) ? 0 : (int) $page_id;
}

function omnitech_seed_job(string $title, string $slug, string $excerpt, string $content): void
{
    $content = omnitech_source_job_content($slug) ?? $content;
    $existing_job = get_page_by_path($slug, OBJECT, 'omnitech_job');
    if ($existing_job instanceof WP_Post) {
        wp_update_post([
            'ID' => $existing_job->ID,
            'post_title' => $title,
            'post_name' => $slug,
            'post_excerpt' => $excerpt,
            'post_content' => $content,
            'post_status' => 'publish',
        ], true);

        return;
    }

    wp_insert_post([
        'post_type' => 'omnitech_job',
        'post_status' => 'publish',
        'post_title' => $title,
        'post_name' => $slug,
        'post_excerpt' => $excerpt,
        'post_content' => $content,
    ]);
}

function omnitech_seed_site_home(): int
{
    $home_id = omnitech_seed_page(
        'The Accountable Enterprise',
        'home',
        'OMNITECH Systems delivers cost-effective, scalable, and dependable enterprise IT solutions for commercial and federal clients.',
        '<section class="section services-home"><div class="container center"><p class="eyebrow">What we do</p><h2>Enterprise IT Solutions &amp; Services</h2><div class="pill-grid"><a class="service-pill" href="solutions/#data-management">Data Management</a><a class="service-pill" href="solutions/#clm">Contract Lifecycle Management</a><a class="service-pill" href="solutions/#analytics-ai">Analytics &amp; AI</a><a class="service-pill" href="solutions/#devops">DevOps &amp; Infrastructure</a><a class="service-pill" href="solutions/#application-development">Application Development &amp; Support</a><a class="service-pill" href="solutions/#strategic-consulting">Strategic Consulting</a><a class="service-pill" href="solutions/#database">Database Design &amp; Administration</a></div></div></section><section class="partner-band"><div class="container"><div class="partner-panel"><h2>OMNITECH: YOUR ACCOUNTABLE IT PARTNER</h2><p>From data architecture, analytics, AI/ML, and data management to software development, cloud computing, virtualization, and DevOps, our clients trust us to deliver relevant solutions and prepare them for future success.</p><p>OMNITECH Systems delivers solutions and the means and methods to sustain them, powered by a commitment to exceptional customer experience.</p></div></div></section><section class="section clients-section"><div class="container center"><h2 class="clients-title">Representative Clients That Trust OMNITECH</h2><ul class="client-grid"><li>Merrill</li><li>FIS</li><li>SunTrust</li><li>Freddie Mac</li><li>Booz Allen Hamilton</li><li>NSF</li><li>The World Bank</li><li>IFC</li><li>CACI</li><li>Autodesk</li><li>Societe Generale</li><li>Citigroup</li><li>Sodexo</li><li>TECAN</li><li>SanDisk</li><li>PTC</li><li>Fannie Mae</li></ul></div></section><section class="section"><div class="container"><p class="eyebrow">Join the team</p><h2>Careers</h2><p class="narrow">Find a place where you can join a team and grow your career.</p><div class="job-list"><article class="job-row"><h3>AI/ML Developer</h3><a class="btn btn-outline lime" href="career/ai-ml-developer/">View Position</a></article><article class="job-row"><h3>Enterprise Data Architect</h3><a class="btn btn-outline lime" href="career/enterprise-data-architect/">View Position</a></article><article class="job-row"><h3>Lead Data Scientist</h3><a class="btn btn-outline lime" href="career/lead-data-scientist/">View Position</a></article></div></div></section>'
    );

    return $home_id;
}

function omnitech_source_page_content(string $slug): ?string
{
    $base = get_template_directory_uri() . '/assets/img/';

    if ($slug === 'about') {
        return '<section class="about-story"><div class="container story-copy"><p class="eyebrow lime">Our History and Purpose</p>'
            . '<p>OMNITECH Systems is a Software Solutions and Software Services provider that caters to a wide range of U.S based and international firms and the Federal and State governments.</p>'
            . '<p>Headquartered in the Washington DC Metropolitan area, OMNITECH was established in 1999 as a minority-owned small business by IT Professionals with diverse experience in the field of Software Development and IT Consulting for fortune 500 companies.</p>'
            . '<p>In keeping with our goal of being “The Accountable Enterprise”, OMNITECH’s profitably managed growth is due in part to our expert team’s razor focus on the customer’s needs and commitment to deliver the highest quality service possible.</p>'
            . '<p class="story-close">Reach us today for a free assessment of your business needs.</p></div></section>'
            . '<section class="badges"><div class="container badge-row"><img class="cert-badge" src="' . esc_url($base . 'sba-badge.png') . '" alt="SBA Certified Small Disadvantaged Business">'
            . '<img class="cert-badge" src="' . esc_url($base . 'gsa-badge.png') . '" alt="GSA IT Schedule 70"></div></section>';
    }

    if ($slug === 'solutions') {
        $services = [
            ['data-management', 'Data Management', ['Data Architecture and Engineering', 'Data Warehousing', 'Data Migration', 'Data Quality']],
            ['clm', 'Contract Lifecycle Management (CLM)', ['CLM Vendor (Product) Selection', 'CLM Strategy', 'CLM Readiness', 'CLM Implementation', 'Data Extraction &amp; Data Migration', 'Managed Services']],
            ['analytics-ai', 'Analytics &amp; AI', ['Data Analytics', 'Data Visualization', 'AI/ML']],
            ['devops', 'DevOps &amp; Infrastructure', ['IaaS, SaaS &amp; PaaS', 'Grid Computing', 'IBM Platform Product Suite', 'AWS, Azure, VMware']],
            ['application-development', 'Application Development &amp; Support', ['Salesforce', 'ServiceNow', 'Full Stack Development', 'Waterfall &amp; Agile Methodologies']],
            ['strategic-consulting', 'Strategic Consulting', ['Enterprise Data Strategy', 'IT Strategy', 'Network &amp; Storage Strategy', 'Re-Platforming', 'Legacy DB platform migrations (For eg., Sybase to PostgreSQL, Oracle to MySQL, etc.)']],
            ['database', 'Database Design &amp; Administration', ['AWS RDS, AWS Aurora, PostgreSQL, ORACLE, Sybase, MS-SQL Server Administration &amp; Support', 'Database Design &amp; Architecture', 'Performance Tuning']],
        ];
        $cards = '';
        foreach ($services as [$service_slug, $title, $items]) {
            $list = '';
            foreach ($items as $item) {
                $list .= '<li>' . $item . '</li>';
            }
            $contact_url = add_query_arg('interest', wp_strip_all_tags($title), home_url('/contact/'));
            $cards .= '<article class="solution-card" id="' . esc_attr($service_slug) . '">' . omnitech_mark('#B4D33D', 54)
                . '<h2>' . $title . '</h2><ul>' . $list . '</ul><a class="btn btn-solid" href="' . esc_url($contact_url) . '">Learn More</a></article>';
        }

        return '<section class="section"><div class="container center">' . omnitech_mark('#B4D33D', 48)
            . '<p class="eyebrow">IT Solutions &amp; Services</p></div><div class="container card-grid">' . $cards
            . '</div></section><section class="section alliances"><div class="container center"><h2>Key Technology Expertise and Industry Alliances</h2></div>'
            . '<ul class="alliance-grid"><li>Conga</li><li>Agiloft</li><li>Ironclad</li><li>Malbek</li><li>DocuSign</li><li>LEAH</li><li>IntelAgree</li><li>Zoho Contracts</li></ul></section>';
    }

    if ($slug === 'contact') {
        $windows = '';
        for ($row = 0; $row < 5; $row++) {
            for ($column = 0; $column < 9; $column++) {
                $windows .= '<rect x="' . (112 + $column * 34) . '" y="' . (142 + $row * 12) . '" width="18" height="7" rx="1"/>';
            }
        }
        $building = '<div class="building" aria-hidden="true"><svg viewBox="0 0 520 250"><rect width="520" height="250" fill="#d7e4ea"/>'
            . '<path d="M40 210h440v16H40z" fill="#8ea0a8"/><path d="M70 210 V120 C140 70 380 70 450 120 V210z" fill="#8aa0ad"/>'
            . '<path d="M90 210 V132 C150 92 370 92 430 132 V210z" fill="#1d4e78"/><g fill="#d5e7f2" opacity=".85">' . $windows . '</g>'
            . '<rect x="230" y="176" width="60" height="34" fill="#12324e"/><circle cx="90" cy="188" r="16" fill="#6ea36a"/>'
            . '<circle cx="430" cy="184" r="22" fill="#5d9460"/></svg></div>';
        return '<section class="section contact-section"><div class="container"><div class="contact-card"><div class="contact-grid">'
            . '<div class="contact-info">' . omnitech_mark('#B4D33D', 48) . '<h2>Office Address</h2><p>8300 Boone Blvd, Suite 500<br>Vienna, VA 22182</p>'
            . '<h2>Contact Info</h2><p><a href="tel:+17032812340">+1 703-281-2340 (Phone)</a><br><span>+1 703-291-2343 (Fax)</span><br>'
            . '<a href="https://www.omnitechsys.com">www.omnitechsys.com</a><br><a href="mailto:contact@omnitechsys.com">contact@omnitechsys.com</a></p></div>'
            . '<div class="contact-form-wrap">' . $building . '<h2>Engage with OMNITECH</h2><p>For inquiries, email <a href="mailto:contact@omnitechsys.com">contact@omnitechsys.com</a>.</p>[omnitech_contact_form]</div>'
            . '</div></div><ul class="alliance-grid contact-alliances"><li>Conga</li><li>Agiloft</li><li>Ironclad</li><li>Malbek</li><li>DocuSign</li><li>LEAH</li><li>IntelAgree</li><li>Zoho Contracts</li></ul></div></section>';
    }

    if ($slug === 'privacy') {
        return <<<'HTML'
<div class="prose">
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
<ul><li>Name, phone, company, comments, and interests: to respond to inquiries and provide requested information, products, or services.</li><li>Email address: to reply to inquiries and, where you have asked for them, send notices about services, events, or news.</li><li>Resume and application details: to evaluate you for a role you applied for. Resumes sent to the general contact inbox are not accepted.</li><li>Device and browsing data: to understand how the site is used, keep it reliable, and protect it.</li></ul>
<h2>Use of Your Information</h2><p>We use personal information to manage your relationship with Omnitech, respond to you, and improve the Services. We may also use it to protect legal rights, privacy, safety, or property, and to comply with applicable law.</p>
<h2>Sharing Your Information</h2><p>In the ordinary course of business Omnitech does not sell, trade, or rent your individual identifying information. Consistent with applicable law, information may be shared with subsidiaries and affiliates; with service providers who host data or support the site; when required by law or to protect the Services; if a business or assets are sold or transferred; and when you or your organization consent.</p><p>Information may be transferred outside your country to a country that does not have similar data protection legislation. By using the Services or providing information you consent to those transfers.</p>
<h2>Links to Other Websites</h2><p>The Services may link to third-party sites, including the employee portal and LinkedIn. Omnitech is not responsible for the privacy or security practices of those sites.</p>
<h2>Choice and Opt-Out</h2><p>Marketing messages include a way to decline future communications. You can also opt out by emailing <a href="mailto:contact@omnitechsys.com">contact@omnitechsys.com</a>.</p>
<h2>Cookies and Similar Technologies</h2><p>This site uses a session cookie so contact and application forms can include a security token. The cookie is not used for advertising. You can refuse cookies in your browser; the forms need the session cookie in order to submit.</p>
<h2>Protection of Information</h2><p>Omnitech uses reasonable safeguards for information under our control. No internet transmission can be guaranteed. Omnitech assumes no liability for disclosure caused by transmission errors or unauthorized third parties.</p>
<h2>Children’s Information</h2><p>The Services are intended for adults and organizations interested in Omnitech. They are not intended for children, and Omnitech does not knowingly collect personal information about children under 13.</p>
<h2>Changes to this Privacy Statement</h2><p>We may revise this statement as technology, legal requirements, or the Services change. Updates will be posted on this page.</p>
<h2>Do Not Track</h2><p>Some browsers send a “do-not-track” signal. We do not currently change site behavior in response to that signal.</p>
<h2>Access and Correction</h2><ul><li>We take reasonable steps to verify identity before granting access or making corrections.</li><li>We do not place a fee on ordinary access requests, and we may decline unreasonable requests and explain why.</li><li>If information is not kept in retrievable form, we will explain how that type of information is collected and used.</li><li>If information is retrievable, we aim to respond within fifteen working days. Access is provided by disclosure and does not include direct access to our repositories.</li></ul>
<h2>Questions and Contact Information</h2><p>Questions about this statement can be sent to <a href="mailto:contact@omnitechsys.com">contact@omnitechsys.com</a> or by mail to 8300 Boone Blvd, Suite 500, Vienna, VA 22182.</p><p>CVs and resumes sent to the general inbox will not be accepted. To apply for a job, use the <a href="/wordpress/careers/">Careers</a> section.</p>
</div>
HTML;
    }

    return null;
}

function omnitech_source_job_content(string $slug): ?string
{
    $jobs = [
        'ai-ml-developer' => [
            'intro' => 'We are looking for an AI/ML Developer with the following skills and experience:',
            'location' => 'Northern Virginia (Currently Remote)',
            'sections' => [
                ['Responsibilities', [
                    'Strong development experience on emerging technologies using AI/ML services.',
                    'Experience in all phases of the software development life cycle (SDLC), including design, development, and maintenance of applications.',
                    'Prototype, develop, and analyze software.',
                    'Perform peer reviews on source code to ensure reuse, scalability, and the use of best practices.',
                    'Participate in collaborative technical discussions that focus on software design, architecture, and development as well as user experience.',
                    'Provide continuous feedback to refine current practices, promote timely software release cycles, and improve agile methods.',
                ]],
                ['Requirements', [
                    '5+ years of experience with a software development team',
                    '3+ years of experience with agile methodologies',
                    'Experience with C#',
                    'Experience with implementing RESTful APIs',
                    'Experience with Natural Language Processing or chatbot development',
                    'Knowledge of database concepts and CRUD operations',
                    'Experience with Azure Cloud Services',
                    'Experience with JavaScript',
                    'Experience with Python',
                    'Experience with mentoring junior developers',
                    'Professional experience in the AI or Data Science field',
                    'MS degree in CS or an IT related field',
                ]],
            ],
        ],
        'enterprise-data-architect' => [
            'intro' => 'We are looking for an Enterprise Data Architect with the following skill sets.',
            'location' => 'Northern Virginia (Currently Remote)',
            'body' => 'An enterprise data architect’s primary goal is to keep data easily accessible and accurate. To meet that goal, this architect reviews, refines and implements data standards. Examples of data standards include those that define how data is categorized or how alphanumeric codes are assigned to represent specific products, customers and other data types. After gathering information about data use in the workplace, this architect creates a blueprint or road map, showing processes and services that affect data use and data standards. The architect then works with project managers and business stakeholders to implement that design.',
            'sections' => [
                ['Qualifications', [
                    '8+ years of relevant hands-on technical experience in an enterprise environment',
                    'Preference will be given to those with strong experience in an Agile/DevOps environment.',
                    'Demonstrable senior-level expertise in Cloud Services and Solutions; Database Administration and Development; Analytical Sciences; Information Technology Governance; Information Security; Information Technology Resource Management; Business Case; Business Scenario; Business Process Design; Strategic Planning; and Business Functions.',
                ]],
            ],
        ],
        'lead-data-scientist' => [
            'intro' => 'We are looking for a Lead Data Scientist to extract and analyze data from different types of documents. You will be working with large data sets combining structured and unstructured data. You will be building a team of Data Scientists to develop products and tools.',
            'location' => 'Northern Virginia (Currently Remote)',
            'sections' => [
                ['Essential Duties and Responsibilities', [
                    'Develop and apply the latest innovations in machine learning, artificial intelligence, and related technologies.',
                    'Lead and support research and development efforts to explore the applicability of emerging machine learning and artificial intelligence methods to address client challenges and identify and prioritize emerging methods and challenges for original research or proof of concepts.',
                    'Lead and support efforts to identify, shape, capture, and deliver data science, machine learning, and artificial intelligence contracts.',
                    'Work with clients and internal teams to build analytic strategies, technology roadmaps, implementation plans, and research initiatives.',
                    'Lead and develop a strong team of data scientists, data engineers, machine learning engineers, and artificial intelligence specialists.',
                ]],
                ['Minimum Qualifications', [
                    'Over 5 years of experience with machine learning techniques (clustering, decision tree learning, artificial neural networks, natural language processing, and similar methods) and algorithms for addressing a variety of problems.',
                    'Over 5 years of experience leading or managing delivery teams, projects, and development efforts.',
                    'Over 3 years of experience with programming, including machine learning frameworks (TensorFlow, PyTorch), Python, and Spark.',
                    'Very strong experience with distributed data and computing tools: MapReduce, Hadoop, Hive, Spark, and MySQL.',
                    'Experience with business development and client or customer relationship management.',
                    'Experience developing effective delivery or research teams, including recruiting, hiring, mentoring, coaching, and managing team members.',
                    'Ability to communicate results to both technical and non-technical audiences, including presenting to senior executives.',
                    'BA or BS degree in Statistics, Machine Learning, Mathematics, Computer Science, Computer Engineering, Industrial Engineering, or Operations Research.',
                ]],
                ['Preferred Qualifications', [
                    'MS degree in Science, Engineering, Mathematics, or a related field preferred; PhD degree a plus.',
                ]],
            ],
        ],
    ];

    if (!isset($jobs[$slug])) {
        return null;
    }

    $job = $jobs[$slug];
    $content = '<p>' . esc_html($job['intro']) . '</p>';
    if (isset($job['body'])) {
        $content .= '<p>' . esc_html($job['body']) . '</p>';
    }
    foreach ($job['sections'] as [$heading, $items]) {
        $content .= '<h2>' . esc_html($heading) . '</h2><ul>';
        foreach ($items as $item) {
            $content .= '<li>' . esc_html($item) . '</li>';
        }
        $content .= '</ul>';
    }
    $content .= '<p><strong>Location:</strong> ' . esc_html($job['location']) . '</p>';

    return $content;
}

function omnitech_seed_site_content(): void
{
    if ((int) get_option('omnitech_content_seed_version', 0) >= 2) {
        return;
    }

    $home_id = omnitech_seed_site_home();
    $about_id = omnitech_seed_page(
        'About Us',
        'about',
        'OMNITECH Systems is a minority-owned software solutions and services firm serving commercial and government clients since 1999.',
        '<section class="about-story"><div class="container story-copy"><p class="eyebrow lime">Our History and Purpose</p><p>OMNITECH Systems is a software solutions and services provider serving U.S. and international firms and federal and state governments.</p><p>Headquartered in the Washington, DC metropolitan area, OMNITECH was established in 1999 as a minority-owned small business by IT professionals with diverse software development and IT consulting experience.</p><p>Our growth is rooted in a focus on customer needs and a commitment to delivering high-quality services.</p><p class="story-close">Reach us today for an assessment of your business needs.</p></div></section>' . '<section class="badges"><div class="container badge-row"><img class="cert-badge" src="' . esc_url(get_template_directory_uri()) . '/assets/img/sba-badge.png" alt="SBA Certified Small Disadvantaged Business"><img class="cert-badge" src="' . esc_url(get_template_directory_uri()) . '/assets/img/gsa-badge.png" alt="GSA IT Schedule 70"></div></section>'
    );

    $solutions_id = omnitech_seed_page(
        'Solutions & Services',
        'solutions',
        'Enterprise IT solutions in data management, CLM, analytics, DevOps, application development, consulting, and database administration.',
        '<section class="section"><div class="container center"><p class="eyebrow">IT Solutions &amp; Services</p><h2>Enterprise IT Solutions &amp; Services</h2></div><div class="container card-grid"><article class="solution-card" id="data-management"><h2>Data Management</h2><ul><li>Data Architecture and Engineering</li><li>Data Warehousing</li><li>Data Migration</li><li>Data Quality</li></ul></article><article class="solution-card" id="clm"><h2>Contract Lifecycle Management (CLM)</h2><ul><li>CLM Vendor Selection</li><li>CLM Strategy and Readiness</li><li>CLM Implementation</li><li>Data Extraction and Migration</li><li>Managed Services</li></ul></article><article class="solution-card" id="analytics-ai"><h2>Analytics &amp; AI</h2><ul><li>Data Analytics</li><li>Data Visualization</li><li>AI/ML</li></ul></article><article class="solution-card" id="devops"><h2>DevOps &amp; Infrastructure</h2><ul><li>IaaS, SaaS &amp; PaaS</li><li>Grid Computing</li><li>IBM Platform Product Suite</li><li>AWS, Azure, VMware</li></ul></article><article class="solution-card" id="application-development"><h2>Application Development &amp; Support</h2><ul><li>Salesforce</li><li>ServiceNow</li><li>Full Stack Development</li><li>Waterfall &amp; Agile Methodologies</li></ul></article><article class="solution-card" id="strategic-consulting"><h2>Strategic Consulting</h2><ul><li>Enterprise Data Strategy</li><li>IT Strategy</li><li>Network &amp; Storage Strategy</li><li>Re-Platforming</li></ul></article><article class="solution-card" id="database"><h2>Database Design &amp; Administration</h2><ul><li>AWS RDS, Aurora, PostgreSQL, Oracle, Sybase, and MS-SQL Server</li><li>Database Design &amp; Architecture</li><li>Performance Tuning</li></ul></article></div></section><section class="section alliances"><div class="container center"><h2>Key Technology Expertise and Industry Alliances</h2><ul class="alliance-grid"><li>Conga</li><li>Agiloft</li><li>Ironclad</li><li>Malbek</li><li>DocuSign</li><li>LEAH</li><li>IntelAgree</li><li>Zoho Contracts</li></ul></div></section>'
    );

    $contact_id = omnitech_seed_page(
        'Contact Us',
        'contact',
        'Contact OMNITECH Systems in Vienna, Virginia to discuss enterprise IT solutions.',
        '<section class="section"><div class="container"><div class="contact-card contact-grid"><div class="contact-info"><h2>Office Address</h2><p>8300 Boone Blvd, Suite 500<br>Vienna, VA 22182</p><h2>Contact Info</h2><p><a href="tel:+17032812340">+1 703-281-2340 (Phone)</a><br>+1 703-291-2343 (Fax)<br><a href="https://www.omnitechsys.com">www.omnitechsys.com</a><br><a href="mailto:contact@omnitechsys.com">contact@omnitechsys.com</a></p></div><div class="contact-form-wrap"><h2>Engage with OMNITECH</h2><p>For inquiries, email <a href="mailto:contact@omnitechsys.com">contact@omnitechsys.com</a>.</p></div></div></div></section><section class="section alliances"><div class="container center"><h2>Technology Alliances</h2><ul class="alliance-grid"><li>Conga</li><li>Agiloft</li><li>Ironclad</li><li>Malbek</li><li>DocuSign</li><li>LEAH</li><li>IntelAgree</li><li>Zoho Contracts</li></ul></div></section>'
    );

    $privacy_id = omnitech_seed_page(
        'Privacy Policy',
        'privacy',
        'Privacy statement for the OMNITECH Systems website.',
        '<div class="prose"><h2>OMNITECH Systems Privacy</h2><p>OMNITECH Systems recognizes the importance of protecting your information. Information submitted through this website may include your name, email address, phone number, message, and resume.</p><h2>How We Use Information</h2><p>We use information to respond to inquiries, provide requested services, evaluate job applications, maintain the website, and protect its users.</p><h2>Sharing and Security</h2><p>We do not sell personal information. Information may be shared with service providers supporting the website or when required by law. We use reasonable safeguards, but no internet transmission can be guaranteed secure.</p><h2>Cookies</h2><p>This website may use cookies required for its features and forms.</p><h2>Questions</h2><p>Contact <a href="mailto:contact@omnitechsys.com">contact@omnitechsys.com</a> with privacy questions.</p></div>'
    );

    omnitech_seed_job(
        'AI/ML Developer',
        'ai-ml-developer',
        'Join the team building software with AI and machine learning services.',
        '<p>We are looking for an AI/ML Developer with experience building and maintaining modern applications.</p><h2>Responsibilities</h2><ul><li>Design, develop, and maintain applications using emerging AI/ML services.</li><li>Participate in software design, architecture, code reviews, and agile delivery.</li><li>Develop RESTful APIs and collaborate with technical teams.</li></ul><h2>Requirements</h2><ul><li>Experience with C#, REST APIs, JavaScript, and Python.</li><li>Experience with NLP, chatbot development, or Azure services.</li><li>Knowledge of database concepts and the software development lifecycle.</li></ul><p><strong>Location:</strong> Northern Virginia (currently remote)</p>'
    );
    omnitech_seed_job(
        'Enterprise Data Architect',
        'enterprise-data-architect',
        'Help define and deliver enterprise data standards and architecture.',
        '<p>We are looking for an Enterprise Data Architect to keep organizational data accessible, consistent, and accurate.</p><h2>Responsibilities</h2><ul><li>Review and implement data standards.</li><li>Create architecture roadmaps connecting data processes and services.</li><li>Work with project managers and stakeholders to deliver data designs.</li></ul><h2>Qualifications</h2><ul><li>8+ years of relevant hands-on technical experience in an enterprise environment.</li><li>Experience with cloud services, database platforms, analytics, governance, and strategic planning.</li></ul><p><strong>Location:</strong> Northern Virginia (currently remote)</p>'
    );
    omnitech_seed_job(
        'Lead Data Scientist',
        'lead-data-scientist',
        'Lead data science teams building machine-learning products and tools.',
        '<p>Lead research and delivery efforts using machine learning, artificial intelligence, and data science.</p><h2>Responsibilities</h2><ul><li>Apply modern machine-learning methods to client challenges.</li><li>Build analytic strategies, roadmaps, and proof-of-concept solutions.</li><li>Lead and mentor data scientists, engineers, and AI specialists.</li></ul><h2>Qualifications</h2><ul><li>Experience with machine learning, Python, TensorFlow or PyTorch, and Spark.</li><li>Experience leading delivery teams and communicating results to technical and executive audiences.</li></ul><p><strong>Location:</strong> Northern Virginia (currently remote)</p>'
    );

    if ($home_id && get_option('show_on_front') !== 'page') {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_id);
    } elseif ($home_id && !get_option('page_on_front')) {
        update_option('page_on_front', $home_id);
    }

    $menu = wp_get_nav_menu_object('OMNITECH Main Menu');
    if (!$menu) {
        $menu_id = wp_create_nav_menu('OMNITECH Main Menu');
        if (!is_wp_error($menu_id)) {
            $menu_pages = [
                ['Home', $home_id],
                ['About', $about_id],
                ['Solutions & Services', $solutions_id],
                ['Contact', $contact_id],
            ];
            foreach ($menu_pages as [$label, $page_id]) {
                if ($page_id) {
                    wp_update_nav_menu_item($menu_id, 0, [
                        'menu-item-title' => $label,
                        'menu-item-object' => 'page',
                        'menu-item-object-id' => $page_id,
                        'menu-item-type' => 'post_type',
                        'menu-item-status' => 'publish',
                    ]);
                }
            }
            wp_update_nav_menu_item($menu_id, 0, [
                'menu-item-title' => __('Careers', 'omnitech'),
                'menu-item-url' => home_url('/careers/'),
                'menu-item-type' => 'custom',
                'menu-item-status' => 'publish',
            ]);

            $locations = get_theme_mod('nav_menu_locations', []);
            $locations['primary'] = (int) $menu_id;
            $locations['footer'] = (int) $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
    }

    update_option('omnitech_content_seeded', 1);
    update_option('omnitech_content_seed_version', 2);
}

function omnitech_maybe_seed_site_content(): void
{
    if (current_user_can('manage_options')) {
        omnitech_seed_site_content();
    }
}
add_action('admin_init', 'omnitech_maybe_seed_site_content');

function omnitech_alliance_logo_markup(): string
{
    $logos = [
        ['Autodesk', 'autodesk.png'],
        ['ServiceNow', 'servicenow.png'],
        ['VMware', 'vmware.png'],
        ['MSDN', 'msdn.png'],
        ['Salesforce', 'salesforce.png'],
        ['SAP', 'sap.png'],
        ['Microsoft Azure', 'azure.png'],
        ['Amazon Web Services', 'aws.png'],
    ];
    $items = '';
    foreach ($logos as [$name, $file]) {
        $items .= '<li><img src="' . esc_url(get_template_directory_uri() . '/assets/img/alliances/' . $file) . '" alt="' . esc_attr($name) . '"></li>';
    }
    $list = '<ul class="alliance-logos">' . $items . '</ul>';
    $hidden = '<ul class="alliance-logos" aria-hidden="true">' . $items . '</ul>';

    return '<div class="marquee"><div class="marquee-track">' . $list . $hidden . '</div></div>';
}

function omnitech_solutions_alliance_logos(string $content): string
{
    if (!is_page('solutions')) {
        return $content;
    }
    $replaced = preg_replace(
        '/<ul class="alliance-grid">.*?<\/ul>/s',
        omnitech_alliance_logo_markup(),
        $content,
        1,
        $count
    );

    return $count ? $replaced : $content;
}
add_filter('the_content', 'omnitech_solutions_alliance_logos');

function omnitech_about_cert_badges(string $content): string
{
    if (!is_page('about') || !str_contains($content, 'class="badge-mark"')) {
        return $content;
    }

    $base = get_template_directory_uri();
    $markup = '<section class="badges"><div class="container badge-row">'
        . '<img class="cert-badge" src="' . esc_url($base . '/assets/img/sba-badge.png') . '" alt="SBA Certified Small Disadvantaged Business">'
        . '<img class="cert-badge" src="' . esc_url($base . '/assets/img/gsa-badge.png') . '" alt="GSA IT Schedule 70">'
        . '</div></section>';
    $replaced = preg_replace('/<section class="badges">.*?<\/section>/s', $markup, $content, 1, $count);

    return $count ? $replaced : $content;
}
add_filter('the_content', 'omnitech_about_cert_badges');