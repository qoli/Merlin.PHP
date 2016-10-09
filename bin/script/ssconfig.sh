#!/bin/sh

# 導出 ss 配置 json

cd /opt/share/www/config

eval `dbus export ssconf_basic`

path=$(cd `dirname $0`; pwd)
# echo "Run Path: "${path}

rm ss-configs.json

touch ss-configs.json

echo "{" >>ss-configs.json

server_nu=`dbus list ssconf_basic_server | sort -n -t "_" -k 4|cut -d "=" -f 1|cut -d "_" -f 4`

for nu in $server_nu

do
	array1=`dbus get ssconf_basic_server_$nu`
	array2=`dbus get ssconf_basic_port_$nu`
	array3=`dbus get ssconf_basic_password_$nu`
	array4=`dbus get ssconf_basic_method_$nu`
	array5=`dbus get ssconf_basic_use_rss_$nu`
	array6=`dbus get ssconf_basic_onetime_auth_$nu`
	array7=`dbus get ssconf_basic_rss_protocol_$nu`
	array8=`dbus get ssconf_basic_rss_obfs_$nu`
	array9=`dbus get ssconf_basic_name_$nu`
	server_ip=`dbus get shadowsocks_server_ip`

	# if [  ! -z $(echo $array1 | awk '$0~/^[0-9]*$/')];then
	# 	echo '數字 - '$array1
	# fi

	ip=$(ping -c 1 $array1 -w 1 | awk -F'[()]' '/PING/{print $2}')

	if [ "$server_ip" == $ip ];then
		isWork="1"
	else
		isWork="0"
	fi

	echo ""$array9 ": (working: "$isWork") " $array1

cat >>ss-configs.json <<EOF

"$nu":
{
	"name":"$array9",
	"server":"$array1",
	"server_port":$array2,
	"password":"$array3",
	"protocol":"$array7",
	"obfs":"$array8",
	"method":"$array4",
	"working": "$isWork",
	"number":"$nu"
},

EOF
done
echo '"Max" :"'$nu'"' >>ss-configs.json
echo "}" >>ss-configs.json

# cat ss-configs.json

