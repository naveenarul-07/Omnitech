# OMNITECH WordPress theme

This theme adapts the existing OMNITECH site styling for WordPress. It is separate from the original PHP site, which remains unchanged.

## Install WordPress first

XAMPP provides PHP, but `/wp-admin` requires a WordPress installation and a database. Install WordPress into its own folder under XAMPP's `htdocs`, start Apache and MySQL in the XAMPP Control Panel, and complete the setup in your browser.

## Install the theme

Copy the `omnitech` folder into the WordPress installation's `wp-content/themes/` directory. In WordPress admin, open **Appearance > Themes** and activate **OMNITECH Systems**. Then open **Settings > Permalinks** and click **Save Changes** once.

On the first admin page load after activating the theme, it creates starter Home, About, Solutions, Contact, and Privacy pages, three open positions, and a navigation menu, then selects Home as the static front page. Existing pages with the same slugs are preserved and never overwritten. Edit the generated copy in **Pages** and positions under **Open Positions**.

Open positions are managed under **Open Positions** in the admin menu. Add each role as a position post; the archive is available at `/careers` and each role at `/career/role-slug`.

The contact and job application forms are not converted from the old JSON-backed PHP forms. Add a WordPress form plugin and configure mail delivery (typically with an SMTP plugin). Insert its shortcode into the Contact page; for applications, enter the shortcode in the **Application Form** box while editing a position.

If you activated an earlier theme version before its starter content was added, copy this updated `omnitech` theme folder over the installed one. Then reload the WordPress Dashboard once to run the one-time content setup.

Set the site name and tagline under **Settings > General**, upload a logo under **Appearance > Customize**, and edit the employee portal URL and contact email under **Appearance > Customize > OMNITECH Contact Details**.