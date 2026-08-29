# DiziDex Ecommerce Platform Setup

This project is a complete PHP/MySQL implementation for the DiziDex landing page and admin dashboard, optimized for Hostinger shared hosting.

## Requirements
- PHP 7.4 or higher
- MySQL / MariaDB
- Web server (Apache/Nginx) with URL rewriting enabled

## Local Setup
1. Clone this repository into your local server directory (e.g., `htdocs` or `/var/www/html`).
2. The document root should be pointed to the `public_html` folder.
3. Import `public_html/database/database.sql` into your local MySQL database.
4. Copy `.env.example` to `.env` and configure your database credentials:
   ```env
   DB_HOST=localhost
   DB_DATABASE=dizidex_db
   DB_USERNAME=root
   DB_PASSWORD=yourpassword
   APP_ENV=development
   ```

## Admin Access
- **URL**: `http://yourdomain.com/admin/login.php`
- **Username**: `uday`
- **Password**: `Dizidex@8660`
*(Note: Change your password immediately after first login in a production environment)*

## Hostinger Deployment
1. Upload all files to your Hostinger `public_html` directory (ensure the contents of the local `public_html` go into Hostinger's `public_html`).
2. Create a MySQL database via Hostinger control panel.
3. Import `database.sql` using phpMyAdmin in Hostinger.
4. Create a `.env` file (one level above public_html if possible for security, or in public_html if restricted) and update DB credentials.
5. Ensure your Hostinger PHP version is at least 7.4.

## Meta Pixel Configuration
The Meta Pixel ID is currently hardcoded as `1697678007968221` in `public_html/index.php`. To change it, edit the `<script>` tag in `index.php`.

## Checkout URL Configuration
The checkout redirect URL is used across all "Buy Now" buttons. To change it, open `public_html/index.php` and search for `https://superprofile.bio/vp/ms-office-and-windows?checkout=true` to replace it.

## File Structure
- `public_html/`
  - `index.php` - Main landing page
  - `admin/` - Admin dashboard
  - `api/` - Backend tracking APIs
  - `assets/` - CSS, JS, Images
  - `config/` - Database config
  - `includes/` - Auth logic
  - `database/` - SQL schema
