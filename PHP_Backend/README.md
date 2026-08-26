# Nananom Farms administration dashboard

This directory contains the authenticated PHP administration area for the Nananom Farms website. It also provides the form handlers used by the public website.

## Dashboard features

- Sign-in, sign-out, and inactivity lock-screen handling.
- Booking and enquiry review, replies, and deletion.
- Product creation, editing, deletion, and image upload.
- Payment recording and reports.
- Dashboard-user management.
- Summary counts and reporting views.

## Key files and directories

- `login.php` - dashboard sign-in page.
- `index.php` - dashboard home page.
- `db.php` - loads the root `.env` file and creates the MySQL connection.
- `auth/` - authentication and lock-screen checks.
- `add_*.php`, `update_*.php`, and `delete_*.php` - data-management handlers.
- `user_bookings.php`, `user_enquiries.php`, `manage_products.php`, and `users_home.php` - management screens.
- `partials/` - shared dashboard navigation, layout, and scripts.
- `assets/`, `js/`, `libs/`, and `fonts/` - dashboard assets and third-party browser libraries.

## Setup

1. Import `../sql/nananomfarms.sql` into MySQL/MariaDB.
2. Run `composer install` from the project root to install `vlucas/phpdotenv`.
3. Create the root `.env` file with valid `DB_HOST`, `DB_USER`, `DB_PASSWORD`, and `DB_NAME` values.
4. Serve the project with Apache and PHP.
5. Navigate to `http://localhost/project/PHP_Backend/login.php` and use a user account from the database (or create one through the dashboard).

The session guard in `auth/authenticate.php` locks an inactive user after five minutes. Protected pages should include it before rendering dashboard content.

## Email replies

Booking and enquiry replies are processed by the root-level `bookings_mail.php` and `equiries_mail.php` scripts, which use the bundled PHPMailer library. Configure `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_FROM`, and `MAIL_FROM_NAME` in the root `.env` file before using this feature.

## Deployment note

The root `.env` file is Git-ignored. Use least-privilege database credentials, secure all admin accounts, enable HTTPS, and provide database/SMTP secrets through the production environment or a protected `.env` file.
