# Laravel Blog App

## Requirements

Before starting, ensure you have the following installed:

-   PHP `^8.x`
-   Composer
-   MySQL (or SQLite, PostgreSQL, etc.)

## Installation

### 1️⃣ Clone the Repository

```
git clone https://github.com/adnan-ha/laravel-blog-app.git
```

```
cd laravel-blog-app.git
```

### 2️⃣ Install Dependencies

```
composer install
```

### 3️⃣ Set Up Environment File

```
copy .env.example .env
```

```
php artisan key:generate
```

Then, open .env and update the database settings.

### 4️⃣ Run Database Migrations

```
php artisan migrate --seed
```

### 5️⃣ Start the Server

```
php artisan serve
```

Then, open http://127.0.0.1:8000 in your browser.
