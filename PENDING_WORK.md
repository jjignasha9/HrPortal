# Pending Work - HR Portal

This document tracks remaining tasks to complete the full spec. The app is scaffolded with Breeze, Tailwind, Alpine, Blade components, routes, controllers, and models. Dashboard and base layout implemented.

## High Priority
- Implement CRUD UIs (AJAX + Yajra DataTables) for: Leads, Employees, Inquiries, Quotations, Companies, Projects, Performa/Invoices, Receipts, Vouchers, Tickets, Events.
- Storage uploads (public disk) for resumes, photos, event media.
- Spatie Roles & Permissions setup (migrations publish/update to support Laravel 12 dev-main) + policies/middleware per modules.
- Attendance module: report listing + Excel export using Laravel Excel.
- Settings module forms (site title, logo, colors, mail).

## UI
- Sidebar active states for all routes; mobile sidebar toggle.
- Replace placeholder widgets with real data, add DataTable sections on dashboard (recent inquiries, tickets, companies).
- Add SweetAlert/Toastr notifications to all CRUD actions.

## Data
- Complete migrations for remaining models (inquiry, quotation, company, project, performa, receipt, voucher, ticket, event).
- Seeders for demo data for each module.

## Dev notes
- Run: `php artisan migrate --seed` then `npm install && npm run dev` then `php artisan serve`.


