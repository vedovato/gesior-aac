## Gesior-AAC

#### Caso esteja utilizando uniform server, siga o passo descrito no final do readme para habilitar a compatibilidade com o site.

#### If you are using uniform server, follow the step described at the end of the readme for enable compatibility with the sitte.

## Installation

### Requirements

* [Apache](http://www.apache.org/) with [mod_rewrite](http://httpd.apache.org/docs/current/mod/mod_rewrite.html) enabled + [PHP](http://php.net) Version 5.6 or newer

### How to install

* Clone the Gesior-AAC From Github.
* change the permission for write in /cache.

```bash
sudo chmod -R 777 /cache
```

### Tips and Tricks

* This website have some security implements, here you can use apache2 to apply them.
* run these commands to maximize your security.
````bash
sudo a2enmod headers
sudo a2enmod rewrite 
````
* on ubuntu 16.06 or 14.04 go to apache folder and edit your config.
* run:
````bash
sudo vim /etc/apache2/apache2.conf 
````
and search for something like this: 
```markdown
<Directory PATH_TO_YOUR_WEBSITE>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted         
</Directory>
```

* and add something like this /\

### PHP NEEDS THAT FOLLOWING
```bash
sudo apt-get install php5-gd
sudo apt-get install php5-curl
```

Make sure curl is enabled in the php.ini file. For me it's in /etc/php5/apache2/php.ini, if you can't find it, this line might be in /etc/php5/conf.d/curl.ini. Make sure the line :
extension=curl.so

now restart apache.:
```bash
sudo /etc/init.d/apache2 restart
```
or
```bash
sudo service apache2 restart
```

## Install composer https://getcomposer.org/download/

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer
```

After that in the terminal enter the site folder and run the command
```bash
cd /var/www/html && composer install
```

### FOR UBUNTU ACCOUNTING PROBLEMS
If you have trouble registering using ubuntu or any other version of php where the site claims to have registered but was not done, simply run the following command on your database:
```bash
SET GLOBAL sql_mode = '';
```

### UniformServer
If you are using UniformServer, you will need to enable the module that allows SSL
Go to: PHP/Edit Basic and Modules
PHP Modules Enable/Disable
Enable the "php_openssl.dll" file

## Main Dev
@riicksouzaa

## credits
@gesior <br>
@Felipe Monteiro <br>
And more developers

## License
* Open Source
