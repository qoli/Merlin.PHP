#!/bin/sh

up_time1=`ifconfig $1 | grep "bytes" | awk '{printf $6}'`
down_time1=`ifconfig $1 | grep "bytes" | awk '{print $2}'`

sleep 1

up_time2=`ifconfig $1 | grep "bytes" | awk '{print $6}'`
down_time2=`ifconfig $1 | grep "bytes" | awk '{print $2}'`

up_time1=${up_time1##bytes:}
up_time2=${up_time2##bytes:}
down_time1=${down_time1##bytes:}
down_time2=${down_time2##bytes:}

up_time=`expr $up_time2 - $up_time1`
down_time=`expr $down_time2 - $down_time1`
up_time=`expr $up_time / 1024`
down_time=`expr $down_time / 1024`

echo 上傳：$up_time kb/s ． 下載：$down_time kb/s
