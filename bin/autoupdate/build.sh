#!/bin/sh

tar -cvf merlin-php.tar.gz -C ./../../../ --exclude=Merlin.PHP/bin --exclude=Merlin.PHP/.* Merlin.PHP
# md5sum='md5 -r'
MD5=$(md5 -r merlin-php.tar.gz | awk '{ print $1 }')
echo $MD5 >>./md5
