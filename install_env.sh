#!/usr/bin/env bash

# Install everything
#sudo apt-get install lamp-server^
sudo apt-get install -qq apache2
#sudo ls /var/www/
sudo service apache2 restart
