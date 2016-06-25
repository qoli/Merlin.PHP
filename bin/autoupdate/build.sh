#!/bin/sh

MD5=$(date '+%A %W %Y %X' | md5 -r | awk '{ print $1 }')
echo $MD5 > md5
COPYFILE_DISABLE=1 tar -zcvf merlin-php.tar.gz -C ./../../../ --exclude=Merlin.PHP/bin/zip/ --exclude=Merlin.PHP/.* --exclude=Merlin.PHP/sftp-config.json  --exclude=Merlin.PHP/md5 Merlin.PHP
mv merlin-php.tar.gz ../zip/
cat md5
