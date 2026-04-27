# Alpha Nerd - Laravel Blog & Admin Dashboard

Alpha Nerd is a Laravel personal blog project with a public website and an admin dashboard.  
The system allows admins to manage posts, categories, comments, and contact messages, with support for authentication, image uploads, search, pagination, and soft delete.

## Features

### Public Website
- Homepage
- Posts listing page
- Single post details page
- Categories page
- Search functionality
- Contact page
- Contact form that stores messages in the database

### Admin Dashboard
- Admin dashboard overview
- Posts CRUD
- Categories CRUD
- Comments management
- Contact messages management
- Soft delete, restore, and force delete
- Image upload for posts
- Pagination for large data lists

### Authentication
- Login system using Laravel Breeze
- Register page
- Forgot password page
- Change password page
- Protected admin dashboard
- Admin-only access for management pages

## Screenshots

### Public Website

#### Homepage
![Homepage](public/screenshots/home.png)

#### Posts Page
![Posts Page](public/screenshots/all%20posts.png)

#### Single Post Page
![Single Post Page](public/screenshots/post.png)

#### Post Comments
![Post Comments](public/screenshots/post%20comments.png)

#### Categories Page
![Categories Page](public/screenshots/categories.png)

#### Category Posts Page
![Category Posts Page](public/screenshots/category.png)

#### Search Results
![Search Results](public/screenshots/search.png)

#### Contact Page
![Contact Page](public/screenshots/contact.png)

### Authentication Pages

#### Login Page
![Login Page](public/screenshots/login.png)

#### Register Page
![Register Page](public/screenshots/register.png)

#### Forgot Password Page
![Forgot Password Page](public/screenshots/forgot%20password.png)

#### Change Password Page
![Change Password Page](public/screenshots/change%20password%20for%20admin.png)

### Admin Dashboard

#### Dashboard Overview
![Admin Dashboard](public/screenshots/dashboard.png)

#### Posts Management
![Posts Management](public/screenshots/all%20posts.png)

#### Create Post
![Create Post](public/screenshots/create%20post.png)

#### Edit Post
![Edit Post](public/screenshots/edit%20post.png)

#### Deleted Posts
![Deleted Posts](public/screenshots/deleted%20posts.png)

#### Categories Management
![Categories Management](public/screenshots/all%20categories.png)

#### Edit Category
![Edit Category](public/screenshots/edit%20category.png)

#### Deleted Categories
![Deleted Categories](public/screenshots/deleted%20category.png)

#### Contact Messages Management
![Contact Messages](public/screenshots/contact%20messages.png)

#### Deleted Messages
![Deleted Messages](public/screenshots/deleted%20messages.png)

## Tech Stack

- Laravel 13
- PHP
- MySQL
- Blade
- Laravel Breeze
- HTML
- CSS
- JavaScript
- Git & GitHub

## Main Database Tables

- users
- posts
- categories
- comments
- contact_messages

## Installation

Clone the repository:

```bash
git clone https://github.com/ahmdan4-hue/alpha-nerd-project.git
```

Move into the project folder:

```bash
cd alpha-nerd-project
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure your database in the `.env` file:

```env
DB_DATABASE=alpha_nerd
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations and seeders:

```bash
php artisan migrate --seed
```

Create the storage link:

```bash
php artisan storage:link
```

Start the Laravel server:

```bash
php artisan serve
```

Run Vite:

```bash
npm run dev
```

Now open:

```text
http://127.0.0.1:8000
```

## Project Purpose

This project was built as a practical Laravel portfolio project to apply backend development concepts such as routing, controllers, models, migrations, Eloquent relationships, authentication, CRUD operations, validation, file uploads, pagination, search, and soft delete.

The project also reflects secure web development basics such as protected admin routes, request validation, CSRF protection, authenticated access, and role-based dashboard access.

## Author

Ahmed  
4th-year Cybersecurity student at UCAS  
Interested in Laravel backend development, secure web applications, and cybersecurity.
