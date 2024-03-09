# Hillcroft Test - Matt Dawkins

## Requirements

Your development environment will need Git installed to download the repository, as well as PHP 8.3 and Composer. It also assumes the use of Laravel Sail, which depends on Docker. The instructions below assume you have a bash alias set up so that you can use `sail` directly; if you don't have that, you'll need to substitute `./vendor/bin/sail` in these commands.

Vite is used to serve the CSS and JS files. If you have NPM installed locally you can use `npm ...` instead of `sail npm ...`.

## Installation

- Clone the repository
- `composer install` to install the PHP dependencies
- Copy .env.example to .env and use the following database connection details:

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

- `sail up -d` to start the Laravel Sail environment
- `sail artisan key:generate`
- `sail artisan migrate`
- `sail npm install` (or `npm install` if you have NPM installed locally) to install other dependencies
- `sail npm run dev` to start the Vite server
- `sail artisan queue:work` to process the queue (imports uploaded XML files and sends emails)
- Open http://127.0.0.1 in your browser
- To preview emails sent by the application, open http://localhost:8025/ in your browser

When you're done, shut down Sail using `sail down`.
