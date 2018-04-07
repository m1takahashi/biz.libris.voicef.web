# サーバーインストール #

```
# mkdir logs
# chmod 777 logs/

# useradd voicef
# passwd voicef
# rm -rfv voicef/

# yum install mariadb mariadb-server
# vi /etc/my.cnf
character-set-server=utf8

# systemctl enable mariadb.service
# systemctl start mariadb.service

# mysql_secure_installation

# yum install -y php

# cd /usr/local/src/
# curl https://packages.zendframework.com/zftool.phar > zftool.phar
# chmod +x zftool.phar 
# ./zftool.phar install zf /usr/share/zf2
# ln -s /usr/share/zf2/library/Zend/ /usr/share/php

# vi /etc/php.ini
date.timezone = 'Asia/Tokyo'

# yum install php-mysql
# yum install php-mbstring
# yum install php-xml

# wget https://files.phpmyadmin.net/phpMyAdmin/4.4.15.1/phpMyAdmin-4.4.15.1-all-languages.zip
# unzip phpMyAdmin-4.4.15.1-all-languages.zip 
# mv phpMyAdmin-4.4.15.1-all-languages /usr/share/phpmyadmin

# yum install memcached
# systemctl enable memcached.service
# systemctl start memcached.service

# yum -y install php-pecl-memcache

# yum install php-pear
# yum install ImageMagick*
# pecl install Imagick
# yum install php-devel
# pecl install Imagick
# php -i | grep Imagick

pecl install memcached
```


# php.ini
```
extension=imagick.so
extension=memcached.so

```