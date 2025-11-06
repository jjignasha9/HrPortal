# HR Portal (Laravel 11)

Modern, modular HR Portal built with Laravel 11, TailwindCSS, Alpine.js, Breeze auth, Yajra DataTables (server-side), SweetAlert2/Toastr notifications, Chart.js, and Spatie Roles & Permissions.

## Requirements
- PHP 8.2+
- MySQL 8+
- Node.js 18+
- Composer

## Quick Start
1. Clone/copy this project into your web root (e.g. `C:/xampp/htdocs/HrPortal`).
2. Create and configure your `.env` (database, mail, `APP_URL`).
3. Install PHP dependencies:
   ```bash
   composer install
   ```
4. Install JS dependencies:
   ```bash
   npm install
   ```
5. Generate app key (if needed):
   ```bash
   php artisan key:generate
   ```
6. Migrate and seed demo data, roles and permissions:
   ```bash
   php artisan migrate --seed
   ```
7. Build assets (or run dev):
   ```bash
   npm run dev   # for dev
   # or
   npm run build # for production
   ```
8. Link storage (for uploads):
   ```bash
   php artisan storage:link
   ```
9. Run the app:
   ```bash
   php artisan serve
   ```

Login (seeded):
- Email: `admin@hrportal.test`
- Password: `password`

## Modules
- Dashboard (clock, calendar, summaries, recent lists, charts)
- HR: Hiring Leads (CRUD, resume upload), Employees (CRUD, photo upload)
- Inquiries (CRUD + follow-ups)
- Quotations (Standard/Premium + follow-ups)
- Companies (CRUD, logo upload)
- Projects (CRUD)
- Performa (items + print)
- Invoices (items + print)
- Receipts (print), Vouchers (print)
- Tickets (CRUD, assign, resolve)
- Attendance (DataTable + Excel export), Leave approvals
- Events (images/videos gallery uploads)
- Roles & Permissions (Spatie)
- Settings (site title, logo, theme color, mail)

All CRUD lists are powered by Yajra DataTables with server-side processing and AJAX modals for create/edit/delete.

## Tech Notes
- Icons: Blade Heroicons
- Styles: TailwindCSS + Forms plugin
- JS: Alpine.js, Chart.js, SweetAlert2, Toastr, jQuery (for DataTables UI)
- Permissions: Spatie `HasRoles` on `User`; `role:Super_Admin` middleware for Roles/Settings
- Uploads: `storage/app/public/...` via `Storage::disk('public')`

## Scripts
- `npm run dev` – Vite dev server
- `npm run build` – Build production assets

## Troubleshooting
- If DataTables CSS/JS isn’t loading, ensure `npm run dev` or `npm run build` ran and `@vite(['resources/css/app.css','resources/js/app.js'])` exists in your layout.
- If uploads aren’t visible, confirm `php artisan storage:link` and web server can read `public/storage`.
- If permissions errors occur, re-run the seeder:
  ```bash
  php artisan db:seed --class=RolePermissionSeeder
  ```

## License
This project is provided as-is for demonstration purposes.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
