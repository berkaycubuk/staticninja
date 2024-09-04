# Static Ninja

Static Ninja is a website builder that is specifically designed for small businesses.

## Dev guide

Software you need to have on your machine:
- PHP 8.3 (minimum)
- Composer 2 (minimum)
- Node.js 18 (minimum)

### First start

After cloning the repository, please run this set of commands:

- `composer i` to install all the php packages
- `npm i` to install all the node packages
- `cp .env.example .env` to create your local version of .env file
- If you want to use this in production, you have to fill `LINODE_` values in the `.env` file with your object storage values. Currently it is only tested with Linode's object storage service
- In your first start you need to run the migrations, `php artisan migrate`
- You'll need to create an account, `php artisan make:filament-user`, and follow the instructions. Suggested name: admin, email: admin@admin.admin, and password: password
- On a different terminal, `php artisan serve` to start php backend
- And on another terminal, `npm run dev` to start the dev node server Now you should be able to access it with `localhost:8000`

### Quick info about file locations

- Views, components and similiar are stored under resources folder
    - Svelte components: /resources/js/Components
    - Svelte pages: /resources/js/Pages
    - Laravel blade stuff: /resources/views
- Backend logic, services and models are stored under app folder
- Database related migrations and database itself is stored under: /database

### Testing

Tests are stored under /test. To run the Laravel tests, `php artisan test`.

## Component rendering

Components are rendered by the RenderService that you can find in `app/Services/RenderService.php`.

## Deploying indiviual sites

First component renderer renders the site (to be honest currently, only the index page), and upload directly to the object storage. After you create a new site, a fresh Nginx configuration will be created as well.
