#!/usr/bin/env bash

# Install everything
sudo apt-get install -qq apache2

## Configure Apache
#WEBROOT="$(pwd)/htdocs"
#CGIROOT=`dirname "$(which php-cgi)"`
#echo "WEBROOT: $WEBROOT"
#echo "CGIROOT: $CGIROOT"
#sudo echo "<VirtualHost *:8080>
#        DocumentRoot $WEBROOT
#        <Directory />
#                Options FollowSymLinks
#                AllowOverride All
#        </Directory>
#        <Directory $WEBROOT >
#                Options Indexes FollowSymLinks MultiViews
#                AllowOverride All
#                Order allow,deny
#                allow from all
#        </Directory>
#
#</VirtualHost>" | sudo tee /etc/apache2/sites-available/001-php.conf> /dev/null
#sudo cat /etc/apache2/sites-available/001-php.conf
#sudo ls /etc/apache2/sites-available/

sudo a2enmod rewrite
sudo a2enmod actions
sudo service apache2 restart
sudo ls /var/www/
#sudo cat /etc/apache2/sites-enabled/000-default.conf

# PHP
sudo mkdir /var/www/php
sudo echo "<?php
             echo "hello world";
           ?>" > /var/www/html/index.php
sudo service apache2 restart

#sudo cp 001-php.conf /etc/apache2/sites-enabled/001-php.conf
#sudo cp 001-php.conf /etc/apache2/sites-available/001-php.conf
#sudo a2ensite 001-php
#sudo a2ensite php

# Configure custom domain
#echo "127.0.0.1 mydomain.local" | sudo tee --append /etc/hosts
#
#echo "TRAVIS_PHP_VERSION: $TRAVIS_PHP_VERSION"
#		# Configure PHP as CGI
#		ScriptAlias /local-bin $CGIROOT
#		DirectoryIndex index.php index.html
#		AddType application/x-httpd-php5 .php
#		Action application/x-httpd-php5 '/local-bin/php-cgi'
