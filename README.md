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
$ yarn run encore production --config assets/themes/acme/webpack.config.js
$ php bin/console server:start

```

## Docker
```
docker-compose build
docker-compose up 
docker exec -it doven_php_1 bin/console doctrine:database:create
docker exec -it doven_php_1 bin/console doctrine:schema:create
docker exec -it doven_php_1 doctrine:fixtures:load --no-interaction
docker exec -it doven_php_1 yarn run encore production --config assets/themes/acme/webpack.config.js
docker exec -it doven_php_1 bin/console server:start

connect to http://symfony.localhost/
```
Now open page http://127.0.0.1:8000/ in your browser and enjoy! 😎