# Task: Mini medical practice management system - admin dashboard

Basically, project to manage practices and their employees.

- Basic Laravel Auth ability to log in as administrator
- Use database seeds to create first user with email and password
- CRUD functionality (Create / Read / Update / Delete) for three menu items: Practices,
Employees, Fields of practice
- Practices DB table consists of these fields: name (required), email, logo (minimum 100×100),
website
- Employees DB table consists of these fields: first name (required), last name (required), practice
(foreign key to Practices), email, phone
- Fields of practice table should contain registry of tags. Each Practice can be associated with
multiple fields of practice.
- Use database migrations to create those schemas above
- Store practices’ logos in storage/app/public folder and make them accessible from public
- Use basic Laravel’s resource controllers with default methods – index, create, store etc.
- Use Laravel’s validation function, using Request classes for required and email format validation
- Use Laravel’s pagination for showing Practices/Employees list, 10 entries per page
- Create view to show single Practice entry with all details included (e.g. employees listing, fields
of practice)
- Use Laravel make:auth as default Bootstrap-based design theme, but remove ability to register
- Create an API endpoint for listing all practices in database (unauthenticated)
- Add final project to Git repository
- Deploy to test server (DigitalOcean, Linode …)

## Install and Test
```shell
$ composer install
$ npm install
$ php artisan migrate --seed # Login: "admin@example.com" / "password"
$ php artisan serve
```
