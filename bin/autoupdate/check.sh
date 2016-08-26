#!/bin/sh

way=0

cd bin/autoupdate/
echo 'Checking update.'
remote_md5=$(curl -N --no-buffer https://raw.githubusercontent.com/qoli/Merlin.PHP/master/bin/autoupdate/md5)
local_md5=$(cat md5)
echo
echo "local:" $local_md5
echo "remote:" $remote_md5
echo

if [ "$remote_md5" != "$local_md5" ]; then
	way='need'
fi

if [ "$remote_md5" == "" ]; then
	way='empty'
fi

case $way in
  0)
    echo 'The version is up-to-date.'
    echo
		cd bin/autoupdate/
		echo $local_md5 '->' $(cat md5)
    ;;
  need)
  	echo 'need update.'
  	echo '請點擊上方「實行更新」'
    ;;
  empty)
  	echo 'github.com timeout'
  	echo '與 github.com 的通信失敗'
    ;;
esac

chmod +x /opt/share/www/bin/autoupdate/update.sh
chmod +x /opt/share/www/bin/autoupdate/check.sh
chmod +x /opt/share/www/bin/autoupdate/reinstall.sh
chmod +x /opt/share/www/bin/script/ssconfig.sh
chmod +x /opt/share/www/bin/script/netspeed.sh

echo
date
