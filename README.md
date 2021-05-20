# Laravel Shop
Just a simple ecommerce app built with laravel

## Instalation
- Clone this repositry by `git clone https://github.com/miqdadyyy/Laravel-Shop`
- Run `composer install`
- Run `npm install && npm run prod`
- Run `cp .env.example .env`
- Run `php artisan key:gen`
- Set up environment database and stripe api on .env file
- Run `php artisan migrate --seed`
- Setup your stripe webhook when payment success on `/_webhook/stripe/success`
- Serve application

## Overview of this project
- I use [Stisla](https://github.com/stisla/stisla) Template for this project
- I use datatable for list transaction, customer and product
- I'm bad at frontend and designing css
- I only use stripe payment for this project
- I use Laravel Livewire also on cart

## Feature Checklist
| Feature                           | Status |
|-----------------------------------|--------|
| Register                          | ✅      |
| Login                             | ✅      |
| Category List                     | ✅      |
| Product List                      | ✅      |
| Cart                              | ✅      |
| Product Detail                    | ✅      |
| Stripe Payment                    | ✅      |
| Stripe Webhook Success            | ✅      |
| List, Detail Transaction          | ✅      |
| List, Detail Customer             | ✅      |
| List, Add, Delete, Update Product | ✅      |



