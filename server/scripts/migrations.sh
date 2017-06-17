#!/usr/bin/env bash

php /var/www/bin/console doctrine:database:create
php /var/www/bin/console doctrine:migrations:migrate -y