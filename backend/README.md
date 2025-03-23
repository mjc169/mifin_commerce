## E-commerce

## Docker Setup

Considering you have docker already installed in your machine.

Build and Run Docker services

```
docker-compose up -d --build
```

This will download the images from the dockerfile and build it.

Please wait for a while for it to complete building, it may take a while for you to access the web page. You will usually see `502 Bad Gateway` status for NGINX.

## Backend setup

1. Run `composer install` in the `backend` folder

```
/var/www/backend: composer install
```

2. Run seeders to start testing locally.

```
php artisan migrate:fresh --seed
```

## Frontend setup

1. Considering you have Node Js and NPM already installed.
   Run npm install to download packages used by the project. See `package.json` for dependencies.

```
/var/www/oph-stats: npm install
```

3. Compile Scripts `npm run dev `

```
/var/www/oph-stats:/var/www/html# npm run dev
```

You can access the Backend API via:

```
http://127.0.0.1:8000/
```

## Debugging:

2. When MYSQL/Database related issue, connection refuse, etc.

-   Check if there is no other application using the same `DB_PORT:3306`,
-   Also check if you have `.env` file properly configured in the project
-   It also worth emptying `.docker/mysql/data` folder files for a fresh start.

### .env

Locate `.env.example` configuration from the `root` folder and save it as `.env` and adjust the database host, database, password, port accordingly
