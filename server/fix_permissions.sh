#!/bin/bash
set -e

echo '* Fixing permissions issue (https://github.com/docker-library/mysql/issues/99)'
HOST_USER_UID=$(stat -c "%u" /var/www)
echo "-- Setting www-data user to use uid ${HOST_USER_UID}"
usermod -o -u "${HOST_USER_UID}" www-data || true
HOST_USER_GID=$(stat -c "%g" /var/www)
echo "-- Setting www-data group to use gid ${HOST_USER_GID}"
groupmod -o -g "${HOST_USER_GID}" www-data || true
echo
/sbin/my_init