#!/bin/bash



################################################################################
# Any errors should stop the script from continuing.
set -e



################################################################################
# Prepare for an unattended installation
export DEBIAN_FRONTEND=noninteractive



################################################################################
# Parameters

if [ ! -z $1 ]; then
	USER=$1
else
	read -p "=> User: " USER
fi

if [ ! -z $2 ]; then
	APP_DIR=$2
else
	read -p "=> App Directory: " APP_DIR
fi



################################################################################
## Nginx

cat <<EOF | sudo tee -a /etc/nginx/sites-enabled/web
server {
    listen 80 default_server;

    server_name web.dev;

    charset utf-8;

    root '${APP_DIR}/';

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
        fastcgi_pass  unix:/var/run/php/php7.0-fpm.sock;
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
## Cron

echo "* * * * * ${USER} /usr/bin/php ${APP_DIR}/cli.php background/manager" | sudo tee -a /etc/cron.d/app
echo "* * * * * ${USER} /usr/bin/php ${APP_DIR}/cli.php cron"               | sudo tee -a /etc/cron.d/app



################################################################################
# Install Composer dependencies

cd ${APP_DIR}

composer install --no-interaction



################################################################################
# Install NPM dependencies

cd ${APP_DIR}

npm install



################################################################################
#

cat <<EOF | sudo tee -a /home/vagrant/.bashrc
cd ${APP_DIR}
EOF



################################################################################
# Seed the database

# http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/tools.html
.vendor/bin/doctrine orm:schema-tool:create
