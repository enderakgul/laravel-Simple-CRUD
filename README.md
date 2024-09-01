# Laravel Project Management API

This is a Laravel-based project management API that provides basic CRUD functionality for managing projects and tasks. The API uses the Repository Design Pattern for clean separation of business logic.

## Features

- **Projects:** Create, read, update, and delete projects.
- **Tasks:** Create, read, update, and delete tasks associated with a project.
- **Dynamic Filters:** Filter tasks by status.

## Prerequisites

- PHP 8.4
- Composer

## Getting Started

### Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/your-repository-name.git
    cd your-repository-name
    ```

2. **Edit the `.env` file:**

    update .env file for database preference. Default one is set to use mysql on localhost with a database called as 'laravel'

3. **Install dependencies:**

    ```bash
    composer install
    ```

4. **Run the migrations:**

    After the Docker containers are up, run the migrations to set up the database schema:

    ```bash
    php artisan migrate
    ```

### Usage

- **Start the Laravel server:**

    ```bash
    php artisan serve
    ```

- **Access the API:** 

    You can now make API requests to `http://localhost:8000`.