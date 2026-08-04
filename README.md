# Campus Lost & Found Portal

A premium university-facing lost and found platform built with Laravel 12, Blade, Bootstrap 5, and MySQL.

## Overview
This project delivers a production-ready portal for students and campus staff to:
- report lost and found items
- search and filter listings
- manage claims and notifications
- access a polished admin dashboard
- interact through secure authentication and authorization

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
- MySQL
- Blade + Bootstrap 5.3 + JavaScript
- Font Awesome, SweetAlert2, AOS, Chart.js

## Installation
1. Clone the repository
2. Copy `.env.example` to `.env`
3. Configure your database credentials
4. Run `composer install`
5. Run `php artisan migrate --seed`
6. Run `php artisan serve`

## Database Setup
- Create a MySQL database and update `.env` with the connection details.

## Environment Variables
Set the following in `.env`:
- `DB_CONNECTION=mysql`
- `DB_HOST=127.0.0.1`
- `DB_PORT=3306`
- `DB_DATABASE=campus_lost_found`
- `DB_USERNAME=root`
- `DB_PASSWORD=`

## Folder Structure
- `app/` for models, controllers, policies, middleware
- `resources/views/` for Blade templates
- `routes/` for web routes
- `database/migrations/` and `database/seeders/` for schema and demo data

## License
MIT

## Author
Campus Lost & Found Portal Team
