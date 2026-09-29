<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

const SITE_NAME = 'OMNITECH Systems';
const SITE_TAGLINE = 'OMNITECH Systems - IT ENTERPRISE SOLUTIONS';
const SITE_EMAIL = 'contact@omnitechsys.com';
const SITE_PHONE = '+1 703-281-2340';
const SITE_FAX = '+1 703-291-2343';
const SITE_ADDRESS_1 = '8300 Boone Blvd, Suite 500';
const SITE_ADDRESS_2 = 'Vienna, VA 22182';
const SITE_WEB = 'http://www.omnitechsys.com';
const EMPLOYEE_PORTAL = 'https://columbiaedp.evolutionpayroll.com/ess#/login';
const LINKEDIN_URL = 'https://www.linkedin.com/company/omnitech-systems/';
const STORAGE_DIR = __DIR__ . '/../storage';
const MAX_RESUME_BYTES = 5 * 1024 * 1024;
