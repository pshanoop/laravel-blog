## Laravel 5.1 Based simple blog system



## Installation

```sh
composer install
php artisan migrate:install --seed
```
## Application Configuration

You have to create .env file or make environment file variable for application configuration.
More details on [laravel doc](http://laravel.com/docs/5.1/installation#environment-configuration).
as reference you use `.env.example` file.

## Creating new user

By default a user will be creating during seeding.
`User name: admin`
`Password: demo`
You can change this
To create new user use this command

```sh
php artisan newUser
```
### Thanks
 Thank you [Taylor Otwell](https://github.com/taylorotwell) and other contributors for creating an awesome framework
### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
