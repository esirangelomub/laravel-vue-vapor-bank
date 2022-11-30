
# BNB Bank

A simplified banking system.

## Dependencies

```bash
PHP 8.0+
Node 16+
NPM 8+
Docker
```

## Running Locally

Clone the project

```bash
  git clone https://github.com/esirangelomub/laravel-vue-vapor-bank.git
```

Access the project folder

```bash
  cd laravel-vue-vapor-bank
```

Copy .env.default to .env

```bash
  cp .env.default .env
```

Install dependencies

```bash
  composer install
  or
  composer install --ignore-platform-reqs (Your local PHP < 8.0)
```

Initialize docker with Sail

```bash
  ./vendor/bin/sail up -d
```
For more information about sail access the documentation [here](https://laravel.com/docs/9.x/sail).

Running migrations

```bash
  ./vendor/bin/sail artisan migrate --seed
```

Install NPM dependencies from the container

```bash
  ./vendor/bin/sail npm install
```


Initialize Front End application

```bash
  ./vendor/bin/sail npm run dev
```

Initial usage information

Access the routes and create a new account (as Customer or Admin).

```bash
<HOST>/auth_login
<HOST>/auth_login/admin
<HOST>/auth_register
<HOST>/auth_register/admin
```

The password set for admin users is admin@123.

## Deploy with Laravel Vapor

Laravel Vapor is a serverless deployment platform for Laravel, powered by AWS. Launch your Laravel infrastructure on Vapor and fall in love with the scalable simplicity of serverless.

After creating the Vapor account, follow the steps below to deploy this application.

Initialize the Vapor service

```bash
./vendor/bin/vapor init
```

Log in to your account

```bash
./vendor/bin/vapor login
```

Create a MySQL database on the sail panel. Remember to use the database name bnb-bank, otherwise you will need to change the name of the database in the vapor.yml file. It should look like this:

![alt text](https://raw.githubusercontent.com/esirangelomub/laravel-vue-vapor-bank/main/public/docs/mysql_vapor.png)

Once your database is available, run the deploy command:

```bash
./vendor/bin/vapor deploy production
```

This was just a brushstroke on Laravel Vapor.
For more information about Vapor, access [https://vapor.laravel.com/](https://vapor.laravel.com/)
## Stack

**Front-end:** Vue, Vuex, Vuetify

**Back-end:** Laravel

**Environment:** Laravel Vapor, Docker, Sail

**Database:** MySQL


## Running the tests

To run the tests, run the following command

```bash
  ./vendor/bin/sail artisan test
```


## To improve

Implement more tests
Implement more Vuex


## Support

For support, send an email to eduardo.sirangelo@gmail.com


## 🔗 Links
[![portfolio](https://img.shields.io/badge/my_portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](https://github.com/esirangelomub)
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/eduardosirangelo/?locale=en_US)
[![twitter](https://img.shields.io/badge/twitter-1DA1F2?style=for-the-badge&logo=twitter&logoColor=white)](https://twitter.com/esirangelo)

