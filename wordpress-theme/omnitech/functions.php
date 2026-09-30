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

function omnitech_flush_rewrites(): void
{
    omnitech_register_careers();
    omnitech_seed_site_content();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'omnitech_flush_rewrites');

function omnitech_seed_page(string $title, string $slug, string $excerpt, string $content): int
{
    $existing_page = get_page_by_path($slug, OBJECT, 'page');
    if ($existing_page instanceof WP_Post) {
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
    if (get_page_by_path($slug, OBJECT, 'omnitech_job')) {
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

function omnitech_seed_site_content(): void
{
    if (get_option('omnitech_content_seeded')) {
        return;
    }

    $home_id = omnitech_seed_page(
        'The Accountable Enterprise',
        'home',
        'OMNITECH Systems delivers cost-effective, scalable, and dependable enterprise IT solutions for commercial and federal clients.',
        '<section class="section services-home"><div class="container center"><p class="eyebrow">What we do</p><h2>Enterprise IT Solutions &amp; Services</h2><div class="pill-grid"><a class="service-pill" href="solutions/#data-management">Data Management</a><a class="service-pill" href="solutions/#clm">Contract Lifecycle Management</a><a class="service-pill" href="solutions/#analytics-ai">Analytics &amp; AI</a><a class="service-pill" href="solutions/#devops">DevOps &amp; Infrastructure</a><a class="service-pill" href="solutions/#application-development">Application Development &amp; Support</a><a class="service-pill" href="solutions/#strategic-consulting">Strategic Consulting</a><a class="service-pill" href="solutions/#database">Database Design &amp; Administration</a></div></div></section><section class="partner-band"><div class="container"><div class="partner-panel"><h2>OMNITECH: YOUR ACCOUNTABLE IT PARTNER</h2><p>From data architecture, analytics, AI/ML, and data management to software development, cloud computing, virtualization, and DevOps, our clients trust us to deliver relevant solutions and prepare them for future success.</p><p>OMNITECH Systems delivers solutions and the means and methods to sustain them, powered by a commitment to exceptional customer experience.</p></div></div></section><section class="section clients-section"><div class="container center"><h2 class="clients-title">Representative Clients That Trust OMNITECH</h2><ul class="client-grid"><li>Merrill</li><li>FIS</li><li>SunTrust</li><li>Freddie Mac</li><li>Booz Allen Hamilton</li><li>NSF</li><li>The World Bank</li><li>IFC</li><li>CACI</li><li>Autodesk</li><li>Societe Generale</li><li>Citigroup</li><li>Sodexo</li><li>TECAN</li><li>SanDisk</li><li>PTC</li><li>Fannie Mae</li></ul></div></section><section class="section"><div class="container"><p class="eyebrow">Join the team</p><h2>Careers</h2><p class="narrow">Find a place where you can join a team and grow your career.</p><div class="job-list"><article class="job-row"><h3>AI/ML Developer</h3><a class="btn btn-outline lime" href="career/ai-ml-developer/">View Position</a></article><article class="job-row"><h3>Enterprise Data Architect</h3><a class="btn btn-outline lime" href="career/enterprise-data-architect/">View Position</a></article><article class="job-row"><h3>Lead Data Scientist</h3><a class="btn btn-outline lime" href="career/lead-data-scientist/">View Position</a></article></div></div></section>'
    );

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
                ['Privacy', $privacy_id],
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