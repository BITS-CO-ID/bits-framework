# BITS Framework

BITS Framework allow to create, manage, analyze, and publish our client, partner, project, payment, and file management.

Featured :

 * Project Management
    * Project Type
    * Programming Language
    * Database Platform
    * Progress Monitoring
    * Project by Status
    * Project by Type
    * Project by Programming
    * Project by Database
    * Project File Management
    * Project Service Management
    * Project Invoice Management
    * Project Payment Management
    * Project Tasks Management
 * Client Management
    * Project Monitoring
    * Payment Monitoring
    * Invoice Monitoring
 * Staff Management
    * Staff Role
    * Staff Profile
    * Staff Timelines Statuses
    * Staff Project Assigned
    * Staff Task Assigned
    * Staff Private Messages
 * Billing Management
    * Generate Invoice
    * Send Invoice
    * Payment Notification


## Install

Install BITS Framework

```
cd /var/www
git clone git@gitlab.com:BITS-CO-ID/bpms.git bpms
cd bpms
composer update
bower install --allow-root
npm install
grunt
```

## Configurations

### Nginx + PHP-FPM

Install Nginx & PHP-FPM (Debian & Ubuntu)

```
apt-get install nginx php5-fpm
```
Nginx Configuration for BITS Framework

```
cd /etc/nginx/sites-available
nano bpms.dev
```

Insert the following Nginx Config
```
server {
    listen 80;

    root /var/www/bpms;
    index index.php index.html index.htm;
    server_name bpms.dev;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```
Enable Nginx Configuration
```
ln -s /etc/nginx/sites-available/bpms.dev /etc/nginx/sites-enabled/bpms.dev
```
Restart Nginx & PHP-FPM
```
service php5-fpm restart
service nginx restart
```
### Database Configuration

Install MariaDB
```
apt-get install mariadb-server php5-mysql
```

Install MySQL
```
apt-get install mysql-server php5-mysql
```

Install phpMyAdmin
```
apt-get install phpmyadmin
ln -s /usr/share/phpmyadmin /var/www/bpms/phpmyadmin
```
#### Import Database
Open http://bpms.dev/phpmyadmin in your browser. Create database and import bpms.sql to your database.

#### Start BITS Framework
Open http://bpms.dev in your browser & enjoy it !

### Created & Supported by :

 * [BITS.CO.ID](https://bits.co.id) - Banten IT Solutions official sites
 * [BITS.MY.ID](http://bits.my.id) - BITS Framework
 * [Banten IT Solutions](http://www.banten-it.com) - Banten IT Solutions official sites
 * [Nurul Imam Studio](http://www.nurulimam.com) - Nurul Imam at Project Manager
