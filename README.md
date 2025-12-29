# Trustfactory eCommerce Challenge Project

## Technology stack

### Backend technologies

- Laravel v12
- Fortify v1
- Sanctum v4

### Frontend technologies

- VueJS v3
- TailwindCSS v4

### Database

To get it easier for the demonstration, I have use a simple SQLite database.

## Setup steps

### .env file

Make a copy of the .env.example file to the .env file and complete the following lines with your own data.

```
MAIL_USERNAME=
MAIL_PASSWORD=

CART_EXPIRATION_DELAY=1
DAILY_REPORT_HOUR=22:00
```

### Dependencies installation and app key generation

Execute the next commands to install all dependencies (PHP and node).

(perhaprs you need to install composer globally in your development environment)

```
composer install
npm run dev && npm run build
php artisan key:generate
```

### Application initialization

You can initialize the database fake users and fake products.

```
php artisan teac:init
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
- 

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
