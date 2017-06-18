#!/bin/bash

php bin/console doctrine:database:drop --if-exists --force
php bin/console doctrine:database:create
echo "y" | php bin/console doctrine:migrations:migrate