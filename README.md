# Nananom Farms Ltd.

A PHP and MySQL web application for Nananom Farms Ltd. It includes a public-facing farm and palm-oil business website, plus an administrative dashboard for managing bookings, enquiries, products, payments, users, and client replies.

## Project structure

- `PHP_Frontend/` — public website, product catalogue, service-booking form, and enquiry form.
- `PHP_Backend/` — password-protected admin dashboard and request handlers.
- `sql/nananomfarms.sql` — database schema and sample data.
- `PHPMailer/` — bundled mail library used to send replies to customers.
- `bookings_mail.php` and `equiries_mail.php` — email reply handlers.

## Requirements

- PHP 8.2 or later
- MySQL or MariaDB
- Apache (WAMP/XAMPP/LAMP are suitable)
- An SMTP account for customer reply emails

## Local setup

1. Place the repository in your web-server directory (for example, `C:\\wamp64\\www\\project`).
2. Start Apache and MySQL.
3. Import `sql/nananomfarms.sql` with phpMyAdmin or the MySQL client. This creates the `nananomfarms` database.
4. Update the database connection in `PHP_Backend/db.php` if your local MySQL host, username, password, or database name differs.
5. Configure SMTP credentials in `bookings_mail.php` and `equiries_mail.php`. Do not commit real passwords or app passwords to source control.
6. Open the public site at `http://localhost/project/PHP_Frontend/`.
7. Open the dashboard at `http://localhost/project/PHP_Backend/login.php`.

## Main capabilities

- Public pages for the company, products, contact information, service bookings, and enquiries.
- Product catalogue populated from the database.
- Admin sign-in and inactivity lock screen.
- Management of bookings, enquiries, products, payments, replies, and dashboard users.
- Email replies to booking and enquiry customers through PHPMailer.

## Security note

The repository currently contains SMTP configuration in the mail-handler files. Replace any existing credentials, keep secrets outside version control, and use environment-based configuration before deploying the application.
