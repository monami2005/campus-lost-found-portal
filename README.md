# Campus Lost & Found Portal

A premium university-facing lost and found platform built with Laravel 12, Blade, Bootstrap 5, and SQLite.

🚀 **[Live Demo](https://campus-lost-found-portal-production.up.railway.app/)**

## Overview

This project delivers a production-ready portal for students and campus staff to:

- Report lost and found items
- Search and filter listings
- Manage claims and notifications
- Access a polished admin dashboard
- Interact through secure authentication and authorization

## Features

- Laravel Breeze authentication with registration, login, password reset, verification, profile updates, and password changes
- Student and admin roles with policy-based access control
- Lost/found item CRUD, search, filters, pagination, and claim workflows
- Dashboard analytics with Chart.js
- Image upload with previews and placeholder handling
- Notifications, profile management, FAQ, contact form, and responsive UI

## Tech Stack

- Laravel 12
- PHP 8.3+
- SQLite
- Blade
- Bootstrap 5.3
- JavaScript
- Font Awesome
- SweetAlert2
- AOS
- Chart.js

## Installation

1. Clone the repository
2. Copy `.env.example` to `.env`
3. Configure the environment variables
4. Run `composer install`
5. Run `php artisan migrate --seed`
6. Run `php artisan storage:link`
7. Run `php artisan serve`

## Folder Structure

- `app/` — Models, controllers, policies, and middleware
- `resources/views/` — Blade templates
- `routes/` — Web routes
- `database/migrations/` — Database migrations
- `database/seeders/` — Database seeders and demo data
- `public/` — Public assets and application entry point

## License

MIT

## Author

Campus Lost & Found Portal Team
