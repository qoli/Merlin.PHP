#!/bin/sh
echo
echo 'script - 2016-06-24 03:13:54'
echo
echo 'INSTALL Merlin.PHP'
echo
echo '「STEP 1」IPKG'
ipkg update
ipkg upgrade
ipkg install lighttpd nano http://www.llqoli.com/ipks/gdbm_1.8.3-4_arm.ipk php-fcgi php-curl
sed -i 's/server.port                = 8081/server.port                = 81/g' "/opt/etc/lighttpd/lighttpd.conf"
/opt/etc/init.d/S80lighttpd restart
app_set_enabled.sh lighttpd yes
echo
echo '「STEP 2」CODE'
echo
rm -rf /tmp/m_update
# rm -rf /opt/share/www/
mkdir /tmp/m_update
cd /tmp/m_update
wget https://github.com/qoli/Merlin.PHP/raw/master/bin/zip/merlin-php.tar.gz --no-cache --no-check-certificate --no-dns-cache
echo 'extract...'
echo
tar ﹣xvzf merlin-php.tar.gz
echo 'copying...'
echo
mkdir /opt/share/tmp/ -p
cd /tmp/m_update/Merlin.PHP/
cp * /opt/share/tmp/ -R
echo 'install done'
echo
echo 'open http://192.168.1.1:81 and enjoy.'
