#!/bin/sh
/usr/sbin/wget -4 --spider --quiet --tries=2 --timeout=2 www.google.com.tw

if [ "$?" == "0" ]; then
	echo '正常'
else
	echo '錯誤'
fi
