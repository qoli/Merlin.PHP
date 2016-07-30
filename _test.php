<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'library/phpseclib');
require_once 'library/MainFunction.php';
require_once 'Net/SSH2.php';
require_once 'library/Requests.php';
require_once 'library/AppFunction.php';
Requests::register_autoloader();

// $d = file_get_contents('config/setting.template.json');
// file_put_contents('config/setting-config.json', $d);
// $c = file_get_contents('config/setting-config.json');
$s = new setting();

$o = $s->set('remote', 0);
$o = $s->getAll();
// dump($d);
dump($o);

echo @display($o->dev);

function display($v = '') {
	if ($v or $v != '') {
		return 'block';
	} else {
		return 'none';
	}
}

exit;

$s = new setting();
$o = $s->getAll();

?>
<style name="setting-config" type="text/css">

.setting-remote {
	display: <?=display($o->remote);?>
}

.setting-debug {
	display: <?=display($o->debug);?>
}

.setting-dev {
	display: <?=display($o->dev);?>
}

</style>
