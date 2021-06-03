## Gesior-AAC

#### Caso esteja utilizando uniform server, siga o passo descrito no final do readme para habilitar a compatibilidade com o site.

#### If you are using uniform server, follow the step described at the end of the readme for enable compatibility with the site.

## Installation

### Requirements

* [Apache](http://www.apache.org/) with [mod_rewrite](http://httpd.apache.org/docs/current/mod/mod_rewrite.html) enabled + [PHP](http://php.net) Version 7.4 or newer

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
* on ubuntu 18.04 or 20.04 go to apache folder and edit your config.
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
sudo apt-get install php7.4-gd
sudo apt-get install php7.4-curl
```

Make sure curl is enabled in the php.ini file. For me it's in /etc/php7/apache2/php.ini, if you can't find it, this line might be in /etc/php7/conf.d/curl.ini. Make sure the line :
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

### Uniform Server
If you are using Uniform Server, you will need to enable the module that allows curl and SSL.
* Go to: PHP/Edit Basic and Modules, PHP Modules Enable/Disable.
* Enable the options "curl" and "openssl".

## Main Dev
@riicksouzaa

## credits
@gesior <br>
@Felipe Monteiro <br>
And more developers

## License
* Open Source
