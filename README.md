## About L-commerce

Build with laravel 10, this project included docker-compose.yml for laravel sail,service inside docker is the app it self, mysql and mail hog for email verification after register. this project using stripe for payment gateway, please make account on stripe to use the feature

## Running project manual

```
cp .env.example .env
composer install
php artisan migrate:fresh --seed
php artisan passport:install
npm install
npm run dev
```

## Running project with laravel sail

Install docker first.

```
cp .env.example .env
composer install
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate:fresh --seed
./vendor/bin/sail artisan passport:install
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

then open http://localhost from browser, to access mail hog, open http://localhost:8025.

## Stripe

after register in stripe website, place the key to .env file

```
STRIPE_SECRET_KEY=
STRIPE_KEY=
STRIPE_WEBHOOK_SECRET=
```

## Database design

![alt text](l-commerce-diagram.png "Database Diagram")


## Admin management

Admin management use rest API for create, update and delete product, please use postman. when running migrate command with seed, the admin user will create.

```
email: jon@doe.com
password: admin123
```

## Postman setting

add 2 headers

```
Accept: application/json
Content-Type: application/json
```

the admin management using oauth authentication, after login from postman you will retrieve json like this.

```JSON
{
    "user": {
        "id": 1,
        "name": "Admin",
        "email": "jon@doe.com",
        "created_at": "2023-11-09 03:35:27"
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOWFkNzcwZWNkMzRlYmMxZDgxNjA4YjRhMmQ0NDQ1MzhlZGI2ZjljMmI4YWQwNDdiNWQ0OWRkMjc2M2UxZDM3YzczYjU5YTZmZmYzNDg3MDciLCJpYXQiOjE2OTk1MDE0MjQuMDk1NTgyLCJuYmYiOjE2OTk1MDE0MjQuMDk1NTgzLCJleHAiOjE3MzExMjM4MjQuMDcyMzQ2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Unlw4Yb3ZI1kFEHNHvbNSBFByPz4256QayuNTUOyqPtv3BhpAn0qarC9ZPzydQcqhzyryUYMP7I2b5JjwQtSR5g7KatyLJwlrbcX8ovGQuO8kDDzXGLRkOR6--4mIXdHrf6Sn8h-ct7-2340hBtrZ_URaMKa0fmz_gW7nbh9FFk1cKaWVWN62qa1huq0HyMlO1ii97wATRGO-nv4imMFCHBvlcQb46W7DwyvG40wkyehVETpd6mC_IytD75cOCJpz2QpYRlhEMriRs6OtdYHE8iY3ialleqX8NmYw4BuIlQDRsbQ3LebnpU-x1ejysYlJZBU36-lxruIklOZvtMaih3xwncZx8uxotXJfetAxq4WCv50xvU12fbUeaOiDQSSkK0PQ1C_OuwoDa9dDCwlri6G7d2w1zN9pMj3QYq8nmeAeqQUnCy0RK4K9cm0Cs-pDrtiIIDfX-u6EhTrhF0sOqX0mK8nR-6bYFtKFQF9gD_8-loM5TBKg67ytcRKaOQWSTToRWJYoAcFrXzqodfEGhksi92V9KAe8fHqkTtSXSkpnOeB4J8iTe2Bd_e0308Vyo4ONgzm7zTCRmteJO2-0dNINZYzfyUpzOFnEwk-ThvYp7cMNGPusgZVbGdIaZMOoK8iihUXPRI5Q5_fy6aGWGjk4RyfFJEzqLMZw64q0Zo"
}
```

the token we retrieve from login will use for bearer authentication in postman.


## API route

```
GET|HEAD        api/categories ... categories.index › Api\V1\CategoryController@index
  POST            api/categories ... categories.store › Api\V1\CategoryController@store
  GET|HEAD        api/categories/tree ... Api\V1\CategoryController@getAsTree
  PUT|PATCH       api/categories/{category} ... categories.update › Api\V1\CategoryController@update
  DELETE          api/categories/{category} ... categories.destroy › Api\V1\CategoryController@destroy
  GET|HEAD        api/countries ... Api\V1\CustomerController@countries
  GET|HEAD        api/customers ... customers.index › Api\V1\CustomerController@index
  POST            api/customers ... customers.store › Api\V1\CustomerController@store
  GET|HEAD        api/customers/{customer} ... customers.show › Api\V1\CustomerController@show
  PUT|PATCH       api/customers/{customer} ... customers.update › Api\V1\CustomerController@update
  DELETE          api/customers/{customer} ... customers.destroy › Api\V1\CustomerController@destroy
  GET|HEAD        api/dashboard/customers-count ... Api\V1\DashboardController@activeCustomers
  GET|HEAD        api/dashboard/income-amount ... Api\V1\DashboardController@totalIncome
  GET|HEAD        api/dashboard/latest-customers ... Api\V1\DashboardController@latestCustomers
  GET|HEAD        api/dashboard/latest-orders ... Api\V1\DashboardController@latestOrders
  GET|HEAD        api/dashboard/orders-by-country ... Api\V1\DashboardController@ordersByCountry
  GET|HEAD        api/dashboard/orders-count ... Api\V1\DashboardController@paidOrders
  GET|HEAD        api/dashboard/products-count ... Api\V1\DashboardController@activeProducts
  POST            api/login ... Api\V1\AuthController@login
  POST            api/logout ... Api\V1\AuthController@logout
  GET|HEAD        api/orders ... Api\V1\OrderController@index
  POST            api/orders/change-status/{order}/{status} ... Api\V1\OrderController@changeStatus
  GET|HEAD        api/orders/statuses ... Api\V1\OrderController@getStatuses
  GET|HEAD        api/orders/{order} ... Api\V1\OrderController@view
  GET|HEAD        api/products ... products.index › Api\V1\ProductController@index
  POST            api/products ... products.store › Api\V1\ProductController@store
  GET|HEAD        api/products/{product} ... products.show › Api\V1\ProductController@show
  PUT|PATCH       api/products/{product} ... products.update › Api\V1\ProductController@update
  DELETE          api/products/{product} ... products.destroy › Api\V1\ProductController@destroy
  POST            api/register ... Api\V1\AuthController@register
  GET|HEAD        api/report/customers ... ReportController@customers
  GET|HEAD        api/report/orders ... ReportController@orders
  GET|HEAD        api/user ... Api\V1\AuthController@getUser
  GET|HEAD        api/users ... users.index › Api\V1\UserController@index
  POST            api/users ... users.store › Api\V1\UserController@store
  GET|HEAD        api/users/{user} ... users.show › Api\V1\UserController@show
  PUT|PATCH       api/users/{user} ... users.update › Api\V1\UserController@update
  DELETE          api/users/{user} ... users.destroy › Api\V1\UserController@destroy
```
