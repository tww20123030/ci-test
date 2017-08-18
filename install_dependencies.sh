#!/usr/bin/env bash

# Install everything
sudo apt-get install -qq apache2 libapache2-mod-fastcgi libapache2-mod-php5
sudo apt-get install php5-cgi
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
#</VirtualHost>" | sudo tee /etc/apache2/sites-available/default> /dev/null
sudo cat /etc/apache2/apache2.conf ##
#sudo ls /etc/apache2/sites-available/

sudo a2enmod fastcgi alias
sudo a2enmod rewrite    #url rewrite rule
sudo a2enmod actions
sudo service apache2 restart
#sudo ls /var/www/  ##removed
#sudo cat /etc/apache2/sites-enabled/000-default.conf

# PHP
sudo mkdir /var/www/php
sudo mkdir /var/www/html/ci-test ##added

sudo rm /var/www/html/index.html
#sudo touch /var/www/html/index.php
echo "<?php
             echo 'hello world';
           ?>" | sudo tee /var/www/html/index.php
sudo cp Request.php Response.php .htaccess index.php /var/www/html/ci-test  ##
ls   /var/www/html/ci-test         ##
#sudo cp 000-default.conf /etc/apache2/sites-enabled/000-default.conf
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
