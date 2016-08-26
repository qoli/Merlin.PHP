#!/bin/sh

cd /tmp
wget --no-check-certificate --timeout=15 https://raw.githubusercontent.com/koolshare/koolshare.github.io/master/shadowsocks/shadowsocks.tar.gz
tar -zxvf /tmp/shadowsocks.tar.gz
chmod +x /tmp/shadowsocks/install.sh
sh /tmp/shadowsocks/install.sh
