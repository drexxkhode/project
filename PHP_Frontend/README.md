# Nananom Farms public website

This directory contains the public-facing PHP website for Nananom Farms Ltd. Visitors can learn about the business, browse products, book services, and send general enquiries.

## Pages

- `index.php` - home page.
- `aboutUs.php` - company information.
- `products.php` - product catalogue loaded from the `products` database table.
- `book_service.php` - service-booking form.
- `enquiries.php` - general-enquiry form.
- `contactUs.php` - contact page.

## How it works

The booking form submits to `../PHP_Backend/add_booking.php`, while the enquiry form submits to the corresponding backend handler. The product catalogue connects through `../PHP_Backend/db.php` and reads product records from MySQL.

Shared layout files are in `partials/`; styles, scripts, vendor files, and images are under `assets/`.

## Run locally

1. Complete the root-project setup, including importing `../sql/nananomfarms.sql`.
2. Run `composer install` from the project root.
3. Add valid `DB_HOST`, `DB_USER`, `DB_PASSWORD`, and `DB_NAME` values to the root `.env` file.
4. Serve the repository through Apache/PHP.
5. Visit `http://localhost/project/PHP_Frontend/`.

## Notes for development

- Keep relative links intact: pages rely on the frontend and backend directories being siblings.
- Product images are stored in the database and rendered by `products.php`.
- Update contact details and social-media links in the page templates when deploying for a different organisation.
- Database credentials are read from the sibling project's root `.env` file by `../PHP_Backend/db.php`; do not add credentials to frontend pages.
