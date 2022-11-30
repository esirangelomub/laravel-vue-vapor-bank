
# BNB Bank

A simplified banking system.




## Running Locally

Clone the project

```bash
  git clone https://github.com/esirangelomub/laravel-vue-vapor-bank.git
```

Access the project folder

```bash
  cd laravel-vue-vapor-bank
```

Install dependencies

```bash
  composer install
  or
  composer install --ignore-platform-reqs (Your local PHP < 8.0)
```

```bash
  npm install
```

Initialize docker

```bash
  sail up -d
```

Initialize application

```bash
  sail npm run dev
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


## Stack

**Front-end:** Vue, Vuex, Vuetify

**Back-end:** Laravel

**Environment:** Laravel Vapor, Docker, Sail

**Database:** MySQL


## Running the tests

To run the tests, run the following command

```bash
  sail artisan test
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

