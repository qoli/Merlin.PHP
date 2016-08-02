#!/bin/sh
path=$(cd `dirname $0`; pwd)
echo "{"
# echo '  "Run Path": "'${path}'",'
echo '  "arp": "'$(arp | awk '{print $1,$2","}')'",'
echo '  "date": "'$(date)'"'
echo "}"
