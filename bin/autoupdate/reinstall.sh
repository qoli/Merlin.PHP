#!/bin/sh

way=0

cd bin/autoupdate/
echo 'Reinstall. Still working'
echo
rm -rf /tmp/m_update
rm -rf /opt/share/www/*
mkdir /tmp/m_update
cd /tmp/m_update
wget https://github.com/qoli/Merlin.PHP/raw/master/bin/zip/merlin-php.tar.gz --no-cache --no-check-certificate --no-dns-cache
echo 'extract...'
echo
tar zxvf merlin-php.tar.gz
echo 'copying...'
echo
mkdir /opt/share/www/ -p
cd /tmp/m_update/Merlin.PHP/
cp * /opt/share/www/ -R
echo 'install done'

echo
cd bin/autoupdate/
echo $local_md5 '->' $(cat md5)
echo
date
