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

- `login.php` — dashboard sign-in page.
- `index.php` — dashboard home page.
- `db.php` — MySQL connection used throughout the application.
- `auth/` — authentication and lock-screen checks.
- `add_*.php`, `update_*.php`, and `delete_*.php` — data-management handlers.
- `user_bookings.php`, `user_enquiries.php`, `manage_products.php`, and `users_home.php` — management screens.
- `partials/` — shared dashboard navigation, layout, and scripts.
- `assets/`, `js/`, `libs/`, and `fonts/` — dashboard assets and third-party browser libraries.

## Setup

1. Import `../sql/nananomfarms.sql` into MySQL/MariaDB.
2. Set the correct database host, username, password, and database name in `db.php`.
3. Serve the project with Apache and PHP.
4. Navigate to `http://localhost/project/PHP_Backend/login.php` and use a user account from the database (or create one through the dashboard).

The session guard in `auth/authenticate.php` locks an inactive user after five minutes. Protected pages should include it before rendering dashboard content.

## Email replies

Booking and enquiry replies are processed by the root-level `bookings_mail.php` and `equiries_mail.php` scripts, which use the bundled PHPMailer library. Configure a valid SMTP account before using this feature, and keep its credentials out of the repository.

## Deployment note

Use least-privilege database credentials, secure all admin accounts, enable HTTPS, and move database/SMTP secrets to environment-specific configuration before deploying.
