<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'library/phpseclib');
require_once 'library/MainFunction.php';
require_once 'Net/SSH2.php';
require_once 'library/Requests.php';
require_once 'library/AppFunction.php';
Requests::register_autoloader();

$headers = array('Content-Type' => 'application/javascript');
$o = Requests::get('http://192.168.1.1/update_clients.asp',$headers);

$networkmap = $o->body;


if (strpos($networkmap,'<HTML><HEAD><script>top.location.href') !== false) {
	echo "登入失敗";
	exit;
}

$networkmap = str_replace('originDataTmp = originData;','',$networkmap);
$networkmap = str_replace("networkmap_fullscan = '0';",'',$networkmap);
$networkmap = str_replace('if(networkmap_fullscan == 1) genClientList();','',$networkmap);

?>

<script type="text/javascript">
<?=$networkmap;?>
</script>
<body>
	<?=$networkmap;?>
</body>
