# E-commerce Backend API (Laravel 12.3.0)

This repository contains the backend API for an e-commerce application, built using the Laravel framework version 12.3.0.

```bash
php artisan --version
# Output: Laravel Framework 12.3.0
```

## Prerequisites

Before you begin, ensure you have the following installed:

-   **PHP**: Version 8.2 - 8.4 (Required for Laravel 12)
-   **Composer**: Version 2.8.6 or later (Recommended)
-   **Docker Desktop**: Version 4.17.1 or later (Recommended for containerized development)

## Getting Started

### Environment Configuration

1.  **Copy `.env.example`:**

    ```bash
    cp .env.example .env
    ```

    Create a `.env` file from the provided `.env.example` template.

2.  **Configure `.env` Variables:**

    Open the `.env` file and update the database connection details:

    ```
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=mifin_commerce
    DB_USERNAME=root
    DB_PASSWORD=localhost_db_password
    ```

    **Note:** Ensure these values match your Docker MySQL service configuration.

### Composer Docker Preparation (Convenience Script)

The `composer docker-prep` script automates the Docker setup process:

```bash
composer docker-prep
```

We have custom composer script created to simplify the following process below.

### Detailed Docker Setup

Using Docker simplifies setup and ensures a consistent environment. If you have Docker installed, follow these steps:

1.  **Build and Start Containers:**

    ```bash
    docker-compose up -d --build
    ```

    This command builds the Docker images (if they don't exist) and starts the containers in detached mode (`-d`).

2.  **Install Dependencies and Dump Autoload:**

    ```bash
    docker compose exec -T php composer install && docker compose exec -T php composer dumpautoload
    ```

    This installs the PHP dependencies using Composer within the PHP container and regenerates the autoloader.

3.  **Run Database Migrations and Seed Data:**

    ```bash
    docker compose exec -T php php artisan migrate:fresh --seed
    ```

    This command runs fresh database migrations and populates the database with seed data for a development environment.

### Debugging

-   **Database Connection Issues (e.g., "Connection Refused"):**
    -   Ensure that the database server is running.
    -   Verify that the `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` settings in your `.env` file are correct.
    -   Check if any other applications are using the same database port (e.g., 3306).
-   **General Troubleshooting:**
    -   Check your framework's log files for error messages.
    -   Ensure all required dependencies are installed.
    -   Restart your Docker containers or web server after making configuration changes.
    -   Check your PHP version, sometimes your local machine's PHP version and backend Docker PHP version is being mixed up, check which PHP version is being used
    -   Check .docker/app/php.dockerfile is running correctly by reading the PHP Container Logs
