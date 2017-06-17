#!/bin/bash

bin/wait-for-it "instaparser-postgresql:5432"
su -s /bin/bash www-data -c "bin/recreate"