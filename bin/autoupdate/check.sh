#!/bin/sh

way=0

cd bin/autoupdate/
echo 'Check update.'
remote_md5=$(curl https://raw.githubusercontent.com/qoli/Merlin.PHP/master/bin/autoupdate/md5)
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
  	echo 'need update.'
  	echo '請點擊上方「實行更新」'
    ;;
esac

echo
cd bin/autoupdate/
echo $local_md5 '->' $(cat md5)
echo
date
