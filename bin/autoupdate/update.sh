#!/bin/sh
cd /tmp
wget https://github.com/qoli/Merlin.PHP/archive/master.zip --no-check-certificate
unzip master.zip
cd Merlin.PHP-master
cp * /opt/share/www/ -R
