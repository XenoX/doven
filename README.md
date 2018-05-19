# Doven

## About
Doven is a homemade CMF to easily generate a esport websites 

## Installation

```
$ git clone git@github.com:XenoX/doven.git
$ cd doven
$ composer install
$ yarn install
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:create
$ php bin/console doctrine:fixtures:load --no-interaction
$ yarn run encore dev --config assets/themes/acme/webpack.config.js
$ php bin/console server:start

```
Now open page http://127.0.0.1:8000/ in your browser and enjoy! 😎