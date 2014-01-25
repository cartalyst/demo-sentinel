# Sentry 3 Demo

This is a basic demo showing some of the functionality of Sentry 3 on Laravel 4.1.

## Installation

##### 1. Clone this repo:

```
git clone git@github.com:cartalyst/demo-sentry.git
```

##### 2. Setup your virtual host.

##### 3. Go into the directory in your terminal app and install the dependencies:

```
composer install
```

##### 4. Configure your database connection by opening `app/config/database.php` file.

##### 5. Update the `app/config/mail.php` file to use your email credentials.

##### 6. Run the migrations

```
php artisan migrate --package="cartalyst/sentry"
```
