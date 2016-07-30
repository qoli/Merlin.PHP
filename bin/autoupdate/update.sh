#!/bin/sh

way=0

cd bin/autoupdate/
echo 'update.'
remote_md5=$(curl -N --no-buffer https://raw.githubusercontent.com/qoli/Merlin.PHP/master/bin/autoupdate/md5)
local_md5=$(cat md5)
echo
echo "local:" $local_md5
echo "remote:" $remote_md5
echo

if [ "$remote_md5" != "$local_md5" ]; then
	way='need'
fi

case $way in
  0)
    echo 'The version is up-to-date.'
    ;;
  need)
  	echo 'need update. Still working'
  	echo
		rm -rf /tmp/m_update
		# rm -rf /opt/share/www/
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
		echo 'update done'
    ;;
esac

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
