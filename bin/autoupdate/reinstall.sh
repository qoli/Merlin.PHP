#!/bin/sh

way=0

cd bin/autoupdate/
echo 'Reinstall. Still working'
echo
rm -rf /tmp/m_update
mkdir /tmp/m_update
cd /tmp/m_update
curl -LO https://github.com/qoli/Merlin.PHP/raw/master/bin/zip/merlin-php.tar.gz
echo 'extract...'
rm -rf /opt/share/www/*
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
chmod +x /opt/share/www/bin/autoupdate/update.sh
chmod +x /opt/share/www/bin/autoupdate/check.sh
chmod +x /opt/share/www/bin/autoupdate/reinstall.sh
chmod +x /opt/share/www/bin/script/ssconfig.sh
chmod +x /opt/share/www/bin/script/netspeed.sh
date
