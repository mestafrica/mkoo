# MEST Kitchen Online Ordering

Order for your lunch and supper online to improve your eating experience at MEST

[![Build Status](https://travis-ci.org/mestafrica/mkoo.svg?branch=develop)](https://travis-ci.org/mestafrica/mkoo)

## Getting started

You must make sure you have both [PHP](http://php.net/) (at least php7.1) and [composer](https://getcomposer
.org/download/) installed on your computer before running the commands below.

* `git clone https://github.com/mestafrica/mkoo.git` # clones this repository
* `cd mkoo`
* `composer install` # installs project dependencies
* `cp .env.example .env` # setup environment variables in here
* Update .env with appropriate config database settings, for instance
* Add *CLIENT_ID* and *SECRET_KEY* (grabbed from Google Developer Console)
* `php artisan key:generate`
* `php artisan migrate` # run migrations
* `php artisan serve` # starts a development web server
* Visit [http://localhost:8000](http://localhost:8000) to see the application

## Documentation

Stop by the [wiki](https://github.com/mestafrica/mkoo/wiki), you might find something informative there.
