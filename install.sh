#!/bin/bash

# Any errors should stop the script from continuing.
set -e

# Prepare for an unattended installation
export DEBIAN_FRONTEND=noninteractive



################################################################################
# Update apt and packages

sudo apt-get -y update

sudo apt-get -y dist-upgrade



################################################################################
# Install nginx

sudo cp site.conf /etc/nginx/sites-enabled/web

sudo service nginx restart



################################################################################
# Install dependencies

cd /app/

npm install

composer install --no-interaction



###############################################################################
## Cron

sudo cp cron /etc/cron.d/app



################################################################################
# Seed the database

# http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/tools.html
.vendor/bin/doctrine orm:schema-tool:create
