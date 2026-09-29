# OMNITECH Systems website

A PHP, HTML, CSS, and JavaScript recreation of the public OMNITECH Systems site. Pages cover home, about, solutions, contact, careers, job applications, and privacy.

Client and partner names are set in text. Illustrations are original drawings, so this project does not redistribute the live site’s photographs or logo artwork.

## Run locally

```bash
php -S localhost:8080 router.php
```

Open http://localhost:8080/

Apache with `mod_rewrite` can use the included `.htaccess` rules for the same addresses.

## What the PHP side does

- Shared header, footer, and page data
- Contact form validation, a honeypot field, and a session token
- Messages saved to `storage/messages.json`
- Job applications saved to `storage/applications.json`, with resumes in `storage/resumes/`
- Resume uploads limited to PDF, DOC, and DOCX files of 5 MB or less

`storage/` is blocked from direct web access.
