#!/bin/bash



################################################################################
# Any errors should stop the script from continuing.
set -e



################################################################################
# Prepare for an unattended installation
export DEBIAN_FRONTEND=noninteractive



################################################################################
# Update apt

sudo apt-get -y update



################################################################################
# PPAs and repositories

sudo apt-get -y install curl

sudo apt-get -y install software-properties-common
sudo apt-get -y install --reinstall ca-certificates

sudo apt-get -y install apt-transport-https

curl https://artifacts.elastic.co/GPG-KEY-elasticsearch | sudo apt-key add -
echo "deb https://artifacts.elastic.co/packages/6.x/apt stable main" | sudo tee -a /etc/apt/sources.list.d/elastic-6.x.list

sudo apt-get -y update



################################################################################
# Upgrade all software

sudo apt-get -y dist-upgrade



################################################################################
# Install nginx

sudo apt-get -y install nginx

sudo rm /etc/nginx/sites-enabled/default

sudo sed -i -e "s/user www-data;/user vagrant;/g" /etc/nginx/nginx.conf

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
# Install PHP 7

sudo apt-get -y install php7.2-fpm php7.2-cli

# PHP Extensions
sudo apt-get -y install php7.2-curl php-gettext php7.2-intl php7.2-bcmath php7.2-mbstring

sudo apt-get -y install php-xdebug

sudo apt-get -y install php-zip

sudo sed -i -e "s/user = www-data/user = vagrant/g" /etc/php/7.2/fpm/pool.d/www.conf
sudo sed -i -e "s/group = www-data/group = vagrant/g" /etc/php/7.2/fpm/pool.d/www.conf

sudo sed -i -e "s/listen.owner = www-data/listen.owner = vagrant/g" /etc/php/7.2/fpm/pool.d/www.conf
sudo sed -i -e "s/listen.group = www-data/listen.group = vagrant/g" /etc/php/7.2/fpm/pool.d/www.conf

sudo service php7.2-fpm restart



################################################################################
# Install Postgresql

sudo apt-get -y install postgresql-10

sudo apt-get -y install php7.2-pgsql

# See http://www.cyberciti.biz/faq/howto-add-postgresql-user-account/
sudo -u postgres psql -c "CREATE USER vagrant WITH PASSWORD 'vagrant';"

sudo -u postgres psql -c "CREATE DATABASE vagrant;"

sudo -u postgres psql -c "GRANT ALL PRIVILEGES ON DATABASE vagrant TO vagrant;" vagrant

sudo -u postgres psql -c "ALTER USER vagrant WITH PASSWORD 'vagrant';" vagrant



################################################################################
# Install ElasticSearch (and Java)

sudo apt-get -y install openjdk-11-jdk

sudo apt-get -y install elasticsearch

# Reduce heap size to 512MB.
sudo sed -i -e 's/-Xms1g/-Xms512m/' /etc/elasticsearch/jvm.options
sudo sed -i -e 's/-Xmx1g/-Xmx512m/' /etc/elasticsearch/jvm.options

sudo service elasticsearch start

sudo update-rc.d elasticsearch defaults



################################################################################
# Install Redis

sudo apt-get -y install redis-server

sudo apt-get -y install php-redis



################################################################################
# Install Beanstalkd

sudo apt-get -y install beanstalkd

cat <<EOF | sudo tee -a /etc/default/beanstalkd
START=yes

BEANSTALKD_LISTEN_ADDR=127.0.0.1
BEANSTALKD_LISTEN_PORT=11300
BEANSTALKD_EXTRA="-b /var/lib/beanstalkd"
EOF



################################################################################
# Install Git

sudo apt-get -y install git



################################################################################
# Install Composer

sudo apt-get -y install unzip

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

sudo php composer-setup.php --install-dir=/usr/local/bin/ --filename=composer

rm composer-setup.php



################################################################################
# Bash

cat <<EOF | sudo tee -a /home/vagrant/.bashrc
# Colorize the prompt.
yellow=\$(tput setaf 3)
green=\$(tput setaf 2)
blue=\$(tput setaf 104)
bold=\$(tput bold)
reset=\$(tput sgr0)

PS1="\[\$yellow\]\u\[\$reset\]@\[\$green\]\h\[\$reset\]:\[\$blue\$bold\]\w\[\$reset\]\$ "

# Don't put duplicate lines or lines starting with space in the history.
# See bash(1) for more options.
export HISTCONTROL=ignoreboth

# Append to the history file, don't overwrite it.
shopt -s histappend

# History size up to 1000 commands.
export HISTSIZE=1000

# Make less more friendly for non-text input files, see lesspipe(1).
[ -x /usr/bin/lesspipe ] && eval "\$(SHELL=/bin/sh lesspipe)"

# Enable color support of ls and also add handy aliases.
export CLICOLOR=1
export LSCOLORS=ExFxCxDxBxegedabagacad
if [ -x /usr/bin/dircolors ]; then
    test -r ~/.dircolors && eval "\$(dircolors -b ~/.dircolors)" || eval "\$(dircolors -b)"
    alias ls='ls --color=auto'
    alias grep='grep --color=auto'
    alias fgrep='fgrep --color=auto'
    alias egrep='egrep --color=auto'
fi

# Enable programmable completion features (you don't need to enable this, if
# it's already enabled in /etc/bash.bashrc and /etc/profile sources
# /etc/bash.bashrc).
if [ -f /etc/bash_completion ] && ! shopt -oq posix; then
    . /etc/bash_completion
fi

export VISUAL=nano
export EDITOR=nano

export PATH=/usr/local/bin:\$PATH

export PATH=~/.composer/vendor/bin:\$PATH

cd /app/
EOF



################################################################################
# Install NPM

sudo apt-get -y install npm



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



################################################################################
# Clean up APT packages

sudo apt-get -y autoremove
sudo apt-get -y clean

sudo rm -rf /tmp/* /var/tmp/*
