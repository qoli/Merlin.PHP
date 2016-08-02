#!/bin/sh
path=$(cd `dirname $0`; pwd)
echo "{"
# echo '  "Run Path": "'${path}'",'
echo '  "Processor": "'$(cat /proc/cpuinfo | grep 'Processor')'",'
echo '  "rc_support": "'$(nvram get rc_support)'",'
echo '  "LAN MAC 位址": "'$(nvram get lan_hwaddr)'",'
echo '  "Wireless 2.4GHz MAC 位址": "'$(nvram get wl0_hwaddr)'",'
echo '  "Wireless 5GHz MAC 位址": "'$(nvram get wl1_hwaddr)'",'
echo '  "date": "'$(date)'"'
echo "}"
