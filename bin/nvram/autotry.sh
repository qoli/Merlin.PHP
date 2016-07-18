#!/bin/sh
# http://www.linksysinfo.org/index.php?threadsv1-23-how-to-script-automatic-wan-dhcp-release-renew.29372/
# modified by Xruptor to use wan_dns instead of get_wan_dns.  This will return the static DNS instead of Modem
# static dns should be 8.8.8.8

# cable modems require the SIGUSR1 and SIGUSR2 commands
# https://stuff.mit.edu/afs/sipb/project/merakidev/src/openwrt-meraki/openwrt/build_mips/busybox-1.1.0/networking/udhcp/README.udhcpc

while [ true ]; do
  while [ "`nvram get wan_get_dns`" = "" ]; do
    logger Renewing DHCP and waiting for external DNS
    killall -SIGUSR1 udhcpc
    sleep 10
  done
  wandns=`nvram get wan_dns | awk '{ print $1 }'`
  if ping -c 5 -W 1 $wandns | grep "100% packet loss" ; then
    logger $wandns is DOWN, requesting DHCP release/renew
    killall -SIGUSR2 udhcpc
  else
    sleep 10
  fi
done
