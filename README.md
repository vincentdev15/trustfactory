# Trustfactory eCommerce Challenge Project

## Technology stack

You have 2 versions of the project :

- a first one without InertiaJS, please go the main branch
- a first one with InertiaJS, please go to the inertia branch

### Main backend technologies

- Laravel v12
- Fortify v1
- Sanctum v4 / git branch main
- Inertia v2 / git branch inertia

### Main frontend technologies

- VueJS v3
- TailwindCSS v4
- InertiaJS for Vue3 v2.3 / git branch inertia

### Database

To get it easier for the demonstration, I have use a simple SQLite database.

## Setup steps

### Demonstration setup

Execute the next commands to install all dependencies (PHP and node).

(perhaps you need to install composer globally in your development environment)

This command will :

- install the back and the front dependencies
- make a copy of the .env.example file to .env
- generate the application key
- migrate the database
- seed the database with demo datas
- build the front assets

```
composer setup-demo
```

### .env file

You need to setup the value for these keys in the .env file.

(the email is preconfigured to use mailtrap, feel free to setup the whole email configuration if you need another mail server)

```
MAIL_USERNAME=
MAIL_PASSWORD=

CART_EXPIRATION_DELAY=1
DAILY_REPORT_HOUR=22:00
```

Feel free to modify these 2 lines according to your needs.

```
APP_ENV=production
APP_DEBUG=false
```

### Run the application demonstration

You just have to run this command, it will execute the built-in Laravel queue worker and a schedule worker.

```
composer run demo
```

## Application tests

The application has only been tested manually.

For such an application, it's important to trust the code, so the next step is to write tests to ensure all functionalities work as expected.

## Functionalities

### Current functionalities

- register / login / logout
- the admin can access the dashboard and see all products
- users can browse the products, add products to their cart, remove products, update products quantities
- users can validate and pay for the products (fake payment)
- if a product stock is running low (custom low stock limit for each product), an email is sent to the admin
- everyday at 22:00 by default (the hours it customizeable in the .env file), the admin receives a report with all sales of the day

### Stock and cart logic

- there are 2 differents stock values : the stock quantity (real stock) and the reserved stock quantity (quantity reserved after cart validation)
- the displayed stock is the available stock (difference between the real stock and the reserved stock quantity)
- the cart has 2 different statuses : OPEN and VALIDATED
- when a user adds a product to the cart, there is no modification in the stock
- when a user validated the cart, there is no modification in the stock, but the product is reserved, the displayed stock is the available stock
- when a user adds new products or updates product quantities, the cart is set to the OPEN status back and the user has to validate it once again
- when a user pays, the real stock and the reserved stock are updated
- once the cart is validated, a job is dispatched to clear it after 15 min by default (the delay is customizable in the .env file), if the cart has been modified within this delay, the job will have no effect

### Improvements that could be done

Here are some improvements that could be done :

- optimize the sales funnel according to the needs of a real project
- add an configuration page to let the admin configure dynamically the cart expiration delay and the daily report hour
- the application should be, but currently is not responsive
- add a better designed menu for the user
- allow a user to have several carts
- add visitor carts
- check if the cart expiration delay and the daily report hour have valid values
- retrieve the unit price only while validating the cart (currently it's retrieve when the product is put in the cart)
- add a confirmation dialog modal for sensitive actions like deleting a product
- attach the products to different categories and filter the market page with categories and keywords

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
