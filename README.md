# User Management System

A basic user management system built with **Laravel 11**, **Inertia.js**, and **Vue 3** that provides session-based authentication, an admin dashboard, and basic user management functionalities.

## Overview

This project is a modern user management system that allows admin users to:

- log in and log out.
- View a dashboard listing non-admin users.
- View detailed user profiles.
- Edit a user.
- Delete users.

The application uses Laravel as its backend, Inertia.js for SPA navigation, and Vue 3 for the frontend.

## Features

- **User Authentication**: Secure, session-based authentication using database with Laravel.
- **Admin Dashboard**: An interface for admin users to manage other users.
- **User Management**: View, edit, and delete non-admin users.
- **Role-Based Access Control**: Only users with the admin role can access administrative routes.

## Installation

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js & npm (or yarn)
- A database (e.g., MySQL, PostgreSQL, SQLite)

### Steps

1. **Clone the Repository**

```bash
git clone https://github.com/janarnelbanaag/user-management-system.git
cd user-management-system
```

## 2. **Install PHP Dependencies**

```bash
composer install
```

## 3. **Install JavaScript Dependencies**

```bash
npm install
```

## 4. **Configure Environment**

Copy the example environment file and update your configuration:

```bash
cp .env.example .env
```

Update the .env file with your database credentials and other settings.

## 5. **Database Setup**

Make sure you have a database named user_management_system (or update your .env file to match your database name).

## 6. **Run Migrations and Seeds**

```bash
php artisan migrate
php artisan db:seed
```

## Running the Project

Start the local development server:

```bash
composer run dev
```

Access the application at http://localhost:8000.

## Usage

- **Authentication:**

    - Visit `/login` to log in.
    - The application uses session-based authentication, so once logged in, you'll have access to protected routes.

- **Admin Dashboard:**

    - Navigate to `/dashboard` (protected by admin middleware) to see a list of non-admin users.
    - From the dashboard, you can view, edit, or delete users.

- **User Management:**
    - **View User:** `/user/{id}` (for a read-only view).
    - **Edit User:** `/user/{id}?isEdit=true` (for an editable view).
    - **Delete User:** A DELETE request is sent to `/user/{id}` to remove a user.

## Acknowledgements

- [Laravel](https://laravel.com/)
- [Inertia.js](https://inertiajs.com/)
- [Vue.js](https://vuejs.org/)
