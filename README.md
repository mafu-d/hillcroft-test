# Hillcroft Test - Matt Dawkins

This simple web application allows a user to import and view products. There are a few things to note:

- The provided XML data had one missing bracket and no XML header, which I have fixed in the /database/Example.xml file. The header is needed for Laravel to validate that the incoming file is an XML file, and it cannot be processed at all with the missing bracket.
- Rather than processing the uploaded file immediately on upload, it is instead stored on the filesystem and queued for processing. This allows us to process larger files without disrupting the user experience. Improvements to this would be to properly test importing data at scale (potentially batching into smaller chunks of data), and showing the import status (and showing validation error messages) live on the front end.
- If products are uploaded with a matching `code`, the data will be updated rather than rejected or duplicated.
- Categories have been moved to their own table to ensure database normalisation.
- Confirmation emails are sent, but will be caught by the MailPit service that comes with Laravel Sail. This means no email actually leaves the server, but you can check a 'fake' inbox to see it.
- There is a test seeder included, which you can run with `sail artisan db:seed`. This adds a few more products to the database. Pagination is included on the front end so that products are only shown 12 at a time. All products are included, including those out of stock, as no assumptions have been made about the target audience for this application. Products are sorted by how recently they were updated.
- Development of this project took approximately 2 hours, not including environment setup time and documentation.

Future developments could include:

- Artisan command to import an XML file. Since the processing of the XML file is done through a queued job, this would be easy to tap into without code duplication.
- A `manufacturer` table could be set up to further reduce data duplication. This would necessitate a change in the incoming data, so would need some careful planning.
- Search, sorting and filtering on the front end to improve the user experience.
- Importing data from Excel and CSV files as well as XML.
- Exporting data in a range of formats.
- Authentication. It would be wise to lock down imports to authorised users only, while keeping the front end list of products available to everyone. Fortunately Laravel makes this nice and easy.
- An API to automate the import of data from external sources, so that XML files don't have to be manually uploaded.

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
