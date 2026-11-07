# Project Name

A brief description of what your project does goes here.

## Prerequisites

Before starting the project, ensure you have the following installed:
* A local web server environment (e.g., **XAMPP**, **WAMP**, or **MAMP**)
* **PHP** (compatible with your project files)
* **MySQL / MariaDB**

---

## Getting Started & Database Setup

Follow these steps to set up the database and configure the application:

### 1. Database Initialization
When you start the project for the first time, you must manually create and populate the database:
1. Open your relational database management system dashboard (e.g., **phpMyAdmin**).
2. Just import the file in there we are creating the database and the tables.
3. Choose the `users_db.sql` file located in the root directory of this project.
4. Click **Go** / **Import** to execute the script. This will automatically generate the required tables and structure.

### 2. Configuration Settings
You must verify that your application links correctly to your database instance. Open the **`config.php`** file and adjust the connection details to match your environment. 

Ensure the following variables are defined correctly:

```php
host = '127.0.0.1';
user = 'root';
password = '1234';
database = 'users_db';
port = 3307;
```

> **Note:** Update the `$password` and `$port` parameters if your local MySQL instance configuration differs from the defaults listed above.

---

## Project Structure

Based on the source directory, the following primary files are included:
* `config.php` — Database configuration settings.
* `admin.php` & `auth_process.php` — Authentication and administrative processing.
* `facility_booking.php` & `schedules.php` — Booking management systems.
* `users_db.sql` — Database initialization script.
