#!/usr/bin/env bash

# Go install a LAMP stack
apt-get update
apt-get -q -y install php5-gd apache2 php5
apt-get -q -y install curl libcurl3 libcurl3-dev php5-curl

sudo apt-get install -y php5-fpm php5-cli php5-curl php5-json php5-gd php5-mcrypt php5-xdebug php5-memcached php5-imagick php5-intl
echo 'PHP installed'

sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password mypass'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password mypass'
sudo apt-get -q -y install mysql-server-5.5 php5-mysql

# Database and import data...
mysql -h localhost -u root -pmypass -e "CREATE DATABASE jamesdoc"
mysql -h localhost -u root -pmypass jamesdoc < /vagrant/data.sql
mysql -h localhost -u root -pmypass -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '' WITH GRANT OPTION; FLUSH PRIVILEGES;"
echo 'MySQL installed & external permissions granted...'

# Enable modrewrite because we can
a2enmod rewrite
sed -i '/AllowOverride None/c AllowOverride All' /etc/apache2/sites-available/default

service apache2 restart

echo 'And away we go...'
