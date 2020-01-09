# 💻 Ecommerce with paypal

Laravel project with Ecommerce site with the next features:

- Products
- Shopping Cart
- Checkout (Demo)
- Paypal Gateway

## Getting Started 🎬

```
git clone https://github.com/ArielMejiaDev/Ecommerce-with-paypal shop
```

### Prerequisites 🔍

    - PHP 7.2 
    - Server ready for Laravel environment recommended: [Valet](https://medium.com/ariel-mejia-dev/install-laravel-valet-on-mac-6e5229cba1e)

### Installing ⚙️

```
cd api
composer install 
cp .env.example .env 
php artisan key:generate
nano .env //edit your file as you want
```

## Running the tests 🧪

The project goes with test to all endpoints.

- List all products
- Add products to shopping cart
- Remove all products from shopping cart
- Correct data between checkout and selected products
- Paypal payment successfull
- Paypal payment fail with notification

- reviews
```
vendor/bin/phpunit
```

### And coding style 💻

It is written using PSR-4 and PSR-12 standard.

## Deployment 🚀
```
echo "web: vendor/bin/heroku-php-apache2 public/" > Procfile
heroku create apiname
heroku config:set APP_KEY=
```
* all env file settings can be added on Heroku app/settings section.

To add a database is required a heroku plugin for data, it can be found 
in this link: (Heroku data section)[https://data.heroku.com], you can select a free or pay plan, and heroku provides a aws database.
then you need to match the database and the app, it can be handle in Heroku GUI, 
and then add some environment variables to heroku app 

```env
APP_URL=herokuurl
DB_CONNECTION=pgsql
DB_HOST=herokugenerated
DB_PORT=5432
DB_DATABASE=herokudatabasenamegenerated
DB_USERNAME=herokuusernamegenerated
DB_PASSWORD=herokupasswordgenerated
```
### Add Paypal ID and Secret

(create your account on paypal sandbox)[https://developer.paypal.com]
(get id and secret)[https://developer.paypal.com/developer/applications/]

Add this values to "env" file

```env
PAYPAL_CLIENT_ID='yourId'
PAYPAL_SECRET='yourSecret'
PAYPAL_MODE=sandbox
```

All database keys are required to connect correctly with heroku database plugin, 
but the APP_URL key is required because Passport endpoint "oauth/token" redirects to base url.

finally we are going to change the composer.json file to reflect Heroku deployment needs

```json
    //in scripts object add
    "post-install-cmd": [ 
        "php artisan clear-compiled",
        "chmod -R 777 storage", 
        "php artisan passport:keys"
    ]
    //copy from require-dev object the faker version of your project to required object
    "fzaninotto/faker": "^1.4"
```

update composer to get changes and add the changes to Heroku

```php
composer update
```

```bash
git add .
git commit -m "wip"
git push heroku master
```

## Built With 🛠️

* [Laravel](https://github.com/laravel/laravel) - The web framework used
* [Composer](https://getcomposer.org/) - Dependency Management
* [Passport](https://laravel.com/docs/6.x/passport) - Passport
* [Postgres](https://www.postgresql.org/) - Postgres
* [Heroku](https://devcenter.heroku.com/articles/getting-started-with-laravel) - Heroku

## Versioning 🔢

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors 🧔

* **Ariel Mejia Dev** - [ArielMejiaDev](https://github.com/ArielMejiaDev)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
