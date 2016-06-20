#!/bin/sh

MD5=$(date '+%A %W %Y %X' | md5 -r | awk '{ print $1 }')
echo $MD5 > md5
tar -cvf merlin-php.tar.gz -C ./../../../ --exclude=Merlin.PHP/bin/zip/ --exclude=Merlin.PHP/.* --exclude=Merlin.PHP/sftp-config.json  --exclude=Merlin.PHP/md5 Merlin.PHP
mv merlin-php.tar.gz ../zip/
# md5sum='md5 -r'
# MD5=$(md5 -r ../zip/merlin-php.tar.gz | awk '{ print $1 }')
cat md5
