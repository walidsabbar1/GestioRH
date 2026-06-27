# GestioRH - Human Resources Management System

GestioRH is a modern Human Resources Management web application built with Laravel 13, MySQL, Tailwind CSS, and Vite.

---

## Prerequisites

Before starting, ensure you have the following installed on your system:

- **PHP**: `^8.3`
- **Composer**: `^2.x`
- **Node.js**: `^20.19` or `^22.12` (Vite 8 requirement)
- **NPM**: `^9.x` or later
- **MySQL Database**: `^8.x`
- **System Utilities**: `unzip` (required by Composer for unpacking zip files)

---

## Step-by-Step Installation Guide

Follow these steps to get the application up and running on your local machine:

### 1. Clone the Repository
Clone the project repository to your local system and navigate to the project directory:
```bash
git clone <repository-url>
cd GestioRH
```

### 2. Install PHP Dependencies
Make sure you have the system `unzip` package installed first (run `sudo apt install -y unzip` on Ubuntu/Debian if it is missing). Then run:
```bash
composer install
```
*Note: If your local PHP version is older (e.g. PHP 8.3) than what was locked by a teammate on PHP 8.4, you may need to run `composer update` to resolve dependency version matches.*

### 3. Create the Environment Configuration
Copy the sample `.env.example` file to create your local `.env` configuration file:
```bash
cp .env.example .env
```

### 4. Create and Configure the Database
1. Open your MySQL client and create a new database:
   ```sql
   CREATE DATABASE GestioRH;
   ```
2. Update the database settings in your `.env` file to match your MySQL credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=GestioRH
   DB_USERNAME=your_mysql_username
   DB_PASSWORD=your_mysql_password
   ```

### 5. Generate the Application Encryption Key
Generate a secure application key:
```bash
php artisan key:generate
```

### 6. Run Migrations and Seed the Database
Create the database tables and populate them with the initial seeded data (users, departments, and employees):
```bash
php artisan migrate --seed
```

### 7. Install Node.js Packages
Install the required frontend dependencies:
```bash
npm install
```

### 8. Build Frontend Assets
Compile the CSS and Javascript assets:
```bash
npm run build
```

---

## Running the Application

There are two ways to run the application on your localhost:

### Option A: The Simple Way (Concurrently)
The project includes a helper composer script that automatically spins up the Laravel server, Vite assets compilation server, background queue, and log watcher simultaneously in a single terminal:
```bash
composer dev
```
- **Web App URL**: [http://127.0.0.1:8000](http://127.0.0.1:8000)
- **Vite Dev Server**: [http://localhost:5173](http://localhost:5173)

### Option B: The Manual Way (Separate Terminals)
If you prefer running components individually, run each command in its own terminal:

1. **Start the Laravel PHP Server**:
   ```bash
   php artisan serve
   ```
2. **Start the Vite compiler**:
   ```bash
   npm run dev
   ```
3. **Start the Queue Listener** (required for background queues/jobs):
   ```bash
   php artisan queue:listen --tries=1
   ```

---

## Default Login Credentials

After seeding the database (`php artisan migrate --seed`), you can log in with the following admin account:

| Field        | Value                    |
|--------------|--------------------------|
| **Email**    | `admin@rhmanager.com`    |
| **Password** | `password`               |
