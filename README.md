# Getting Started

Welcome to the Laravel API! This guide will help you set up and run the project locally.

---

## Prerequisites

Ensure you have the following tools installed:

- [PHP](https://www.php.net/) (version 8.0 or later)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/) or another database supported by Laravel
- [Git](https://git-scm.com/)

---

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/fahmiaksan/laravel-api.git
   cd laravel-api
   ```
2. **Install dependencies**:
   ```bash
   composer install
   ```
3. **Set up enviroment variable**:
   ```bash
   cp .env.example .env
   ```

4. **Generate the application key**:
   ```bash
   php artisan key:generate
   ```

5. **Generate storage link**:
   ```bash
   php artisan storage:link
   ```

6. **Run migration**:
   ```bash
    php artisan migrate
   ```
7. **Run seeder**:
   ```bash
    php artisan db:seed
   ```

## Running the project
1. **Start the local development server**:
   ```bash
   php artisan serve
   ```