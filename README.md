# Mini

Mini is a small Laravel application with 2 modules to go with the book [Laravel: The Modular Way](https://modularlaravel.com)

## Install

Clone this repo

```
git clone git@github.com:dcblogdev/mini.git mini
```
Run the migration and seeds in a single action:

```
php artisan db:build
```

Run the app:

```
php artisan serve
```

Next register a user account by clicking Register on the browser.

Upon registering you will be logged in, no email validation is enforced.

The 2 modules `Contacts` and `Serials` can be accessed from the sidebar.
