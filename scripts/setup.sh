#!/bin/bash
echo "Doing Final Setup"
sudo apt-get -y install mysql-server
sudo apt-get install -y php7.0-mysql
mysql_secure_installation
mysql -u root -ptoor -e "CREATE DATABASE USER;"
sudo apt-get -y install  phpmyadmin
sudo a2dismod php5
sudo service apache2 restart
cd /var/www/html


sudo cat > /var/www/html/.env <<- "EOF"
APP_ENV=local
APP_KEY=base64:dLPFN9w7IsGoaZpif642ZJvvsueRXx+EhWaB/dvDfiM=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=USER
DB_USERNAME=root
DB_PASSWORD=toor

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=work@tier5.us
MAIL_PASSWORD=!Aworker2#4
MAIL_ENCRYPTION=tls

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=


EOF

php artisan migrate
php artisan db:seed
php artisan key:generate

sudo chmod -R a+w bootstrap/cache/ storage/

sudo cat > /etc/apache2/sites-available/000-default.conf <<- "EOF"
<VirtualHost *:80>
        # The ServerName directive sets the request scheme, hostname and port that
        # the server uses to identify itself. This is used when creating
        # redirection URLs. In the context of virtual hosts, the ServerName
        # specifies what hostname must appear in the request's Host: header to
        # match this virtual host. For the default virtual host (this file) this
        # value is not decisive as it is used as a last resort host regardless.
        # However, you must set it for any further virtual host explicitly.
        #ServerName www.example.com

        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/html/public
        DirectoryIndex index.php 
<Directory /var/www/html/public>
        AllowOverride All
</Directory>
        # Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
        # error, crit, alert, emerg.
        # It is also possible to configure the loglevel for particular
        # modules, e.g.
        #LogLevel info ssl:warn

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

        # For most configuration files from conf-available/, which are
        # enabled or disabled at a global level, it is possible to
        # include a line for only one particular virtual host. For example the
        # following line enables the CGI configuration for this host only
        # after it has been globally disabled with "a2disconf".
        #Include conf-available/serve-cgi-bin.conf
</VirtualHost>

# vim: syntax=apache ts=4 sw=4 sts=4 sr noet
EOF
sudo a2ensite 000-default.conf
sudo service apache2 restart

echo -e "\nPutting vagrant cache and log into .gitignore\n"
cat >> .gitignore <<-"EOF"
.vagrant
ubuntu-xenial-16.04-cloudimg-console.log
EOF

echo -e "\nPutting Apache2 into default user group\n"
sudo usermod -a -G ubuntu www-data

echo -e "\nRestarting Apache2 Service\n"
sudo systemctl restart apache2.service