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

cat <<EOF | sudo tee -a /etc/nginx/sites-enabled/web
server {
    listen 80 default_server;

    server_name web.dev;

    charset utf-8;

    root '/app/';

    sendfile off;

    client_max_body_size 20M;



    location = /favicon.ico {
        access_log off;
        break;
    }

    location ~ /(fonts|img)/ {
        break;
    }

    location / {
        rewrite ^(.*)$ /web.php last;
    }

    location = /web.php {
        fastcgi_pass  unix:/var/run/php/php7.2-fpm.sock;
        fastcgi_index /web.php;

        include fastcgi_params;
        fastcgi_split_path_info       ^(.+\.php)(/.+)$;
        fastcgi_param PATH_INFO       \$fastcgi_path_info;
        fastcgi_param PATH_TRANSLATED \$document_root\$fastcgi_path_info;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
    }
}
EOF

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
