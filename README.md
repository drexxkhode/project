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
- [Composer](https://getcomposer.org/) for the PHP dependencies

## Local setup

1. Place the repository in your web-server directory (for example, `C:\\wamp64\\www\\project`).
2. Start Apache and MySQL.
3. Import `sql/nananomfarms.sql` with phpMyAdmin or the MySQL client. This creates the `nananomfarms` database.
4. Run `composer install` in the project root to install `vlucas/phpdotenv`.
5. Create a root-level `.env` file and set the required database and mail values listed below.
6. Open the public site at `http://localhost/project/PHP_Frontend/`.
7. Open the dashboard at `http://localhost/project/PHP_Backend/login.php`.

## Environment configuration

The application loads `.env` from the project root through `PHP_Backend/db.php`. Add these values to your local `.env` file:

```dotenv
DB_HOST=localhost
DB_USER=your_database_user
DB_PASSWORD=your_database_password
DB_NAME=nananomfarms

MAIL_HOST=your_smtp_host
MAIL_PORT=465
MAIL_USERNAME=your_smtp_username
MAIL_PASSWORD=your_smtp_password
MAIL_FROM=sender@example.com
MAIL_FROM_NAME="Nananom Farms Ltd."
```

`DB_*` variables configure the MySQL connection. `MAIL_*` variables configure PHPMailer for booking and enquiry replies. The `.env` file is ignored by Git; never commit real credentials.

## Main capabilities

- Public pages for the company, products, contact information, service bookings, and enquiries.
- Product catalogue populated from the database.
- Admin sign-in and inactivity lock screen.
- Management of bookings, enquiries, products, payments, replies, and dashboard users.
- Email replies to booking and enquiry customers through PHPMailer.

## Security note

Keep production credentials only in the deployment environment or its `.env` file. Use least-privilege database and SMTP accounts, and rotate any credentials that were previously committed.
