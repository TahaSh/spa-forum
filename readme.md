# SPA-FORUM

This is a demo from ["Building a Single Page Application from Scratch with Vue.js and Laravel"](http://taha-sh.com/blog/building-a-single-page-application-from-scratch-with-vuejs-and-laravel) series.

## Installing

#### 1. Clone it

``` plain
git clone https://github.com/TahaSh/spa-forum
```

#### 2. Install dependencies

``` plain
composer install
npm install
```

#### 3. Generate a new key

``` plain
php artisan key:generate
```

#### 4. Create, migrate and seed the database

``` plain
touch database/database.sqlite
php artisan migrate
php artisan db:seed
```

#### 5. Run the server

``` plain
php artisan serve
```

Finally, open up `localhost:8000` and enjoy :).

---

*Test user that you can login with:*

Email: foo@example.com

Password: password
