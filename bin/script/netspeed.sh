#!/bin/sh

up_time1=`cat /sys/class/net/$1/statistics/tx_bytes`
down_time1=`cat /sys/class/net/$1/statistics/rx_bytes`

sleep 1

up_time2=`cat /sys/class/net/$1/statistics/tx_bytes`
down_time2=`cat /sys/class/net/$1/statistics/rx_bytes`

up_time1=${up_time1##bytes:}
up_time2=${up_time2##bytes:}
down_time1=${down_time1##bytes:}
down_time2=${down_time2##bytes:}

up_time=`expr $up_time2 - $up_time1`
down_time=`expr $down_time2 - $down_time1`
up_time=`expr $up_time / 1024`
down_time=`expr $down_time / 1024`

echo 上傳：$up_time kb/s ． 下載：$down_time kb/s
