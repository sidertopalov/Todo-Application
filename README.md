# Requirements:
PHP ^7.3|^8.0

# Initial Setup:
1. Clone project
2. Run "composer install"
3. Copy .env.example to .env
4. Run "php artisan key:generate"
5. Run "php artisan jwt:secret"
6. Run "npm install"
7. Change the following in your .env file:

- MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel #YOUR DATABASE NAME
DB_USERNAME=root    #YOUR MySQL USERNAME
DB_PASSWORD=        #YOUR MySQL PASS

# To your local database
8. Run "composer dump-autoload"
9. Run "php artisan migrate"
10. Run "npm run dev" or "npm run watch"
