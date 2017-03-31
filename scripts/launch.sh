sudo apt-add-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get -y install zip
sudo apt-get -y install git
sudo apt-get -y install apache2
sudo apt-get -y install php7.0 libapache2-mod-php7.0 php7.0-mcrypt php7.0-mbstring php7.0-dom php7.0-curl php7.0-cli
sudo phpenmod mcrypt
sudo a2enmod rewrite
sudo service apache2 restart
sudo curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
cd /var/www/html
rm -rf index.html
sudo composer install
sudo composer update