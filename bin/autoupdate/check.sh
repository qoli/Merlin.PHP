#!/bin/sh

way=0

# cd ../../
echo
remote_md5=$(curl https://raw.githubusercontent.com/qoli/Merlin.PHP/master/bin/autoupdate/md5)
local_md5=$(cat md5)
echo
echo "local :" $local_md5
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
  	echo
    ;;
esac
