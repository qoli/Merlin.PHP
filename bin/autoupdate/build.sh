#!/bin/sh

tar -cvf merlin-php.tar.gz -C ./../../../ --exclude=Merlin.PHP/bin/zip/ --exclude=Merlin.PHP/.* Merlin.PHP
mv merlin-php.tar.gz ../zip/
# md5sum='md5 -r'
MD5=$(md5 -r ../zip/merlin-php.tar.gz | awk '{ print $1 }')
echo $MD5 > ./md5
