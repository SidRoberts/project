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
# Install NPM dependencies

cd /app/

npm install



################################################################################
# Install Composer dependencies

cd /app/

composer install --no-interaction



###############################################################################
## Cron

echo "* * * * * vagrant /usr/bin/php /app/cli.php background/manager" | sudo tee -a /etc/cron.d/app
echo "* * * * * vagrant /usr/bin/php /app/cli.php cron"               | sudo tee -a /etc/cron.d/app



################################################################################
# Seed the database

# http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/tools.html
.vendor/bin/doctrine orm:schema-tool:create
