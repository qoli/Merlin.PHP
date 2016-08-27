#!/bin/sh
echo '▪ DNS 設定腳本'
echo
if [ ! -n "$1" ]; then
	echo '□ 採用運營商 DNS'
	nvram set wan_dnsenable_x=1
	nvram set wan0_dnsenable_x=1
fi

if [ -n "$1" ]; then
	echo '□ 手動設定 DNS'
	echo
	echo '傳入: '$1
	nvram set wan_dnsenable_x=0
	nvram set wan0_dnsenable_x=0
	nvram set wan_dns="$1 $2"
	nvram set wan0_dns="$1 $2"
	nvram set wan0_xdns="$1 $2"
	nvram set wan_dns1_x="$1"
	nvram set wan0_dns1_x="$1"
	nvram set wan_dns2_x="$2"
	nvram set wan0_dns2_x="$2"
fi

nvram commit
echo
echo '□ service restart_dnsmasq'
service restart_dnsmasq
echo
echo '□ service restart_wan'
service restart_wan
echo
sleep 1
echo '□ resolv.conf'
cat /tmp/resolv.conf
echo
date
echo
echo '▪ 結束'
