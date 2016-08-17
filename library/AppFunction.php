<?php

function ChmodCheck() {
	shell_exec("chmod +x /opt/share/www/bin/autoupdate/update.sh");
	shell_exec("chmod +x /opt/share/www/bin/autoupdate/check.sh");
	shell_exec("chmod +x /opt/share/www/bin/autoupdate/reinstall.sh");
	shell_exec("chmod +x /opt/share/www/bin/script/ssconfig.sh");
	shell_exec("chmod +x /opt/share/www/bin/script/netspeed.sh");
	$o = array('修正運行權限' => 'update.sh, check.sh, reinstall.sh, ssconfig.sh, netspeed.sh');
	echo json_encode($o);
}


/**
* BaseInformation
* 基本網絡信息網絡測試
**/
function BaseInformation() {

	if ((trim(shell_exec('nvram get wan0_dns'))) == '' ){
		$o = array(
			'狀態' => '連線中斷',
			'區域網' => shell_exec('nvram get lan_ipaddr_rt')
			);
	} else {

		$o = array(
			'網路類型' => shell_exec('nvram get wan0_proto'),
			'WAN IP' => shell_exec('nvram get wan0_ipaddr'),
			'DNS' => shell_exec('nvram get wan0_dns'),
			'LAN IP' => shell_exec('nvram get lan_ipaddr_rt'),
			);
	}
	echo json_encode($o);
}

/**
* ConnectTest
* $way(baidu,google,'');
* 網絡測試
**/

function ConnectTest($way){
	$lan = trim(shell_exec('nvram get lan_ipaddr_rt'));
	switch ($way) {
		case 'baidu':
		$o = array('延遲' => shell_exec("curl -o /dev/null -s -w %{time_total} --connect-timeout 10 https://www.baidu.com"));
		break;
		case 'google':
		$o = array('延遲' => shell_exec("curl -o /dev/null -s -w %{time_total} --connect-timeout 10 --socks5-hostname ".$lan.":23456 https://www.google.com/"));
		break;
		default:
		$o = array(
			'Baidu' => shell_exec("curl -o /dev/null -s -w %{time_total} --connect-timeout 6 https://www.baidu.com"),
			'Google' => shell_exec("curl -o /dev/null -s -w %{time_total} --connect-timeout 10 --socks5-hostname ".$lan.":23456 https://www.google.com/"),
			);
		break;

	}

	echo json_encode($o);
}


/**
*   GetShadowSockConfig
*   獲得 ShadowSock 配置信息
**/
function GetShadowSockConfig () {
		// $mode = trim(shell_exec('cat ss-mode'));
	$number = trim(shell_exec('nvram get ss_mode'));

	switch ($number) {
		case 1:
		$mode = 'gfw';
		break;
		case 2:
		$mode = 'mainland';
		break;
		case 3:
		$mode = 'game';
		break;
		case 4:
		$mode = 'v2';
		break;
	}

	switch ($mode) {
		case 'v2':
		$c=shell_exec("cat /koolshare/ss/koolgame/ss.json");
		$Config = json_decode($c);
		$Config_Output = array(
			'模式' => $mode,
			'Server' => $Config->server,
			'Server Port' => $Config->server_port
			);
		echo json_encode($Config_Output);
		break;
		case 'game':
		$c=shell_exec("cat /koolshare/ss/game/ss.json");
		$Config = json_decode($c);
		$Config_Output = array(
			'模式' => $mode,
			'Server' => $Config->server,
			'Server Port' => $Config->server_port,
			'PID' => shell_exec("cat /var/run/shadowsocks.pid")
			);
		echo json_encode($Config_Output);
		break;
		default:
		$Config_Output = array(
			'模式' => trim(shell_exec('cat ss-mode')),
			'Server' => shell_exec('dbus get ss_basic_server'),
			'Server Port' => shell_exec('dbus get ss_basic_port'),
			'Mode Number' => shell_exec('nvram get ss_mode'),
			'PID' => shell_exec("cat /var/run/shadowsocks.pid"),
			'DNS2SOCKS PID' => shell_exec("cat /var/run/sslocal1.pid")
			);
		echo json_encode($Config_Output);
		break;
	}

		// dump($Config);

}

/**
* RemoteIP
* 透過 ipinfo 反饋公網 IP
{
		ip: "202.96.30.237",
		hostname: "No Hostname",
		city: "Beijing",
		region: "Beijing",
		country: "CN",
		loc: "39.9289,116.3883",
		org: "AS4808 China Unicom Beijing Province Network"
}
**/

function RomoteIP() {
	$headers = array('Accept' => 'application/json');
	$request = Requests::get('http://ipinfo.io', $headers);

	$o = array(
		'公網 IP' => $request->body->ip,
		'位置' => $request->body->city,
		);

	echo json_encode($o);


}

/**
*
*
**/

function SSPID () {
	$PID = array('PID' => shell_exec("cat /var/run/shadowsocks.pid"));
	echo json_encode($PID);
}

/**
*   SwitchMode
*   $mode(gfw,mainland,game,v2);
* 切換 SS 模式
* gfw 黑名單；
* mainland 大陸白名單；
* game 遊戲模式（UDP）；
* v2 koolshare 的遊戲模式 v2；
**/

function SwitchMode($mode) {
		// echo $mode;
	echo '<pre>';
	system("/koolshare/ss/stop.sh");
	sleep(1);
	switch ($mode) {
		case 'gfw':
		shell_exec('dbus set ss_basic_mode=1');
		system('/koolshare/ss/ipset/start.sh');
		break;
		case 'mainland':
		shell_exec('dbus set ss_basic_mode=2');
		system('/koolshare/ss/redchn/start.sh');
		break;
		case 'game':
		shell_exec('dbus set ss_basic_mode=3');
		system('/koolshare/ss/game/start.sh');
		break;
		case 'v2':
		shell_exec('dbus set ss_basic_mode=4');
		system('/koolshare/ss/koolgame/start.sh');
		break;
		default:
		break;
	}
	shell_exec('/opt/share/www/bin/script/ssconfig.sh');
	system('echo '.$mode.' > ss-mode');
	echo '</pre>';
}

function FastReboot() {
	$mode = trim(shell_exec('cat ss-mode'));
	switch ($mode) {
		case 'gfw':
		$PID_R_O=shell_exec('cat /var/run/shadowsocks.pid');
		shell_exec('kill -9 '.$PID_R_O);
		shell_exec('ss-redir -b 0.0.0.0 -c /koolshare/ss/ipset/ss.json -f /var/run/shadowsocks.pid');
		$PID_R=shell_exec('cat /var/run/shadowsocks.pid');
		$PID_L_O = shell_exec('cat /var/run/sslocal1.pid');
		shell_exec('kill -9 '.$PID_L_O);
		shell_exec('ss-local -b 0.0.0.0 -l 23456 -c /koolshare/ss/ipset/ss.json -u -f /var/run/sslocal1.pid');
		$PID_L = shell_exec('cat /var/run/sslocal1.pid');
		$json = array('Mode' => $mode,'ss-redir PID' => trim($PID_R_O).' -> '.$PID_R, 'DNS2SOCKS PID' => trim($PID_R_O).' -> '.$PID_L);
		break;
		case 'mainland':
		$PID_R_O=shell_exec('cat /var/run/sslocal1.pid');
		shell_exec('kill -9 '.$PID_R_O);
		shell_exec('ss-local -b 0.0.0.0 -l 23456 -c /koolshare/ss/redchn/ss.json -u -f /var/run/sslocal1.pid');
		$PID_R=shell_exec('cat /var/run/sslocal1.pid');
		$PID_L_O = shell_exec('cat /var/run/redsocks2.pid');
		shell_exec('kill -9 '.$PID_L_O);
		shell_exec('redsocks2 -c /koolshare/ss/redchn/redsocks2.conf -p /var/run/redsocks2.pid');
		$PID_L = shell_exec('cat /var/run/redsocks2.pid');
		$json = array('Mode' => $mode,'ss-local PID' => trim($PID_R_O).' -> '.$PID_R, 'Red Socks PID' => trim($PID_R_O).' -> '.$PID_L);
		break;
		case 'game':
		$PID_R_O=shell_exec('cat /var/run/shadowsocks.pid');
		shell_exec('kill -9 '.$PID_R_O);
		shell_exec('ss-redir -b 0.0.0.0 -u -c /koolshare/ss/game/ss.json -f /var/run/shadowsocks.pid');
		$PID_R=shell_exec('cat /var/run/shadowsocks.pid');
		$PID_L_O = shell_exec('cat /var/run/sslocal1.pid');
		shell_exec('kill -9 '.$PID_L_O);
		shell_exec('ss-local -b 0.0.0.0 -l 23456 -c /koolshare/ss/game/ss.json -u -f /var/run/sslocal1.pid');
		$PID_L = shell_exec('cat /var/run/sslocal1.pid');
		$json = array('Mode' => $mode,'ss-redir PID' => trim($PID_R_O).' -> '.$PID_R, 'DNS2SOCKS PID' => trim($PID_L_O).' -> '.$PID_L);
		break;
		case 'v2':
		$PID_P_O = shell_exec('cat /tmp/var/pdu.pid');
		$PID_G_O = shell_exec("cat /tmp/var/koolgame.pid");
		shell_exec('kill -9 '.trim($PID_G_O));
		shell_exec("start-stop-daemon -S -q -b -m -p /tmp/var/koolgame.pid -x /koolshare/ss/koolgame/koolgame -- -c /koolshare/ss/koolgame/ss.json");
		$PID_G = shell_exec("cat /tmp/var/koolgame.pid");
		$PID_P = shell_exec('cat /tmp/var/pdu.pid');
		$json = array('Mode' => $mode,'PDU PID' => trim($PID_P_O).' -> '.trim($PID_P),'koolgame PID' => trim($PID_G_O).' -> '.trim($PID_G));
		break;
		default:
		break;
	}
	shell_exec('service restart_dnsmasq');
	echo json_encode($json);

}


function GetExec($command) {
	system($command);
}

function SystemNetwork() {
	echo "<pre>";
	echo "service restart_dnsmasq: ";
	system('service restart_dnsmasq');
	echo "service restart_wan: ";
	system('service restart_wan');
	echo "</pre>";
}

function SystemCommand($command) {
	echo '<pre>';
	system($command);
	echo '</pre>';
}

function flush_buffers()
{
	ob_end_flush();
	ob_flush();
	flush();
	ob_start('ob_callback');
}

/**
 * [ob_callback description]
 * @param  [type] $buffer [description]
 * @return [type]         [description]
 */
function ob_callback($buffer)
{
	return $buffer . str_repeat(' ', max(0, 4097 - strlen($buffer)));
}

/**
* merlin PHP 信息交互類
*/
class merlin_php
{

/**
 * [__construct description]
 */
	function __construct() {
				# code...
	}

	function _review($data,$title = '錯誤') {
		dump($data,$title);
				// exit;
	}


	function _export($data,$type = 'text') {
		switch ($type) {
			case 'array':
			$o = $data;
			echo json_encode($o);
			break;

			case 'json':
			$o = $data;
			echo json_encode($o);
			break;

			case 'pre':
			echo "<pre>";
			echo $data;
			echo "</pre>";
			break;

			default:
								# type == text
								// $o = array('text' => $data);
								// dump($data,'data');
								// dump($o,'o');
			$o = explode("\n",$data);
			if (end($o) == '') {
				array_pop($o);
			}
			echo json_encode($o);
			break;
		}
				// return json_encode($o);
	}

}


/**
* SS 配置
*/
class ssconfig extends merlin_php
{
	private $config;
	public $config_total;
	public $config_now;
	private $config_files = 'config/ss-configs.json';
	function __construct()
	{

		if (!file_exists($this->config_files)) {
						// 初始化配置
			shell_exec('/opt/share/www/bin/script/ssconfig.sh');
		}

		$this->config = json_decode(file_get_contents($this->config_files));
		$this->config_total = $this->config->Max;
	}

	function getAllConfig() {
		return $this->config;
	}

	function config($id) {
		if ($id > $this->config_total) {
			$id = $this->config_total;
		}
		$this->config_now = $this->config->$id;

		foreach ($this->config as $key => $value) {
			@$this->config->$key->working = 0;
		}

		$this->config->$id->working = 1;
		shell_exec('dbus set ss_basic_server="'.$this->config->$id->server.'"');
		shell_exec('dbus set ss_basic_port="'.$this->config->$id->server_port.'"');
		shell_exec('dbus set ss_basic_password="'.$this->config->$id->password.'"');
		shell_exec('dbus set ss_basic_method="'.$this->config->$id->method.'"');
		shell_exec('dbus set ss_basic_rss_protocol="'.$this->config->$id->protocol.'"');
		shell_exec('dbus set ss_basic_rss_obfs="'.$this->config->$id->obfs.'"');
		shell_exec('dbus set ss_basic_use_rss="0"');
		shell_exec('dbus set ssconf_basic_node="'.$this->config->$id->number.'"');
				// shell_exec('dbus set shadowsocks_server_ip="'.$this->config->$id->server.'"');

		return $this->config->$id;
	}

	function workng_ss() {

	}

	function rebuild() {
		$o = shell_exec('/opt/share/www/bin/script/ssconfig.sh');
		return($o);
	}

	function get_ss_basic() {
		$json = array(
			'ss_basic_server' => shell_exec('dbus get ss_basic_server'),
			'ss_basic_port' => shell_exec('dbus get ss_basic_port'),
						// 'ss_basic_password' => shell_exec('dbus get ss_basic_password'),
			'ss_basic_method' => shell_exec('dbus get ss_basic_method'),
			'ss_basic_mode' => shell_exec('dbus get ss_basic_mode'),
			'nvram ss_mode' => shell_exec('nvram get ss_mode'),
			'shadowsocks_server_ip' => shell_exec('dbus get shadowsocks_server_ip')

			);
		return $json;
	}

}

function ss_all_config() {
	$ssconfig = new ssconfig();
	echo json_encode($ssconfig->getAllConfig());
}

function ss_config($id = 0) {
	$ssconfig = new ssconfig();
	if ($id == 0) {
		echo json_encode($ssconfig->getAllConfig());
	} else {
		echo json_encode($ssconfig->config($id));
	}
}

function ss_rebuild() {
	$ssconfig = new ssconfig();
		// echo $ssconfig->_be_json($ssconfig->rebuild());
	$ssconfig->_export($ssconfig->rebuild());
}

function ss_basic() {
	$ssconfig = new ssconfig();
	echo json_encode($ssconfig->get_ss_basic());
}

/**
* 遠程工具
*/
class remote extends merlin_php
{
	public $config;
	public $config_total;
	public $config_now;
	public $ssh;
	private $config_files = 'config/vps-config.json';
	private $config_template = 'config/vpsconfig.template.json';
	private $dev = true;

	function __construct() {

		if (!file_exists($this->config_files)) {
			$d = file_get_contents($this->config_template);
			file_put_contents($this->config_files, $d);
		}

				// 讀取配置文件
		$this->config = json_decode(file_get_contents($this->config_files));
		$this->config_total = count((array)$this->config);

	}

	function getAllConfig() {
		return $this->config;
	}

	function config($id) {
		if ($id > $this->config_total) {
			$id = $this->config_total;
		}
		$this->config_now = $this->config->$id;

		$this->ssh = new Net_SSH2($this->config_now->server);
		if (!$this->ssh->login($this->config_now->name, $this->config_now->pass)) {
						// $this->_review($this->config_now, 'Login Failed');
			return 'Login Failed';
		}

		return $this;
	}

	function test($id) {
		$this->config_now = $this->config->$id;

		$this->ssh = new Net_SSH2($this->config_now->server);
		if (!$this->ssh->login($this->config_now->name, $this->config_now->pass)) {
						// $this->_review($this->config_now, 'Login Failed');
			return 'Login Failed';
		} else {
			return 'success';
		}
	}

	function command($command = 'whoami') {
		return $this->ssh->exec($command);
	}

	function getConfig($id) {
		if ($id > $this->config_total) {
			$id = $this->config_total;
		}

		if (isset($this->config->$id)) {

		}

		$this->config_now = $this->config->$id;

		return $this->config_now;
	}

	function saveConfig($id,$data) {
		$this->config->$id->server = $data['ip'];
		$this->config->$id->name = $data['user'];
		$this->config->$id->pass = $data['pass'];
		return file_put_contents($this->config_files,json_encode($this->config));
	}

	function clist() {
		foreach ($this->config as $k => $c) {
			$arr[$k] = $c->server;
		}

		return $arr;
	}

	function setActive($id) {

		foreach ($this->config as $key => $value) {
			$this->config->$key->active = false;
		}

		$this->config->$id->active = true;
				// dump(json_encode($this->config));
		return file_put_contents($this->config_files,json_encode($this->config));
	}

}

function remote_connectTest() {
	$remote = new remote();
	@$o = $remote->test(1);
	echo $o;
}

function remote_command($command = 'ls -a') {
	$remote = new remote();
	$o = $remote->config(1)->command($command);
	echo $o;
}

function remote_clist() {
	$remote = new remote();
	echo json_encode($remote->clist());
}

function remoteConfig() {
	$remote = new remote();
	echo json_encode($remote->getAllConfig());
}

function setActive($id) {
	$remote = new remote();
	echo json_encode($remote->setActive($id));
}

function json_update($json_file,$name,$var) {
		//todo: 未處理傳遞多個參數
	$j = json_decode(file_get_contents($json_file));
	$j->$name = $var;
	file_put_contents($json_file,json_encode($j));
	echo json_encode($j);
}

/**
* setting
*
**/
class setting extends merlin_php
{
	public $config;
	public $config_total;
	private $config_files = 'config/setting-config.json';
	private $config_template = 'config/setting.template.json';
	function __construct()
	{
		if (!file_exists($this->config_files)) {
			$d = file_get_contents($this->config_template);
			file_put_contents($this->config_files, $d);
		}

				// 讀取配置文件
		$this->config = json_decode(file_get_contents($this->config_files));
		$this->config_total = count((array)$this->config);
	}

	function set($name, $value) {
		$this->config->$name = $value;
		$o =  file_put_contents($this->config_files, json_encode($this->config));
		if (!$o) {
			return false;
		} else {
			return true;
		}
	}

	function get($name) {
		return $this->config->$name;
	}

	function getAll() {
		return $this->config;
	}

	function rebuild() {
		$d = file_get_contents($this->config_template);
		return file_put_contents($this->config_files, $d);
	}
}

































